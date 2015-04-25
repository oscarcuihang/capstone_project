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
	
		//if never save before,directly submit to the database
		//for journal_status: 1 means submit version
		//					  0 means save version
		if($_POST["s_s"]=="submit"){
			$query = "INSERT INTO table traveljournal VALUES(DEFAULT,'".$_SESSION["id"]."','".$_POST["journal_title"]."','".$_POST["editor"]."',DEFAULT,'',1,0,0,'".$tag1."','".$tag2."','".$tag3."','".$tag4."','".$tag5."')";
			mysql_query($query,$conn) or die(mysql_error());
			
			//#then jump to the view mypage
			header('../mypages/myjournal.php');
		}
		else{//$_POST["s_s"]=="save",only difference is can not be searched
			$query = "INSERT INTO table traveljournal VALUES(DEFAULT,'".$_SESSION["id"]."','".$_POST["journal_title"]."','".$_POST["editor"]."',DEFAULT,'',0,0,0,'".$tag1."','".$tag2."','".$tag3."','".$tag4."','".$tag5."')";
			mysql_query($query,$conn) or die(mysql_error());
			
			//#then jump to the view mypage
			header('../mypages/myjournal.php');
		
		}
}
?>