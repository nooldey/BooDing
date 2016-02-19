<?php
    include("includes/theme_options.php");
    require_once(TEMPLATEPATH . '/includes/archive-function.php');
    include("includes/shortcode.php");
    include("includes/mailnotify.php");

/**
* Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
}

//移除谷歌sans字体
function remove_open_sans() { 
wp_deregister_style( 'open-sans' ); 
wp_register_style( 'open-sans', false ); 
wp_enqueue_style('open-sans',''); 
} 
add_action( 'init', 'remove_open_sans' );


/*禁止中英文符号自动转换*/
remove_filter('the_content', 'wptexturize');

// 取消站内pingback 源自No Self Pings
function no_self_ping( &$links ) {
$home = get_option( 'home' );
foreach ( $links as $l => $link )
if ( 0 === strpos( $link, $home ) )
unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//使用昵称替换用户名，通过用户ID进行查询
add_filter( 'request', 'ssn_request' );
function ssn_request( $query_vars )
{
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='first_name' AND meta_value = %s", $query_vars['author_name'] ) );
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}
//使用昵称替换链接中的用户名
add_filter( 'author_link', 'ssn_author_posts_link', 10, 3 );
function ssn_author_posts_link( $link, $author_id, $author_nicename )
{
    $author_first_name = get_user_meta( $author_id, 'first_name', true );
    if ( $author_first_name ) {
        $link = str_replace( $author_nicename, $author_first_name, $link );
    }
    return $link;
}

/*添加后台链接管理*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// 添加对文章样式的支持，在数组中增加以上列表的类型别名即可
add_theme_support( 'post-formats', array( 'status', 'audio','video') );
/* standard – 标准，也就是默认的文章形式
 * aisde – 日志，实质上就是个不显示标题的标准文章
 * link – 链接，类似 Tumblr 的链接分享
 * quote – 引语，展示为引用的一段文字
 * status – 状态，简而言之就像是一条 Tweet
 * image – 图像，发布单张图片
 * gallery – 相册，也就是扩充的图像功能
 * audio – 音频，……需要说吗
 * video – 视频，……同上
 * chat – 聊天，以专门格式显示聊天记录
 */

/*导航菜单*/
if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array('primary' => '导航菜单'));
    register_nav_menus(array('footnav' => '页面导航'));
}

/** 注册边栏小工具 **/  
    if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name'          => '小工具1',
        'before_widget' => '<section class="widget">',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widgettitle"><i class="widgeticon"></i>',
        'after_title'   => '</h3>',
        'after_widget' => '</section>',
    ));
}
{
    register_sidebar(array(
        'name'          => '小工具2',
        'before_widget' => '<section class="widget">',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widgettitle"><i class="widgeticon"></i>',
        'after_title'   => '</h3>',
        'after_widget' => '</section>',
    ));
}

/*postviews 访问统计*/
//设置计数规则
function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if (is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('wp_head', 'set_post_views');

//转化数字与单位 from BIGFA
function format_number($number) {
    if($number >= 1000) {
       return  number_format($number/1000,1) . "k";   // NB: you will want to round this
    }
    else {
        return $number;
    }
}
//输出文章统计结果
function post_views($post_id, $echo=true, $unit=' views') {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if ($views == '') {
        //return '';
        echo '0' . $unit;
    } else {
        if ($echo) {
            echo format_number($views) . $unit;
        } else {
            return format_number($views) . $unit;
        }
    }
}
//站点总浏览数
function all_view()
{
    global $wpdb;
    $count=0;
    $views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'");
    foreach($views as $key=>$value)
        {
        $meta_value=$value->meta_value;
        if($meta_value!=' ')
            {
            $count+=(int)$meta_value;
            }
        }
            if ($count>=10000000) {
                return number_format($count/10000000,2) . "千万";
            } else {
            return $count;
            }
}
   
/** 标题文字截断 **/
    function cut_str($src_str,$cut_length)
    {
        $return_str='';
        $i=0;
        $n=0;
        $str_length=strlen($src_str);
        while (($n<$cut_length) && ($i<=$str_length)){
            $tmp_str=substr($src_str,$i,1);
            $ascnum=ord($tmp_str);
            if ($ascnum>=224){
                $return_str=$return_str.substr($src_str,$i,3);
                $i=$i+3;
                $n=$n+2;
            } elseif ($ascnum>=192) {
                $return_str=$return_str.substr($src_str,$i,2);
                $i=$i+2;
                $n=$n+2;
            } elseif ($ascnum>=65 && $ascnum<=90) {
                $return_str=$return_str.substr($src_str,$i,1);
                $i=$i+1;
                $n=$n+2;
            } else {
                $return_str=$return_str.substr($src_str,$i,1);
                $i=$i+1;
                $n=$n+1;
            }
        }
        if ($i<$str_length) {
            $return_str = $return_str . '...';
        }
        if (get_post_status() == 'private') {
            $return_str = $return_str . '（private）';
        }
        return $return_str ;
    }
    
/*添加编辑器快捷按钮 */
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    }

/*隐藏版本号*/
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/*禁用修订版本*/
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep( $num, $post ) {
   if ( 'post_type' == $post->post_type )
      $num = 0;
   return $num;
}

/*取消自动保存*/
function no_autosave() {
  wp_deregister_script('autosave');
  }
add_action( 'admin_print_scripts', 'no_autosave' );

/*去除文章记录*/
remove_action('pre_post_update', 'wp_save_post_revision' );
add_action( 'wp_print_scripts', 'disable_autosave' );
function disable_autosave() {
wp_deregister_script('autosave');
}

/*缩略图*/

//支持外链缩略图
if ( function_exists('add_theme_support') )
 add_theme_support('post-thumbnails');
 function catch_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){
    $random = mt_rand(1, 15);
    echo get_bloginfo( 'stylesheet_directory' );
    echo '/images/random/tb'.$random.'.jpg';
  }
  return $first_img;
 }

/*去掉replytocom*/
add_filter('comment_reply_link', 'add_nofollow', 420, 4);
function add_nofollow($link, $args, $comment, $post){
  return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href=\'#comment-$3', $link );
}

/**************评论部分，较长*******************/
//自定义表情
    if ( !isset( $wpsmiliestrans ) ) {
    		$wpsmiliestrans = array(
           '[/发呆]'=> 'icon_arrow.gif',
           '[/亲亲]'=> 'icon_biggrin.gif',
           '[/头晕]'=> 'icon_confused.gif',
           '[/装酷]'=>   'icon_cool.gif',
           '[/流泪]'=> 'icon_cry.gif',
           '[/饥饿]'=> 'icon_eek.gif',
           '[/闭嘴]'=> 'icon_evil.gif',
           '[/调皮]'=> 'icon_exclaim.gif',
           '[/邪恶]'=> 'icon_idea.gif',
           '[/呲牙]'=> 'icon_lol.gif',
           '[/愤怒]'=> 'icon_mad.gif',
           '[/偷笑]'=> 'icon_mrgreen.gif',
           '[/害羞]'=> 'icon_neutral.gif',
           '[/流汗]'  => 'icon_question.gif',
           '[/羡慕]'  => 'icon_razz.gif',
           '[/欢呼]'=> 'icon_redface.gif',
           '[/可怜]'=> 'icon_rolleyes.gif',
           '[/伤心]'=> 'icon_sad.gif',
           '[/微笑]'=> 'icon_smile.gif',
           '[/惊吓]'=> 'icon_surprised.gif',
           '[/大笑]'=> 'icon_twisted.gif',
           '[/淡定]'=> 'icon_wink.gif',
            );
    }
    function custom_smilies_src($src, $img)
    {
    	return get_bloginfo('template_directory').'/images/smiley/'. $img;
    }
    add_filter('smilies_src', 'custom_smilies_src', 10, 2);

    function time_ago( $type = 'comment', $day = 30 ) {
        $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
        $timediff = time() - $d('U');
        if ($timediff <= 60*60*24*$day){
            echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
            }
        if ($timediff > 60*60*24*$day){
                echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
            }
    }

    /*评论链接跳转*/   
function ssn_redirect_comment_link(){
       $linkname = get_comment_author_url($comment_ID);
       $url = '/r?url='.base64_encode(get_comment_author_url($comment_ID));
       $author = get_comment_author($comment_ID);
      if ( empty($url) || 'http://' == $url )
             return $author;
       else
             return '<a href="http://zhuweisheng.com.cn'.$url.' "rel="external nofollow" target="_blank" class="url" title="'.$linkname.'">'.$author.'</a>' ;
}
add_filter('get_comment_author_link', 'ssn_redirect_comment_link'); 

/* 禁止全英文和日文评论 */
function ssn_comment_post( $incoming_comment ) { 
    $pattern = '/[一-龥]/u'; 
    $jpattern ='/[ぁ-ん]+|[ァ-ヴ]+/u'; 
    if(!preg_match($pattern, $incoming_comment['comment_content'])) { 
        err( "写点汉字吧，博主看不懂鸟语！ Please write some chinese ！" ); 
        } 
        if(preg_match($jpattern, $incoming_comment['comment_content'])){ 
            err( "日文滚粗！Stop！" ); 
            } 
            return( $incoming_comment ); 
            } 
add_filter('preprocess_comment', 'ssn_comment_post');

/*防止冒充博主*/
        function usecheck($incoming_comment) {
            $isSpam = 0;
            /* 将 碎碎念 改成博主昵称 */
            if (trim($incoming_comment['comment_author']) == '碎碎念')
                $isSpam = 1;
            if (trim($incoming_comment['comment_author']) == '碎碎念（博主）')
                $isSpam = 1;
            if (trim($incoming_comment['comment_author']) == '博主')
                $isSpam = 1;
            if (trim($incoming_comment['comment_author']) == '管理员')
                $isSpam = 1;
            if (trim($incoming_comment['comment_author']) == '管理')
                $isSpam = 1;
            if (trim($incoming_comment['comment_author']) == '站长')
                $isSpam = 1;
            /* 将 openzws@163.com 改成博主Email */
            if (trim($incoming_comment['comment_author_email']) == 'openzws@163.com')
                $isSpam = 1;
            if(!$isSpam)
                return $incoming_comment;
            err('请勿冒充博主发表评论！');
        }
        if(!is_user_logged_in())
            add_filter( 'preprocess_comment', 'usecheck' );
/*此段结束*/

/* 评论回复/头像缓存 */
function lomo_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { /*初始化楼层计数器 */
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);/*获取主评论总数量*/
          $page = get_query_var('cpage');/*获取当前评论列表页码*/
          $cpp=get_option('comments_per_page');/*获取每页评论显示数量*/
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;/*如果评论只有1页或者是最后一页，初始值为主评论总数*/
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
        <div class="comment-author vcard">
            <?php echo get_avatar($comment, 45,$default,$alt=get_comment_author($id)); ?>
            <span class="fayan"><?php comment_author_link() ?></span>
            <?php if(is_admin_comment($comment->comment_ID)) echo '<span class="admincomment changecolor">（博主）</span>';?><!--判断博主身份并标记-->
            <span class="datetime"><?php time_ago() ?> </span> 
            <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="icon-reply"></i>回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>  
            <?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?>
            <span class="floor">
            <?php if(!$parent_id = $comment->comment_parent){switch ($commentcount){
             case 2 :echo "沙发";--$commentcount;break;
             case 3 :echo "板凳";--$commentcount;break;
             case 4 :echo "地板";--$commentcount;break;
             default:printf('%1$s楼', --$commentcount);
                      }
                 } ?>
            </span>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <span style="color:#C00; font-style:inherit">正在提交您的评论，请等待审核...</span>
            <br />          
        <?php endif; ?>
        <section class="commenttext"><?php comment_text() ?></section>
  </div>
<?php
}
function lomo_end_comment() {
        echo '</li>';
}
/*标记博主留言判断身份*/
function is_admin_comment( $comment_ID = 0 ) { 
    $comment = get_comment( $comment_ID ); 
    $admin_comment = false; /*设置一个布尔类型的变量用于判断该留言的ID是否为管理员的留言 */
    if($comment->user_id == 1){ 
    $admin_comment = true; 
    } 
    return $admin_comment; 
} 

/*头像缓存到本地*/
function my_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.jpg';
  $t = 1209600; //設定14天, 單位:秒
  if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //當頭像不存在或文件超過14天才更新
    copy(htmlspecialchars_decode($g), $e);
  } else  $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));
  if (filesize($e) < 500) copy($w.'/avatar/default.jpg', $e);
  return $avatar;
}
add_filter('get_avatar', 'my_avatar');



/* 垃圾评论拦截 */
class anti_spam {
	function anti_spam() {
	    if ( !current_user_can('level_0') ) {
	      add_action('template_redirect', array($this, 'w_tb'), 1);
	      add_action('init', array($this, 'gate'), 1);
	      add_action('preprocess_comment', array($this, 'sink'), 1);
		}
	  }
	function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
      $IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
      $way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
      $spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
    }
  }
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      /*方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.*/
      die();
      /*方法二: 标记为 spam, 留在资料库检查是否误判. */
   /*  //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
     //$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed']; */
    }
    return $comment;
	  }
	}
	$anti_spam = new anti_spam();

/*屏蔽评论内容链接*/
remove_filter('comment_text', 'make_clickable', 9);