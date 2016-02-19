<?php
/**
 * Page
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <article class="post-page post" id="post-<?php the_ID(); ?>">
                <header class="page-title">
                    <h2><?php the_title(); ?></h2>
                    <address class="page-edit">
                        <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                        <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
                    </address>
                </header>
                <div class="entry">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>

 <?php if (get_option('swt_adb') == 'Display') { ?>
                 <section class="pageadsense">
                    <?php echo stripslashes(get_option('swt_adbcode')); ?>
                 </section>
                 <?php { echo ''; } ?><?php } else { } ?>


        <?php comments_template('', true); ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>