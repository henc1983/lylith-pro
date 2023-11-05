<?php

/**
 * includes/class-ajax.php
 * 
 * Ajax Server Side Class
 * 
 * @version 1.1
 * @package lylith-pro
*/


if(!class_exists('LylithProAdmin') && class_exists('LylithProBaseClass')) {
    final class LylithProAdmin extends LylithProBaseClass {
        
        public function register() {
            if(!current_user_can( 'manage_options' )) {
                return;
            }
            add_action( 'admin_menu' , [ $this, 'add_admin_menu_page' ]);
            
            // Can install plugins via Ajax request
            add_action( 'wp_ajax_wp_ajax_install_plugin', 'wp_ajax_install_plugin' );

            add_action( 'admin_enqueue_scripts' , [ $this , 'admin_enqueue_scripts' ] );
            add_action( 'after_setup_theme', [$this, 'redirect_from_admin_menu'] );         
        }

        /**
         * Implement Admin Page as submenu into Appearance menu
         */
        public function add_admin_menu_page() {
            add_theme_page( __('Lylith Pro beállítások', $this->domain), __('Lylith Pro beállítások', $this->domain), 'manage_options', 'themes.php?page=lylith_pro');
            add_theme_page( __('Körhinta (Carousel)', $this->domain), __('Körhinta (Carousel)', $this->domain), 'manage_options', 'themes.php?post_type=carousel');
            add_theme_page( __('Jellemzők (Features)', $this->domain), __('Jellemzők (Features)', $this->domain), 'manage_options', 'themes.php?post_type=company_features');
            add_theme_page( __('Hírdető plakátok', $this->domain), __('Hírdető plakátok', $this->domain), 'manage_options', 'themes.php?post_type=adver_posters');
            add_menu_page( __('Lylith Pro', $this->domain), __('Lylith Pro', $this->domain), 'manage_options', 'lylith_pro', [ $this, 'admin_callback_page'], 'dashicons-art', 110 );
            add_submenu_page( 'lylith_pro', __('Bállítások', $this->domain), __('Beállítások', $this->domain), 'manage_options', 'lylith_pro', null, 0);
            add_submenu_page( 'lylith_pro', __('Menük', $this->domain), __('Menük', $this->domain), 'manage_options', 'nav-menus.php', null, 1);
        }


        /**
         * Callback of Submenu Page
         */
        public function admin_callback_page() {
            ?>
            <div class="wrap">
                <?php get_template_part( "admin/admin" ); ?>
            </div>
            <?php
        }
        
        
        /**
         * Appearance Menu Link redirection to Own Menu Page
         */
        public function redirect_from_admin_menu() {
            global $pagenow;
            if ( $pagenow == 'themes.php' && !empty( $_GET['page'] ) ) {
                wp_safe_redirect('/wp-admin/admin.php?page='.$_GET['page']);
                exit;
            }
            
            if ( $pagenow == 'themes.php' && !empty( $_GET['post_type'] ) ) {
                wp_safe_redirect('/wp-admin/edit.php?post_type='.$_GET['post_type']);
                exit;
            }

        }


        public function admin_enqueue_scripts() {        
            
            if($_SERVER['REQUEST_URI'] == "/wp-admin/admin.php?page=lylith_pro") {
                wp_enqueue_style( 'lylith-pro-admin', $this->theme_css_uri.'/admin.min.css', [], filemtime($this->theme_css.'/admin.min.css'), 'all' );
                wp_enqueue_script( 'lylith-pro-admin', $this->theme_js_uri.'/admin.js', ['jquery'], filemtime($this->theme_js.'/admin.js'), true );
                wp_enqueue_script( 'bootstrap-admin', $this->theme_js_uri.'/bootstrap.bundle.min.js', ['jquery'], filemtime($this->theme_js.'/bootstrap.bundle.min.js'), true );
                wp_localize_script( 'lylith-pro-admin', 'LylithProAdminLocalize', [
                    'wp_rest_nonce' => wp_create_nonce( 'wp_rest' ),
                    'wp_rest_url' => esc_html( home_url( '/wp-json' ) ),
                    'wp_updates_nonce' => wp_create_nonce( 'updates' ),
                    'ajax_url'=>admin_url( 'admin-ajax.php' ),
                    'i18n' => [
                        'success_msg' => __('Beállítások mentve!', $this->domain),
                        'error_msg' => __('Hiba a mentés során!', $this->domain),
                        'copy_success_msg' => __('A rövidkód másolása sikeres!', $this->domain),
                        'copy_error_msg' => __('Hiba a rövidkód másolása során!', $this->domain),
                        'install_success_msg' => __('Sikeres bővítmény telepítés!', $this->domain),
                        'install_error_msg' => __('Hiba a bővítmény telepítése során!', $this->domain),
                    ]
                ] );
            }

        }
    }
}
