<?php 
    $tablerows = array(
        array(
            'plugin'=>'woocommerce/woocommerce.php',
            'slug'=>'woocommerce',
            'title'=>'Woocommerce',
        ),
        array(
            'plugin'=>'jvm-woocommerce-wishlist/jvm-woocommerce-wishlist.php',
            'slug'=>'jvm-woocommerce-wishlist',
            'title'=>'Wishlist for Woocommerce',
        ),
        array(
            'plugin'=>'google-site-kit/google-site-kit.php',
            'slug'=>'google-site-kit',
            'title'=>'Google Site Kit',
        ),
        array(
            'plugin'=>'google-listings-and-ads/google-listings-and-ads.php',
            'slug'=>'google-listings-and-ads',
            'title'=>'Google Listings and Ads',
        ),
        array(
            'plugin'=>'hungarian-pickup-points-for-woocommerce/index.php',
            'slug'=>'hungarian-pickup-points-for-woocommerce',
            'title'=>'Csomagpontok és Címkék',
        ),
    );

?>


<div class="tab-pane fade bg-white flex-grow-1" role="tabpanel" aria-labelledby="admin_plugins" id="admin_plugins_tab">
    <div class="w-100 h-100 d-flex flex-column p-5 gap-2 ">
        <h4 class="h5 fw-bold"><?php echo __('Extra bővítmények', 'lylith-pro')?></h4>
        <h5 class="h6 fw-normal"><?php echo __('Bővítmények (plugin) telepítése', 'lylith-pro')?></h5>

        <form class="d-flex flex-column gap-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="w-50">#</th>
                        <th scope="col">Beállítás</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($tablerows as $row): 
                    
                    $installed = array_key_exists($row['plugin'], get_plugins());
                        
                    ?>
                    
    
                    <tr scope="row">
                        <td class="w-50"><?php echo $row['title'] ?></td>
                        <td class="clearfix align-middle">
                            <?php
                                $val = filter_var(is_plugin_active( $row['plugin'] ), FILTER_VALIDATE_BOOLEAN);
                                printf('<input %3$s id="%1$s" name="%1$s" type="checkbox" class="float-start plugin-activate" %2$s />', $row['plugin'], $val == false ? null : 'checked', $installed == false ? 'disabled' : null);
                            ?>
                            <?php if(!$installed) : ?>
                                <div class="float-start d-flex flex-row align-items-center gap-3 h-100 ml-2">
                                    <button class="plugin-install-button btn btn-secondary btn-sm" data-slug="<?php echo $row['slug'] ?>" data-title="<?php echo $row['title'] ?>">
                                        <?php echo __('Telepítés', 'lylith-pro')?>
                                    </button>
                                    <div class="d-none spinner-border spinner-border-sm text-secondary" role="status">
                                      <span class="visually-hidden"><?php echo __('Betöltés', 'lylith-pro')?></span>
                                    </div>
                                </div>
                            <?php endif;?>
                        </td>
                    </tr>
    
                    <?php endforeach; ?>
    
                </tbody>
            </table>
        </form>

    </div>
</div>
