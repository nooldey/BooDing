<div id="rss">
	<ul>
		<?php if (get_option('swt_tsina') == 'Display') { ?>
        <li class="tsina">
        	<a href="<?php echo stripslashes(get_option('swt_tsinaurl')); ?>" target="_blank" rel="external nofollow" class="icon3" title="新浪微博">
        		<i class="iconfont sinaicon">&#xf01af;</i>
        	</a>
        </li>
        <?php { echo ''; } ?><?php } else { } ?>

        <?php if (get_option('swt_qq') == 'Display') { ?>
        <li class="qqhao">
        	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo stripslashes(get_option('swt_qqhao')); ?>&site=qq&menu=yes" target="_blank"  rel="external nofollow"  class="icon4" title="有急事？直接Q我！">
        		<i class="iconfont qqicon">&#xf01c7;</i>
        	</a>
        </li>
        <?php { echo ''; } ?><?php } else { } ?>

        <?php if (get_option('swt_taobao') == 'Display') { ?>
        <li class="taobao">
            <a href="<?php echo stripslashes(get_option('swt_taobaourl')); ?>" target="_blank"  rel="external nofollow"  class="icon3" title="来淘宝小店坐坐">
                <i class="iconfont taobaoicon">&#xf0193;</i>
            </a>
        </li>
        <?php { echo ''; } ?><?php } else { } ?>

        <?php if (get_option('swt_myweb') == 'Display') { ?>
        <li class="myweb">
        	<a href="<?php echo stripslashes(get_option('swt_mylink')); ?>" target="_blank"  rel="external nofollow"  class="icon2" title="站长推荐">
	        	<i class="iconfont webicon">&#x3506;</i>
	        </a>
	    </li>
        <?php { echo ''; } ?><?php } else { } ?>

        <li class="rssfeed">
        	<a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="icon1" title="欢迎订阅<?php bloginfo('name'); ?>">
        		<i class="iconfont feedicon">&#xf003f;</i>
        	</a>
        </li>

    </ul>
</div>
<div id="search">
    <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
        <input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" placeholder="搜搜更健康 !" maxlength="50"/>
        <button type="submit" id="sb">search</button>
    </form>
</div>
<div class="tgtd">
    <a class="btn-tg" href="http://zhuweisheng.com.cn/postonline" target="_blank">在线投稿</a>
</div>
<div class="tgtd">
    <a class="btn-tg" href="http://zhuweisheng.com.cn/r/?url=aHR0cDovL3d3dy5zc3NuLmNsdWIv" target="_blank">手气不错</a>
</div>