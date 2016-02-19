<div class="thumbnail">
	<?php if ( get_post_meta($post->ID, 'thumbnail', true) ) : ?>
	<?php $image = get_post_meta($post->ID, 'thumbnail', true); ?>

	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="http://zhuweisheng.com.cn/wp-content/uploads/opacity.png" style="background:url('<?php echo $image; ?>') no-repeat 50% 50%;background-size:cover;width:140px;height:140px;" alt="<?php the_title(); ?>"/></a>

	<?php else: ?>

	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail'); }
	else { ?>
	<img class="home-thumb" src="http://zhuweisheng.com.cn/wp-content/uploads/opacity.png" style="background:url('<?php 	echo catch_first_image() ?>') no-repeat 50% 50%;background-size:cover;width:140px;height:140px;" alt="<?php the_title(); ?>"/>
	<?php } ?>
	</a>

	<?php endif; ?>
</div>