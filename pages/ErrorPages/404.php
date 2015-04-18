<?php 
  //include '../../database.php'; 
	if(!session_start())
		die("Error: fail to start session");
	$conn = mysql_connect("localhost", "root", "");
	mysql_select_db("rtp", $conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Road Trip Planner</title>

    <!-- Bootstrap core CSS -->
    <link href="../style/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../style/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../style/assets/js/ie-emulation-modes-warning.js"></script>

	<!-- Navigation bar css		-->
	<link href = "../style/css/rtp.css" rel = "stylesheet"/>
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
</head>

  <body>
<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/capstone_project">Road Trip Planner</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/capstone_project/pages/home.php">Home</a></li>
            <li><a href="/capstone_project/pages/maps/index.php">Trip Plan</a></li>
            <li><a href="/capstone_project/pages/journal/index.php">Travel Journal</a></li>
            <li><a href="/capstone_project/pages/qa/index.php">Ask</a></li>

            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog fa-1x"></i><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
<?php if(!isset($_SESSION["email"])){ ?>                
				<li class = "register-start-btn cursor-pointer"><a>New User Register</a></li>
                <li class = "sign-in-btn-nav cursor-pointer"><a>Login</a></li>
<?php } else {	?>
                <li><a href="/capstone_project/pages/mypages/mytrip.php">My Trip</a></li>
                <li><a href="/capstone_project/pages/mypages/myjournal.php">My Journal</a></li>
                <li><a href="/capstone_project/pages/mypages/myqa.php">My Questions/As</a></li>
                <li class = "cursor-pointer sign-out-btn-nav"><a>Log Out</a></li>
<?php	}	?>               
                <li class="divider"></li>
                <li class="dropdown-header">I'm a Dropdown!</li>
<?php if(!isset($_SESSION["email"])){ ?>                
<?php } else {  ?>
                <li><a href="#">Setting</a></li>
<?php } ?> 
                <li><a href="/capstone_project/pages/about/aboutus.php">About RTP Team</a></li>
              </ul>
            </li>
          </ul>
		  <p class = "navbar-text navbar-right">Hi, <?= (isset($_SESSION["email"])? $_SESSION["fname"]. " ". $_SESSION["lname"] : "there"); ?></p>
		  </div><!--/.nav-collapse -->
      </div>
    </nav>


    

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
		<img src = "404.gif" width = "250" style = "float:left;"/>
		<div class = "popover right panel panel-danger" style = "display:block;position:relative;float:left;border-color:#ebccd1;">
			<div class = "arrow"></div>
			<h1 class = "popover-title" role = "alert" id = "popover-right" style = "background-color:#f2dede;color:#a94442;font-size:2em;text-algin:center;">404 Error</h1>
			<div class = "popover-content"><p>Sorry, <b style = "color:#31708f;">meow~</b></p><p>Page <b style = "color: #a94442;">does not exist</b>, <b style = "color:#31708f;">meow~</b></p><p>I know I am very cute, <b style = "color:#31708f;">meow~</b></p></div>
		</div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../style/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../style/assets/js/ie10-viewport-bug-workaround.js"></script>
	<!-- Navigation bar javascript	-->
	<script src="../style/js/rtp.js"></script>
  </body>
</html>
