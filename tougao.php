<?php include('includes/forbiddenCC.php'); ?>
<?php
/*
 * TouGao
 * Template Name: 投稿
 * 原作：露兜
 * 博客：http://www.ludou.org/
 * 参考资料：http://www.ludou.org/wordpress-add-contribute-page.html/comment-page-2#comment-3817
 * 修正时间戳函数，使用wp函数current_time('timestamp')替代time()
 * 修改了wp_die函数调用，使用合适的页面title
 * 错误提示，增加点此返回链接,nickname为中文昵称
 * 添加插入图片、视频按钮
 * 增加屏蔽日文、纯英文内容
 * 增加投稿信息发送邮箱
 */
?>

<?php 
    
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
    global $wpdb;
    $current_url = 'http://www.zhuweisheng.com.cn/postonline';   // 注意修改此处的链接地址
    $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'post' ORDER BY post_date DESC LIMIT 1");
    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( current_time('timestamp') - strtotime($last_post) < 240 ) {
        wp_die('您投稿也太勤快了吧，先歇会儿！<a href="'.$current_url.'">点此返回</a>');
    }        
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
	$nickname = isset( $_POST['tougao_nickname'] ) ? trim(htmlspecialchars($_POST['tougao_nickname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    $blog =  isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 9;	//将9改为指定的分类id
    $content =  isset( $_POST['tougao_content'] ) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    $ip = $_SERVER["REMOTE_ADDR"];
// 表单项数据验证
   /* 取消投稿者注册为订阅者时可以注释掉此处用户名
    if ( empty($name) || mb_strlen($name) > 20 ) {
        wp_die('用户名必须填写，且长度不得超过20字。<a href="'.$current_url.'">点此返回</a>');
    }
    */
	if ( empty($nickname) || mb_strlen($nickname) > 30 ) {
        wp_die('昵称必须填写，且长度不得超过30字。<a href="'.$current_url.'">点此返回</a>');
    }

    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        wp_die('Email必须填写，且长度不得超过60字，必须符合Email格式。<a href="'.$current_url.'">点此返回</a>');
    }
    
    if ( empty($title) || mb_strlen($title) > 100 ) {
        wp_die('标题必须填写，且长度不得超过100字。<a href="'.$current_url.'">点此返回</a>');
    }
    
    if ( empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 100) {
        wp_die('内容必须填写，且长度不得超过3000字，不得少于100字。<a href="'.$current_url.'">点此返回</a>');
    }

	/*禁止日文投稿*/
	$pattern = '/[一-龥]/u'; 
	$jpattern ='/[ぁ-ん]+|[ァ-ヴ]+/u'; 
	if(preg_match($jpattern, $content)){ wp_die( "日文滚粗！Stop！" ); } 	
	if(!preg_match($pattern, $content)){ wp_die( "写点汉字吧，博主看不懂鸟语！ Please write some chinese ！" ); }
    
	if (empty ($blog)){
		$post_content = ''.$content.'<p>本文由<span>'.$nickname.'</span>原创并发布在碎碎念博客。</p>';  
		}
		else{
		$post_content = ''.$content.'<p>本文由<span>'.$nickname.'</span>转载自<ins>'.$blog.'</ins>。</p>';
		}
	  
    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content,
		'post_status' => 'pending',//是否自动发布,自动发布为publish，待审核为pending
		'post_category' => array($category)
    );

   //---------------将投稿者注册成你本站的订阅者start-------------
   /*
    require_once(ABSPATH . WPINC . '/registration.php');
	$user_id = username_exists( $name );
    if($user_id == NULL) {
    if(mb_strlen($name,"utf-8") != strlen($name) || email_exists($email))
        wp_die('用户名含有非英文字符，或者Email已被注册！');
        $password = '148976y'; // 默认的用户密码，自行更改
        $user_id = wp_create_user( $name, $password, $email );
        wp_update_user( array ('ID' => $user_id, 'user_url' => $blog, 'role' => 'subscriber','nickname' => $nickname) ) ;}
		// 更新用户的网站和角色，角色默认为投稿者contributor,角色可改成订阅者：subscriber，作者：author
		// 如果用户名已存在，则不添加用户，文章归到管理员名下
		// 建立文章与作者关系
		$tougao['post_author'] = $user_id;//-------投稿者注册为订阅者end-------------
	*/

	// 将文章插入数据库
	$status = wp_insert_post( $tougao );
	$new_post_toward = '
	碎碎念又有新投稿啦，快去看看吧！
	投稿者信息如下：
	昵称: ' .$nickname.'
	邮箱：'.$email.'
	访问来源：'.$ip.'
	文章标题：'.$title.'
	文章来源：'.$blog.'
	投稿时间：'.current_time('mysql').'
	';
	$new_post_toward = convert_smilies($new_post_toward);

    if ($status != 0) { 
        // 投稿成功给博主发送邮件
        // admin@admin.com替换博主邮箱
        // My subject替换为邮件标题，content替换为邮件内容
        wp_mail("admin@admin.com","碎碎念投稿审核", $new_post_toward);

        wp_die('投稿成功！感谢投稿！<a href="'.get_permalink( $status ).'">点此查看发布的文章</a> [ <a href="'.$current_url.'">点此返回</a> ] ', '投稿成功');
    }
    else {
        wp_die('投稿失败！<a href="'.$current_url.'">点此返回</a>');
    }
}
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>" charset="<?php bloginfo('charset') ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php include_once("includes/seo.php");?>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="shortcut icon" href="<?php bloginfo('home');?>/favicon.ico"/>
    <?php 
        wp_enqueue_script('jquery');
        wp_head();
    ?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory');?>/style.css.php?v=2.0"/>
    <!--[if ie 6]>
        <script src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
    <![endif]-->
</head>
<body>
    <header id="header">
        <div id="site-header">
            <div id="site-title">
                <a href="<?php bloginfo('home'); ?>/" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>" rel="home">
                    <div class="logo"></div>
                    <h1 class="blogname"><?php bloginfo('name'); ?></h1>
                </a>
            </div>

            <div id="navbar">
                <?php if(function_exists('wp_nav_menu')) { wp_nav_menu(array('theme_location'=>'primary','menu_id'=>'nav','container'=>'ul'));}?>
            </div>
 
        </div>
	<div class="mobileclear"></div>
    </header>
<div id="wrapper">
    <div id="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post post-page" id="post-<?php the_ID(); ?>">
            <header class="page-title">
                <h2><?php the_title(); ?></h2>
                <address class="page-edit">
                    <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
                    <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
                </address>
            </header>
            <div class="entry">
                <?php the_content(); ?> 
                <div class="clear"></div>
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                    <!--如果取消注册为用户名，此处可以注释掉。
                    <div class="tougao_label"><label>用户名:*（填写英文昵称，请勿包含数字和任何符号等非英文字符）</label></div>
                    <div class="tougao_input"><input type="text" size="40" value="" name="tougao_authorname" /></div>
                    -->
                    <div class="tougao_label">
                        <label for="tougao_nickname">昵称*:</label>
                    </div>
                    <div class="tougao_input">
                        <input type="text" size="40" value="" name="tougao_nickname" />
                    </div>
                    <div class="tougao_label">
                        <label>E-Mail*:</label>
                    </div>
                    <div  class="tougao_input">
                        <input type="text" size="40" value="" name="tougao_authoremail" />
                    </div>
                    <div class="tougao_label">
                        <label>您的博客/文章来源:</label>
                    </div>
                    <div  class="tougao_input">
                        <input type="text" size="40" value="" name="tougao_authorblog" />
                    </div>
                    <div class="tougao_label">
                        <label>文章标题*:</label>
                    </div>
                    <div  class="tougao_input">
                        <input type="text" size="40" value="" name="tougao_title" />
                    </div>
                    <div class="tougao_label">
                        <label>文章内容*:</label>
                    </div>
                    <div id="tougao_content">
                        <textarea rows="15" cols="55" name="tougao_content" id="tougao_text"></textarea>
                    </div>
                    <br clear="all">
                    <div>
                        <input type="hidden" value="send" name="tougao_form" />
                        <input type="submit" id="submit" value="提交" />
                        <input type="reset" id="reset" value="重填" />
                    </div>
                </form>
            </div>
        </article>
    </div>
<?php endwhile; endif; ?>
<?php get_sidebar();?>
</div>
<?php get_footer(); ?>