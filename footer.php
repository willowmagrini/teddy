<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
<?php
	$odin_general_opts = get_option( 'socials' );

	$face = $odin_general_opts['facebook'];
	$inst = $odin_general_opts['instagram'];
	$yout = $odin_general_opts['youtube'];
	$face = coloca_http($face);
?>
		</div><!-- #main -->

		<footer id="footer" role="contentinfo">
			<div id="" class="centro col-sm-10">
				<div class="site-info">
					<span>Faccioli Films Ltda. &copy; <?php echo date( 'Y' ); ?> </span>
				</div><!-- .site-info -->
				<div class="site-social">
					<a class="social-img" id="facebook" target="_blanck" href='<?php echo $face;?>'></a>
					<a class="social-img" id="instagram" target="_blanck" href="http://www.instagram.com"></a>
					<a class="social-img" id="youtube"  target="_blanck" href="http://www.youtube.com" ></a>
				</div><!-- .site-social -->
			</div>
			<div class="clearfix"></div>
		</footer><!-- #footer -->
		
	</div><!-- .container -->

	<?php wp_footer(); ?>
</body>
</html>
