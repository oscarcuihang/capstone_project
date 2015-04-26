<?php
if(!session_start()){
	die ("Miaomiao shi huai ren!");
}
 if(isset($_POST["editor"])){
		$tag1 = $_POST["tag1"];
		$tag2 = $_POST["tag2"];
		$tag3 = $_POST["tag3"];
		$tag4 = $_POST["tag4"];
		$tag5 = $_POST["tag5"];
		$id=$_SESSION["id"];
		$Jid=$_POST["Jid"];
		$editor=$_POST["editor"];
		$title=$_POST["journal_title"];
		//if never save before,directly submit to the database
		//for journal_status: 1 means submit version
		//					  0 means save version
		if($_POST["operation"]=="submit"){
			if($_POST["Jaction"]=="create"){
				$query = "INSERT INTO traveljournal VALUES(DEFAULT,'$id','$title','$editor',DEFAULT,'',1,0,0,'$tag1','$tag2','$tag3','$tag4','$tag5')";
				mysql_query($query,$conn) or die(mysql_error());
				
				//#then jump to the view mypage
				header('../mypages/myjournal.php');
			}
			else if($_POST["Jaction"]=="edit"){
				$query = "UPDATE traveljournal SET journal_title='$title', journal_content='$editor', journal_tag1='$tag1', journal_tag2='$tag2', journal_tag3='$tag3', journal_tag4='$tag4', journal_tag5='$tag5', journal_timestamp = DEFAULT WHERE id='$Jid'";
				mysql_query($query, $conn) or die(mysql_error());
				
				header('../mypages/myjournal.php');
			}
		}
		else if($_POST["operation"]=="save"){//$_POST["s_s"]=="save",only difference is can not be searched
			if($_POST["Jaction"]=="create"){
				$query = "INSERT INTO traveljournal VALUES(DEFAULT,'$id','$title','$editor',DEFAULT,'',0,0,0,'$tag1','$tag2','$tag3','$tag4','$tag5')";
				mysql_query($query,$conn) or die(mysql_error());
				
				//#then jump to the view mypage
				header('../mypages/myjournal.php');
			}
			else if($_POST["Jaction"]=="edit"){
				$query = "UPDATE traveljournal SET journal_title='$title', journal_content='$editor', journal_tag1='$tag1', journal_tag2='$tag2', journal_tag3='$tag3', journal_tag4='$tag4', journal_tag5='$tag5', journal_timestamp = DEFAULT, journal_status=0 WHERE id='$Jid'";
				mysql_query($query, $conn) or die(mysql_error());
				
				header('../mypages/myjournal.php');
			}
		}
}
?>