<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 </title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> </title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> </title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> </title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?> </title><?php } ?>
<?php if ( has_post_format('status') ) { ?><title><?php _e('微博墙','zws'); ?> </title><?php } ?>
<?php if ( is_author() ) { ?><title><?php echo the_author_nickname(''); ?>发布的文章 </title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> </title><?php } ?> <?php } ?>
<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_home() ) { ?>
<meta name="description" content="<?php echo get_option('swt_description'); ?>" />
<meta name="keywords" content="<?php echo get_option('swt_keywords'); ?>" />
<?php } ?>
<?php if ( is_page() ) { ?>
<meta name="description" content="<?php $description=substr(strip_tags($post->post_content),0,200);{echo $description;}?>" />
<meta name="keywords" content="<?php echo trim(wp_title('',0)); ?> " />
<?php } ?>
<?php if ( is_category() ) { ?>
<meta name="description" content="<?php echo category_description( $categoryID ); ?>" />
<meta name="keywords" content="<?php single_cat_title(); ?>,<?php $keywords="碎碎念,碎碎念ZWS,wordpress碎碎念";{echo $keywords;}?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo single_tag_title(); ?>" />
<meta name="keywords" content="<?php $keywords="碎碎念,碎碎念ZWS,wordpress碎碎念";{echo $keywords;}?>" />
<?php } ?>
<?php if ( is_author() ) { ?>
<meta name="description" content="<?php echo the_author_nickname(); ?>发布的文章" />
<meta name="keywords" content="<?php echo the_author_nickname(); ?>" />
<?php } ?>

        