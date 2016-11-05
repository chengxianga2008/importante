//HEROTHEME MENU CONTROLLER FUNCTIONS
var htheme_global_options;
var htheme_global_pages;

jQuery(function(){

    //GET OBJECT
    htheme_get_options();

    //GET PAGES
    htheme_get_pages();

});

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
        htheme_global_options = data;

        //ADD TAGS TO MENU ITEMS
        htheme_bind_mega_tags();

        //BIND MENU ITEM LISTENER
        htheme_bind_mega_listeners();

    }).fail(function(event){
        //IF FAILED
    });

}

//GET OPTIONS
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

        //SET OPTIONS TO GLOBAL
        htheme_global_pages = data;

    }).fail(function(event){
        //IF FAILED
    });

}

//ADD TAGS TO MENU ITEMS
function htheme_bind_mega_tags(){

    //VARIABLES
    var htheme_controls = jQuery('.item-controls');

    //ADD TAGS
    htheme_controls.append('<div class="htheme_tag_holder">Mega Menu</div>');

    jQuery('.item-controls').each(function(){
        //VARIABLES
        var htheme_id = jQuery(this).parents('li').attr('id').replace('menu-item-', '');
        var htheme_type = jQuery(this).children('.item-type').html();
        var htheme_title = jQuery(this).prev('span').children('.menu-item-title').html();
        //SET ID
        jQuery(this).children('.htheme_tag_holder').attr('data-menu-id', htheme_id);
        //SET TYPE
        jQuery(this).children('.htheme_tag_holder').attr('data-menu-type', htheme_type);
        //SET ITEM TITLE
        jQuery(this).children('.htheme_tag_holder').attr('data-menu-item-title', htheme_title);
    });

    htheme_set_active_mega();

}

//SET ACTIVE
function htheme_set_active_mega(){

    jQuery('.htheme_tag_holder').removeClass('htheme_active_mega_menu');

    jQuery('.htheme_tag_holder').each(function(index, element){
        var id = jQuery(this).attr('data-menu-id');
        jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(idx, ele){
            if(id === ele.id && ele.enable === 'on'){
                jQuery('[data-menu-id="'+id+'"]').addClass('htheme_active_mega_menu');
            }
        });
    });

}

//BIND MENU ITEM LISTENER
function htheme_bind_mega_listeners(){

    //VARIABLES
    var htheme_settings = jQuery('.htheme_mega_menu_settings');

    //ADD CLICKS
    jQuery('.htheme_tag_holder').on('click', function(){

        var htheme_settings_toggle = jQuery('.htheme_mega_menu_settings').attr('data-mega-toggle');
        var htheme_id = jQuery(this).attr('data-menu-id');
        var htheme_type = jQuery(this).attr('data-menu-type');
        var htheme_title = jQuery(this).attr('data-menu-item-title');

        if(htheme_settings_toggle === 'open'){
            TweenMax.to(htheme_settings, 1, {
                    bottom:0,
                    ease:Power4.easeInOut,
                    force3D:true
                }
            );
            jQuery('.htheme_mega_menu_settings').attr('data-mega-toggle', 'close');
        }

        //SET DATA
        htheme_set_menu_item_data(htheme_id, htheme_type, htheme_title);

    });

    //CLOSE
    jQuery('.htheme_menu_close').on('click', function(){

        TweenMax.to(htheme_settings, 1, {
                bottom:-450,
                ease:Power4.easeInOut,
                force3D:true
            }
        );
        jQuery('.htheme_mega_menu_settings').attr('data-mega-toggle', 'open');

    });

}

function htheme_set_menu_item_data(id,type,title){

    //SET STATIC VALUES IN HTML
    jQuery('.htheme_menu_detail span a').html(id);
    jQuery('.htheme_menu_detail > a').html(title);
    jQuery('.htheme_mega_menu_settings').attr('data-item-id', id);

    //VARIABLES
    htmeme_add_status = true;

    //IF ITEM HAS DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){
            htmeme_add_status = false;
        }
    });

    //IF FALSE GET EXISTING DATA, IF TRUE ADD NEW DATA
    switch(htmeme_add_status){
        case true:
            htheme_add(id,type,title);
        break;
        case false:
            //htheme_insert_new(id,type,title);
            htheme_set_data(id,type,title);
        break;
    }

    //ENABLE SIDE NAV
    htheme_side_nav();

    jQuery('.htheme_nav_button').first().trigger('click');

    //SET UPDATE
    htheme_update_data(id,type,title);

}

//ENABLE SIDE NAV
function htheme_side_nav(){

    jQuery('.htheme_nav_button').on('click', function(){

        //VARIABLES
        var attr = jQuery(this).attr('data-id');

        //SIDENAV
        jQuery('.htheme_nav_button').removeClass('htheme_active');
        jQuery(this).addClass('htheme_active');

        //CONTENT
        jQuery('.htheme_container').removeClass('htheme_active_content');
        jQuery('#'+attr).addClass('htheme_active_content');
    });

}

//ADD NEW OBJECT
function htheme_add(id,type,title){

    //VARIABLES
    var htheme_menu_item_json = {
        id:id,
        enable:'off',
        enableMobile:'yes',
        columnLayout:'3',
        backgroundImage:'',
        backgroundPosition:'center',
        backgroundSize:'contain',
        backgroundColor:'#FFFFFF',
        fontPrimary:'',
        fontSecondary:'',
        underlineTitle:'yes',
        underlineColor:'#EFEFEF',
        border:'no',
        borderColor:'#EFEFEF',
        shadow:'no',
        shadowColor:'#CCCCCC',
        menuData:[]
    };

    //PUSH DATA INTO GLOBAL OBJECT
    htheme_global_options.settings.megamenu.menuItems.push(htheme_menu_item_json);

    //LOAD COL DATA
    htheme_populate_column_data(3,id);

    //SET THE DATA AFTER IT HAS BEEN ADDED
    htheme_set_data(id,type,title);

    //SET SAVE
    htheme_flag_save(true);

}

//SET EXISTING DATA
function htheme_set_data(id,type,title){

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //VARIABLES
            var htheme_menu_id = element.id;
            var htheme_menu_enable = element.enable;
            var htheme_menu_cols = element.columnLayout;
            var htheme_menu_col_data = element.menuData;

            var htheme_background_image = element.backgroundImage;
            var htheme_background_position = element.backgroundPosition;
            var htheme_background_color = element.backgroundColor;
            var htheme_background_size = element.backgroundSize;

            var htheme_font_primary = element.fontPrimary;
            var htheme_font_secondary = element.fontSecondary;

            var htheme_underline = element.underlineTitle;
            var htheme_underline_color = element.underlineColor;

            var htheme_border = element.border;
            var htheme_border_color = element.borderColor;

            var htheme_shadow = element.shadow;
            var htheme_shadow_color = element.shadowColor;

            var htheme_mobile = element.enableMobile;

            /////////////////////////////
            // LAYOUT SETTINGS
            /////////////////////////////

            //INPUTS
            var htheme_input_enable = jQuery('[data-item-id="'+id+'"]').find('.htheme_enable_mega');
            var htheme_input_columns = jQuery('[data-columns="'+htheme_menu_cols+'"]');

            //SET ENABLE
            if(htheme_menu_enable !== 'off'){
                htheme_input_enable.attr('data-enable', 'on');
            } else {
                htheme_input_enable.attr('data-enable', 'off');
            }

            //SET COLUMNS
            jQuery('.htheme_layout_select_holder').removeClass('htheme_active_column');
            if(htheme_menu_cols){
                htheme_input_columns.addClass('htheme_active_column');
            }

            //SET COLUMN HTML
            htheme_set_column_html(htheme_menu_col_data,id);

            //SET COLUMN DATA
            htheme_set_column_data(htheme_menu_col_data,id);

            /////////////////////////////
            // BACKGROUND SETTINGS
            /////////////////////////////


            //SET IMAGE
            jQuery('#htheme_bg_image').val(htheme_background_image);
            jQuery('#image_htheme_bg_image').css({
                'background-image' : 'url('+htheme_background_image+')'
            });


            if(htheme_background_position){
                jQuery('#htheme_bg_position option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_background_position){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            if(htheme_background_color){
                jQuery('#htheme_bg_color').val(htheme_background_color);
                jQuery('#htheme_bg_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_background_color});
            }

            if(htheme_background_size){
                jQuery('#htheme_bg_size option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_background_size){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            if(htheme_font_primary){
                jQuery('#htheme_font_primary').val(htheme_font_primary);
                jQuery('#htheme_font_primary').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_font_primary});
            }

            if(htheme_font_secondary){
                jQuery('#htheme_font_secondary').val(htheme_font_secondary);
                jQuery('#htheme_font_secondary').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_font_secondary});
            }

            /////////////////////////////
            // STYLING SETTINGS
            /////////////////////////////

            if(htheme_underline){
                jQuery('#htheme_underline option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_underline){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            if(htheme_underline_color){
                jQuery('#htheme_underline_color').val(htheme_underline_color);
                jQuery('#htheme_underline_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_underline_color});
            }

            if(htheme_border){
                jQuery('#htheme_border option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_border){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            if(htheme_border_color){
                jQuery('#htheme_border_color').val(htheme_border_color);
                jQuery('#htheme_border_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_border_color});
            }

            if(htheme_shadow){
                jQuery('#htheme_shadow option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_shadow){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            if(htheme_shadow_color){
                jQuery('#htheme_shadow_color').val(htheme_shadow_color);
                jQuery('#htheme_shadow_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':htheme_shadow_color});
            }

            if(htheme_mobile){
                jQuery('#htheme_mobile_enable option').each(function(index, element) {
                    if(jQuery(this).val() == htheme_mobile){
                        jQuery(this).attr('selected', 'selected')
                    }
                });
            }

            //CONVERT COMPONENTS
            htheme_convert_components();

        }
    });

}

//GET EXISTING DATA
function htheme_update_data(id,type,title){

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //VARIABLES
            var htheme_menu_enable = jQuery('.htheme_enable_mega');

            var htheme_background_image = jQuery('#htheme_bg_image');
            var htheme_background_position = jQuery('#htheme_bg_position');
            var htheme_background_color = jQuery('#htheme_bg_color');
            var htheme_background_size = jQuery('#htheme_bg_size');

            var htheme_font_primary = jQuery('#htheme_font_primary');
            var htheme_font_secondary = jQuery('#htheme_font_secondary');

            var htheme_underline = jQuery('#htheme_underline');
            var htheme_underline_color = jQuery('#htheme_underline_color');

            var htheme_border = jQuery('#htheme_border');
            var htheme_border_color = jQuery('#htheme_border_color');

            var htheme_shadow = jQuery('#htheme_shadow');
            var htheme_shadow_color = jQuery('#htheme_shadow_color');

            var htheme_mobile = jQuery('#htheme_mobile_enable');

            jQuery('.htheme_layout_select_holder').on('click', function(){
                var htheme_columns = jQuery(this).attr('data-columns');
            });

            jQuery(htheme_menu_enable).off().on('click', function(){
                var data = jQuery(this).attr('data-enable');
                if(data === 'on'){
                    jQuery(this).attr('data-enable', 'off');
                } else {
                    jQuery(this).attr('data-enable', 'on');
                }
                element.enable = jQuery(this).attr('data-enable');
                htheme_global_options.settings.megamenu.menuItems[index].enable = jQuery(this).attr('data-enable');
                htheme_set_active_mega();
                htheme_flag_save(true);
            });

            //ENABLE COL SELECTION
            htheme_enable_col_data_select(id,type,title);

            //ENABLE COL SELECTION
            htheme_enable_col_select(id,type,title);

            /////////////////////////////
            // BACKGROUND SETTINGS
            /////////////////////////////

            jQuery(htheme_background_image).off().on('change', function(){
                element.backgroundImage = jQuery(this).val();
                //SET IMAGE
                jQuery('#image_htheme_bg_image').css({
                    'background-image' : 'url('+element.backgroundImage+')'
                });
                htheme_flag_save(true);
            });

            jQuery(htheme_background_position).off().on('change', function(){
                element.backgroundPosition = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

            jQuery(htheme_background_color).off().on('change', function(){
                element.backgroundColor = jQuery(this).val();
                jQuery('#htheme_bg_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            jQuery(htheme_background_size).off().on('change', function(){
                element.backgroundSize = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

            jQuery(htheme_font_primary).off().on('change', function(){
                element.fontPrimary = jQuery(this).val();
                jQuery('#htheme_font_primary').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            jQuery(htheme_font_secondary).off().on('change', function(){
                element.fontSecondary = jQuery(this).val();
                jQuery('#htheme_font_secondary').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            /////////////////////////////
            // STYLING SETTINGS
            /////////////////////////////

            jQuery(htheme_underline).off().on('change', function(){
                element.underlineTitle = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

            jQuery(htheme_underline_color).off().on('change', function(){
                element.underlineColor = jQuery(this).val();
                jQuery('#htheme_underline_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            jQuery(htheme_border).off().on('change', function(){
                element.border = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

            jQuery(htheme_border_color).off().on('change', function(){
                element.borderColor = jQuery(this).val();
                jQuery('#htheme_border_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            jQuery(htheme_shadow).off().on('change', function(){
                element.shadow = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

            jQuery(htheme_shadow_color).off().on('change', function(){
                element.shadowColor = jQuery(this).val();
                jQuery('#htheme_shadow_color').parents('.htheme_color_wrap').children('.htheme_sample_holder').css({'background-color':jQuery(this).val()});
                htheme_flag_save(true);
            });

            jQuery(htheme_mobile).off().on('change', function(){
                element.enableMobile = jQuery(this).children('option:selected').val();
                htheme_flag_save(true);
            });

        }
    });

}

//POPULATE COLUMNS
function htheme_populate_column_data(amount,id){

    //CLEAR DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(i,e){
        if(e['id'] === id){ e.menuData = []; }
    });

    //ADD DATA TO MENU ITEM
    for(var count = 0; count < amount; count++){
        //PUSH DATA INTO GLOBAL OBJECT
        jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(i,e){
            if(e['id'] === id){
                e.menuData.push(
                    {
                        title:'My Title',
                        type:'posts',
                        showType:'latest',
                        showHtml:'',
                        showPages:''
                    }
                );
            }
        });
    }

}

//ENABLE COLUMN CHANGER
function htheme_enable_col_select(id,type,title){

    jQuery('.htheme_layout_select_holder').off().on('click', function(){
        //VARIABLES
        var htheme_cols = jQuery(this).attr('data-columns');
        //LOAD COL DATA
        htheme_populate_column_data(htheme_cols,id);
        //SET COL LAYOUT
        jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(i,e){
            if(e['id'] === id){ e.columnLayout = htheme_cols; }
        });
        //SET THE DATA
        htheme_set_data(id,type,title);
        //UPDATE THE DATA
        htheme_update_data(id,type,title);
        //ENABLE SAVE
        htheme_flag_save(true);
    });

}

//SET COLUMN DATA
function htheme_set_column_data(htheme_menu_col_data,id){

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){

        if(element['id'] === id){

            //EACH COL
            jQuery('[data-menu-item-id="'+id+'"]').each(function(i,e){

                //VARIABLES
                var type = element.menuData[i].type;
                var showType = element.menuData[i].showType;
                var showHtml = element.menuData[i].showHtml;
                var showPages = element.menuData[i].showPages;
                var title = element.menuData[i].title;

                //SET TYPE
                if(type){

                    jQuery(this).find('[id="htheme-title-'+i+'"]').val(title);

                    jQuery(this).find('[id="htheme-col-'+i+'"] option').each(function(index, element) {
                        if(jQuery(this).val() == type){
                            jQuery(this).attr('selected', 'selected')
                        }
                    });

                    //POPULATE
                    switch(type){
                        case 'posts':
                            htheme_populate_select(htheme_global_options.settings.megamenu.colData.posts, i, id, showType);
                            break;
                        case 'pages':
                            //PAGES
                            htheme_populate_pages('pages', i, id, showPages);
                            break;
                        case 'categories':
                            //CATEGORIES
                            break;
                        case 'plainHtml':
                            //PLAIN HTML
                            htheme_populate_textarea('plain_html', i, id, showHtml);
                            break;
                        case 'products':
                            htheme_populate_select(htheme_global_options.settings.megamenu.colData.products, i, id, showType);
                            break;
                    }

                }
            });

        }

    });

}

//ENABLE COL SELECTION
function htheme_enable_col_data_select(id,type,title){

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //EACH COL
            jQuery('[data-menu-item-id="'+id+'"]').each(function(i,e){

                //VARIABLES
                var _colSelector = jQuery(this).find('[id="htheme-col-'+i+'"]');
                var _colTitle = jQuery(this).find('[id="htheme-title-'+i+'"]');

                jQuery(_colSelector).off().on('change', function(){

                    var value = jQuery(this).children('option:selected').val();

                    //SET TYPE
                    element.menuData[i].type = value;

                    switch(value){
                        case 'posts':
                            htheme_populate_select(htheme_global_options.settings.megamenu.colData.posts, i, id);
                        break;
                        case 'pages':
                            //PAGES
                            htheme_populate_pages('pages', i, id);
                        break;
                        case 'categories':
                            //CATEGORIES
                        break;
                        case 'plainHtml':
                            //PLAIN HTML
                            htheme_populate_textarea('plain_html', i, id);
                        break;
                        case 'products':
                            htheme_populate_select(htheme_global_options.settings.megamenu.colData.products, i, id);
                        break;
                    }

                    //ENABLE SAVE
                    htheme_flag_save(true);

                });

                jQuery(_colTitle).off().on('change', function(){
                    //SET TYPE
                    element.menuData[i].title = jQuery(this).val();
                    htheme_flag_save(true);
                });

            });

        }

    });

}

//POPULATE TEXTAREA
function htheme_populate_textarea(type, i, id, showHtml){

    //HIDE
    jQuery('.htheme_container').find('[id="htheme-order-col-'+i+'"]').hide();
    jQuery('.htheme_container').find('.htheme_column_pages_id_'+i).hide();
    jQuery('.htheme_container').find('[id="htheme-html-input-'+i+'"]').show();

    //VARIABLES
    var _inputHtml = jQuery('.htheme_container').find('[id="htheme-html-input-'+i+'"]');

    //SET VALUE
    _inputHtml.val(showHtml);

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //EACH COL
            jQuery('[data-menu-item-id="'+id+'"]').each(function(i,e){

                //VARIABLES
                var _inputHtml = jQuery(this).find('[id="htheme-html-input-'+i+'"]');

                jQuery(_inputHtml).off().on('change', function(){

                    //SET HTML
                    element.menuData[i].showHtml = jQuery(this).val();

                    //ENABLE SAVE
                    htheme_flag_save(true);

                });

            });

        }
    });

}

//POPULATE PAGES
function htheme_populate_pages(type, i, id, showPages){

    //HIDE
    jQuery('.htheme_container').find('[id="htheme-order-col-'+i+'"]').hide();
    jQuery('.htheme_container').find('.htheme_column_pages_id_'+i).show();
    jQuery('.htheme_container').find('[id="htheme-html-input-'+i+'"]').hide();

    //VARIABLES
    var _inputHtml = jQuery('.htheme_container').find('[id="htheme-pages-input-'+i+'"]');
    var pages_array = [];

    //SET VALUE
    _inputHtml.val(showPages);

    if(showPages){
        pages_array = _inputHtml.val().split(',');
    }

    //SET TOTAL
    jQuery('.htheme_container').find('.htheme_column_pages_id_'+i+' span a').html(pages_array.length);

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //EACH COL
            jQuery('[data-menu-item-id="'+id+'"]').each(function(idx,e){

                //VARIABLES
                var _inputHtml = jQuery(this).find('[id="htheme-pages-input-'+idx+'"]');

                jQuery(_inputHtml).off().on('change', function(){

                    //SET HTML
                    element.menuData[idx].showPages = jQuery(this).val();

                    //ENABLE SAVE
                    htheme_flag_save(true);

                });

            });

        }
    });

    jQuery('.htheme_page_selector').off().on('click', function(){

        var html = '';
        var id = jQuery(this).attr('data-pages-id');

        TweenMax.to(jQuery('.htheme_pages_overlay'), 1, {
                opacity:1,
                display:'table',
                ease:Power4.easeInOut,
                force3D:true
            }
        );

        jQuery(htheme_global_pages).each(function(index,element){
            html += '<div class="htheme_page_item" data-page-id="'+element['ID']+'" data-page-toggle="off"><span>'+element['post_title']+'</span></div>';
        });

        jQuery('.htheme_load_pages').html(html);

        jQuery('.htheme_page_item').attr('data-page-toggle', 'off');

        pages_array = jQuery('#htheme-pages-input-'+id).val().split(',');

        //SET ACTIVE
        jQuery(pages_array).each(function(idx, ele){
            jQuery('.htheme_load_pages').find('[data-page-id="'+ele+'"]').attr('data-page-toggle', 'on')
        });

        //ENABLE CLICK
        jQuery('.htheme_page_item').off().on('click', function(){

            var page_id = jQuery(this).attr('data-page-id');
            var toggle = jQuery(this).attr('data-page-toggle');

            if(toggle === 'off'){
                jQuery(this).attr('data-page-toggle', 'on');
            } else {
                jQuery(this).attr('data-page-toggle', 'off');
            }

            var ids = '';

            //FIND VALUES
            jQuery('.htheme_page_item').each(function(){
                if(jQuery(this).attr('data-page-toggle') === 'on'){
                    ids += jQuery(this).attr('data-page-id') + ',';
                }
            });

            jQuery('#htheme-pages-input-'+id).val(ids.replace(/,\s*$/, ""));

            pages_array = jQuery('#htheme-pages-input-'+id).val().split(',');

            //SET TOTAL
            jQuery('.htheme_container').find('.htheme_column_pages_id_'+id+' span a').html(pages_array.length);

            jQuery('#htheme-pages-input-'+id).trigger('change');

        });

    });

    jQuery('.htheme_overlay_close').off().on('click', function(){
        TweenMax.to(jQuery('.htheme_pages_overlay'), 1, {
                opacity:0,
                ease:Power4.easeInOut,
                onComplete:function(){
                    jQuery('.htheme_pages_overlay').css({'display':'none'});
                },
                force3D:true
            }
        );
    });

}

//POPULATE SELECT
function htheme_populate_select(values, select_id, id, showType){

    //HIDE
    jQuery('.htheme_container').find('[id="htheme-html-input-'+select_id+'"]').hide();
    jQuery('.htheme_container').find('.htheme_column_pages_id_'+select_id).hide();
    jQuery('.htheme_container').find('[id="htheme-order-col-'+select_id+'"]').show();

    //VARIABLES
    var _orderSelector = jQuery('.htheme_container').find('[id="htheme-order-col-'+select_id+'"]');
    var option_html = '';

    jQuery(values).each(function(key,element){
        if(showType == element){
            option_html += '<option selected value="'+element+'">'+element+'</option>';
        } else {
            option_html += '<option value="'+element+'">'+element+'</option>';
        }
    });

    jQuery(_orderSelector).html(option_html);

    //GET THE ITEM DATA
    jQuery(htheme_global_options.settings.megamenu.menuItems).each(function(index,element){
        if(element['id'] === id){

            //EACH COL
            jQuery('[data-menu-item-id="'+id+'"]').each(function(i,e){

                //VARIABLES
                var _orderSelector = jQuery(this).find('[id="htheme-order-col-'+i+'"]');

                jQuery(_orderSelector).off().on('change', function(){

                    //SET TYPE
                    element.menuData[i].showType = jQuery(this).children('option:selected').val();

                    //ENABLE SAVE
                    htheme_flag_save(true);

                });

            });

        }
    });

}

//SET COL DATA
function htheme_set_column_html(data,id){

    //VARIABLES
    var htheme_html = '';
    var htheme_col_style = '12';

    //CHECK COLUMNS
    switch(data.length){
        case 1:
            htheme_col_style = '12';
            break;
        case 2:
            htheme_col_style = '6';
            break;
        case 3:
            htheme_col_style = '4';
            break;
        case 4:
            htheme_col_style = '3';
            break;
    }

    jQuery(data).each(function(index, element){
        htheme_html += '<div class="htheme_mega_menu_col_'+htheme_col_style+'" data-menu-item-id="'+id+'">';
            htheme_html += '<div class="htheme_column_selectors">';
                htheme_html += '<div class="htheme_column_data">';
                    htheme_html += '<input name="htheme-title-'+index+'" id="htheme-title-'+index+'" value="" placeholder="Add title...">';
                htheme_html += '</div>';
                htheme_html += '<div class="htheme_column_data">';
                    htheme_html += '<select name="htheme-col-'+index+'" id="htheme-col-'+index+'">';
                        htheme_html += '<option value="plainHtml">Please make a selection</option>';
                        htheme_html += '<option value="posts">Posts</option>';
                        htheme_html += '<option value="pages">Pages</option>';
                        //htheme_html += '<option value="categories">Categories</option>';
                        htheme_html += '<option value="plainHtml">Plain HTML</option>';
                        htheme_html += '<option value="products">WooCommerce Products</option>';
                    htheme_html += '</select>';
                htheme_html += '</div>';
                htheme_html += '<div class="htheme_column_data">';
                    //SELECT FOR OTHER OPTIONS ORDERING
                    htheme_html += '<select name="htheme-order-col-'+index+'" id="htheme-order-col-'+index+'">';
                        htheme_html += '<option value=""></option>';
                    htheme_html += '</select>';
                    //TEXTAREA FOR HTML
                    htheme_html += '<input type="text" name="htheme-html-input-'+index+'" id="htheme-html-input-'+index+'">';
                    //PAGE SELECTOR
                    htheme_html += '<div class="htheme_column_pages_holder htheme_column_pages_id_'+index+'">';
                        htheme_html += '<div class="htheme_media_button htheme_page_selector" data-pages-id="'+index+'">Select Pages</div>';
                        htheme_html += '<span>(<a>0</a> Pages)</span>';
                        htheme_html += '<input type="hidden" name="htheme-pages-input-'+index+'" id="htheme-pages-input-'+index+'">';
                    htheme_html += '</div>';
                htheme_html += '</div>';
            htheme_html += '</div>';
        htheme_html += '</div>';
    });

    //ADD HTML
    jQuery('.htheme_layout_columns').html(htheme_html);

}

//SET SAVE FLAG ON BUTTON
function htheme_flag_save(status){

    if(status){
        //REBIND THE CLICK
        jQuery('.htheme_menu_save').removeClass('htheme_no_save').bind('click');
        //SET THE SAVE
        htheme_set_save();
        //SET STATUS
        htheme_save_status = true;
    } else {
        //UNBIND THE CLICK
        jQuery('.htheme_menu_save').addClass('htheme_no_save').unbind('click');
        //SET STATUS
        htheme_save_status = false;
    }

}

//SAVE OPTIONS
function htheme_set_save(){

    //SAVE OBJECT
    jQuery('.htheme_menu_save').off().on('click', function(){
        htheme_show_save(true);
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'options':htheme_global_options,
                'action': 'htheme_object_save'
            },
            dataType: "json"
        }).done(function(data){
            //SET LOADER
            htheme_flag_save(false);
            //SHOW SAVE
            htheme_show_save(false);

        }).fail(function(event){
            //console.log(event);
        });
    });

}

//SHOW SAVE
function htheme_show_save(status){

    if(status){
        //ANIMATION
        TweenMax.to( jQuery('.htheme_loading'), 0.2, {
                opacity:1,
                display:'table',
                ease:Power4.easeInOut,
                force3D:true
            }
        );
    } else {
        //ANIMATION
        TweenMax.to( jQuery('.htheme_loading'), 0.2, {
                opacity:0,
                onComplete:function(){
                    jQuery('.htheme_loading').css({'display':'none'});
                },
                ease:Power4.easeInOut,
                force3D:true
            }
        );
    }

}

//SAVE MANAGEMENT
jQuery(window).on('beforeunload', function(e){
    if(htheme_save_status){
        return 'You have unsaved data!';
    }
});
