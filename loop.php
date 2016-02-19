<?php
/**
 * Loop
 */
?>
<div id="loop">
<?php while(have_posts()) : the_post(); ?>
    <?php $format = get_post_format(); ?>
        <?php if ( $format != false ) :?>

                <?php if ( has_post_format( 'video' )) : ?>
                    <?php include(TEMPLATEPATH . '/library/post-video.php');?>
                <?php endif;?>
                
                <?php if ( has_post_format( 'audio' )) : ?>
                    <?php include(TEMPLATEPATH . '/library/post-audio.php');?>
                <?php endif;?>
                
                <?php if ( has_post_format( 'status' )) : ?>
                    <?php include(TEMPLATEPATH . '/library/post-status.php');?>
                <?php endif;?>
        
        <?php else : ?>      
                <?php include(TEMPLATEPATH . '/library/post-standard.php');?>
        <?php endif; ?>


<?php endwhile; ?>
    
            <nav class="page_nav">
                <div class="pagination">
                    <?php echo paginate_links(array(
                          'prev_next'          => 1,
                          'before_page_number' => '',
                          'mid_size'           => 2,
                     ));?>
                </div>
            </nav>
       
</div>