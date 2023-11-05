<?php

/**
 * includes/custom_post_types/features.php
 * 
 * Custom Post Type - Features
 * 
 * @version 1.1
 * @package lylith-pro
*/


if(!class_exists('LylithProCPTFeatures')) {
    final class LylithProCPTFeatures extends LylithProBaseClass {
        

        private $screens = array('company_features');

        private $fields = array(
            array(
                'label' => 'Egyéni Class',
                'id' => 'lylith_pro_company_additional_classes',
                'type' => 'text',
            ),
            array(
                'label' => 'Cím és ikon Class',
                'id' => 'lylith_pro_company_title_classes',
                'type' => 'text',
            ),
            array(
                'label' => 'Leírás Class',
                'id' => 'lylith_pro_company_features_excerpt_classes',
                'type' => 'text',
            )  
        );


        
        public function register() {
            add_action( 'init', [$this, 'register_custom_post_type'], 112 );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_fields' ) );
        }

        /**
         * Register Custom Post Type
         */
        public function register_custom_post_type() {
            $labels = array(
                'name'                  => _x( 'Jellemzők (Features)', 'Post Type General Name', 'lylith-pro' ),
                'singular_name'         => _x( 'Jellemzők (Features)', 'Post Type Singular Name', 'lylith-pro' ),
                'menu_name'             => __( 'Jellemzők (Features)', 'lylith-pro' ),
                'name_admin_bar'        => __( 'Jellemzők (Features)', 'lylith-pro' ),
                'archives'              => __( 'Archives', 'lylith-pro' ),
                'attributes'            => __( 'Attributumok', 'lylith-pro' ),
                'parent_item_colon'     => __( 'Szülő elem:', 'lylith-pro' ),
                'all_items'             => __( 'Jellemzők (Features)', 'lylith-pro' ),
                'add_new_item'          => __( 'Új elem hozzáadása', 'lylith-pro' ),
                'add_new'               => __( 'Hozzáad', 'lylith-pro' ),
                'new_item'              => __( 'Új Jellemző', 'lylith-pro' ),
                'edit_item'             => __( 'Jellemző szerkesztése', 'lylith-pro' ),
                'update_item'           => __( 'Frissít', 'lylith-pro' ),
                'view_item'             => __( 'Megnéz', 'lylith-pro' ),
                'view_items'            => __( 'Megnéz', 'lylith-pro' ),
                'search_items'          => __( 'Keresés', 'lylith-pro' ),
                'not_found'             => __( 'Nincs', 'lylith-pro' ),
                'not_found_in_trash'    => __( 'Üres a Lomtár', 'lylith-pro' ),
                'insert_into_item'      => __( 'Beilleszt', 'lylith-pro' ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', 'lylith-pro' ),
                'items_list'            => __( 'Items list', 'lylith-pro' ),
                'items_list_navigation' => __( 'Items list navigation', 'lylith-pro' ),
                'filter_items_list'     => __( 'Filter items list', 'lylith-pro' ),
            );
            $args = array(
                'label'                 => __( 'Jellemzők (Features)', 'lylith-pro' ),
                'description'           => __( 'Cég jellemzők Lylith Pro témához', 'lylith-pro' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor' ),
                'menu_icon'             => 'dashicons-format-gallery',
                'hierarchical'          => false,
                'public'                => false,
                'show_ui'               => true,
                'show_in_menu'          => 'lylith_pro',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => false,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => false,
                'capability_type'       => 'post',
                'show_in_rest'          => false,
            );
            register_post_type( 'company_features', $args );
        }        
        

        public function add_meta_boxes() {
            foreach ( $this->screens as $s ) {
              add_meta_box(
                'company_features_settings_meta_box',
                __( 'Jellemzők beállítása', $this->domain ),
                array( $this, 'meta_box_callback' ),
                $s,
                'normal',
                'high'
              );
            }
        }

        public function meta_box_callback( $post ) {
            wp_nonce_field( 'company_features_nonce_data', 'company_features_nonce' ); 
            $this->field_generator( $post );
        }

        public function field_generator( $post ) {
            $output = '';
            foreach ( $this->fields as $field ) {
                $label = '<label for="' . $field['id'] . '">' . __($field['label'], 'lylith-pro') . '</label>';
                $meta_value = get_post_meta( $post->ID, $field['id'], true );
                if ( empty( $meta_value ) ) {
                if ( isset( $field['default'] ) ) {
                    $meta_value = $field['default'];
                }
                }
                switch ( $field['type'] ) {
                default:
                    $input = sprintf(
                    '<input %s id="%s" name="%s" type="%s" value="%s">',
                    $field['type'] !== 'color' ? 'style="width: 100%"' : '',
                    $field['id'],
                    $field['id'],
                    $field['type'],
                    $meta_value
                );
                }
                $output .= $this->format_rows( $label, $input );
            }
            echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
        }

        public function format_rows( $label, $input ) {
            return '<div style="margin-top: 10px;"><strong>'.$label.'</strong></div><div>'.$input.'</div>';
        }

        

        public function save_fields( $post_id ) {
            if ( !isset( $_POST['company_features_nonce'] ) ) {
                return $post_id;
            }
            $nonce = $_POST['company_features_nonce'];
            if ( !wp_verify_nonce( $nonce, 'company_features_nonce_data' ) ) {
                return $post_id;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            foreach ( $this->fields as $field ) {
                if ( isset( $_POST[ $field['id'] ] ) ) {
                switch ( $field['type'] ) {
                    case 'email':
                    $_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
                    break;
                    case 'text':
                    $_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
                    break;
                }
                update_post_meta( $post_id, $field['id'], $_POST[ $field['id'] ] );
                } else if ( $field['type'] === 'checkbox' ) {
                update_post_meta( $post_id, $field['id'], '0' );
                }
            }
        }       
    }
}