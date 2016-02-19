<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <section class="category-page">
            <h1 id="archive-title">
                <?php echo single_cat_title( '', false ) ; ?>
            </h1>
            <entry>
                <?php echo category_description( $category ); ?>
            </entry>
        </section>
        <?php  
            rewind_posts();
            get_template_part('loop', 'archive');
        ?>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>