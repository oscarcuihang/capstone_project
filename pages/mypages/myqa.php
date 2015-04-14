<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>

<div class="container">

<hr>


<form method="POST" action="">

  <button class="btn btn-info" type="submit" name = "question"> My Questions <span class="glyphicon glyphicon-chevron-right"></span></button>
  <button class="btn btn-info" type="submit" name = "answer"> Answered <span class="glyphicon glyphicon-chevron-right"></span></button>

</form>

<hr>
<?php
  if(isset($_POST['answer']))
  {
    $user_id = $_SESSION["id"];
    $query = "SELECT * FROM answer WHERE answer_userid = '$user_id' GROUP BY answer_questionid ORDER BY answer_timestamp DESC";
    $result = mysql_query($query,$conn) or die(mysql_error());  

      while ($line = mysql_fetch_assoc($result)) 
      {
        $question_id= $line['answer_questionid'];
        $query_question = "SELECT * FROM question WHERE id = '$question_id'";
        $result_question = mysql_query($query_question,$conn) or die(mysql_error());
        while ($line2 = mysql_fetch_assoc($result_question)){
          $question_id= $line2['id'];
          $question_text = $line2['question_text'];
          $question_timestamp  = $line2['question_timestamp'];
          $query_answers = "SELECT * FROM answer WHERE answer_questionid = '$question_id'";
          $result_answers = mysql_query($query_answers,$conn) or die(mysql_error());
          $answers = mysql_fetch_assoc($result_answers);
          $numberofanswers = mysql_num_rows($result_answers);
?>
          <div class="row">
            <div class="col-md-12" style="weight:300px">
                <h3><?php echo $question_text; ?></h3>
                <p><?php echo $numberofanswers . " answers."; ?></p>
                <p><?php echo "Posted on: " .$question_timestamp; ?></p>
            </div>
          </div>
          <hr>
<?php
        }
      }

  }
  else
  {
    $user_id = $_SESSION["id"];
    $query = "SELECT * FROM question WHERE question_userid = '$user_id' ORDER BY question_timestamp DESC";
  
    $result = mysql_query($query,$conn) or die(mysql_error());  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $question_id= $line['id'];
        $question_text = $line['question_text'];
        $question_timestamp  = $line['question_timestamp'];

        $query_answers = "SELECT * FROM answer WHERE answer_questionid = '$question_id'";
        $result_answers = mysql_query($query_answers,$conn) or die(mysql_error());
        $answers = mysql_fetch_assoc($result_answers);
        $numberofanswers = mysql_num_rows($result_answers);
        //$user_name = $user_info['user_fname'] . " " . $user_info['user_lname'] ;
?>
        <div class="row">
            <div class="col-md-12" style="weight:300px">
                <h3><?php echo $question_text; ?></h3>
                <p><?php echo $numberofanswers . " answers."; ?></p>
                <p><?php echo "Posted on: " .$question_timestamp; ?></p>
            </div>
        </div>
        <hr>
<?php
      }
    }
?>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>