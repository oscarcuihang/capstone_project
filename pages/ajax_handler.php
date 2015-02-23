<?php
if(!session_start())
	die("Error: fail to start session");
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("rtp", $conn);
include_once "authentication.php";

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