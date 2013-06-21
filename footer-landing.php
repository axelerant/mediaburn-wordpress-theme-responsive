	<div id="footer">
		<div class="copy left"><?php _e('Copyright', 'wpzoom') ?> &copy; <?php echo date("Y",time()); ?> <?php bloginfo('name'); ?>.&nbsp;</div>
		<?php 
			// $footerMenu = get_transient( 'videozoom_footerMenu' );
			$footerMenu = false;
			if ( false === $footerMenu ) {
				$footerMenu = wp_nav_menu(array(
					'container' => '', 
					'container_class' => 'copy left', 
					'menu_class' => '',
					'menu_id' => 'footerMenu',
					'sort_column' => 'menu_order',
					'theme_location' => 'footer',
					'echo' => 0,
				));

				// set_transient( 'videozoom_footerMenu', $footerMenu, T3VB_TIME_DAY );
			}

			echo $footerMenu;
		?>
		<div class="copy right">Media Burn | <a href="mailto:info@mediaburn.org">info@mediaburn.org</a></div>
	</div><!-- /#footer -->

</div><!-- /#container -->

<?php if (is_single()) { ?><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><?php } // Google Plus button ?>

<?php wp_footer(); ?>
</body>
</html>