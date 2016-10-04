<?php
get_header();

$htheme_meta_sidebar_heading = get_post_meta($post->ID, 'htheme_meta_sidebar_heading', true);
$htheme_meta_brand = get_post_meta($post->ID, 'htheme_meta_brand', true);

?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- SET HEADER IF NOT SELECTED -->
	<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

	<?php $htheme_meta_image_gallery = get_post_meta($post->ID, 'htheme_meta_image_gallery', true); ?>

	<!-- ROW -->
	<div class="htheme_row">
		<div class="htheme_container">
			<div class="htheme_inner_col htheme_gallery_container">
				<?php
				if($htheme_meta_image_gallery){
					$count = 1;
					$img_ids = explode(',', $htheme_meta_image_gallery);
					foreach($img_ids as $img){
						?>
						<div class="htheme_col_3 htheme_look_book_image htheme_gallery_item" data-id="<?php echo esc_attr($count); ?>" data-gallery-src="<?php echo esc_url($img); ?>" style="background-image:url(<?php echo esc_url($img); ?>)" data-hover-type="hover_look_img">
							<div class="htheme_icon_look_book_inner htheme_activate_zoom" data-zoom-id="<?php echo esc_attr($count); ?>"></div>
						</div>
						<?php
						$count++;
					}
				}
				?>
			</div>
		</div>
	</div>
	<!-- ROW -->

	<?php get_template_part( 'htheme/templateparts/content/the', 'content' ); ?>

	<!-- SOCIAL -->
		<?php
			#GET TEMPLATE PART - SOCIAL
			get_template_part( 'htheme/templateparts/content/post', 'social' );
		?>
	<!-- SOCIAL -->

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
