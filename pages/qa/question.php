<?php include '../templates/header.html'; ?>


<link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="SegmentFault" />


<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/global.676c5944.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/qa/css/qa_all.fe492d19.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/responsive.2e038079.css" />

<?php include '../templates/navbar.html'; ?>


<div class="wrap">

    
    <div class="container mt30">
        <div class="row">
            <div class="col-xs-12 col-md-9 main">
<?php
	//echo $_POST["Qid"];
	if(isset($_POST["Qid"])){
		$Qid=$_POST["Qid"];
		$query="SELECT* FROM question WHERE id='$Qid'";
		$result=mysql_query($query,$conn) or die(mysql_error());
		$record=mysql_fetch_assoc($result);
?>

                <article class="widget-question__item">
                    <div class="post-col">
                        <div class="widget-vote">
                            
                            <span class="count"><?php echo $record["question_rate_avg"]."/5"; ?></span><!--问题的rating显示在这里-->
                            
                        </div><!-- end .widget-vote -->
                    </div>

                    <div class="post-offset">

                        <div class="question fmt">
							<h2><?php echo $record["question_text"]; ?></h2><!--问题的text内容就写在这里-->
						</div>
					</div><!-- end .post-offset -->
                </article>
				

<?php	
		$query2="SELECT U.user_fname, U.user_lname, A.answer_text, A.answer_timestamp FROM answer A, userInfo U WHERE U.id = A.answer_userid AND A.answer_questionid ='$Qid'";
		$result2=mysql_query($query2,$conn) or die(mysql_error());
		$answer_num=mysql_num_rows($result2);
?>
		<div class="widget-answers">

					<h5 class="title h4 mt30 mb20 post-title" id="answers-title"><?php echo $answer_num; ?> Answers</h5><!--一共有多少个回答数目-->

<?php
		for($i=0;$i<$answer_num;$i++){
			
			$answer=mysql_fetch_assoc($result2);
		
?>                   

					<article class="clearfix widget-answers__item accepted">
						<div class="post-col">
							<div class="widget-vote">

								<span class="count"><?php echo $answer["answer_rate_avg"];?>/5</span>

							</div>
						</div>

						<div class="post-offset">
						
						<strong><a class="mr5"><?php echo $answer["user_fname"]." ".$answer["user_lname"];?></a></strong>

							<span class="ml10 text-muted">Reply a: <?php echo $answer["answer_timestamp"]; ?></span>

							<div class="answer fmt mt10">
								<p><?php echo $answer["answer_text"];?></p>
							</div>

						</div>
					</article><!-- /article -->

<?php			
		}
	}
?>		
        
				</div><!-- /.widget-answers -->

            
					<h4>Give Your Answer</h4>

					<div class = "answer-textarea" data-id = "<?= $record["id"]; ?>" <?= isset($_SESSION["id"])? "contentEditable" : ""; ?> style = "width: 80%;height: 200px;padding:10px;border-radius:4px;font-size:20px;font-family:Georgia;border:1px solid #ccc;<?= isset($_SESSION["id"])? "": "background-color: #BEBEBE;"; ?>'"><?= isset($_SESSION["id"])? "" : "<p style = 'text-align:center;margin-top:50px;'>Please <button class = 'btn btn-lg btn-success sign-in-btn-nav'>Log In</button> First</p>"; ?></div>
					<button type="button" class="btn btn-default btn-lg submit-answer btn-success" style="margin-top: 9px;" <?= isset($_SESSION["id"])? "" : "disabled"; ?>>Answer</button>
					

            </div><!-- /.main -->


            


        </div>
    </div>
</div>

<div id="fixedTools" class="hidden-xs hidden-sm">
  <a id="backtop" class="hidden border-bottom" href="#">UP</a>
</div>


<?php include '../templates/footer.html'; ?>


    <script src="//static.segmentfault.com/build/3rd/assets.ce4fe392.js"></script>
   
   

<script src="http://cbjs.baidu.com/js/m.js"></script>
<script>
$(document).ready(function(){
		$("body").on("click", ".submit-answer", function(){
			var content = $(this).prev();
			var html = content.html();
			if(html.length == 0){
				content.css("border-color", "#a94442");
			} else {
				var Qid = content.attr("data-id");
				$.ajax({
					url: "ajax_handler.php",
					type: "POST",
					data: {Qid:Qid, context:html, operation:"answer"},
					async: false,
					success: function(data){
						var receive = JSON.parse(data);
						
						if(receive.status == "success"){
							var kk = "<p><b><?php echo $_SESSION["fname"]; ?> <?php echo $_SESSION["lname"]?>:</b></p>" +
								"<p>" + html + "</p>" +
								"<p style='color:gray;'>" + receive.time + "</p>" +
								"<hr/>"
							$("h3[data-id='" + Qid + "']").after(kk);
						} else console.log(receive)
					}
				})
			}
		}).on("click", ".comment-textarea", function(){
			$(this).css("border-color", "#ccc");
		})
	})
</script>

