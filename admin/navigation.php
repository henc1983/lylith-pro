<?php 
    $nav = [
        ['id'=>"admin_user", 'i' => 'admin_user_tab','title' => __('Felhasználó', 'lylith-pro'),],
        ['id'=>"admin_company", 'i' => 'admin_company_tab', 'title' => __('Céges adatok', 'lylith-pro'),],
        ['id'=>"admin_bank", 'i' => 'admin_bank_tab', 'title' => __('Banki Információk', 'lylith-pro'),],
        ['id'=>"admin_webhost", 'i' => 'admin_webhost_tab', 'title' => __('Webtárhely', 'lylith-pro'),],
        ['id'=>"admin_woocommerce", 'i' => 'admin_woocommerce_tab', 'title' => __('Woocommerce', 'lylith-pro'),],
        ['id'=>"admin_plugins", 'i' => 'admin_plugins_tab', 'title' => __('Bővítmények', 'lylith-pro'),],
        ['id'=>"admin_settings", 'i' => 'admin_settings_tab', 'title' => __('Beállítások', 'lylith-pro'),],
    ];
?>

<aside class="bg-neutral" style="width:260px">
    <ul class="m-0 w-100 nav nav-tabs d-flex flex-column bg-neutral" role="tablist">
        <?php 
            foreach($nav as $n) {
                if($n['i'] == 5 && !class_exists('WooCommerce')){
                    continue;
                }
                echo'<li class="nav-item m-0" role="presentation">';
                printf('<button type="button" data-bs-toggle="tab" data-bs-target="#%1$s" aria-controls="%1$s" class="bg-primary w-100 nav-link %3$s" id="%4$s">%2$s</button>', $n['i'], $n['title'], $n['i'] == 'admin_user_tab' ? 'active' : '', $n['id']);
                echo'</li>';
            }
        ?>
    </ul>
</aside>