<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - The template for displaying the header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<!-- META -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- OG META - FACEBOOK -->
	<?php get_template_part( 'htheme/templateparts/header/header', 'facebook' ); ?>
	<!-- GET TEMPLATE PART - FAV ICON -->
	<?php get_template_part( 'htheme/templateparts/bits/fav', 'icon' ); ?>
	<!-- LINK -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- WP_HEAD -->
	<?php wp_head(); ?>
</head>
<?php

	#GLOBALS
	global $post, $woocommerce, $product;
	setup_postdata( $post );

	#IS ADMIN BAR ACTIVE
	$htheme_margin_top = 0;
	if(is_admin_bar_showing()){
		$htheme_margin_top = '32px';
	}

?>
<body <?php body_class(); ?>>
<?php
	#GET TEMPLATE PART - NAVIGATION
	get_template_part( 'htheme/templateparts/bits/popup', 'overlay' );
?>

<?php

	#GET PAGE META VARAIBLES
	if ( class_exists( 'WooCommerce' ) ){
		if(is_shop() || is_product_category() || is_product_tag()){
			$post = get_post(get_option('woocommerce_shop_page_id'));
		}
	}

	$htheme_meta_layout = 3;
	$htheme_meta_fullscreen = false;

	if(isset($post)){
		$htheme_meta_layout = get_post_meta( $post->ID, 'htheme_meta_layout', true );
		$htheme_meta_fullscreen = get_post_meta( $post->ID, 'htheme_meta_fullscreen', true );
	}

	$htheme_is_top_image = true;

	#DO CHECK
	if(is_front_page() || is_page_template( 'templates/template.home.php' ) || (is_front_page() && is_page_template( 'templates/template.home-noslider.php' ))){
		$htheme_front_top_style = '';
	} else if(isset($post) && ($post->post_type == 'post' || is_search() || is_archive())){
		$htheme_front_top_style = 'htheme_content_top';
	} else if(isset($post) && $post->post_type == 'people'){
		$htheme_front_top_style = '';
	} else {
		if($htheme_meta_layout == 1){
			$htheme_front_top_style = '';
			if($htheme_meta_fullscreen){
				$htheme_front_top_style = 'htheme_is_fullscreen';
			}
		} else if($htheme_meta_layout == 2){
			$htheme_front_top_style = 'htheme_content_top_small';
		} else if($htheme_meta_layout == 3){
			$htheme_front_top_style = 'htheme_content_top';
			$htheme_is_top_image = false;
		} else {
			$htheme_front_top_style = 'htheme_content_top';
			$htheme_is_top_image = false;
		}
	}

?>
<!-- TOP HOLDER -->
<div class="htheme_top_holder <?php echo esc_attr($htheme_front_top_style); ?>">

<?php

	#GET TEMPLATE PART - NAVIGATION
	get_template_part( 'htheme/templateparts/header/top', 'navigation' );
	#GET TEMPLATE PART - SLIDER
	if(is_page_template( 'templates/template.home-noslider.php' )){
		get_template_part( 'htheme/templateparts/header/top', 'content-image' );
	} else if(is_front_page() || is_page_template( 'templates/template.home.php' )){
		get_template_part( 'htheme/templateparts/header/top', 'home-slider' );
	} else if(isset($post) && ($post->post_type == 'post' || is_search() || is_archive() || is_404())){
		#NONE
	} else if(isset($post) && ($post->post_type) == 'people'){
		get_template_part( 'htheme/templateparts/header/top', 'people' );
	} else if(isset($post) && ($htheme_is_top_image)) {
		get_template_part( 'htheme/templateparts/header/top', 'content-image' );
	}

?>

</div>
<!-- TOP HOLDER -->
<!-- LOADER -->
<div class="htheme_page_loader">
	<div class="htheme_spinner">
		<div class="htheme_double_bounce1"></div><div class="htheme_double_bounce2"></div>
	</div>
</div>
<!-- LOADER -->
