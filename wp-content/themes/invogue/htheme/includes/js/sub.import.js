//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('Import &amp; Export Settings');

    //SET DATA TYPE SIGNUPS
    htheme_set_signups();

    //GENERATE STRING
    htheme_generate_string();

    //GENERATE STRING
    htheme_import_string();

    //CREATE SIGNUPS
    htheme_write_to_file();

});

//GENERATE STRING
function htheme_generate_string(){

    jQuery('#htheme_export_options').on('click', function(){

        //GENERATE
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'htheme_generate_options_string'
            },
            dataType: "json"
        }).done(function(data){
            jQuery('#exportOptions').val(JSON.stringify(data));
        }).fail(function(event){
            //console.log(event);
        });

    });

}

//GENERATE STRING
function htheme_import_string(){

    jQuery('#htheme_import_options').on('click', function(){

        if(jQuery('#importOptions').val() !== '' && jQuery('#importOptions').val().length > 12500){
            var update_options = JSON.parse(jQuery('#importOptions').val());
            //GENERATE
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    'action': 'htheme_import_options_string',
                    'options': update_options
                },
                dataType: "json"
            }).done(function(data){
                jQuery('#importOptions').val('');
                jQuery('#exportOptions').val('');
                global_options = data;
                //SHOW VISUAL FLAG OF SAVE
                htheme_set_flag('import');
            }).fail(function(event){
            });
        } else {
            //SHOW VISUAL FLAG OF ERROR
            htheme_set_flag('error');
        }

    });

}

//WRITE TO FILE TESt
function htheme_write_to_file(){

    jQuery('.create_export').on('click', function(){

        //VARAIBLES
        var signups = jQuery(this).attr('data-signups');

        //GENERATE
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'htheme_write_file',
                'signups': signups
            },
            dataType: "json"
        }).done(function(data){
            //SHOW DOWNLOAD
            jQuery('.htheme_download_export').show();
        }).fail(function(event){
            //console.log(event);
        });

    });

    jQuery('.htheme_download_export').on('click', function(){
        var file = jQuery(this).attr('data-file');
        window.open(file);
    });

}

//SET SIGNUPS ATTRIBUTE
function htheme_set_signups(){
    jQuery('.create_export').attr('data-signups', global_signups)
}