//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('WooCommerce');

    //PRE POPULATE PAGES
    htheme_set_page_html();

    //SET DATA
    htheme_set_data();

    //CONVERT COMPONENTS
    htheme_convert_components();

    //UPDATE DATA
    htheme_update_data();

});

//PAGE SELECT BOX
function htheme_set_page_html(){

    //VARIABLES
    var html = '';

    html += '<option value="">Please select a page</option>';

    //LOOP OBJECT
    jQuery(global_pages).each(function(index,element){
        html += '<option value="'+element['ID']+'">'+element['post_title']+'</option>';
    });

    jQuery('#wishlistPage').append(html);

}

function htheme_set_data(){

    //VARIABLES
    var _shopLayout = global_options.settings.woocommerce.shopLayout;
    var _nextPrev = global_options.settings.woocommerce.nextPrev;
    var _socialIcons = global_options.settings.woocommerce.socialIcons;
    var _wishlistPage = global_options.settings.woocommerce.wishlistPage;

    //SET DATA
    if(_shopLayout){
        jQuery('#shopLayout option').each(function(index, element) {
            if(jQuery(this).val() == _shopLayout){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_nextPrev){
        if(jQuery('#nextPrev').val() == _nextPrev){
            jQuery('#nextPrev').attr('checked', 'checked');
        }
    }

    if(_socialIcons){
        if(jQuery('#socialIcons').val() == _socialIcons){
            jQuery('#socialIcons').attr('checked', 'checked');
        }
    }

    //SET DATA
    if(_wishlistPage){
        jQuery('#wishlistPage option').each(function(index, element) {
            if(jQuery(this).val() == _wishlistPage){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _shopLayout = jQuery('#shopLayout');
    var _nextPrev = jQuery('#nextPrev');
    var _socialIcons = jQuery('#socialIcons');
    var _wishlistPage = jQuery('#wishlistPage');

    //UPDATE
    jQuery(_shopLayout).on('change', function(){
        global_options.settings.woocommerce.shopLayout = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_nextPrev).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.woocommerce.nextPrev = jQuery(this).val() : global_options.settings.woocommerce.nextPrev = false;
        htheme_flag_save(true);
    });

    jQuery(_socialIcons).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.woocommerce.socialIcons = jQuery(this).val() : global_options.settings.woocommerce.socialIcons = false;
        htheme_flag_save(true);
    });

    jQuery(_wishlistPage).on('change', function(){
        global_options.settings.woocommerce.wishlistPage = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

}
