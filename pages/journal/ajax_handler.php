<?php
if(!session_start())
	die("Error: fail to start session");
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("rtp", $conn);

function register_new_user($user, $conn){
	//	user = {
	//		"fname" => 	""
	//		"lname"	=>	""
	//		"email"	=>	""
	//		"phone"	=>	""
	//		"password"	=>	""
	//	}
	$fname = $user["fname"];
	$lname = $user["lname"];
	$email = $user["email"];
	$phone = $user["phone"];
	$salt = md5(time());
	$pass = $user["password"];
	$hashpass = md5($salt. $pass);
	//print_r($user);
	$result = mysql_query("SELECT * FROM userinfo WHERE user_email = '$email'");
	if(mysql_num_rows($result) > 0)
		return -1;	//	user already exist
	mysql_query("INSERT INTO userinfo VALUES(DEFAULT, '$fname', '$lname', '$email', '$phone', '$salt', '$hashpass')") or die("Error: do not succeed");
	$_SESSION["email"] = $user["email"];
	$_SESSION["lname"] = $user["lname"];
	$_SESSION["fname"] = $user["fname"];
	return 1;
}

function authentication_user($user, $conn){
	//	user = {
	//		"email"	=>	""
	//		"password"	=>	""
	//	}
	$email = $user["email"];
	$pass = $user["password"];
	$result = mysql_query("SELECT * FROM userinfo WHERE user_email = '$email'");
	if(mysql_num_rows($result) == 0)
		return 0;	//	user not exist
	$row = mysql_fetch_assoc($result);
	//print_r($row);
	$salt = $row["user_salt"];
	$user_hash = md5($salt. $pass);
	$hashpass = $row["user_hashpass"];
	if($hashpass == $user_hash){
		$_SESSION["email"] = $row["user_email"];
		$_SESSION["lname"] = $row["user_lname"];
		$_SESSION["fname"] = $row["user_fname"];
		return 1;	// 	log in successfully
	} else return -1;	// password not right
}

function sign_out_user($user, $conn){
	if(isset($_SESSION["email"])){
		unset($_SESSION["email"]);
		unset($_SESSION["lname"]);
		unset($_SESSION["fname"]);
		session_destroy();
	}
}

if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == 'login'){
	//	
	//	Log in ajax handler
	//
	$r = authentication_user($_REQUEST, $conn);
	echo $r;
} else if(isset($_REQUEST["signout"])){
	//
	//	Sign out ajax handler
	//
	sign_out_user($_SESSION["email"], $conn);
} else if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == 'register'){
	//
	//	Register new user
	//
	$r = register_new_user($_REQUEST, $conn);
	echo $r;
} else echo "fail";
mysql_close($conn);
?>