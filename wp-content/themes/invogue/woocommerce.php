<?php get_header(); ?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- IF SINGLE OR ARCHIVE :: START -->
	<?php
		if(is_product()){ #SINGLE PRODUCT
			?>
				<?php woocommerce_content(); ?>
			<?php
		} else if(is_shop() || is_product_category() || is_product_tag()){
			?>
				<?php wc_get_template( 'archive-product.php' ); ?>
			<?php
		} else {
			?>
				<!-- OTHER -->
			<?php
		}
	?>
	<!-- IF SINGLE OR ARCHIVE :: END -->

</div>
<!-- CONTENT HOLDER -->

<!-- GET FOOTER -->
<?php get_footer(); ?>
