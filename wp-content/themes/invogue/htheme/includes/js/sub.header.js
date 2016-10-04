//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Header');

    //SET DATA
    htheme_set_data();

    //SET SOCIAL ICONS
    jQuery(global_options.settings.header.socialItems).each(function(index, element){
        //GET HTML
        jQuery('.htheme_load_social').append(htheme_get_social_html(index, element.label));
        //SET DATA
        htheme_set_social(index);
    });

    //SET HEADER STYLING OPTIONS
    jQuery(global_options.settings.header.stylingOptions).each(function(index, element){
        //GET HTML
        jQuery('.htheme_load_header_styles').append(htheme_get_header_font_html(index, element));
        //SET FONTS
        var fonts = [ 'family_'+index ];
        htheme_fonts_options(fonts);
        //SET DATA
        htheme_set_header_data(index);
    });

    //CONVERT COMPONENTS
    htheme_convert_components();

    //SET HEADER STYLING UPDATE
    jQuery(global_options.settings.header.stylingOptions).each(function(index, element){
        //UPDATE DATA
        htheme_update_header_data(index);
        //SET WEIGHT DATA - This is run after component has been generated to set the correct font variant from google api
        htheme_set_weight_data(index);
    });

    //SET SOCIAL ICONS
    jQuery(global_options.settings.header.socialItems).each(function(index, element){
        //UPDATE DATA
        htheme_set_update_social(index);
    });

    //UPDATE DATA
    htheme_update_data();

    //SET REMOVE
    htheme_set_remove();

});

function htheme_set_data(){

    //VARIABLES
    var _layout = global_options.settings.header.layout;
    var _imageForLogo = global_options.settings.header.imageForLogo;
    var _srcLogo = global_options.settings.header.srcLogo;
    var _srcMobileLogo = global_options.settings.header.srcMobileLogo;
    var _srcLogoRetina = global_options.settings.header.srcLogoRetina;
    var _logoHeight = global_options.settings.header.logoHeight;
    var _logoPadding = global_options.settings.header.logoPadding;
    var _srcStickyLogo = global_options.settings.header.srcStickyLogo;
    var _srcStickyLogoRetina = global_options.settings.header.srcStickyLogoRetina;
    var _logoStickyHeight = global_options.settings.header.logoStickyHeight;
    var _logoStickyPadding = global_options.settings.header.logoStickyPadding;
    var _stickOnMobile = global_options.settings.header.stickOnMobile;
    var _optionFullWidth = global_options.settings.header.optionFullWidth;
    var _optionAccount = global_options.settings.header.optionAccount;
    var _optionCart = global_options.settings.header.optionCart;
    var _optionWishlist = global_options.settings.header.optionWishlist;
    var _optionSearch = global_options.settings.header.optionSearch;
    var _optionBurger = global_options.settings.header.hamburger;
    var _srcHamburgerLogo = global_options.settings.header.srcHamburgerLogo;
    var _optionLanguage = global_options.settings.header.optionLanguage;
    var _colorScheme = global_options.settings.header.colorScheme;
    var _socialIcons = global_options.settings.header.socialIcons;
    var _socialPrimaryColor = global_options.settings.header.socialPrimaryColor;

    //SET DATA
    if(_layout){
        jQuery('.htheme_layout_selector').each(function(){
            if( jQuery(this).attr('data-value')==_layout ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
    }

    if(_imageForLogo){
        if(jQuery('#imageForLogo').val() == _imageForLogo){
            jQuery('#imageForLogo').attr('checked', 'checked');
        }
    }

    if(_srcLogo){
        jQuery('#srcLogo').val(_srcLogo);
        //SET IMAGE
        jQuery('#image_srcLogo').css({
            'background-image' : 'url('+_srcLogo+')'
        });
    }

    if(_srcMobileLogo){
        jQuery('#srcLogo').val(_srcMobileLogo);
        //SET IMAGE
        jQuery('#image_srcMobileLogo').css({
            'background-image' : 'url('+_srcMobileLogo+')'
        });
    }

    if(_srcLogoRetina){
        jQuery('#srcLogoRetina').val(_srcLogoRetina);
        //SET IMAGE
        jQuery('#image_srcLogoRetina').css({
            'background-image' : 'url('+_srcLogoRetina+')'
        });
    }

    if(_logoHeight){
        jQuery('#logoHeight option').each(function(index, element) {
            if(jQuery(this).val() == _logoHeight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_logoPadding){
        jQuery('#logoPadding').val(_logoPadding);
    }

    if(_srcStickyLogo){
        jQuery('#srcStickyLogo').val(_srcStickyLogo);
        //SET IMAGE
        jQuery('#image_srcStickyLogo').css({
            'background-image' : 'url('+_srcStickyLogo+')'
        });
    }

    if(_srcStickyLogoRetina){
        jQuery('#srcStickyLogoRetina').val(_srcStickyLogoRetina);
        //SET IMAGE
        jQuery('#image_srcStickyLogoRetina').css({
            'background-image' : 'url('+_srcStickyLogoRetina+')'
        });
    }

    if(_logoStickyHeight){
        jQuery('#logoStickyHeight option').each(function(index, element) {
            if(jQuery(this).val() == _logoStickyHeight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_logoStickyPadding){
        jQuery('#logoStickyPadding').val(_logoStickyPadding);
    }

    if(_stickOnMobile){
        if(jQuery('#stickOnMobile').val() == _stickOnMobile){
            jQuery('#stickOnMobile').attr('checked', 'checked');
        }
    }

    if(_optionFullWidth){
        if(jQuery('#optionFullWidth').val() == _optionFullWidth){
            jQuery('#optionFullWidth').attr('checked', 'checked');
        }
    }

    if(_optionAccount){
        if(jQuery('#optionAccount').val() == _optionAccount){
            jQuery('#optionAccount').attr('checked', 'checked');
        }
    }

    if(_optionCart){
        if(jQuery('#optionCart').val() == _optionCart){
            jQuery('#optionCart').attr('checked', 'checked');
        }
    }

    if(_optionWishlist){
        if(jQuery('#optionWishlist').val() == _optionWishlist){
            jQuery('#optionWishlist').attr('checked', 'checked');
        }
    }

    if(_optionSearch){
        if(jQuery('#optionSearch').val() == _optionSearch){
            jQuery('#optionSearch').attr('checked', 'checked');
        }
    }

    if(_optionBurger){
        if(jQuery('#hamburger').val() == _optionBurger){
            jQuery('#hamburger').attr('checked', 'checked');
        }
    }

    if(_srcHamburgerLogo){
        jQuery('#srcHamburgerLogo').val(_srcHamburgerLogo);
        //SET IMAGE
        jQuery('#image_srcHamburgerLogo').css({
            'background-image' : 'url('+_srcHamburgerLogo+')'
        });
    }

    if(_optionLanguage){
        if(jQuery('#optionLanguage').val() == _optionLanguage){
            jQuery('#optionLanguage').attr('checked', 'checked');
        }
    }

    if(_colorScheme){
        jQuery('#colorScheme option').each(function(index, element) {
            if(jQuery(this).val() == _colorScheme){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_socialIcons){
        if(jQuery('#socialIcons').val() == _socialIcons){
            jQuery('#socialIcons').attr('checked', 'checked');
        }
    }

    if(_socialPrimaryColor){
        jQuery('#socialPrimaryColor').val(_socialPrimaryColor);
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _layout = jQuery('.htheme_layout_selector');
    var _imageForLogo = jQuery('#imageForLogo');
    var _srcLogo = jQuery('#srcLogo');
    var _srcMobileLogo = jQuery('#srcMobileLogo');
    var _srcLogoRetina = jQuery('#srcLogoRetina');
    var _logoHeight = jQuery('#logoHeight');
    var _logoPadding = jQuery('#logoPadding');
    var _srcStickyLogo = jQuery('#srcStickyLogo');
    var _srcStickyLogoRetina = jQuery('#srcStickyLogoRetina');
    var _logoStickyHeight = jQuery('#logoStickyHeight');
    var _logoStickyPadding = jQuery('#logoStickyPadding');
    var _stickOnMobile = jQuery('#stickOnMobile');
    var _optionFullWidth = jQuery('#optionFullWidth');
    var _optionAccount = jQuery('#optionAccount');
    var _optionCart = jQuery('#optionCart');
    var _optionWishlist = jQuery('#optionWishlist');
    var _optionSearch = jQuery('#optionSearch');
    var _optionBurger = jQuery('#hamburger');
    var _srcHamburgerLogo = jQuery('#srcHamburgerLogo');
    var _optionLanguage = jQuery('#optionLanguage');
    var _colorScheme = jQuery('#colorScheme');
    var _socialIcons = jQuery('#socialIcons');
    var _socialPrimaryColor = jQuery('#socialPrimaryColor');

    //UPDATE
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
        global_options.settings.header.layout = the_value;

        htheme_flag_save(true);

    });

    jQuery(_imageForLogo).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.imageForLogo = jQuery(this).val() : global_options.settings.header.imageForLogo = false;
        htheme_flag_save(true);
    });

    jQuery(_srcLogo).on('change', function(){
        global_options.settings.header.srcLogo = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcLogo').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_srcMobileLogo).on('change', function(){
        global_options.settings.header.srcMobileLogo = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcMobileLogo').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_srcLogoRetina).on('change', function(){
        global_options.settings.header.srcLogoRetina = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcLogoRetina').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_logoHeight).on('change', function(){
        global_options.settings.header.logoHeight = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_logoPadding).on('change', function(){
        global_options.settings.header.logoPadding = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_srcStickyLogo).on('change', function(){
        global_options.settings.header.srcStickyLogo = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcStickyLogo').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_srcStickyLogoRetina).on('change', function(){
        global_options.settings.header.srcStickyLogoRetina = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcStickyLogoRetina').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_logoStickyHeight).on('change', function(){
        global_options.settings.header.logoStickyHeight = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_logoStickyPadding).on('change', function(){
        global_options.settings.header.logoStickyPadding = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_stickOnMobile).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.stickOnMobile = jQuery(this).val() : global_options.settings.header.stickOnMobile = false;
        htheme_flag_save(true);
    });

    jQuery(_optionFullWidth).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionFullWidth = jQuery(this).val() : global_options.settings.header.optionFullWidth = false;
        htheme_flag_save(true);
    });

    jQuery(_optionAccount).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionAccount = jQuery(this).val() : global_options.settings.header.optionAccount = false;
        htheme_flag_save(true);
    });

    jQuery(_optionCart).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionCart = jQuery(this).val() : global_options.settings.header.optionCart = false;
        htheme_flag_save(true);
    });

    jQuery(_optionWishlist).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionWishlist = jQuery(this).val() : global_options.settings.header.optionWishlist = false;
        htheme_flag_save(true);
    });

    jQuery(_optionSearch).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionSearch = jQuery(this).val() : global_options.settings.header.optionSearch = false;
        htheme_flag_save(true);
    });

    jQuery(_optionBurger).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.hamburger = jQuery(this).val() : global_options.settings.header.hamburger = false;
        htheme_flag_save(true);
    });

    jQuery(_srcHamburgerLogo).on('change', function(){
        global_options.settings.header.srcHamburgerLogo = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_srcHamburgerLogo').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_optionLanguage).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.optionLanguage = jQuery(this).val() : global_options.settings.header.optionLanguage = false;
        htheme_flag_save(true);
    });

    jQuery(_colorScheme).on('change', function(){
        global_options.settings.header.colorScheme = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_socialIcons).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.socialIcons = jQuery(this).val() : global_options.settings.header.socialIcons = false;
        htheme_flag_save(true);
    });

    jQuery(_socialPrimaryColor).on('change', function(){
        global_options.settings.header.socialPrimaryColor = jQuery(this).val();
        htheme_flag_save(true);
    });

}

//SET SOCIAL ITEMS
function htheme_set_social(index){

    if(global_options.settings.header.socialItems[index].status){
        if(jQuery('#status_'+index).val() == global_options.settings.header.socialItems[index].status){
            jQuery('#status_'+index).attr('checked', 'checked');
        }
    }

    if(global_options.settings.header.socialItems[index].url){
        jQuery('#url_'+index).val(global_options.settings.header.socialItems[index].url);
    }

    if(global_options.settings.header.socialItems[index].target){
        jQuery('#target_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.socialItems[index].target){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.socialItems[index].hoverColor){
        jQuery('#hoverSocialColor_'+index).val(global_options.settings.header.socialItems[index].hoverColor);
    }

}

//SET UPDATE FOR SOLCIAL
function htheme_set_update_social(index){

    jQuery('#status_'+index).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.header.socialItems[index].status = jQuery(this).val() : global_options.settings.header.socialItems[index].status = false;
        htheme_flag_save(true);
    });

    jQuery('#url_'+index).on('change', function(){
        global_options.settings.header.socialItems[index].url = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#target_'+index).on('change', function(){
        global_options.settings.header.socialItems[index].target = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#hoverSocialColor_'+index).on('change', function(){
        global_options.settings.header.socialItems[index].hoverColor = jQuery(this).val();
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_social_html(index, label){

    var social_html = '';

    social_html += '<!-- SOCIAL ITEM :: START -->';
    social_html += '<div class="htheme_form_col_4">';
    social_html += '<div class="htheme_form_col_12">';
    social_html += '<div class="htheme_form_col_8">';
    social_html += '<div class="htheme_label">'+label+' icon</div>';
    social_html += '</div>';
    social_html += '<div class="htheme_form_col_4">';
    social_html += '<input type="checkbox" name="status_'+index+'" id="status_'+index+'" value="true">';
    social_html += '</div>';
    social_html += '</div>';
    social_html += '<div class="htheme_social_controls">';
    social_html += '<div class="htheme_form_col_12">';
    social_html += '<input type="text" name="url_'+index+'" id="url_'+index+'" class="htheme_field_med" placeholder="URL">';
    social_html += '</div>';
    social_html += '<div class="htheme_form_col_4">';
    social_html += '<select name="target_'+index+'" id="target_'+index+'" class="htheme_field_med">';
    social_html += '<option value="_blank">_blank</option>';
    social_html += '<option value="_self">_self</option>';
    social_html += '</select>';
    social_html += '</div>';
    social_html += '<div class="htheme_form_col_4"><input name="hoverSocialColor_'+index+'" id="hoverSocialColor_'+index+'" class="htheme_color_picker"></div>';
    social_html += '</div>';
    social_html += '</div>';
    social_html += '<!-- SOCIAL ITEM :: END -->';

    return social_html;

}

//SET HEADER FONT STYLES
function htheme_set_header_data(index){

    //SET DATA
    if(global_options.settings.header.stylingOptions[index].family){
        jQuery('#family_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].family){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.stylingOptions[index].color){
        jQuery('#color_'+index).val(global_options.settings.header.stylingOptions[index].color);
    }

    if(global_options.settings.header.stylingOptions[index].hoverColor){
        jQuery('#hoverColor_'+index).val(global_options.settings.header.stylingOptions[index].hoverColor);
    }

    if(global_options.settings.header.stylingOptions[index].size){
        jQuery('#size_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].size){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.stylingOptions[index].transform){
        jQuery('#transform_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].transform){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.stylingOptions[index].spacing){
        jQuery('#spacing_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].spacing){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.stylingOptions[index].opacity){
        jQuery('#opacity_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].opacity){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.header.stylingOptions[index].background){
        jQuery('#background_'+index).val(global_options.settings.header.stylingOptions[index].background);
    }

}

//SET WEIGHT DATA
function htheme_set_weight_data(index){
    if(global_options.settings.header.stylingOptions[index].weight){
        jQuery('#weight_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.header.stylingOptions[index].weight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }
}

//UPDATE DATA
function htheme_update_header_data(index){

    //UPDATE - BODY
    jQuery('#family_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].family = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#color_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].color = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#hoverColor_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].hoverColor = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#size_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].size = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#weight_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].weight = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#transform_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].transform = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#spacing_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].spacing = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#background_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].background = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#opacity_'+index).on('change', function(){
        global_options.settings.header.stylingOptions[index].opacity = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_header_font_html(index, element){

    var font_html = '';
    font_html += '<div class="htheme_form_row">';
    font_html += '<div class="htheme_form_col_12 htheme_margin_bottom_20">';
    font_html += '<div class="htheme_label htheme_red_heading">'+element.title+'</div>';
    font_html += '</div>';
    font_html += '<!-- ROW -->';
    font_html += '<div class="htheme_form_col_12">';
    font_html += '<div class="htheme_label">Fonts</div>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography_search">';
        font_html += '<div class="htheme_label_excerpt">Font Family</div>';
        font_html += '<select name="family_'+index+'" id="family_'+index+'" class="htheme_font_search"></select>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';
        font_html += '<div class="htheme_label_excerpt">Font Color</div>';
        font_html += '<input name="color_'+index+'" id="color_'+index+'" class="htheme_color_picker">';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';

        if(element.slug != 'navigation_login'){
            font_html += '<div class="htheme_label_excerpt">Font Hover Color</div>';
        } else {
            font_html += '<div class="htheme_label_excerpt">Link Color</div>';
        }

        font_html += '<input name="hoverColor_'+index+'" id="hoverColor_'+index+'" class="htheme_color_picker">';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';
        font_html += '<div class="htheme_label_excerpt">Font Size</div>';
        font_html += '<select name="size_'+index+'" id="size_'+index+'" class="htheme_field_typography">';
        font_html += '<option value="9px">9px</option>';
        font_html += '<option value="10px">10px</option>';
        font_html += '<option value="11px">11px</option>';
        font_html += '<option value="12px">12px</option>';
        font_html += '<option value="13px">13px</option>';
        font_html += '<option value="14px">14px</option>';
        font_html += '<option value="15px">15px</option>';
        font_html += '<option value="16px">16px</option>';
        font_html += '<option value="17px">17px</option>';
        font_html += '<option value="18px">18px</option>';
        font_html += '<option value="19px">19px</option>';
        font_html += '<option value="20px">20px</option>';
        font_html += '<option value="21px">21px</option>';
        font_html += '<option value="22px">22px</option>';
        font_html += '<option value="23px">23px</option>';
        font_html += '<option value="24px">24px</option>';
        font_html += '<option value="25px">25px</option>';
        font_html += '<option value="26px">26px</option>';
        font_html += '<option value="27px">27px</option>';
        font_html += '<option value="28px">28px</option>';
        font_html += '<option value="29px">29px</option>';
        font_html += '<option value="30px">30px</option>';
        font_html += '<option value="31px">31px</option>';
        font_html += '<option value="32px">32px</option>';
        font_html += '<option value="33px">33px</option>';
        font_html += '<option value="34px">34px</option>';
        font_html += '<option value="35px">35px</option>';
        font_html += '<option value="36px">36px</option>';
        font_html += '<option value="37px">37px</option>';
        font_html += '<option value="38px">38px</option>';
        font_html += '<option value="39px">39px</option>';
        font_html += '<option value="40px">40px</option>';
        font_html += '</select>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';
        font_html += '<div class="htheme_label_excerpt">Font Variant</div>';
        font_html += '<select name="weight_'+index+'" id="weight_'+index+'" data-search-link="family_'+index+'" class="htheme_field_typography">';
        font_html += '</select>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';
        font_html += '<div class="htheme_label_excerpt">Text Transform</div>';
        font_html += '<select name="transform_'+index+'" id="transform_'+index+'" class="htheme_field_typography">';
        font_html += '<option value="capitalize">capitalize</option>';
        font_html += '<option value="inherit">inherit</option>';
        font_html += '<option value="lowercase">lowercase</option>';
        font_html += '<option value="none">none</option>';
        font_html += '<option value="uppercase">uppercase</option>';
        font_html += '</select>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography">';
        font_html += '<div class="htheme_label_excerpt">Letter Spacing</div>';
        font_html += '<select name="spacing_'+index+'" id="spacing_'+index+'" class="htheme_field_typography">';
        font_html += '<option value="inherit">inherit</option>';
        font_html += '<option value="normal">normal</option>';
        font_html += '<option value="0px">0px</option>';
        font_html += '<option value="0.5px">0.5px</option>';
        font_html += '<option value="1px">1px</option>';
        font_html += '<option value="1.5px">1.5px</option>';
        font_html += '<option value="2px">2px</option>';
        font_html += '<option value="2.5px">2.5px</option>';
        font_html += '<option value="3px">3px</option>';
        font_html += '</select>';
    font_html += '</div>';

    font_html += '<div class="htheme_form_col_12 htheme_header_color_settings">';
        font_html += '<div class="htheme_label">Background</div>';
    font_html += '</div>';

    font_html += '<div class="htheme_form_col_12">';

        font_html += '<div class="htheme_form_col_typography">';
            font_html += '<div class="htheme_label_excerpt">Bacground Color</div>';
            font_html += '<input name="background_'+index+'" id="background_'+index+'" class="htheme_color_picker">';
        font_html += '</div>';

        font_html += '<div class="htheme_form_col_typography">';
            font_html += '<div class="htheme_label_excerpt">Bacground Opacity</div>';
            font_html += '<select name="opacity_'+index+'" id="opacity_'+index+'" class="htheme_field_typography">';
            font_html += '<option value="0">0%</option>';
            font_html += '<option value="0.1">10%</option>';
            font_html += '<option value="0.2">20%</option>';
            font_html += '<option value="0.3">30%</option>';
            font_html += '<option value="0.4">40%</option>';
            font_html += '<option value="0.5">50%</option>';
            font_html += '<option value="0.6">60%</option>';
            font_html += '<option value="0.7">70%</option>';
            font_html += '<option value="0.8">80%</option>';
            font_html += '<option value="0.9">90%</option>';
            font_html += '<option value="1">100%</option>';
            font_html += '</select>';
        font_html += '</div>';

    font_html += '</div>';

    font_html += '</div>';
    font_html += '<div class="htheme_row_split"></div>';
    font_html += '<!-- ROW -->';

    return font_html;

}
