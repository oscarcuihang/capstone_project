
<?php include '../templates/header.html'; ?>
<?php //include '../templates/navbar.html'; ?>

<?php


if(!isset($_SESSION['id'])){
	die ("Miaomiao shi huai ren!");
}
 if(isset($_POST["editor"])){
	 if($_POST["editor"]==NULL){
		 echo '<form id="emptyInfo" action="index.php" method="POST">';
		 echo '<input type="hidden" name="message" value="Empty question cannot be created!!">'
		 echo '</form>';
		 echo '<script language="javascript">';
		 echo 'document.getElementById("emptyInfo").submit()';
		 echo '</script>';
	 }
	 else{
		$id=$_SESSION["id"];
		$editor=$_POST["editor"];
		$query = "INSERT INTO question VALUES(DEFAULT,'$id','$editor',DEFAULT,0,0)";
		mysql_query($query,$conn) or die(mysql_error());
				
		mysql_query("INSERT INTO userLog VALUES(DEFAULT, $id, '$ip', DEFAULT, 'create/post question')");
		
		 echo '<form id="emptyInfo" action="index.php" method="POST">';
		 echo '<input type="hidden" name="message" value="Empty question cannot be created!!">'
		 echo '</form>';
		 echo '<script language="javascript">';
		 echo 'document.getElementById("emptyInfo").submit()';
		 echo '</script>';
	 }		
?>