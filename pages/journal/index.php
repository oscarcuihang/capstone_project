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
  
 
<div class="container" style="margin: 0px;padding:0px;">

    <!-- Main component for a primary marketing message or call to action -->

    <header class="main-title">
      <h1>Welcom to Journal Sharing! <strong>By Road Trip Planner</strong></h1>
      <p>Try to swipe or drag to flip the pages, click to open items! </p>
      <p><strong>Get Amazing Experience! </strong></p>
    </header> 
    <div id="flip" class="Jcontainer">
    
      <div class="f-page f-cover">
        <div class="cover-elements">
          <div class="logo">
            Travel
          </div>
          <div class="f-cover-story"><span>Interesting Story and Trip Journal</span>Customized by Users ALL OVER THE WORLD</div>
        </div>
        <div class="f-cover-flip">&lt; Flip</div>
      </div>
<?php
  $query = "SELECT * FROM travelJournal WHERE journal_status = 1 ORDER BY journal_timestamp DESC";
  $result= mysql_query($query,$conn) or die(mysql_error());
  $total_num = mysql_num_rows($result);
  $com_num=$total_num/14;
  $rest_num=$total_num%14;
  if($rest_num>0){
	  $com_num-=1;
  }
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
          <h3><?php printf("%s", $record["journal_title"]); ?><span>Published  <?php printf("%s",$record["journal_timestamp"]);?></span></h3>
          <p><?php printf("%s", $record["journal_content"]); ?></p>
		  <hr>
		  <h3>Tag:</h3> 
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		</div>		  
		  
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
		//print_r($record2);
?>
	<p><b><?php echo $record2["user_fname"];?> <?php $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"];?></p>
	<p color="gray"><?php echo $record2["comment_timestamp"];?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		</div>	
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p color="gray"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>	
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p color="gray"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color:#BEBEBE;";?>'"></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>	
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p color="gray"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
         <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>	
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p color="gray"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
         <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
        <div class="box w-70 h-50 box-img-left"><!--image on the left side, need to set margin-left = 0 for <p>-->
          <div class="img-cont img-4"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>	
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button> 
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" :""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;'"></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-50 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-50 title-top box-img-left"><!--need reset margin!!(picture on left side)-->
          <div class="img-cont img-6"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-60 box-img-left title-top">
          <div class="img-cont img-7"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-40 h-40 box-img-left box-b-r title-top">
          <div class="img-cont img-8"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-40 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>   

		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-30 h-40 title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php	
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
         <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
        <!--The function bar--when greater than 5, should still print first 5 -->       
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
         <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>          
        </div>
        <div class="box w-30 h-50 box-b-r title-top">
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
<?php 
    }
  }
?>
        </div>
        <div class="box w-70 h-50 title-top box-img-left">
          <div class="img-cont img-6"></div>
          <?php $record= mysql_fetch_assoc($result);?>
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <p style="margin-left:0px;"><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p style="margin-left:0px;"><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p style="margin-left:0px;"><?php echo $record2["comment_text"]?></p>
	<p style="margin-left:0px;color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
         <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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
          <h3><?php printf("%s", $record["journal_title"]) ?><span>Published<?php printf("%s",$record["journal_timestamp"])?></span></h3>
          <p><?php printf("%s", $record["journal_content"]) ?></p>
		  
		  <hr>
		  <h3>Tag:</h3>  
		  <div>
				<img src = "../../style/image/tag.png" style="width:20px;" ><a><?php echo $record["journal_tag1"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag2"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag3"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag4"];?></a>
				<img src = "../../style/image/tag.png" style="width:20px;margin-left:10px;" ><a><?php echo $record["journal_tag5"];?></a>
		  </div>
		  <hr>
		  <h3 class = "comment-insert" data-id = "<?= $record["id"]; ?>">Comment:</h3>
<?php 
	$query2 ="SELECT U.user_fname, U.user_lname, C.comment_text, C.comment_timestamp FROM travelJournalComment C, userInfo U WHERE U.id = C.comment_userid AND C.comment_traveljournalid = ".$record["id"];
	//echo $query2;
	$result2=mysql_query($query2, $conn) or die(mysql_error());
	$total_num2 = mysql_num_rows($result2);
	for($j=0;$j<$total_num2;$j++){
		$record2= mysql_fetch_assoc($result2);
?>
	<p><b><?php echo $record2["user_fname"]?> <?php echo $record2["user_lname"]?>:</b></p> 
	<p><?php echo $record2["comment_text"]?></p>
	<p style="color:gray;"><?php echo $record2["comment_timestamp"]?></p>
	<hr>
<?php		
	}
?>
	<h3>Write a comment: </h3>
	<div class = "comment-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
	<button type="button" class="btn btn-default btn-lg submit-comment btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Comment</button>
<?php
  if (isset($_SESSION["id"])){
    if( $_SESSION["id"]==$record["journal_userid"]){
?>
          <a class="btn btn-warning" onclick="clickAction('action_form', '<?php echo $record["id"]; ?>', 'edit');">Edit</a>
          <a class="btn btn-danger" href="/capstone_project/pages/journal/deletejournal.php?action=delete&id=<?php echo $record["id"]; ?>">Delete</a>
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

    </div>
  

</div> <!-- /container -->


<?php include '../templates/footer.html'; ?>

<script type="text/javascript">
      $(".reply-textarea").unbind("click");
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
    
	
	$(document).ready(function(){
		$("body").on("click", ".submit-comment", function(){
			var content = $(this).prev();
			var html = content.html();
			if(html.length == 0){
				content.css("border-color", "#a94442");
			} else {
				var jid = content.attr("data-id");
				$.ajax({
					url: "ajax_handler.php",
					type: "POST",
					data: {jid:jid, context:html, operation:"comment"},
					async: false,
					success: function(data){
						var receive = JSON.parse(data);
						
						if(receive.status == "success"){
							var kk = "<p><b><?php echo $_SESSION["fname"]; ?> <?php echo $_SESSION["lname"]?>:</b></p>" +
								"<p>" + html + "</p>" +
								"<p style='color:gray;'>" + receive.time + "</p>" +
								"<hr/>"
							$("h3[data-id='" + jid + "']").after(kk);
							$("div.comment-textarea[data-id='" + jid + "']").html("")
						} else console.log(receive)
					}
				})
			}
		}).on("click", ".comment-textarea", function(){
			$(this).css("border-color", "#ccc");
		})
	})
</script>
