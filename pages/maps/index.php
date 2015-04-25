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
	  
	  #card-info {
		  background-color: #fff;
		  font-family: Roboto;
		  text-overflow: ellipsis;
		  width: 408px;
		  height: 64px;
		  position: absolute;
		  margin-top: 54px;
		  margin-left:10px;
		  border-color:1px solid transparent;
		  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		  z-index: 2;
		  display:none;
	  }
	  
	  #card-info-content{
		  height:64px;
		  width:300px;
	  }
	  
	  .vr {
		  margin-left: 20px;
		  margin-right: 20px;
		  height: 50px;
		  border: 0;
		  border-left: 1px solid #cccccc;
		  display: inline-block;
		  vertical-align: top;
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
	
	.close {
		font-size:57px;
	}
	
	.row div.button{
		padding-top:14px;
	}
	
	.row i{
		font-size:30px;
		color: #666;
		cursor: pointer;
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
    
    <input id="pac-input" class="controls" type="text" placeholder="Enter a location">
	<div id = "card-info">
		<div class = "row">
			<div class = "col-md-9 card-content">
			</div>
			<div class = "col-md-1 button add-location">
				<i class = "glyphicon glyphicon-plus"></i>
			</div>
			<div class = "col-md-1 button close-card-info">
				<i class = "glyphicon glyphicon-remove"></i>
			</div>
		</div>
	</div>
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
 
	var undefined_marker = "";	// markers not in the path, only one will appear on the map
	var settle_markers = [];		// markers included in the path
	var map = "";
	var last_index_marker = 0;
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay;
	function initialize() {
		var mapOptions = {
			zoom: 11
		};
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				map.setCenter(initialLocation);
			});
		}
		directionsDisplay = new google.maps.DirectionsRenderer({
			suppressMarkers: true
		});
		directionsDisplay.setMap(map);

		var input = /** @type {HTMLInputElement} */
			document.getElementById('pac-input');

		var types = document.getElementById('type-selector');
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		//var infowindow = new google.maps.InfoWindow();
		

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var marker = new google.maps.Marker({
				map: map,
				anchorPoint: new google.maps.Point(0, -29)
				//draggable: true
			});
			marker.setVisible(false);
			if(undefined_marker != "")
				undefined_marker.setMap(null);
			undefined_marker = marker;
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
			
			var lat = place.geometry.location.lat();
			var lon = place.geometry.location.lng();
			
			$.ajax({
				url: "http://maps.googleapis.com/maps/api/geocode/json",
				type: "GET",
				async: false,
				data: { latlng: lat + "," + lon, sensor: "true_or_false"},
				success: function(data, status){
					results = data.results;
					$(".card-content").html(results[0].formatted_address)
					$("#card-info").hide().show(200);
				}
			})
			google.maps.event.addListener(marker, "click", function(){
				if($("#card-info").css("display") == "none")
					$("#card-info").show(200)
			})
		});

	  // Sets a listener on a radio button to change the filter type on Places
	  // Autocomplete.
		function setupClickListener(id, types) {
			var radioButton = document.getElementById(id);
			google.maps.event.addDomListener(radioButton, 'click', function() {
				autocomplete.setTypes(types);
			});
		}
		
		
		// Add marker by clicking the map
		google.maps.event.addListener(map, 'click', function(event) {
			if(undefined_marker != "")
				undefined_marker.setMap(null)
			//console.log(event.latLng)
			var marker = new google.maps.Marker({
				position: event.latLng,
				map: map,
				draggable: true
			})
			undefined_marker = marker;
			var infocontent = "";
			/*google.maps.event.addListener(marker, "dbclick", function(){
				console.log("miao");
				marker.setMap(null);
			})*/
			var lat = event.latLng.lat();
			var lon = event.latLng.lng();
			$.ajax({
				url: "http://maps.googleapis.com/maps/api/geocode/json",
				type: "GET",
				async: false,
				data: { latlng: lat + "," + lon, sensor: "true_or_false"},
				success: function(data, status){
					results = data.results;
					$(".card-content").html(results[0].formatted_address)
					$("#card-info").hide().show(200);
				}
			})
			google.maps.event.addListener(marker, "click", function(){
				if($("#card-info").css("display") == "none")
					$("#card-info").show(200)
			})
		});
	}
	
	function calc_route(){
		console.log(settle_markers)
		var settle_markers_len = 0;
		var i;
		for(i in settle_markers)
			settle_markers_len++;
		console.log(settle_markers_len)
		if(settle_markers_len / 2 >= 2){
			var start = settle_markers[settle_markers[0]].getPosition();
			var end = settle_markers[settle_markers[settle_markers_len / 2 - 1]].getPosition();
			var waypoints = [];
			for(var i = 1; i < settle_markers_len / 2 - 1; i++){
				console.log(settle_markers[i])
				waypoints.push({
					location: settle_markers[settle_markers[i]].getPosition(),
					stopover: true
				})
			}
			
			var request = {
				origin: start,
				destination: end,
				waypoints: waypoints,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			directionsService.route(request, function(response, status){
				if(status == google.maps.DirectionsStatus.OK){
					directionsDisplay.setMap(map);
					directionsDisplay.setDirections(response);
				}
			})
		} else {
			if(directionsDisplay != null){
				directionsDisplay.setMap(null);
			}
		}
	}

	google.maps.event.addDomListener(window, 'load', initialize);

  </script>
        
  

  <script>
	$(document).ready(function(){
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			var target = $(this).attr("data-target");
			var width = $(target).width() == 0? "250px" : "0px";
			if(width == "0px")
				$("#sidebar-wrapper > .row").hide();
			$(target).animate({width: width}, 700, function(){
				if(width == "250px")
					$("#sidebar-wrapper > .row").show();
			});
		});
		$(".add-location").click(function(){
			var settle_markers_len = 0;
			var i;
			for(i in settle_markers)
				settle_markers_len++;
			//console.log(settle_markers_len);
			if(settle_markers_len / 2 >= 10)
				alert("Cannot add more than 10 spots to the path")
			else {
				var target = $("#menu-toggle").attr("data-target");
				if(settle_markers[$(".card-content").html()] == null){
					if($(target).width() != 250) 
						$(target).animate({width:250}, 700, function(){
							$("#sidebar-wrapper").append(
								"<div class = 'row location-in-route' data-address = '" + $(".card-content").html() + "'>" + 
									"<div class = 'col-md-6'>" +
										$(".card-content").html() +
									"</div>" +
									"<div class = 'col-md-1'>" +
										"<i class = 'glyphicon glyphicon-remove close delete-loc'></i>" +
									"</div>" +
									"<i class = 'glyphicon glyphicon-arrow-up move-up'></i>" +
									"<i class = 'glyphicon glyphicon-arrow-down move-down'></i>" +
									"<hr>" +
								"</div>"
							)
							$("#sidebar-wrapper").show();
						})
					else {
						$("#sidebar-wrapper").append(
							"<div class = 'row location-in-route' data-address = '" + $(".card-content").html() + "'>" + 
								"<div class = 'col-md-6'>" +
									$(".card-content").html() +
								"</div>" +
								"<div class = 'col-md-1'>" +
									"<i class = 'glyphicon glyphicon-remove close delete-loc'></i>" +
								"</div>" +
								"<i class = 'glyphicon glyphicon-arrow-up move-up'></i>" +
								"<i class = 'glyphicon glyphicon-arrow-down move-down'></i>" +
								"<hr>" +
							"</div>"
						)
					}
					undefined_marker.setMap(null);	// Replace the undefined marker with a different marker
													// to change color into blue
					var pinColor = "2F76EE";
					var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
						new google.maps.Size(21, 34),
						new google.maps.Point(0,0),
						new google.maps.Point(10, 34)
					);
					var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
						new google.maps.Size(40, 37),
						new google.maps.Point(0, 0),
						new google.maps.Point(12, 35)
					);
					var marker = new google.maps.Marker({
						position: undefined_marker.getPosition(),
						map: map,
						icon: pinImage,
						shadow: pinShadow,
						draggable: false
					})
					settle_markers[$(".card-content").html()] = marker;
					settle_markers.push($(".card-content").html());
					undefined_marker = "";
					calc_route();
				} else alert("already in the path");
			}
		})
		$(".close-card-info").click(function(){
			$("#card-info").hide(200)
		})
		$("body").on("click", ".delete-loc", function(){
			var target = $(this).parent().parent().attr("data-address");
			$("#card-info").hide(200);
			$("#sidebar-wrapper > div.row[data-address='" + target + "']").remove()
			settle_markers[target].setMap(null);
			var index = settle_markers.indexOf(target);
			delete settle_markers[target];
			settle_markers.splice(index, 1);
			calc_route();
			//console.log(settle_markers)
		}).on("click", ".move-up", function(){
			var $cur = $(this).parent();
			var $pre = $cur.prev(".location-in-route");
			if($pre.length != 0){
				var index = settle_markers.indexOf($cur.attr("data-address"));
				if(index > 0){
					var tmp = settle_markers[index - 1];
					settle_markers[index - 1] = settle_markers[index];
					settle_markers[index] = tmp;
				} else console.log("Error: fail to switch the index")
				$pre.before($cur);
				calc_route();
				console.log(settle_markers)
			}
		}).on("click", ".move-down", function(){
			var settle_markers_len = 0;
			var i;
			for(i in settle_markers)
				settle_markers_len++;
			var $cur = $(this).parent();
			var $aft = $cur.next();
			if($aft.length != 0){
				var index = settle_markers.indexOf($cur.attr("data-address"));
				if(index < settle_markers_len / 2 - 1){
					var tmp = settle_markers[index + 1];
					settle_markers[index + 1] = settle_markers[index];
					settle_markers[index] = tmp;
				}
				$aft.after($cur);
				calc_route();
				console.log(settle_markers)
			}
		})
	})

    </script>