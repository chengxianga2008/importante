//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Styling');

    //SET DATA - ACCENTS
    jQuery(global_options.settings.styling.accents).each(function(index, element){
        jQuery('.htheme_load_accents').append(htheme_get_accent_html(index, element));
        //SET DATA
        htheme_set_accent_data(index, element);
    });

    //SET DATA - BUTTON
    jQuery(global_options.settings.styling.buttons).each(function(index, element){
        jQuery('.htheme_load_buttons').append(htheme_get_button_html(index, element));
        //SET FONTS
        var fonts = [ 'family_'+index ];
        htheme_fonts_options(fonts);
        //SET DATA
        htheme_set_button_data(index, element);
    });

    //CONVERT COMPONENTS
    htheme_convert_components();

    //GET HTML - ACCENTS
    jQuery(global_options.settings.styling.accents).each(function(index, element){
        //SET UPDATE DATA
        htheme_update_accent_data(index, element);
    });

    //SET HEADER STYLING UPDATE
    jQuery(global_options.settings.styling.buttons).each(function(index, element){
        //UPDATE DATA
        htheme_update_button_data(index);
        //SET WEIGHT DATA - This is run after component has been generated to set the correct font variant from google api
        htheme_set_weight_data(index);
    });

});

//GET ACCENT HTML
function htheme_get_accent_html(index, element){

    //VARAIBLES
    var html = '';

    html += '<!-- ROW -->';
    html += '<div class="htheme_form_row">';
        html += '<div class="htheme_form_col_3">';
            html += '<div class="htheme_label">'+element.title+'</div>';
        html += '</div>';
        html += '<div class="htheme_form_col_9">';
         html += '<input name="'+element.label+'_'+index+'" id="'+element.label+'_'+index+'" class="htheme_color_picker">';
        html += ' </div>';
    html += '</div>';
    html += '<!-- ROW -->';

    return html;

}

//SET ACCENT DATA
function htheme_set_accent_data(index, element){

    if(global_options.settings.styling.accents[index].color){
        jQuery('#'+element.label+'_'+index).val(global_options.settings.styling.accents[index].color);
    }

}

//SET ACCENT UPDATE
function htheme_update_accent_data(index, element){

    jQuery('#'+element.label+'_'+index).on('change', function(){
        global_options.settings.styling.accents[index].color = jQuery(this).val();
        htheme_flag_save(true);
    });

}

//SET BUTTON DATA
function htheme_set_button_data(index, element){

    //SET DATA
    if(global_options.settings.styling.buttons[index].family){
        jQuery('#family_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].family){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.styling.buttons[index].color){
        jQuery('#color_'+index).val(global_options.settings.styling.buttons[index].color);
    }

    if(global_options.settings.styling.buttons[index].hoverColor){
        jQuery('#hoverColor_'+index).val(global_options.settings.styling.buttons[index].hoverColor);
    }

    if(global_options.settings.styling.buttons[index].size){
        jQuery('#size_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].size){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.styling.buttons[index].transform){
        jQuery('#transform_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].transform){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.styling.buttons[index].spacing){
        jQuery('#spacing_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].spacing){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.styling.buttons[index].opacity){
        jQuery('#opacity_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].opacity){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.styling.buttons[index].background){
        jQuery('#background_'+index).val(global_options.settings.styling.buttons[index].background);
    }

    if(global_options.settings.styling.buttons[index].backgroundHover){
        jQuery('#backgroundHover_'+index).val(global_options.settings.styling.buttons[index].backgroundHover);
    }

}

//SET WEIGHT DATA
function htheme_set_weight_data(index){
    if(global_options.settings.styling.buttons[index].weight){
        jQuery('#weight_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.styling.buttons[index].weight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }
}

//UPDATE DATA
function htheme_update_button_data(index, element){

    //UPDATE - BODY
    jQuery('#family_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].family = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#color_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].color = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#hoverColor_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].hoverColor = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#size_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].size = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#weight_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].weight = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#transform_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].transform = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#spacing_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].spacing = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#background_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].background = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#backgroundHover_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].backgroundHover = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#opacity_'+index).on('change', function(){
        global_options.settings.styling.buttons[index].opacity = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_button_html(index, element){

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

    if(element['slug'] !== 'blockquote' || element['slug'] !== 'product_tag'){
    font_html += '<div class="htheme_form_col_typography">';
    font_html += '<div class="htheme_label_excerpt">Bacground Hover Color</div>';
    font_html += '<input name="backgroundHover_'+index+'" id="backgroundHover_'+index+'" class="htheme_color_picker">';
    font_html += '</div>';
    }

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
