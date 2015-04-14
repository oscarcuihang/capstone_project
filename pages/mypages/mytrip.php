<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>


    

<div class="container">

<?php
  echo $_SESSION["id"];
  $query = "SELECT * FROM travelJournal WHERE journal_status = 1";
  $result = mysql_query($query,$conn) or die(mysql_error());
  //$total_num = mysql_num_row($result);

  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $journal_title = $line['journal_title'];
        $journal_timestamp = $line['journal_timestamp'];
        $journal_userid  = $line['journal_userid'];
        $journal_content  = $line['journal_content'];

        $query_user = "SELECT * FROM userInfo WHERE id = '$journal_userid' AND journal_status = 1";
        $result_user = mysql_query($query_user,$conn) or die(mysql_error());
        $user_info = mysql_fetch_assoc($result_user);
        $user_name = $user_info['user_fname'] . " " . $user_info['user_lname'] ;
?>
        <div class="row">
            <div class="col-md-7">
                <a href="">
                    <img class="img-responsive" src="" alt="" id = "imagestyle">
                </a>
            </div>
            <div class="col-md-5">
                <h3><?php echo $journal_title; ?></h3>
                <h4><?php echo $user_name; ?></h4>
                <p><?php echo $journal_timestamp; ?></p>

                <p class="myPara"><?php echo $journal_content; ?></p>
                <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <hr>
<?php
      }
?>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>
