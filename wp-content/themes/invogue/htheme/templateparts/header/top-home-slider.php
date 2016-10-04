<?php

#SLIDES
$slides = $GLOBALS['htheme_global_object']['settings']['slider']['slides'];
$speed = $GLOBALS['htheme_global_object']['settings']['slider']['transitionSpeed'];
$transition = $GLOBALS['htheme_global_object']['settings']['slider']['transition'];
$idle = $GLOBALS['htheme_global_object']['settings']['slider']['idle'];
$idle_display = $GLOBALS['htheme_global_object']['settings']['slider']['idleDisplay'];
$htheme_meta_shortcode = get_post_meta( $post->ID, 'htheme_meta_shortcode', true );
$slide_count = 0;
#SORT ARRAY
$sortArray = array();
foreach($slides as $slide){
	foreach($slide as $key=>$value){
		if(!isset($sortArray[$key])){
			$sortArray[$key] = array();
		}
		$sortArray[$key][] = $value;
	}
}
$orderby = 'order';
array_multisort($sortArray[$orderby],SORT_ASC,$slides);
#CHECK SLIDE STATUS
foreach($slides as $slide){
	if($slide['status'] == 'true' && $slide['deleted'] != 'true'){
		$slide_count++;
	}
}
?>

<?php if($htheme_meta_shortcode != ''){ ?>
<div class="htheme_intro_holder">
	<?php echo do_shortcode($htheme_meta_shortcode); ?>
</div>
<?php } else {
if($slide_count > 0){
?>
	<div class="htheme_slide_holder" data-speed="<?php echo esc_attr($speed); ?>" data-transition="<?php echo esc_attr($transition); ?>" data-idle="<?php echo esc_attr($idle); ?>" data-idle-display="<?php echo esc_attr($idle_display); ?>">

		<?php
		if($slides){
			$count = 1;
			foreach($slides as $slide){
				if($slide['status'] == 'true' && $slide['deleted'] != 'true'){
					#VARIABLES
					$img_layout = $slide['imageContent'];
					$bg_color = $slide['backgroundColor'];
					$bg = $slide['backgroundSrc'];

					$layout = '';

					#CHECK CONTENT POSITION
					if($slide['layout'] == '1'){
						$layout = 'htheme_content_left';
					}else if($slide['layout'] == '2'){
						$layout = 'htheme_content_right';
					}else if($slide['layout'] == '3'){
						$layout = 'htheme_content_center';
					}

					#IMAGES (BG/CONTENT IMG)
					if($slide['imageContentSrc'] != ''){
						$image_content_src = $slide['imageContentSrc'];
					}

					?>

					<div class="htheme_slide" id="htheme_slide_id_<?php echo esc_attr($count); ?>" style="background-image:url(<?php echo esc_url($bg); ?>); background-color:<?php echo esc_attr($bg_color); ?>">
						<?php if($img_layout == 'true'){ ?>
							<div class="htheme_inner_slide <?php echo esc_attr($layout); ?>">
								<div class="htheme_inner_col">
									<?php if($slide['imageContentSrc'] != ''){ ?>
										<a href="<?php echo esc_url($slide['slideUrl']); ?>">
											<img alt="<?php esc_html_e('Click Here', 'invogue'); ?>" src="<?php echo esc_url($slide['imageContentSrc']); ?>">
										</a>
									<?php } ?>
								</div>
							</div>
						<?php }else{ ?>
							<div class="htheme_inner_slide <?php echo esc_attr($layout); ?>">
								<div class="htheme_inner_slide_content">
									<?php if($slide['slideTitle'] !== ''): ?>
										<span
											class="htheme_slide_title" <?php if($slide['color'] !== ''): echo 'style="color:' . esc_attr($slide['color']) . '"'; endif; ?>><?php echo esc_html($slide['slideTitle']); ?></span>
									<?php endif; ?>
									<?php if($slide['slideContent'] !== ''): ?>
										<span
											class="htheme_slide_content" <?php if($slide['contentColor'] !== ''): echo 'style="color:' . esc_attr($slide['contentColor']) . '"'; endif; ?>><?php echo esc_html($slide['slideContent']); ?></span>
									<?php endif; ?>
									<?php if($slide['buttonText'] !== ''): ?>
										<a href="<?php echo esc_url($slide['slideUrl']); ?>"
										   class="htheme_btn_style_1"><?php echo esc_html($slide['buttonText']); ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php } ?>
						<?php if($transition == 'shutter'): ?>
							<div class="htheme_mask_holder">
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
								<div class="htheme_mask_item"
									 style="background-image:url(<?php echo esc_url($slide['backgroundSrc']); ?>)"></div>
							</div>
						<?php endif; ?>
					</div>
					<?php
					$count++;
				}
			}
		}
		?>
		<div class="htheme_slider_navigation">
			<div class="htheme_slide_button htheme_icon_slider_left" data-side="left"></div>
			<div class="htheme_slide_button htheme_icon_slider_right" data-side="right"></div>
		</div>
		<!-- TIMER -->
		<div class="htheme_timer_holder"></div>
		<!-- TIMER -->
	</div>
<?php } ?>
<?php } ?>