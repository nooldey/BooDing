<?php
/**
 * Index
 */
?>
<?php get_header(); ?>
<div id="wrapper">
    <div id="content">
        <?php get_template_part('middle', 'index'); ?>
        <?php get_template_part('loop', 'index'); ?>
    </div>
    <?php get_sidebar(); ?> 
</div>
<?php get_footer(); ?>