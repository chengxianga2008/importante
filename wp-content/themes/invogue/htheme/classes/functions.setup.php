<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HTHEME SETUP
function htheme_setup(){

	#ADD THEME TITLE SUPPORT
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'editor-style' );

	if(function_exists('add_theme_support')) {
		add_theme_support('automatic-feed-links');
	}

	#IF WOOCOMMERCE CLASS EXIST
	if ( class_exists( 'WooCommerce' ) ){
		add_theme_support('woocommerce');
	}

	#REGISTER MENUS
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'invogue' ),
		'secondary'  => esc_html__( 'Secondary Menu', 'invogue' ),
		'footer'  => esc_html__( 'Footer Menu', 'invogue' ),
	) );

	#ADD MULTIPLE IMAGE SIZES
	add_image_size( 'htheme-image-50', 50, 9999, false );
	add_image_size( 'htheme-image-100', 100, 9999, false );
	add_image_size( 'htheme-image-165', 165, 165, false );
	add_image_size( 'htheme-image-200', 200, 9999, false );
	add_image_size( 'htheme-image-300', 300, 9999, false );
	add_image_size( 'htheme-image-400', 400, 9999, false );
	add_image_size( 'htheme-image-500', 500, 9999, false );
	add_image_size( 'htheme-image-600', 600, 9999, false );
	add_image_size( 'htheme-image-700', 700, 9999, false );
	add_image_size( 'htheme-image-800', 800, 9999, false );
	add_image_size( 'htheme-image-900', 900, 9999, false );

	#REQUIRED FOR THEME-CHECK
	if ( ! isset( $content_width ) ) $content_width = 900;

	#EDITOR STYLES
	add_editor_style( 'assets/css/herotheme_editor_styles.css' );

}

#HTHEME SETUP ACTION HOOK
add_action( 'after_setup_theme', 'htheme_setup' );

#SCRIPT ENQUEUE
function htheme_scripts(){

	#INSTANTIATE CREATE JS CLASS
	$htheme_create_js = new htheme_js();

	#JQUERY MOBILE
	wp_enqueue_script( 'htheme-mobile', get_template_directory_uri().'/htheme/assets/js/jquery.mobile.js', array( 'jquery' ) );

	#SHARETHIS JS FILE
	wp_enqueue_script( 'htheme-sharethis', 'https://ws.sharethis.com/button/buttons.js', array( 'jquery' ) );

	#COMMENT REPLY SCRIPT
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	#ENQUEUE CUSTOM SHARETHIS SCRIPT
	$custom_sharethis_js = $htheme_create_js->htheme_create_sharethis();
	wp_add_inline_script( 'htheme-sharethis', $custom_sharethis_js );

	#ENQUEUE CUSTOM SCRIPT BEFORE HEAD
	$custom_before_js = $htheme_create_js->htheme_create_before_js();
	wp_add_inline_script( 'htheme-sharethis', $custom_before_js );

}

#HTHEME SCRIPT ACTION HOOK
add_action( 'wp_enqueue_scripts', 'htheme_scripts' );

#ADD CUSTOM SCRIPT TO WP_FOOTER
function htheme_footer_script() {

	#INSTANTIATE CREATE JS CLASS
	$htheme_create_js = new htheme_js();

	wp_enqueue_script('jquery-ui-core');

	#LOAD TWEENMAX (UTILS/EASING/MAIN MAX)
	wp_enqueue_script( 'htheme-cssplugin', get_template_directory_uri().'/htheme/assets/js/greensock/plugins/CSSPlugin.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-scroll', get_template_directory_uri().'/htheme/assets/js/greensock/plugins/ScrollToPlugin.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-easepack', get_template_directory_uri().'/htheme/assets/js/greensock/easing/EasePack.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-split', get_template_directory_uri().'/htheme/assets/js/greensock/utils/SplitText.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-throw', get_template_directory_uri().'/htheme/assets/js/greensock/plugins/ThrowPropsPlugin.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-draggable', get_template_directory_uri().'/htheme/assets/js/greensock/utils/Draggable.js', array( 'jquery' ) );
	wp_enqueue_script( 'htheme-tweenmax', get_template_directory_uri().'/htheme/assets/js/greensock/TweenMax.js', array( 'jquery' ) );

	#MASONRY
	wp_enqueue_script( 'htheme-masonry', get_template_directory_uri().'/htheme/assets/js/masonry.pkgd.min.js', array( 'jquery' ) );

	#TRANSIT
	wp_enqueue_script( 'htheme-transit', get_template_directory_uri().'/htheme/assets/js/jquery.transit.min.js', array( 'jquery' ) );

	#LOAD SCRIPT FUNCTIONS FILE
	wp_enqueue_script( 'htheme-script', get_template_directory_uri().'/htheme/assets/js/functions.js', array( 'jquery' ) );

	#VARIABLES CUSTOM PAGE LOAD
	$htheme_pageLoader = $GLOBALS['htheme_global_object']['settings']['general']['pageLoader'];

	if($htheme_pageLoader != 'false'){
		$custom_pageload_js = $htheme_create_js->htheme_get_pageload_js();
		wp_add_inline_script( 'htheme-script', $custom_pageload_js );
	}

	#VARIABLES
	$htheme_custom_body = $GLOBALS['htheme_global_object']['settings']['general']['codeBody'];

	if($htheme_custom_body){
		?>
		<script type="text/javascript">
			<?php echo stripslashes($htheme_custom_body); ?>
		</script>
		<?php
	}

}

add_action( 'wp_footer', 'htheme_footer_script' );

#HTHEME ADMIN SCRIPTS
function htheme_add_admin_scripts(){

	#ADD ADMIN STYLES
	if(is_admin() && isset($_GET['page']) && $_GET['page'] == 'htheme_settings' || isset($_GET['post'])){ //admin panel
		//admin vc styles
		wp_enqueue_style( 'htheme-vcstyles', get_template_directory_uri().'/htheme/assets/css/herotheme_vc_styles.css' );
		//admin setting styles
		wp_enqueue_style( 'htheme-settingstyles', get_template_directory_uri().'/htheme/assets/css/herotheme_settings_styles.css' );
		//admin tweenmax
		wp_enqueue_script( 'htheme-tweenmax', get_template_directory_uri().'/htheme/assets/js/greensock/TweenMax.js' );
		//admin manager
		wp_enqueue_script( 'htheme-manager', get_template_directory_uri().'/htheme/assets/js/manager.js' );
		//admin global
		wp_enqueue_script( 'htheme-global', get_template_directory_uri().'/htheme/assets/js/global.js' );
		//admin components
		wp_enqueue_script( 'htheme-components', get_template_directory_uri().'/htheme/assets/js/components.js' );
		//meta script
		wp_enqueue_script( 'htheme-meta', get_template_directory_uri().'/htheme/assets/js/meta.js' );
		//media uploader
		if(isset($_GET['page']) == 'herotheme_settings'){
			wp_enqueue_media();
		}
		//autocomplete
		wp_enqueue_script( 'jquery-ui-autocomplete' );
	}

}

#ADMIN ACTION
add_action( 'admin_enqueue_scripts', 'htheme_add_admin_scripts' );

#STYLES ENQUEUE
function htheme_styles() {

	#ENQUEUE STYLES
	wp_enqueue_style( 'htheme-styles', get_template_directory_uri().'/htheme/assets/css/herotheme_theme_styles.css' );

	#INSTANTIATE CREATE CSS CLASS
	$htheme_create_css = new htheme_css();

	#ENQUEUE CUSTOM STYLES
	$custom_css = $htheme_create_css->htheme_create_css();
	wp_add_inline_style( 'htheme-styles', $custom_css );

	#ADD GOOGLE FONTS
	wp_enqueue_style( 'htheme-google-fonts', htheme_add_google_fonts(), array(), '1.0.0' );

}

#STYLES ACTION
add_action( 'wp_enqueue_scripts', 'htheme_styles', 20 );

#GOOGLE FONTS
function htheme_add_google_fonts(){

	#INSTANTIATE CREATE CSS CLASS
	$htheme_create_css = new htheme_css();

	#ENQUEUE GOOGLE FONTS
	$google_fonts = implode('|', array_unique($htheme_create_css->htheme_google_fonts()));

	$font_url = '';

	#GENERATE URL
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'invogue' ) ) {
		$font_url = add_query_arg( 'family', $google_fonts, "//fonts.googleapis.com/css" );
	}

	return $font_url;

}

#WIDGETS
function htheme_widgets(){

	#REGISTER SIDEBAR - DEFAULT
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'invogue' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'invogue' ),
		'before_widget' => '<div class="htheme_sidebar_container"><div class="htheme_sidebar_source widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	#REGISTER SIDEBAR - SHOP
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar Area', 'invogue' ),
		'id'            => 'htheme-woo-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your shop page sidebar.', 'invogue' ),
		'before_widget' => '<div class="htheme_sidebar_container"><div class="htheme_sidebar_source widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	#REGISTER SIDEBAR - FOOTER AREA (1)
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column (1)', 'invogue' ),
		'id'            => 'htheme-footer-sidebar-one',
		'description'   => esc_html__( 'Add widgets here to appear in your first column in the footer.', 'invogue' ),
		'before_widget' => '<div class="htheme_inner_col"><div class="htheme_footer_content widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="htheme_footer_heading">',
		'after_title'   => '</div>',
	) );

	#REGISTER SIDEBAR - FOOTER AREA (2)
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column (2)', 'invogue' ),
		'id'            => 'htheme-footer-sidebar-two',
		'description'   => esc_html__( 'Add widgets here to appear in your first column in the footer.', 'invogue' ),
		'before_widget' => '<div class="htheme_inner_col"><div class="htheme_footer_content widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="htheme_footer_heading">',
		'after_title'   => '</div>',
	) );

	#REGISTER SIDEBAR - FOOTER AREA (3)
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column (3)', 'invogue' ),
		'id'            => 'htheme-footer-sidebar-three',
		'description'   => esc_html__( 'Add widgets here to appear in your first column in the footer.', 'invogue' ),
		'before_widget' => '<div class="htheme_inner_col"><div class="htheme_footer_content widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="htheme_footer_heading">',
		'after_title'   => '</div>',
	) );

	#REGISTER SIDEBAR - FOOTER AREA (4)
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column (4)', 'invogue' ),
		'id'            => 'htheme-footer-sidebar-four',
		'description'   => esc_html__( 'Add widgets here to appear in your first column in the footer.', 'invogue' ),
		'before_widget' => '<div class="htheme_inner_col"><div class="htheme_footer_content widget %2$s" id="%1$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="htheme_footer_heading">',
		'after_title'   => '</div>',
	) );

}

#HTHEME WIDGET ACTION HOOK
add_action( 'widgets_init', 'htheme_widgets' );

#AJAX URL
function htheme_ajaxurl() {
	?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php
}

#AJAX URL HOOK
add_action('wp_head','htheme_ajaxurl');

#CREATE PAGES
function htheme_create_pages(){

	global $wpdb, $post;

	if (isset($_GET['activated']) && is_admin()){

		#PAGES ARRAY
		$page_array = array(
			array(
				'page_title' => 'Wishlist',
				'page_content' => '',
				'page_template' => 'templates/template.wishlist.php',
			),
		);

		#ADD NEW PAGES
		foreach($page_array as $page){

			#VARIABLES
			$new_page_title = $page['page_title'];
			$new_page_content = $page['page_content'];
			$new_page_template = $page['page_template'];

			#CHECK IF PAGE EXISTS
			$page_check = get_page_by_title($new_page_title);

			#ARRAY
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
			);

			#CHECK AND INSERT NEW PAGE
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

	}

}

add_action('after_setup_theme', 'htheme_create_pages');
