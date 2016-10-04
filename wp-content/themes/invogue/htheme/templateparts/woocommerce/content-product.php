<!-- ITEM -->
<?php

	#GLOBALS
	global $product, $post;
	setup_postdata( $post );

	#FEATURED IMAGE
	$image = wp_get_attachment_image_src ( get_post_thumbnail_id(), 'full' );

	#VARIABLES
	$price = get_post_meta( $post->ID, '_regular_price', true );
	$sale_price = get_post_meta( $post->ID, '_sale_price', true );

	#DATE
	$now = time(); // or your date as well
	$your_date = strtotime($post->post_date);
	$datediff = $now - $your_date;
	$days = floor($datediff/(60*60*24));

?>
<div class="htheme_col_3 htheme_product_list_item" data-hover-type="hover_product_list">
	<div class="htheme_inner_col" style="background-image:url(<?php echo esc_url($image[0]); ?>)">
		<?php

			#IF PRODUCT IS OLDER THAN 20 DAYS
			if($days <= 20){
				echo '<div class="htheme_product_list_new">'._e('NEW', 'invogue').'</div>';
			}

			#IF PRODUCT ON SALE SHOW TAG
			if($product->is_on_sale()){
				echo '<div class="htheme_product_list_percent">-' . round((($price - $sale_price ) / $price ) * 100) . '%</div>';
			}

		?>
		<div class="htheme_product_list_button" data-hover-type="hover_product_list_box">
			<div class="htheme_product_list_price">
				<?php
					$symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));
					if($sale_price != ''){
						echo $symbol . ' ' . $sale_price;
					} else {
						echo $symbol . ' ' . $price;
					}
				?>
			</div>
			<div class="htheme_product_list_options">
				<div class="htheme_icon_list_product_add" data-tooltip="true" data-tooltip-text="<?php esc_html_e('Add to cart', 'invogue'); ?>"></div>
				<div class="htheme_icon_list_product_preview" data-tooltip="true" data-tooltip-text="<?php esc_html_e('Preview', 'invogue'); ?>"></div>
				<div class="htheme_icon_list_product_wishlist" data-tooltip="true" data-tooltip-text="<?php esc_html_e('Add to wishlist', 'invogue'); ?>"></div>
			</div>
			<div class="htheme_product_list_title">
				<?php esc_attr(the_title()); ?>
			</div>
			<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="htheme_product_list_read">
				<?php esc_html_e('View Product', 'invogue'); ?>
			</a>
		</div>
	</div>
</div>
<!-- ITEM -->