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
		position: absolute;
	}
	  
	#menu-toggle{
		position: absolute;
		z-index:1000;
		right: 0px;
	}
</style>
<link rel = "stylesheet" href = "../../style/css/simple-sidebar.css">

<?php include '../templates/navbar.html'; ?>

	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    
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
		var markers = []
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
			//markers.push(marker);
		});
		
		if(!$("#wrapper").hasClass("toggled"))
			$("#menu-toggle").css("right", "250px");
	})
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		if($("#wrapper").hasClass("toggled"))
			$("#menu-toggle").animate({right: "0px"});
		else $("#menu-toggle").animate({right: "250px"});
    });
</script>