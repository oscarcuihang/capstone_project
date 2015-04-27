
<?php include '../templates/header.html'; ?>
<?php //include '../templates/navbar.html'; ?>

<?php


if(!isset($_SESSION['id'])){
	die ("Miaomiao shi huai ren!");
}
 if(isset($_POST["editor"])){
		$id=$_SESSION["id"];
		$editor=$_POST["editor"];
		$query = "INSERT INTO question VALUES(DEFAULT,'$id','$editor',DEFAULT,0,0)";
		mysql_query($query,$conn) or die(mysql_error());
				
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $id, '$ip', DEFAULT, 'create/post question')");

		header('Location: index.php');
		
 }
?>