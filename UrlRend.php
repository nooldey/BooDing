<?php
/*
Template Name: UrlRend
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
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                     <?php the_content(); ?>
                <?php endwhile;endif; ?>
<!---->
 <section>
     <h3>输入要加密的网址（可不带http://）</h3>
     <textarea id="src" rows="6" cols="60" value="" name="src"></textarea><br/>
     <button onclick="doEncode();" type="button" value="encode" name="encode">转换</button>
</section>
<section>
     <h3>加密结果：</h3>
     <textarea id="dest" rows="6" cols="60" value="" name="dest"></textarea>
</section>
<!---->
<style type="text/css">
	.entry section {
	    padding: 10px;
            text-indent: 0;
	    border: 1px solid #666;
	    border-top: 4px solid #666;
	    margin: 10px auto;
    }    
         #src,#dest{width:100%;}
         button {
		background: #08B;
		color: white;
		border: 0;
		padding: 3px;
		width: 80px;
		cursor: pointer;
		margin-left: 5px;
	}
</style>
<!---->
<script type="text/javascript">
var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
function base64encode(str) {
    var out, i, len;
    var c1, c2, c3;
    len = str.length;
    i = 0;
    out = "";
    while(i < len) {
    c1 = str.charCodeAt(i++) & 0xff;
    if(i == len)
    {
        out += base64EncodeChars.charAt(c1 >> 2);
        out += base64EncodeChars.charAt((c1 & 0x3) << 4);
        out += "==";
        break;
    }
    c2 = str.charCodeAt(i++);
    if(i == len)
    {
        out += base64EncodeChars.charAt(c1 >> 2);
        out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
        out += base64EncodeChars.charAt((c2 & 0xF) << 2);
        out += "=";
        break;
    }
    c3 = str.charCodeAt(i++);
    out += base64EncodeChars.charAt(c1 >> 2);
    out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
    out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6));
    out += base64EncodeChars.charAt(c3 & 0x3F);
    }
    return out;
}
function utf16to8(str) {
    var out, i, len, c;
    out = "";
    len = str.length;
    for(i = 0; i < len; i++) {
    c = str.charCodeAt(i);
    if ((c >= 0x0001) && (c <= 0x007F)) {
        out += str.charAt(i);
    } else if (c > 0x07FF) {
        out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
        out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));
        out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));
    } else {
        out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));
        out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));
    }
    }
    return out;
}
function doEncode() {
	var src = document.getElementById('src').value;
	document.getElementById('dest').value = 'http://zhuweisheng.com.cn/r/?url=' + base64encode(utf16to8(src));
}
</script>
<!---->
            </div>
        </article>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>