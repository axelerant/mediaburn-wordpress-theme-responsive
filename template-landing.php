<?php
/*
Template Name: Landing Page
*/
?>

<?php get_header( 'landing' ); ?>

<div id="main" class="full">

    <div class="wrapper">
  
        <div class="sep sepMenu">&nbsp;</div>

        <div id="content">
  
            <?php while (have_posts()) : the_post(); ?>

                <div class="singlepost single-page">

                    <h1><?php the_title(); ?></h1>
                
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                    
                    <p class="more"><?php edit_post_link( __('Edit this post &raquo;', 'wpzoom'), '', ''); ?></p>

                </div><!-- /.single -->

                <div class="cleaner">&nbsp;</div>

            <?php endwhile; ?>
             
			<?php if (option::get('comments_page') == 'on') { ?>
 				<?php comments_template(); ?>  
 			<?php } ?>

        </div><!-- /#content -->

        <div class="cleaner">&nbsp;</div>

    </div><!-- /.wrapper -->

</div><!-- /#main -->

<?php get_footer( 'landing' ); ?>