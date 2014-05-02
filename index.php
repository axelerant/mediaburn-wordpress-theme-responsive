<?php get_header(); ?>
<?php global $loop_blog_ids; ?>
 
<div id="main">
  
    <div class="wrapper">
    	<!-- >>> CHANGED BY DEZIO1900
    		- added menu php code logic
    		- added .vertical-menu-wrapper and vertical-menu-container
    	-->
    	<?php 
    		$show_sidebar = is_active_sidebar( 'homepage-slider-sidebar' );
    	?>
    	<div class="<?php echo $show_sidebar ? 'homepage-slider-with-sidebar-wrapper' : ''; ?>">
			<?php if( $show_sidebar ) : ?>
			<ul>
				<?php dynamic_sidebar( 'homepage-slider-sidebar' ); ?>
			</ul>
			<?php endif; ?>
			<?php if ($paged < 2) { 
				if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; }
				
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Content Widgets') ) : ?> <?php endif; ?>
				
				<?php if (option::get('sidebar_home') == 'off') { echo "</div>"; }
			} // if $paged < 2 ?> 
		           
			<?php if (option::get('featured_enable') == 'on' && is_home() && $paged < 2) { get_template_part('wpzoom', 'slider'); } // Show the Featured Slider? ?>
		</div>
		<!-- <<< CHANGED BY DEZIO1900 -->
		
		<?php if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>

		<div id="content">

			<?php if (option::get('recent_posts') == 'on') { // Display Recent Posts ?>
	 				
				<?php
					global $query_string; // required

					/* Exclude categories from Recent Posts */
					if (option::get('recent_part_exclude') != 'off') {
						if (count(option::get('recent_part_exclude'))){
							$exclude_cats = implode(",-",option::get('recent_part_exclude'));
							$exclude_cats = '-' . $exclude_cats;
							$args['cat'] = $exclude_cats;
						}
					}

					/* Exclude featured posts from Recent Posts */
					if (option::get('hide_featured') == 'on') {
						
						/*
						$featured_posts = new WP_Query( 
							array( 
								'post__not_in' => get_option( 'sticky_posts' ),
								'posts_per_page' => option::get('slideshow_posts'),
								'post_type' => 'video',
								'meta_key' => 'wpzoom_is_featured',
								'meta_value' => 1				
								) );
							
						while ($featured_posts->have_posts()) {
							$featured_posts->the_post();
							global $post;
							$postIDs[] = $post->ID;
						}
						$args['post__not_in'] = $postIDs;
						*/
						$args['post__not_in'] = $loop_blog_ids;
					}

					$args['paged'] = $paged;
					/*
					if (count($args) >= 1) {
						query_posts($args);
					}
					*/
					?>

					<?php if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>
				      
<?php
					// show 2 blog posts only on home page
					if (is_home() && $paged < 2) {
						$posts_per_page_orig = $args['posts_per_page'];
						$args['posts_per_page'] = 2;

						$category_name_orig = $args['category_name'];
						$args['category_name'] = 'blog';
						$args['post_type'] = 'post';

						if (!empty($args)) {
							$posts = get_posts($args);
						}

						get_template_part('wpzoom', 'blog'); // Show the Blog
						// t3vb_get_template_part_cache('wpzoom', 'blog'); // Show the Blog

						/*
						// don't include the blogs again
						if ( empty( $loop_blog_ids ) ) {
							// $loop_blog_ids = get_transient( 'videozoom_loop_blog_ids' );
							$loop_blog_ids = array();
						}
						*/
						$args['post__not_in'] = is_array( $args['post__not_in'] ) ? $args['post__not_in'] : array();
						$args['post__not_in'] = array_merge( $args['post__not_in'], $loop_blog_ids );
						// $args['posts_per_page'] = $posts_per_page_orig;
						$args['posts_per_page'] = get_option( 'posts_per_page' );
						$args['category_name'] = $category_name_orig;
					} else {
						$args['posts_per_page'] = get_option( 'posts_per_page' );
					}
?>
	           
					<div id="postFuncs">
						<div id="funcStyler">
							<?php if (option::get('post_switcher') == 'on') { ?><a href="javascript: void(0);" id="mode" <?php if ($_COOKIE['mode'] == 'list') echo 'class="flip"'; if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'Grid') { echo ' '; }  if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'List') { echo 'class="flip"';}?>></a><?php } ?>
						</div>
					  
						<?php if (!is_home()) { 
								echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>'; 
							} 
				            else { ?>
								<h2><?php echo option::get('recent_title'); ?></h2>
				            <?php } ?>
					</div><!-- /#postFuncs -->
				        
					<div id="archive">
				        
<?php
					if (!empty($args)) {
						$args['post_type'] = array( 'post', 'video', 'document' );
						$posts = get_posts($args);
					}

					get_template_part('loop');
?>
				         
					</div><!-- /#archive -->

					<?php get_template_part( 'pagination'); ?>

				<?php } // Display Recent Posts ?>
			      
			</div><!-- /#content -->
			<?php if (option::get('sidebar_home') == 'off') { echo "</div>"; } ?>
          
		<?php if (option::get('sidebar_home') == 'on') { ?>
		 
			<?php get_sidebar(); ?>
 		 
		<?php } ?>
 
      	<div class="cleaner">&nbsp;</div>
    </div><!-- /.wrapper -->

</div><!-- /#main -->

<?php get_footer(); ?>