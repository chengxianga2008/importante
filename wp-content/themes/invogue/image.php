<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - The template for displaying image attachments
 */

get_header(); ?>

<!-- ROW -->
<div class="htheme_row">
	<div class="htheme_container">
		<div class="htheme_inner_col htheme_default_content">
			<img src="<?php echo esc_url($post->guid); ?>">
		</div>
	</div>
</div>
<!-- ROW -->

<?php get_footer(); ?>
