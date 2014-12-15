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
	altura_modal=parseInt(altura)/2-225;
	altura = parseInt(altura) - 345;
	$('#main').css('min-height', altura+'px');
	$('.modal-dialog').css('top',altura_modal+'px');

   	
});
