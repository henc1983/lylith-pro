<?php

/**
 * /template-parts/header/custom_logo.php
 * 
 * Custom Logo Template Part
 * 
 * @version 1.1
 * @package lylith-pro
*/

$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'medium' );

$height = isset($args['height']) ? $args['height'] : '44px';

?>

<a class="main-logo d-block" href="<?php echo esc_url(home_url())?>">
    <?php  
        if ( has_custom_logo() ) {
            echo '<img style="height:'.$height.'" class="logo-img object-fit-cover" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
        } else {
            echo '<h1 class="h4 text-white">' . get_bloginfo('name') . '</h1>';
        }
    ?>
</a>