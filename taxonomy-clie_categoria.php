<?php 
$url = $_SERVER['REQUEST_URI'];
$categoria=explode('/',$url);
$categoria = $categoria[3];
?>
<script>
jQuery('.link-video').click(function (e) {
	e.preventDefault();
	var src = jQuery(this).attr("href");
	var tit = jQuery(this).attr("titulo");
	var src = src.replace("watch?v=", "v/");
	src = src+'?rel=0&autoplay=1&controls=0&showinfo=0&fs=1';
	jQuery('#modal-portfolio').modal('show');
	jQuery('#modal-portfolio iframe').attr('src', src);
	jQuery('.modal-header').append('<h4>'+ tit +'</h4>');
	jQuery('#modal-portfolio').modal({
	  backdrop: 'static',
	  keyboard: false
	});
});
jQuery('.page-numbers').click(function (e) {
	e.preventDefault();
	src=jQuery(this).attr('href');
	jQuery("#lista-videos").fadeOut()
							.load(src)
							.fadeIn();
});
jQuery('#modal-portfolio button').click(function () {
	jQuery('#modal-portfolio iframe').removeAttr('src');
	jQuery('.modal-header').children('h4').remove();
   });
jQuery('.modal-dialog').focusout(function() {
    jQuery('#modal-portfolio iframe').removeAttr('src');
	jQuery('.modal-header').children('h4').remove();
});

</script>
<?php
// The Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type' => 'clientes',
	'clie_categoria'=> $categoria,
	'paged'  =>  $paged
	
);
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<ul class="sem-margem"> ';
	$count=1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$titu =  get_the_title();
		$desc = get_the_content();
		?>
		<li class='clientes col-md-3 ' id="cliente-<?php echo $post->ID;?>">
				<div class="capa">
					<div class="capa-hover"><h3><?php echo $titu;?></h3></div>
					<img src="<?php echo 'thumbnail';?>">
				</div>
			</a>
		</li>
		<?php
		if ($count % 4 == 0){
			?>
			<div class="clearfix"></div>
			<?php
		}
	$count++;
	}//while
	echo '</ul>';
} else {
	// no posts found
}
?>
<div class="clearfix"></div>

 <?php
/* Restore original Post Data */
wp_reset_postdata();
if ( function_exists('base_pagination') ) { base_pagination(); } else if ( is_paged() ) { ?>
	<div id="pag-nav" class="navigation clearfix">
	    <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
	    <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
	</div>
	<?php } 
