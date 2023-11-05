<?php

/**
 * admin/admin.php
 * 
 * Main Admin View Template
 * @version 1.1
 * @package lylith-pro
 * @since 1.0
*/

defined('ABSPATH') or die('Hey! Are You human?!');
?>

<aside id="lylith-pro-admin-messages"></aside>

<main class="d-flex flex-column gap-5">
    <div class="lylith-pro-admin-header bg-primary p-3 text-white d-flex flex-column gap-2 shadow">
        <h2 class="header-title" >Lylith Pro</h2>
        <h3 class="header-version fs-6 bg-secondary px-3 py-1 rounded-1 w-max">v1.1.0</h3>
        <p class="text-white-50 m-0 p-0">Makai Henrik</p>
    </div>
    <section class="lylith-pro-admin-content d-flex flex-column flex-lg-row shadow">

        
        <?php  get_template_part( 'admin/navigation' ); ?>
        
        <div class="m-0 p-0 w-100 tab-content">
            
            
            <?php 
                
                get_template_part( 'admin/user-panel' );
                get_template_part( 'admin/company-panel' );
                get_template_part( 'admin/bank-panel' );
                get_template_part( 'admin/webhost-panel' );
                if(class_exists('WooCommerce')) {
                    get_template_part( 'admin/woocommerce-panel' );
                }
                get_template_part( 'admin/plugins-panel' );
                get_template_part( 'admin/settings-panel' );
            
            ?>

        </div>

    </section>
    <p class="fs-6">Ezt témasablont az <a class="text-dark fw-bolder d-inline-block bg-primary p-1" href="https://epoxydreamshop.hu"><img class="bg-primary" height="30px" src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo.png'?>" alt="EpoxyDreamShop Logó"></a> csapata készítette és forgalmazza!</p>
</main>