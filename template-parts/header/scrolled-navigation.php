<?php

/**
 * /template-parts/header/scrolled-navigation.php
 * 
 * Scrolled Navigation View
 * 
 * @version 1.1
 * @package lylith-pro
*/

?>

<div class="w-100 d-block d-lg-none" style="min-height:60px"></div>
<div style="" id="scrolled-navbar" class="w-100 bg-primary shadow-lg">
    <div class="container-xxl navbar-wrapper d-flex flex-nowrap align-items-center py-2">

        <?php get_template_part( 'template-parts/header/custom_logo', null, ['height' => '36px']); ?>

        
        <nav>
            <ul id="nav-menu-list" class="mb-0 d-none d-lg-flex flex-nowrap gap-2 gap-lg-6 ms-4 align-items-center">
                <?php get_template_part('/template-parts/components/menu_items', null, array( 'menu_id' => 'primary_menu' ) ); ?>
            </ul>
        </nav>

        
        <ul id="navbar-right-section" class="mb-0 d-flex flex-nowrap align-items-center gap-2 ms-auto me-3 me-lg-2">
            <li class="header-product-searchbar">
                <?php get_template_part('/template-parts/components/searchbar', null , array() ) ?>
            </li>
            <?php 
                $has_bottom_navigation = filter_var( get_option( 'lylith_pro_use_bottom_navigation' ), FILTER_VALIDATE_BOOLEAN )  ? 'd-none d-lg-flex' : 'd-flex';
            ?>
            
            <li class="user-button-group">
                <ul class="mb-0 buttons flex-nowrap gap-1 <?php echo $has_bottom_navigation ?>">
                    <li>
                        <?php 
                            $args_myaccount = [
                                'title' => is_user_logged_in() ? __( 'Fiókom', 'lylith-pro' ) : __( 'Bejelentkezés', 'lylith-pro' ),
                                'url' => esc_url( wc_get_page_permalink( 'myaccount' ) ),
                                'icon' => THEME_IMAGES_URI.'/myaccount.svg#myaccount-icon',
                                'badge' => true,
                                'badge_data' => '',
                                'badge_class' => is_user_logged_in() ? 'badge myaccount logged-in' : 'badge myaccount text-light bg-secondary',
                                'button_class' => 'text-neutral navbar-icon-button myaccont',
                            ];
                            get_template_part( '/template-parts/components/icon_button', null, $args_myaccount );   
                        ?>        
                    </li>
                    <?php if(class_exists('JVM_WooCommerce_Wishlist')) :?>
                        <li>
                            <?php 
                                $args_wishlist = [
                                    'title' => __( 'Kedvencek', 'lylith-pro' ),
                                    'url' => class_exists('JVM_WooCommerce_Wishlist') ? esc_url( jvm_get_wishlist_url() ) : esc_url( '#' ),
                                    'icon' => THEME_IMAGES_URI.'/favorite-fill.svg#favorite-filled-icon',
                                    'badge' => true,
                                    'badge_data' => class_exists('JVM_WooCommerce_Wishlist') ? jvm_woocommerce_wishlist_get_count() : 0,
                                    'badge_class' => 'badge wishlist text-light bg-secondary',
                                    'button_class' => 'text-neutral navbar-icon-button wishlist',
                                ];
                                get_template_part( '/template-parts/components/icon_button', null, $args_wishlist );   
                            ?>        
                        </li>
                    <?php endif;?>
                    <li>
                        <?php 
                            $args_cart = [
                                'title'=> __( 'Kosár', 'lylith-pro' ),
                                'url'=> class_exists('WooCommerce') ? wc_get_page_permalink( 'cart' ) : esc_url( '#' ),
                                'icon'=> THEME_IMAGES_URI.'/shopping-bag.svg#shopping-bag-icon',
                                'badge'=>true,
                                'badge_data' => class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : 0,
                                'badge_class' => 'badge cart text-light bg-secondary',
                                'button_class' => 'text-neutral navbar-icon-button cart',
                            ];
                            get_template_part( '/template-parts/components/icon_button', null, $args_cart );   
                        ?>        
                    </li>
                </ul>
            </li> <!-- <li class="user-button-group"> -->
        </ul> <!-- <ul id="navbar-right-section"> -->
        <?php

        $args_menutoggle = [
            'title'=> __( 'Menü', 'lylith-pro-2024' ),
            'url'=> esc_url( '#' ),
            'icon'=> THEME_IMAGES_URI.'/hamburger.svg#hamburger-icon',
            'button_class' => 'navbar-icon-button menu-toggle main-sidebar d-flex justify-content-center align-items-center text-white p-2 rounded',
        ];
        get_template_part( '/template-parts/components/icon_button', null , $args_menutoggle );

        ?>

    </div>
</div>
