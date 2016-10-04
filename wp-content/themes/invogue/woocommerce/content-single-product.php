<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- ROW -->
	<div class="htheme_row">
		<div class="htheme_container">
			<!-- NOTICES -->
			<div class="htheme_inner_col">
				<?php
				/**
				 * woocommerce_before_single_product hook.
				 *
				 * @hooked wc_print_notices - 10
				 */
				do_action( 'woocommerce_before_single_product' );
				?>
			</div>
			<!-- SINGLE PRODUCT -->
			<div class="htheme_single_product_holder">
				<div class="htheme_inner_col">
					<!-- IMAGES -->
					<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>

					<!-- SUMMARY -->
					<?php
						/**
						 * woocommerce_single_product_summary hook.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
			<!-- SINGLE PRODUCT -->
		</div>
	</div>
	<!-- ROW -->

	<?php
	$htheme_product_next_prev = $GLOBALS['htheme_global_object']['settings']['woocommerce']['nextPrev'];

	if($htheme_product_next_prev != 'false'){

		$prev_post = get_previous_post();
		if (!empty( $prev_post )): ?>
			<?php
			#GET IMAGE
			$htheme_prev_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $prev_post->ID ), 'htheme-image-400' );
			?>
			<a href="<?php echo $prev_post->guid ?>" class="htheme_product_nav htheme_product_nav_prev">
				<span><?php //echo $prev_post->post_title ?><?php esc_html_e('Previous', 'invogue'); ?></span>
				<div class="htheme_product_nav_content">
					<div class="htheme_product_nav_image" style="background-image:url(<?php echo esc_url($htheme_prev_image[0]); ?>);">
						<div class="htheme_product_nav_overlay"></div>
						<span><?php echo esc_html($prev_post->post_title); ?></span>
					</div>
				</div>
			</a>
		<?php endif ?>

		<?php
		$next_post = get_next_post();
		if (!empty( $next_post )): ?>
			<?php
			#GET IMAGE
			$htheme_next_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $next_post->ID ), 'htheme-image-400' );
			?>
			<a href="<?php echo $next_post->guid ?>" class="htheme_product_nav htheme_product_nav_next">
				<span><?php //echo $next_post->post_title ?><?php esc_html_e('Next', 'invogue'); ?></span>
				<div class="htheme_product_nav_content">
					<div class="htheme_product_nav_image" style="background-image:url(<?php echo esc_url($htheme_next_image[0]); ?>);">
						<div class="htheme_product_nav_overlay"></div>
						<span><?php echo esc_html($next_post->post_title); ?></span>
					</div>
				</div>
			</a>
		<?php endif ?>

	<?php } ?>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php esc_url(the_permalink()); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
