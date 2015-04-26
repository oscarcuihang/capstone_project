<?php include '../templates/header.html'; ?>

<script type="text/javascript">

function clickAction(form, Jid, action)
{
  document.forms[form].elements['Jid'].value = Jid;
  document.forms[form].elements['action'].value = action;

  document.getElementById(form).submit();
}

</script>

<?php include '../templates/navbar.html'; ?>

<form action='text_editor.php' id='action_form' method='POST'>
    <input type='hidden' name = 'Jid'>
    <input type='hidden' name = 'action'>
</form>

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
				    <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $journal_id; ?>', 'edit');">Update</a>
				<p1> OR </p1>
		        <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $journal_id; ?>">Delete <span class="glyphicon glyphicon-chevron-right"></span></a>
		        <p1>This Journal</p1>
<?php
			}
		}
?>
		<h3><?php  echo $journal['journal_title']; ?></h3>
		<p1><?php  echo $journal['journal_content']; ?></p1>


</div> <!-- /container -->

<?php include '../templates/footer.html'; ?>