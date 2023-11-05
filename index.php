<?php

/**
 * index.php
 * 
 * Show The Main Content
 * 
 * @version 1.1
 * @package lylith-pro
*/

defined('ABSPATH') or die('Hey! Are You human?!');

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
            if(have_posts()) :
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'templates/content', 'page' );
                endwhile;
                    
            else :
                get_template_part( 'templates/content', 'none' );
            endif;
        ?>

    </main>
</div>

<?php
get_footer();

