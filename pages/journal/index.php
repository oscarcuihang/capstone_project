<?php include '../templates/header.html'; ?>
  <meta charset="UTF-8" />
        
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../../style/css/journal_main.css" />
    <link rel="stylesheet" type="text/css" href="../../style/css/journal_style.css" />
  <!-- lol, test -->
  
<script type="text/javascript" src="../../style/js/modernizr.custom.08464.js"></script>
<script id="pageTmpl" type="text/x-jquery-tmpl">
      <div class ="${theClass}" style="${theStyle}">
        <div class="front">
          <div class="outer">
            <div class="content" style="${theContentStyleFront}">
              <div class="inner">{{html theContentFront}}</div>
            </div>
          </div>
        </div>
        <div class="back">
          <div class="outer">
            <div class="content" style="${theContentStyleBack}">
              <div class="inner">{{html theContentBack}}</div>
            </div>
          </div>
        </div>
      </div>      
</script>
<script>
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
  
 
<div class="container" style="margin: 0px;height:100%;">

    <!-- Main component for a primary marketing message or call to action -->

    <header class="main-title">
      <h1>Experimental Page Layout <strong>Inspired by Flipboard</strong></h1>
      <p>Swipe or drag to flip the pages, click to open items </p>
      <p><strong>Best viewed in a Webkit browser (Safari, Chrome)</strong></p>
    </header> 
    <div id="flip" class="Jcontainer">
    
      <div class="f-page f-cover">
        <div class="cover-elements">
          <div class="logo">
            Travel 
            <a class="f-ref" href="http://www.flickr.com/photos/nasahqphoto/">Images by NASA HQ Photo</a>
          </div>
          <h1> <span>Inspired by <a href="http://flipboard.com/">Flipboard</a></span></h1>
          <div class="f-cover-story"><span>Cover Story</span>Shuttle Enterprise Flight to New York</div>
        </div>
        <div class="f-cover-flip">&lt; Flip</div>
      </div>
<?php
  $query = "SELECT * FROM travelJournal WHERE journal_status = 1";
  $result= mysql_query($query,$conn) or die(mysql_error());
  $total_num = mysql_num_rows($result);
  $com_num=$total_num/14;
  $rest_num=$total_num%14;

  for($i=0;$i<$com_num;$i++){
    
?>
      
      <div class="f-page">
        <!--The function bar-->
        
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
        
        <div class="box w-25 h-70">
          <div class="img-cont img-1"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-70 box-b-l box-b-r">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-25 h-70">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>

		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
		  <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>

		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>
      
      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
        <div class="box w-70 h-50 box-b-r title-top box-img-left">
          <div class="img-cont img-4"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-50">
          <div class="img-cont img-5"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-50 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-50 title-top box-img-left">
          <div class="img-cont img-6"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>
      
      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
        <div class="box w-30 h-60 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-60 box-img-left title-top">
          <div class="img-cont img-7"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-40 h-40 box-img-left box-b-r title-top">
          <div class="img-cont img-8"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-40 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>        
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-40 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>
<?php 
  }
  if($rest_num>0){
    if($rest_num<=5){
?>
      <div class="f-page">; 
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
<?php
      if($rest_num>=1){
?>
        <div class="box w-25 h-70">
          <div class="img-cont img-1"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num>=2){
?>
        <div class="box w-50 h-70 box-b-l box-b-r">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num>=3){
?>
        <div class="box w-25 h-70">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num>=4){
?>
        <div class="box w-50 h-30 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num==5){
?>  
        <div class="box w-50 h-30 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
?>
      </div>;
<?php
    }     
    if($rest_num>5 && $rest_num<=9){
?>
      <div class="f-page">
        <!--The function bar-->       
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="">Search</a>
        </div>
        
        <div class="box w-25 h-70">
          <div class="img-cont img-1"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-70 box-b-l box-b-r">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-25 h-70">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>      
      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
<?php
      if($rest_num>=6){
?>
        <div class="box w-70 h-50 box-b-r title-top box-img-left">
          <div class="img-cont img-4"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>  
<?php
      }
      if($rest_num>=7){
?>        
        <div class="box w-30 h-50">
          <div class="img-cont img-5"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>        
<?php       
      }
      if($rest_num>=8){
?>
        <div class="box w-30 h-50 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>  
        
<?php
      }
      if($rest_num==9){
?>
        <div class="box w-70 h-50 title-top box-img-left">
          <div class="img-cont img-6"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>      
<?php     
      }
?>
      </div>
<?php     
    }
    if($rest_num>9&&$rest_num<=14){
?>
      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>

        
        <div class="box w-25 h-70">
          <div class="img-cont img-1"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-70 box-b-l box-b-r">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-25 h-70">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-50 h-30 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>
      

      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>
        <div class="box w-70 h-50 box-b-r title-top box-img-left">
          <div class="img-cont img-4"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-50">
          <div class="img-cont img-5"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>          
        </div>
        <div class="box w-30 h-50 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-50 title-top box-img-left">
          <div class="img-cont img-6"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
      </div>
      

      <div class="f-page">
        <div class="f-title">
          <a onclick="clickAction('action_form', '', 'create');">Create</a>
          <h2>Travel Journal</h2>
          <a href="../home.php">Search</a>
        </div>  
<?php
      if($rest_num>=10){
?>
        <div class="box w-30 h-60 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>        
<?php
      }
      if($rest_num>=11){
?>
        <div class="box w-70 h-60 box-img-left title-top">
          <div class="img-cont img-7"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>        
<?php     
      }
      if($rest_num>=12){
?>
        <div class="box w-40 h-40 box-img-left box-b-r title-top">
          <div class="img-cont img-8"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num>=13){
?>
        <div class="box w-30 h-40 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
      if($rest_num==14){
?>
        <div class="box w-30 h-40 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  <hr>
		  <h3>Tag:</h3>  
		  <p><a class="tag icon-tag"><?php$record["journal_tag1"]?></a> <a class="tag icon-tag"><?php$record["journal_tag2"]?></a> <a class="tag icon-tag"><?php$record["journal_tag3"]?></a> <a class="tag icon-tag"><?php$record["journal_tag4"]?></a> <a class="tag icon-tag"><?php$record["journal_tag5"]?></a></p>
		  <hr>
		  <h3>Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM traveljournalcomment C, userinfo U WHERE U.id = C.comment_userid AND comment_traveljournalid = ".$record["id"];
	echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($i=0;$i<$total_num2;$i++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php $record2["user_fname"]?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php $record["comment_text"]?></p>
	<p color="gray"><?php $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a onclick="clickAction('action_form', '<?php $record["id"] ?>', 'edit');">Edit</a>
          <a href="">Delete</a>
<?php 
    }
  }
?>
        </div>
<?php
      }
?>
      </div>      
<?php   
    }
  }
?>
      <div class="f-page f-cover-back">
        <div id="codrops-ad-wrapper">
          
          
        </div>
      </div>
<!--
      <div class="f-page">
        <div class="f-title">
          <a href="http://tympanus.net/Tutorials/CSS3FluidParallaxSlideshow/">Previous Demo</a>
          <h2>Incredible Spacenews</h2>
          <a href="http://tympanus.net/codrops/2012/05/07/experimental-page-layout-inspired-by-flipboard/">Back to the Codrops Article</a>
        </div>
        <div class="box w-25 h-70">
          <div class="img-cont img-1"></div>
          <h3>Japanese Prime Minister Noda with NASA Administrator Bolden <span>Published May 3, 2012</span></h3>
          <p>Thundercats adipisicing marfa wes anderson farm-to-table, +1 vero yr ennui messenger bag occaecat williamsburg cosby sweater anim tattooed. Farm-to-table umami direct trade viral cosby sweater Austin. Magna tattooed irure, DIY do placeat helvetica sapiente laboris. Put a bird on it jean shorts wolf enim, viral authentic hoodie bespoke master cleanse proident. Ea pour-over swag wayfarers, Austin thundercats letterpress mollit 8-bit excepteur forage elit. Cupidatat minim dolore laborum whatever. Farm-to-table nihil tattooed, letterpress helvetica vegan semiotics pariatur pop-up. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-50 h-70 box-b-l box-b-r">
          <div class="img-cont img-2"></div>
          <h3>Shuttle Enterprise Flight to New York <span>Published May 3, 2012</span></h3>
          <p>Art party cillum et cosby sweater aliquip wolf photo booth thundercats dreamcatcher pickled banksy. Sustainable ex kogi, mumblecore mlkshk occupy mcsweeney's freegan laboris nisi stumptown street art labore food truck. Stumptown pariatur 8-bit, iphone quis ethical pitchfork portland vegan. Irony esse gluten-free, id fanny pack umami commodo. Godard bushwick narwhal, quinoa biodiesel veniam jean shorts minim portland aesthetic excepteur sapiente. Fanny pack aesthetic post-ironic chambray esse. Bespoke nesciunt fugiat aute pariatur craft beer, laborum ex. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-25 h-70">
          <div class="img-cont img-3"></div>
          <h3>Expedition 30 Landing <span>Published May 3, 2012</span></h3>
          <p>Single-origin coffee ex fingerstache keytar labore adipisicing, synth umami wolf jean shorts. Next level high life selvage cillum. Cupidatat before they sold out ex, shoreditch accusamus kogi consectetur delectus gluten-free. Keffiyeh seitan ex, trust fund fugiat gluten-free sunt put a bird on it pinterest. Vegan aesthetic vero, ethnic bespoke before they sold out williamsburg ennui 8-bit proident synth marfa mcsweeney's trust fund photo booth. Sed velit dolor, cardigan shoreditch typewriter ea. Dolore nihil occaecat high life post-ironic, ennui chillwave tattooed craft beer umami. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-50 h-30 box-b-r title-top">
          <h3>NASA Begins Second Round of J-2X Testing <span>Published May 3, 2012</span></h3>
          <p>Duis williamsburg irony proident vinyl. Irony stumptown magna nulla, nisi next level gentrify twee nostrud veniam retro tumblr forage. Gastropub wolf vegan hella, messenger bag next level keytar aliqua synth put a bird on it dolor exercitation iphone. Selvage tempor mollit kale chips carles. Ethnic irure master cleanse, carles non godard flexitarian. You probably haven't heard of them reprehenderit cillum ea post-ironic, delectus ut mlkshk chillwave sriracha single-origin coffee sunt. Dolore fixie do american apparel, kogi velit salvia VHS forage bespoke pariatur. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-50 h-30 title-top">
          <h3>NASA's Webb Flight Backplane Completed <span>Published May 3, 2012</span></h3>
          <p>Qui trust fund artisan, ullamco jean shorts craft beer ad forage. Kale chips scenester stumptown fugiat, magna nostrud aliqua. Chambray nihil gastropub 3 wolf moon food truck, cillum leggings. Mumblecore do iphone umami pork belly. Enim banh mi ut consequat, mixtape bushwick portland leggings sustainable officia nulla. Tattooed cillum ex, cray letterpress locavore marfa synth organic etsy minim williamsburg exercitation twee. Single-origin coffee cillum nulla polaroid ethical, fugiat incididunt. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
      </div>
      
      <div class="f-page">
        <div class="f-title">
          <a href="http://tympanus.net/Tutorials/CSS3FluidParallaxSlideshow/">Previous Demo</a>
          <h2>Incredible Spacenews</h2>
          <a href="http://tympanus.net/codrops/2012/05/07/experimental-page-layout-inspired-by-flipboard/">Back to the Codrops Article</a>
        </div>
        <div class="box w-70 h-50 box-b-r title-top box-img-left">
          <div class="img-cont img-4"></div>
          <h3>Expedition 30 Astronaut back on Earth <span>Published May 3, 2012</span></h3>
          <p>Consectetur locavore brooklyn dreamcatcher, aesthetic anim dolor put a bird on it semiotics godard pork belly forage. VHS veniam aliqua thundercats dolore keffiyeh, direct trade authentic PBR eiusmod. Dolore veniam fanny pack, proident iphone mixtape irure sed. Lo-fi leggings stumptown cardigan etsy, pitchfork echo park terry richardson next level labore proident. Messenger bag cillum squid scenester, before they sold out dolor nostrud ad bicycle rights. Ut ex bicycle rights, wes anderson thundercats duis synth gluten-free hoodie twee. Four loko artisan viral, letterpress dreamcatcher twee yr cray vegan enim photo booth 3 wolf moon. Id veniam mustache squid, cliche terry richardson organic quis dreamcatcher skateboard. Chambray before they sold out yr, iphone street art ut locavore squid placeat you probably haven't heard of them small batch. Cred proident occaecat wolf, fixie letterpress est biodiesel kogi gentrify. Artisan +1 culpa, bicycle rights trust fund direct trade consectetur gentrify synth pariatur twee delectus consequat wayfarers deserunt. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-30 h-50">
          <div class="img-cont img-5"></div>
          <h3>Space Shuttle Discovery Ready For Demate <span>Published May 3, 2012</span></h3>
          <p>Ethical 3 wolf moon sartorial nihil consequat twee, officia banh mi scenester carles vero thundercats. Keffiyeh mlkshk cliche craft beer, sartorial bespoke flexitarian helvetica consequat. Echo park organic nihil nostrud brooklyn scenester, delectus bushwick est narwhal sriracha. Chambray terry richardson direct trade, tumblr keffiyeh semiotics minim post-ironic. Sapiente nostrud banksy in nisi, lo-fi kale chips polaroid retro. 8-bit you probably haven't heard of them bespoke cred portland trust fund yr dolore sed. Art party quis street art american apparel lomo. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-30 h-50 box-b-r title-top">
          <h3>Black Hole Caught Red-Handed in a Stellar Homicide <span>Published May 3, 2012</span></h3>
          <p>Salvia +1 pork belly cosby sweater, lo-fi wolf tattooed VHS. Before they sold out dolore cray flexitarian et VHS +1 trust fund. Typewriter squid fap aute wolf 3 wolf moon, vice cillum street art. Austin organic gluten-free, ex cosby sweater odio squid. Iphone high life sriracha, +1 cupidatat assumenda shoreditch exercitation wayfarers. Aesthetic selvage nesciunt ennui. Nisi anim single-origin coffee, ullamco bushwick delectus fanny pack marfa tumblr cliche. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-70 h-50 title-top box-img-left">
          <div class="img-cont img-6"></div>
          <h3>Space Station Trio Lands Safely In Kazakhstan <span>Published May 3, 2012</span></h3>
          <p>Consectetur locavore brooklyn dreamcatcher, aesthetic anim dolor put a bird on it semiotics godard pork belly forage. VHS veniam aliqua thundercats dolore keffiyeh, direct trade authentic PBR eiusmod. Dolore veniam fanny pack, proident iphone mixtape irure sed. Lo-fi leggings stumptown cardigan etsy, pitchfork echo park terry richardson next level labore proident. Messenger bag cillum squid scenester, before they sold out dolor nostrud ad bicycle rights. Ut ex bicycle rights, wes anderson thundercats duis synth gluten-free hoodie twee. Four loko artisan viral, letterpress dreamcatcher twee yr cray vegan enim photo booth 3 wolf moon. Semiotics mlkshk anim sustainable butcher tempor. Odio single-origin coffee raw denim consequat mcsweeney's retro bespoke. Vero voluptate minim, letterpress accusamus twee farm-to-table pariatur cray.  Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
      </div>
      
      <div class="f-page">
        <div class="f-title">
          <a href="http://tympanus.net/Tutorials/CSS3FluidParallaxSlideshow/">Previous Demo</a>
          <h2>Incredible Spacenews</h2>
          <a href="http://tympanus.net/codrops/2012/05/07/experimental-page-layout-inspired-by-flipboard/">Back to the Codrops Article</a>
        </div>
        <div class="box w-30 h-60 box-b-r title-top">
          <h3>NASA Statement on John Glenn Selection for Medal of Freedom <span>Published May 3, 2012</span></h3>
          <p>Accusamus yr gluten-free id. Ennui occupy scenester polaroid, incididunt VHS minim sustainable skateboard aute cillum retro. Odd future gluten-free excepteur retro, biodiesel jean shorts minim nisi. Mlkshk hoodie next level pop-up 8-bit. Butcher scenester aliqua, tumblr nisi mcsweeney's PBR pork belly bespoke keytar cillum laboris swag pitchfork. Fugiat et eu american apparel truffaut brooklyn minim. Incididunt quis pickled, chillwave +1 odio dolore freegan est pop-up before they sold out twee cliche echo park ut. In high life swag tofu ethnic 8-bit, seitan pinterest DIY lomo post-ironic. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-70 h-60 box-img-left title-top">
          <div class="img-cont img-7"></div>
          <h3>Legendary Astronaut Shannon Lucid Retires From NASA <span>Published May 3, 2012</span></h3>
          <p>Wes anderson trust fund organic pour-over, aute authentic high life fanny pack enim. Ethnic mumblecore salvia, letterpress minim velit fugiat sartorial beard mixtape vice ad. Farm-to-table aute cred cosby sweater sed, dolore pork belly pinterest keytar 3 wolf moon mustache. Vice thundercats pour-over, lo-fi echo park accusamus ullamco adipisicing selvage street art you probably haven't heard of them etsy. Readymade bushwick mumblecore whatever aesthetic, do nesciunt direct trade proident culpa. Vegan you probably haven't heard of them hoodie adipisicing qui, voluptate Austin stumptown photo booth sed. Mixtape excepteur locavore eu, labore sustainable nisi tofu narwhal fanny pack VHS nulla aliqua. Beard velit street art aute sartorial. Sapiente pitchfork polaroid, fugiat ea DIY williamsburg forage officia sint occaecat. Gentrify exercitation cray marfa, blog biodiesel readymade aliquip beard placeat raw denim stumptown. Austin photo booth accusamus et semiotics. Messenger bag ethical direct trade ullamco jean shorts. Selvage authentic seitan direct trade delectus butcher, mollit occupy cillum photo booth banksy proident gentrify commodo vice. Retro qui cray whatever. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-40 h-40 box-img-left box-b-r title-top">
          <div class="img-cont img-8"></div>
          <h3>Coverage Set For Next Soyuz Space Station Crew Rotation <span>Published May 3, 2012</span></h3>
          <p>Mcsweeney's pitchfork chambray tattooed four loko, commodo nesciunt lo-fi dreamcatcher mixtape eu occaecat vinyl cupidatat. Delectus selvage gentrify, commodo fingerstache jean shorts sriracha you probably haven't heard of them aesthetic. Bespoke nulla eiusmod deserunt, qui 8-bit +1 high life proident dolor small batch accusamus laborum ethical. In high life swag tofu ethnic 8-bit, seitan pinterest DIY lomo post-ironic. American apparel fingerstache portland, lomo thundercats small batch velit quis letterpress. Dolore iphone accusamus pitchfork authentic. Qui narwhal voluptate, street art keffiyeh non laborum. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-30 h-40 box-b-r title-top">
          <h3>Shuttle Enterprise to Fly Over New York City Metro Area April 23 <span>Published May 3, 2012</span></h3>
          <p>Authentic put a bird on it mustache magna. Terry richardson dolor vero, magna odio synth letterpress umami brunch vice craft beer Austin. Velit mcsweeney's consequat wes anderson. Yr eu minim id. Pinterest odio keytar, irony bushwick pickled delectus placeat 3 wolf moon trust fund. Small batch mixtape carles chambray aute pop-up reprehenderit, portland magna skateboard vero dreamcatcher. Id artisan twee tempor excepteur pitchfork. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
        <div class="box w-30 h-40 title-top">
          <h3>Top Scientist and Technologist Discuss What's Next for NASA <span>Published May 3, 2012</span></h3>
          <p>Nisi anim raw denim, occupy seitan magna selvage pork belly leggings gluten-free. Street art consequat aliquip, echo park helvetica enim pariatur fanny pack aesthetic et laboris pickled jean shorts ethical. Austin pop-up next level esse, retro quinoa locavore mollit etsy elit nesciunt quis salvia beard. Quis magna consequat selvage, ullamco commodo exercitation. VHS polaroid fugiat quis gastropub, cosby sweater aliquip aesthetic velit jean shorts swag. Put a bird on it etsy pork belly synth nisi, pitchfork wes anderson semiotics cliche ea. Cliche officia cosby sweater ullamco, quis stumptown est blog vinyl pork belly. Helvetica ex godard selvage, sriracha echo park ut portland forage cardigan. Retro readymade williamsburg cliche laboris pinterest. Mollit aliqua direct trade, tumblr vegan lo-fi shoreditch semiotics sed 8-bit. Incididunt keffiyeh PBR cray, assumenda yr butcher nisi. Mustache brunch kogi, farm-to-table small batch odio fugiat consequat fap esse quinoa. Iphone banh mi brunch jean shorts sartorial, letterpress culpa direct trade master cleanse banksy fap whatever quinoa biodiesel. Portland eiusmod minim nihil Austin, sartorial aesthetic occupy tofu sriracha pitchfork seitan.</p>
        </div>
      </div>
      
      <div class="f-page f-cover-back">
        <div id="codrops-ad-wrapper">
          
        </div>
      </div>
-->
    </div>
  

</div> <!-- /container -->



<?php include '../templates/footer.html'; ?>

<script type="text/javascript">
        
      var $Jcontainer   = $( '#flip' ),
        $pages    = $Jcontainer.children().hide();
      
      Modernizr.load({
        test: Modernizr.csstransforms3d && Modernizr.csstransitions,
        yep : ['../../style/js/jquery.tmpl.min.js','../../style/js/jquery.history.js','../../style/js/core.string.js','../../style/js/jquery.touchSwipe-1.2.5.js','../../style/js/jquery.flips.js'],
        nope: '../../style/css/journal_fallback.css',
        callback : function( url, result, key ) {
          
          if( url === '../../style/css/journal_fallback.css' ) {
            $pages.show();
          }
          else if( url === '../../style/js/jquery.flips.js' ) {
            $Jcontainer.flips();
          }
      
        }
      });
        
</script>
