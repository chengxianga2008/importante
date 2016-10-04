<?php $htheme_meta_layout = get_post_meta( $post->ID, 'htheme_meta_layout', true ); ?>
<?php $htheme_meta_title = get_post_meta( $post->ID, 'htheme_meta_title', true ); ?>
<?php $htheme_meta_devider = get_post_meta( $post->ID, 'htheme_meta_title_devider', true ); ?>
<?php $htheme_meta_excerpt = get_post_meta( $post->ID, 'htheme_meta_sub', true ); ?>
<?php $htheme_meta_devider_color = get_post_meta( $post->ID, 'htheme_meta_title_devider_color', true ); ?>
<?php if($htheme_meta_layout == '3' || !$htheme_meta_layout){ ?>
	<!-- ROW -->
	<div class="htheme_row htheme_padding_bottom">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<!-- TITLE DEFAULT -->
				<div class="htheme_title_container" data-title-type="default">
					<div class="htheme_title">
						<h1>
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
					</div>
					<?php if($htheme_meta_devider != '' && $htheme_meta_devider != 'none'){ ?>
						<div class="htheme_svg_holder">
							<?php echo wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$htheme_meta_devider.'.svg'); ?>
						</div>
					<?php } ?>
					<?php if(class_exists( 'WooCommerce' ) && is_shop() || class_exists( 'WooCommerce' ) && is_product_category() || class_exists( 'WooCommerce' ) && is_product_tag()){ ?>
					<!-- DO NOTHING -->
					<?php } else if($htheme_meta_excerpt != '') { ?>
						<div class="htheme_sub_title htheme_h1_sub">
							<?php echo esc_html($htheme_meta_excerpt); ?>
						</div>
					<?php } else if($htheme_meta_excerpt == '' && $post->post_excerpt != '') { ?>
						<div class="htheme_sub_title htheme_h1_sub">
							<?php echo esc_html($post->post_excerpt); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->
<?php } ?>