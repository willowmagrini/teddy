<?php
/**
 * Template Name: Contato
 *
 * Template para a página de contato
 *
 */


get_header(); ?>

	<div id="primary" class="col-sm-12">
		<div class="col-sm-2"></div>
		
		<div id="content" class="site-content col-sm-8" role="main">
			<div id="map-canvas" class="col-sm-6"></div>
		   
			
			<?php echo scf_html();?>
			

		</div><!-- #content -->
	</div><!-- #primary -->

	<script>
	      // This example displays a marker at the center of Australia.
		// When the user clicks the marker, an info window opens.

		function initialize() {
		  var myLatlng = new google.maps.LatLng(-23.558985, -46.647035);
		  var mapOptions = {
		    zoom: 14,
		    center: myLatlng
		  };

		  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		  var contentString = '<div id="content">'+
		      '<div id="siteNotice">'+
		      '</div>'+
		      '<img style="display:inline-block;width:30%" src="http://localhost:8888/teddy/wp-content/uploads/2014/12/logo1.png"><h2 id="firstHeading" class="firstHeading"><a  target=_blank href="https://www.google.com.br/maps/dir//R.+dos+Ingleses,+123+-+Morro+dos+Ingleses,+S%C3%A3o+Paulo+-+SP/@-23.5589853,-46.6470346,17z/data=!4m13!1m4!3m3!1s0x94ce59b6c5656dbf:0x831743a8526f7772!2sR.+dos+Ingleses,+123+-+Morro+dos+Ingleses,+S%C3%A3o+Paulo+-+SP!3b1!4m7!1m0!1m5!1m1!1s0x94ce59b6c5656dbf:0x831743a8526f7772!2m2!1d-46.6470346!2d-23.5589853?hl=en">Teddy Bear Filmes</a></h2>'+
		      '<div id="bodyContent">'+
		      '<p><b>Rua dos Ingleses, 123 - Bela Vista <br> São Paulo - SP - Brasil CEP 01329-000 <br> Tel/Fax +55 11 3262 3344</b>'+
		      '</div>'+
		      '</div>';

		  var infowindow = new google.maps.InfoWindow({
		      content: contentString
		  });

		  var marker = new google.maps.Marker({
		      position: myLatlng,
		      map: map,
		      title: 'Uluru (Ayers Rock)'
		  });
		  google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(map,marker);
		  });
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	    </script>
<?php

get_footer();
