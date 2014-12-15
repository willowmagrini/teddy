<?php
/**
 * Template Name: Contato
 *
 * Template para a página de contato
 *
 */


get_header(); ?>

	<div id="primary" class="<?php echo odin_classes_page_full(); ?>">
		<div class="col-md-2"></div>
		
		<div id="content" class="site-content col-md-8" role="main">
			<div id="map-canvas" class="col-md-6"></div>
		    
			<form  class="col-md-6" role="form">
				<div id="endereco">
					<p>Rua dos Ingleses, 123 - Bela Vista   |   São Paulo - SP - Brasil</p>
					<p>CEP 01329-000   |   Tel/Fax +55 11 3262 3344</p>
					<p>	<a href="mailto:teddy@teddyfilmes.com.br"> teddy@teddyfilmes.com.br </a> | Faccioli Films Ltda.</p>
				</div>
				<div class="form-group">
			    	<label for="nome">Nome</label>
			    	<input id="nome"type="text" class="form-control" id="nome" placeholder="Nome">
			  	</div>
			  	<div class="form-group">
			    	<label for="email">E-mail</label>
 			    	<input type="email" class="form-control" id="email" placeholder="email">
				</div>
				<div class="form-group">
			    	<label for="telefone">Telefone</label>
 			    	<input type="tel" class="form-control" id="telefone" placeholder="telefone">
			  	</div>
				<div class="form-group">
					<label for="mensagem">Mensagem</label>
				  	<textarea class="form-control" id="mensagem" name="mensagem"></textarea>
				  	<button type="submit" class="btn btn-default">Enviar</button>
				</div>
			</form>

		</div><!-- #content -->
	</div><!-- #primary -->

	<script>
	      function initialize() {
	        var mapCanvas = document.getElementById('map-canvas');
	        var mapOptions = {
	          center: new google.maps.LatLng(44.5403, -78.5463),
	          zoom: 8,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        }
		
	        var map = new google.maps.Map(mapCanvas, mapOptions)
				var marker = new google.maps.Marker({
				      position: new google.maps.LatLng(44.5403, -78.5463),
				      map: map,
				      title: 'Hello World!'
				  });
	      }
	      google.maps.event.addDomListener(window, 'load', initialize);
	    </script>
<?php

get_footer();
