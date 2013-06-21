<?php
require_once( USER_INC . '/custom/fitv/custom_functions.php' );

register_nav_menu( 'footer', 'Footer' );

register_sidebar(array(
	'name'=>'Header',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Search',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Post Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Post Top Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
 
?>
