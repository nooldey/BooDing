        <article <?php post_class(); ?> id="post-<?php the_ID(); ?> ">
            <header class="post-title">
                <h2><i class="posticon"></i><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>">
                         <?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>
                    </a><?php if(is_sticky()) echo'<sup class="red-flag changecolor stickyicon"></sup>'; ?>
                </h2>
            </header>
            <?php if(post_password_required()) { ?>
                 <span class="comments-link"><a href="<?php the_permalink() ?>" title="请输入密码后查看评论！">X</a></span>
                 <?php } else { ?>
                <span class="comments-link"><?php comments_popup_link('0','1','%'); ?></span>
            <?php } ?>
            <address class="entry-meta">
                <p>
                    <span class="entry-author"><?php the_author_posts_link(''); ?></span>  
                    <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('',' views'); } ?></span>
                    <span class="entry-edit"><?php edit_post_link('编辑', '[', ']'); ?></span>
                </p>
            </address>
            <?php if(is_home() || is_archive() || is_search()) : ?>
            <div class="entry">
                <?php include('thumbnail.php');?>
                 <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 480,"…"); ?>
            </div>
            <footer class="entry-footer">
                <p>
                <span class="entry-date"><?php the_time('Y-m-d'); ?></span> 
                <span class="entry-category"><?php the_category(','); ?></span> 
                <span class="entry-tags"><?php the_tags(''); ?></span>
                </p>
            </footer>
            <?php endif; ?>
        </article>