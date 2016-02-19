<?php
/**
 * attachment
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <?php while(have_posts()) : the_post(); ?>
        <article class="post" id="post-single">
            <h2 class="post-title"><?php the_title(); ?></h2>
            <address class="entry-meta">
                <p>
                <span class="entry-date"><?php the_time('Y-m-d'); ?></span>  
                <span class="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                <span class="entry-edit"><?php edit_post_link('编辑','[',']'); ?></span>
                </p>
            </address>
            <div class="entry">
                <p class="attachment">
                    <a href="<?php echo wp_get_attachment_url($post->ID); ?>">
                        <?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?>
                    </a>
                </p>
            </div>
           
        </article>
        <?php endwhile; ?>

                 <section id="author-page">
                    <span class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'),'64',$default,$alt=get_the_author($id) );?></span>
                    <span class="author-name author-data"><b>作者</b>：<?php the_author_posts_link(''); ?></span>
                    <span class="author-description author-data"><b>简介</b>：<?php the_author_description(); ?></span>
                 </section>

                 <?php if (get_option('swt_adb') == 'Display') { ?>
                 <section class="pageadsense">
                    <?php echo stripslashes(get_option('swt_adbcode')); ?>
                 </section>
                 <?php { echo ''; } ?><?php } else { } ?>
       <?php comments_template(); ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>