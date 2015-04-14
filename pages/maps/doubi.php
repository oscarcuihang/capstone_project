<?php include '../templates/header.html'; ?>

<style type="text/css">
	html,body{
		height:100%;
	}

	#map-canvas {
		width:100%;
		height:100%;
	}

	.navbar-default {
		margin-bottom:0;
	}
	  
	#wrapper{
		position: fixed;
		z-index: 1000;
		width: 300px;
		right: 0px;
		height: 100%;
	}
	  
	#sidebar-wrapper{
		width: 0px;
		height: 100%;
		float: right;
		background-color: #f8f8f8;
		border: 1px solid #ccc;
		border-radius: 4px;
	}  
	  
	#menu-toggle{
		float: right;
		width: 50px;
		height: 43px;
		cursor: pointer;
		margin-top: 100px;
		background-color: #f8f8f8;
		border-right-width: 0px;
		border-top-right-radius: 0px;
		border-bottom-right-radius: 0px;
	}
	 
	#menu-toggle i{
		font-size: 27px;
		color: black;
	}
</style>

<?php include '../templates/navbar.html'; ?>

	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
        </div>
        <!-- /#sidebar-wrapper -->
		<a class="btn btn-default" data-target = "#sidebar-wrapper" id="menu-toggle"><i class = "glyphicon glyphicon-menu-hamburger"></i></a>
        <!-- Page Content -->
        <!--<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /#page-content-wrapper -->

    </div>
                    
	<div id="map-canvas"></div>
    <div id="push"></div>

    <div class="container">
	
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>

<!--
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
-->

<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>

<script type='text/javascript'>
	//
	// Google Map API functions
	//
	
	// Google Map API functions
	//
	//
	
	$(document).ready(function(){
		// Google Map setup 
		var myOptions = {
			zoom: 11
		}
		var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				map.setCenter(initialLocation);
			});
		}
		google.maps.event.addListener(map, 'click', function(event) {
			console.log(event.latLng)
			var marker = new google.maps.Marker({
				position: event.latLng,
				map: map,
				draggable: true
			})
			var infocontent = "";
			google.maps.event.addListener(marker, "click", function(){
				var lat = marker.getPosition().lat();
				var lon = marker.getPosition().lng();
				$.ajax({
					url: "http://maps.googleapis.com/maps/api/geocode/json",
					type: "GET",
					data: { latlng: lat + "," + lon, sensor: "true_or_false"},
					success: function(data, status){
						results = data.results;
						var infowindow = new google.maps.InfoWindow({content: results[0].formatted_address});
						infowindow.open(map, marker);
					}
				})
			})
		});
		
		$("#menu-toggle").click(function() {
			var target = $(this).attr("data-target");
			var width = $(target).width() == 0? "250px" : "0px";
			$(target).animate({width: width}, 700);
		});
	})
</script>
