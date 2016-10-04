<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<!-- ROW -->
	<div class="htheme_row htheme_padding_top">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<div class="htheme_content_tab_holder">
					<div class="htheme_content_tabs">
						<div class="htheme_content_tabs_inner">
							<?php $count_tabs = 1; ?>
							<?php foreach ( $tabs as $key => $tab ) : ?>
								<div class="htheme_content_tabs_item" data-id="<?php echo esc_attr($count_tabs); ?>">
									<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
								</div>
								<?php $count_tabs++; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="htheme_content_tabs_content">
						<?php $count_content = 1; ?>
						<?php foreach ( $tabs as $key => $tab ) : ?>
							<div class="htheme_content_tabs_content_item" data-id="<?php echo esc_attr($count_content); ?>">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
							</div>
							<?php $count_content++; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->

<?php endif; ?>
