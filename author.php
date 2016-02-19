<?php
/**
 * author page
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
			<header class="archive-header">
				<section id="author-page">
                    <span class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'),'64',$default,$alt=get_the_author($id) );?></span>
                    <span class="author-name author-data"><b>作者</b>：<?php echo the_author_nickname(); ?></span>
                    <span class="author-description author-data"><b>自述</b>：<?php the_author_description(); ?></span>
                 </section>
			</header>
			<?php  get_template_part('loop',get_post_format() );	?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>