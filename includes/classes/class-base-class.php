<?php

/**
 * includes/class-base-class.php
 * 
 * Theme Setup Class
 * 
 * @version 1.1
 * @package lylith-pro
*/


if(!class_exists('LylithProBaseClass')) {
    class LylithProBaseClass {
        
        public $theme_uri;
        public $theme_path;
        public $domain;

        public function __construct() {
            $this->domain = 'lylith-pro';
            $this->theme_uri = untrailingslashit( get_stylesheet_directory_uri() );
            $this->theme_path = untrailingslashit( get_stylesheet_directory() );
            $this->theme_css_uri = untrailingslashit( get_stylesheet_directory_uri() . '/assets/css' );
            $this->theme_css = untrailingslashit( get_stylesheet_directory() . '/assets/css' );
            $this->theme_js_uri = untrailingslashit( get_stylesheet_directory_uri() . '/assets/js' );
            $this->theme_js = untrailingslashit( get_stylesheet_directory() . '/assets/js' );
            $this->theme_classes = untrailingslashit( get_stylesheet_directory() . '/includes/classes' );
            $this->theme_cpt = untrailingslashit( get_stylesheet_directory() . '/includes/custom_post_types' );
        }
        
    }
}