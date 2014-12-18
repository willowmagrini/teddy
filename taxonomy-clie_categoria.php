<?php 
$url = $_SERVER['REQUEST_URI'];
$categoria=explode('/',$url);
$categoria = $categoria[2];
?>
<script>

jQuery('.page-numbers').click(function (e) {
	e.preventDefault();
	src=jQuery(this).attr('href');
	jQuery("#lista-videos").fadeOut()
							.load(src)
							.fadeIn();
});
</script>
<?php
// The Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type' => 'clientes',
	'clie_categoria'=> $categoria,
	'posts_per_page' => 9999,
	'orderby'=> 'title', 
	'order' => 'ASC',
	'paged'  =>  false
	
	
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
		<li class='clientes col-sm-4 ' id="cliente-<?php echo $post->ID;?>">
				<div class="capa">
					<h4>
						<?php echo $titu;?>
					</h4>
				</div>
			</a>
		</li>
		<?php
		if ($count % 3 == 0){
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

