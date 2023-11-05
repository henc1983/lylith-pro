<?php

/**
 * includes/class-menu.php
 * 
 * Menu Class
 * 
 * @version 1.1
 * @package lylith-pro
 * @since 1.0
*/


if(!class_exists('LylithProMenus') && class_exists('LylithProBaseClass')) {
    final class LylithProMenus extends LylithProBaseClass {
        
        public function register() {
            add_action('after_setup_theme', [$this, 'menu_registering']);
        }


        public function menu_registering() {
            add_theme_support( 'menus' );
            register_nav_menus(array(
                'primary_menu' => esc_attr__( 'Navigációs Menu', 'lylith-pro'),
                'footer_menu' => esc_attr__( 'Lábléc menü', 'lylith-pro'),
                'account_menu' => esc_attr__( 'Fiók menü', 'lylith-pro'),
                'categories_menu' => esc_attr__( 'Termékkategóriák', 'lylith-pro'),
            ));
        }

        public static function get_navigation_menu_id($id) {
            $locations = get_nav_menu_locations();
            $menu_id = $locations[$id];
            return !empty($menu_id) ? $menu_id : '';
        }


        public static function get_child_menu_items(array $menu, $parent_id) {
            $child_menus = [];
            if (!empty($menu) && is_array($menu)) {
                foreach ($menu as $child) {
                    if ( intval($child->menu_item_parent == $parent_id) ) {
                        array_push($child_menus, $child);
                    }
                }
            }
            return $child_menus;
        }

    }
}
