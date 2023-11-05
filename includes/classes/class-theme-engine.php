<?php

/**
 * includes/class-theme-engine.php
 * 
 * Theme Setup Class
 * 
 * @version 1.1
 * @package lylith-pro
*/


if(!class_exists('LylithProThemeEngine') && class_exists('LylithProBaseClass')) {
    final class LylithProThemeEngine extends LylithProBaseClass {
        
        public function register() {
            add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
            add_filter( 'wp_is_mobile', [ $this, 'mobile_screen_detection' ], 99, 1 );
            add_filter( 'body_class', [ $this, 'custom_body_class' ] );
        }


        /**
         * Main Theme Settings
         * 
         * @method Class::after_setup_theme()
         * 
         * - language support, title tag, menus, html5 and custom-logo
        */
        public function after_setup_theme() {
            load_theme_textdomain( $this->theme_path . '/languages' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
            add_theme_support( 'custom-logo', array(
                'height'               => 120,
                'width'                => 300,
                'flex-height'          => true,
                'flex-width'           => true,
                'unlink-homepage-logo' => true,
            ) );
        }




        /**
         * Enqueueing Stylesheets and scripts
         * 
         * @method Class::wp_enqueue_scripts()
         */
        public function wp_enqueue_scripts() {
                       
            wp_enqueue_script( 'jquery' );

        }



        /**
         * FIXING Wordpress Mobile Screen detection
         * @method Class::mobile_screen_detection()
         * 
         * - fixed issue with iPhone detection
         */
        public function mobile_screen_detection( $is_mobile ) {
            if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
                $is_mobile = false;
            } elseif ( str_contains( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) // Many mobile devices (all iPhone, iPad, etc.)
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Macintosh' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Android' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Silk/' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Kindle' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' )
                || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) ) {
                    $is_mobile = true;
            } else {
                $is_mobile = false;
            }
        
            return $is_mobile;
        }


        /**
         * Add Classes to body
         * @method Class::custom_body_class()
         */
        function custom_body_class( $classes ) {
            if( wp_is_mobile() ) {
                $classes[] = 'mobile-view';
            }
            if (is_front_page()) {
                $classes[] = 'front-page';
            }
            return $classes;
        }

    }
}
