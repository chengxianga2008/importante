<?php

#POST VARIABLES
$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );

?>
<!-- ROW -->
<div class="htheme_row">
	<div class="htheme_container">
		<div class="htheme_inner_col">
			<div <?php post_class(); ?>>
				<?php if($post_image[0]){ ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_post_image" style="background-image:url(<?php echo esc_url($post_image[0]); ?>)"></a>
				<?php } ?>
				<div class="htheme_post_content">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_post_heading"><h2><?php esc_html(the_title()); ?></h2></a>
					<span class="htheme_post_sub htheme_h2_sub">
						<?php the_time(get_option( 'date_format' )); ?>
					</span>
					<div class="htheme_post_excerpt htheme_default_content">
						<?php the_excerpt(); ?>
					</div>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_btn_style_big"><?php esc_html_e('View Now', 'invogue'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ROW -->