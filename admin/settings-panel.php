<?php 
    $tablerows = array(
        array(
            'id'=>'lylith_pro_has_social_media',
            'title'=>'Közösségi média haszálata',
        ),
        array(
            'id'=>'lylith_pro_has_social_facebook',
            'title'=>'Van Facebook-om',
        ),
        array(
            'id'=>'lylith_pro_has_social_instagram',
            'title'=>'Van Intagram-om',
        ),
        array(
            'id'=>'lylith_pro_has_social_tiktok',
            'title'=>'Van TikTok-om',
        ),
        array(
            'id'=>'lylith_pro_use_bottom_navigation',
            'title'=>'Alsó mobil-navigáció használata',
        ),
        array(
            'id'=>'lylith_pro_sidebar_menu_on_right',
            'title'=>'Mobil oldalsáv a jobb oldalon nyílik',
        ),
        array(
            'id'=>'lylith_pro_minicart_on_right',
            'title'=>'Kosár oldalsáv a jobb oldalon nyílik',
        ),
    );
    
    $tablerows_inputs = array(
        array(
            'id'=>'lylith_pro_barion_pixel_id',
            'title'=>'Barion Pixel ID',
        ),
        array(
            'id'=>'lylith_pro_barion_picture_link',
            'title'=>'Barion kép linkje',
        ),
        array(
            'id'=>'lylith_pro_social_media_facebook',
            'title'=>'Facebook link',
        ),
        array(
            'id'=>'lylith_pro_social_media_instagram',
            'title'=>'Instagram link',
        ),
        array(
            'id'=>'lylith_pro_social_media_tiktok',
            'title'=>'TikTok link',
        ),
    );



?>

<div class="tab-pane fade bg-white flex-grow-1" role="tabpanel" aria-labelledby="admin_settings" id="admin_settings_tab">
    <div class="w-100 h-100 d-flex flex-column p-5 gap-2 ">
        <h4 class="h5 fw-bold"><?php echo __('Téma beállítások', 'lylith-pro')?></h4>
        <h5 class="h6 fw-normal"><?php echo __('Lylith Pro 2024 beállítások', 'lylith-pro')?></h5>
        
        <form class="d-flex flex-column gap-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="w-50">#</th>
                        <th scope="col">Beállítás</th>
                    </tr>
                </thead>
                <tbody >
                    
                    <?php foreach($tablerows_inputs as $row): ?>
                    
    
                    <tr scope="row">
                        <td class="w-50"><?php echo $row['title'] ?></td>
                        <td>

                            <?php 
                                printf('<input id="%1$s" name="%1$s" class="lylith-pro-admin-input" value="%2$s"/>', $row['id'], get_option($row['id']));
                            ?>

                        </td>
                    </tr>
    
                    <?php endforeach; ?>

                    <?php foreach($tablerows as $row): ?>
                    
    
                    <tr scope="row">
                        <td class="w-50"><?php echo $row['title'] ?></td>
                        <td>
                        

                        
                            <?php 
                                $val = filter_var(get_option($row['id']), FILTER_VALIDATE_BOOLEAN);
                                printf('<input id="%1$s" name="%1$s" type="checkbox" value="%2$s"  %3$s/>', $row['id'], $val,  $val == false ? null : 'checked');
                            ?>
                       

                        </td>
                    </tr>
    
                    <?php endforeach; ?>
    
                </tbody>
            </table>
    
            <button class="admin-submit-button btn btn-secondary w-max px-7 py-2 rounded-0">
                <?php echo __('Mentés', 'lylith-pro') ?>
                <svg class="hidden" style="color:inherit" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
            </button>
        </form>
    </div>
</div>