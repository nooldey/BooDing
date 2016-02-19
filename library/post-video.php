        
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <header class="video-title">
                <h2><i class="videoicon"></i><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?></a><?php if(is_sticky()) echo'<sup class="red-flag changecolor">推荐</sup>'; ?></h2>
            </header>
             <div class="video-entry">
                <?php
                    the_content( __( '', 'ZWS' ) );
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ZWS' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                ?>
                <!--flag-->
            </div>

        </article>