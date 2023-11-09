<?php

/**
 * /template-parts/header/normal-navigation.php
 * 
 * Normal Navigation View
 * 
 * @version 1.1
 * @package lylith-pro
*/
$email = get_option('lylith_pro_company_email', 'lylith_pro@email.com');
$phone = get_option('lylith_pro_company_phone', '+36 1 2346 789');

?>

<div id="normal-navbar" class="w-100 d-none d-lg-block">
    <div class="container-xxl pb-3 pt-1 d-flex justify-content-between ">
        <div class="d-flex align-items-center gap-3">
            <a href="mailto:<?php echo $email?>" class="fs-7 text-light d-flex gap-2 align-items-center mb-0 text-decoration-none"><svg><use href="<?php echo THEME_IMAGES_URI . '/contacts/email.svg#email-icon'?>"></use></svg><?php echo $email?></a>
            <a href="tel:<?php echo $phone?>" class="fs-7 text-light d-flex gap-2 align-items-center mb-0 text-decoration-none"><svg><use href="<?php echo THEME_IMAGES_URI . '/contacts/phone.svg#phone-icon'?>"></use></svg><?php echo $phone?></a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?php echo get_permalink( wc_terms_and_conditions_page_id() ); ?>" class="fs-7 text-light d-flex gap-2 align-items-center mb-0 text-decoration-none"><svg style="width:1.125em"><use href="<?php echo THEME_IMAGES_URI . '/umbrella.svg#umbrella-icon'?>" /></svg><?php echo __('Általános Szerződési Feltételek', 'lylith-pro')?></a>
            <a href="<?php echo get_privacy_policy_url()?>" class="fs-7 text-light d-flex gap-2 align-items-center mb-0 text-decoration-none"><svg style="width:1.25em"><use href="<?php echo THEME_IMAGES_URI . '/shield.svg#shield-icon'?>" /></svg><?php echo __('Adatkezelési tájékoztató', 'lylith-pro')?></a>
        </div>
    </div>


    <div class="container-xxl navbar-wrapper d-grid pb-3" style="grid-template-columns:repeat(3, 1fr)">

        
        <?php get_template_part( 'template-parts/header/custom_logo', null, ['height' => '44px']); ?>
        


        <div class="normal-navbar" style="min-width:300px">
            <?php get_template_part('/template-parts/components/searchbar', null , array('text_color'=> 'text-primary')) ?>
        </div>
                
        <ul id="navbar-right-section" class="d-flex flex-nowrap align-items-end gap-2 me-3 me-lg-2 mb-0 justify-content-end">
            <?php 
                $has_bottom_navigation = filter_var( get_option( 'lylith_pro_use_bottom_navigation' ), FILTER_VALIDATE_BOOLEAN )  ? '' : 'no-bottom-navigation';
            ?>
            
            <li class="user-button-group">
                <ul class="buttons d-none d-lg-flex flex-nowrap gap-2 ps-0">
                    <li>
                        <?php 
                            $args_myaccount = [
                                'title' => is_user_logged_in() ? __( 'Fiókom', 'lylith-pro' ) : __( 'Bejelentkezés', 'lylith-pro' ),
                                'show_title' => true,
                                'url' => esc_url( wc_get_page_permalink( 'myaccount' ) ),
                                'icon' => THEME_IMAGES_URI.'/myaccount.svg#myaccount-icon',
                                'button_class' => 'navbar-bg-icon-button myaccont bg-secondary',
                            ];
                            get_template_part( '/template-parts/components/icon_button', null, $args_myaccount );   
                        ?>        
                    </li>
                    <?php if(class_exists('JVM_WooCommerce_Wishlist')) :?>
                        <li>
                            <?php 
                                $args_wishlist = [
                                    'title' => __( 'Kedvencek', 'lylith-pro' ),
                                    'show_title' => true,
                                    'url' => esc_url( jvm_get_wishlist_url() ),
                                    'icon' => THEME_IMAGES_URI.'/favorite-fill.svg#favorite-filled-icon',
                                    'badge' => true,
                                    'badge_data' => jvm_woocommerce_wishlist_get_count(),
                                    'badge_class' => 'badge wishlist text-primary bg-warning',
                                    'button_class' => 'navbar-bg-icon-button wishlist bg-secondary',
                                ];
                                get_template_part( '/template-parts/components/icon_button', null, $args_wishlist );   
                            ?>        
                        </li>
                    <?php endif;?>
                    <li>
                        <?php 
                            $args_cart = [
                                'title'=> __( 'Kosár', 'lylith-pro' ),
                                'show_title' => true,
                                'url'=> class_exists('WooCommerce') ? wc_get_page_permalink( 'cart' ) : esc_url( '#' ),
                                'icon'=> THEME_IMAGES_URI.'/shopping-bag.svg#shopping-bag-icon',
                                'badge'=>true,
                                'badge_data' => class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : 0,
                                'badge_class' => 'badge cart text-primary bg-warning',
                                'button_class' => 'navbar-bg-icon-button cart bg-secondary',
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
            'button_class' => 'navbar-icon-button menu-toggle',
        ];
        get_template_part( '/template-parts/components/icon_button', null , $args_menutoggle );

        ?>

    </div>

    <ul style="font-family:'Inter';" id="nav-menu-list" class="w-100 bg-primary d-none d-lg-flex flex-nowrap gap-2 gap-lg-6 justify-content-center text-white py-4 fs-8 text-uppercase align-items-center mb-0">
        <?php get_template_part('/template-parts/components/menu_items', null, array( 'menu_id' => 'primary_menu' ) ); ?>
    </ul>
</div>