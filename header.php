<?php include('includes/forbiddenCC.php'); ?>
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