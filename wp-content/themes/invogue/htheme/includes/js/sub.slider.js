//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Home Slider');

    //SET DATA
    htheme_set_data();

    //UPDATE DATA
    htheme_update_data();

});

function htheme_set_data(){

    //VARIABLES
    var _transition = global_options.settings.slider.transition;
    var _transitionSpeed = global_options.settings.slider.transitionSpeed;
    var _height = global_options.settings.slider.height;
    var _idle = global_options.settings.slider.idle;
    var _idleDisplay = global_options.settings.slider.idleDisplay;

    //SET DATA
    if(_transition){
        jQuery('#transition option').each(function(index, element) {
            if(jQuery(this).val() == _transition){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_transitionSpeed){
        jQuery('#transitionSpeed option').each(function(index, element) {
            if(jQuery(this).val() == _transitionSpeed){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_height){
        jQuery('#height').val(_height);
    }

    if(_idle){
        jQuery('#idle option').each(function(index, element) {
            if(jQuery(this).val() == _idle){
                jQuery(this).attr('selected', 'selected')
            }
        });
    }

    if(_idleDisplay){
        if(jQuery('#idleDisplay').val() == _idleDisplay){
            jQuery('#idleDisplay').attr('checked', 'checked');
        }
    }

    htheme_get_slides(global_options.settings.slider.slides);
    htheme_add_slide();

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _transition = jQuery('#transition');
    var _transitionSpeed = jQuery('#transitionSpeed');
    var _height = jQuery('#height');
    var _idle = jQuery('#idle');
    var _idleDisplay = jQuery('#idleDisplay');

    //UPDATE
    jQuery(_transition).on('change', function(){
        global_options.settings.slider.transition = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_transitionSpeed).on('change', function(){
        global_options.settings.slider.transitionSpeed = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_height).on('change', function(){
        global_options.settings.slider.height = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_idle).on('change', function(){
        global_options.settings.slider.idle = jQuery(this).children('option:selected').val();
        htheme_flag_save(true);
    });

    jQuery(_idleDisplay).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.slider.idleDisplay = jQuery(this).val() : global_options.settings.slider.idleDisplay = false;
        htheme_flag_save(true);
    });

}

//GET SLIDES
function htheme_get_slides(data){

    //CLEAR HTML
    jQuery('.htheme_load_slides').html('');

    //VARIABLES
    var slide_count = 1;

    //CHECK DATA
    if(data || typeof data == undefined){
        jQuery(data).each(function(index, element){
            if(element.deleted !== 'true'){
                //ADD HTML
                jQuery('.htheme_load_slides').append(htheme_get_slide_html(element, index, slide_count));
                //SET MARKET DATA
                htheme_set_slide_data(index);
                htheme_update_slide_data(index);
                slide_count++;
            }
        });
    } else {
        htheme_show_message_box('.htheme_load_slides', 'No slides have been added.', 'htheme_box_grey');
    }

    //REMOVE
    htheme_remove_slide();

}

//ADD SLIDE
function htheme_add_slide(){

    jQuery('#htheme_add_slide').off().on('click', function(){


        var slide_count = htheme_get_slide_count(global_options.settings.slider.slides);
        var slide_index = global_options.settings.slider.slides.length;

        //VARIABLES
        var slide_json = '{' +
            '"status": "true",' +
            '"imageContent": "true",' +
            '"layout": "3",' +
            '"imageContentSrc": "",' +
            '"backgroundSrc": "",' +
            '"slideTitle": "",' +
            '"slideContent": "",' +
            '"slideUrl": "",' +
            '"deleted": "false",' +
            '"backgroundColor": "#FFFFFF",' +
            '"color": "#2B2B2B",' +
            '"contentColor": "#2B2B2B",' +
            '"buttonText": "View Now",' +
            '"order": "'+(slide_count)+'"' +
            '}';
        var parse_slide = JSON.parse(slide_json);

        //PUSH MARKER INTO MARKERS
        global_options.settings.slider.slides.push(parse_slide);

        //ADD HTML
        jQuery('.htheme_load_slides').append(htheme_get_slide_html(parse_slide, slide_index, slide_count));

        //SET MARKET DATA
        htheme_set_slide_data(slide_index);
        htheme_update_slide_data(slide_index);
        htheme_remove_slide();
        htheme_flag_save(true);

        //SET REMOVE
        htheme_set_remove();

    });

}

//GET COUNT
function htheme_get_slide_count(data){

    //VARIABLES
    var slide_count = 1;

    jQuery(data).each(function(index, element){
        if(element.deleted !== 'true'){
            slide_count++;
        }
    });

    return slide_count;

}

//SET SLIDE DATA
function htheme_set_slide_data(index){

    //SET DATA
    var _layout = global_options.settings.slider.slides[index].layout;

    if(_layout){
        jQuery('.htheme_selector_'+index+' .htheme_slide_layout_selector').each(function(){
            if( jQuery(this).attr('data-value')==_layout ){
                jQuery(this).addClass('htheme_active_state');
            } else {
                jQuery(this).removeClass('htheme_active_state');
            }
        });
    }

    if(global_options.settings.slider.slides[index].status){
        if(jQuery('#status_'+index).val() == global_options.settings.slider.slides[index].status){
            jQuery('#status_'+index).attr('checked', 'checked');
        }
    }

    var image_content = global_options.settings.slider.slides[index].imageContent;
    if(global_options.settings.slider.slides[index].imageContent){
        if(jQuery('#imageContent_'+index).val() == global_options.settings.slider.slides[index].imageContent){
            jQuery('#imageContent_'+index).attr('checked', 'checked');
        }
        htheme_set_layout_img(index, image_content);
    }

    if(global_options.settings.slider.slides[index].imageContentSrc){
        jQuery('#imageContentSrc_'+index).val(global_options.settings.slider.slides[index].imageContentSrc);
        //SET IMAGE
        jQuery('#image_imageContentSrc_'+index).css({
            'background-image' : 'url('+global_options.settings.slider.slides[index].imageContentSrc+')'
        });
    }

    if(global_options.settings.slider.slides[index].backgroundSrc){
        jQuery('#backgroundSrc_'+index).val(global_options.settings.slider.slides[index].backgroundSrc);
        //SET IMAGE
        jQuery('#image_backgroundSrc_'+index).css({
            'background-image' : 'url('+global_options.settings.slider.slides[index].backgroundSrc+')'
        });
    }

    if(global_options.settings.slider.slides[index].slideTitle){
        jQuery('#slideTitle_'+index).val(global_options.settings.slider.slides[index].slideTitle);
    }

    if(global_options.settings.slider.slides[index].slideContent){
        jQuery('#slideContent_'+index).val(global_options.settings.slider.slides[index].slideContent);
    }

    if(global_options.settings.slider.slides[index].slideUrl){
        jQuery('#slideUrl_'+index).val(global_options.settings.slider.slides[index].slideUrl);
    }

    if(global_options.settings.slider.slides[index].backgroundColor){
        jQuery('#backgroundColor_'+index).val(global_options.settings.slider.slides[index].backgroundColor);
    }

    if(global_options.settings.slider.slides[index].color){
        jQuery('#color_'+index).val(global_options.settings.slider.slides[index].color);
    }

    if(global_options.settings.slider.slides[index].contentColor){
        jQuery('#contentColor_'+index).val(global_options.settings.slider.slides[index].contentColor);
    }

    if(global_options.settings.slider.slides[index].buttonText){
        jQuery('#buttonText_'+index).val(global_options.settings.slider.slides[index].buttonText);
    }

    if(global_options.settings.slider.slides[index].order){
        jQuery('#order_'+index).val(global_options.settings.slider.slides[index].order);
    }

    //SET REMOVE
    htheme_set_remove();

    //CONVERT COMPONENTS
    htheme_convert_components();

    //SLIDER ACCORDION
    htheme_slider_accordion();

}

//SET LAYOUT IMG
function htheme_set_layout_img(index, image_content){

    jQuery('.htheme_selector_'+index+' .htheme_slide_layout_selector').each(function(){
        if(image_content === 'false'){
            switch(jQuery(this).attr('id')){
                case 'htheme_slide_1':
                    jQuery(this).addClass('htheme_text_slide_1');
                    break;
                case 'htheme_slide_2':
                    jQuery(this).addClass('htheme_text_slide_2');
                    break;
                case 'htheme_slide_3':
                    jQuery(this).addClass('htheme_text_slide_3');
                    break;
            }
            //SHOW HIDE
            jQuery(this).parents('#htheme_row_slide_'+index).find('[data-show="content"]').show();
            jQuery(this).parents('#htheme_row_slide_'+index).find('[data-show="image"]').hide();
        } else {
            switch(jQuery(this).attr('id')){
                case 'htheme_slide_1':
                    jQuery(this).removeClass('htheme_text_slide_1');
                    break;
                case 'htheme_slide_2':
                    jQuery(this).removeClass('htheme_text_slide_2');
                    break;
                case 'htheme_slide_3':
                    jQuery(this).removeClass('htheme_text_slide_3');
                    break;
            }
            //SHOW HIDE
            jQuery(this).parents('#htheme_row_slide_'+index).find('[data-show="image"]').show();
            jQuery(this).parents('#htheme_row_slide_'+index).find('[data-show="content"]').hide();
        }
    });

}

//REMOVE SLIDE
function htheme_remove_slide(){

    jQuery('.htheme_slide_remove').off().on('click', function(){
        var id_to_remove = jQuery(this).attr('data-index');
        global_options.settings.slider.slides[id_to_remove].deleted = 'true';
        //global_options.settings.slider.slides.splice(id_to_remove, 1); // DELETE FROM ARRAY
        jQuery('#htheme_row_slide_'+id_to_remove).remove();
        htheme_get_slides(global_options.settings.slider.slides);
    });

}

//SET UPDATE DATA
function htheme_update_slide_data(index){

    var _layout = jQuery('.htheme_selector_'+index+' .htheme_slide_layout_selector');
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
        global_options.settings.slider.slides[index].layout = the_value;

        htheme_flag_save(true);

    });

    jQuery('#status_'+index).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.slider.slides[index].status = jQuery(this).val() : global_options.settings.slider.slides[index].status = false;
        htheme_flag_save(true);
    });

    jQuery('#imageContent_'+index).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.slider.slides[index].imageContent = jQuery(this).val() : global_options.settings.slider.slides[index].imageContent = false;
        jQuery(this).prop('checked') ? htheme_set_layout_img(index, jQuery(this).val()) : htheme_set_layout_img(index, 'false');
        htheme_flag_save(true);
    });

    jQuery('#imageContentSrc_'+index).on('change', function(){
        global_options.settings.slider.slides[index].imageContentSrc = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_imageContentSrc_'+index).css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery('#backgroundSrc_'+index).on('change', function(){
        global_options.settings.slider.slides[index].backgroundSrc = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_backgroundSrc_'+index).css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery('#slideTitle_'+index).on('change', function(){
        global_options.settings.slider.slides[index].slideTitle = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#slideContent_'+index).on('change', function(){
        global_options.settings.slider.slides[index].slideContent = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#slideUrl_'+index).on('change', function(){
        global_options.settings.slider.slides[index].slideUrl = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#backgroundColor_'+index).on('change', function(){
        global_options.settings.slider.slides[index].backgroundColor = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#color_'+index).on('change', function(){
        global_options.settings.slider.slides[index].color = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#contentColor_'+index).on('change', function(){
        global_options.settings.slider.slides[index].contentColor = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#buttonText_'+index).on('change', function(){
        global_options.settings.slider.slides[index].buttonText = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery('#order_'+index).on('change', function(){
        global_options.settings.slider.slides[index].order = jQuery(this).val();
        htheme_flag_save(true);
    });

}

//GET HTML
function htheme_get_slide_html(element, index, slide_count){

    //VARIABLES
    var slide_html = '';

    slide_html += '<div class="htheme_slide_holder" id="htheme_row_slide_'+index+'">';
    slide_html += '<div class="htheme_slide_holder_top" style="background-color:'+element.backgroundColor+'">';
    slide_html += '<div class="htheme_form_col_9">Slide #'+slide_count+'</div>';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<span class="htheme_slide_open htheme_edit_button" data-status="open"></span>';
    slide_html += '<span class="htheme_slide_remove htheme_delete_button" data-index="'+index+'"></span>';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_slide_holder_content">';
    slide_html += '<div class="htheme_inner_slide_content">';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Active</div>';
    slide_html += '<div class="htheme_label_excerpt">Slides can be switched off if you don\'t want to display it. Enable must be ticked by default.</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="checkbox" name="status_'+index+'" id="status_'+index+'" value="true">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Use image for content</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="checkbox" name="imageContent_'+index+'" id="imageContent_'+index+'" value="true">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Slide layout</div>';
    slide_html += '<div class="htheme_label_excerpt">Choose content position.</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9 htheme_selector_'+index+'">';
    slide_html += '<div class="htheme_slide_layout_selector" data-value="1" id="htheme_slide_1"></div>';
    slide_html += '<div class="htheme_slide_layout_selector" data-value="2" id="htheme_slide_2"></div>';
    slide_html += '<div class="htheme_slide_layout_selector" data-value="3" id="htheme_slide_3"></div>';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';

slide_html += '<div class="htheme_show_hide_slider" data-show="image">';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Image content</div>';
    slide_html += '<div class="htheme_label_excerpt">Add image on slide canvas.</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="imageContentSrc_'+index+'" data-multiple="false" data-size="full">';
    slide_html += 'Upload';
    slide_html += '</div>';
    slide_html += '<input type="hidden" name="imageContentSrc_'+index+'" id="imageContentSrc_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_12">';
    slide_html += '<div class="htheme_image_holder" id="image_imageContentSrc_'+index+'"></div>';
    slide_html += '<span class="htheme_remove_image" data-input="imageContentSrc_'+index+'">Remove image [x]</span>';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
slide_html += '</div>';

    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Background image</div>';
    slide_html += '<div class="htheme_label_excerpt">Add a background image of approximately 2000px x 700px</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="backgroundSrc_'+index+'" data-multiple="false" data-size="full">';
    slide_html += 'Upload';
    slide_html += '</div>';
    slide_html += '<input type="hidden" name="backgroundSrc_'+index+'" id="backgroundSrc_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_12">';
    slide_html += '<div class="htheme_image_holder" id="image_backgroundSrc_'+index+'"></div>';
    slide_html += '<span class="htheme_remove_image" data-input="backgroundSrc_'+index+'">Remove image [x]</span>';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';

slide_html += '<div class="htheme_show_hide_slider" data-show="content">';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Slide title</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="text" name="slideTitle_'+index+'" id="slideTitle_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Slide content</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<textarea name="slideContent_'+index+'" id="slideContent_'+index+'" class="htheme_field_fixed_400" rows="5"></textarea>';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Button Text</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="text" name="buttonText_'+index+'" id="buttonText_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
slide_html += '</div>';

    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">URL</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="text" name="slideUrl_'+index+'" id="slideUrl_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Slide background color</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input name="backgroundColor_'+index+'" id="backgroundColor_'+index+'" class="htheme_color_picker">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';

slide_html += '<div class="htheme_show_hide_slider" data-show="content">';
    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Title color</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input name="color_'+index+'" id="color_'+index+'" class="htheme_color_picker">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';

    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Content color</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input name="contentColor_'+index+'" id="contentColor_'+index+'" class="htheme_color_picker">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
slide_html += '</div>';

    slide_html += '<!-- ROW -->';
    slide_html += '<div class="htheme_form_row">';
    slide_html += '<div class="htheme_form_col_3">';
    slide_html += '<div class="htheme_label">Slide order</div>';
    slide_html += '</div>';
    slide_html += '<div class="htheme_form_col_9">';
    slide_html += '<input type="text" name="order_'+index+'" id="order_'+index+'" class="htheme_field_fixed_400">';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '<!-- ROW -->';
    slide_html += '</div>';
    slide_html += '</div>';
    slide_html += '</div>';

    return slide_html;

}

//SLIDER ACCORDION
function htheme_slider_accordion(){

    //CLICK
    jQuery('.htheme_slide_open').off().on('click', function(){

        //VARIABLES
        var the_height = jQuery(this).parents('.htheme_slide_holder').children('.htheme_slide_holder_content').children('.htheme_inner_slide_content').height();
        var extend_div = jQuery(this).parents('.htheme_slide_holder').children('.htheme_slide_holder_content');

        if(jQuery(this).attr('data-status') === 'open'){
            //TWEEN
            TweenMax.to( jQuery(extend_div), 0, {
                    height:the_height,
                    ease:Strong.easeOut
                }
            );
            jQuery(extend_div).css({
                'display':'table'
            });
            jQuery(this).attr('data-status', 'close');
        } else {
            //TWEEN
            TweenMax.to( jQuery(extend_div), 0, {
                    height:115,
                    ease:Strong.easeOut
                }
            );
            jQuery(extend_div).css({
                'display':'block'
            });
            jQuery(this).attr('data-status', 'open');
        }

    });

}
