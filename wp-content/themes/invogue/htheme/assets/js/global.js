//SETTINGS
var global_options;
var htheme_save_status = false;
var global_fonts;
var global_search_fonts = [];
var global_pages;
var global_signups;

jQuery(function(){

    //SET THE SIDEBAR
    htheme_get_options();

    //GET GOOGLE FONTS
    htheme_get_google_fonts();

    //GET PAGES
    htheme_get_pages();

    //GET SIGNUPS
    htheme_get_signups();

    //SET SAVE
    htheme_flag_save(htheme_save_status);

});

function htheme_set_remove(){

    jQuery('.htheme_remove_image').on('click', function(){
        var input_to_remove = jQuery(this).attr('data-input');
        jQuery('#'+input_to_remove).val('');
        jQuery('#'+input_to_remove).trigger('change');
    });

}

/*
 **************** PAGES
 */

//GET PAGES
function htheme_get_pages(){

    //GET TEST OBJECT
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
            'action': 'htheme_get_pages'
        },
        dataType: "json"
    }).done(function(data){
        global_pages = data;
    }).fail(function(event){
        //IF FAILED
    });

}

/*
 **************** SIGNUPS
 */

//GET SIGNUPS
function htheme_get_signups(){
    //GENERATE
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
            'action': 'htheme_get_signups'
        },
        dataType: "json"
    }).done(function(data){
        global_signups = data;
    }).fail(function(event){
        console.log(event);
    });
}

/*
**************** GOOGLE FONTS
 */

//GOOGLE FONTS
function htheme_get_google_fonts(){

    //AJAX CALL FOR GOOGLE FONTS
    jQuery.ajax({
        url: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCe3XGw8IKuzIXe7bL6ZQc1xbe3MX5DR-s',
        type: "GET",
        dataType: "json"
    }).done(function(data){
        //SET GLOBAL VARIABLE
        global_fonts = data.items;
        //SETUP SEARCH ARRAY
        htheme_setup_search_fonts(data.items);
    }).fail(function(){
    });

}

//SETUP SEARCH ARRAY
function htheme_setup_search_fonts(data){

    //LOOP AND PUSH VALUES INTO GLOBAL ARRAY FOR SEARCH
    jQuery(data).each(function(index, element){
        global_search_fonts.push(element.family);
    });

}

//GET FONT HTML
function htheme_fonts_options(select_elements){

    var html = '';

    jQuery(select_elements).each(function(index, element){

        //POPULATE OPTIONS FOR EACH SELECT
        jQuery(global_search_fonts).each(function(idx,ele){
            html += "<option value='"+ele+"'>"+ele+"</option>";
        });

        jQuery('#'+element).html(html);

    });

}

//GET SELECT HTML
function htheme_pages_options(select_elements){

    var html = '';

    html += "<option value=''>Select a page</option>";

    jQuery(select_elements).each(function(index, element){

        //POPULATE OPTIONS FOR EACH SELECT
        jQuery(global_pages).each(function(idx,ele){
            html += "<option value='"+ele['ID']+"'>"+ele['post_title']+"</option>";
        });

        jQuery('#'+element).html(html);

    });

}

/*
 **************** GOOGLE FONTS
 */

//SHOW MESSAGES
function htheme_show_message_box(load_area, message, box_color){

    //VARIABLES
    var message_html = '';

    //HTML
    message_html += '<!-- CAUTION BOX -->';
        message_html += '<div class="htheme_caution_box '+box_color+' htheme_margin_bottom_20">';
            message_html += message;
        message_html += '</div>';
    message_html += '<!-- CAUTION BOX -->';

    //INSERT HTML
    jQuery(load_area).html(message_html);

}

//GET OPTIONS
function htheme_get_options(){

    //GET TEST OBJECT
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
            'action': 'htheme_object_get'
        },
        dataType: "json"
    }).done(function(data){
        //SET OPTIONS TO GLOBAL
        global_options = data;
        //ENABLE SIDEBAR
        htheme_enable_sidebar();
        //SET SIDEBAR ANIMATION
        htheme_set_sidebar_animation();
    }).fail(function(event){
        //IF FAILED
    });

}

//SET SAVE FLAG ON BUTTON
function htheme_flag_save(status){

    if(status){
        //REBIND THE CLICK
        jQuery('.htheme_save_button').removeClass('htheme_no_save').bind('click');
        //SET THE SAVE
        htheme_set_save();
        //SET STATUS
        htheme_save_status = true;
    } else {
        //UNBIND THE CLICK
        jQuery('.htheme_save_button').addClass('htheme_no_save').unbind('click');
        //SET STATUS
        htheme_save_status = false;
    }

}

//SAVE OPTIONS
function htheme_set_save(){

    //SAVE OBJECT
    jQuery('.htheme_save_button').off().on('click', function(){
        htheme_enable_save(true);
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'options':global_options,
                'action': 'htheme_object_save'
            },
            dataType: "json"
        }).done(function(data){
            //SHOW VISUAL FLAG OF SAVE
            htheme_set_flag('save');
            //SET LOADER
            htheme_flag_save(false);
            //SET THE SAVE BUTTON (ON/OFF)
            htheme_enable_save(false);
        }).fail(function(event){
            //console.log(event);
        });
    });

}

//SHOW SAVE TYPE
function htheme_set_flag(flagtype){

    //CHECK WHAT TYPE OF FLAG IT IS
    switch(flagtype){
        case 'save':
            htheme_show_save(flagtype);
            break;
        case 'error':
            htheme_show_save(flagtype);
            break;
        case 'caution':
            break;
        case 'layout':
            htheme_show_save(flagtype);
            break;
        case 'import':
            htheme_show_save(flagtype);
            break;
    }

}

//SHOW SAVE
function htheme_show_save(flagtype){

    //ELEMENT
    var save_element = jQuery('.inner_'+flagtype);

    //KILL THE PREVIOUS TWEEN
    //TweenMax.killTweensOf(save_element);

    //ADD HTML
    jQuery('.htheme_status_holder').html('<div class="inner_'+flagtype+'"></div>');

    //ANIMATION
    TweenMax.to( jQuery('.inner_'+flagtype), 1, {
            css:{
                opacity:1,
                top:'-150px'
            },
            ease:Back.easeOut,
            onComplete:function(){
                TweenMax.to(jQuery('.inner_'+flagtype), 1, {
                        css:{
                            opacity:0,
                            left:'100%',
                            rotation:10
                        }, delay:2, ease:Back.easeIn,
                        onComplete:function(){
                            jQuery('.inner_'+flagtype).remove();
                        }
                    }
                );
            }
        }
    );

}

//ENABLE SAVE
function htheme_enable_save(status){

    //VARIABLES
    var status_opacity = 0;
    var status_text_opacity = 1;

    //CHECK SAVE STATUS
    if(status){
        status_opacity = 1;
        status_text_opacity = 0;
    }

    //ANIMATION
    TweenMax.to( jQuery('.htheme_loading'), 1, {
            opacity:status_opacity,
            ease:Strong.easeOut
        }
    );

    //SAVE TEXT
    TweenMax.to( jQuery('.htheme_inner_save'), 1, {
            opacity:status_text_opacity,
            ease:Strong.easeOut
        }
    );

}

//ENABLE SIDEBAR CLICK
function htheme_enable_sidebar(){

    //ADD CLICK
    jQuery('.htheme_sidebar .htheme_control_nav li').off().on('click', function(){
        //REMOVE ANY OCCURRENCE OF THE ACTIVE STATE
        jQuery("*").removeClass('htheme_active_side');
        //FADE IN LOADER
        TweenMax.to( jQuery('.htheme_page_loader'), 0, {
                opacity:1,
                ease:Strong.easeOut
            }
        );
        //FADEOUT CONTENT
        TweenMax.to( jQuery('.htheme_form_controls'), 0.3, {
                opacity:0,
                ease:Strong.easeOut
            }
        );
        if(jQuery(this).attr('data-slug')){
            var slug = jQuery(this).attr('data-slug');
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    'slug':slug,
                    'dir':global_theme_directory,
                    'action': 'htheme_get_backend_pages'
                },
                dataType: "html"
            }).done(function(data){
                jQuery('.htheme_form_controls').html(data);
                TweenMax.to( jQuery('.htheme_page_loader'), 0, {
                        opacity:0,
                        ease:Strong.easeOut
                    }
                );
                //FADE IN CONTENT
                TweenMax.to( jQuery('.htheme_form_controls'), 0.3, {
                        opacity:1,
                        ease:Strong.easeOut
                    }
                );
            }).fail(function(event){
                console.log(event);
            });
        }
        //ADD ACTIVE STATE
        jQuery(this).addClass('htheme_active_side');
    });

    //TRIGGER FIRST LOAD
    jQuery('.htheme_sidebar li').first().trigger('click');

}

//SET PAGE HEADER
function htheme_set_header(name){
    //SET NAME
    jQuery('.htheme_heading').html(name);
}

//SAVE MANAGEMENT

jQuery(window).on('beforeunload', function(e){
    if(htheme_save_status){
        return 'You have unsaved data!';
    }
});



