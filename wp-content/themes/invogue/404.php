<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - The template for displaying the 404 page (not found)
 */

#VARAIBLES
$title = $GLOBALS['htheme_global_object']['settings']['general']['page_404_title'];
$sub = $GLOBALS['htheme_global_object']['settings']['general']['page_404_sub'];
$desc = $GLOBALS['htheme_global_object']['settings']['general']['page_404_description'];
$text = $GLOBALS['htheme_global_object']['settings']['general']['page_404_button_text'];
$url = $GLOBALS['htheme_global_object']['settings']['general']['page_404_button_url'];

get_header(); ?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- ROW -->
	<div class="htheme_row htheme_404">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<div class="htheme_seperate_text_holder">
					<?php if($title){ ?>
					<h1 class="htheme_image_seperate">
						<?php echo esc_html($title); ?>
					</h1>
					<?php } ?>
					<?php if($sub){ ?>
					<h3 class="htheme_seperate_text_title">
						<?php echo esc_html($sub); ?>
					</h3>
					<?php } ?>
					<?php if($desc){ ?>
					<div class="htheme_seperate_text_excerpt">
						<?php echo esc_html($desc); ?>
					</div>
					<?php } ?>
					<?php if($text){ ?>
					<a href="<?php if($url){ echo esc_url($url); } else { echo esc_url(home_url()); } ?>" class="htheme_btn_style_1"><?php if($text){ echo esc_html($text); } else { echo esc_html('Back to home'); } ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
