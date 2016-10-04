//HEROTHEME MANAGER

jQuery(function(){

    //SET THE SIDEBAR
    htheme_set_sidebar();

    //ADJUST SIDEBAR HEIGHT ACCORDING TO CONTENT HEIGHT
    jQuery(window).on('resize', function(){
        htheme_set_sidebar();
    });

});

//SET THE SIDEBAR
function htheme_set_sidebar(){

    //VARIABLES
    var height = jQuery('.htheme_control').height() + 40;

    //ADD CSS HEIGHT TO SIDEBAR
    jQuery('.htheme_sidebar').css({
        'height':height
    });

}

//SET THE SIDEBAR
function htheme_set_sidebar_animation(){

    //ADD CSS HEIGHT TO SIDEBAR
    jQuery('.htheme_sidebar ul li').on({
        mouseenter: function(){
            TweenMax.to( jQuery(this).children('span'), 0.4, {
                    paddingLeft:50,
                    ease:Strong.easeOut,
                    zIndex:9999
                }
            );
        },
        mouseleave: function(){
            TweenMax.to( jQuery(this).children('span'), 0.5, {
                    paddingLeft:45,
                    ease:Strong.easeOut,
                    zIndex:1
                }
            );
        }
    });

}


