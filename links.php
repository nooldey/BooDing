<?php
/*
 * links
 * Template Name: 友情链接
 */
?>
<?php get_header(); ?>
<div id="wrapper">
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="post-page post" id="post-<?php the_ID(); ?>">
	            <header class="page-title">
	                <h2><?php the_title(); ?></h2>
	                <address class="page-edit">
	                    <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
		            	<span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览：','次'); } ?></span>
	                </address>
	            </header>

	            <section id="links-page">
	            	<div class="linklist">
	            		<ul>
	            			<?php wp_list_bookmarks('orderby=rand&category_orderby=id'); ?>
	            		</ul>
	            	</div>
	            	<div class="clear"></div>
					<div class="entry">
                                                <?php the_content(); ?>
					</div>
				</section>
			<?php endwhile; endif; ?>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>