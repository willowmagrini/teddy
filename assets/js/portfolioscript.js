jQuery(document).ready(function(){
	url = jQuery('.categorias_portfolio a').attr('href');
	jQuery("#lista-videos").load(url);						
	jQuery(".categorias_portfolio a").first().addClass("ativo");
	
	jQuery(".categorias_portfolio").click(function(e){
		e.preventDefault();
		jQuery( ".ativo" ).removeClass( "ativo" )
		id = jQuery(this).attr("id");
		jQuery(this).children('a').attr("class", 'ativo');
		url = jQuery(this).children('a').attr("href");
		jQuery("#lista-videos").fadeOut('fast',function(){
			jQuery('#loading').show();
		});
	   		jQuery("#lista-videos").load(url, function() {
				jQuery("#lista-videos").fadeIn()
				.attr('class',id);
				jQuery('#loading').hide();
			});
	   	});
	// jQuery( ".categorias_portfolio" ).each(function( index ) {
	// 	  console.log( index + ": " + $( this ).text() );
	// 	});
});