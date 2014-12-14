jQuery(document).ready(function($) {
	// fitVids.
	$( '.entry-content' ).fitVids();
	$( '.video-portfolio' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();
	//ajusta altura do peincipal 
	altura=$( window ).height();
	console.log (altura);
	altura = parseInt(altura) - 345;
	console.log(altura);
	$('#main').css('min-height', altura+'px');

});
