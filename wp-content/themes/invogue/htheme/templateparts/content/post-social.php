<?php

#POST VARIABLES
$post_type = $post->post_type;
$htheme_social_array = [];
$social_col = 'htheme_col_4';
$htheme_row_style = '';

#POST VARIABLES
$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full' );
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
	<?php foreach($htheme_social_array[0] as $social){ if($social['status'] == 'true'){?>
	<div class="<?php echo esc_attr($social_col); ?>">
		<div class="htheme_inner_col htheme_social_trigger" data-hover-type="hover_social" data-color="blue">
			<div class="htheme_icon_social_row_<?php echo esc_attr($social['label']); ?> st_<?php echo esc_attr($social['label']); ?>_large htheme_social_icon"></div>
			<div class="htheme_social_text"><?php echo esc_html($social['label']); ?></div>
		</div>
	</div>
	<?php }} ?>
</div>
<!-- ROW -->
<?php } else { ?>
	<div class="htheme_grey_line_separator"></div>
<?php } ?>
