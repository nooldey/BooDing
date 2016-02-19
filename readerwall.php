<?php
/**
 * Readers
 * Template Name: 读者墙
 */
?>
<?php get_header(); ?>
<div id="wrapper">
	<div id="content">
        <article class="post post-page"  id="post-<?php the_ID(); ?>">
            <header class="page-title">
                <h2><?php the_title(); ?></h2>
                <address class="page-edit">
                    <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览','次'); } ?></span>
                    <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
                </address>
            </header>
             
            <div class="entry">
                <?php the_content('Read more...'); ?>
                <?php
                    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'admin@admin.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 49";//大家把管理员的邮箱改成你的,目的是从读者墙里面排除博客作者，最后的数字49是读者的个数，可以按照自己的情况修改！
                    $wall = $wpdb->get_results($query);
                    $maxNum = $wall[0]->cnt;
                    foreach ($wall as $comment)
                    {
                        if( $comment->comment_author_url )
                        $url = $comment->comment_author_url;
                        else $url="#";
                    $touxiang = get_avatar( $comment->comment_author_email, $size = '70', $default ,$alt=get_comment_author($id));
                        $tmp = "<li><a class=\"-sv-no-icon-\" target=\"_blank\" rel=\"nofollow\" href=\"".$url."\">".$touxiang." <em>".$comment->comment_author."</em><strong>".$comment->cnt."条</strong></a></li>";
                        $output .= $tmp;
                     }
                    $output = "<ul class=\"readerwall\">".$output."</ul>";
                    echo $output ;
                ?>
            </div>
        </article>
        <?php comments_template('', true); ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>