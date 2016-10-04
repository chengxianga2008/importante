<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - The template for displaying the footer
 */

#VARIABLES
$htheme_number_cols = $GLOBALS['htheme_global_object']['settings']['footer']['columnLayout'];
$htheme_col_style = 'htheme_col_3';
$htheme_footer_layout = $GLOBALS['htheme_global_object']['settings']['footer']['layout'];
$htheme_copyright = $GLOBALS['htheme_global_object']['settings']['footer']['copyright'];
$htheme_copytext = $GLOBALS['htheme_global_object']['settings']['footer']['copyrightText'];
?>

<!-- FOOTER HOLDER -->
<div class="htheme_footer_holder">

	<?php if($htheme_footer_layout == 'footer_full' || $htheme_footer_layout == 'footer_top'){ ?>
	<div class="htheme_main_footer">
		<div class="htheme_container">

			<?php
				if($htheme_number_cols == 4){
					$htheme_col_style = 'htheme_col_3';
				} else if($htheme_number_cols == 3){
					$htheme_col_style = 'htheme_col_4';
				} else if($htheme_number_cols == 2){
					$htheme_col_style = 'htheme_col_6';
				}
			?>

			<?php if( $htheme_number_cols >= 2 ){ ?>
			<div class="<?php echo esc_attr($htheme_col_style); ?>">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column (1)') ) : else : ?>
					<div class="htheme_inner_col">
						<div class="htheme_footer_heading">
							<?php esc_html_e('Footer Widget Area (1)', 'invogue'); ?>
						</div>
						<div class="htheme_footer_content">
							<a href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Click here', 'invogue'); ?></a> <?php esc_html_e('to add some widgets.', 'invogue'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php } ?>
			<?php if( $htheme_number_cols >= 2 ){ ?>
			<div class="<?php echo esc_attr($htheme_col_style); ?>">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column (2)') ) : else : ?>
					<div class="htheme_inner_col">
						<div class="htheme_footer_heading">
							<?php esc_html_e('Footer Widget Area (2)', 'invogue'); ?>
						</div>
						<div class="htheme_footer_content">
							<a href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Click here', 'invogue'); ?></a> <?php esc_html_e('to add some widgets.', 'invogue'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php } ?>
			<?php if( $htheme_number_cols >= 3 ){ ?>
			<div class="<?php echo esc_attr($htheme_col_style); ?>">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column (3)') ) : else : ?>
					<div class="htheme_inner_col">
						<div class="htheme_footer_heading">
							<?php esc_html_e('Footer Widget Area (3)', 'invogue'); ?>
						</div>
						<div class="htheme_footer_content">
							<a href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Click here', 'invogue'); ?></a> <?php esc_html_e('to add some widgets.', 'invogue'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php } ?>
			<?php if( $htheme_number_cols >= 4 ){ ?>
			<div class="<?php echo esc_attr($htheme_col_style); ?>">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column (4)') ) : else : ?>
					<div class="htheme_inner_col">
						<div class="htheme_footer_heading">
							<?php esc_html_e('Footer Widget Area (4)', 'invogue'); ?>
						</div>
						<div class="htheme_footer_content">
							<a href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Click here', 'invogue'); ?></a> <?php esc_html_e('to add some widgets.', 'invogue'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php

	if($htheme_footer_layout == 'footer_full' || $htheme_footer_layout == 'footer_sub'){

		$htheme_social_items =  $GLOBALS['htheme_global_object']['settings']['header']['socialItems'];
		$htheme_social_status = $GLOBALS['htheme_global_object']['settings']['footer']['social'];

		$social_count = 0;
		foreach($htheme_social_items as $social){
			if($social['status'] == 'true'){
				$social_count++;
			}
		}

		$float_style = '';
		if($social_count > 0 && $htheme_social_status == 'true'){
			$float_style = 'htheme_footer_float_right';
		}

	?>

	<div class="htheme_sub_footer">
		<div class="htheme_container htheme_position_relative">
			<div class="htheme_inner_col">

				<div class="htheme_footer_nav_wrap <?php echo esc_attr($float_style); ?>">
					<?php if($htheme_copyright == 'true'){ ?>
					<div class="htheme_copyright">
						<?php echo esc_html($htheme_copytext); ?>
					</div>
					<?php } ?>
					<div class="htheme_footer_nav">
						<?php
							if ( has_nav_menu( 'footer' ) ){
								wp_nav_menu(array('theme_location' => 'footer', 'container' => '', 'menu_class' => '', 'menu_id' => 'footer'));
							}
						?>
					</div>
				</div>

				<?php if($social_count > 0 && $htheme_social_status == 'true'){ ?>
				<div class="htheme_footer_social_wrap">
					<?php
						foreach($htheme_social_items as $social){
							if($social['status'] == 'true'){
								?>
									<a href="<?php echo esc_url($social['url']); ?>" target="<?php echo esc_attr($social['target']); ?>" class="htheme_footer_social_item htheme_icon_social_<?php echo esc_attr($social['label']); ?>"></a>
								<?php
							}
						}
					?>
				</div>
				<?php } ?>

			</div>
		</div>
	</div>
	<?php } ?>
</div>
<!-- FOOTER HOLDER -->
<?php wp_footer(); ?>
</body>
</html>
