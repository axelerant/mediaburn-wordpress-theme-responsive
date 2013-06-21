<div id="sidebar">

	<?php if (option::get('ad_side') == 'on' && option::get('ad_side_pos') == 'Before widgets') { ?>
		<div class="banner">

			<?php if ( option::get('ad_side_imgpath') <> "") {
				echo stripslashes(option::get('ad_side_imgpath'));
			} else { ?>
				<a href="<?php echo option::get('banner_sidebar_url'); ?>"><img src="<?php echo option::get('banner_sidebar'); ?>" alt="<?php echo option::get('banner_sidebar_alt'); ?>" /></a>
			<?php } ?>

		</div><!-- /.side_ad -->
	<?php } ?>

<?php
				if (function_exists('dynamic_sidebar')) {
					if ( ! is_search() ) {
						dynamic_sidebar('Sidebar');
					} else {
						dynamic_sidebar('Search');
					}
				}
?>

 	<?php if (option::get('ad_side') == 'on' && option::get('ad_side_pos') == 'After widgets') { ?>
		<div class="banner">

			<?php if ( option::get('ad_side_imgpath') <> "") {
				echo stripslashes(option::get('ad_side_imgpath'));
			} else { ?>
				<a href="<?php echo option::get('banner_sidebar_url'); ?>"><img src="<?php echo option::get('banner_sidebar'); ?>" alt="<?php echo option::get('banner_sidebar_alt'); ?>" /></a>
			<?php } ?>

		</div><!-- /.side_ad -->
	<?php } ?>

   	<div class="cleaner">&nbsp;</div>

</div><!-- /#sidebar -->