<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php wp_title(); ?></title>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
	<?php ui::js("jwplayer"); ?>
	<?php ui::js("jquery.fitvid"); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">

	<div id="header">

		<div class="wrapper">

			<div id="logo">
				<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>

				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
					<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
						<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
					<?php } ?>
				</a><div class="clear"></div>

				<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

			</div><!-- / #logo -->
			<div id="subtitle"></div>



			<?php if (option::get('ad_head_select') == 'on') { ?>
				<div id="bannerHead">

<?php if ( option::get('ad_head_code') <> "") {
	echo stripslashes(option::get('ad_head_code'));
} else { ?>
						<a href="<?php echo option::get('banner_top_url'); ?>"><img src="<?php echo option::get('banner_top'); ?>" alt="<?php echo option::get('banner_top_alt'); ?>" /></a>
					<?php } ?>

				</div><!-- /#topad -->
			<?php } ?>

			<div class="cleaner">&nbsp;</div>

		</div><!-- /.wrapper -->

	</div><!-- /#header -->