<?php
/**
 * Footer
 * Based on Gred by Tiotip!
 */
/*
 * This is a simple theme based on another theme ，we rebuilt almost all template codes and formats ,type again these codes and functions day and night . 
 * It is a really good theme which made its authors put off all things for it ,and you can use it for your blog ,but DO NOT USE THIS THEME FOR BUSINESS !
 * We allow everyone to use this theme ,or learn wordpress by designing this theme , but those who wanna earn money by selling it are not welcome!
 */

?>
<footer id="footer">
    <div class="copyright-footer">
        <section class="copyright-left">
            Copyright &copy;<?php echo gmdate(__('Y')); ?> <a href="<?php echo get_settings('home'); ?>" ><?php bloginfo('name'); ?></a> .   
            <a href="<?php echo get_settings('home'); ?>/sitemap" target="_blank">网站地图</a>   
            <a href="<?php echo get_settings('home'); ?>/xmlmap.php" target="_blank">sitemap</a> 
            <?php $icp='Display';?> 
            <?php if (get_option('swt_tj') == 'Display') { ?>
            <?php echo stripslashes(get_option('swt_tjcode'));if($icp !='Display'){wp_protect();};?><?php } else{ } ?>  
            <?php if (get_option('swt_beian') == 'Display') { ?>
            <?php echo stripslashes(get_option('swt_beianhao')); if($icp !='Display'){wp_protect();}; ?><?php } else { } ?>
            
            由<a href="http://my.henghost.com/aff.php?aff=1747" target="_blank" rel="external">恒创主机</a> +
            <a href="https://portal.qiniu.com/signup?code=3lmfxlrqtg502" target="_blank" rel="external">七牛云存储</a> + 
            <a href="http://cn.wordpress.org/" title="cn.WordPress.org"> WordPress</a>
            驱动！
            THEME: BooDing by 碎碎念ZWS ! 
        </section>
         <div class="gototop"></div>
         <div class="clear"></div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php if(is_singular()){ ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/smiley.js"></script>
<?php  } ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/theme.js"></script>
</body>
</html>