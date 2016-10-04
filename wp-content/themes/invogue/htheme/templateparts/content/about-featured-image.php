<?php
#POST VARIABLES
$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );
?>
<?php if($post_image[0]): ?>
<!-- ROW -->
<div class="htheme_row">
	<div class="htheme_container">
		<div class="htheme_inner_col">
			<div class="htheme_pager_featured_image" style="background-image:url(<?php echo esc_url($post_image[0]); ?>)">

			</div>
		</div>
	</div>
</div>
<!-- ROW -->
<?php endif; ?>