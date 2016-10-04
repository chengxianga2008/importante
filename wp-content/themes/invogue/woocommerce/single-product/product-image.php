<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;


#VARIABLES
$image_src_array = array();
$variations = '';
if($product->product_type == 'variable'){
	$variations = $product->get_available_variations();
}

#BUILD IMAGE ARRAY
$image_src = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'htheme-image-900' );
$image_full = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full' );
$htheme_meta_superzoom = get_post_meta( $post->ID, 'htheme_meta_superzoom', true );

#PUSH FIRST IMAGE INTO ARRAY
array_push($image_src_array, array('image'=> $image_src[0], 'type' => 'normal', 'variation' => '', 'full' => $image_full[0]));

#PUSH GALLERY IMAGES INTO ARRAY
foreach($product->get_gallery_attachment_ids() as $image_id){
	$img = wp_get_attachment_image_src( $image_id, 'htheme-image-900' );
	$img_full = wp_get_attachment_image_src( $image_id, 'full' );
	array_push($image_src_array, array('image'=> $img[0], 'type' => 'normal', 'variation' => '', 'full' => $img_full[0]));
}

#PUSH VARIATION IMAGES
if(isset($variations) && $variations != ''){
	foreach($variations as $var){
		array_push($image_src_array, array('image'=> $var['image_link'], 'type' => 'variation', 'variation' => $var['variation_id'], 'full' => $var['image_link']));
	}
}

#HEIGHT
$htheme_height_change = '';
if(!$image_src_array[0]['image']){
	$htheme_height_change = 'htheme_height_change';
}

?>

<div class="htheme_single_product_image_container htheme_gallery_container <?php echo esc_attr($htheme_height_change); ?>">

	<?php if($image_src_array[0]['image']){ ?>
		<div class="htheme_single_product_thumbs">
			<?php

			#THUMBNAILS
			$htheme_thumb = 0;
			$htmeme_small_thumb = '';
			if(count($image_src_array) > 6){
				$htmeme_small_thumb = 'htmeme_small_thumb';
			}
			foreach($image_src_array as $img){
				$image = '';
				$variation_style = '';
				if($img['image']){
					$image = 'style="background-image:url('.esc_url($img['image']).');"';
				}
				if($img['type'] == 'variation'){
					$variation_style = 'htheme_hide_element';
				}
				if($img['image']){
					$htheme_thumb++;
				}
				?>
				<div class="htheme_single_product_thumb_item htheme_gallery_item <?php echo esc_attr($variation_style); ?> <?php echo esc_attr($htmeme_small_thumb); ?>" <?php if($img['variation']){ echo 'data-variation-img-link="'.$img['variation'].'"'; } ?> data-id="<?php echo esc_attr($htheme_thumb); ?>" data-gallery-src="<?php echo esc_url($img['image']); ?>" data-full-src="<?php echo esc_url($img['full']); ?>" <?php echo $image; ?>></div>
				<?php

			}

			?>
		</div>

		<div class="htheme_single_product_featured">
			<?php
				$htheme_meta_video_url = get_post_meta( $post->ID, 'htheme_meta_video_url', true );
				$htheme_shift_product_icon = '';
				if($htheme_meta_video_url != ''){
					$htheme_shift_product_icon = 'htheme_shift_product_icon';
			?>
			<div class="htheme_icon_product_video" data-tooltip="true" data-tooltip-text="<?php esc_html_e('Play Video', 'invogue'); ?>" data-video-url="<?php echo esc_url($htheme_meta_video_url); ?>">
				<?php echo wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_playbutton.svg'); ?>
			</div>
			<?php } ?>
			<?php if($htheme_meta_superzoom): ?>
			<div class="htheme_icon_super_zoom <?php echo esc_attr($htheme_shift_product_icon); ?>" data-tooltip="true" data-tooltip-text="<?php esc_html_e('Super Zoom', 'invogue'); ?>" data-src="">
				<?php echo wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_superzoom.svg'); ?>
			</div>
			<?php endif; ?>
			<div class="htheme_icon_single_product_featured_zoom htheme_activate_zoom" data-tooltip="true" data-tooltip-text="<?php esc_html_e('View Gallery', 'invogue'); ?>" data-zoom-id="1"></div>
			<?php
			#MAIN IMAGE
			$htheme_main = 0;
			foreach($image_src_array as $img){
				$image = '';
				if($img['image']){
					$image = 'style="background-image:url('.esc_url($img['image']).');"';
					$htheme_no_img = '';
					$htheme_main++;
				?>
					<div class="htheme_single_product_featured_item" data-gallery-id="<?php echo esc_attr($htheme_main); ?>" <?php echo $image; ?>></div>
				<?php

				}
			}
			?>
		</div>
	<?php } ?>

</div>

