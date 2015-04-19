<?php 
  //include '../../database.php'; 
	if(!session_start())
		die("Error: fail to start session");
    $conn = mysql_connect("localhost", "root", "");
	mysql_select_db("rtp", $conn);
?>

<?php

	$query_journal = "SELECT * FROM travelJournal WHERE id=101";
        $result = mysql_query($query_journal,$conn) or die(mysql_error());
        $rows = mysql_num_rows($result);
        
       
        
      $line = mysql_fetch_assoc($result);
      echo $line['journal_cover_page'];
?>