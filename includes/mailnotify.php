<?php
/**
 * WordPress评论回复邮件提醒防垃圾评论版
 * 作者：露兜
 * 博客：http://www.ludou.org/
 */

function zws_comment_mail_notify($comment_id, $comment_status) {
  // 评论必须经过审核才会发送通知邮件
  if ($comment_status !== 'approve' && $comment_status !== 1)
    return;
  $comment = get_comment($comment_id);
  if ($comment->comment_parent != '0') {
    $parent_comment = get_comment($comment->comment_parent);
    // 邮件接收者email      
    $to = trim($parent_comment->comment_author_email);
    // 邮件标题
    $subject = '您收到来自[' . get_option("blogname") . ']的动态消息';
    // 邮件内容，自行修改，支持HTML
    $message = '
<div style="border:1px solid #AAAAAA;background:#f5f5f5;line-height:35px;padding:20px;border-radius:8px;font-size: 14px;width:600px;margin:0 auto;">
      <h2 style="background:#52b8cb;color:#f5f5f5;font-size:16px;line-height:20px;text-shadow:1px 1px 5px #b1b1b1;font-weight:normal;padding:10px;">您在 <font style="font-weight:700;"> ' . get_option('blogname') . '</font> 的评论有新回复啦！</h2>
      <p><font color="#52b8cb">' . $parent_comment->comment_author . '</font> 童鞋，你曾经在《' . get_the_title($comment->comment_post_ID) . '》留言说：</p> 
      <p style="background-color: #DDD;padding:5px 8px;margin:5px 15px;text-indent:2em;">'. $parent_comment->comment_content . '</p> 
      <p><font color="#52b8cb">' . $comment->comment_author . '</font> 给你的回应是：</p> 
      <p style="background-color: #DDD;padding:5px 8px;margin:5px 15px;text-indent:2em;">' . $comment->comment_content . '</p> 
      <p>猛击这里：<a href="' . htmlspecialchars(get_comment_link($comment->comment_parent)) . '"><font color="#52b8cb">查看完整评论</font></a>， 欢迎再次访问<a href="'.home_url().'"><font color="#52b8cb">' . get_option('blogname') . '</font></a></p>
      <p>（此邮件由系统自动发送，请勿回复）</p> 
    </div>';
    $message_headers = "Content-Type: text/html; charset=\"".get_option('blog_charset')."\"\n";
    // 不用给不填email的评论者和管理员发提醒邮件
    if($to != '' && $to != get_bloginfo('admin_email'))
      @wp_mail($to, $subject, $message, $message_headers);
  }
}
// 编辑和管理员的回复直接发送提醒邮件，因为编辑和管理员的评论不需要审核
add_action('comment_post', 'zws_comment_mail_notify', 20, 2);
// 普通访客发表的评论，等博主审核后再发送提醒邮件
add_action('wp_set_comment_status', 'zws_comment_mail_notify', 20, 2);
?>