//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Signup Popup');

    //POPULATE PAGE SELECT
    var pages = [ 'page' ];
    htheme_pages_options(pages);

    //SET DATA
    htheme_set_data();

    //CONVERT COMPONENTS
    htheme_convert_components();

    //UPDATE DATA
    htheme_update_data();

});

function htheme_set_data(){

    //VARIABLES
    var _status = global_options.settings.newsletter.status;
    var _page = global_options.settings.newsletter.page;
    var _title = global_options.settings.newsletter.title;
    var _info = global_options.settings.newsletter.info;
    var _backgroundImage = global_options.settings.newsletter.backgroundImage;
    var _backgroundSize = global_options.settings.newsletter.backgroundSize;
    var _backgroundPosition = global_options.settings.newsletter.backgroundPosition;
    var _sendToEmail = global_options.settings.newsletter.sendToEmail;

    //SET DATA
    if(_status){
        if(jQuery('#status').val() == _status){
            jQuery('#status').attr('checked', 'checked');
        }
    }

    if(_page){
        jQuery('#page option').each(function(index, element) {
            if(jQuery(this).val() == _page){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_title){
        jQuery('#title').val(_title);
    }

    if(_info){
        jQuery('#info').val(_info);
    }

    if(_backgroundImage){
        jQuery('#backgroundImage').val(_backgroundImage);
        //SET IMAGE
        jQuery('#image_backgroundImage').css({
            'background-image' : 'url('+_backgroundImage+')'
        });
    }

    if(_backgroundSize){
        jQuery('#backgroundSize option').each(function(index, element) {
            if(jQuery(this).val() == _backgroundSize){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_backgroundPosition){
        jQuery('#backgroundPosition option').each(function(index, element) {
            if(jQuery(this).val() == _backgroundPosition){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_sendToEmail){
        jQuery('#sendToEmail').val(_sendToEmail);
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _status = jQuery('#status');
    var _page = jQuery('#page');
    var _title = jQuery('#title');
    var _info = jQuery('#info');
    var _backgroundImage = jQuery('#backgroundImage');
    var _backgroundSize = jQuery('#backgroundSize');
    var _backgroundPosition = jQuery('#backgroundPosition');
    var _sendToEmail = jQuery('#sendToEmail');

    //UPDATE
    jQuery(_status).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.newsletter.status = jQuery(this).val() : global_options.settings.newsletter.status = false;
        htheme_flag_save(true);
    });

    jQuery(_page).on('change', function(){
        global_options.settings.newsletter.page = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_title).on('change', function(){
        global_options.settings.newsletter.title = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_info).on('change', function(){
        global_options.settings.newsletter.info = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_backgroundImage).on('change', function(){
        global_options.settings.newsletter.backgroundImage = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_backgroundImage').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_backgroundSize).on('change', function(){
        global_options.settings.newsletter.backgroundSize = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_backgroundPosition).on('change', function(){
        global_options.settings.newsletter.backgroundPosition = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_sendToEmail).on('change', function(){
        global_options.settings.newsletter.sendToEmail = jQuery(this).val();
        htheme_flag_save(true);
    });

}
