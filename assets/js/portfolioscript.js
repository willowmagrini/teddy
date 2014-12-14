jQuery(document).ready(function(){
	jQuery("#lista-videos").load("?port_categoria=comercial");
	jQuery(".categorias_portfolio").click(function(){
		id = jQuery(this).attr("id");
		console.log("?port_categoria="+id)
		jQuery("#lista-videos").load("?port_categoria="+id);
		
	  });


	// jQuery( ".categorias_portfolio" ).each(function( index ) {
	// 	  console.log( index + ": " + $( this ).text() );
	// 	});
});