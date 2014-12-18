<?php
/**
 * Template Name: Clientes
 *
 * Template para a página de clientes
 *
 */
get_header();?>
	<?php
	$clie_categoria = get_terms( 'clie_categoria', array(
 		'orderby'    => '',
 		'hide_empty' => 0,
 		)
 	);
?>
	

	
	
	
	
	<div id="primary" class="col-sm-12">
		<div class="col-sm-2"></div>
		<div id="content-clientes" class="site-content col-sm-9" role="main">
			<ul id="menu-port" class="sem-margem">
			    <?php foreach ( $clie_categoria as $cat ) { ?>
			    <li class="categorias_clientes" id="<?php echo $cat->slug; ?>">
					<a class=""  href="<?php echo get_term_link( $cat->slug, 'clie_categoria' ); ?>">
						<?php echo $cat->name; ?>
					</a>
				</li>

			    <?php } ?>
			</ul>
			<div id="lista-videos"></div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
