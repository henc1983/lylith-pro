<?php

/**
 * includes/classes/class-rest_api.php
 * 
 * Wordpress Rest APi
 * 
 * @version 1.1
 * @package lylith-pro
*/

defined('ABSPATH') or die('Hey! Are You human?!');


if( !class_exists('LylithProRestApi') ) {
    final class LylithProRestApi {
        
        public function register() {
            if(!current_user_can( 'manage_options' )) {
                return;
            }
            add_action( 'rest_api_init', [$this, 'lylith_rest_api_routes'] );
        }


        public function lylith_rest_api_routes() {
            register_rest_route( 
                'lylithpro/v2/', 
                'set_options',
                array(
                    'methods'   => 'POST',
                    'callback'  => [$this, 'lylith_option_set_state'],
                    'permission_callback' => [$this, 'lylith_rest_api_permission_check'],
                ),
            );
        }  
        
        public function lylith_option_set_state($request) {
            $list = [];
            foreach($request->get_params() as $key => $value) {
                update_option( $key, $value );
                
                array_push($list, array(
                    $key => $value
                ));
            }
            $list['success'] = true;        
            return rest_ensure_response( $list ); 
        }
        
        public function lylith_rest_api_permission_check($request) {
            return current_user_can( 'manage_options' );
        }
    }

    $lylith_pro_rest_api_class = new LylithProRestApi();
}