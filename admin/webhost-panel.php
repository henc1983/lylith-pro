<?php 
    $tablerows = array(
        array(
            'id'=>'lylith_pro_webhost_name',
            'title'=>'Tárhelyszolgáltató neve',
        ),
        array(
            'id'=>'lylith_pro_webhost_email',
            'title'=>'Email cím',
        ),
        array(
            'id'=>'lylith_pro_webhost_phone',
            'title'=>'Telefon',
        ),
        array(
            'id'=>'lylith_pro_webhost_address',
            'title'=>'Levelezési cím',
        ),
        array(
            'id'=>'lylith_pro_webhost_openingtime',
            'title'=>'Ügyfélfogadási idő',
        ),
        array(
            'id'=>'lylith_pro_webhost_domain',
            'title'=>'Webcím',
        ),
    );

?>

<div class="tab-pane fade bg-white flex-grow-1" role="tabpanel" aria-labelledby="admin_webhost" id="admin_webhost_tab">
    <div class="w-100 h-100 d-flex flex-column p-5 gap-2">
        <h4 class="h5 fw-bold"><?php echo __('Tárhelyszolgáltató', 'lylith-pro')?></h4>
        <h5 class="h6 fw-normal"><?php echo __('Webtárhely vagy domain szolgáltató', 'lylith-pro')?></h5>
        
        <form class="d-flex flex-column gap-3">
                <table class="table align-middle">
                    <thead  class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Beállítás</th>
                            <th scope="col">Rövidkód</th>
                            <th scope="col">Mentés</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($tablerows as $row): ?>
        
                        <tr>
                            <td><?php echo $row['title']?></td>
                            <td>
                                
                                <?php 
                                    printf('<input class="lylith-pro-admin-input" id="%1$s" name="%1$s" value="%2$s"/>', $row['id'], get_option($row['id']));
                                ?>
                                                          
                            </td>
                            <td>
                                <?php 
                                    printf('<p class="text-base">[adatok n="%s"]</p>', $row['id']);
                                ?>
                            </td>
                            <td>
                                <button class="btn btn-link text-success text-decoration-none" data-shortcode="<?php echo $row['id']?>">
                                <svg style="color:inherit" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path fill="currentColor" d="M160 0c-23.7 0-44.4 12.9-55.4 32H48C21.5 32 0 53.5 0 80V400c0 26.5 21.5 48 48 48H192V176c0-44.2 35.8-80 80-80h48V80c0-26.5-21.5-48-48-48H215.4C204.4 12.9 183.7 0 160 0zM272 128c-26.5 0-48 21.5-48 48V448v16c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V256H416c-17.7 0-32-14.3-32-32V128H320 272zM160 40a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm256 88v96h96l-96-96z"/></svg>
                                </button>
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