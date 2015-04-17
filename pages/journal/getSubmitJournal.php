<?php
if(!session_start()){
	die ("Miaomiao shi huairen!");
}
 if(isset($_POST["editor"])){
		$tag1 = $_POST["tag1"];
		$tag2 = $_POST["tag2"];
		$tag3 = $_POST["tag3"];
		$tag4 = $_POST["tag4"];
		$tag5 = $_POST["tag5"];
	
		//if never save before,directly submit to the database
		//for journal_status: 2 means submit version
		//					  1 means save version
		$query_content = "INSERT INTO table traveljournal output Inserted.id VALUES('".$_SESSION["id"]."','".$_POST["journal_title"]."','".$_POST["editor"]."','','',2);";
		$query_tag = "INSERT INTO traveljournaltag VALUES('".$tag1."','".$tag2."','".$tag3."','".$tag4."','".$tag5."')";
		
		mysql_query($query_content,$conn) or die(mysql_error());
		mysql_query($query_tag,$conn) or die(mysql_error());
		
		//#then jump to the view page[the same page as click the view button after search]

}
?>