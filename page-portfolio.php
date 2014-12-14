<?php
/**
 * Template Name: Portfólio
 *
 * Template para a página de portfolio
 *
 */
get_header();?>
	<?php
	$port_categoria = get_terms( 'port_categoria', array(
 		'orderby'    => '',
 		'hide_empty' => 0,
 		)
 	);
?>
	

	
	
	
	
	<div id="primary" class="<?php echo odin_classes_page_full(); ?>">
		<div class="col-md-2"></div>
		<div id="content-portfolio" class="site-content col-md-9" role="main">
			<ul id="menu-port" class="sem-margem">
			    <?php foreach ( $port_categoria as $cat ) { ?>
			    <li class="categorias_portfolio" id="<?php echo $cat->slug; ?>"><a class="<?php echo $cat->slug; ?> ajax"  href="#"><?php echo $cat->name; ?></a></li>

			    <?php } ?>
			</ul>
			<div id="lista-videos"></div>
			
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
