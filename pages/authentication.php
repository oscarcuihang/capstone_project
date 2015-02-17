<?php
function register_new_user($user, $conn){
	//	user = {
	//		"fname" => 	""
	//		"lname"	=>	""
	//		"email"	=>	""
	//		"phone"	=>	""
	//		"salt"	=>	""
	//		"password"	=>	""
	//	}
	$fname = $user["fname"];
	$lname = $user["lname"];
	$email = $user["email"];
	$phone = $user["phone"];
	$salt = md5(time());
	$pass = $user["password"];
	$hashpass = md5($salt. $pass);
	$result = mysql_query("SELECT * FROM userinfo WHERE user_email = '$email'");
	if(mysql_num_rows($result) > 0)
		return -1;	//	user already exist
	if(mysql_query("INSERT INTO userinfo VALUES(DEFAULT, '$fname', '$lname', '$email', '$phone', '$salt', '$hashpass')"))
		return 1;	//	insertion success
	else return 0;	// 	insertion fail
}

function authentication_user($user, $conn){
	//	user = {
	//		"email"	=>	""
	//		"password"	=>	""
	//		"hashpass"	=>	""
	//	}
	$email = $user["email"];
	$pass = $user["password"];
	$user_hash = $user["hashpass"];
	$result = mysql_query("SELECT * FROM userinfo WHERE user_email = '$email'");
	if(mysql_num_rows($result) == 0)
		return 0;	//	user not exist
	$row = mysql_fetch_assoc($result);
	$salt = $row["user_salt"];
	$hashpass = $row["user_hashpass"];
	if($hashpass != $user_hash)
		return 1;	// 	
}
?>