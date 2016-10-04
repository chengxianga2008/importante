//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Demo Settings');

    //PRE POPULATE PAGES
    htheme_set_page_html();

    //SET CHANGE
    htheme_apply();

    //SET CHANGE
    htheme_demo_install();

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

    jQuery('#pages').append(html);

}

//SET CHANGE
function htheme_apply(){

    jQuery('#htheme_apply_change').on('click', function(){

        //PAGE VALUE
        var htheme_page = jQuery('#pages').val();
        var htheme_layout = jQuery('#shortcode_demo').val();

        //CHECK
        if(htheme_page != '' && htheme_layout != ''){

            //DO UPDATE
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    'action': 'htheme_set_page_shortcode',
                    'id': htheme_page,
                    'layout': htheme_layout
                },
                dataType: "json"
            }).done(function(data){
                htheme_show_save('layout_save');
                jQuery('#pages').val('');
            }).fail(function(event){
                htheme_show_save('error');
            });
        } else {
            htheme_show_save('error');
        }

    });

}

//SET CHANGE
function htheme_demo_install(){

    jQuery('#htheme_check').on('click', function(){
        jQuery('.htheme_sure_holder').show();
    });
    jQuery('#htheme_check_close').on('click', function(){
        jQuery('.htheme_sure_holder').hide();
    });
    jQuery('#htheme_demo_install').on('click', function(){
        //DO UPDATE
        jQuery.ajax({
            url:ajaxurl,
            type:"POST",
            data:{
                'action':'htheme_demo_install'
            },
            dataType:"json"
        }).done(function(data){
            htheme_show_save('save');
            jQuery('.htheme_sure_holder').hide();
        }).fail(function(event){
            htheme_show_save('error');
        });

    })
}


