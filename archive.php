<?php
/**
 * Archive
 * 文章存档
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <section class="archive-page">
            <h2>
                <?php if(is_day()) : ?>
                    <?php printf(__('<span>%s</span> 全部文章：'), get_the_date()); ?>
                <?php elseif(is_month()) : ?>
                    <?php printf(__('<span>%s</span> 全部文章：'), get_the_date('F Y')); ?>
                <?php elseif(is_year()) : ?>
                    <?php printf(__('<span>%s</span> 全部文章：'), get_the_date('Y')); ?>
                <?php elseif( is_tag() ) : ?>
                    <?php printf(__('<span>%s</span> 相关的全部文章：'), single_tag_title()); ?>
                <?php elseif ( has_post_format('status') ): ?>
                    <?php _e('@碎碎念 的微博墙 ','zws'); ?>
                <?php elseif ( has_post_format('audio') ): ?>
                    <?php _e('Type:','zws'); ?><?php _e('音乐台','zws'); ?>
                <?php elseif ( has_post_format('video') ): ?>
                    <?php _e('Type:','zws'); ?><?php _e('视频集','zws'); ?>
                <?php endif; ?>
            </h2>
        </section>
        <?php  
            rewind_posts();
            get_template_part('loop', 'archive');
        ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>