<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('请勿直接加载此页。谢谢！');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('必须输入密码，才能查看评论！'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ($comments) : ?>
	<div id="comments"><h3>目前有<?php comments_number('', '1', '%' );?>个评论！</h3></div>
	<div id="loading-comments">嘿咻嘿咻...</div>
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=lomo_comment&end-callback=lomo_end_comment&max_depth=10'); ?>
	</ol>
	<div class="commentnav">
		<div class="pagination"><?php paginate_comments_links(); ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
		<h3 id="comments">既然来了，就留个言吧！</h3>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">评论已被关闭！</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>

	<div id="respond">
		<span>电子邮件地址不会被公开，必填项已用 * 标注。</span>	
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p><?php print '登录者：'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print '[ 退出 ]'; ?></a></p>
	<?php elseif ( '' != $comment_author ): ?>
	<div class="author"><?php printf(__('欢迎回来 <strong>%s</strong>'), $comment_author); ?>
			<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">[ 更改 ]</a></div>
			<script type="text/javascript" charset="utf-8">
				//<![CDATA[
				var changeMsg = "[ 更改 ]";
				var closeMsg = "[ 隐藏 ]";
				function toggleCommentAuthorInfo() {
					jQuery('#comment-author-info').slideToggle('slow', function(){
						if ( jQuery('#comment-author-info').css('display') == 'none' ) {
						jQuery('#toggle-comment-author-info').text(changeMsg);
						} else {
						jQuery('#toggle-comment-author-info').text(closeMsg);
				}
			});
		}
				jQuery(document).ready(function(){
					jQuery('#comment-author-info').hide();
				});
				//]]>
			</script>
	<?php endif; ?>
	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		<section class="inputarea">
			<p>
				<label for="author">昵称</label>
				<input type="text" name="author" id="author" placeholder="<?php if ($req) echo " *  "; ?>" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			</p>
			<p>
				<label for="email">邮箱</label>
				<input type="text" name="email" id="email" placeholder="<?php if ($req) echo " *  "; ?>" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			</p>
			<p>
				<label for="url">网址</label>
				<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			</p>
		</section>
	</div>
      <?php endif; ?>
      <div class="clear"></div>
      <?php include(TEMPLATEPATH . '/includes/smiley.php'); ?>
		<p><textarea name="comment" id="comment" tabindex="4" cols="50" rows="5"></textarea></p>
		<p>
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="提交留言" />
			<input class="reset" name="reset" type="reset" id="reset" tabindex="6" value="<?php esc_attr_e( '我要重写' ); ?>" />
			<?php comment_id_fields(); ?>
		</p>
		<script type="text/javascript">	//Ctrl+Enter
		//<![CDATA[
			jQuery(document).keypress(function(e){
				if(e.ctrlKey && e.which == 13 || e.which == 10) { 
					jQuery(".submit").click();
					document.body.focus();
				} else if (e.shiftKey && e.which==13 || e.which == 10) {
					jQuery(".submit").click();
				}          
			})
		// ]]>
		</script>
		<?php do_action('comment_form', $post->ID); ?>
    </form>
	<div class="clear"></div>
    <?php endif; // If registration required and not logged in ?>
  </div>

  <?php endif; // if you delete this the sky will fall on your head ?>