<?php

	#VARIABLES
	$image_details = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full' );
	$col_style = 'htheme_col_10';

	#CHECK
	if($image_details[0] == ''){
		$col_style = 'htheme_col_11';
	}

?>

<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="htheme_search_row">
	<?php if($image_details[0] != ''){ ?>
	<div class="htheme_col_1 htheme_position htheme_search_image" style="background-image:url(<?php echo esc_url($image_details[0]); ?>)">
		<div class="htheme_inner_col"></div>
	</div>
	<?php } ?>
	<div class="<?php echo esc_attr($col_style); ?> htheme_position">
		<div class="htheme_inner_col">
			<div class="htheme_row_content_wrap">
				<h4><?php echo esc_html($post->post_title); ?></h4>
				<?php if($post->post_excerpt){ ?>
					<p class="htheme_h4_sub"><?php echo rtrim(substr(esc_html($post->post_excerpt), 0, 90)); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="htheme_col_1 htheme_position">
		<div class="htheme_inner_col">
			<h4><?php echo esc_html($post->post_type); ?></h4>
		</div>
	</div>
</a>