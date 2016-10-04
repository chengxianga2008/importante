//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Blog');

    //SET DATA
    htheme_set_data();

    //UPDATE DATA
    htheme_update_data();

});

function htheme_set_data(){

    //VARIABLES
    var _layout = global_options.settings.blog.layout;
    var _singleLayout = global_options.settings.blog.singleLayout;
    var _socialIcons = global_options.settings.blog.socialIcons;
    var _tags = global_options.settings.blog.tags;
    var _author = global_options.settings.blog.author;
    var _masonry = global_options.settings.blog.masonry;

    //SET DATA
    if(_layout){
        jQuery('#layout option').each(function(index, element) {
            if(jQuery(this).val() == _layout){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_singleLayout){
        jQuery('#singleLayout option').each(function(index, element) {
            if(jQuery(this).val() == _singleLayout){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_socialIcons){
        if(jQuery('#socialIcons').val() == _socialIcons){
            jQuery('#socialIcons').attr('checked', 'checked');
        }
    }

    if(_tags){
        if(jQuery('#tags').val() == _tags){
            jQuery('#tags').attr('checked', 'checked');
        }
    }

    if(_author){
        if(jQuery('#author').val() == _author){
            jQuery('#author').attr('checked', 'checked');
        }
    }

    if(_masonry){
        if(jQuery('#masonry').val() == _masonry){
            jQuery('#masonry').attr('checked', 'checked');
        }
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _layout = jQuery('#layout');
    var _singleLayout = jQuery('#singleLayout');
    var _socialIcons = jQuery('#socialIcons');
    var _tags = jQuery('#tags');
    var _author = jQuery('#author');
    var _masonry = jQuery('#masonry');

    //UPDATE
    jQuery(_layout).on('change', function(){
        global_options.settings.blog.layout = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_singleLayout).on('change', function(){
        global_options.settings.blog.singleLayout = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_socialIcons).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.blog.socialIcons = jQuery(this).val() : global_options.settings.blog.socialIcons = false;
        htheme_flag_save(true);
    });

    jQuery(_tags).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.blog.tags = jQuery(this).val() : global_options.settings.blog.tags = false;
        htheme_flag_save(true);
    });

    jQuery(_author).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.blog.author = jQuery(this).val() : global_options.settings.blog.author = false;
        htheme_flag_save(true);
    });

    jQuery(_masonry).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.blog.masonry = jQuery(this).val() : global_options.settings.blog.masonry = false;
        htheme_flag_save(true);
    });

}
