<?php include '../templates/header.html'; ?>

 <style>
     .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

    </style>

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

        <!-- Page Content -->
        <!--<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
		<a class="btn btn-default" data-target = "#sidebar-wrapper" id="menu-toggle"><i class = "glyphicon glyphicon-menu-hamburger"></i></a>
    </div>
    
                      <input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
    <div id="map-canvas"></div>
    <div id="push"></div>

    <div class="container">
	
    </div> <!-- /container -->


<?php include '../templates/footer.html'; ?>

<!--
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
-->

<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed&signed_in=true&libraries=places"></script>

<script type='text/javascript'>
 
	function initialize() {
		var mapOptions = {
			zoom: 11
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				map.setCenter(initialLocation);
			});
		}

		var input = /** @type {HTMLInputElement} */
			document.getElementById('pac-input');

		var types = document.getElementById('type-selector');
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		var infowindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			map: map,
			anchorPoint: new google.maps.Point(0, -29)
		});

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			infowindow.close();
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				return;
			}

			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.(crap)
			}
			marker.setIcon(/** @type {google.maps.Icon} */({
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(35, 35)
			}));
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);

			var address = '';
			if (place.address_components) {
				address = [
					(place.address_components[0] && place.address_components[0].short_name || ''),
					(place.address_components[1] && place.address_components[1].short_name || ''),
					(place.address_components[2] && place.address_components[2].short_name || '')
				].join(' ');
			}

			infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
			infowindow.open(map, marker);
		});

	  // Sets a listener on a radio button to change the filter type on Places
	  // Autocomplete.
		function setupClickListener(id, types) {
			var radioButton = document.getElementById(id);
			google.maps.event.addDomListener(radioButton, 'click', function() {
				autocomplete.setTypes(types);
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
	}

	google.maps.event.addDomListener(window, 'load', initialize);

  </script>
        
  

  <script>
	$(document).ready(function(){
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			var target = $(this).attr("data-target");
			var width = $(target).width() == 0? "250px" : "0px";
			$(target).animate({width: width}, 700);
		});
	})
    </script>