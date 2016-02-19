<?php
/**
 * Posts Archive
 * Template Name: 文章归档
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <article id="posts-archive" class="post-page post">
            <header class="page-title">
                <h2><?php bloginfo('name'); ?>已发表文章：  <?php echo $hacklog_archives->PostCount();?>篇</h2>
		<address class="page-edit">
                <span class="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                </address>
            </header>
            <div class="entry">
                <?php echo $hacklog_archives->PostList();?>
            </div>
        </article>
    </div>
<?php get_sidebar(); ?>
</div>
    <script type="text/javascript">
        /* <![CDATA[ */
            jQuery(document).ready(function() {
                function setsplicon(c, d) {
                    if (c.html()=='+' || d=='+') {
                        c.html('-');
                        c.removeClass('car-plus');
                        c.addClass('car-minus');
                    } else if( !d || d=='-'){
                        c.html('+');
                        c.removeClass('car-minus');
                        c.addClass('car-plus');
                    }
                }
                jQuery('.car-collapse').find('.car-yearmonth').click(function() {
                    jQuery(this).next('ul').slideToggle(500);
                    setsplicon(jQuery(this).find('.car-toggle-icon'));
                });
                jQuery('.car-collapse').find('.car-toggler').click(function() {
                    if ( '展开所有月份' == jQuery(this).text() ) {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').show(500);
                        jQuery(this).text('折叠所有月份');
                       setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '+');
                    }
                    else {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').hide(500);
                        jQuery(this).text('展开所有月份');
                        setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '-');
                    }
                    return false;
                });
            });
        /* ]]> */
    </script>
<?php get_footer(); ?>
