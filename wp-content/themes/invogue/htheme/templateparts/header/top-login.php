<?php global $woocommerce,$sitepress;; ?>

<?php

	#VARIABLES
	$htheme_is_logged = false;
	$htheme_current_user = '';
	$htheme_social_items =  $GLOBALS['htheme_global_object']['settings']['header']['socialItems'];
	$htheme_show_account =  $GLOBALS['htheme_global_object']['settings']['header']['optionAccount'];
	$htheme_show_social =  $GLOBALS['htheme_global_object']['settings']['header']['socialIcons'];

	$htheme_header_eyebrow_text = $GLOBALS['htheme_global_object']['settings']['header']['eyebrowText'];

	#CHECK LOGIN
	if ( is_user_logged_in() && class_exists( 'WooCommerce' ) ) {

		#GET CURRENT USER DETAILS
		$htheme_current_user = wp_get_current_user();

		#SET LOGGED TO TRUE
		$htheme_is_logged = true;

	}

?>

<!-- IF LOGGED IN -->
<div class="htheme_account_wrap">
<?php if( is_user_logged_in() && class_exists( 'WooCommerce' ) && $htheme_show_account == 'true' ) { ?>
<div class="htheme_account_holder">
	<?php esc_html_e('Welcome', 'invogue'); ?>, <?php echo esc_html($htheme_current_user->user_nicename); ?>!
</div>
<div class="htheme_account_holder">
	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e('My Account','invogue'); ?></a>
</div>
<div class="htheme_account_holder">
	<a href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_html_e('Logout', 'invogue'); ?></a>
</div>
<?php } else if( !is_user_logged_in() && class_exists( 'WooCommerce' ) ){ ?>
<div class="htheme_account_holder">
	<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><?php esc_html_e('Login', 'invogue'); ?></a> <?php esc_html_e('to view your account', 'invogue'); ?>.
</div>
<?php } ?>
<!-- TOP BAR TEXT -->
<?php if($htheme_header_eyebrow_text != ''){ ?>
<div class="htheme_account_holder">
	<?php _e($htheme_header_eyebrow_text, 'invogue'); ?>
</div>
<?php } ?>
</div>
<!-- DO COUNT -->
<?php
	$social_count = 0;
	foreach($htheme_social_items as $social){
		if($social['status'] == 'true'){
			$social_count++;
		}
	}
?>
<?php if($social_count > 0 && $htheme_show_social == 'true'){ ?>
<div class="htheme_share htheme_box_toggle">
	<?php
		$count = 1;
		foreach($htheme_social_items as $social){
			if($social['status'] == 'true'){
	?>
	<a href="<?php echo esc_url($social['url']); ?>" target="<?php echo esc_attr($social['target']); ?>" >
	<?php esc_html_e('Follow us', 'invogue'); ?>
	
				<span  class="htheme_box_item htheme_icon_social_<?php echo esc_attr($social['label']); ?>" data-id="<?php echo esc_attr($count); ?>"></span>
			<?php
						$count++;
			}
		}
	?>
	</a>
</div>
<?php } ?>

<?php

?>
<?php #WPML CODE
$wpml_enable = $GLOBALS['htheme_global_object']['settings']['wpml']['wpmlSelector'];
if ( function_exists('icl_object_id') && $wpml_enable == 'true' ) {
	$wpml_languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
	if(1 < count($wpml_languages)){ ?>
	<div class="htheme_language htheme_box_toggle" data-toggle="open">
		<?php
			echo $sitepress->get_current_language();
		?>
		<div class="htheme_small_white_box htheme_white_box">
			<div class="htheme_box_inner">
				<?php
				$count = 1;
				foreach($wpml_languages as $lang){
					?>
					<a href="<?php echo esc_url($lang['url']); ?>" class="htheme_box_item" data-id="<?php echo esc_attr($count); ?>">
						<?php echo esc_html($lang['language_code']); ?>
					</a>
					<?php
					$count++;
				}
				?>
			</div>
		</div>
	</div>
<?php }} ?>
