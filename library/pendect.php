<ul>
    <li><i class="righticon"></i><span>文章总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</span></li>
    <li><i class="righticon"></i><span>评论条目：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments where comment_author!='".(get_option('swt_user'))."'");?> 条</span></li>
    <li><i class="righticon"></i><span>链接总量：<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> 个</span></li>
    <li><i class="righticon"></i><span>建站日期：<?php echo get_option('swt_builddate');?></span></li>
    <li><i class="righticon"></i><span>运行天数：<?php echo floor((time()-strtotime(get_option('swt_builddate')))/86400); ?> 天</span></li>
    <li><i class="righticon"></i><span>最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></span></li>
    <li><i class="righticon"></i><span>总阅读量：<?php echo all_view();?></span></li>
</ul>