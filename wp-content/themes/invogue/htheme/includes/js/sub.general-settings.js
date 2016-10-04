//INSTANTIATE JQUERY
jQuery(function(){

    //SET THE HEADER
    htheme_set_header('General Settings');

    //SET DATA
    htheme_set_data();

    //UPDATE DATA
    htheme_update_data();

    //CONVERT COMPONENTS
    htheme_convert_components();

});

//SET DATA
function htheme_set_data(){

    //VARIABLES
    var _theme = global_options.settings.general.theme;
    var _favIcon = global_options.settings.general.favIcon;
    var _pageLoader = global_options.settings.general.pageLoader;
    var _toTop = global_options.settings.general.toTop;
    var _codeHead = global_options.settings.general.codeHead;
    var _codeBody = global_options.settings.general.codeBody;
    var _codeCss = global_options.settings.general.codeCss;

    var _page_404_title = global_options.settings.general.page_404_title;
    var _page_404_sub = global_options.settings.general.page_404_sub;
    var _page_404_description = global_options.settings.general.page_404_description;
    var _page_404_button_text = global_options.settings.general.page_404_button_text;
    var _page_404_button_url = global_options.settings.general.page_404_button_url;

    //SET DATA
    if(_theme){
        jQuery('#theme').val(_theme);
    }

    if(_favIcon){
        jQuery('#favIcon').val(_favIcon);
        //SET IMAGE
        jQuery('#image_favIcon').css({
            'background-image' : 'url('+_favIcon+')'
        });
    }

    if(_pageLoader){
        if(jQuery('#pageLoader').val() == _pageLoader){
            jQuery('#pageLoader').attr('checked', 'checked');
        }
    }

    if(_toTop){
        if(jQuery('#toTop').val() == _toTop){
            jQuery('#toTop').attr('checked', 'checked');
        }
    }

    if(_codeHead){
        jQuery('#codeHead').val(_codeHead.replace(/\\/g, ""));
        jQuery('#_codeHead').html(_codeHead.replace(/\\/g, ""));
    }

    if(_codeBody){
        jQuery('#codeBody').val(_codeBody.replace(/\\/g, ""));
        jQuery('#_codeBody').html(_codeBody.replace(/\\/g, ""));
    }

    if(_codeCss){
        jQuery('#codeCss').val(_codeCss.replace(/\\/g, ""));
        jQuery('#_codeCss').html(_codeCss.replace(/\\/g, ""));
    }

    if(_page_404_title){
        jQuery('#page_404_title').val(_page_404_title);
    }

    if(_page_404_sub){
        jQuery('#page_404_sub').val(_page_404_sub);
    }

    if(_page_404_description){
        jQuery('#page_404_description').val(_page_404_description.replace(/\\/g, ""));
    }

    if(_page_404_button_text){
        jQuery('#page_404_button_text').val(_page_404_button_text);
    }

    if(_page_404_button_url){
        jQuery('#page_404_button_url').val(_page_404_button_url);
    }

}

//UPDATE DATA
function htheme_update_data(){

    //VARIABLES
    var _theme = jQuery('#theme');
    var _favIcon = jQuery('#favIcon');
    var _pageLoader = jQuery('#pageLoader');
    var _toTop = jQuery('#toTop');
    var _codeHead = jQuery('#codeHead');
    var _codeBody = jQuery('#codeBody');
    var _codeCss = jQuery('#codeCss');

    var _page_404_title = jQuery('#page_404_title');
    var _page_404_sub = jQuery('#page_404_sub');
    var _page_404_description = jQuery('#page_404_description');
    var _page_404_button_text = jQuery('#page_404_button_text');
    var _page_404_button_url = jQuery('#page_404_button_url');

    //CODE HEAD
    var __codeHead = ace.edit("_codeHead");
    __codeHead.setTheme("ace/theme/twilight");
    __codeHead.session.setMode("ace/mode/javascript");

    __codeHead.getSession().on('change', function () {
        _codeHead.val(__codeHead.getSession().getValue());
        global_options.settings.general.codeHead = __codeHead.getSession().getValue();
        htheme_flag_save(true);
    });

    //CODE BODY
    var __codeBody = ace.edit("_codeBody");
    __codeBody.setTheme("ace/theme/twilight");
    __codeBody.session.setMode("ace/mode/javascript");

    __codeBody.getSession().on('change', function () {
        _codeBody.val(__codeBody.getSession().getValue());
        global_options.settings.general.codeBody = __codeBody.getSession().getValue();
        htheme_flag_save(true);
    });

    //CODE CSS
    var __codeCss = ace.edit("_codeCss");
    __codeCss.setTheme("ace/theme/twilight");
    __codeCss.session.setMode("ace/mode/css");

    __codeCss.getSession().on('change', function () {
        _codeCss.val(__codeCss.getSession().getValue());
        global_options.settings.general.codeCss = __codeCss.getSession().getValue();
        htheme_flag_save(true);
    });

    //UPDATE
    jQuery(_theme).on('change', function(){
        global_options.settings.general.theme = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_favIcon).on('change', function(){
        global_options.settings.general.favIcon = jQuery(this).val();
        //SET IMAGE
        jQuery('#image_favIcon').css({
            'background-image' : 'url('+jQuery(this).val()+')'
        });
        htheme_flag_save(true);
    });

    jQuery(_pageLoader).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.general.pageLoader = jQuery(this).val() : global_options.settings.general.pageLoader = false;
        htheme_flag_save(true);
    });

    jQuery(_toTop).on('change', function(){
        jQuery(this).prop('checked') ? global_options.settings.general.toTop = jQuery(this).val() : global_options.settings.general.toTop = false;
        htheme_flag_save(true);
    });

    jQuery(_codeHead).on('change', function(){
        global_options.settings.general.codeHead = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_codeBody).on('change', function(){
        global_options.settings.general.codeBody = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_codeCss).on('change', function(){
        global_options.settings.general.codeCss = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_page_404_title).on('change', function(){
        global_options.settings.general.page_404_title = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_page_404_sub).on('change', function(){
        global_options.settings.general.page_404_sub = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_page_404_description).on('change', function(){
        global_options.settings.general.page_404_description = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_page_404_button_text).on('change', function(){
        global_options.settings.general.page_404_button_text = jQuery(this).val();
        htheme_flag_save(true);
    });

    jQuery(_page_404_button_url).on('change', function(){
        global_options.settings.general.page_404_button_url = jQuery(this).val();
        htheme_flag_save(true);
    });

}

