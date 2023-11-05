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


get_header();

if(have_posts()) {
    while ( have_posts() ) {

    the_post();

    }

    the_content();

}
else {

    /**
     * Here comes the content-none
     */
    
}

get_footer();

