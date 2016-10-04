//INSTANTIATE JQUERY
jQuery(function(){

    //CONVERT COMPONENTS
    htheme_convert_components();

});

//CONVERT COMPONENTS
function htheme_convert_components(){

    //COLOR PICKER
    jQuery('.htheme_color_picker').each(function(index, element) {
        if(jQuery(this).data('bound') != 'set'){
            var current_value = jQuery(this).val();
            var picker_id = jQuery(this).attr('id');
            var picker_name = jQuery(this).attr('name');
            var picker_class = jQuery(this).attr('class');
            bind_color_picker_html(element, index, current_value, picker_id, picker_name, picker_class);
        }
    });

    //MEDIA UPLOADER
    jQuery('.htheme_media_uploader').each(function(index, element) {
        bind_media_uploader(element);
    });

    //FONT SEARCH SELECT
    jQuery('.htheme_font_search').each(function(index, element) {
        bind_font_select(element);
    });

}

//FONT SELECT BOXES
function bind_font_select(element){

    //VARIABLES
    var html = '';

    //BUILD HTML
    html += '<!-- ADVANCED SEARCH -->';
    html += '<div class="htheme_select_search htheme_font_'+element.id+'">';
        html += '<div class="htheme_select_label">Select Value Here</div>';
        html += '<div class="htheme_select_toggle"></div>';
        html += '<div class="htheme_select_dropdown">';
            html += '<div class="htheme_select_search_field">';
                html += '<input type="text" name="htheme_input_'+element.id+'" id="htheme_input_'+element.id+'" placeholder="Search...">';
            html += '</div>';
            html += '<div class="htheme_select_search_values '+element.id+'">';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    html += '<!-- ADVANCED SEARCH -->';

    //ADD HTML
    jQuery('#' + element.id).after(html);

    //POPULATE SELECT
    htheme_populate_select(element);
    htheme_activate_click(element.id);
    htheme_activate_search(element);
    htheme_toggle_select(element);

}

//POPULATE SELECT
function htheme_populate_select(element){
    jQuery('.'+element.id).html('');
    var html = '';
    jQuery('#'+element.id + ' option').each(function(index, option) {
        html += '<div class="htheme_inner_value"  data-index="'+index+'" data-value="'+jQuery(this).val()+'">'+option.text+'</div>';
        if(jQuery(this).is(':selected')){
            jQuery('.htheme_font_'+element.id+ ' .htheme_select_label').html(option.text);
            htheme_active_variants_search(option.text, element.id);
        }
    });
    jQuery('.'+element.id).html(html);
}

//ACTIVATE CLICK FOR SELECT
function htheme_activate_click(id){
    jQuery('.' + id + ' .htheme_inner_value').on('click', function(){
        var select_value = jQuery(this).data('value');
        var select_text = jQuery(this).text();
        jQuery('#'+id + ' option').removeAttr('selected');
        jQuery('#'+id + ' option').each(function(index, option){
            if(jQuery(this).val() == select_value){
                jQuery(this).attr('selected', 'selected').trigger('change');
                jQuery('.htheme_font_'+id+ ' .htheme_select_label').html(select_text);
            }
        });
        htheme_active_variants_search(select_value, id);
        jQuery('body').find('[data-search-link="'+id+'"]').trigger('change');
    })
}

//ACTIVATE VARIANT SEARCH
function htheme_active_variants_search(value, id){ //ID is equal to the connected dropdown that will have all the values of the variants

    jQuery(global_fonts).each(function(index,element){
        if(element.family === value){
            var option = '';
            jQuery(element.variants).each(function(idx,ele){
                option += '<option value="'+ele+'">'+ele+'</option>';
            });
            jQuery('body').find('[data-search-link="'+id+'"]').html(option);
        }
    });

}

//ACTIVATE SEARCH
function htheme_activate_search(element){
    jQuery( "#htheme_input_"+element.id ).autocomplete({
        source: global_search_fonts,
        appendTo: '.'+element.id,
        response: function( event, ui ) {
            var html = '';
            jQuery(ui.content).each(function(index, element){
                //console.log(element.label);
                html += '<div class="htheme_inner_value" data-index="'+index+'" data-value="'+element.value+'">'+element.label+'</div>';
            });
            jQuery('.'+element.id).html(html);
            htheme_activate_click(element.id);
        }
    });
    jQuery( "#htheme_input_"+element.id).on('change keyup', function(){
        if(jQuery(this).val() === ''){
            htheme_populate_select(element);
            htheme_activate_click(element.id);
        }
    });
}

//TOGGLE SELECT DROPDOWN
function htheme_toggle_select(element){
    var select_holder = jQuery('.htheme_font_'+element.id + ' .htheme_select_toggle');
    jQuery(select_holder).on('click', function(){
        jQuery('.htheme_font_'+element.id+ ' .htheme_select_dropdown').toggle();
        jQuery('.htheme_font_'+element.id).on('mouseleave', function(){
            jQuery('.htheme_font_'+element.id+ ' .htheme_select_dropdown').hide();
        })
    })
}

//SET BOUND
function htheme_set_bound(id){
    jQuery('#'+id).attr('data-bound', 'set');
}

//PICKER VARIABLES
var img_width = 231;
var img_height = 231;

//COLOR PICKER
function bind_color_picker_html(element, index, current_value, picker_id, picker_name, picker_class){

    //VARIABLES
    var color_picker_html = '';
    var color_picker_input = jQuery(element).clone();

    //HTML
    color_picker_html += '<div class="htheme_color_wrap" id="htheme_custom_picker_'+index+'">';
        color_picker_html += '<div class="htheme_sample_holder" id="htheme_sample_'+index+'">';
            color_picker_html += '<div class="htheme_sample_inner"></div>';
        color_picker_html += '</div>';
        color_picker_html += '<div class="htheme_canvas_holder">';
            color_picker_html += '<canvas width="231" height="231" id="htheme_canvas_picker_'+element.id+'"></canvas>';
        color_picker_html += '</div>';
    color_picker_html += '</div>';

    //ATTACH TO HTML
    jQuery(element).replaceWith(color_picker_html);
    jQuery('#htheme_custom_picker_'+index).append(color_picker_input);

    //BIND INPUT
    bind_color_picker(picker_id, current_value, index);
    set_current_color(picker_id, current_value, index);

    //BIND THE TOGGLE
    bind_color_picker_toggle('htheme_custom_picker_'+index);

    //ACTIVATE CANVAS
    htheme_activate_canvas(element);

    //SET BOUND
    htheme_set_bound(picker_id);

}

function bind_color_picker_toggle(element){

    jQuery('#'+element).children('.htheme_canvas_holder').hide();

    jQuery('#'+element).click(function(e) {
        jQuery('.htheme_canvas_holder').hide();
        jQuery(this).children('.htheme_canvas_holder').hide();
        jQuery(this).children('.htheme_canvas_holder').toggle();
        e.stopPropagation();
    });

    jQuery(document).click(function() {
        jQuery('#'+element).children('.htheme_canvas_holder').hide();
    });

}

//BIND COLOR PICKER
function bind_color_picker(picker_id, current_value, index){
    jQuery('#'+picker_id).off().on('change', function(){
        jQuery('#htheme_sample_'+index).css({
            'background-color': jQuery('#'+picker_id).val()
        });
    });
}

//BIND CURRENT COLOR
function set_current_color(picker_id, current_value, index){
    jQuery('#htheme_sample_'+index).css({
        'background-color': jQuery('#'+picker_id).val()
    });
}

//ACTIVATE CANVAS
function htheme_activate_canvas(element){

    //VARIABLES
    var canvas = jQuery('#htheme_canvas_picker_'+element.id)[0];
    var context = canvas.getContext("2d");

    //CREATE IMAGE OBJECT AND GET ITS SOURCE
    var img = new Image();
    img.src = global_theme_directory+'/htheme/assets/images/settings/color_picker.jpg';

    //ADD IMAGE TO CANVAS
    jQuery(img).load(function(){
        context.drawImage(img,0,0);
        canvas.addEventListener('click', select_colour, false);
    });

}

//SELECT COLOR
function select_colour(evt){
    var the_picker = jQuery(this).context.getAttribute('id');
    var the_field = jQuery(this).parents('.htheme_color_wrap').children('input');
    var colour = get_colour(evt, the_picker);
    jQuery(the_field).val(colour).trigger('change');
}

//GET THE COLOR
function get_colour(evt, the_picker){
    var canvas = jQuery('#'+ the_picker)[0];
    var context = canvas.getContext("2d");
    var image_data = context.getImageData(0, 0, img_width, img_height).data;
    var elementXPos = evt.offsetX ? evt.offsetX : (evt.layerX - jQuery(evt.target).position().left);
    var elementYPos = evt.offsetY ? evt.offsetY : (evt.layerY - jQuery(evt.target).position().top);
    var i = ((parseInt(elementYPos) * img_width) + parseInt(elementXPos)) * 4;
    return "#" + d2Hex(image_data[i]) + d2Hex(image_data[i + 1]) + d2Hex(image_data[i + 2]);
}

//CONVERT RGB TO HEX
function d2Hex(d){
    var hex = Number(d).toString(16);
    while(hex.length < 2){ hex = "0" + hex; }
    return hex.toUpperCase();
}

//ACTIVATE MEDIA LOADER
function bind_media_uploader(elements){
    var file_frame;
    jQuery(elements).off().on('click', function(event){

        //connected with an items ID
        var the_connected_input = jQuery('#'+jQuery(this).data('connect'));

        //set multiple status true for multiple, false for single selection
        var the_mulitple_status = jQuery(this).data('multiple');

        //set the image size
        var the_size = jQuery(this).data('size');

        if(the_mulitple_status){
            the_mulitple_status = 'add';
        }else{
            the_mulitple_status = false;
        }

        event.preventDefault();

        if(file_frame){
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('title'),
            button: {
                text: jQuery(this).data('text')
            },
            multiple: the_mulitple_status
        });

        //MEDIA FRAME
        file_frame.on( 'select', function() {

            //VARAIBLES
            var my_img_array = [];
            var img_string = '';

            if(the_mulitple_status == 'add'){
                attachment = file_frame.state().get('selection');
                //LOOP
                jQuery(attachment.models).each(function(index,element){
                    my_img_array.push(element.attributes.url);
                });
                //SET VARIABLE
                img_string = my_img_array.toString();
            } else {
                attachment = file_frame.state().get('selection').first().toJSON();
                //SET VARIABLE
                img_string = attachment.sizes.full.url;
            }

            //SET INPUT
            the_connected_input.val(img_string);

            //TRIGGER
            jQuery(the_connected_input).trigger('change');

        });
        file_frame.open();
    });
}