<?php
/**
 * Template para a página de abertura om seleção de idiomas
 *
  */

get_header('front'); ?>

	<div id="primary" class="<?php echo odin_classes_page_full(); ?>">
		<div id="content" class="site-content" role="main">
			<img src="<?php echo get_template_directory_uri()?>/assets/images/logo-preto.png">
			<div class= "linguas">
				<a href="institucional">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/bra.png">
				</a>
				<a href="en/institucional">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/eua.png">
				</a>
				<a href="it/institucional">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/ita.png">
				</a>
			</div>
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer('front');
