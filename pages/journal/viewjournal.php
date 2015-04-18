<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>


    

    <div class="container">

     
<?php

	$journal_id = $_POST['pk'];
	$query_journal = "SELECT * FROM travelJournal WHERE id = '$journal_id'";
    $result = mysql_query($query_journal,$conn) or die(mysql_error());
    $rows = mysql_num_rows($result);
    $journal = mysql_fetch_assoc($result);
?>
	<h3><?php  echo $journal['journal_title']; ?></h3>

	<p1><?php  echo $journal['journal_content']; ?></p1>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>



