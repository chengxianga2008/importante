<?php

#POST VARIABLES
$post_type = $post->post_type;
$htheme_social_array = [];
$social_col = 'htheme_col_4';
$htheme_row_style = '';
$htheme_facebook_id = $GLOBALS['htheme_global_object']['settings']['sharing']['facebookId'];

#POST VARIABLES
$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );
if(class_exists( 'WooCommerce' ) && is_product() ){
	$htheme_show_social = $GLOBALS['htheme_global_object']['settings']['woocommerce']['socialIcons'];
} else {
	$htheme_show_social = $GLOBALS['htheme_global_object']['settings']['blog']['socialIcons'];
}
#GET OBJECT
foreach($GLOBALS['htheme_global_object']['settings']['sharing']['shares'] as $social){
	if($social['postType'] == $post_type){
		$htheme_social_array[] = $social['socialItems'];
	}
}

#SOCIAL ITEMS ACTIVE
$item_count = 0;

if($htheme_social_array){
	foreach($htheme_social_array[0] as $social){
		if($social['status'] == 'true'){
			$item_count++;
		}
	}
}

switch($item_count){
	case 5:
		$social_col = 'htheme_columns_5_max';
		break;
	case 4:
		$social_col = 'htheme_col_3';
		break;
	case 3:
		$social_col = 'htheme_col_4';
		break;
	case 2:
		$social_col = 'htheme_col_6';
		break;
	case 1:
		$social_col = 'htheme_col_12';
		break;
}

#IF SPECIFIC POST TYPE
if($post_type == 'product'){
	//$htheme_row_style = 'htheme_row_margin_bottom';
}

?>
<?php if($item_count != 0 && $htheme_show_social !== 'false'){ ?>
<!-- ROW -->
<div class="htheme_row htheme_social_row htheme_no_padding <?php echo esc_attr($htheme_row_style); ?>">
	<?php
	foreach($htheme_social_array[0] as $social){
		if($social['status'] == 'true'){
	?>
		<?php
			switch($social['label']){
				case 'facebook':
					if($htheme_facebook_id != ''){
						$htheme_random = rand(5, 150000);
						?>
						<a class="<?php echo esc_attr($social_col); ?>" id="htheme_icon_<?php echo esc_attr($htheme_random); ?>">
							<div class="htheme_inner_col" data-hover-type="hover_social" data-color="blue">
								<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> htheme_social_icon"></div>
								<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
							</div>
						</a>
						<script>
							document.getElementById('htheme_icon_<?php echo esc_attr($htheme_random); ?>').onclick = function() {
								FB.ui({
									method: 'share',
									mobile_iframe: true,
									href: '<?php echo get_permalink($post->ID); ?>'
								}, function(response){});
							}
						</script>
						<?php
					} else {
						?>
						<div class="<?php echo esc_attr($social_col); ?>">
							<div class="htheme_inner_col" data-hover-type="hover_social" data-color="blue">
								<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> st_<?php echo esc_attr($social['label']); ?>_large htheme_social_icon"></div>
								<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
							</div>
						</div>
						<?php
					}
				break;
				case 'twitter':
					?>
					<a href="https://twitter.com/intent/tweet?text=<?php echo esc_url($post->post_title); ?>&url=&hashtags=&via=&related=&in-reply-to=" class="<?php echo esc_attr($social_col); ?>">
						<div class="htheme_inner_col" data-hover-type="hover_social" data-color="blue">
							<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> htheme_social_icon"></div>
							<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
						</div>
					</a>
					<?php
				break;
				case 'googleplus':
					?>
					<a class="<?php echo esc_attr($social_col); ?>" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink($post->ID)); ?>&image=<?php echo esc_url($post_image[0]); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<div class="htheme_inner_col" data-hover-type="hover_social" data-color="blue">
							<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> htheme_social_icon"></div>
							<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
						</div>
					</a>
					<?php
				break;
				case 'pinterest':
					?>
					<div class="<?php echo esc_attr($social_col); ?>">
						<a class="htheme_inner_col" data-hover-type="hover_social" data-color="blue" data-pin-custom="true" href="https://www.pinterest.com/pin/create/button/">
							<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> htheme_social_icon"></div>
							<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
						</a>
					</div>
					<?php
				break;
				case 'tumblr':
					?>
					<a href="http://www.tumblr.com/share?v=3&source=<?php echo urlencode($post_image[0]); ?>&u=<?php echo esc_url(get_permalink($post->ID)); ?>&t=<?php echo esc_url($post->post_title); ?>&image=<?php echo esc_url($post_image[0]); ?>" target="_blank" class="<?php echo esc_attr($social_col); ?>">
						<div class="htheme_inner_col" data-hover-type="hover_social" data-color="blue">
							<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> htheme_social_icon"></div>
							<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
						</div>
					</a>
					<?php
				break;
			}
		?>

	<?php
		}
	}
	?>
</div>
<!-- ROW -->
<?php } else { ?>
	<div class="htheme_grey_line_separator"></div>
<?php } ?>
