<?php include '../templates/header.html'; ?>

<script type="text/javascript">
function clickAction(form, pk, tbl)
{
    document.forms[form].elements['pk'].value = pk;
    document.forms[form].elements['tbl'].value = tbl;

    document.getElementById(form).submit();
}


function updateaction(form, Jid, action)
{
  document.forms[form].elements['Jid'].value = Jid;
  document.forms[form].elements['action'].value = action;

  document.getElementById(form).submit();
}
</script>

<?php include '../templates/navbar.html'; ?>

<div class="container">

<hr>


<form method="POST" action="">
  <button class="btn btn-info" type="submit" name = "journal"> My Uploaded Journals <span class="glyphicon glyphicon-chevron-right"></span></button>
  <button class="btn btn-info" type="submit" name = "draft"> My Drafts <span class="glyphicon glyphicon-chevron-right"></span></button>
</form>

<form action='/capstone_project/pages/journal/viewjournal.php' id='action_form' method='POST'>
  <input type='hidden' name='pk'>
  <input type='hidden' name='tbl'>
</form>

<form action='/capstone_project/pages/journal/text_editor.php' id='edit_form' method='POST'>
    <input type='hidden' name = 'Jid'>
    <input type='hidden' name = 'action'>
</form>

<hr>
<?php
  if(isset($_POST['draft']))
  {
    $user_id = $_SESSION["id"];
  $query = "SELECT * FROM travelJournal WHERE journal_userid = '$user_id' AND journal_status = 0 ORDER BY journal_timestamp DESC";
  
  $result = mysql_query($query,$conn) or die(mysql_error());  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $journal_title = $line['journal_title'];
        $journal_timestamp = $line['journal_timestamp'];
        $journal_userid  = $line['journal_userid'];
        $journal_content  = $line['journal_content'];
        $journal_id = $line['id'];

        $query_user = "SELECT * FROM userInfo WHERE id = '$journal_userid'";
        $result_user = mysql_query($query_user,$conn) or die(mysql_error());
        $user_info = mysql_fetch_assoc($result_user);
        $user_name = $user_info['user_fname'] . " " . $user_info['user_lname'] ;
?>
        <div class="row">
            <div class="col-md-12" style="weight:300px">
                <h3><?php echo $journal_title; ?></h3>
                <p><?php echo $journal_timestamp; ?></p>

                <p class="myPara"><?php echo $journal_content; ?></p>
                <a class="btn btn-warning" onclick="updateaction('edit_form', '<?php echo $journal_id; ?>', 'edit');">Update <span class="glyphicon glyphicon-chevron-right"></span></a>                
                <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $journal_id; ?>&direction=myjournal">Delete <span class="glyphicon glyphicon-chevron-right"></span></a>

            </div>
        </div>
        <hr>
<?php
      }

  }
  else
  {
  $user_id = $_SESSION["id"];
  $query = "SELECT * FROM travelJournal WHERE journal_userid = '$user_id' AND journal_status = 1 ORDER BY journal_timestamp DESC";
  
  $result = mysql_query($query,$conn) or die(mysql_error());  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $journal_title = $line['journal_title'];
        $journal_timestamp = $line['journal_timestamp'];
        $journal_userid  = $line['journal_userid'];
        $journal_content  = $line['journal_content'];
        $journal_id = $line['id'];
        $query_user = "SELECT * FROM userInfo WHERE id = '$journal_userid'";
        $result_user = mysql_query($query_user,$conn) or die(mysql_error());
        $user_info = mysql_fetch_assoc($result_user);
        $user_name = $user_info['user_fname'] . " " . $user_info['user_lname'] ;
?>
        <div class="row">
            <div class="col-md-12" style="weight:300px">
                <h3><?php echo $journal_title; ?></h3>
                <p><?php echo $journal_timestamp; ?></p>

                <p class="myPara"><?php echo $journal_content; ?></p>
                
                <a class="btn btn-primary" onclick="clickAction('action_form', '<?php echo $journal_id; ?>', 'view');">View <span class="glyphicon glyphicon-chevron-right"></a>
                <a class="btn btn-warning" onclick="updateaction('edit_form', '<?php echo $journal_id; ?>', 'edit');">Update <span class="glyphicon glyphicon-chevron-right"></span></a>                
                <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $journal_id; ?>&direction=myjournal">Delete <span class="glyphicon glyphicon-chevron-right"></span></a>
                

            </div>
        </div>
        <hr>
<?php
      }
    }
?>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>


<script type="text/javascript">
    $(function() {
        var limit = 1500;
        for (var i = 0; i < $(".myPara").length; i++)
        {
            var chars = $(".myPara").eq(i).text(); 
            if (chars.length > limit) {
                var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
                var dots = $("<span class='dots'>... </span>");

                $(".myPara").eq(i).empty()
                    .append(visiblePart)
                    .append(dots);
            }
        }
    });
</script>

