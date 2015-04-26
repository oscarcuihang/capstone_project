<!--
	The Hottest page shows the questions order by
	number of rating(votes number) from highest to lowest
-->
<?php include '../templates/header.html'; ?>

<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/global.1e5f56f0.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/qa/css/qa_all.5c45d211.css" />
<link rel="stylesheet" href="//static.segmentfault.com/build/global/css/responsive.2e038079.css" />


<?php include '../templates/navbar.html'; ?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9 main">
                <p class="main-title hidden-xs">
                    What's your question?
                    <a id="goAsk" href="/ask" class="btn btn-primary">I have question!</a>
                </p>

                <ul class="nav nav-tabs nav-tabs-zen mb10">
                    <li><a href="index.php">Newest</a></li>
                    <li class="active"><a href="hottest_q.php">Hottest</a></li>
                    <li><a href="unanswered_q.php">Unanswered</a></li>
                </ul>

				<div class="stream-list question-stream">
<?php
$query = "SELECT * FROM question ORDER BY question_rate_num DESC LIMIT 50;";
$result= mysql_query($query,$conn) or die(mysql_error());
$total_num = mysql_num_rows($result);

for($i=0; $i<$total_num;$i++){
	$record=mysql_fetch_assoc($result);
?>
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
							  
							  <p1 class="title"><a class = "myquestion" href="question.php"><?php echo $record["question_text"]?></a></p1>
							  
							</div>
					</section>
<?php	
}
?>   
				</div><!-- /.stream-list -->

				<!--setting paging (分页)-->
				<div class="text-center">
					<ul class="pagination"><li class="active"><a href="javascript:void(0);">1</a></li><li><a href="/questions/hottest?page=2">2</a></li><li><a href="/questions/hottest?page=3">3</a></li><li><a href="/questions/hottest?page=4">4</a></li><li><a href="/questions/hottest?page=5">5</a></li><li class="disabled"><span>&hellip;</span></li><li class="next"><a href="/questions/hottest?page=2">下一页</a></li></ul>
				</div>
            </div><!-- /.main -->
           
         </div><!-- /.side -->
     </div>
</div>


<script>
    (function (w) {
        w.SF = {
            staticUrl: "//static.segmentfault.com",
        };
        w.SF.token = (function () {
    var _qfotKKs = //'dGO'
'81'+'e85'//'E'
+//'OM'
'73'+'c'//'qvm'
+//'t'
'cc6'+/* 'vG'//'vG' */''+'wS'//'wS'
+'d0'//'ZY'
+//'Mc'
'f'+//'e'
'6'+//'P'
'94'+'5d'//'t6x'
+'XL'//'XL'
+//'GWT'
'a1e'+//'k'
'k'+'4a'//'aq'
+//'jMX'
'jMX'+'XU'//'XU'
+'v8'//'v8'
+//'v3'
'0d'+//'vkZ'
'14'+'0'//'HGD'
+//'F'
'e7d', _Sale44 = [[11,13],[19,21],[22,23],[24,27],[24,26],[24,26]];

    for (var i = 0; i < _Sale44.length; i ++) {
        _qfotKKs = _qfotKKs.substring(0, _Sale44[i][0]) + _qfotKKs.substring(_Sale44[i][1]);
    }

    return _qfotKKs;
})();
    })(window);
</script>

    <script src="//static.segmentfault.com/build/3rd/assets.ce4fe392.js"></script>
    <script>
    requirejs.config({
        baseUrl: "//static.segmentfault.com/build/global/js"
    });
    </script>
            <script src="//static.segmentfault.com/build/qa/js/index.3e69e5af.js"></script>
    
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-918487-8']);
  _gaq.push(['_trackPageview']);
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-918487-8', 'auto');
  ga('send', 'pageview');

</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?e23800c454aa573c0ccb16b52665ac26";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script src="http://cbjs.baidu.com/js/m.js"></script>
<script>
if(typeof BAIDU_CLB_fillSlotAsync === 'function') {
    BAIDU_CLB_fillSlotAsync('981183','adid-981183');
    BAIDU_CLB_fillSlotAsync('981184','adid-981184');
    BAIDU_CLB_fillSlotAsync('981694','adid-981694');
    BAIDU_CLB_fillSlotAsync('981179','adid-981179');
}
</script>



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

