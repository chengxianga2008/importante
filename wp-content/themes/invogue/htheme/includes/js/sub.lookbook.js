//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Lookbooks');

    //SET DATA
    htheme_set_data();

    //CONVERT COMPONENTS
    htheme_convert_components();

    //UPDATE DATA
    htheme_update_data();

});

function htheme_set_data(){

    //VARIABLES
    var _layout = global_options.settings.lookbook.layout;
    var _divider = global_options.settings.lookbook.divider;
    var _dividerColor = global_options.settings.lookbook.dividerColor;

    //SET DATA
    if(_layout){
        jQuery('#layout option').each(function(index, element) {
            if(jQuery(this).val() == _layout){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_divider){
        jQuery('#divider option').each(function(index, element) {
            if(jQuery(this).val() == _divider){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_dividerColor){
        jQuery('#dividerColor').val(_dividerColor);
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _layout = jQuery('#layout');
    var _divider = jQuery('#divider');
    var _dividerColor = jQuery('#dividerColor');

    //UPDATE
    jQuery(_layout).on('change', function(){
        global_options.settings.lookbook.layout = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_divider).on('change', function(){
        global_options.settings.lookbook.divider = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_dividerColor).on('change', function(){
        global_options.settings.lookbook.dividerColor = jQuery(this).val();
        htheme_flag_save(true);
    });

}
