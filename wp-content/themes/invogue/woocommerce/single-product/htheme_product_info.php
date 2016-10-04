<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<!-- ROW -->
<div class="htheme_row htheme_single_product_options htheme_no_padding htheme_row_margin">
	<div class="htheme_container">
		<div class="htheme_inner_col">
			<div class="htheme_single_product_options_inner">
				<?php if($product->get_categories()){ ?>
					<span><?php esc_html_e('Category:', 'woocommerce'); ?> <?php echo $product->get_categories( ', ', '' . _n( '', '', -1, 'woocommerce' ) . ' ', '' ); ?> </span>
				<?php } ?>
				<?php if($product->get_sku()){ ?>
					<span><?php esc_html_e('Product SKU:', 'woocommerce'); ?> <a> <?php echo esc_html($product->get_sku()); ?> </a> </span>
				<?php } ?>
				<?php if($product->get_tags()){ ?>
					<span><?php esc_html_e('Tags:', 'woocommerce'); ?> <?php echo $product->get_tags( ', ', '' . _n( '', '', -1, 'woocommerce' ) . ' ', '' ); ?> </span>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- ROW -->