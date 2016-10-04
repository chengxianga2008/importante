<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

	#DEFINE HERO PRIMARY DIRECTORY
	if ( ! defined( 'HEROTHEME_FRAMEWORK_DIR' ) ) {
		define('HEROTHEME_FRAMEWORK_DIR', get_template_directory_uri() . '/htheme/');
	}

	#CLASSES
	require_once(get_template_directory() . '/htheme/classes/class.tgm.php');
	require_once(get_template_directory() . '/htheme/classes/class.options.php');
	require_once(get_template_directory() . '/htheme/classes/class.settings.php');
	require_once(get_template_directory() . '/htheme/classes/class.check.php');
	require_once(get_template_directory() . '/htheme/classes/class.forms.php');

	#WOOCOMMERCE
	if ( class_exists( 'WooCommerce' ) ){
		require_once(get_template_directory() . '/htheme/classes/class.get.woo.php');
	}

	#CLASSES
	require_once(get_template_directory() . '/htheme/classes/class.get.content.php');
	require_once(get_template_directory() . '/htheme/classes/class.backend.php');
	require_once(get_template_directory() . '/htheme/classes/class.ajax.php');
	require_once(get_template_directory() . '/htheme/classes/class.css.php');
	require_once(get_template_directory() . '/htheme/classes/class.js.php');
	require_once(get_template_directory() . '/htheme/classes/functions.setup.php');
	require_once(get_template_directory() . '/htheme/classes/class.frontend.php');
	require_once(get_template_directory() . '/htheme/classes/class.meta.php');

	#VISUAL COMPOSER
	if ( defined( 'WPB_VC_VERSION' ) ) {
		require_once(get_template_directory() . '/htheme/classes/class.composer.php');
	}

	#WIDGETS
	require_once(get_template_directory() . '/htheme/classes/class.widgets.php');
	require_once(get_template_directory() . '/htheme/classes/class.widgets.instagram.php');

	#THEME INCLUDES
	require_once(get_template_directory() . '/htheme/classes/helper/check.helper.php');
	require_once(get_template_directory() . '/htheme/classes/management/activate_theme.class.php');
	require_once(get_template_directory() . '/htheme/classes/management/update_theme.class.php');
	require_once(get_template_directory() . '/htheme/classes/core/checkin.class.php');
	require_once(get_template_directory() . '/htheme/classes/core/update_object.class.php');

	#THEME ROOT INVOGUE
	class htheme_invogue{

		#THEME CONFIG
		private $theme_name = 'invogue';
		private $theme_slug = 'invogue';
		private $theme_friendly_name = 'InVogue';
		private $theme_version = '1.11.1';
		private $api_version = '1.0.0';

		#CLASS VARS
		private $theme_old_version = NULL;
		private $theme_uuid;

		#CONSTRUCT
		public function __construct(){

			#INSTANTIATE
			global $htheme_helper;
			$htheme_helper = new htheme_helper();

			#DETECT IF UPDATE IS REQUIRED
			global $wpdb;
			if($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->base_prefix."htheme_root")) == $wpdb->base_prefix ."htheme_root") {
				if($this->theme_old_version == NULL){
					$theme_lookup = $wpdb->get_results($wpdb->prepare("SELECT * FROM `". $wpdb->base_prefix ."htheme_root` WHERE `theme_name` = %s;", $this->theme_name));
					if($theme_lookup){
						$this->theme_old_version = $theme_lookup[0]->theme_version;
						$this->theme_uuid = $theme_lookup[0]->theme_uuid; //define theme uuid for check-in
					}
					if(version_compare($this->theme_old_version,$this->theme_version,'<')){
						$update = new htheme_update_theme($this->theme_name,$this->theme_version,$this->theme_old_version);
						$update->htheme_update_theme();
					}
				}
			}

			//queue update check
			$checkin = new htheme_checkin($this->theme_slug, $this->theme_name,$this->theme_friendly_name,$this->api_version);
			add_filter('pre_set_site_transient_update_themes', array(&$checkin, 'htheme_check_in'));
		}

		//activate theme
		public function htheme_activate_theme(){
			$activate = new htheme_activate($this->theme_name, $this->theme_version);
			$activate->htheme_setup_theme();
		}

	}

	#THEME SETUP
	$htheme_options = new htheme_options();
	$htheme_settings = new htheme_settings();
	$htheme_check = new htheme_check();
	$htheme_forms = new htheme_forms();

	$htheme_woo = NULL;
	if ( class_exists( 'WooCommerce' ) ){
		$htheme_woo = new htheme_getwoo(); //this instance can be used by WP for ajax implementations
	}

	$htheme_backend = new htheme_backend(); //this instance can be used by WP for ajax implementations
	$htheme_ajax = new htheme_ajax($htheme_backend, $htheme_woo, $htheme_forms);
	$htheme_frontend = new htheme_frontend();
	$htheme_meta = new htheme_meta();

	#INITIALISE INVOGUE CORE
	$htheme = new htheme_invogue();

	#INITIALISE ACTIVATION HOOK
	add_action('after_switch_theme', array(&$htheme, 'htheme_activate_theme'));

	/**
	 * TGM ACTIVATION
	 */

	add_action( 'tgmpa_register', 'htheme_register_required_plugins' );

	function htheme_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'               => 'inVogue Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/htheme/plugins/js_composer.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name'               => 'inVogue Slider Revolution', // The plugin name.
				'slug'               => 'revslider', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/htheme/plugins/revslider.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name' 		=> 'Woocommerce',
				'slug' 		=> 'woocommerce',
				'required' 	=> false,
			),
			array(
				'name'               => 'Hero Utility Plugin', // The plugin name.
				'slug'               => 'hutility', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/htheme/plugins/hutility.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
		);
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);
		tgmpa( $plugins, $config );
	}

	/**
	 * ALTER POST THUMBNAIL OUTPUT
	 */

	#USED TO CHECK IF PLUGIN IS ACTIVE
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	function htheme_modify_post_thumbnail_html(){

		$id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
		$src = wp_get_attachment_image_src($id, 'large'); // gets the image url specific to the passed in size (aka. custom image size)

		if(class_exists( 'WooCommerce' ) && is_product() && is_plugin_active('yith-woocommerce-zoom-magnifier/init.php')){

			return '<img src="'.$src[0].'">';

		} else {

			return $src[0];

		}

	}

	if(!isset($_GET['post_type'])){
		add_filter('post_thumbnail_html', 'htheme_modify_post_thumbnail_html', 99, 3);
	}

	/**
	 * ADD CLASS TO BODY CLASS
	 */

	function htheme_add_classes($classes){

		if ( class_exists( 'WooCommerce' ) ){
			$classes[] = esc_attr( 'htheme_woo_ajax_check' );
		}

		return $classes;

	}

	add_filter( 'body_class', 'htheme_add_classes' );

	/**
	 * REGISTER WIDGET
	 */

	add_action( 'widgets_init', 'htheme_register_widget' );
	function htheme_register_widget() {
		register_widget( 'htheme_widgets' );
		register_widget( 'htheme_widgets_instagram' );
	}

	/*
	 * SET GLOBALS
	 */

	add_action( 'parse_query', 'htheme_set_globals' );
	function htheme_set_globals(){

		global $htheme_global_object, $htheme_frontend;

		$htheme_global_object = $htheme_frontend->htheme_get_options();

	}

	/*
	 * WOOCOMMERCE
	 */

	# CHANGE SINGLE PRODUCT SUMMARY HTML LAYOUT
	add_action( 'woocommerce_before_single_product_summary', 'htheme_product_summary', 35);
	function htheme_product_summary() {
		echo '<div class="htheme_col_4">';
	}

	add_action( 'woocommerce_after_single_product_summary',  'htheme_close', 4);
	function htheme_close() {
		echo '</div>';
	}

	# CHANGE SINGLE PRODUCT IMAGE HTML LAYOUT
	add_action( 'woocommerce_before_single_product_summary', 'htheme_product_single_image', 8);
	add_action( 'woocommerce_before_single_product_summary',  'htheme_close', 29);
	function htheme_product_single_image() {
		echo '<div class="htheme_col_8">';
	}

	#REMOVE ACTIONS
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating',10);

	#RE-ADD ACTIONS
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating',25);

	#ADD ADDITIONAL WOO TEMPLATES
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_social_htheme', 4 ); #SINGLE PRODUCT SOCIAL ROW
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_info_htheme', 11 ); #PRODUCT INFO

	if ( ! function_exists( 'woocommerce_template_social_htheme' ) ) {

		/**
		 * Output the product social items.
		 *
		 * @subpackage	Product
		 */
		function woocommerce_template_social_htheme() {
			wc_get_template( 'single-product/htheme_social.php' );
		}

		/**
		 * Output the product info row.
		 *
		 * @subpackage	Product
		 */
		function woocommerce_template_info_htheme() {
			wc_get_template( 'single-product/htheme_product_info.php' );
		}

	}

	#MODIFY PRODUCT-CONTENT
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); #REMOVE STANDARD TAGS (SALE etc)
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); #REMOVE STANDARD PRODUCT IMAGE
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

	add_action('woocommerce_before_shop_loop_item_title', 'htheme_product_thumbnail_with_all_content', 10 ); #ADD NEW IMAGE AND CONTENT

	function htheme_product_thumbnail_with_all_content(){

		#GLOBALS
		global $product;

		#INSTANTIATE
		$htheme_woo = new htheme_getwoo();

		#ECHO HTML
		echo $htheme_woo->htheme_get_content_product($product->post);

	}

	#MODIFY ARCHIVE CONTENT
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	#ADD ACTIONS - (SIDEBAR)
	add_action('htheme_get_categories', 'htheme_output_categories', 5 ); #ADD SIDEBAR CATEGORIES

	function htheme_output_categories(){

		//ARGUMENTS
		$args = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		$the_categories = get_categories($args);

		$product_categories = htheme_get_cat_tree(0,$the_categories);

		if($product_categories){

			echo htheme_get_category_html($product_categories);

		}

	}

	function htheme_get_cat_tree($parent,$categories) {
		$result = array();
		foreach($categories as $category){
			if ($parent == $category->category_parent) {
				$category->children = htheme_get_cat_tree($category->cat_ID,$categories);
				$result[] = $category;
			}
		}
		return $result;
	}

	function htheme_get_category_html($categories){

		$html = '';

		$query_obj = get_queried_object();

		$html .= '<ul>';

			foreach($categories as $cat){
				if($query_obj->slug == $cat->slug){
					$html .= '<li><a class="htheme_active_category" href="'.esc_url(get_category_link( $cat )).'">' . $cat->name . ' <span class="htheme_product_count">'.$cat->count.'</span></a>';
				} else {
					$html .= '<li><a href="'.esc_url(get_category_link( $cat )).'">' . $cat->name . ' <span class="htheme_product_count">'.$cat->count.'</span></a>';
				}

				if($cat->children){
					$html .= htheme_get_category_html($cat->children);
					$html .= '</li>';
				} else {
					$html .= '</a></li>';
				}
			}
		$html .= '</ul>';

		return $html;

	}

	function htheme_output_orderby(){

		#SIDEBAR
		$sidebar = $GLOBALS['htheme_global_object']['settings']['woocommerce']['shopLayout'];

		#GET ORDERBY
		$order_by = $_GET['orderby'];

		?>
			<div class="htheme_filter_select_item">
				<div class="htheme_filter_label"><?php esc_html_e('Order by', 'invogue'); ?></div>
				<select name="orderby" id="orderby" class="htheme_generate_select">
					<option value="menu_order" <?php echo ($order_by == 'menu_order') ? 'selected' : ''; ?>><?php esc_html_e('Default sorting', 'invogue'); ?></option>
					<option value="popularity" <?php echo ($order_by == 'popularity') ? 'selected' : ''; ?>><?php esc_html_e('Sort by popularity', 'invogue'); ?></option>
					<option value="rating" <?php echo ($order_by == 'rating') ? 'selected' : ''; ?>><?php esc_html_e('Sort by average rating', 'invogue'); ?></option>
					<option value="date" <?php echo ($order_by == 'date') ? 'selected' : ''; ?>><?php esc_html_e('Sort by newness', 'invogue'); ?></option>
					<option value="price" <?php echo ($order_by == 'price') ? 'selected' : ''; ?>><?php esc_html_e('Sort by price: low to high', 'invogue'); ?></option>
					<option value="price-desc" <?php echo ($order_by == 'price-desc') ? 'selected' : ''; ?>><?php esc_html_e('Sort by price: high to low', 'invogue'); ?></option>
				</select>
			</div>
		<?php

	}

	function htheme_output_attribute_filter(){

		#GLOBALS
		global $product, $post;

		#SETUP
		setup_postdata( $post );

		$taxonomies = wc_get_attribute_taxonomies();

		#GER VARAIBLES
		$get_array = $_GET['htheme_select_box'];

		#SIDEBAR
		$sidebar = $GLOBALS['htheme_global_object']['settings']['woocommerce']['shopLayout'];

		?>
		<?php
		if($sidebar == 'no_sidebar'){
			do_action('htheme_get_orderby');
		}
		foreach($taxonomies as $tax){
			#IF GET IS AVAILABLE CHECK WHAT THE CURRENT SELCT VALUE IS
			$current_value = $get_array['pa_'.$tax->attribute_name];
			?>
				<?php if($sidebar == 'with_sidebar'){ ?> <!-- WITH SIDE BAR -->
					<div class="htheme_sidebar_container">
						<h2><?php echo esc_html($tax->attribute_label); ?></h2>
				<?php } else if($sidebar == 'no_sidebar'){ ?> <!-- NO SIDE BAR -->
					<div class="htheme_filter_select_item">
						<div class="htheme_filter_label"><?php echo esc_html($tax->attribute_label); ?></div>
				<?php } ?>
					<?php if($sidebar == 'with_sidebar'){ ?><div class="htheme_sidebar_source"><?php } ?>
						<select name="htheme_select_box[<?php echo 'pa_'.$tax->attribute_name; ?>]" class="htheme_generate_select" id="<?php echo 'pa_'.$tax->attribute_name ?>">
							<option value="all"><?php esc_html_e('All', 'invogue'); ?></option>
							<?php
							$terms = get_terms('pa_'.$tax->attribute_name);
							foreach($terms as $term){
								if($term->term_id == $current_value){
									?>
										<option selected value="<?php echo esc_attr($term->term_id); ?>"><?php echo $term->name; ?></option>
									<?php
								} else {
									?>
										<option value="<?php echo esc_attr($term->term_id); ?>"><?php echo $term->name; ?></option>
									<?php
								}
							}
							?>
						</select>
						<?php if($sidebar == 'with_sidebar'){ ?></div><?php } ?>
				<?php if($sidebar == 'with_sidebar' || $sidebar == 'no_sidebar'){ ?>
					</div>
				<?php } ?> <!-- CLOSING DIV -->
			<?php
		}
		?>

		<?php

	}

	//CHANGE THE BREADCRUMB
	add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
	function jk_change_breadcrumb_home_text( $defaults ) {

		if(is_product()){ #SINGLE PRODUCT
			$defaults['home'] = 'Shop';
			$defaults['delimiter'] = ' &rsaquo; ';
		}

		return $defaults;

	}

	add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
	function woo_custom_breadrumb_home_url() {

		if(is_product()){ #SINGLE PRODUCT
			$shop_page_url = get_permalink(wc_get_page_id('shop'));
			return $shop_page_url;
		}

	}

	#LOGOUT REDIRECT
	add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

	#SHOP FILTER AND TITLE CHANGE
	add_action( 'pre_get_posts', 'htheme_check_query' );
	function htheme_check_query( $query ) {

		if ( isset($_GET['get_title']) && $query->is_main_query() ) {
			$query->set('post__in', explode(',', $_GET['get_look_products']));
		}

	}

	#SEARCH FORM
	function htheme_wpdocs_my_search_form( $form ) {

		$form = '
		<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<input type="text" value="' . get_search_query() . '" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'invogue' ) .'" />
			<label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'invogue' ) . '</label>
		</form>';

		return $form;
	}

	#COOKIES

	add_action( 'init', 'htheme_signup_cookie' );
	function htheme_signup_cookie() {

		if(!isset($_COOKIE['show_signup'])){
			setcookie( 'show_signup', 'show', time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false );
		}

	}

	#FILTER FOR EXCERPT
	add_filter( 'excerpt_more', 'htheme_wpdocs_excerpt_more' );
	function htheme_wpdocs_excerpt_more( $more ) {
		return '';
	}

	#POST FILTER
	add_action('htheme_get_post_filter', 'htheme_get_post_filter', 5 ); #ADD NEW IMAGE AND CONTENT
	function htheme_get_post_filter(){

		#QUERIED OBJECT
		$get_category_obj = get_queried_object();
		$check_val = '';

		if($get_category_obj){
			$check_val = get_term_link($get_category_obj->term_id);
		}

		#VARIABLES
		$categories = get_terms( 'category', 'orderby=count&hide_empty=0' );

		if($categories){
		?>
		<!-- ROW -->
		<div class="htheme_row htheme_no_padding htheme_filter_row">
			<div class="htheme_container">
				<!-- CATEGORY FILTER -->
				<div class="htheme_inner_col">
					<div class="htheme_filter_holder">
						<div class="htheme_filter_right">
							<div class="htheme_filter_select_item">
								<select name="orderby" id="orderby" class="htheme_generate_select" data-type="blog_filter">
									<option value="<?php echo esc_attr( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php echo esc_html__('Show All', 'invogue'); ?></option>
									<?php
										foreach($categories as $cat){
											if($check_val == get_term_link($cat->term_id)){
									?>
											<option selected value="<?php echo esc_attr(get_term_link($cat->term_id)); ?>"><?php echo $cat->name; ?></option>
									<?php
											} else {
									?>
											<option value="<?php echo esc_attr(get_term_link($cat->term_id)); ?>"><?php echo $cat->name; ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<!-- CATEGORY FILTER -->
			</div>
		</div>
		<!-- ROW -->
		<?php
		}

	}

	#ALTER WIDGET RECENT REVIEWS
	add_action( 'widgets_init', 'htheme_override_woocommerce_widgets', 15 );

	function htheme_override_woocommerce_widgets() {

	  if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
		unregister_widget( 'WC_Widget_Recent_Reviews' );
		include_once( get_template_directory() . '/woocommerce/widgets/widget.class.recent.review.php' );
		register_widget( 'htheme_recentreviews' );
	  }

	}

	#CUSTOM COMMENTS
	function htheme_format_comment($comment, $args, $depth){

		//print_r($comment->comment_author_email);
		$image =  get_avatar_url( $comment, 'small' );
		?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div class="htheme_comment_image" style="background-image:url(<?php echo esc_url($image); ?>);"></div>
			<div class="htheme_comment_content">
				<h5 class="htheme_comment_name"><?php printf(esc_html__('%s', 'invogue'), get_comment_author_link()) ?></h5>
				<span class="htheme_comment_date htheme_h5_sub"><a class="comment-permalink" href="<?php echo esc_url( htmlspecialchars ( get_comment_link( $comment->comment_ID ) ) ); ?>"><?php printf(esc_html__('%1$s', 'invogue'), get_comment_date(), get_comment_time()) ?></a></span>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.', 'invogue') ?></em><br />
				<?php endif; ?>
				<div class="htheme_default_content"><?php comment_text(); ?></div>
				<div class="reply htheme_h5_sub">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</li>

		<?php
	}

	#ALTER TITLES
	add_filter( 'get_the_archive_title', function ($title) {
		if ( is_post_type_archive() ) {
			 $title = sprintf( esc_html__( '%s', 'invogue' ), post_type_archive_title( '', false ) );
		}
		return $title;
	});

	#ALTER SEARCH
	function htheme_search_filter($query) {
		if ( !$query->is_admin && $query->is_search) {
			$query->set('post_type', array('post','pages','faq','product') ); // id of page or post
		}
		return $query;
	}

	add_filter( 'pre_get_posts', 'htheme_search_filter' );

	#PRODUCT CATEGORIES

	remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );

	add_action('woocommerce_before_subcategory_title', 'htheme_list_category_image', 10 ); #ADD NEW IMAGE AND CONTENT
	add_action('woocommerce_shop_loop_subcategory_title', 'htheme_list_category_title', 10 ); #ADD NEW IMAGE AND CONTENT

	function htheme_list_category_image($category){

		#VARABLES
		$term = get_term(intval($category->term_id), 'product_cat', array("fields" => "ids"));
		$thumbnail_id = get_woocommerce_term_meta( intval($category->term_id), 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );

		#IF NO CATEGORY IMAGE
		$no_img = '';
		if(!$image){
			$no_img = 'htheme_no_category_img';
		}

		?>
		<div class="htheme_inner_col <?php echo esc_attr($no_img); ?>" style="background-image:url(<?php echo esc_url($image); ?>)"></div>
		<?php

	}

	function htheme_list_category_title($category){

		#VARABLES
		$term = get_term(intval($category->term_id), 'product_cat', array("fields" => "ids"));

		?>
		<div class="htheme_product_list_content">
			<div class="htheme_inner_col">
				<div class="htheme_product_list_title">
					<?php
						echo esc_html($category->name);
					?>
					<div class="htheme_category_count">
						<?php
							echo esc_html($category->count);
						?>
					</div>
				</div>
			</div>
		</div>
		<?php

	}

	#ENABLE EXCERPT
	add_filter('default_hidden_meta_boxes', 'htheme_show_hidden_meta_boxes', 10, 2);

	function htheme_show_hidden_meta_boxes($hidden, $screen) {
		if ( 'post' == $screen->base ) {
			foreach($hidden as $key=>$value) {
				if ('postexcerpt' == $value) {
					unset($hidden[$key]);
					break;
				}
			}
		}
		return $hidden;
	}

	#WPML POST TRANSLATIONS
	function htheme_show_lang_available(){
		if ( function_exists('icl_object_id') ) {
			$languages = icl_get_languages('skip_missing=1');
			if(1 < count($languages)){
			echo '<div class="htheme_post_languages">';
				echo esc_html__('This post is also available in: ', 'invogue');
				foreach($languages as $l){
					if(!$l['active']) $langs[] = '<a href="'.esc_url($l['url']).'">'.esc_html($l['translated_name']).'</a>';
				}
				echo join(', ', $langs);
			echo '</div>';
			}
		}
	}

	#ENABLE EXCERPT
	add_action('icl_post_languages', 'htheme_show_lang_available', 10, 3);