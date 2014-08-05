<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WakeMojo
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-asides">
			<div class="footer-aside footer-aside-first">
				<div class="footer-wrap">
					<?php dynamic_sidebar( 'footer-aside-first' ); ?>
				</div><!-- .footer-aside-first -->
			<div class="footer-aside footer-aside-second">
				<div class="footer-wrap">
					<?php dynamic_sidebar( 'footer-aside-second' ); ?>
				</div>
			</div><!-- .footer-aside-second -->
			<div class="footer-aside footer-aside-third">
				<div class="footer-wrap">
					<?php dynamic_sidebar( 'footer-aside-third' ); ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</div>
</body>
</html>
