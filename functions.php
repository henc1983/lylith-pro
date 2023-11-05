<?php

/**
 * functions.php
 * 
 * First Level Theme Functions
 * 
 * @version 1.1
 * @package lylith-pro
*/

defined('ABSPATH') or die('Hey! Are You human?!');

$lylith_theme_data = wp_get_theme();

require_once get_template_directory() . '/includes/classes/class-base-class.php';
require_once get_template_directory() . '/includes/init.php';

$lylith_init = new InitClasses();
$lylith_init->registerServices();