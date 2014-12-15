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
			    <li class="categorias_portfolio" id="<?php echo $cat->slug; ?>">
					<a class=""  href="<?php echo get_term_link( $cat->slug, 'port_categoria' ); ?>">
						<?php echo $cat->name; ?>
					</a>
				</li>

			    <?php } ?>
			</ul>
			<div id="lista-videos"></div>
			<div id="modal-portfolio" data-keyboard="false" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			            </div>
			            <div class="modal-body">
			                <iframe width="560" height="315" frameborder="0" allowfullscreen=""></iframe>
			            </div>
			        </div>
			    </div>
			</div>
			
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
