<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>

<div class="container">

<?php
    $user_id = $_SESSION["id"];
    $query = "SELECT * FROM userInfo WHERE id = '$user_id'";
  
    $result = mysql_query($query,$conn) or die(mysql_error());  
    while ($line = mysql_fetch_assoc($result)) 
    {
        $user_fname = $line['user_fname'];
        $user_lname = $line['user_lname'];
        $user_phone = $line['user_phone'];
        $user_email = $line['user_email'];
        //echo $user_fname.$user_lname.$user_phone;
    }
?>

<hr>
<?php

if(isset($_POST['submit']))
{
    $input_fname = $_POST['fname'];
    $input_lname = $_POST['lname'];
    $input_phone = $_POST['phone'];
    $input_pass = $_POST['pwd'];
    $input_comfirm_pass = $_POST['cpwd'];

    if ($input_fname == "") {
        $new_fname = $user_fname;
    }
    else {
        $new_fname = $input_fname;
        $_SESSION["fname"] = $new_fname;
    }
    if ($input_lname == "") {
        $new_lname = $user_lname;
    }
    else {
        $new_lname = $input_lname;
        $_SESSION["lname"] = $new_lname;
    }
    if ($input_phone == "") {
        $new_phone = $user_phone;
    }
    else {
        if (!preg_match('/^\d{10}$/', $input_phone)) {  
?>
        <h2>User Infomation Change</h2>
            <hr>
            <p2>Error: Phone number must be 0000000000</p2>
            <br>
              <form role="form" method="POST" action="" name = "">
                <div class="form-group">
                  <label for="">Email:</label>
                  <input type="" class="form-control" id="email" name ="email" value="<?php echo $user_email; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="">First Name:</label>
                  <input type="" class="form-control" id="fname" name = "fname" value="<?php echo $new_fname; ?>">
                </div>
                <div class="form-group">
                  <label for="">Last Name:</label>
                  <input type="" class="form-control" id="lname" name = "lname" value="<?php echo $new_lname; ?>">
                </div>
                <div class="form-group">
                  <label for="">Phone:</label>
                  <input type="" class="form-control" id="phone" name = "phone" value="<?php echo $user_phone; ?>">
                </div>
                <div class="form-group">
                  <label for="pwd">New Password:</label>
                  <input type="password" class="form-control" id="pwd" name = "pwd" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="pwd">Comfirm Password:</label>
                  <input type="password" class="form-control" id="cpwd" name = "cpwd" placeholder="Re-enter New Password">
                </div>
                <button type="submit" class="btn btn-default" name="submit">Submit</button>
              </form>
            <?php
        }
        else {
           $new_phone = $input_phone;
        }
    }
    if (($input_pass != "") && ($input_comfirm_pass != "") && ($input_pass != $input_comfirm_pass) ) {
?>
    <h2>User Infomation Change</h2>
            <hr>
            <p2>Error: Password and Comfirm error.</p2>
            <br>
              <form role="form" method="POST" action="" name = "">
                <div class="form-group">
                  <label for="">Email:</label>
                  <input type="" class="form-control" id="email" name ="email" value="<?php echo $user_email; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="">First Name:</label>
                  <input type="" class="form-control" id="fname" name = "fname" value="<?php echo $new_fname; ?>">
                </div>
                <div class="form-group">
                  <label for="">Last Name:</label>
                  <input type="" class="form-control" id="lname" name = "lname" value="<?php echo $new_lname; ?>">
                </div>
                <div class="form-group">
                  <label for="">Phone:</label>
                  <input type="" class="form-control" id="phone" name = "phone" value="<?php echo $user_phone; ?>">
                </div>
                <div class="form-group">
                  <label for="pwd">New Password:</label>
                  <input type="password" class="form-control" id="pwd" name = "pwd" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="pwd">Comfirm Password:</label>
                  <input type="password" class="form-control" id="cpwd" name = "cpwd" placeholder="Re-enter New Password">
                </div>
                <button type="submit" class="btn btn-default" name="submit">Submit</button>
              </form>
<?php
    }
    else if (($input_pass == "") && ($input_comfirm_pass == "")) {
        $query = "UPDATE userInfo SET user_fname = '$new_fname', user_lname = '$new_lname', user_phone = '$new_phone' WHERE id='$user_id'";
    }
    else {
        $new_pass = $_POST['pwd'];
        $new_salt = md5(time());
        $new_hashpass = md5($new_salt. $new_pass);
        $query = "UPDATE userInfo SET user_fname = '$new_fname', user_lname = '$new_lname', user_phone = '$new_phone', user_salt = '$new_salt', user_hashpass = '$new_hashpass' WHERE id='$user_id' ";
    }
      $result = mysql_query($query,$conn) or die(mysql_error());
      $ip = $_SERVER["REMOTE_ADDR"];
      mysql_query("INSERT INTO userLog VALUES(DEFAULT, $user_id, '$ip', DEFAULT, 'update userinfo')");
      ?>
      <a class="btn btn-large btn-success" type="button" href="../home.php">Update Success</a>
      <?php
}

else {
?>

<h2>User Infomation Change</h2>
  <form role="form" method="POST" action="" name = "">
    <div class="form-group">
      <label for="">Email:</label>
      <input type="" class="form-control" id="email" name ="email" value="<?php echo $user_email; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="">First Name:</label>
      <input type="" class="form-control" id="fname" name = "fname" value="<?php echo $user_fname; ?>">
    </div>
    <div class="form-group">
      <label for="">Last Name:</label>
      <input type="" class="form-control" id="lname" name = "lname" value="<?php echo $user_lname; ?>">
    </div>
    <div class="form-group">
      <label for="">Phone:</label>
      <input type="" class="form-control" id="phone" name = "phone" value="<?php echo $user_phone; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">New Password:</label>
      <input type="password" class="form-control" id="pwd" name = "pwd" placeholder="Enter New Password">
    </div>
    <div class="form-group">
      <label for="pwd">Comfirm Password:</label>
      <input type="password" class="form-control" id="cpwd" name = "cpwd" placeholder="Re-enter New Password">
    </div>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </form>
<?php
}
?>
</div> <!-- /container -->


<?php include '../templates/footer.html'; ?>
