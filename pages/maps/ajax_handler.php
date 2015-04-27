<?php
if(!session_start())
	die("Error: fail to start session");
$conn = mysql_connect("localhost", "root", "root");
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
	$query = "SELECT * FROM userInfo WHERE user_email = '$email'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows != 0) {
		return -1;	//	user already exist
	}
	else {
		mysql_query("INSERT INTO userInfo VALUES(DEFAULT, '$fname', '$lname', '$email', '$phone', '$salt', '$hashpass')") or die("Error: do not succeed");
		$_SESSION["email"] = $user["email"];
		$_SESSION["lname"] = $user["lname"];
		$_SESSION["fname"] = $user["fname"];
		$query = "SELECT id FROM userInfo WHERE user_email = '". $user["email"]."'";
		$result = mysql_query($query);
		$k = mysql_fetch_assoc($result);
		$_SESSION["id"] = $k["id"];
		/*
		$dir = "users";
		while(!is_dir($dir)){
			$dir = "../". $dir;
		}
		//echo "$dir/$email";
		mkdir("$dir/$email") or die("ER1");
		mkdir("$dir/$email/pic") or die("ER2");
		mkdir("$dir/$email/journal") or die("ER3");
		*/

		$result = mysql_query("SELECT id FROM userInfo WHERE user_email = '$email'");
		$row = mysql_fetch_assoc($result);
		$user_id = $row["id"];
		$ip = $_SERVER["REMOTE_ADDR"];
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $user_id, '$ip', DEFAULT, 'register')");
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $user_id, '$ip', DEFAULT, 'log in')");
		return 1;
	}
}

function authentication_user($user, $conn){
	//	user = {
	//		"email"	=>	""
	//		"password"	=>	""
	//	}
	$email = $user["email"];
	$pass = $user["password"];
	$query = "SELECT * FROM userInfo WHERE user_email = '$email'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
    if ($rows == 0) {
		return 0;	//	user not exist
    }
    else {
		$row = mysql_fetch_assoc($result);
		//print_r($row);
		$salt = $row["user_salt"];
		$user_hash = md5($salt. $pass);
		$hashpass = $row["user_hashpass"];
	}
	if($hashpass == $user_hash){
		$_SESSION["email"] = $row["user_email"];
		$_SESSION["lname"] = $row["user_lname"];
		$_SESSION["fname"] = $row["user_fname"];
		$_SESSION["id"] = $row["id"];
		$user_id = $row["id"];
		$ip = $_SERVER["REMOTE_ADDR"];
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $user_id, '$ip', DEFAULT, 'log in')");
		return 1;	// 	log in successfully
	} else return -1;	// password not right
}

function sign_out_user($user, $conn){
	if(isset($_SESSION["email"])){
		$email = $_SESSION["email"];
		unset($_SESSION["email"]);
		unset($_SESSION["lname"]);
		unset($_SESSION["fname"]);
		unset($_SESSION["id"]);
		session_destroy();
		$query = "SELECT id FROM userInfo WHERE user_email = '$email'";
		$result = mysql_query($query);
		if($result == FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}
		$ip = $_SERVER["REMOTE_ADDR"];
		$line = mysql_fetch_assoc($result);
		$user_id = $line["id"];
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $user_id, '$ip', DEFAULT, 'log out')");	
	}
}

// Calculate the relative url for the current page, require the target url to be a file name
// the second parameter is used to define the number of iterations before the while-loop should stop
// If relative url calculation between two different url is need, new function shoul be defined
function relative_url($target_url, $i = 10){
	$relative_url = "$target_url";
	while(!is_file($relative_url) && (--$i)){
		$relative_url = "../". $relative_url;
	}
	if($i == 0)
		return null;
	else return $relative_url;
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
	echo relative_url("home.php");
} else if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == 'register'){
	//
	//	Register new user
	//
	$r = register_new_user($_REQUEST, $conn);
	echo $r;
} else if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == "trip_save"){
	$receive = $_REQUEST;
	$json = json_decode($receive["json"], true);
	$title = $receive["title"];
	$trip_id = ($receive["trip_id"] == -1)? "DEFAULT" : $receive["trip_id"];
	//echo $receive["trip_id"]. " ". $trip_id;
	$head = array_shift($json);
	$start = $head["lat"]. "," . $head["lng"];
	$end = end($json)["lat"]. ",". end($json)["lng"];
	array_pop($json);
	$userid = $_SESSION["id"];
	if($trip_id == "DEFAULT"){
		$query = "INSERT INTO tripPlan VALUES($trip_id, $userid, '$title', '$start', '$end', DEFAULT";
		for($i = 0; $i < 8; $i++){
			if(isset($json[$i])){
				$tmp = $json[$i];
				$tmp = $tmp["lat"]. ",". $tmp["lng"];
				$query .= ", '$tmp'";
			} else $query .= ", NULL";
		}
		$query .= ", DEFAULT, DEFAULT)";
		//echo $query;
		mysql_query($query) or die(mysql_error());
	} else {
		$query = "UPDATE tripPlan SET trip_title = '$title', trip_startaddress = '$start', trip_endaddress = '$end', trip_last_updated = DEFAULT";
		for($i = 0; $i < 8; $i++){
			if(isset($json[$i])){
				$tmp = $json[$i];
				$tmp = $tmp["lat"]. ",". $tmp["lng"];
				$query .= ", detail_waypoint". ($i + 1). "_address = '$tmp'";
			} else $query .= ", detail_waypoint". ($i + 1) . "_address = NULL";
		}
		$query .= " WHERE id = $trip_id";
		//echo $query;
		mysql_query($query) or die(mysql_error());
	}
	if($trip_id == "DEFAULT"){
		$result = mysql_query("SELECT id FROM tripPlan WHERE trip_userid = $userid ORDER BY trip_last_updated DESC") or die(mysql_error());
		if(mysql_num_rows($result) > 0){
			$row = mysql_fetch_assoc($result);
			echo json_encode(array("trip_id" => $row["id"]));
		} else echo json_encode(array("trip_id" => -1));
	} else echo json_encode(array("trip_id" => $trip_id));
} else if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == "loadplan"){
	$id = $_SESSION["id"];
	$result = mysql_query("SELECT * FROM tripPlan WHERE trip_userid = $id ORDER BY trip_last_updated DESC") or die(mysql_error());
	$num = mysql_num_rows($result);
	$plans = array();
	if($num > 0){
		$plans["content"] = array();
		while($row = mysql_fetch_assoc($result)){
			$plans["content"][] = $row;
		}
		echo json_encode($plans);
	} else echo json_encode(array("content" => array()));
} else echo "fail";
mysql_close($conn);
?>