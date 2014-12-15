jQuery(document).ready(function(){
	url = jQuery('.categorias_clientes a').attr('href');
	console.log(url);
	jQuery("#lista-videos").load(url);						
	jQuery(".categorias_clientes a").first().addClass("ativo");
	
	jQuery(".categorias_clientes").click(function(e){
		e.preventDefault();
		jQuery( ".ativo" ).removeClass( "ativo" )
		id = jQuery(this).attr("id");
		jQuery(this).children('a').attr("class", 'ativo');
		url = jQuery(this).children('a').attr("href");
		jQuery("#lista-videos").fadeOut()
	   							.load(url)
						   		.fadeIn()
								.attr('class',id);
	   	});
	
	
	
	
	// jQuery( ".categorias_portfolio" ).each(function( index ) {
	// 	  console.log( index + ": " + $( this ).text() );
	// 	});
});