//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Footer');

    //SET DATA
    htheme_set_data();

    //SET HEADER STYLING OPTIONS
    jQuery(global_options.settings.footer.stylingOptions).each(function(index, element){
        //GET HTML
        jQuery('.htheme_load_footer_styles').append(htheme_get_footer_font_html(index, element));
        //SET FONTS
        var fonts = [ 'family_'+index ];
        htheme_fonts_options(fonts);
        //SET DATA
        htheme_set_footer_data(index);
    });

    //CONVERT COMPONENTS
    htheme_convert_components();

    //SET HEADER STYLING UPDATE
    jQuery(global_options.settings.footer.stylingOptions).each(function(index, element){
        //UPDATE DATA
        htheme_update_footer_data(index);
        //SET WEIGHT DATA - This is run after component has been generated to set the correct font variant from google api
        htheme_set_weight_data(index);
    });

    //UPDATE DATA
    htheme_update_data();

});

function htheme_set_data(){

    //VARIABLES
    var _layout = global_options.settings.footer.layout;
    var _colLayout = global_options.settings.footer.columnLayout;
    var _colorScheme = global_options.settings.footer.colorScheme;
    var _copyright = global_options.settings.footer.copyright;
    var _copyrightText = global_options.settings.footer.copyrightText;
    var _social = global_options.settings.footer.social;
    var _backgroundPrimary = global_options.settings.footer.backgroundPrimary;
    var _backgroundSecondary = global_options.settings.footer.backgroundSecondary;

    //SET DATA
    if(_layout){
        jQuery('.htheme_footer_layout_selector').each(function(){
            if( jQuery(this).attr('data-value')==_layout ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
    }

    if(_colLayout){
        jQuery('.htheme_col_layout_selector').each(function(){
            if( jQuery(this).attr('data-value')==_colLayout ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
    }

    if(_colorScheme){
        jQuery('#colorScheme option').each(function(index, element) {
            if(jQuery(this).val() == _colorScheme){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_copyright){
        if(jQuery('#copyright').val() == _copyright){
            jQuery('#copyright').attr('checked', 'checked');
        }
    }

    if(_copyrightText){
        jQuery('#copyrightText').val(_copyrightText);
    }

    if(_social){
        if(jQuery('#social').val() == _social){
            jQuery('#social').attr('checked', 'checked');
        }
    }

    if(_backgroundPrimary){
        jQuery('#backgroundPrimary').val(_backgroundPrimary);
    }

    if(_backgroundSecondary){
        jQuery('#backgroundSecondary').val(_backgroundSecondary);
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _layout = jQuery('.htheme_footer_layout_selector');
    var _colLayout = jQuery('.htheme_col_layout_selector');
    var _colorScheme = jQuery('#colorScheme');
    var _copyright = jQuery('#copyright');
    var _copyrightText = jQuery('#copyrightText');
    var _social = jQuery('#social');
    var _backgroundPrimary = jQuery('#backgroundPrimary');
    var _backgroundSecondary = jQuery('#backgroundSecondary');


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
        global_options.settings.footer.layout = the_value;

        htheme_flag_save(true);

    });

    jQuery(_colLayout).on('click', function(){

        //VARIABLES
        var the_value = jQuery(this).attr('data-value');

        //LOOP AND CHECK
        jQuery(_colLayout).each(function(){
            if( jQuery(this).attr('data-value') == the_value ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });

        //SET VARIABLE
        global_options.settings.footer.columnLayout = the_value;

        htheme_flag_save(true);

    });

    jQuery(_colorScheme).on('change', function(){
        global_options.settings.footer.colorScheme = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_copyright).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.footer.copyright = jQuery(this).val() : global_options.settings.footer.copyright = false;
        htheme_flag_save(true);
    });

    jQuery(_copyrightText).on('change', function(){
        global_options.settings.footer.copyrightText = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_social).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.footer.social = jQuery(this).val() : global_options.settings.footer.social = false;
        htheme_flag_save(true);
    });

    jQuery(_backgroundPrimary).on('change', function(){
        global_options.settings.footer.backgroundPrimary = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_backgroundSecondary).on('change', function(){
        global_options.settings.footer.backgroundSecondary = jQuery(this).val();
        htheme_flag_save(true);
    });

}

//SET FOOTER FONT STYLES
function htheme_set_footer_data(index){

    //SET DATA
    if(global_options.settings.footer.stylingOptions[index].family){
        jQuery('#family_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.footer.stylingOptions[index].family){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.footer.stylingOptions[index].color){
        jQuery('#color_'+index).val(global_options.settings.footer.stylingOptions[index].color);
    }

    if(global_options.settings.footer.stylingOptions[index].linkColor){
        jQuery('#linkColor_'+index).val(global_options.settings.footer.stylingOptions[index].linkColor);
    }

    if(global_options.settings.footer.stylingOptions[index].hoverColor){
        jQuery('#hoverColor_'+index).val(global_options.settings.footer.stylingOptions[index].hoverColor);
    }

    if(global_options.settings.footer.stylingOptions[index].size){
        jQuery('#size_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.footer.stylingOptions[index].size){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.footer.stylingOptions[index].transform){
        jQuery('#transform_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.footer.stylingOptions[index].transform){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.footer.stylingOptions[index].spacing){
        jQuery('#spacing_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.footer.stylingOptions[index].spacing){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

}

//SET WEIGHT DATA
function htheme_set_weight_data(index){
    if(global_options.settings.footer.stylingOptions[index].weight){
        jQuery('#weight_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.footer.stylingOptions[index].weight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }
}

//UPDATE DATA
function htheme_update_footer_data(index){

    //UPDATE - BODY
    jQuery('#family_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].family = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#color_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].color = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#linkColor_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].linkColor = jQuery(this).val();
        htheme_flag_save(true);
    });


    jQuery('#hoverColor_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].hoverColor = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#size_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].size = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#weight_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].weight = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#transform_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].transform = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#spacing_'+index).on('change', function(){
        global_options.settings.footer.stylingOptions[index].spacing = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_footer_font_html(index, element){

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
    var hide = '';
    if(element['slug'] === 'footer_headings'){
        hide = 'style="display:none;"';
    }
    font_html += '<div class="htheme_form_col_12 htheme_header_color_settings" '+hide+'>';
    font_html += '<div class="htheme_label">Link Styling</div>';
    font_html += '</div>';

    font_html += '<div class="htheme_form_col_12" '+hide+'>';

    font_html += '<div class="htheme_form_col_typography">';
    font_html += '<div class="htheme_label_excerpt">Link Color</div>';
    font_html += '<input name="linkColor_'+index+'" id="linkColor_'+index+'" class="htheme_color_picker">';
    font_html += '</div>';

    font_html += '<div class="htheme_form_col_typography">';
    font_html += '<div class="htheme_label_excerpt">Font Hover Color</div>';
    font_html += '<input name="hoverColor_'+index+'" id="hoverColor_'+index+'" class="htheme_color_picker">';
    font_html += '</div>';

    font_html += '</div>';

    font_html += '</div>';
    font_html += '<div class="htheme_row_split"></div>';
    font_html += '<!-- ROW -->';

    return font_html;

}