<?php
/**
 * Single
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <div id="page-path">
            <div id="single-path">
                <i class="pathicon"></i>
                <a href="<?php bloginfo('home'); ?>">首页</a>
                <i class="righticon"></i>
                <?php $categorys = get_the_category(); $category = $categorys[0]; echo(get_category_parents($category->term_id, true, '')); ?>
                <i class="righticon"></i>
                <?php $title = get_post($id)->post_title; echo mb_strimwidth($title, 0, 80, '...'); ?>
            </div>
            <div id="singleshare"><!--分享开始-->
<div class="bdsharebuttonbox"><a class="bds_more" href="#" data-cmd="more"></a><a title="分享到QQ空间" class="bds_qzone" href="#" data-cmd="qzone"></a><a title="分享到新浪微博" class="bds_tsina" href="#" data-cmd="tsina"></a><a title="分享到微信" class="bds_weixin" href="#" data-cmd="weixin"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"3248313767"},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>                
   <!--分享结束-->
            </div>
        </div>

        <?php while(have_posts()) : the_post(); ?>
        <article <?php post_class(); ?> id="post-single">
            <h2 class="post-title"><?php the_title(); ?></h2>
            <address class="entry-meta">
                <p>
                <span class="entry-date"><?php the_time('Y-m-d'); ?></span>  
                <span class="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                <span class="entry-edit"><?php edit_post_link('编辑','[',']'); ?></span>
                </p>
            </address>          
            <div class="entry">
                <?php the_content(); ?>
                <section>
                  <p>
                  PS：除特别声明外，本站文章均为原创作品，允许摘录或者全文转载，全部或部分转载本站内容，请注明作品来源于【碎碎念ZWS】：<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_permalink() ?></a>
                  </p>
                </section>
                <section class="qrimg">
                   （手机扫描二维码有惊喜哟！）
                    <img style="height:8em;width:8em;" src="http://qr.liantu.com/api.php?w=220&m=0&text=<?php the_permalink() ?>" alt="qr" />
                </section>
            </div>
            <footer class="single-entry">
                <span class="entry-category"><?php the_category(','); ?></span> 
                <span class="entry-tags"><?php the_tags(''); ?></span>
            </footer>
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


            <?php
                $post_tags = wp_get_post_tags($post->ID);
                if ($post_tags) {
                foreach ($post_tags as $tag){
                $tag_list[] .= $tag->term_id;
                }
                $post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
                $args = array(
                'tag__in' => array($post_tag),
                'category__not_in' => array(NULL),      
                'post__not_in' => array($post->ID),
                'showposts' => 10,               
                'caller_get_posts' => 1
                );
                query_posts($args);
                if (have_posts()) : ?>
        <section id="related">
            <h3 class="related-title"><i class="attachicon"></i>相关文章</h3>
            <div id="tags-related">
            <?php while (have_posts()) : the_post(); update_post_caches($posts); ?>
                <li><i class="righticon"></i> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            </div>
        </section>
        <?php else : ?>
            <?php echo'';?>
            <?php endif; wp_reset_query(); } ?>

       <?php comments_template(); ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>