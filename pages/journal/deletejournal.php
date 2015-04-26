<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>


    <div class="container">
<?php

  if (isset($_POST['delete']))
  {
    $journalid = $_GET['id'];
    $query = "DELETE FROM travelJournal WHERE id = '$journalid'";
    mysql_query($query,$conn) or die(mysql_error());
?>
    <h4>Journal has been deleted.</h4>
    <hr>
    <a class="btn btn-warning" href="/capstone_project/pages/home.php">Home<span class="glyphicon glyphicon-chevron-right"></span></a>

<?php
  }

else{
  if (isset($_GET['id']))
  {
    $journalid = $_GET['id'];
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM travelJournal WHERE id = '$journalid'";
    $result = mysql_query($query,$conn) or die(mysql_error());
    $rows = mysql_num_rows($result);
    $journal = mysql_fetch_assoc($result);
    if ( $journal['journal_userid'] != $user_id)
    {
      echo "<h4>Access Denied</h4>";
    }

?>
   

     <h4>Are you sure to delete this journal?</h4>
     <hr>
    <form id = "delete" method="POST" action = "">
      <a class="btn btn-warning" href="/capstone_project/pages/journal/viewjournal.php?id=<?php echo $_GET['id']; ?>">Cancel<span class="glyphicon glyphicon-chevron-right"></span></a>
     
      <input type = "submit" class="btn btn-danger" name = "delete" value= "Confirm">
      <input type="hidden" name="jid" value="<?php echo $_GET['id']; ?>">
    </form>   
    </div> <!-- /container -->
<?php
}
}
?>

<?php include '../templates/footer.html'; ?>
