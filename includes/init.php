<?php

/**
 * includes/classes/init.php
 * 
 * Initialize Service Classes
 * 
 * @version 1.1
 * @package lylith-pro
*/

final class InitClasses extends LylithProBaseClass {

    /**
     * Return an array included classnames
     */
    public function getServices() {
        
        foreach (scandir( $this->theme_classes ) as $filename) {
            $path = $this->theme_classes . '/' . $filename;
            if ( is_file($path) ) {
                require_once $path;
            }
        }
        
        foreach (scandir( $this->theme_cpt ) as $filename) {
            $path = $this->theme_cpt . '/' . $filename;
            if ( is_file($path) ) {
                require_once $path;
            }
        }

        return array(
            LylithProAjax::class,
            LylithProAdmin::class,
            LylithProMenus::class,
            LylithProRestApi::class,
            LylithProCPTFeatures::class,
            LylithProCPTCarousel::class,
            LylithProCPTAdverPosters::class,
            LylithProThemeEngine::class,
            LylithProWooCommerceThemeEngine::class,
        );
    }

    
    /**
     * Instantiate classes
     */
    public function registerServices() {
        foreach($this->getServices() as $class) {
            $service = $this->instance($class);
            if(method_exists($service, 'register')) {
                $service->register();
            }
        }
    }


    /**
     * Helper methode to return instantiate of class
     */
    private function instance($class) {
        return new $class;
    }

}