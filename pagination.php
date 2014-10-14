<!-- <div class="navigation">
	<?php
		/*global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
  			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text'    => __('&larr;  Previous', 'wpzoom'),
			'next_text'    => __('Next  &rarr;', 'wpzoom')
		 ) );*/
		?>
</div>  -->
<div class="navigation" data-pagination-link="<?php echo str_replace( '999999999', '%#%', get_pagenum_link( 999999999 ) ); ?>">
	<?php
		global $wp_query;
		
		$page_current = max( 1, get_query_var('paged') );
		$page_total = $wp_query->max_num_pages;
		$first_page_link = get_pagenum_link( 1 );
		$prev_page_link = get_pagenum_link( max( $page_current - 1, 1 ) );
		$next_page_link = get_pagenum_link( min( $page_current + 1, $page_total ) );
		$last_page_link = get_pagenum_link( $page_total );
		
	?>
	<a href="<?php echo $first_page_link; ?>" class="<?php echo $page_current == 1 ? 'disabled' : ''; ?>"><i class="fa fa-step-backward"></i></a>
	<a href="<?php  echo $prev_page_link; ?>" class="<?php echo $page_current == 1 ? 'disabled' : ''; ?>"><i class="fa fa-chevron-left"></i></a>
	<a href="#" class="page-goto">Page <span id="page-current"><?php echo $page_current; ?></span> of <span id="page-total"><?php echo $page_total; ?></span></a>
	<a href="<?php echo $next_page_link; ?>" class="<?php echo $page_current == $page_total ? 'disabled' : ''; ?>"><i class="fa fa-chevron-right"></i></a>
	<a href="<?php echo $last_page_link; ?>" class="<?php echo $page_current == $page_total ? 'disabled' : ''; ?>"><i class="fa fa-step-forward"></i></a>
</div>