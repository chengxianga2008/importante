<?php
	#META
	$color_primary = '';
	$color_secondary = '';
	$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full' );
	$htheme_meta_type_background_image = get_post_meta($post->ID, 'htheme_meta_image', true);
	$htheme_meta_type_image_signature = get_post_meta($post->ID, 'htheme_meta_type_image_signature', true);
	$htheme_meta_type_position = get_post_meta($post->ID, 'htheme_meta_type_position', true);

	$htheme_meta_type_primary_color = get_post_meta($post->ID, 'htheme_meta_type_primary_color', true);
	if($htheme_meta_type_primary_color):
		$color_primary = $htheme_meta_type_primary_color;
	endif;
	$htheme_meta_type_secondary_color = get_post_meta($post->ID, 'htheme_meta_type_secondary_color', true);
	if($htheme_meta_type_secondary_color):
		$color_secondary = $htheme_meta_type_secondary_color;
	endif;


	$htheme_meta_social_primary_color = get_post_meta($post->ID, 'htheme_meta_social_primary_color', true);
	$htheme_meta_social_secondary_color = get_post_meta($post->ID, 'htheme_meta_social_secondary_color', true);

	if($htheme_meta_social_primary_color){
		?>
		<style type="text/css">
			.htheme_people_social a:after{				
				color:<?php echo esc_attr($htheme_meta_social_primary_color); ?>
			}
		</style>
		<?php
	}

	if($htheme_meta_social_secondary_color){
		?>
		<style type="text/css">
			.htheme_people_social a:hover:after{
				color:<?php echo esc_attr($htheme_meta_social_secondary_color); ?>
			}
		</style>
		<?php
	}

?>
<div class="htheme_people_single_holder">
	<div class="htheme_people_single" style="background-image:url(<?php echo esc_url($htheme_meta_type_background_image); ?>)">
		<div class="htheme_single_inner_people">
			<div class="htheme_single_people_content">
				<h1 style="color:<?php echo esc_attr($color_primary); ?>"><?php esc_html(the_title()); ?></h1>
				<?php if($htheme_meta_type_position): ?>
					<span class="htheme_h2_sub" style="color:<?php echo esc_attr($color_primary); ?>"><?php echo esc_html($htheme_meta_type_position); ?></span>
				<?php endif; ?>
				<span class="htheme_single_people_info htheme_default_content" style="color:<?php echo esc_attr($color_secondary); ?>">
					<?php if($post->post_excerpt): ?>
						<?php
						if($post->post_excerpt != ''){
							$content = rtrim(substr(esc_html($post->post_excerpt), 0, 250)).'...';
						} else {
							$content = rtrim(substr(esc_html($post->post_excerpt), 0, 250));
						}
						?>
						<?php echo $content; ?>
					<?php endif; ?>
				</span>
				<?php if($htheme_meta_type_image_signature): ?>
				<div class="htheme_single_people_sig">
					<img alt="<?php esc_html_e('Profile signature', 'invogue'); ?>" src="<?php echo esc_url($htheme_meta_type_image_signature); ?>" width="150">
				</div>
				<?php endif; ?>
				<div class="htheme_people_social">
					<?php
						#GET TEMPLATE PART - SOCIAL PEOPLE
						get_template_part( 'htheme/templateparts/content/people', 'social' );
					?>
				</div>
			</div>
		</div>
	</div>
</div>