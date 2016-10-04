//META BOX SETTINGS

//INSTANTIATE JQUERY
jQuery(function(){

    //SET META DATA
    htheme_set_meta_data();

    //ENABLE REMOVE IMAGES
    htheme_set_remove();

    //SET UPDATE DATA
    htheme_set_meta_update();

});

function htheme_set_remove(){

    jQuery('.htheme_remove_image').on('click', function(){
        var input_to_remove = jQuery(this).attr('data-input');
        jQuery('#'+input_to_remove).val('');
        jQuery('#'+input_to_remove).trigger('change');
    });

}

function htheme_set_meta_data(){

    var _layout = jQuery('#htheme_meta_layout').val();

    if(_layout){
        jQuery('.htheme_meta_layout_selector').each(function(){
            if( jQuery(this).attr('data-value')==_layout ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
    }

    var _meta_image = jQuery('#htheme_meta_image').val();

    if(_meta_image){
        jQuery('#htheme_meta_image').val(_meta_image);
        //SET IMAGE
        jQuery('#image_htheme_meta_image').css({
            'background-image' : 'url('+_meta_image+')'
        });
    }

    var _meta_image_featured = jQuery('#htheme_meta_image_featured').val();

    if(_meta_image_featured){
        jQuery('#htheme_meta_image_featured').val(_meta_image_featured);
        //SET IMAGE
        jQuery('#image_htheme_meta_image_featured').css({
            'background-image' : 'url('+_meta_image_featured+')'
        });
    }

    var _meta_fullscreen = jQuery('#htheme_meta_fullscreen');
    var _meta_meta_height = jQuery('#htheme_meta_height');
    jQuery(_meta_fullscreen).prop('checked') ? jQuery(_meta_meta_height).prop('disabled', true) : jQuery(_meta_meta_height).prop('disabled', false);

    var _meta_type_image_signature = jQuery('#htheme_meta_type_image_signature').val();

    if(_meta_type_image_signature){
        jQuery('#htheme_meta_type_image_signature').val(_meta_type_image_signature);
        //SET IMAGE
        jQuery('#image_htheme_meta_type_image_signature').css({
            'background-image' : 'url('+_meta_type_image_signature+')'
        });
    }

    var _meta_image_gallery = jQuery('#htheme_meta_image_gallery').val();

    if(_meta_image_gallery){
        jQuery('#htheme_meta_image_gallery').val(_meta_image_gallery);
        //BUILD ARRAY OF IMAGES
        var img_array = _meta_image_gallery.split(',');
        //LOAD IMAGE TO SCREEN
        var img_html = '';
        jQuery(img_array).each(function(index, element){
            img_html += '<div class="htheme_gallery_img" style="background-image:url('+element+')"></div>';
        });
        jQuery('#image_htheme_meta_image_gallery').html(img_html);
    }

}

function htheme_set_meta_update(){

    var _layout = jQuery('.htheme_meta_layout_selector');

    jQuery(_layout).on('click', function(){

        //VARIABLES
        var the_value = jQuery(this).attr('data-value');

        //LOOP AND CHECK
        jQuery(_layout).each(function(){
            if( jQuery(this).attr('data-value') == the_value ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
        //SET VARIABLE
        jQuery('#htheme_meta_layout').val(the_value);

    });

    var _meta_fullscreen = jQuery('#htheme_meta_fullscreen');
    var _meta_meta_height = jQuery('#htheme_meta_height');
    jQuery(_meta_fullscreen).on('change', function(){
        jQuery(this).prop('checked') ? jQuery(_meta_meta_height).prop('disabled', true) : jQuery(_meta_meta_height).prop('disabled', false);
    });

    var _meta_image = jQuery('#htheme_meta_image');

    jQuery(_meta_image).on('change', function(){
        //SET IMAGE
        jQuery('#image_htheme_meta_image').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
    });

    var _meta_image_featured = jQuery('#htheme_meta_image_featured');

    jQuery(_meta_image_featured).on('change', function(){
        //SET IMAGE
        jQuery('#image_htheme_meta_image_featured').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
    });

    var _meta_type_image_signature = jQuery('#htheme_meta_type_image_signature');

    jQuery(_meta_type_image_signature).on('change', function(){
        //SET IMAGE
        jQuery('#image_htheme_meta_type_image_signature').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
    });

    var _meta_widget_image = jQuery('body').find('[data-widget-field="htheme_widget_image_input"]');

    jQuery(_meta_widget_image).on('change', function(){
        //SET IMAGE
        jQuery('.htheme_widget_image').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
    });

    var _meta_image_gallery = jQuery('#htheme_meta_image_gallery');

    jQuery(_meta_image_gallery).on('change', function(){
        //BUILD ARRAY OF IMAGES
        var img_array = jQuery(this).val().split(',');
        //LOAD IMAGE TO SCREEN
        var img_html = '';
        jQuery(img_array).each(function(index, element){
            img_html += '<div class="htheme_gallery_img" style="background-image:url('+element+')"></div>';
        });
        jQuery('#image_htheme_meta_image_gallery').html(img_html);
    });

}





