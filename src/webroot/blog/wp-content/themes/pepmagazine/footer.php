<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package pepmagazine
 */
?>

	</div><!-- #content -->
</div><!-- #page -->
	<footer id="colophon" class="site-footer" role="contentinfo">
	<hr />
		<div id="footer-menu">
		<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'depth'=>'1')); ?>
		</div>
		<div class="site-info">
			<?php do_action( 'peptheme_credits' ); ?>
			Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. <?php _e('Powered by', 'peptheme'); ?> 
					<a href="//wordpress.org" title="WordPress" target="_blank"><?php _e('WordPress', 'peptheme'); ?></a> &amp; 
					<a href="http://pepthemes.com" title="<?php _e('PepThemes', 'peptheme'); ?>" target="_balnk"><?php _e('PepThemes', 'peptheme'); ?></a>.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>