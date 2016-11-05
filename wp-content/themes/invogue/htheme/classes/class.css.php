<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO CSS SETUP
class htheme_css{

	#CONSTRUCT
	public function __construct(){
	}

	#CREATE CSS
	public function htheme_create_css(){

		#GLOBALS
		global $post;

		#VARAIBLES - GENERAL SETTINGS
		$htheme_toTop = $GLOBALS['htheme_global_object']['settings']['general']['toTop'];

		#VARAIBLES - HEADER
		$htheme_header_style_options = $GLOBALS['htheme_global_object']['settings']['header']['stylingOptions'];
		$htheme_footer_style_options = $GLOBALS['htheme_global_object']['settings']['footer']['stylingOptions'];
		$htheme_typography_style_options = $GLOBALS['htheme_global_object']['settings']['typography']['fonts'];
		$htheme_button_style_options = $GLOBALS['htheme_global_object']['settings']['styling']['buttons'];

		$htheme_slider_height = $GLOBALS['htheme_global_object']['settings']['slider']['height'];

		$htheme_mega_styles = $GLOBALS['htheme_global_object']['settings']['megamenu']['menuItems'];
		$htheme_typography_mega_options = $GLOBALS['htheme_global_object']['settings']['megamenu']['fonts'];

		$htheme_footer_primary_background = $GLOBALS['htheme_global_object']['settings']['footer']['backgroundPrimary'];
		$htheme_footer_secondary_background = $GLOBALS['htheme_global_object']['settings']['footer']['backgroundSecondary'];
		$htheme_logo_height = $GLOBALS['htheme_global_object']['settings']['header']['logoHeight'];
		$htheme_logo_sticky_height = $GLOBALS['htheme_global_object']['settings']['header']['logoStickyHeight'];

		$htheme_social_items =  $GLOBALS['htheme_global_object']['settings']['header']['socialItems'];
		$htheme_social_primary_color =  $GLOBALS['htheme_global_object']['settings']['header']['socialPrimaryColor'];

		$htheme_custom_css =  $GLOBALS['htheme_global_object']['settings']['general']['codeCss'];

		$htheme_meta_height = '';
		$htheme_meta_layout = 3;
		$htheme_meta_shortcode = '';
		$htheme_meta_top_padding = 'no';
		$htheme_meta_font_color = '#000000';

		if(!is_404() && !is_search() && have_posts()){
			$htheme_meta_height = get_post_meta( $post->ID, 'htheme_meta_height', true );
			$htheme_meta_layout = get_post_meta( $post->ID, 'htheme_meta_layout', true );
			$htheme_meta_shortcode = get_post_meta( $post->ID, 'htheme_meta_shortcode', true );
			$htheme_meta_top_padding = get_post_meta( $post->ID, 'htheme_meta_top_padding', true );
			$htheme_meta_font_color = get_post_meta( $post->ID, 'htheme_meta_font_color', true );
		}

		$htheme_lb_meta_devider_color = $GLOBALS['htheme_global_object']['settings']['lookbook']['dividerColor'];

		$htheme_option_search = $GLOBALS['htheme_global_object']['settings']['header']['optionSearch'];

		$htheme_pageLoader = $GLOBALS['htheme_global_object']['settings']['general']['pageLoader'];

		#SLIDER
		$slides = $GLOBALS['htheme_global_object']['settings']['slider']['slides'];
		$slide_count = 0;
		foreach($slides as $slide){
			if(($slide['status'] == 'true' && $slide['deleted'] == 'false')){
				$slide_count++;
			}
		}

		#INLINE CSS
		$htheme_css = '';

		#PREPARE CSS - INLINE ADDITION TO CURRENT THEME STYLES
		if($htheme_slider_height !== ''):
			$htheme_css .= '
				.htheme_top_holder{
					height:'.$htheme_slider_height.'px;
				}
			';
		endif;

		if($htheme_pageLoader == 'false'):
			$htheme_css .= '
				.htheme_page_loader{
					display:none;
				}
			';
		endif;

		if(is_page_template( 'templates/template.home-noslider.php' )){
			//DO NOTHING
		} else if($htheme_meta_shortcode !== ''){
			$htheme_css .= '
				.htheme_top_holder{
					height:auto !important;
				}
			';
		} else if($slide_count == 0 && is_front_page() || $slide_count == 0 && is_page_template( 'templates/template.home.php' ) || is_search()){
			$htheme_css .= '
				.htheme_top_holder{
					height:125px !important;
				}
			';
		}

		$htheme_css .= '/* ---------------------------------------------- slide count '.$slide_count.' */';

		#ADMIN BAR
		if(is_admin_bar_showing()):
			$htheme_css .= '
				.htheme_navigation{
					top:32px;
				}
			';

			$htheme_css .= '@media (min-width: 601px) and (max-width: 768px) {';
				$htheme_css .= '
					.htheme_navigation{
						top:46px;
					}
					.htheme_shift_mobile{
						top:46px;
					}
				';
			$htheme_css .= '}';

			$htheme_css .= '@media (max-width: 600px) {';
				$htheme_css .= '
					.htheme_navigation{
						top:46px;
					}
					.htheme_shift_mobile{
						top:0;
					}
				';
			$htheme_css .= '}';

		endif;

		#CHECK IF SEARCH ICON IS ON
		if($htheme_option_search != 'false'):
			$htheme_css .= '
				.htheme_large_white_box{
					right:-26px !important;
				}
			';
		endif;

		#LOGOS
		$htheme_css .= '
			.htheme_logo .htheme_main_logo img{
				height:'.$htheme_logo_height.';
			}
			.htheme_logo .htheme_sticky_logo img{
				height:'.$htheme_logo_sticky_height.';
			}
			.htheme_logo .htheme_mobile_logo img{
				height:35px;
			}
		';

		#DIVIDERS
		$htheme_css .= '
			svg polygon,
			svg path,
			svg rect{
				fill:' . $this->htheme_get_accent('accentdividertwo') . ';
			}
		';

		$htheme_css .= '
			.htheme_top_holder svg polygon,
			.htheme_top_holder svg path,
			.htheme_top_holder svg rect{
				fill:' . $this->htheme_get_accent('accentdividerone') . ';
			}
		';

		#DIVIDERS
		$htheme_css .= '
			.htheme_lb_layout_one svg polygon,
			.htheme_lb_layout_one svg path,
			.htheme_lb_layout_one svg rect{
				fill:' . $htheme_lb_meta_devider_color . ';
			}
		';

		#HEADER STYLE OPTIONS
		foreach($htheme_header_style_options as $header_options){
			switch($header_options['slug']){
				case 'navigation_primary':
				$htheme_css .= '
					/* PRIMARY NAVIGATION */
					.htheme_default_navigation{
							background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_nav ul li > a{
						color:'.$header_options['color'].';
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					/* ACTIVE STATE */
					.htheme_nav ul .current-menu-item  > a,
					.htheme_nav ul .current-menu-parent > a{
						color:'.$header_options['hoverColor'].';
					}
					.htheme_nav ul li:hover > a{
						color:'.$header_options['hoverColor'].';
					}
					.htheme_icon_nav,
					.htheme_icon_hamburger_toggle{
						border-left: 1px solid rgba('.$this->htheme_hex_to_rgb($header_options['color']).', 0.2);
					}
					.htheme_icon_dropdown:after{
						color:'.$header_options['color'].';
					}
					/* NAV ICONS */
					.htheme_icon_nav li a:before{
						color:'.$header_options['color'].';
					}
					.htheme_icon_nav ul li > a span{
						color:'.$header_options['color'].';
					}
					.htheme_icon_nav ul li:hover a:before{
						color:'.$header_options['hoverColor'].' !important;
					}
				';
				break;
				case 'navigation_dropdown':
				$htheme_css .= '
					.htheme_nav ul li > ul{
						background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_nav ul li > ul li{
						background:none;
					}
					.htheme_nav ul li > ul li a{
						color:'.$header_options['color'].';
						font-family:'.$header_options['family'].' !important;
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].' !important;
						text-transform:'.$header_options['transform'].' !important;
						letter-spacing:'.$header_options['spacing'].' !important;
					}
					/* ACTIVE STATE */
					.htheme_nav ul li > ul .current-menu-item a{
						color:'.$header_options['hoverColor'].';
					}
					.htheme_nav ul li > ul li:hover > a{
						color:'.$header_options['hoverColor'].' !important;
					}
					.htheme_icon_sub_dropdown:after{
						color:'.$header_options['color'].';
					}
					/*MOBILE STYLES*/
					.htheme_mobile .htheme_nav{
						background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_mobile .htheme_nav ul li > a{
						color:'.$header_options['color'].';
					}
					.htheme_mobile .htheme_nav ul li:hover > a{
						color:'.$header_options['hoverColor'].'
					}
					.htheme_mobile .htheme_nav ul li > ul li a{
						color:'.$header_options['color'].' !important;
					}
					.htheme_mobile .htheme_nav ul li > ul li:hover > a{
						color:'.$header_options['hoverColor'].' !important;
					}
					.htheme_mobile .htheme_icon_dropdown:after, .htheme_mobile .htheme_icon_sub_dropdown:after{
						color:'.$header_options['color'].' !important;
					}
				';
				break;
				case 'navigation_sticky':
				$htheme_css .= '
					.htheme_sticky_nav{
						background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_sticky_nav .htheme_nav ul li > a{
						color:'.$header_options['color'].';
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					.htheme_sticky_nav .htheme_nav ul li:hover > a{
						color:'.$header_options['hoverColor'].'
					}
					.htheme_sticky_nav .htheme_icon_nav li a:before{
						color:'.$header_options['color'].';
					}
					.htheme_sticky_nav .htheme_icon_nav ul li > a span{
						color:'.$header_options['color'].';
					}
					.htheme_sticky_nav .htheme_icon_nav ul li:hover a:before{
						color:'.$header_options['color'].' !important;
					}
					.htheme_sticky_nav .htheme_icon_nav{
						border-left: 1px solid rgba('.$this->htheme_hex_to_rgb($header_options['color']).', 0.3);
					}
				';
				break;
				case 'navigation_mobile':
				$htheme_css .= '
					.htheme_default_navigation .htheme_mobile{
						background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_mobile .htheme_nav ul li > a{
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					.htheme_mobile .htheme_icon_nav li a:before{
						color:'.$header_options['color'].';
					}
					.htheme_mobile .htheme_icon_nav ul li > a span{
						color:'.$header_options['color'].';
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					.htheme_mobile .htheme_icon_nav ul li:hover a:before{
						color:'.$header_options['hoverColor'].' !important;
					}
					.htheme_mobile .htheme_icon_nav{
						border-left: 1px solid rgba('.$this->htheme_hex_to_rgb($header_options['color']).', 0.3);
					}
					.htheme_mobile .htheme_inner_navigation .htheme_icon_mobile[data-toggle="open"]:before,
					.htheme_mobile .htheme_inner_navigation .htheme_icon_mobile[data-toggle="close"]:before{
						color:'.$header_options['color'].';
					}
					.htheme_mobile .htheme_inner_navigation .htheme_icon_mobile[data-toggle="open"]:hover:before,
					.htheme_mobile .htheme_inner_navigation .htheme_icon_mobile[data-toggle="close"]:hover:before{
						color:'.$header_options['hoverColor'].';
					}					
					@media (max-width: 768px) {
						.htheme_default_logo_text_inner a{
							color:'.$header_options['color'].' !important;						
						}
					}					
				';
				break;
				case 'navigation_login':
				$htheme_css .= '
					.htheme_small_navigation{
						background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
					}
					.htheme_small_navigation .htheme_account_holder{
						color:'.$header_options['color'].'; border-right-color:rgba('.$this->htheme_hex_to_rgb($header_options['color']).', 0.3);
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					.htheme_small_navigation .htheme_share,
					.htheme_small_navigation .htheme_language{
						color:'.$header_options['color'].';
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
					.htheme_small_navigation .htheme_account_holder a, .htheme_small_navigation .htheme_account_logout a{
						color:'.$header_options['hoverColor'].';
						font-family:'.$header_options['family'].';
						'.$this->htheme_return_weight_style($header_options['weight']).';
						font-size:'.$header_options['size'].';
						text-transform:'.$header_options['transform'].';
						letter-spacing:'.$header_options['spacing'].';
					}
				';
				break;
				case 'navigation_hamburger':
					$htheme_css .= '
						.htheme_hamburger_holder{
							background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', '.$header_options['opacity'].');
						}
						.htheme_hamburger_holder ul li > a{
							color:'.$header_options['color'].';
							font-family:'.$header_options['family'].' !important;
							'.$this->htheme_return_weight_style($header_options['weight']).';
							font-size:'.$header_options['size'].' !important;
							text-transform:'.$header_options['transform'].' !important;
							letter-spacing:'.$header_options['spacing'].' !important;
						}
						.htheme_hamburger_holder ul li:hover{
							background:rgba('.$this->htheme_hex_to_rgb($header_options['background']).', 0.3);
						} 
						.htheme_hamburger_holder ul li > a:hover{
							color:'.$header_options['hoverColor'].';
						}
						.htheme_hamburger_logo{
							border: 1px solid rgba('.$this->htheme_hex_to_rgb($header_options['color']).', .1);
						}		
						.htheme_hamburger_close{
							color:'.$header_options['color'].';
						}
					';
				break;
			}
		}

		#SOCIAL ICONS
		foreach($htheme_social_items as $social){
			$htheme_css .= '
				.htheme_icon_social_'.$social['label'].':before{
					color:'.$htheme_social_primary_color.' !important;
				}
				.htheme_icon_social_'.$social['label'].':hover{
					background-color:'.$social['hoverColor'].' !important;
				}
				.htheme_icon_social_'.$social['label'].':hover:before{
					color:#FFF !important;
				}
			';
		}

		#CONTENT STYLE OPTIONS
		foreach($htheme_typography_style_options as $type){
			switch($type['slug']){
				case 'body':
				$htheme_css .= '
					.htheme_default_content,
					.htheme_post_slider_excerpt,
					.htheme_promo_desc,
					.htheme_image_text_content,
					.woocommerce p,
					.htheme_cart_shipping,
					.htheme_seperate_text_excerpt,
					.woocommerce table tbody,
					.woocommerce table tfoot,
					address,
					.woocommerce-Reviews .description,
					.woocommerce .order_details li,
					.htheme_sidebar_right .textwidget,
					.htheme_sidebar_left .textwidget,
					.calendar_wrap,
					.htheme_caution_yellow,
					.shipping,
					.htheme_shipping_holder,
					.vc_message_box,
					.vc_toggle_content,
					.wpb_raw_html,
					.vc_grid-filter-item,
					.vc_custom_heading p,
					.htheme_vc_row_contained .widget,
					.htheme_special_price,
					.htheme_mega_content{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						line-height:'.$type['lineHeight'].';
					}
					.htheme_signup_show_check label{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].' !important;
						'.$this->htheme_return_weight_style($type['weight']).' !important;
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
						line-height:'.$type['lineHeight'].' !important;
					}					
					[class^="htheme_icon_people_"],
					.htheme_product_nav > span{
						color:'.$this->htheme_get_accent($type['color']).' !important;
					}
					.htheme_instagram_social .htheme_instagram_social_item{
						font-family:'.$type['family'].';
					}	
					[class^="vc_cta"],
					.vc_label,
					[class^="vc_btn3"]{
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
					}
				';
				break;
				case 'h1':
				$htheme_css .= '
					h1{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}										
					.htheme_instagram_mosaic_icon svg polygon,
					.htheme_instagram_mosaic_icon svg path,
					.htheme_instagram_mosaic_icon svg rect{
						fill:' . $this->htheme_get_accent($type['color']) . ';
					}
				';
				break;
				case 'h1_sub':
				$htheme_css .= '
					.htheme_h1_sub{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
					.htheme_h1_sub .woocommerce-breadcrumb{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h2':
				$htheme_css .= '
					h2,
					.htheme_single_product_price{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}	
					.woocommerce-variation-price,
					.woocommerce-variation-price span.price ins span{
						font-family:'.$type['family'].' !important;
						color:'.$this->htheme_get_accent($type['color']).'  !important;
						'.$this->htheme_return_weight_style($type['weight']).' !important;						
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
					}
				';
				break;
				case 'h2_sub':
				$htheme_css .= '
					.htheme_h2_sub,
					.htheme_h2_sub a,
					.htheme_content_tabs_inner,
					.htheme_single_product_options_inner{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h3':
				$htheme_css .= '
					h3,
					h3 a,
					.woocommerce legend,
					.order-total{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
					.htheme_icon_launch_arrow:after{
						color:'.$this->htheme_get_accent($type['color']).' !important;
					}
					.htheme_launch_overlay{
						border-color:'.$this->htheme_get_accent($type['color']).' !important;
					}
					.htheme_default_logo_text_inner a{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}
				';
				break;
				case 'h3_sub':
				$htheme_css .= '
					.htheme_h3_sub,
					#commentform p a,
					.comment-notes{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h4':
				$htheme_css .= '
					h4,
					.htheme_cart_row .htheme_position .htheme_inner_col h1,
					.htheme_cart_row .htheme_position .htheme_inner_col h1 a,
					.htheme_position .htheme_inner_col span,
					.htheme_position .quantity .qty,
					.cart-subtotal,
					.woocommerce table thead,
					.vc_tta-title-text{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h4_sub':
				$htheme_css .= '
					.htheme_h4_sub,
					.htheme_no_data_available,
					.htheme_position .htheme_inner_col dl dt,
					.htheme_position .htheme_inner_col dl dd,
					.htheme_position .htheme_inner_col dl dd p,
					.htheme_cart_head{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						line-height:20px !important;
					}
				';
				break;
				case 'h5':
				$htheme_css .= '
					h5,
					.nav-previous .post-title,
					.nav-next .post-title,
					label,
					.htheme_review_text strong,
					.url,
					.htheme_default_content dt{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}
				';
				break;
				case 'h5_sub':
				$htheme_css .= '
					.htheme_h5_sub,
					.htheme_h5_sub a,
					.nav-previous .screen-reader-text,
					.nav-next .screen-reader-text,
					.htheme_content_tabs_content p.meta time{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h6':
				$htheme_css .= '
					h6,
					cite,
					.wp-caption-text,
					.no-comments,
					.vc_figure-caption{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'h6_sub':
				$htheme_css .= '
					.htheme_h6_sub,
					.htheme_h6_sub a{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'label':
				$htheme_css .= '
					label{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'input':
				$htheme_css .= '
					input[type=text],
					input[type=email],
					input[type=tel],
					input[type=password],
					select,
					textarea,
					.woocommerce form .country_select,
					.select2-drop{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'widget_heading':
				$htheme_css .= '
					.htheme_widget_heading,
					.htheme_sidebar_container h2,
					.htheme_sidebar_container h2 a{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'widget_content':
				$htheme_css .= '
					.htheme_widget_content,
					.htheme_sidebar_right .widget ul li,
					.htheme_sidebar_left .widget ul li,
					.htheme_sidebar_right .widget ul li a,
					.htheme_sidebar_left .widget ul li a,
					.htheme_filter_dropdown_inner ul li,
					.htheme_filter_value span,
					.price_slider_wrapper,
					.woocommerce .widget_price_filter .price_slider_amount,
					.htheme_sidebar_post_heading,
					.widget_product_search .search-field,
					.searchform input[type=text]{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'widget_sub_content':
				$htheme_css .= '
					.htheme_widget_sub_content,
					.htheme_sidebar_right .widget ul li .count,
					.htheme_sidebar_left .widget ul li .count,
					.htheme_sidebar_right .post-date,
					.htheme_sidebar_left .post-date,
					.woocommerce .woocommerce-result-count,
					.woocommerce-review-link,
					.widget_rss ul li .rss-date{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'widget_price':
				$htheme_css .= '
					.htheme_widget_price,
					.htheme_sidebar_post_heading span{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'main_product_title':
				$htheme_css .= '
					.htheme_single_heading,
					.htheme_promo_title{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].' !important;
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
					}
					.htheme_product_nav span{
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
					}
				';
				break;
				case 'main_product_price':
				$htheme_css .= '
					.htheme_single_product_price,
					.htheme_promo_price{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].' !important;
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
					}
				';
				break;
				case 'product_list_title':
				$htheme_css .= '
					.htheme_product_list_title,
					.htheme_category_count{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].' !important;
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
						text-decoration:none;
					}
					.htheme_product_list_title{
						overflow:hidden;
						height:'.$type['size'].';
					}
					.htheme_product_list_title:after{					
						height:'.$type['size'].';
					}
					.htheme_product_list_options .htheme_icon_wishlist_added{
						color:'.$this->htheme_get_accent($type['color']).' !important;
					}
				';
				break;
				case 'product_list_price':
				$htheme_css .= '
					.htheme_product_list_price{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].' !important;
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].' !important;
						text-transform:'.$type['transform'].' !important;
						letter-spacing:'.$type['spacing'].' !important;
					}
				';
				break;
				case 'slider_title':
				$htheme_css .= '
					.htheme_slide_title{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'slider_content':
				$htheme_css .= '
					.htheme_slide_content{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						line-height:'.$type['lineHeight'].';
					}
				';
				break;
				case 'link':
				$htheme_css .= '
					.htheme_sidebar_right .widget ul li a,
					.htheme_sidebar_left .widget ul li a,
					.htheme_default_content a,
					.htheme_continue_shopping,
					.woocommerce-MyAccount-navigation a,
					.woocommerce-Address-title a,
					.htheme_vc_row_contained .widget a{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}
				';
				break;
				case 'link_hover':
				$htheme_css .= '
					.htheme_sidebar_right .widget ul li a:hover,
					.htheme_sidebar_left .widget ul li a:hover,
					.htheme_default_content a:hover,
					.htheme_continue_shopping:hover,
					.woocommerce-MyAccount-navigation a:hover,
					.woocommerce-Address-title a:hover,
					.woocommerce-MyAccount-navigation .is-active a,
					.htheme_vc_row_contained .widget a:hover{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
				';
				break;
				case 'element_category':
				$htheme_css .= '
					.htheme_category_more,
					.htheme_load_more_btn{
						color:'.$this->htheme_get_accent($type['color']).';
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}
				';
				break;
				case 'element_category_hover':
				$htheme_css .= '
					.htheme_category_more:hover,
					.htheme_load_more_btn:hover{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
					}
					.htheme_load_more_btn{
						opacity: 0.5; filter: alpha(opacity=05);
					}
					.htheme_is_active_category{
						color:'.$this->htheme_get_accent($type['color']).' !important;
					}
				';
				break;
				case 'element_blog_category':
				$htheme_css .= '
					.htheme_blog_categories,
					.htheme_blog_categories a{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}					
					.htheme_single_pager,
					.htheme_single_pager a{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
					}
				';
				break;
				case 'cart_popup_heading':
				$htheme_css .= '
					.htheme_box_price,
					.htheme_box_product_heading,
					.htheme_box_heading{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}	
				';
				break;
				case 'cart_popup_sub_heading':
				$htheme_css .= '
					.htheme_box_product_sub,
					.htheme_box_qty_text{
						color:'.$this->htheme_get_accent($type['color']).' !important;
						font-family:'.$type['family'].';
						'.$this->htheme_return_weight_style($type['weight']).';
						font-size:'.$type['size'].';
						text-transform:'.$type['transform'].';
						letter-spacing:'.$type['spacing'].';
						text-decoration:none;
					}	
				';
				break;
			}
		}

		#FOOTER STYLE OPTIONS
		foreach($htheme_footer_style_options as $footer_options){
			switch($footer_options['slug']){
				case 'footer_headings':
				$htheme_css .= '
					.htheme_footer_heading,
					.htheme_footer_holder .widget_htheme_image_instagram_widget h2{
						color:'.$footer_options['color'].' !important;
						font-family:'.$footer_options['family'].' !important;
						'.$this->htheme_return_weight_style($footer_options['weight']).';
						font-size:'.$footer_options['size'].' !important;
						text-transform:'.$footer_options['transform'].' !important;
						letter-spacing:'.$footer_options['spacing'].' !important;
					}
				';
				break;
				case 'footer_content':
				$htheme_css .= '
					.htheme_footer_content p, .htheme_footer_content{
						color:'.$footer_options['color'].';
						font-family:'.$footer_options['family'].';
						'.$this->htheme_return_weight_style($footer_options['weight']).';
						font-size:'.$footer_options['size'].';
						text-transform:'.$footer_options['transform'].';
						letter-spacing:'.$footer_options['spacing'].';
					}
					.htheme_main_footer .widget ul li a, .htheme_footer_content * a,
					.htheme_footer_layout_one_social_wrap a span{
						color:'.$footer_options['linkColor'].';
						font-family:'.$footer_options['family'].';
						'.$this->htheme_return_weight_style($footer_options['weight']).';
						font-size:'.$footer_options['size'].';
						text-transform:'.$footer_options['transform'].';
						letter-spacing:'.$footer_options['spacing'].';
					}
					.htheme_main_footer .widget ul li a:hover, .htheme_footer_content * a:hover,
					.htheme_footer_layout_one_social_wrap a:hover span,
					.htheme_footer_layout_one_social [class^="htheme_icon_social_"]:hover:before{
						color:'.$footer_options['hoverColor'].' !important;
					}
				';
				break;
				case 'footer_copyright':
				$htheme_css .= '
					.htheme_sub_footer .htheme_footer_nav_wrap,
					.htheme_footer_layout_one .htheme_footer_nav_wrap{
						color:'.$footer_options['color'].';
						font-family:'.$footer_options['family'].';
						'.$this->htheme_return_weight_style($footer_options['weight']).';
						font-size:'.$footer_options['size'].';
						text-transform:'.$footer_options['transform'].';
						letter-spacing:'.$footer_options['spacing'].';
					}
					.htheme_sub_footer .htheme_footer_nav_wrap a,					
					.htheme_footer_layout_one .htheme_footer_nav_wrap a{
						color:'.$footer_options['linkColor'].';
						font-family:'.$footer_options['family'].';
						'.$this->htheme_return_weight_style($footer_options['weight']).';
						font-size:'.$footer_options['size'].';
						text-transform:'.$footer_options['transform'].';
						letter-spacing:'.$footer_options['spacing'].';
					}
					.htheme_sub_footer .htheme_footer_nav_wrap a:hover,
					.htheme_footer_layout_one .htheme_footer_nav_wrap a:hover{
						color:'.$footer_options['hoverColor'].';
					}
					.htheme_sub_footer .htheme_footer_nav_wrap a:hover:after,
					.htheme_footer_layout_one .htheme_footer_nav_wrap a:hover:after{
						color:'.$footer_options['linkColor'].';
					}
					.htheme_sub_footer .htheme_footer_social_wrap a:before,
					.htheme_footer_layout_one .htheme_footer_nav_wrap a:before{
						color:'.$footer_options['linkColor'].' !important;
					}
					.htheme_sub_footer .htheme_footer_social_wrap a:hover:before,
					.htheme_footer_layout_one .htheme_footer_nav_wrap a:hover:before{
						color:'.$footer_options['hoverColor'].' !important;
					}
				';
				break;
			}
		}

		#FOOTER HOLDER
		$htheme_css .= '
			.htheme_footer_holder,
			.htheme_footer_logo:before{
				background-color:'.$htheme_footer_primary_background.';
			}
			.htheme_footer_holder .htheme_image_instagram_widget a{
				border-color:'.$htheme_footer_primary_background.';
			}
			.htheme_sub_footer{
				background-color:'.$htheme_footer_secondary_background.';
			}
			.htheme_main_footer .widget ul li{
				border-bottom:1px solid rgba('.$this->htheme_hex_to_rgb('#FFFFFF').', 0.1);
			}
		';

		#FULLSCREEN BUTTON
		$htheme_css .= '
			.htheme_fullscreen_button{
				width:60px;
				height:60px;
				position:absolute; left:50%; margin-left:-30px; bottom:80px; border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				-webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px;
				-webkit-transition: all 0.3s ease-in-out;
				-moz-transition: all 0.3s ease-in-out;
				-o-transition: all 0.3s ease-in-out;
				transition: all 0.3s ease-in-out;
				cursor:pointer; box-sizing:border-box;
				display: inline-block;
				animation:htheme_pulse 2s infinite ;
				-ms-animation:htheme_pulse 2s infinite;
				-webkit-animation:htheme_pulse 2s infinite;
				-moz-animation:htheme_pulse 2s infinite;
				-o-animation:htheme_pulse 2s infinite;
			}
			.htheme_fullscreen_button:hover{
				-webkit-transform:scale(1.1, 1.1) !important;
				-moz-transform:scale(1.1, 1.1) !important;
				-ms-transform:scale(1.1, 1.1) !important;
				-o-transform:scale(1.1, 1.1) !important;
				transform:scale(1.1, 1.1) !important;
				background:rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0) !important;
				animation:none;
				-ms-animation:none;
				-webkit-animation:none;
				-moz-animation:none;
				-o-animation:none;
				border:1px solid  rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 1.0) !important;
			}
			@keyframes htheme_pulse {
				0% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				}
				100% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0.2);
				}
			}
			/* Firefox < 16 */
			@-moz-keyframes htheme_pulse {
				0% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				}
				100% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0.2);
				}
			}
			/* Safari, Chrome and Opera > 12.1 */
			@-webkit-keyframes htheme_pulse {
				0% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				}
				100% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0.2);
				}
			}
			/* Internet Explorer */
			@-ms-keyframes htheme_pulse {
				0% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				}
				100% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0.2);
				}
			}
			/* Opera < 12.1 */
			@-o-keyframes htheme_pulse {
				0% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0);
				}
				100% {
					border:1px solid rgba('.$this->htheme_hex_to_rgb($htheme_meta_font_color).', 0.2);
				}
			}
			.htheme_fullscreen_button:after{
				content:"\e601"; text-align:center; font-size:30px; color:'.$htheme_meta_font_color.'; height:60px; width:20px; margin:0 auto; display:table; ;line-height:60px;
			}
		';

		#META TOP SHORTCODE
		if(is_page_template( 'templates/template.home-noslider.php' ) || !is_front_page() && !is_page_template( 'templates/template.home.php' )){
			if($htheme_meta_shortcode != ''){
				$htheme_css .= '
					.htheme_top_holder{
						height: auto !important;
					}
				';
			} else if($htheme_meta_height && $htheme_meta_layout == 1){
				$htheme_css .= '
					.htheme_top_holder{
						height:'.$htheme_meta_height.'px;
					}
				';
			}
		}

		#META TOP PADDING
		if($htheme_meta_top_padding == 'no' && !is_search()){
			$htheme_css .= '
				.htheme_content_holder{
					padding-top:0 !important;
				}
			';
		} else if($htheme_meta_top_padding == 'no' && is_search()){
			$htheme_css .= '
				.htheme_content_holder{
					padding-top:125 !important;
				}
			';
		}

		#BACK TO TOP BUTTON
		if($htheme_toTop == 'false'):
			$htheme_css .= '
				.htheme_icon_backtop{
					display:none !important;
				}
			';
		endif;

		#BUTTON STYLING
		foreach($htheme_button_style_options as $button_style){
			switch($button_style['slug']){
				case 'button_primary':
					$htheme_css .= '
						.htheme_btn_style_1,
						.woocommerce #respond input#submit.alt,
						.woocommerce a.button.alt,
						.woocommerce button.button.alt,
						.woocommerce input.button.alt,
						.htheme_cart_button_dark,
						.htheme_button_container,
						.htheme_single_product_add_button,
						.woocommerce #respond input#submit,
						#commentform input#submit,
						.woocommerce #respond input#submit,
						.woocommerce a.button,
						.woocommerce button.button,
						.woocommerce input.button,
						.htheme_cart_button_dark,
						.htheme_btn_style_big{
							background:rgba('.$this->htheme_hex_to_rgb($button_style['background']).', '.$button_style['opacity'].');
							color:'.$button_style['color'].';
							font-family:'.$button_style['family'].' !important;
							'.$this->htheme_return_weight_style($button_style['weight']).';
							font-size:'.$button_style['size'].' !important;
							text-transform:'.$button_style['transform'].' !important;
							letter-spacing:'.$button_style['spacing'].' !important;
							-webkit-appearance: none;
							-webkit-border-radius:0; -moz-border-radius:0; border-radius:0;
						}
						.htheme_btn_style_1:hover,
						.htheme_cart_button_dark:hover,
						.htheme_button_container:hover,
						.htheme_single_product_add_button:hover,
						.woocommerce #respond input#submit:hover,
						#commentform input#submit:hover,
						#commentform input#submit:hover,
						.woocommerce #respond input#submit:hover,
						.woocommerce a.button:hover,
						.woocommerce button.button:hover,
						.woocommerce input.button:hover,
						.htheme_cart_button_dark:hover,
						.htheme_cart_button_light:hover,
						.htheme_btn_style_big:hover{
							background-color:'.$button_style['backgroundHover'].' !important;
							color:'.$button_style['hoverColor'].' !important;
						}
						.htheme_cart_button_light{
							color:#2B2B2B !important;
							font-family:'.$button_style['family'].' !important;
							'.$this->htheme_return_weight_style($button_style['weight']).';
							font-size:'.$button_style['size'].' !important;
							text-transform:'.$button_style['transform'].' !important;
							letter-spacing:'.$button_style['spacing'].' !important;
						}
					';
				break;
				case 'tag_category':
					$htheme_css .= '
						.htheme_sidebar_right .tagcloud a,
						.htheme_sidebar_left .tagcloud a,
						.htheme_post_tags a{
							background:rgba('.$this->htheme_hex_to_rgb($button_style['background']).', '.$button_style['opacity'].');
							color:'.$button_style['color'].' !important;
							font-family:'.$button_style['family'].' !important;
							'.$this->htheme_return_weight_style($button_style['weight']).' !important;
							font-size:'.$button_style['size'].' !important;
							text-transform:'.$button_style['transform'].' !important;
							letter-spacing:'.$button_style['spacing'].' !important;
						}
						.htheme_sidebar_right .tagcloud a:hover,
						.htheme_sidebar_left .tagcloud a:hover,
						.htheme_post_tags a:hover{
							background-color:'.$button_style['backgroundHover'].';
							'.$this->htheme_return_weight_style($button_style['weight']).' !important;
							color:'.$button_style['hoverColor'].' !important;
						}
					';
				break;
				case 'blockquote':
					$htheme_css .= '
						.htheme_default_content blockquote{
							background:rgba('.$this->htheme_hex_to_rgb($button_style['background']).', '.$button_style['opacity'].');
							color:'.$button_style['color'].';
							font-family:'.$button_style['family'].';
							'.$this->htheme_return_weight_style($button_style['weight']).';
							font-size:'.$button_style['size'].';
							text-transform:'.$button_style['transform'].';
							letter-spacing:'.$button_style['spacing'].';
						}
						.htheme_default_content blockquote:before{
							color:'.$button_style['color'].';
							font-family:'.$button_style['family'].';
							'.$this->htheme_return_weight_style($button_style['weight']).';
							font-size:'.$button_style['size'].';
							text-transform:'.$button_style['transform'].';
							letter-spacing:'.$button_style['spacing'].';
						}
						.htheme_default_content blockquote:hover{
							background-color:'.$button_style['backgroundHover'].';
							color:'.$button_style['hoverColor'].';
						}
					';
				break;
				case 'product_tag':
					$htheme_css .= '
						.htheme_product_list_percent,
						.htheme_product_list_new,
						.htheme_onsale{
							background:rgba('.$this->htheme_hex_to_rgb($button_style['background']).', '.$button_style['opacity'].');
							color:'.$button_style['color'].';
							font-family:'.$button_style['family'].';
							'.$this->htheme_return_weight_style($button_style['weight']).';
							font-size:'.$button_style['size'].';
							text-transform:'.$button_style['transform'].';
							letter-spacing:'.$button_style['spacing'].';
						}
					';
				break;
			}
		}

		foreach($htheme_typography_mega_options as $mega_options){
			switch($mega_options['slug']){
				case 'mega_heading':
					$htheme_css .= '
						.htheme_mega_title{
							color:'.$this->htheme_get_accent($mega_options['color']).';
							font-family:'.$mega_options['family'].';
							'.$this->htheme_return_weight_style($mega_options['weight']).';
							font-size:'.$mega_options['size'].';
							text-transform:'.$mega_options['transform'].';
							letter-spacing:'.$mega_options['spacing'].';
							line-height:'.$mega_options['lineHeight'].';
						}
					';
				break;
				case 'mega_title':
					$htheme_css .= '
						.htheme_mega_item_content a{
							color:'.$this->htheme_get_accent($mega_options['color']).';
							font-family:'.$mega_options['family'].';
							'.$this->htheme_return_weight_style($mega_options['weight']).';
							font-size:'.$mega_options['size'].';
							text-transform:'.$mega_options['transform'].';
							letter-spacing:'.$mega_options['spacing'].';
							line-height:'.$mega_options['lineHeight'].';
							text-decoration:none;
						}
					';
				break;
				case 'mega_sub_content':
					$htheme_css .= '
						.htheme_mega_item_content a.htheme_mega_date,
						.htheme_mega_item_content span{
							color:'.$this->htheme_get_accent($mega_options['color']).';
							font-family:'.$mega_options['family'].';
							'.$this->htheme_return_weight_style($mega_options['weight']).';
							font-size:'.$mega_options['size'].';
							text-transform:'.$mega_options['transform'].';
							letter-spacing:'.$mega_options['spacing'].';
							line-height:'.$mega_options['lineHeight'].';
							text-decoration:none;
						}
					';
				break;
			}
		}

		foreach($htheme_mega_styles as $i){
			if(isset($i['backgroundSize'])):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . '{
						background-size:'.$i['backgroundSize'].'										
					}		
				';
			endif;
			if(isset($i['underlineColor']) && $i['underlineTitle'] != 'no'):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . ' .htheme_mega_title{
						border-bottom: 1px solid '.$i['underlineColor'].';							
					}					
				';
			endif;
			if(isset($i['fontPrimary']) && $i['fontPrimary'] != ''):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . ' .htheme_mega_title{
						color:'.$i['fontPrimary'].' !important;					
					}										
				';
			endif;
			if(isset($i['fontSecondary']) && $i['fontSecondary'] != ''):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . ' .htheme_mega_item_content a,
					.htheme_mega_' . $i['id'] . ' .htheme_mega_item_content .htheme_mega_date,
					.htheme_mega_' . $i['id'] . ' .htheme_mega_item_content .htheme_mega_date span{
						color:'.$i['fontSecondary'].' !important;					
					}										
				';
			endif;
			#BORDER
			if(isset($i['borderColor']) && $i['border'] != 'no'):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . '{
						border: 1px solid '.$i['borderColor'].';							
					}					
				';
			endif;
			#SHADOW
			if(isset($i['shadowColor']) && $i['shadow'] != 'no'):
				$htheme_css .= '
					.htheme_mega_' . $i['id'] . '{
						-webkit-box-shadow: 4px 4px 10px -1px rgba('.$this->htheme_hex_to_rgb($i['shadowColor']).',0.22);
						-moz-box-shadow: 4px 4px 10px -1px rgba('.$this->htheme_hex_to_rgb($i['shadowColor']).',0.22);
						box-shadow: 4px 4px 10px -1px rgba('.$this->htheme_hex_to_rgb($i['shadowColor']).',0.22);						
					}					
				';
			endif;
		}

		#CUSTOM CSS
		$htheme_css .= $htheme_custom_css;

		return $htheme_css;

	}

	public function htheme_get_pageload_css($status){

		#VARIABLES
		$css = '';

		return $css;

	}

	#RETURN WEIGHT AND STYLE
	public function htheme_return_weight_style($weight){

		#VARIABLE
		$original = $weight;
		$w = '';
		$s = 'inherit';

		$remove_items = array("italic", "regular");

		#GET THE WEIGHT
		$w =  str_replace($remove_items, "", $weight);

		#GET THE STYLE - ONLY IF IT EXISTS
		if(strpos($original, 'italic') !== false){
			$s = 'italic';
		} else if(strpos($original, 'regular') !== false){
			$s = 'normal';
		}

		$return_weight = '';
		$return_style = '';

		#RETURN VARIABLES
		if($w){
			$return_weight = 'font-weight:'.$w.' !important;';
		}
		if($s){
			$return_style = 'font-style:' . $s . ';';
		}

		#RETURN
		return	$return_weight.$return_style;

	}

	#GET COLOR ACCENT
	public function htheme_get_accent($accent){

		$htheme_accents = $GLOBALS['htheme_global_object']['settings']['styling']['accents'];

		foreach($htheme_accents as $color){
			if($color['label'] == $accent){
				return $color['color'];
			}
		}

	}

	#HEX TO RGB
	public function htheme_hex_to_rgb($hex){

		#GET HEX VALUE AND REMOVE THE #
		$hex_value = str_replace('#', '', $hex);

		#IF HEX VALUE LENGTH IS 3, ELSE
		if(strlen($hex_value) == 3) {
			$r = hexdec(substr($hex_value,0,1).substr($hex_value,0,1));
			$g = hexdec(substr($hex_value,1,1).substr($hex_value,1,1));
			$b = hexdec(substr($hex_value,2,1).substr($hex_value,2,1));
		} else {
			$r = hexdec(substr($hex_value,0,2));
			$g = hexdec(substr($hex_value,2,2));
			$b = hexdec(substr($hex_value,4,2));
		}

		#RGB STRING
		$rgb_string = $r . ',' . $g . ',' . $b;

		#RETURN RGB STRING
		return $rgb_string;

	}

	#GET GOOGLE FONTS
	public function htheme_google_fonts(){

		#VARIABLES
		$htheme_fonts_array = array();
		$exclude_array = ['Arial', 'Verdana'];
		$typography_fonts = $GLOBALS['htheme_global_object']['settings']['typography']['fonts'];
		$mega_fonts = $GLOBALS['htheme_global_object']['settings']['megamenu']['fonts'];
		$header_fonts = $GLOBALS['htheme_global_object']['settings']['header']['stylingOptions'];
		$footer_fonts = $GLOBALS['htheme_global_object']['settings']['footer']['stylingOptions'];
		$button_fonts = $GLOBALS['htheme_global_object']['settings']['styling']['buttons'];

		#TYPOGRAPHY PUSH
		foreach($typography_fonts as $font){
			if(!in_array($font['family'], $exclude_array)){
				array_push($htheme_fonts_array, $font['family'].':'.$font['weight']);
			}
		}

		#MEGA PUSH
		foreach($mega_fonts as $font){
			if(!in_array($font['family'], $exclude_array)){
				array_push($htheme_fonts_array, $font['family'].':'.$font['weight']);
			}
		}

		#HEADER PUSH
		foreach($header_fonts as $font){
			if(!in_array($font['family'], $exclude_array)){
				array_push($htheme_fonts_array, $font['family'].':'.$font['weight']);
			}
		}

		#FOOTER PUSH
		foreach($footer_fonts as $font){
			if(!in_array($font['family'], $exclude_array)){
				array_push($htheme_fonts_array, $font['family'].':'.$font['weight']);
			}
		}

		#BUTTON PUSH
		foreach($button_fonts as $font){
			if(!in_array($font['family'], $exclude_array)){
				array_push($htheme_fonts_array, $font['family'].':'.$font['weight']);
			}
		}

		return $htheme_fonts_array;

	}

}