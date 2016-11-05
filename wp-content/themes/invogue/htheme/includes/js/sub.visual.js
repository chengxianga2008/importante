//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Visual Composer Advanced Settings');

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
    var _visualElements = global_options.settings.visual.visualElements;

    if(_visualElements){
        if(jQuery('#visualElements').val() == _visualElements){
            jQuery('#visualElements').attr('checked', 'checked');
        }
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _visualElements = jQuery('#visualElements');

    jQuery(_visualElements).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.visual.visualElements = jQuery(this).val() : global_options.settings.visual.visualElements = false;
        htheme_flag_save(true);
    });

}
