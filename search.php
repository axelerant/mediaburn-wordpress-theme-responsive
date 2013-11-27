<?php get_header(); ?>

<div id="main">
  
    <div class="wrapper">
      
        <div class="sep sepMenu">&nbsp;</div>
        <div class="full">

        <?php if ( ! is_search() && option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>
		
		<div id="content">
			      
			<div id="postFuncs">
				<div id="funcStyler">
					<?php if (empty($_COOKIE['mode'])) {
						$_COOKIE['mode'] = 'list';
					}?>
					<?php if (option::get('post_switcher') == 'on') { ?><a href="javascript: void(0);" id="mode" <?php if ($_COOKIE['mode'] == 'list') echo 'class="flip"'; ?>></a><?php } ?>
				</div>
			  
				<?php echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>';  ?>
			</div><!-- /#postFuncs -->
		        
			<div id="archive">

		       <?php get_template_part('loop-search'); ?>

<?php
if ( function_exists( 'relevanssi_didyoumean' ) )
	relevanssi_didyoumean( get_search_query(), '<h3>Did you mean?</h3><p>', '</p>', 5 );

if ( function_exists( 'relevanssi_related' ) )
    relevanssi_related( get_search_query(), '<h3>Related Searches:</h3><ul><li>' );
?>
			         
			</div><!-- /#archive -->

			<?php get_template_part( 'pagination'); ?>
			      
		</div><!-- /#content -->
		<?php if ( ! is_search() && option::get('sidebar_home') == 'off') { echo "</div>"; } ?>
		</div><!-- /.full -->
		  
		<?php if ( is_search() || option::get('sidebar_home') == 'on') { ?>
				<?php // get_sidebar(); ?>
			<?php } ?>

		<div class="cleaner">&nbsp;</div>
	</div><!-- /.wrapper -->

</div><!-- /#main -->

<?php get_footer(); ?>