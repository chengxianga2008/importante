//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('WPML Settings');

    //SET DATA
    htheme_set_data();

    //UPDATE DATA
    htheme_update_data();

    //CONVERT COMPONENTS
    htheme_convert_components();

});

//SET DATA
function htheme_set_data(){

    //VARIABLES
    var _wpmlSelector = global_options.settings.wpml.wpmlSelector;

    if(_wpmlSelector){
        if(jQuery('#wpmlSelector').val() == _wpmlSelector){
            jQuery('#wpmlSelector').attr('checked', 'checked');
        }
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _wpmlSelector = jQuery('#wpmlSelector');

    jQuery(_wpmlSelector).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.general.wpmlSelector = jQuery(this).val() : global_options.settings.general.wpmlSelector = false;
        htheme_flag_save(true);
    });

}

