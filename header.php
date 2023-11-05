<?php

/**
 * header.php
 * 
 * Main Header Part
 * 
 * @version 1.1
 * @package lylith-pro
*/

defined('ABSPATH') or die('Hey! Are You human?!');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">	
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- HERE COMES THE HEADER TEMPLATE PART -->