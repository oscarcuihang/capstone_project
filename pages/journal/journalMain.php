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
<?php include '../templates/navbar.html'; ?>
   
 
	
 
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
	$query = "SELECT * FROM travelJournal";
	$result= mysql_query($query,$conn) or die(mysql_error());
	$total_num = mysql_num_row($result);
	$com_num=$total_num/14;
	$rest_num=$total_num%14;

	for($i=0;$i<$com_num;$i++){
		
?>
			
			<div class="f-page">
				<!--The function bar-->
				
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
				
				<div class="box w-25 h-70">
					<div class="img-cont img-1"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-70 box-b-l box-b-r">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-25 h-70">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>
			
			<div class="f-page">
				<div class="f-title">
					<a href="">Previous Demo</a>
					<h2>Incredible Spacenews</h2>
					<a href="">Back to the Codrops Article</a>
				</div>
				<div class="box w-70 h-50 box-b-r title-top box-img-left">
					<div class="img-cont img-4"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-50">
					<div class="img-cont img-5"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-50 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-70 h-50 title-top box-img-left">
					<div class="img-cont img-6"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>
			
			<div class="f-page">
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
				<div class="box w-30 h-60 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-70 h-60 box-img-left title-top">
					<div class="img-cont img-7"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-40 h-40 box-img-left box-b-r title-top">
					<div class="img-cont img-8"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-40 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-40 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>
<?php	
	}
	if($rest_num>0){
		if($rest_num<=5){
?>
			<div class="f-page">;	
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
<?php
			if($rest_num>=1){
?>
				<div class="box w-25 h-70">
					<div class="img-cont img-1"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
<?php
			}
			if($rest_num>=2){
?>
				<div class="box w-50 h-70 box-b-l box-b-r">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
<?php
			}
			if($rest_num>=3){
?>
				<div class="box w-25 h-70">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
<?php
			}
			if($rest_num>=4){
?>
				<div class="box w-50 h-30 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
<?php
			}
			if($rest_num==5){
?>	
				<div class="box w-50 h-30 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
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
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
				
				<div class="box w-25 h-70">
					<div class="img-cont img-1"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-70 box-b-l box-b-r">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-25 h-70">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>			
			<div class="f-page">
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
<?php
			if($rest_num>=6){
?>
				<div class="box w-70 h-50 box-b-r title-top box-img-left">
					<div class="img-cont img-4"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
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
				</div>				
<?php				
			}
			if($rest_num>=8){
?>
				<div class="box w-30 h-50 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
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
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>

				
				<div class="box w-25 h-70">
					<div class="img-cont img-1"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-70 box-b-l box-b-r">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-25 h-70">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-50 h-30 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>
			

			<div class="f-page">
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>
				<div class="box w-70 h-50 box-b-r title-top box-img-left">
					<div class="img-cont img-4"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-50">
					<div class="img-cont img-5"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-30 h-50 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
				<div class="box w-70 h-50 title-top box-img-left">
					<div class="img-cont img-6"></div>
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
			</div>
			

			<div class="f-page">
				<div class="f-title">
					<a href="">Create</a>
					<h2>Travel Journal</h2>
					<a href="">Search</a>
				</div>	
<?php
			if($rest_num>=10){
?>
				<div class="box w-30 h-60 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
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
				</div>
<?php
			}
			if($rest_num>=13){
?>
				<div class="box w-30 h-40 box-b-r title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
				</div>
<?php
			}
			if($rest_num==14){
?>
				<div class="box w-30 h-40 title-top">
					<?php $record= mysql_fetch_assoc($result);?>
					<h3><?php printf("%s", $record["journal_title"]) ?><span>Published  <?php printf("%s",$record["journal_timestamp"])?></span></h3>
					<p><?php printf("%s", $record["journal_content"]) ?></p>
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
				
			var $Jcontainer 	= $( '#flip' ),
				$pages		= $Jcontainer.children().hide();
			
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
