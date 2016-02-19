<h3 class="widgettitle"><i class="topviews"></i>热门月榜</h3>
<ul>
        <?php
        $args = array(
            'posts_per_page' => 8,//文章数
            'meta_key' => 'views',
            'orderby' => 'meta_value_num',
            'date_query' => array(
                array(
                    'after'  => '2 month ago',//时间范围
                ))
        );
        $postslist = get_posts( $args );
        foreach ( $postslist as $post ) :
            setup_postdata( $post ); ?>
            <li><i class="righticon"></i>
                <a href="<?php the_permalink(); ?>" title="<?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 26, '...'); ?></a>
                <span class="grey-span"> - <?php if ( function_exists('post_views') ) post_views($post->ID);//如果安装的是插件就换成插件的调用方法 ?></span>
            </li>
        <?php endforeach;
        wp_reset_postdata(); ?>
</ul>