<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<!-- SET HEADER IF ON IS NOT SELECTED -->
<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

<!-- ALTER QUERY -->
<?php

#CHECK SIDEBAR
$sidebar = $GLOBALS['htheme_global_object']['settings']['woocommerce']['shopLayout'];
$col_layout = '9';

if($sidebar == 'no_sidebar'){
	$col_layout = '12';
}

?>
<!-- ROW -->
<div class="htheme_row htheme_padding_bottom">
	<div class="htheme_container htheme_with_sidebar">
		<?php if($col_layout != '12'){ ?>
		<div class="htheme_col_3">
			<div class="htheme_inner_col">
				<div class="htheme_sidebar_left">
					<?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
					?>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="htheme_col_<?php echo esc_attr($col_layout); ?>">

			<?php if($col_layout == '12'){ ?>
			<!-- PRODUCT FILTER -->
			<div class="htheme_inner_col">
				<div class="htheme_filter_holder">
					<div class="htheme_filter_left">
						<!--<div class="htheme_icon_filter_block" data-tooltip="true" data-tooltip-text="Column layout"></div>
						<div class="htheme_icon_filter_list" data-tooltip="true" data-tooltip-text="Row layout"></div>-->
						<?php
						/**
						 * woocommerce_before_shop_loop hook.
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
							do_action( 'woocommerce_before_shop_loop' );
						?>
					</div>
					<div class="htheme_filter_right">
						<?php
							do_action('htheme_get_attribute_filter');
						?>
					</div>
				</div>
			</div>
			<!-- PRODUCT FILTER -->
			<?php } ?>

			<!-- PRODUCT LIST -->
			<div class="htheme_product_list" data-type="htheme_contained_loader"> <!-- htheme_contained_loader, htheme_contained_carousel, htheme_full_carousel -->
				<div class="htheme_product_list_inner">
					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

					<!--<div class="htheme_inner_col">

						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

							<h1 class="page-title"><?php esc_html(woocommerce_page_title()); ?></h1>

						<?php endif; ?>

					</div>-->

					<?php if ( have_posts() ) : ?>

						<?php if($col_layout != '12'){ ?>
							<!-- PRODUCT FILTER -->
							<div class="htheme_inner_col">
								<div class="htheme_filter_holder">
									<div class="htheme_filter_left">
										<!--<div class="htheme_icon_filter_block" data-tooltip="true" data-tooltip-text="Column layout"></div>
										<div class="htheme_icon_filter_list" data-tooltip="true" data-tooltip-text="Row layout"></div>-->
										<?php
										/**
										 * woocommerce_before_shop_loop hook.
										 *
										 * @hooked woocommerce_result_count - 20
										 * @hooked woocommerce_catalog_ordering - 30
										 */
										do_action( 'woocommerce_before_shop_loop' );
										?>
									</div>
									<div class="htheme_filter_right"></div>
								</div>
							</div>
							<!-- PRODUCT FILTER -->
						<?php } ?>
						<?php woocommerce_product_loop_start(); ?>

							<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

						<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			</div>
			<!-- PRODUCT LIST -->
		</div>
	</div>
</div>
<!-- ROW -->

<?php
/**
 * woocommerce_archive_description hook.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action( 'woocommerce_archive_description' );
?>
