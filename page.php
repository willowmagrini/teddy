<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<div id="primary" class="<?php echo odin_classes_page_full(); ?>">
		<div class="col-md-2"></div>
		<div id="content-portfolio" class="site-content col-md-8" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
