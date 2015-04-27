<!--
	The index page is the same page as newest page,
	shows the questions order by timestamp from newest to the oldest
-->
<?php include '../templates/header.html'; ?>


<!--for paging-->

<link rel="stylesheet" href="../../style/css/slimtable.css">
<link rel="stylesheet" href="../../style/css/site.css">

<script src="../../style/RichTextEditor/ckeditor.js"></script>

<!--for questions and answers-->
<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/global.1e5f56f0.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/qa/css/qa_all.5c45d211.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/responsive.2e038079.css" />



<?php 
	if(isset($_POST["message"])){
		echo "alert('". $_POST["message"]. "');";
	}
?>

<script>
	function SubmitContents() {
		// Get the editor instance that you want to interact with.
		var editor = CKEDITOR.instances.editor;

		// Get editor contents
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
		//alert( editor.getData() );
		console.log(editor.getData());
		document.getElementsByClassName("question")[0].submit();
	}

</script>
<script>
function questionDetail(form, Qid)
{
  document.forms[form].elements['Qid'].value = Qid;


  document.getElementById(form).submit();
}
</script>
<?php include '../templates/navbar.html'; ?>
<form action="question.php" id="action_form" method="POST">
	<input type="hidden" name="Qid">
</form>


<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9 main">
                <p class="main-title hidden-xs">
<?php
	if(isset($_SESSION["id"])){
?>                   
				   What's your question?
                    <a id="goAsk" class="askquestion btn btn-primary">I have question!</a>
<?php
	}
	else{
?>	
					Want to ask a question? 
					<a class="sign-in-btn-nav cursor-pointer btn btn-danger">Sign In</a>
<?php
	}
?>
                </p>

                <ul class="nav nav-tabs nav-tabs-zen mb10">
                    <li class="active"><a href="index.php">Newest</a></li>
                    <li><a href="hottest_q.php">Hottest</a></li>
                    <li><a href="unanswered_q.php">Unanswered</a></li>
                </ul>

				<div class="stream-list question-stream">
					<table id="exampletable">
					<thead><tr><th></th></tr></thead>
<?php
$query = "SELECT * FROM question ORDER BY question_timestamp DESC;";
$result= mysql_query($query,$conn) or die(mysql_error());
$total_num = mysql_num_rows($result);

for($i=0; $i<$total_num;$i++){
	$record=mysql_fetch_assoc($result);
?>
					<tr><td>
					<section class="stream-list__item">
							<div class="qa-rank">
							  <div class="votes plus hidden-xs">
								<?php echo $record["question_rate_avg"]."/5"; ?><small>Rate</small>
							  </div>
							  <div class="answers answered solved">
<?php
	$query2="SELECT * FROM answer WHERE answer_questionid=".$record["id"];
	$result2= mysql_query($query2,$conn) or die(mysql_error());
	$answer_num = mysql_num_rows($result2);
?>                
									<?php echo $answer_num;?><small>Reply</small>
							  </div>
							  <div class="views hidden-xs">
									<?php echo $record["question_rate_num"];?><small>Votes</small>
							  </div>
							</div>
            
							<div class="summary">
							  <ul class="author list-inline">
								  <li>
<?php
	if($answer_num > 0){
		$query3_help = "SELECT answer_userid, answer_timestamp FROM answer WHERE answer_questionid = ".$record["id"]." ORDER BY answer_timestamp DESC LIMIT 1";
		$result3_help = mysql_query($query3_help,$conn) or die (mysql_error());
		$lastPost_help = mysql_fetch_assoc($result3_help);
		//print_r($lastPost_help);
		
		$query3="SELECT user_fname, user_lname FROM userInfo WHERE id = ".$lastPost_help["answer_userid"];
		$result3=mysql_query($query3,$conn) or die(mysql_error());
		$lastPost=mysql_fetch_assoc($result3);
		//print_r($lastPost);
?>
								   <a><?php echo "Latest Reply: ".$lastPost["user_fname"]." ".$lastPost["user_lname"];?></a>
								   <span class="split"></span>
								   <a><?php echo $lastPost_help["answer_timestamp"];?></a>
								   </li>
							  </ul>
<?php
	}
	else{
?>
								   <a><?php echo "Try to be the first answer the question!:)";?></a>
								   </li>
							  </ul>
<?php
	}
?>
							  
							   <p1 class="title"><a class = "myquestion" onclick="questionDetail('action_form','<?php echo $record["id"]; ?>');"><?php echo $record["question_text"]?></a></p1>
							  
							</div>
					</section></td></tr>
<?php	
}
?>   
				</table>

				</div><!-- /.stream-list -->
		
            </div><!-- /.main -->
           
         </div><!-- /.side -->
     </div>
</div>

<script src="//static.segmentfault.com/build/3rd/assets.ce4fe392.js"></script>

<script type="text/javascript">

    //charactors limit for question
    $(function() {
        var limit = 200;
        for (var j = 0; j < $(".myquestion").length; j++)
        { 
            var chars = $(".myquestion").eq(j).text(); 
            if (chars.length > limit) {
                var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
                var dots = $("<span class='dots'>... </span>");

                $(".myquestion").eq(j).empty()
                    .append(visiblePart)
                    .append(dots);
            }
        }
    });
</script>

<?php include '../templates/footer.html'; ?>
<script type="text/javascript" src="../../style/js/slimtable.min.js"></script>

<script type="text/javascript">
$("document").ready(function(){
	$("#exampletable").slimtable();
});
</script>

<script>
$(document).ready(function(){
	$("#goAsk").click(function(){
		console.log("lalalal");
		var content = "<div class = 'cover-window-shell'></div>"+
					  "<div class = 'create-question-window' style = 'position:absolute;left:50%;width:500px;top:35%;z-index:10000;'>"+
						"<div class = 'panel panel-success' style = 'position:relative;right:50%;'>"+
							"<div class = 'panel-heading'><h2 class = 'panel-title'>Ask Question:<span class = 'glyphicon glyphicon-remove text-danger closeWindow' style = 'cursor:pointer; float:right'></span></h2></div>"+
								"<div class = 'panel-body'>"+
									"<form action = 'getSubmitQuestion.php' method = 'POST' class = 'question'>"+
										"<textarea rows='4' cols='65' name='editor' id='editor'></textarea>"+
										"<button class='btn btn-success questionSubmit' onclick=\" SubmitContents()\">Submit</button>"+							
									"</form>"+
								"</div>"+
						"</div>"+
					"</div>";
					  
		$("body").append(content);
	});
});

$("document").ready(function(){
	$("body").on("click", ".closeWindow", function(){
		$("div.cover-window-shell").remove();
		$("div.create-question-window").fadeOut(function(){
			$("div.create-question-window").remove();
		})
	});
});

</script>