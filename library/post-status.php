        <article <?php post_class(); ?> id="post-<?php the_ID(); ?> ">
            <section class="format-status">
                <aside class="status-avatar">
                    <span class="status-span">
                        <?php $author_email = get_the_author_email();echo get_avatar($author_email, '64',$default,$alt=get_the_author($id));?>
                    </span>
                </aside>
                <?php if(is_home() || is_archive() || is_search()) : ?>
                <div class="status-entry">
                    <i class="twittericon"></i><?php the_author_posts_link(''); ?> ：<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"…"); ?>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="评论这条说说《<?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>》" class="changecolor">【评论一下】</a>
                </div>
                <?php endif; ?>
            </section>
        </article>