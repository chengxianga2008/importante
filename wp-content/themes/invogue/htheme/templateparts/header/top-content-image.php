<?php

	#GET PAGE META VARAIBLES
	$htheme_meta_layout = get_post_meta( $post->ID, 'htheme_meta_layout', true );
	$htheme_meta_background_image = get_post_meta( $post->ID, 'htheme_meta_image', true );
	$htheme_meta_fullscreen = get_post_meta( $post->ID, 'htheme_meta_fullscreen', true );
	$htheme_meta_height = get_post_meta( $post->ID, 'htheme_meta_height', true );
	$htheme_meta_title = get_post_meta( $post->ID, 'htheme_meta_title', true );
	$htheme_meta_devider = get_post_meta( $post->ID, 'htheme_meta_title_devider', true );
	$htheme_meta_devider_color = get_post_meta( $post->ID, 'htheme_meta_title_devider_color', true );
	$htheme_meta_excerpt = get_post_meta( $post->ID, 'htheme_meta_sub', true );
	$htheme_meta_horz = get_post_meta( $post->ID, 'htheme_meta_horz', true );
	$htheme_meta_bg_position = get_post_meta( $post->ID, 'htheme_meta_bg_position', true );
	$htheme_meta_header_color = get_post_meta( $post->ID, 'htheme_meta_bg_color', true );
	$htheme_meta_font_color = get_post_meta( $post->ID, 'htheme_meta_font_color', true );
	$htheme_meta_btn_text = get_post_meta( $post->ID, 'htheme_meta_btn_text', true );
	$htheme_meta_btn_url = get_post_meta( $post->ID, 'htheme_meta_btn_url', true );
	$htheme_meta_btn_target = get_post_meta( $post->ID, 'htheme_meta_btn_target', true );
	$htheme_meta_shortcode = get_post_meta( $post->ID, 'htheme_meta_shortcode', true );

	$htheme_bg_position = 'background-position:'.$htheme_meta_bg_position.';';

	if($htheme_meta_fullscreen == true){
		$htheme_bg_position = 'background-position:50% 0;';
		echo '<div class="htheme_fullscreen_button"></div>';
	}

?>

<div class="htheme_intro_holder">
	<?php
	if($htheme_meta_shortcode != ''){
		echo do_shortcode($htheme_meta_shortcode);
	} else {

		if(isset($_GET['main'])){
			$htheme_img = wp_get_attachment_url( $_GET['main'] );
			?>
				<div class="htheme_intro" style="text-align:<?php echo esc_attr($htheme_meta_horz); ?> !important; background-image:url(<?php echo esc_url($htheme_img); ?>); <?php echo $htheme_bg_position; ?> background-color:<?php echo esc_attr($htheme_meta_header_color); ?>">
			<?php
		} else {
			?>
				<div class="htheme_intro" style="text-align:<?php echo esc_attr($htheme_meta_horz); ?> !important; background-image:url(<?php echo esc_url($htheme_meta_background_image); ?>); <?php echo $htheme_bg_position; ?> background-color:<?php echo esc_attr($htheme_meta_header_color); ?>">
			<?php
		}

		$button_position = '';
		$content_position = '';

		#CHECK ALIGNMENT
		if($htheme_meta_horz == 'left'){
			$button_position = 'style="float:left; margin-top:20px;"';
			$content_position = 'htheme_position_left';
		} else if($htheme_meta_horz == 'right'){
			$button_position = 'style="float:right; margin-top:20px;"';
			$content_position = 'htheme_position_right';
		} else {
			$button_position = 'style="margin:20px auto 0"';
			$content_position = 'htheme_position_center';
		}

	?>

			<div class="htheme_intro_item">
				<div class="htheme_inner_col <?php echo esc_attr($content_position); ?>">
					<h1 style="color:<?php echo esc_attr($htheme_meta_font_color); ?>">
						<?php if(isset($_GET['get_title'])){ ?>
							<?php echo esc_html($_GET['get_title']); ?>
						<?php } else { ?>
							<?php
							if($htheme_meta_title != ''){
								echo esc_html($htheme_meta_title);
							} else {
								esc_html(the_title());
							}
							?>
						<?php } ?>
					</h1>
					<?php if($htheme_meta_devider != '' && $htheme_meta_devider != 'none'){ ?>
						<div class="htheme_svg_holder">
							<?php echo wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$htheme_meta_devider.'.svg'); ?>
						</div>
					<?php } ?>
					<?php if(class_exists( 'WooCommerce' ) && is_shop() || class_exists( 'WooCommerce' ) && is_product_category() || class_exists( 'WooCommerce' ) && is_product_tag()){ ?>
						<div class="htheme_sub_title htheme_h1_sub" <?php if($htheme_meta_font_color){ ?>style="color:<?php echo esc_attr($htheme_meta_font_color); ?>"<?php } ?>><?php woocommerce_breadcrumb(); ?></div>
					<?php } else if($htheme_meta_excerpt != '') { ?>
						<div class="htheme_sub_title htheme_h1_sub" <?php if($htheme_meta_font_color){ ?>style="color:<?php echo esc_attr($htheme_meta_font_color); ?>"<?php } ?>>
							<?php echo esc_html($htheme_meta_excerpt); ?>
						</div>
						<?php if($htheme_meta_btn_text != '' && $htheme_meta_btn_url != ''){ ?>
							<a href="<?php echo esc_url($htheme_meta_btn_url); ?>" target="<?php echo esc_attr($htheme_meta_btn_target); ?>" <?php echo $button_position; ?> class="htheme_btn_style_1"><?php echo esc_html($htheme_meta_btn_text); ?></a>
						<?php } ?>
					<?php } else if($htheme_meta_excerpt == '' && $post->post_excerpt != '') { ?>
						<div class="htheme_sub_title htheme_h1_sub" <?php if($htheme_meta_font_color){ ?>style="color:<?php echo esc_attr($htheme_meta_font_color); ?>"<?php } ?>><?php echo esc_html($post->post_excerpt); ?></div>
					<?php } ?>

				</div>
			</div>

		</div>

	<?php } ?>

</div>