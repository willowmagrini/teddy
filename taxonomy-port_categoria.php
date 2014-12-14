<?php $categoria=$_GET['port_categoria'];?>

<?php
// The Query
$args = array(
	'post_type' => 'portfolio',
	'port_categoria'=> $categoria,
	
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
		<li class='video-portfolio col-md-3 ' id="video-<?php echo $post->ID;?>">
			<img src="<?php echo get_field('link_do_video');?>">
		</li>
		<?php
		if ($count % 4 == 0){
			?>
			<div class="clearfix"></div>
			<?php
		}
	$count++;
	}
	echo '</ul>';
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
