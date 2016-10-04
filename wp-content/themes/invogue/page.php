<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - The template for displaying pages
 */

get_header(); ?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- SET HEADER IF ON IS NOT SELECTED -->
	<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

	<?php if(class_exists( 'WooCommerce' )){ ?>
		<?php if(is_woocommerce() || is_cart() || is_checkout() || is_account_page()){ ?>
		<!-- ROW -->
		<div class="htheme_row">
			<div class="htheme_container">
				<div class="htheme_inner_col">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<!-- ROW -->
		<?php } else { ?>
			<?php get_template_part( 'htheme/templateparts/content/the', 'content' ); ?>
		<?php } ?>
	<?php } else { ?>
		<?php get_template_part( 'htheme/templateparts/content/the', 'content' ); ?>
	<?php } ?>
    
    <!-- COMMENTS -->
	<?php if ( comments_open() || get_comments_number() ) : ?>
        <!-- GREY LINE -->
        <div class="htheme_row_margin_bottom">
			<div class="htheme_container">
				<div class="htheme_inner_col">
            		<div class="htheme_row htheme_no_padding">
                		<div class="htheme_grey_line_separator"></div>
					</div>
				</div>
            </div>
        </div>
        <!-- GREY LINE -->
        <!-- ROW -->
        <div class="htheme_row htheme_padding_bottom">
			<div class="htheme_container">
				<div class="htheme_inner_col">
					<?php
						comments_template();
					?>
				</div>
			</div>
        </div>
        <!-- ROW -->
    <?php endif; ?>
    <!-- COMMENTS -->

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
