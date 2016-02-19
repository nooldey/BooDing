<aside id="sidebar">

 <section class="widget">
        <h3 class="widgettitle"><i class="widgeticon"></i>关注本站</h3>
        <?php include(TEMPLATEPATH . '/library/searchform.php') ?>
        <div class="clear"></div>
    </section>

<?php if (get_option('swt_ada') == 'Display') { ?>
    <section class="widget adsense">
        <?php echo stripslashes(get_option('swt_adacode')); ?>
        <?php { echo ''; } ?>
    </section>
        <?php } else { } ?>

    <section class="widget">
        <h3 class="widgettitle"><i class="navicon"></i>更多</h3>
        <div class="footnav">
            <?php if(function_exists('wp_nav_menu')) { wp_nav_menu(array('theme_location'=>'footnav','menu_id'=>'sidenav','container'=>'ul'));}?>
        </div>
        <div class="clear"></div>
    </section>

    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具1') ) : ?><?php endif; ?>
    
    <section class="widget top_views">
        <?php require_once(TEMPLATEPATH . '/library/topviews.php');//最热阅读 ?>
    </section>

    <section class="widget r_comment">
        <?php require_once(TEMPLATEPATH . '/library/r_comment.php');//最新评论 ?>
    </section>

    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具2') ) : ?><?php endif; ?>

    <section class="widget">
        <h3 class="widgettitle"><i class="widgeticon"></i>网站概况</h3>
        <?php include_once(TEMPLATEPATH . '/library/pendect.php') ?>
        <div class="clear"></div>
    </section>

    <?php wp_reset_query();if(is_home() ){?>
    <section class="widget">
        <h3 class="widgettitle"><i class="vlinks"></i>友情链接</h3>
        <div class="mylinks">
            <ul>
                <?php 
                    $linkscat = get_option('swt_linkscat');
                    wp_list_bookmarks('orderby=link_id&category='.$linkscat.'&categorize=0&title_li');?>
            </ul>
        </div>
    </section>
    <?php } ?>



</aside>