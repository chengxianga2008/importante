//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Typography');

    //SET DATA
    jQuery(global_options.settings.typography.fonts).each(function(index, element){
        //GET HTML
        jQuery('.htheme_load_fonts').append(htheme_get_font_html(index, element.label, element.slug));
        //SET FONTS
        var fonts = [ 'family_'+index ];
        htheme_fonts_options(fonts);
        //SET DATA
        htheme_set_data(index);
        //UPDATE DATA
        htheme_update_data(index);
    });

    //CONVERT COMPONENTS
    htheme_convert_components();

    //SET WEIGHT DATA - This is run after component has been generated to set the correct font variant from google api
    jQuery(global_options.settings.typography.fonts).each(function(index, element){
        //SET WEIGHT DATA
        htheme_set_weight_data(index);
    });

});

//SET WEIGHT DATA
function htheme_set_weight_data(index){

    if(global_options.settings.typography.fonts[index].weight){
        jQuery('#weight_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].weight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

}

function htheme_set_data(index){

    //SET DATA
    if(global_options.settings.typography.fonts[index].family){
        jQuery('#family_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].family){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.typography.fonts[index].size){
        jQuery('#size_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].size){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.typography.fonts[index].lineHeight){
        jQuery('#lineHeight_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].lineHeight){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.typography.fonts[index].transform){
        jQuery('#transform_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].transform){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.typography.fonts[index].spacing){
        jQuery('#spacing_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].spacing){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(global_options.settings.typography.fonts[index].color){
        jQuery('#color_'+index+' option').each(function(idx, element) {
            if(jQuery(this).val() == global_options.settings.typography.fonts[index].color){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

}

//UPDATE DATA
function htheme_update_data(index){

    //UPDATE - BODY
    jQuery('#family_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].family = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#size_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].size = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#lineHeight_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].lineHeight = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#weight_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].weight = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#transform_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].transform = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#spacing_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].spacing = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery('#color_'+index).on('change', function(){
        global_options.settings.typography.fonts[index].color = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_font_html(index, label, slug){

    var font_html = '';

    font_html += '<!-- ROW -->';
    font_html += '<div class="htheme_form_row">';
    font_html += '<div class="htheme_form_col_12">';
    font_html += '<div class="htheme_label">'+label+'</div>';
    font_html += '</div>';
    font_html += '<div class="htheme_form_col_typography_search">';
    font_html += '<div class="htheme_label_excerpt">Font Family</div>';
    font_html += '<select name="family_'+index+'" id="family_'+index+'" class="htheme_font_search"></select>';
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
    font_html += '<div class="htheme_label_excerpt">Line Height</div>';
    font_html += '<select name="lineHeight_'+index+'" id="lineHeight_'+index+'" class="htheme_field_typography">';
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

    //REMOVE IF IS SLIDER TYPE
    var display_slide_none =  '';
    if(slug == 'slider_title' || slug == 'slider_content'){
        display_slide_none = 'style="display:none"';
    }
    font_html += '<div class="htheme_form_col_typography" '+display_slide_none+'>';
    font_html += '<div class="htheme_label_excerpt">Font Color</div>';
    font_html += '<select name="color_'+index+'" id="color_'+index+'" class="htheme_field_typography">';
    font_html += '<option value="accentone">Color Accent 1</option>';
    font_html += '<option value="accenttwo">Color Accent 2</option>';
    font_html += '<option value="accentthree">Color Accent 3</option>';
    font_html += '<option value="accentfour">Color Accent 4</option>';
    font_html += '</select>';
    font_html += '</div>';

    font_html += '</div>';
    font_html += '<!-- ROW -->';

    return font_html;

}