<?php

/**
 * includes/custom_post_types/carousel.php
 * 
 * Custom Post Type - Carousel
 * 
 * @version 1.1
 * @package lylith-pro
*/

if(!class_exists('LylithProCPTCarousel')) {
    final class LylithProCPTCarousel extends LylithProBaseClass {
        

        private $screens = array('carousel');

        private $fields = array(
          array(
            'label' => 'Tartalom',
            'id' => 'lylith_pro_carousel_content',
            'type' => 'text',
           ),
          array(
            'label' => 'Leírás',
            'id' => 'lylith_pro_carousel_excerpt',
            'type' => 'text',
           )  
        );


        
        public function register() {
            add_action( 'init', [$this, 'register_custom_post_type'], 0 );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_fields' ) );
            add_filter( "manage_carousel_posts_columns", function ( $defaults ) {
	                
                $new = array();
                $title = $defaults['title'];
                unset($defaults['title']);  
                $date = $defaults['date'];  
                unset($defaults['date']);   

                
                $new['thumbnail'] = __('Háttérkép', $this->domain);
                $new['title'] = $title;
                $new['date'] = $date;

                return $new;  
            } );

            add_action('admin_head', function (){
                $output_css = '<style type="text/css">
                    .column-thumbnail { width: 220px }
                </style>';
                echo $output_css;
            });
            

            add_action( "manage_carousel_posts_custom_column", function ( $column_name, $post_id ) {
                if ( $column_name == 'thumbnail' ) {
                    echo get_the_post_thumbnail( $post_id, array(200, 80) );
                }
            }, 10, 2 );
        }

        /**
         * Register Custom Post Type
         */
        public function register_custom_post_type() {
            $labels = array(
                'name'                  => _x( 'Körhinta (Carousel)', 'Post Type General Name', $this->domain ),
                'singular_name'         => _x( 'Körhinta (Carousel)', 'Post Type Singular Name', $this->domain ),
                'menu_name'             => __( 'Körhinta (Carousel)', $this->domain ),
                'name_admin_bar'        => __( 'Körhinta (Carousel)', $this->domain ),
                'archives'              => __( 'Archives', $this->domain ),
                'attributes'            => __( 'Attributumok', $this->domain ),
                'parent_item_colon'     => __( 'Szülő elem:', $this->domain ),
                'all_items'             => __( 'Körhinta (Carousel)', $this->domain ),
                'add_new_item'          => __( 'Új elem hozzáadása', $this->domain ),
                'add_new'               => __( 'Hozzáad', $this->domain ),
                'new_item'              => __( 'Új Dia', $this->domain ),
                'edit_item'             => __( 'Dia szerkesztése', $this->domain ),
                'update_item'           => __( 'Frissít', $this->domain ),
                'view_item'             => __( 'Megnéz', $this->domain ),
                'view_items'            => __( 'Megnéz', $this->domain ),
                'search_items'          => __( 'Keresés', $this->domain ),
                'not_found'             => __( 'Nincs', $this->domain ),
                'not_found_in_trash'    => __( 'Üres a Lomtár', $this->domain ),
                'featured_image'        => __( 'Háttérkép', $this->domain ),
                'set_featured_image'    => __( 'Háttérkép beállítása', $this->domain ),
                'remove_featured_image' => __( 'Háttérkép törlése', $this->domain ),
                'use_featured_image'    => __( 'Háttérként használ', $this->domain ),
                'insert_into_item'      => __( 'Beilleszt', $this->domain ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', $this->domain ),
                'items_list'            => __( 'Items list', $this->domain ),
                'items_list_navigation' => __( 'Items list navigation', $this->domain ),
                'filter_items_list'     => __( 'Filter items list', $this->domain ),
            );
            $args = array(
                'label'                 => __( 'Körhinta (Carousel)', $this->domain ),
                'description'           => __( 'Körhinta Lylith Pro témához', $this->domain ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
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
            register_post_type( 'carousel', $args );
        }        
        

        public function add_meta_boxes() {
            foreach ( $this->screens as $s ) {
              add_meta_box(
                'carousel_settings_meta_box',
                __( 'Körhinta beállítások', $this->domain ),
                array( $this, 'meta_box_callback' ),
                $s,
                'normal',
                'high'
              );
            }
        }

        public function meta_box_callback( $post ) {
            wp_nonce_field( 'carousel_nonce_data', 'carousel_nonce' ); 
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
            if ( !isset( $_POST['carousel_nonce'] ) ) {
                return $post_id;
            }
            $nonce = $_POST['carousel_nonce'];
            if ( !wp_verify_nonce( $nonce, 'carousel_nonce_data' ) ) {
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




