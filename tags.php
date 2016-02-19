<?php
/**
 * Posts Archive
 * Template Name: 标签云
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <div id="posts-archive" class="post-page post">
            <header class="page-title">
                <h2><?php the_title(); ?></h2>
                <address class="page-edit">
                    <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                    <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
                </address>
            </header>
            <div class="entry">
                <div class="all-tags">
                    <?php wp_tag_cloud('smallest=14&largest=14&unit=px&number=0&orderby=count&order=DESC');?>
                </div>
            </div>
        </div>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>