<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>

<div class="container">

<hr>

<h2>My Trip Plans</h2>

<hr>
<?php
  
    $user_id = $_SESSION["id"];
    $query = "SELECT * FROM tripPlan WHERE trip_userid = '$user_id'";
  
    $result = mysql_query($query,$conn) or die(mysql_error());  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $trip_id = $line['id'];
        $trip_title = $line['trip_title'];
        $trip_startaddress  = $line['trip_startaddress'];
        $trip_endaddress  = $line['trip_endaddress'];
        $trip_detailid  = $line['trip_detailid'];

?>
        <div class="row">
            <div class="col-md-12" style="weight:300px">
                <h3><?php echo $trip_title; ?></h3>
                <p><?php echo $trip_startaddress . " -> ".$trip_endaddress; ?></p>
                
            </div>
        </div>
        <hr>
<?php
      }
    
?>
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>