<?php if ( ! is_page( 'education' ) ) : ?>
	<div id="footWidgets">

		<div class="column">
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 1') ) : ?> <?php endif; ?>
		</div><!-- /1st column -->

		<div class="column">
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 2') ) : ?> <?php endif; ?>
		</div><!-- /2nd column -->

		<?php if ( false ) { ?>
		<div class="column">
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 3') ) : ?> <?php endif; ?>
		</div><!-- /3rd column -->

		<div class="column last">
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 4') ) : ?> <?php endif; ?>
		</div><!-- /4th column -->
		<?php } ?>

		<div class="cleaner">&nbsp;</div>

	</div><!-- /#footWidgets -->
<?php endif; ?>

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