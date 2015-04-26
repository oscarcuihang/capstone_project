<?php include '../templates/header.html'; ?>

<script type="text/javascript">
function clickAction(form, pk, tbl)
{
    document.forms[form].elements['pk'].value = pk;
    document.forms[form].elements['tbl'].value = tbl;

    document.getElementById(form).submit();
}
</script>

<?php include '../templates/navbar.html'; ?>


<div class="container">
     
<?php
	if (isset($_POST['pk'])){
		$journal_id = $_POST['pk'];
	}
	else {
		$journal_id = $_GET['id'];
	}
		$query_journal = "SELECT * FROM travelJournal WHERE id = '$journal_id'";
	    $result = mysql_query($query_journal,$conn) or die(mysql_error());
	    $rows = mysql_num_rows($result);
	    $journal = mysql_fetch_assoc($result);
	    
	    if (isset($_SESSION['id'])) {
	    	if ($journal['journal_userid'] == $_SESSION["id"])
			{
?>			
				<p1>Your are the onwer, you can</p1>
		        <input class="btn btn-warning" type = "button" value ="Update">
		        OR
		        <form action='/capstone_project/pages/journal/viewjournal.php' id='delete_action' method='POST'>
        		<input type='hidden' name='pk'>
        		<input type='hidden' name='tbl'>
		        <input class="btn btn-danger" type = "button" value ="Delete">
		        This Journal
		        </form>
<?php
			}
		}
?>
		<h3><?php  echo $journal['journal_title']; ?></h3>
		<p1><?php  echo $journal['journal_content']; ?></p1>


</div> <!-- /container -->

<?php include '../templates/footer.html'; ?>