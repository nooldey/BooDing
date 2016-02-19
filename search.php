<?php
/**
 * Search
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <?php if(have_posts()) : ?>
        <section id="search-keywords">
            <h3>包含关键词“<span class="changecolor"><?php the_search_query(); ?></span>”的所有文章：</h3>
        </section>
        <?php get_template_part('loop', 'search'); ?>
        <?php else : ?>
        <article class="post">
            <div id="no-post">
                <h3>没有找到</h3>
                    <p class="entry">非常抱歉，没有找到您所请求的内容！你可以换个关键词搜索，或者阅读下面的文章。</p>
                <div id="search-related">
                        <h3>试试手气：</h3>
                        <?php  
                            $rand_posts = get_posts('numberposts=15&orderby=rand');
                            foreach($rand_posts as $post) : ?>
                        <li>
                            <i class="righticon"></i>  <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                        </li>
                            <?php endforeach; ?>
                </div>
            </div>
        </article>
        <?php endif; ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>