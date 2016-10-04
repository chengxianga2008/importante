//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Sharing');

    //GET HTML
    jQuery(global_options.settings.sharing.shares).each(function(index, element){
        jQuery('.htheme_load_sharing').append(htheme_get_sharing_html(index, element));
    });

    //SET UPDATE
    jQuery(global_options.settings.sharing.shares).each(function(index, element){
        jQuery(element.socialItems).each(function(idx, ele){
            htheme_set_data(index, idx, ele.label);
            htheme_update_data(index, idx, ele.label);
        });
    });

    //CONVERT COMPONENTS
    //htheme_convert_components();

});

function htheme_set_data(primary_index, social_index, label){

    //SET DATA
    if(global_options.settings.sharing.shares[primary_index].socialItems[social_index].status){
        if(jQuery('#social'+label+'_'+primary_index).val() == global_options.settings.sharing.shares[primary_index].socialItems[social_index].status){
            jQuery('#social'+label+'_'+primary_index).attr('checked', 'checked');
        }
    }

}

//UPDATE DATA
function htheme_update_data(primary_index, social_index, label){

    //UPDATE
    jQuery('#social'+label+'_'+primary_index).off().on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.sharing.shares[primary_index].socialItems[social_index].status = jQuery(this).val() : global_options.settings.sharing.shares[primary_index].socialItems[social_index].status = false;
        htheme_flag_save(true);
    });

}

//GET FONT HTML
function htheme_get_sharing_html(index, element){

    var font_html = '';

    font_html += '<!-- ROW -->';
    font_html += '<div class="htheme_form_row">';
        font_html += '<div class="htheme_form_col_12">';
            font_html += '<div class="htheme_label">'+element.for+'</div>';
        font_html += '</div>';
        font_html += '<div class="htheme_form_col_12">';
            jQuery(element.socialItems).each(function(idx, ele){
                font_html += '<div class="htheme_form_col_sharing">';
                    font_html += '<input type="checkbox" name="social'+ele.label+'_'+index+'" id="social'+ele.label+'_'+index+'" value="true">';
                    font_html += '<div class="htheme_label_excerpt">'+ele.label+'</div>';
                font_html += '</div>';
            });
        font_html += '</div>';
    font_html += '</div>';
    font_html += '<!-- ROW -->';

    return font_html;

}