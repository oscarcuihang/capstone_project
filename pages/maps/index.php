<?php include '../templates/header.html'; ?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
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
</style>

<?php include '../templates/navbar.html'; ?>

<div id="map-canvas"></div>
<div id="push"></div>
<div class="container">
  <!-- Main component for a primary marketing message or call to action -->
  <!--<div id="map_canvas"></div>-->
</div> <!-- /container -->

<?php include '../templates/footer.html'; ?>

<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
<!-- JavaScript jQuery code from Bootply.com editor  -->
<script type='text/javascript'>
  $(document).ready(function() {
    function initialize() {
      getLocation(); 
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function getLocation(){
      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
      } else {
        // default location
      }
    }

    function success(position){
      var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

      var mapOptions = {
        center: latlng,
        zoom: 12
      };
      var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }

      function error(msg){
        if (msg.code == 1) {
            //PERMISSION_DENIED 
        } else if (msg.code == 2) {
            //POSITION_UNAVAILABLE 
        } else {
        }   //TIMEOUT
      }
    });
  </script>
        
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-40413119-1', 'bootply.com');
    ga('send', 'pageview');
  </script>

