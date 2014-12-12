<?php get_header(); ?>

<?php
	// Custom Post Options
	// $template 		 = get_post_meta($post->ID, 'wpzoom_post_template', true);
	$template 		 = 'full';
	// $videolocation 	 = get_post_meta($post->ID, 'wpzoom_post_embed_location', true);
	$videolocation 	 = 'In the middle column';
	$videotype 		 = get_post_meta($post->ID, 'wpzoom_video_type', true);
	$videoexternal 	 = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
	$videoselfhosted = get_post_meta($post->ID, 'wpzoom_post_embed_self', true);
	$video_hd 		 = get_post_meta($post->ID, 'wpzoom_post_embed_hd', true);
  	$skin			 = strtolower(get_post_meta($post->ID, 'wpzoom_post_embed_skin', true));
 ?>

<div id="main"<?php if ($template == 'full') {echo' class="full"';} elseif ($template == 'side-left') {echo' class="invert"';} ?>>

    <div class="wrapper">

		<?php while (have_posts()) : the_post();

			$image = get_the_image( array( 'size' => 'large',  'image_scan' => false, 'echo' => false, 'format' => 'array' ) );
			if (!empty ($image)) { 	$url = $image['src']; }

		?>
 		<?php if ($videolocation == 'Before everything else') { ?>


 			<?php if ($videotype == 'external') {
 					if (strlen($videoexternal) > 1) { // Embedding video from external site
						$videoexternal = embed_fix($videoexternal,920,518); // add wmode=transparent to iframe/embed
						?>
						<div class="zoomVideo zoomVideoBig"><?php echo "$videoexternal"; ?></div>
						<?php
						}
					}
			else {
				if (strlen($videoselfhosted) > 1 && $videotype == 'selfhosted') { // Embed self-hosted video using JW Player
   				?>
				<div class="zoomVideo zoomVideoBig">
 
					<div id='jw_video'>Video</div>
					<script type='text/javascript'>
					  jwplayer('jw_video').setup({
						'file': '<?php echo "$videoselfhosted"; ?>',
						'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
						<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
						'width': '925',
						'height': '518',
						'stretching': 'fill',
 						<?php if (strlen($video_hd) > 1) { ?>'plugins': {
						   'hd-1': {
							   'file': '<?php echo "$video_hd"; ?>'
						   }
						}, <?php } ?>
						'modes': [
							{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
							{type: 'html5'}				 
						]
					  });
					</script>
				</div>
				<?php }
			} ?>

      	<?php } else { ?>
       	  <div class="sep sepMenu">&nbsp;</div>
       	<?php } ?>

		<div id="content">

			<?php if (option::get('meta_sidebar') == 'off') { echo "<div class=\"no_meta\">"; } ?>

 			<div id="post-<?php the_ID(); ?>" <?php post_class('singlepost'); ?>>

				<?php if ($videolocation == 'In the middle column' && $template != 'full') {
 					if ($videotype == 'external') {
 						if (strlen($videoexternal) > 1) { // Embedding video from external site

						$videoexternal = embed_fix($videoexternal,570,320); // add wmode=transparent to iframe/embed
						echo "<div class=\"zoomVideo\">$videoexternal</div>"; }
					}
					else {
						if (strlen($videoselfhosted) > 1) { // Embed self-hosted video using JW Player
  						?>
							<div class="zoomVideo">
								<div id='jw_video'>Video</div>
								<script type='text/javascript'>
								  jwplayer('jw_video').setup({
									'file': '<?php echo "$videoselfhosted"; ?>',
									'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
									<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
									'width': '570',
									'height': '320',
									'stretching': 'fill',
									<?php if (strlen($video_hd) > 1) { ?>'plugins': {
									   'hd-1': {
										   'file': '<?php echo "$video_hd"; ?>'
									   }
									}, <?php } ?>
									'modes': [
										{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
										{type: 'html5'}
 									]
								  });
								</script>
							</div>
						<?php }
					}
	            } ?>
	          	<p class="postmetadata"><?php if (option::get('post_author') == 'on') { ?><?php _e('Posted by', 'wpzoom') ?> <?php the_author_posts_link(); } ?><?php if (option::get('post_author') == 'on' && option::get('post_date') == 'on') { ?> <?php _e('on', 'wpzoom') ?> <?php } ?><?php if (option::get('post_date') == 'on') { ?> <?php printf('%s at %s', get_the_date(), get_the_time()); } ?></p>
	         	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

					<?php if ($videolocation == 'In the middle column' && $template == 'full') {
	 					if ($videotype == 'external') {
	 						if (strlen($videoexternal) > 1) { // Embedding video from external site
							// $videoexternal = embed_fix($videoexternal,818,460); // add wmode=transparent to iframe/embed
								$find				= '&autoplay=true';
								$ap_off				= '&autoplay=false';
								$api_on				= 'apiOn=true';
								if ( strripos( $videoexternal, $find ) ) {
									// MB remove autoplay
									$videoexternal		= str_replace( $find, $ap_off, $videoexternal );
									// $videoexternal		= str_replace( $find, '', $videoexternal );

									update_post_meta( get_the_ID(), 'wpzoom_post_embed_code', $videoexternal );
								} elseif ( strripos( $videoexternal, $ap_off ) ) {
									$videoexternal		= str_replace( $ap_off, '', $videoexternal );

									update_post_meta( get_the_ID(), 'wpzoom_post_embed_code', $videoexternal );
								} elseif ( false && strripos( $videoexternal, $api_on ) && ! strripos( $videoexternal, $ap_off ) ) {
									$videoexternal		= str_replace( $api_on, $api_on . $ap_off, $videoexternal );

									update_post_meta( get_the_ID(), 'wpzoom_post_embed_code', $videoexternal );
								}
								echo "<div class=\"zoomVideo\">$videoexternal</div>";
							}
							else {
								if ( 'video' == $post->post_type ) {
									post_thumbnail();
									echo "<h4>This videotape is not yet digitized. Please <a href='/contact/'>email us</a> to let us know you're interested in watching it, and we'll see if we're able to make it available online sooner.</h4>";
								}
							}
							} else {
					  	if (strlen($videoselfhosted) > 1) { // Embed self-hosted video using JW Player
 						?>
						<div class="zoomVideo">
							<div id='jw_video'>Video</div>
							<script type='text/javascript'>
							  jwplayer('jw_video').setup({
								'file': '<?php echo "$videoselfhosted"; ?>',
								'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
								<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
								'width': '818',
								'height': '460',
								'stretching': 'fill',
								<?php if (strlen($video_hd) > 1) { ?>'plugins': {
								   'hd-1': {
									   'file': '<?php echo "$video_hd"; ?>'
								   }
								}, <?php } ?>
								'modes': [
									{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
									{type: 'html5'}
 								]
							  });
							</script>
						</div>
						<?php }
							else {
								if ( 'video' == $post->post_type ) {
									post_thumbnail();
									echo "<h4>This videotape is not yet digitized. Please <a href='/contact/'>email us</a> to let us know you're interested in watching it, and we'll see if we're able to make it available online sooner.</h4>";
								}
							}
					}
	             } ?>



	         	<div class="entry">
<?php
	if ( get_post_meta( get_the_ID(), 'wpzoom_post_embed_code', true ) ) {
		$seconds				= 0;
		$startPointJS			= '';
		$content				= '<p>';
		$content				.= '<em class="chapter" onclick="';

		$startPoint				= get_post_meta( get_the_ID(), 'video_start_point', true );
		if ( $startPoint ) {
			$startPoint			= trim( $startPoint );
			$seconds			= time2seconds( $startPoint );
			$startPointJS		= 'playVzaarVideoAt(' . $seconds . ');';
		} else {
			$startPoint			= 0;
			$startPointJS		= 'playVzaarVideo();';
		}

		$content				.= $startPointJS;
		$content				.= '">' . __( 'Skip to program start', 'fitv' );
		$content				.= '</em>';
		// $content				.= Fitv_Theme::fitv_copy_time_url( $startPoint );
		$content				.= '</p>';

		$url_time = ! empty( $_REQUEST['t'] ) && preg_match( '#^\d+(:\d+)+$#', $_REQUEST['t'] ) ? $_REQUEST['t'] : false;
		if ( $url_time ) {
			$time				= trim( $url_time );
			$seconds			= time2seconds( $time );
			$startPointJS		= 'playVzaarVideoAt( ' . $seconds . ' );';
		}

		Fitv_Theme::$startPointJS = $startPointJS;

		// echo $content;

		add_action( 'wp_footer', array( 'Fitv_Theme', 'fitv_footer_javascript' ), 20 );
	}

$excerpt						= get_post_field( 'post_excerpt', $post->ID );
if ( $excerpt ) {
	echo '<p><em>';
	echo $excerpt;
	echo '</p></em>';
}
?>
<?php
$do_contextly = false;
global $contextly;
if ( ! empty( $contextly ) && is_object( $contextly ) && 'Contextly' == get_class( $contextly ) ) {
	remove_action( 'the_content', array( $contextly, 'addSnippetWidgetToContent' ) );
	$do_contextly = true;
}
?>
	 				<?php the_content(); ?>
<?php
$document_assets				= get_field('document_assets', $post->ID);
$temp_post						= $post;
if ( ! empty( $document_assets ) ) {
	echo '<h3>' . __( 'Related Documents', 'fitv' ) . '</h3>';
	echo '<ul>';
	$documents					= explode( ',', $document_assets );
	foreach ( $documents as $id ) {
		echo '<li>';
		$title					= get_the_title( $id );
		echo '<a href="' . get_permalink( $id ) . '" ' . 'title="' . $title . '">' . $title . '</a>';
		$excerpt				= get_post_field( 'post_excerpt', $id );
		if ( $excerpt ) {
			echo ' ';
			echo '<em>';
			echo $excerpt;
			echo '</em>';
		}
		echo '</li>';
	}
	echo '</ul>';
}
$post							= $temp_post;

$document_options				= get_field('document_options', $post->ID);
if ( ! empty( $document_options ) )
	echo $document_options;

$document_embed					= get_field('document_embed', $post->ID);
if ( ! empty( $document_embed ) )
	echo $document_embed;
?>
				</div>

<?php
if ( $do_contextly ) {
	echo $contextly->getSnippetWidget();
}
?>

	         	<?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	         	<p class="more"><?php edit_post_link( __('Edit this post &raquo;', 'wpzoom'), '', ''); ?></p>

       		</div><!-- /.singlepost -->

			<?php if (option::get('meta_sidebar') == 'on') { // Show Meta Sidebar? ?>
	 			<div class="postmetadata">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Top Sidebar') ) : ?> <?php endif; ?>

<?php
// Main credits, additional credits, date notation (or production date if that is advantageous)
$parts							= array(
	'main_credits' 				=> __('Main Credits', 'fitv'),
	'additional_credits' 		=> __('Additional Credits', 'fitv'),
	'performers' 				=> __('Performers', 'fitv'),
	'date_notation' 			=> __('Date', 'fitv'),
	'staff_comments' 			=> __('Staff and Producer Comments', 'fitv'),
	'running_time' 				=> __('Running Time', 'fitv'),
	'number_of_pages' 			=> __('Number of Pages', 'fitv'),
	'video_tape_format' 		=> __('Video Tape Format', 'fitv'),
	'document_type' 			=> __('Document Type', 'fitv'),
	// 'generation' 				=> __('Generation', 'fitv'),
);

custom_meta_sidebar( $post, $parts );
?>

					<?php if (option::get('post_share') == 'on') { // Show Social Icons? ?>
						<div class="section">
						<h3><?php _e('Share this post', 'wpzoom') ?></h3>

						  	<ul class="wpzoomSocial">
								<li><a href="http://twitter.com/share" data-url="<?php the_permalink() ?>" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>

								<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=1000&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe></li>

								<li><g:plusone size="medium"></g:plusone></li>
 						 	</ul>
							<div class="cleaner">&nbsp;</div>
						</div>
	 				<?php } // if social icons should be shown ?>

					<?php if (option::get('post_category') == 'on') {  // Show Category? ?>
						<div class="section">
							<h3><?php _e('Categories', 'wpzoom') ?></h3>
							<?php the_category(', '); ?>
						</div>
	 				<?php } ?>

<?php
$producer						= custom_get_the_terms( $post, 'producer' );
if ( ! empty( $producer ) ) {
	echo '<div class="section">';
	echo '<h3>';
	_e('Producers', 'fitv');
	echo '</h3>';
	echo $producer;
	echo '</div>';
}
?>

<?php
$collection						= custom_get_the_terms( $post, 'collection' );
if ( ! empty( $collection ) ) {
	echo '<div class="section">';
	echo '<h3>';
	_e('Collection', 'fitv');
	echo '</h3>';
	echo $collection;
	echo '</div>';
}
?>

<?php
$genre							= custom_get_the_terms( $post, 'genre' );
if ( ! empty( $genre ) ) {
	echo '<div class="section">';
	echo '<h3>';
	_e('Genre', 'fitv');
	echo '</h3>';
	echo $genre;
	echo '</div>';
}
?>

<?php
$production_date							= custom_get_the_terms( $post, 'production_date' );
if ( ! empty( $production_date ) ) {
	echo '<div class="section">';
	echo '<h3>';
	_e('Production Date', 'fitv');
	echo '</h3>';
	echo $production_date;
	echo '</div>';
}
?>

<?php
$publication_date							= custom_get_the_terms( $post, 'publication_date' );
if ( ! empty( $publication_date ) ) {
	echo '<div class="section">';
	echo '<h3>';
	_e('Publication Date', 'fitv');
	echo '</h3>';
	echo $publication_date;
	echo '</div>';
}
?>

	 				<?php if (option::get('post_tags') == 'on') { // Show Tags??>
						<?php the_tags( '<div class="section tags"><h3>'.__('Tags', 'wpzoom').'</h3>', ' ', '<div class="cleaner">&nbsp;</div></div>'); ?>
	 				<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Sidebar') ) : ?> <?php endif; ?>

				</div><!-- /.postmetadata -->
			<?php } // if meta sidebar is shown ?>

   			<?php if (option::get('meta_sidebar') == 'off') { echo "</div>"; } ?>
       		<div class="cleaner">&nbsp;</div>

	        <?php if (option::get('post_comments') == 'on') {
		        comments_template();
		        } ?>

      	</div><!-- /#content -->

     	<?php if ($template != 'full') { get_sidebar(); } ?>
  		<div class="cleaner">&nbsp;</div>

	<?php endwhile; ?>
	</div><!-- /.wrapper -->
</div><!-- /#main -->

<?php get_footer(); ?>