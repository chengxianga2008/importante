<!-- MOBILE LOGO -->
<?php $htheme_src_burger_logo = $GLOBALS['htheme_global_object']['settings']['header']['srcHamburgerLogo']; if($htheme_src_burger_logo){ ?>
	<div class="htheme_hamburger_logo">
		<a href="<?php echo esc_url(home_url()); ?>"><img alt="<?php esc_html_e('Back to home', 'invogue'); ?>" src="<?php echo esc_url($htheme_src_burger_logo); ?>"></a>
	</div>
<?php } ?>
<!-- MOBILE LOGO -->
<div class="htheme_hamburger_close"></div>
<div class="htheme_hamburger_holder">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => '', 'menu_id' => 'primary' ) ); ?>
</div>