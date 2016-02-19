<?php
//回复内容可见				
function ATheme_reply_to_read($atts, $content=null) {
        extract(shortcode_atts(array("notice" => '<p class="yincang-tag">此处内容需要您<a href="#respond" title="去评论">[ 评论本文 ]</a>后才能查看!</p>'), $atts));  
        $email = null;   
        $user_ID = (int) wp_get_current_user()->ID;   
        if ($user_ID > 0) {   
            $email = get_userdata($user_ID)->user_email;   
            //对博主直接显示内容   
            $admin_email = get_bloginfo ('admin_email');  
			
            if ($email == $admin_email) {   
                return $content;   
            }   
        } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {   
            $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);   
        } else {   
            return $notice;   
        }   
        if (empty($email)) {   
            return $notice;   
        }   
        global $wpdb;   
        $post_id = get_the_ID();   
        $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";   
        if ($wpdb->get_results($query)) {   
            return do_shortcode($content);   
        } else {   
            return $notice;   
        }   
    }   
	
add_shortcode('reply', 'ATheme_reply_to_read');

//音乐播放器
function doubanplayer($atts, $content=null){
	extract(shortcode_atts(array("auto"=>'0'),$atts));
	return '<embed src="'.get_bloginfo("template_url").'/images/shortcode/doubanplayer.swf?url='.$content.'&amp;autoplay='.$auto.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="400" height="30">';
	}
add_shortcode('music','doubanplayer');

//下载链接
function downlink($atts,$content=null){
	extract(shortcode_atts(array("href"=>'http://'),$atts));
	return '<div class="but_down"><a href="http://zhuweisheng.com.cn/r?url='.base64_encode($href).'" title="'.$content.'" alt="'.$content.'" target="_blank"><span>'.$content.'</span></a><div class="clear"></div></div>';
	}
	add_shortcode('Downlink','downlink');

function lomo_Shortpage(){
?>
<div class="wrap">
  <h2>主题短代码</h2>
    <div style="margin:10px;font-size:15px;">
  	    <p>写文章时如果需要可以加入下列短代码（在“可视化”与“HTML”两种模式均可直接加入）</p>
        <section style="marign:10px;padding:10px 0;">
        <strong style="margin:5px;">下载样式</strong>
        <code style="background:none;display:block;text-indent:2em;padding:5px 8px;">[Downlink href="http://www.xxx.com/xxx.zip"]download[/Downlink]</code>
      </section>
      <section style="marign:10px;padding:10px 0;">
        <strong style="margin:5px;">回复显示</strong>
        <code style="background:none;display:block;text-indent:2em;padding:5px 8px;">[reply]隐藏内容[/reply]</code>
    </section>
    <section style="marign:10px;padding:10px 0;">
        <strong style="margin:5px;font-weight:700;color:#ccc;">通用音乐播放器</strong>
        <br/><strong style="margin:5px;">默认不自动播放：</strong>
        <code style="background:none;display:block;text-indent:2em;padding:5px 8px;">[music]http://www.xxx.com/xxx.mp3[/music]</code>
        <br/><strong style="margin:5px;">自动播放:</strong>
        <code style="background:none;display:block;text-indent:2em;padding:5px 8px;">[music auto=1]http://www.xxx.com/xxx.mp3[/music]</code>
      </section>
    </div>
</div>
<?php }
function lomo_shortcode_page(){
  add_theme_page("短代码提示","短代码提示",'edit_themes','lomo_shortcode_page','lomo_Shortpage'); 
}
add_action('admin_menu','lomo_shortcode_page');

?>