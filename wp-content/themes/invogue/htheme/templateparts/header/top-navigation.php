<?php

	#GLOBALS
	global $woocommerce;

	#BLOG VARAIBLES
	$htheme_src_logo = $GLOBALS['htheme_global_object']['settings']['header']['srcLogo'];
	$htheme_src_sticky_logo = $GLOBALS['htheme_global_object']['settings']['header']['srcStickyLogo'];
	$htheme_src_mobile_logo = $GLOBALS['htheme_global_object']['settings']['header']['srcMobileLogo'];
	$htheme_logo_height = $GLOBALS['htheme_global_object']['settings']['header']['logoHeight'];
	$htheme_logo_sticky_height = $GLOBALS['htheme_global_object']['settings']['header']['logoStickyHeight'];

	$htheme_header_layout = $GLOBALS['htheme_global_object']['settings']['header']['layout'];

	$htheme_header_cart_status = $GLOBALS['htheme_global_object']['settings']['header']['optionCart'];
	$htheme_header_wishlist_status = $GLOBALS['htheme_global_object']['settings']['header']['optionWishlist'];
	$htheme_header_search_status = $GLOBALS['htheme_global_object']['settings']['header']['optionSearch'];
	$htheme_header_hamburger_status = $GLOBALS['htheme_global_object']['settings']['header']['hamburger'];

	$htheme_burger = '';

	if($htheme_header_hamburger_status == 'true'){
		$htheme_burger = 'htheme_is_burger';
		get_template_part( 'htheme/templateparts/header/top', 'hamburger' );
	}

	$htheme_woocommerce_wishlist_page = $GLOBALS['htheme_global_object']['settings']['woocommerce']['wishlistPage'];

	$cart_style = '';
	$nav_icon_style = '';
	$nav_icon_status = true;

	if($htheme_header_cart_status == 'false'){
		$cart_style = 'display:none';
	}

	$wishlist_style = '';
	if($htheme_header_wishlist_status == 'false'){
		$wishlist_style = 'display:none';
	}

	$search_style = '';
	if($htheme_header_search_status == 'false'){
		$search_style = 'display:none';
	}

	if($htheme_header_cart_status == 'false' && $htheme_header_wishlist_status == 'false' && $htheme_header_search_status == 'false'){
		$nav_icon_status = false;
		$nav_icon_style = 'display:none';
	}

?>

<div class="htheme_navigation <?php echo esc_attr($htheme_burger); ?>">
	<?php if($htheme_header_layout == 2){ ?>
	<div class="htheme_small_navigation">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<?php
					#GET TEMPLATE PART - NAVIGATION
					get_template_part( 'htheme/templateparts/header/top', 'login' );
				?>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="htheme_default_navigation" data-height-default="80" data-height-sticky="60" data-height-mobile="60">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<div class="htheme_logo">
					<!-- MAIN LOGO -->
					<?php if($htheme_src_logo){ ?>
						<a href="<?php echo esc_url(home_url()); ?>" class="htheme_main_logo"><img alt="<?php esc_html_e('Back to home', 'invogue'); ?>" src="<?php echo esc_url($htheme_src_logo); ?>"></a>
					<?php } ?>
					<!-- STICKY LOGO -->
					<?php if($htheme_src_sticky_logo){ ?>
						<a href="<?php echo esc_url(home_url()); ?>" class="htheme_sticky_logo"><img alt="<?php esc_html_e('Back to home', 'invogue'); ?>" src="<?php echo esc_url($htheme_src_sticky_logo); ?>"></a>
					<?php } ?>
					<!-- MOBILE LOGO -->
					<?php if($htheme_src_sticky_logo){ ?>
						<a href="<?php echo esc_url(home_url()); ?>" class="htheme_mobile_logo"><img alt="<?php esc_html_e('Back to home', 'invogue'); ?>" src="<?php echo esc_url($htheme_src_mobile_logo); ?>"></a>
					<?php } ?>
					<!-- PLACEHOLDER -->
					<div class="htheme_default_logo_text">
						<div class="htheme_default_logo_text_inner">
							<a href="<?php echo esc_url(home_url()); ?>">
								<?php
									echo get_option('blogname');
								?>
							</a>
						</div>
					</div>
				</div>
				<div class="htheme_main_navigation">
					<div class="htheme_inner_navigation">
						<div class="htheme_nav">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => '', 'menu_id' => 'primary' ) ); ?>
						</div>
						<?php if($htheme_header_search_status == 'true' || class_exists( 'WooCommerce' )){ ?>
						<div class="htheme_icon_nav" style="<?php echo esc_attr($nav_icon_style); ?>">
							<ul>
								<?php if(class_exists( 'WooCommerce' )){ ?>
									<!-- CHECK IF LOGGED IN -->
									<?php
										$login_status = 'out';
										$toggle_classes = '';
										$href = '';
										$htheme_wishlist_page = '';
										if(is_user_logged_in() && class_exists( 'WooCommerce' )){
											$login_status = 'in';
											if($htheme_woocommerce_wishlist_page != ''){
												$htheme_wishlist_page = get_post(intval($htheme_woocommerce_wishlist_page));
											} else {
												$htheme_wishlist_page = get_page_by_title('Wishlist');
											}
											if($htheme_wishlist_page){
												$href = 'href="'.esc_url(get_permalink($htheme_wishlist_page->ID)).'"';
											}
										} else {
											$toggle_classes = 'class="htheme_box_toggle htheme_wishlist_box" data-toggle="open"';
										}
									?>
									<li <?php echo $toggle_classes; ?> style="<?php echo $wishlist_style; ?>">
										<a <?php echo $href; ?> data-login-status="<?php echo esc_attr($login_status); ?>" class="htheme_icon_nav_wishlist"><span><!-- LOAD WISHLIST COUNT --></span></a>
										<a <?php echo $href; ?> class="htheme_icon_nav_wishlist_fill"></a>
										<div class="htheme_large_white_box htheme_white_box">
											<div class="htheme_box_inner">
												<div class="htheme_box_item htheme_no_wishlist_items" data-id="1">
													<?php esc_html_e('You have to be signed in to add &amp; view your wishlist.', 'invogue'); ?>
												</div>
												<div class="htheme_box_line"></div>
												<div class="htheme_box_item" data-id="2">
													<div class="htheme_button_holder">
														<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" class="htheme_button_container">
															<?php esc_html_e('LOGIN / REGISTER', 'invogue'); ?>
														</a>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="htheme_box_toggle htheme_cart_box" data-toggle="open" style="<?php echo $cart_style; ?>">
										<a class="htheme_icon_nav_cart"><span><!-- LOAD CART COUNT --></span></a>
										<div class="htheme_large_white_box htheme_white_box">
											<div class="htheme_box_inner">
												<div class="htheme_box_item" data-id="1">
													<div class="htheme_box_heading"><?php esc_html_e('SHOPPING CART', 'invogue'); ?></div>
												</div>
												<div class="htheme_box_line"></div>
												<div class="htheme_box_item htheme_no_items" data-id="2">
													<?php esc_html_e('You currently don\'t have any items in your cart.', 'invogue'); ?>
												</div>
												<div class="htheme_box_item htheme_has_items" data-id="2">
													<div class="htheme_box_cart_items">
														<!-- LOAD CART ITEMS -->
													</div>
												</div>
												<div class="htheme_box_line htheme_has_items"></div>
												<div class="htheme_box_item htheme_has_items htheme_qty_remove" data-id="3">
													<div class="htheme_box_qty_text"><!-- SHOW QTY TOTAL TEXT --><?php esc_html_e('View full list in cart.', 'invogue'); ?></div>
												</div>
												<div class="htheme_box_item htheme_has_items" data-id="4">
													<div class="htheme_box_price"><?php esc_html_e('Total', 'invogue'); ?>: <span></span><!-- SHOW TOTAL --></div>
												</div>
												<div class="htheme_box_line htheme_has_items"></div>
												<div class="htheme_box_item htheme_has_items" data-id="5">
													<div class="htheme_button_holder">
														<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="htheme_button_container">
															<?php esc_html_e('VIEW CART', 'invogue'); ?>
														</a>
														<a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>" class="htheme_button_container">
															<?php esc_html_e('CHECKOUT', 'invogue'); ?>
														</a>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php } ?>
								<li style="<?php echo esc_attr($search_style); ?>"><a class="htheme_icon_nav_search htheme_overlay_search"></a></li>
								<li class="htheme_burger_li"><a class="htheme_icon_hamburger_toggle"></a></li>
							</ul>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>