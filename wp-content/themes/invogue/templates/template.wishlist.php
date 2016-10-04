<?php
/*
Template Name: inVogue - Wishlist Template
*/

get_header(); ?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- SET HEADER IF ON IS NOT SELECTED -->
	<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

	<!-- ROW -->
	<div class="htheme_row woocommerce">
		<div class="htheme_container">
			<div class="htheme_inner_col">

				<?php if(is_user_logged_in() && class_exists( 'WooCommerce' )){ ?>

					<?php $htheme_woo->htheme_show_wishlist(); ?>

				<?php } ?>

			</div>
		</div>
	</div>
	<!-- ROW -->

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
