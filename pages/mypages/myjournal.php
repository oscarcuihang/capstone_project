<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>

<div class="container">
<hr>
<?php
   
  $user_id = $_SESSION["id"];
  $query = "SELECT * FROM travelJournal WHERE journal_userid = '$user_id' AND journal_status = 1";
  
  $result = mysql_query($query,$conn) or die(mysql_error());
  
  //$total_num = mysql_num_row($result);
  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $journal_title = $line['journal_title'];
        $journal_timestamp = $line['journal_timestamp'];
        $journal_userid  = $line['journal_userid'];
        $journal_content  = $line['journal_content'];

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
                <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
                <a class="btn btn-warning" href="">Update <span class="glyphicon glyphicon-chevron-right"></span></a>
                <a class="btn btn-danger" href="">Delet <span class="glyphicon glyphicon-chevron-right"></span></a>

            </div>
        </div>
        <hr>
<?php
      }
?>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>

<script type="text/javascript">
    $(function() {
        var limit = 1500;
        var chars = $(".myPara").text(); 
        if (chars.length > limit) {
            var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
            var dots = $("<span class='dots'>... </span>");

            $(".myPara").empty()
                .append(visiblePart)
                .append(dots);
        }
    });
</script>