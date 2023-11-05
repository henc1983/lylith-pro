jQuery(function($){  

    /**
     * Shortcode Copier Function
     * @returns void
     */
    function copyShortcode(event) {
        event.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(`[adatok n="${$(event.currentTarget).data('shortcode')}"]`).select();
        let result = document.execCommand("copy");
        $temp.remove();
        
        if(result) { 
            $('#lylith-pro-admin-messages').createMessage(LylithProAdminLocalize.i18n.copy_success_msg);
        }
        else {
            $('#lylith-pro-admin-messages').createMessage(LylithProAdminLocalize.i18n.copy_error_msg, 'danger');
        }
    }

    $.fn.createMessage = function(msg, msgClass = 'success', duration = 2000) {
        return $(this).each(function(){
            let alert = $("<p></p>").text(msg).addClass(`alert alert-${msgClass}`).css('display', 'none');
            $(this).append(alert);
            $(alert).slideDown(200).delay(2000).slideUp(200, function(){$(this).remove()});
        })
    }

    /**
     * Shortcode Copier Button
     */
    $('button[data-shortcode]').on('click', copyShortcode );
    $('button.plugin-install-button').on('click', clickPluginInstallButton);
    $('button.admin-submit-button').on('click', submitAdminPanel );

    

    function submitAdminPanel(event) {
        event.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
        
        const spinner = $('<div class="spinner-border spinner-border-sm text-white"></div>')

        const inputList = $(event.target.form).find('input.lylith-pro-admin-input, input[type="checkbox"]');
        var dataObjectList = []

        $(inputList).each(function(i,e){
            dataObjectList.push({name: e.id, value: e.type === 'checkbox' ? $(e).prop('checked') : e.value});
        })

        $.ajax({
            url: `${LylithProAdminLocalize.wp_rest_url}/lylithpro/v2/set_options`,
            method:'POST',
            dataType:'json',
            data : dataObjectList,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', LylithProAdminLocalize.wp_rest_nonce);
                $(event.currentTarget).append(spinner);
                $(event.currentTarget).attr('disabled', true)
            },
            success: function(response){
                let msg = '';
                let msgType = 'success';
                if(response.success === true) {
                    $(event.currentTarget).find('svg').removeClass('hidden').delay(2000).fadeOut(200, function(){$(this).addClass('hidden')});
                    msg = LylithProAdminLocalize.i18n.success_msg;
                }
                else {
                    msg = LylithProAdminLocalize.i18n.error_msg;
                }
                $('#lylith-pro-admin-messages').createMessage(msg, msgType);
            },
            complete: function() {
                $(spinner).remove();
                $(event.currentTarget).removeAttr('disabled');    
            }
        });
    }



    function clickPluginInstallButton(event) {
        event.preventDefault();
        var target = $(event.currentTarget);
        var grandparent = $(event.currentTarget.parentElement.parentElement);
        var parent = $(event.currentTarget.parentElement);
        const spinner = parent.find('.spinner-border');
    
        $.ajax({
            type: 'post',
            url: LylithProAdminLocalize.ajax_url,
            data: {
                action: 'wp_ajax_install_plugin',
                _ajax_nonce: LylithProAdminLocalize.wp_updates_nonce, 
                slug: target.data('slug'),
            },
            beforeSend: function(){
                $(spinner).removeClass('d-none')
            },
            success: function(response) {
                let msg = '';
                let msgType = 'success';
                if(!response.success === true) {
                    msg = `${LylithProAdminLocalize.i18n.install_error_msg}: ${target.data('title')}`;
                    msgType = 'danger';

                }
                else {
                    msg = `${LylithProAdminLocalize.i18n.install_success_msg}: ${target.data('title')}`;
                    grandparent.find('input').removeAttr("disabled");
                    parent.remove(); 
                }
                $('#lylith-pro-admin-messages').createMessage(msg, msgType, 5000);
            },
            complete: function(){
                $(spinner).addClass('d-none');
            },
        });
    }

});