<?php
/**
 * Middle
 */
?>
<div id="middle">
    <div id="random">
        
        <?php  
            $rand_posts = get_posts('numberposts=1&orderby=rand');
            foreach($rand_posts as $post) :
        ?>
        <li class="randomimg" id="post-<?php the_ID(); ?> ">
 	    <h2><i class="attachicon"></i>推荐阅读：<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">《<?php the_title(); ?>》</a></h2>
        </li>
    <?php endforeach; ?>
    </div>
</div>