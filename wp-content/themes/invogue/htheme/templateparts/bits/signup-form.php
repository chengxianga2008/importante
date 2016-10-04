<?php
	#VARAIBLES
	$htheme_newsletter_status = $GLOBALS['htheme_global_object']['settings']['newsletter']['status'];
	$htheme_newsletter_page = $GLOBALS['htheme_global_object']['settings']['newsletter']['page'];

	if(isset($post->ID)){
	
	if(isset($_COOKIE['show_signup']) &&  $_COOKIE['show_signup'] == 'show' && $htheme_newsletter_status == 'true' && $htheme_newsletter_page == $post->ID) {

	$htheme_newsletter_title = $GLOBALS['htheme_global_object']['settings']['newsletter']['title'];
	$htheme_newsletter_info = $GLOBALS['htheme_global_object']['settings']['newsletter']['info'];
	$htheme_newsletter_bg = $GLOBALS['htheme_global_object']['settings']['newsletter']['backgroundImage'];
	$htheme_newsletter_size = $GLOBALS['htheme_global_object']['settings']['newsletter']['backgroundSize'];
	$htheme_newsletter_position = $GLOBALS['htheme_global_object']['settings']['newsletter']['backgroundPosition'];
	$htheme_newsletter_bg_color = $GLOBALS['htheme_global_object']['settings']['newsletter']['backgroundColor'];

?>

<div class="htheme_signup_preview">
	<div class="htheme_icon_popup_close"></div>
	<div class="htheme_signup_holder" style="background-image:url(<?php echo esc_url($htheme_newsletter_bg); ?>); background-color:<?php echo esc_attr($htheme_newsletter_bg_color); ?>; background-size:<?php echo esc_attr($htheme_newsletter_size);?>; background-position:<?php echo esc_attr($htheme_newsletter_position); ?>">
		<!-- ROW -->
		<form id="htheme_form_signup_popup" class="htheme_signup_form" data-subject="SUBJECT">
			<div class="htheme_row">
				<div class="htheme_signup_container">
					<h2><?php echo esc_html($htheme_newsletter_title); ?></h2>
					<div class="htheme_icon_signup"></div>
					<span class="htheme_h2_sub"><?php echo esc_html($htheme_newsletter_info); ?></span>
					<div class="htheme_signup_form_holder">
						<div class="htheme_signup_controls">
							<div class="htheme_form_status_message"></div>
						</div>
						<div class="htheme_signup_fields">
							<div class="htheme_signup_field_item">
								<input type="text" name="user_signup_email" id="user_signup_email">
								<label for="user_signup_email" class="">
									<?php esc_html_e('Email Address', 'invogue'); ?>
									<span class="htheme_icon_signup_btn"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- ROW -->
		<div class="htheme_signup_show_check htheme_h5_sub">
			<input type="checkbox" name="htheme_hide_signup" id="htheme_hide_signup">
			<label for="htheme_hide_signup"><?php esc_html_e('Don\'t show this message again', 'invogue'); ?></label>
		</div>
	</div>
</div>

<?php }} ?>