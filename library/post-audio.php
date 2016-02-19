
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?> ">
             <div class="audio-entry">
                <?php
                    the_content( __( '', 'ZWS' ) );
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ZWS' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                ?>
            </div>
        </article>