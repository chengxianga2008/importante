<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<?php
	$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $product->id ), 'small' );
	?>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" class="htheme_sidebar_post_item">
		<div class="htmeme_sidebar_post_image" style="background-image:url(<?php echo esc_url($image[0]); ?>);"></div>
		<div class="htheme_sidebar_post_heading">
			<?php echo esc_html($product->get_title()); ?>
			<span>
			<?php if($product->product_type == 'variable'){ ?>
				<?php echo esc_html(get_woocommerce_currency_symbol(get_option('woocommerce_currency')) . $product->min_variation_price); ?>
			<?php } else { ?>
				<?php echo $product->get_price_html(); ?>
			<?php } ?>
			</span>
		</div>
	</a>
</li>
