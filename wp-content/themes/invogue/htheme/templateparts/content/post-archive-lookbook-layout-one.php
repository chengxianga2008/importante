<?php

#POST VARIABLES
$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );
$htheme_meta_devider = $GLOBALS['htheme_global_object']['settings']['lookbook']['divider'];
$htheme_meta_image_gallery = get_post_meta($post->ID, 'htheme_meta_image_gallery', true);

#ARRAYS
$array_one_top = array(0,5,10,20);
$array_two_top = array(50,60);
$array_three_top = array(5,15);
$array_one_width = array(630,530);
$array_two_width = array(730,830,930,1030);
$array_three_width = array(400,300);
$array_height_one = array(650,450,750);
$array_height_two = array(550,450,350);
$array_height_three = array(400,300);

?>

<!-- ROW -->
<div class="htheme_row">
	<div class="htheme_lb_layout_one">
		<div class="htheme_lb_layout_one_image_holder">
			<?php
				if($htheme_meta_image_gallery){
					$count = 1;
					$img_ids = explode(',', $htheme_meta_image_gallery);
					foreach($img_ids as $img){
						#VARIABLES
						$width = 0;
						$top = 0;
						$height = 0;
						#SWITCH
						switch($count){
							case 1:
								$width = $array_one_width[array_rand($array_one_width)];
								$top = $array_one_top[array_rand($array_one_top)];
								$height = $array_height_one[array_rand($array_height_one)];
								break;
							case 2:
								$width = $array_two_width[array_rand($array_two_width)];
								$top = $array_two_top[array_rand($array_two_top)];
								$height = $array_height_two[array_rand($array_height_two)];
								break;
							case 3:
								$width = $array_three_width[array_rand($array_three_width)];
								$top = $array_three_top[array_rand($array_three_top)];
								$height = $array_height_three[array_rand($array_height_three)];
								break;
						}
						?>
						<div class="htheme_lb_layout_one_image_<?php echo $count; ?>" style="background-image:url(<?php echo esc_url($img); ?>); height:<?php echo esc_attr($height) . 'px'; ?>; width:<?php echo esc_attr($width) . 'px'; ?>; top:<?php echo esc_attr($top) . '%'; ?>;"></div>
						<?php
						$count++;
					}
				}
			?>
		</div>
		<div class="htheme_lb_layout_one_content_holder">
			<div class="htheme_lb_layout_one_content_inner">
				<h1><?php esc_html(the_title()); ?></h1>
				<?php if($htheme_meta_devider != '' && $htheme_meta_devider != 'none'){ ?>
					<div class="htheme_svg_holder">
						<?php echo wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$htheme_meta_devider.'.svg'); ?>
					</div>
				<?php } ?>
				<span class="htheme_default_content "><?php esc_html_e(the_excerpt()); ?></span>
				<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_btn_style_1"><?php echo esc_html__('VIEW COLLECTION', 'invogue') ?></a>
			</div>
		</div>
	</div>
</div>
<!-- ROW -->