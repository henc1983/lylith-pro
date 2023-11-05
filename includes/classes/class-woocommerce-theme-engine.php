<?php

/**
 * includes/class-woocommerce-theme-engine.php
 * 
 * Theme Setup Class
 * 
 * @version 1.1
 * @package lylith-pro
*/


if(!class_exists('LylithProWooCommerceThemeEngine') && class_exists('LylithProBaseClass')) {
    final class LylithProWooCommerceThemeEngine extends LylithProBaseClass {
        
        public function register() {
            
            if(!class_exists('WooCommerce')) {
                return;
            }


            add_action('after_setup_theme', [$this, 'woocommerce_theme_supports']);
            
            $this->fineTuning();
        }



        /**
         * WooCommerce Theme Supports
         * @method Class::woocommerce_theme_supports()
         */
        public function woocommerce_theme_supports() {
            $args = [
                'thumbnail_image_width' => 350,
                'single_image_width'    => 440,
                'product_grid'          => [
                    'default_rows'    => 4,
                    'min_rows'        => 4,
                    'max_rows'        => 4,
                    'default_columns' => 3,
                    'min_columns'     => 3,
                    'max_columns'     => 3,
                ]
            ];
            add_theme_support( 'woocommerce', $args );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
        }


        public function fineTuning() {
            // Disable Shop Page Title
            add_filter( 'woocommerce_show_page_title', '__return_false' );
            // Remove Unneeded zeros from price - e.g: 2500.00 -> 2500
            add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
            // Disable redirecting after AddToCart return error
            add_filter( 'woocommerce_cart_redirect_after_error', '__return_false' );
        }

    }
}