<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO SETTINGS PANEL FOR BACKEND
class htheme_backend{

	#CONSTRUCT
	public function __construct(){}

	#GET BACKEND PAGES
	public function htheme_get_backend_pages(){

		$slug = $_POST['slug'];

		get_template_part( 'htheme/includes/sub', $slug );

		exit();

	}

	#WRITE FILE
	public function htheme_write_file(){

		/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
		$creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

		/* initialize the API */
		if ( ! WP_Filesystem($creds) ) {
			//RESPOND WITH JSON
			echo json_encode('ERROR');
			exit();
		}

		#GLOBALS
		global $wp_filesystem;

		#VARAIBLES
		$directory = get_template_directory() . '/htheme/includes/signups/';
		$signups = explode(',', $_POST['signups']);
		$emails = '';

		foreach($signups as $sign){
			$emails .= $sign . "\r\n";
		}

		#CHECK IF FOLDER EXISTS
		if(!$wp_filesystem->is_dir($directory)){

			#CREATE DIRECTORY
			$wp_filesystem->mkdir($directory);

		}

		#FILE
		$file = $directory . "signups.csv";
		$wp_filesystem->put_contents($file, $emails, FS_CHMOD_FILE);

		//RESPOND WITH JSON
		echo json_encode($emails);
		exit();

	}

	#GET SIGNUP
	public function htheme_get_signups(){

		global $wpdb, $post;
		setup_postdata( $post );

		#GET EMAILS
		$args = array(
			'post_type' => 'signup',
			'numberposts' => -1,
		);

		#GET POSTS
		$the_posts = get_posts($args);
		$signups = [];

		foreach($the_posts as $s){
			$signups[] = $htheme_meta_user_signup_email = get_post_meta($s->ID, 'htheme_meta_user_signup_email', true);
		}

		//RESPOND WITH JSON
		echo json_encode($signups);
		exit();

	}

	#SAVE OPTIONS
	public function htheme_save_options() {

		#POST VARIABLES
		$options = stripslashes_deep($_POST['options']);

		#SERIALIZE
		$serialize = serialize($options);

		#UPDATE OPTION
		update_option( 'hero_theme_options', $serialize );

		//RESPOND WITH JSON
		echo json_encode(unserialize($serialize));
		exit();

	}

	#GET OPTION DATA
	public function htheme_get_options() {

		#GET OPTION DATA
		$options = get_option( 'hero_theme_options' );

		#CONVERT STRING BACK TO ARRAY
		$data = unserialize($options);

		//RESPOND WITH JSON
		echo json_encode($data);
		exit();

	}

	#SET PAGE SHORTCODE
	public function htheme_set_page_shortcode() {

		#VARIABLES
		$id = $_POST['id'];
		$new_content = $this->htheme_get_layout($_POST['layout']);

		#SET ARRAY
		$update_post = array(
			'ID'           => $id,
			'post_content' => $new_content,
		);

		#UPDATE
		wp_update_post( $update_post );

		#RESPOND WITH JSON
		echo json_encode($new_content);
		exit();

	}

	#GET LAYOUT
	public function htheme_get_layout($layout, $data_array = false){

		#VARIABLES
		$content = '';
		$product_ids = '';
		$people_ids = '';
		$testimonial_ids = '';

		#PRODUCT ID'S
		if($data_array && $data_array['product_ids']){
			foreach($data_array['product_ids'] as $id){
				$product_ids .= $id.',';
			}
		} else {
			$product_ids = $this->htheme_get_ids('product', 8);
		}

		#PEOPLE ID'S
		if($data_array && $data_array['people_ids']){
			foreach($data_array['people_ids'] as $id){
				$people_ids .= $id.',';
			}
		} else {
			$people_ids = $this->htheme_get_ids('people', 2);
		}

		#PEOPLE ID'S
		if($data_array && $data_array['testimonial_ids']){
			foreach($data_array['testimonial_ids'] as $id){
				$testimonial_ids .= $id.',';
			}
		} else {
			$testimonial_ids = $this->htheme_get_ids('testimonial', 2);
		}

		switch($layout){
			case 'home_default':
				$content = '[vc_row row_margin="row_margin_top" row_background_color="#ffffff"][vc_column][htheme_title_slug htheme_title_title="SUMMER COLLECTION" htheme_title_devider="zigzag" htheme_title_devider_color="#3a3a3a" htheme_title_excerpt="Style is a way to say who you are without having to speak" htheme_title_layout="default"][/vc_column][/vc_row][vc_row][vc_column][htheme_woolist_slug htheme_woolist_sorting="title" htheme_woolist_layout="contained_multi_caro" htheme_category_align="left" htheme_product_rows="3" htheme_woolist_ids=""][/vc_column][/vc_row][vc_row][vc_column][htheme_banner_slug htheme_banner_title="Banner Title" htheme_banner_excerpt="Lorem ipsum dolor sit amet, consectetur adipiscing elit. " htheme_banner_height="150" htheme_banner_button="true" htheme_banner_image="105" htheme_banner_url="#" htheme_banner_url_target="_blank"][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="HOT THIS MONTH" htheme_title_excerpt="Here are the best sellers for the past few weeks" htheme_title_layout="default"][/vc_column][/vc_row][vc_row][vc_column][htheme_woolist_slug htheme_woolist_sorting="title" htheme_woolist_layout="contained_caro" htheme_woolist_ids=""][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="FROM THE BLOG" htheme_title_layout="side_by_side"][/vc_column][/vc_row][vc_row][vc_column][htheme_blog_slug htheme_blog_category="27"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" row_margin="row_margin_top" row_background_color="#ffffff"][vc_column][htheme_promo_slug htheme_promo_ids=""][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" row_background_color="#ffffff"][vc_column][htheme_imgcarousel_slug htheme_imgcarousel_images="" htheme_image_carousel_layout="full_row" htheme_image_carousel_height="200"][/vc_column][/vc_row]';
				break;
			case 'home_simple':
				$content = '[vc_row][vc_column][htheme_woolist_slug htheme_woolist_sorting="title" htheme_woolist_layout="contained_multi_caro" htheme_category_align="left" htheme_product_rows="4" htheme_woolist_ids=""][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="Clients love us" htheme_title_layout="side_by_side"][/vc_column][/vc_row][vc_row row_padding="row_padding_bottom" row_background_color="#ffffff"][vc_column][htheme_testimonial_slug htheme_testimonial_title="true" htheme_testimonial_rating="true" htheme_testimonial_excerpt="true" htheme_testimonial_ids="'.rtrim($testimonial_ids, ',').'"][/vc_column][/vc_row][vc_row row_margin="row_margin_bottom" row_background_color="#ffffff"][vc_column][htheme_line_slug htheme_line_layout="contained" htheme_line_color="#ffffff"][/vc_column][/vc_row]';
				break;
			case 'home_demo_2':
				$content = '[vc_row][vc_column][htheme_launch_slug htheme_launch_align="center" htheme_pad_launch="%5B%7B%22htheme_pad_title%22%3A%22SUMMER%20WEAR%22%2C%22htheme_pad_excerpt%22%3A%22Look%20at%20our%20latest%20collection%22%2C%22htheme_pad_image%22%3A%22295%22%2C%22htheme_pad_url%22%3A%22http%3A%2F%2Finvogue.heroplugins.com%2Fshop%2F%22%7D%2C%7B%22htheme_pad_title%22%3A%22Latest%20trends%22%2C%22htheme_pad_excerpt%22%3A%22Have%20a%20look%20at%20what\'s%20hot%22%2C%22htheme_pad_image%22%3A%22297%22%2C%22htheme_pad_url%22%3A%22http%3A%2F%2Finvogue.heroplugins.com%2Fwhats-hot%2F%22%7D%2C%7B%22htheme_pad_title%22%3A%22Fragrance%22%2C%22htheme_pad_excerpt%22%3A%22In%20stores%20later%20this%20month%22%2C%22htheme_pad_image%22%3A%22294%22%2C%22htheme_pad_url%22%3A%22%23%22%7D%5D"][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="now in store" htheme_title_layout="side_by_side"][/vc_column][/vc_row][vc_row row_background_color="#ffffff"][vc_column][htheme_woolist_slug htheme_woolist_sorting="title" htheme_woolist_layout="contained_multi_caro" htheme_category_align="left" htheme_product_rows="3" htheme_woolist_ids=""][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="shop categories" htheme_title_layout="side_by_side"][/vc_column][/vc_row][vc_row][vc_column][htheme_woocategory_slug htheme_woocategory_layout="full_width_caro" htheme_woocategory_ids=""][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" row_margin="row_margin_top" row_background_color="#ffffff"][vc_column][htheme_promo_slug htheme_promo_ids="'.rtrim($product_ids, ',').'"][/vc_column][/vc_row]';
				break;
			case 'home_demo_3':
				$content = '[vc_row full_width="stretch_row_content_no_spaces" row_background_color="#ffffff"][vc_column][htheme_woolist_slug htheme_woolist_sorting="title" htheme_woolist_layout="full_width_caro" htheme_woolist_ids=""][/vc_column][/vc_row][vc_row][vc_column][htheme_look_slug htheme_look_looks="%5B%7B%22htheme_look_products%22%3A%22%22%7D%5D"][/vc_column][/vc_row]';
				break;
			case 'about_demo_1':
				$content = '[vc_row][vc_column][htheme_people_slug htheme_people_ids="'.rtrim($people_ids, ',').'"][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="More about us" htheme_title_layout="side_by_side"][/vc_column][/vc_row][vc_row row_margin="none" row_background_color="#ffffff"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla. Sed sagittis augue eget libero tincidunt dapibus. Aenean ac mollis mi. Nullam quis elit non ex imperdiet dapibus porttitor non mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla. Sed sagittis augue eget libero tincidunt dapibus. Aenean ac mollis mi. Nullam quis elit non ex imperdiet dapibus porttitor non mi.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][htheme_imgcarousel_slug htheme_imgcarousel_images="" htheme_image_carousel_size="contain" htheme_image_carousel_layout="contained_row" htheme_image_carousel_height="200"][/vc_column][/vc_row][vc_row][vc_column][htheme_banner_slug htheme_banner_title="we are hiring" htheme_banner_excerpt="Yes you heard right. Chat to us now!" htheme_banner_height="170" htheme_banner_button="true" htheme_banner_image="" htheme_banner_url="" htheme_banner_url_target="_blank"][/vc_column][/vc_row][vc_row][vc_column][htheme_signup_slug htheme_signup_title="WEEKLY NEWSLETTER" htheme_signup_excerpt="Sign up and stay in touch with the latest trends and tips."][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" row_margin="row_margin_top" row_background_color="#ffffff"][vc_column][htheme_instagram_slug htheme_instagram_title="" htheme_instagram_uid="" htheme_instagram_token=""][/vc_column][/vc_row]';
				break;
			case 'what_hot_demo_1':
				$content = '[vc_row row_margin="row_margin_bottom" row_background_color="#ffffff"][vc_column][htheme_topten_slug htheme_topten_ids="'.rtrim($product_ids, ',').'"][/vc_column][/vc_row]';
				break;
			case 'faq_demo_1':
				$content = '[vc_row full_width="stretch_row_content_no_spaces" row_margin="row_margin_top" row_background_color="#ffffff"][vc_column][htheme_banner_slug htheme_banner_title="Banner Title" htheme_banner_excerpt="Please send us a message via our contact page." htheme_banner_height="350" htheme_banner_layout="full_row" htheme_banner_content_position="center" htheme_banner_button="true" htheme_banner_button_text="Contact us" htheme_banner_image="" htheme_banner_url="" htheme_banner_url_target="_self" htheme_banner_btn_position="center"][/vc_column][/vc_row]';
				break;
			case 'contact_demo_1':
				$content = '[vc_row][vc_column][htheme_map_slug htheme_map_enable_zoom="true" htheme_map_center_lat="40.7230303" htheme_map_center_long="-73.9996874" htheme_map_enable_images="true" htheme_map_marker_image="238" htheme_map_styles="ShadesOfGrey" htheme_map_markers="%5B%7B%22htheme_map_enable_marker%22%3A%22true%22%2C%22htheme_map_marker_lat%22%3A%2240.7230303%22%2C%22htheme_map_marker_long%22%3A%22-73.9996874%22%2C%22htheme_map_marker_info%22%3A%22Note%3A%20This%20function%20only%20returns%20results%20from%20the%20default%20%E2%80%9Ccategory%E2%80%9D%20taxonomy.%20For%20custom%20taxonomies%20use%20get_the_terms().%22%7D%5D" htmeme_map_styles="ShadesOfGrey"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_icon type="linecons" icon_linecons="vc_li vc_li-bubble" color="custom" css_animation="appear" custom_color="#2b2b2b"][vc_column_text]Column One Content[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon type="linecons" icon_linecons="vc_li vc_li-location" color="custom" css_animation="appear" custom_color="#2b2b2b"][vc_column_text]Column Two Content[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon type="linecons" icon_linecons="vc_li vc_li-shop" color="custom" css_animation="appear" custom_color="#2b2b2b"][vc_column_text]Column Three Content[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][htheme_line_slug htheme_line_layout="contained" htheme_line_color="#e2e2e2"][/vc_column][/vc_row][vc_row][vc_column][htheme_title_slug htheme_title_title="FEEL FREE TO DROP US AN EMAIL" htheme_title_excerpt="Lorem ipsum dolor sit amet, consectetur adipiscing elit." htheme_title_layout="default"][/vc_column][/vc_row][vc_row row_padding="row_padding_bottom" row_background_color="#ffffff"][vc_column][htheme_contact_slug htheme_contact_subject="Please let us know" htheme_contact_title="FEEL FREE TO DROP US AN EMAIL" htheme_contact_excerpt="Set the subject line for admin response email"][/vc_column][/vc_row]';
				break;
			case 'lookbook_single_1':
				$content = '[vc_row row_margin="row_margin_bottom" row_background_color="#ffffff"][vc_column width="2/3"][vc_column_text]More about the look[/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]Additional info[/vc_column_text][/vc_column][/vc_row][vc_row row_margin="row_margin_bottom" row_background_color="#ffffff"][vc_column][htheme_line_slug htheme_line_layout="full" htheme_line_color="#eeeeee"][/vc_column][/vc_row][vc_row row_padding="row_padding_bottom" row_margin="row_margin_bottom" row_background_color="#ffffff"][vc_column][htheme_lookbooks_slug htheme_lookbooks=""][/vc_column][/vc_row]';
				break;
			case 'people_single_1':
				$content = '[vc_row row_background_color="#ffffff"][vc_column][htheme_title_slug htheme_title_title="More about me" htheme_title_layout="default"][/vc_column][/vc_row][vc_row row_margin="none" row_background_color="#ffffff"][vc_column width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac luctus turpis. Donec egestas, dui non egestas euismod, ligula lectus eleifend metus, vel dignissim quam nunc sit amet quam. Vestibulum vel dictum libero, eu porttitor nulla. Proin ullamcorper leo posuere elit egestas consectetur. Donec arcu metus, mattis sit amet bibendum et, facilisis sit amet purus. Aliquam faucibus nisl pharetra vestibulum euismod. Morbi ac nisl velit. Nullam porttitor mi ut iaculis sagittis.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_column_text]Nullam porttitor mi ut iaculis sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac luctus turpis. Donec egestas, dui non egestas euismod, ligula lectus eleifend metus, vel dignissim quam nunc sit amet quam. Vestibulum vel dictum libero, eu porttitor nulla. Proin ullamcorper leo posuere elit egestas consectetur. Donec arcu metus, mattis sit amet bibendum et, facilisis sit amet purus. Aliquam faucibus nisl pharetra vestibulum euismod. Morbi ac nisl velit.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][htheme_line_slug htheme_line_layout="full" htheme_line_color="#eeeeee"][/vc_column][/vc_row][vc_row row_padding="row_padding_bottom" row_background_color="#ffffff"][vc_column][htheme_blog_slug htheme_blog_category=""][/vc_column][/vc_row]';
				break;
		}

		return $content;

	}

	#GET PAGES
	public function htheme_get_pages(){

		#ARGUMENTS
		$args = array(
			'post_type' => 'page',
			'numberposts' => -1,
			'orderby' => 'name',
			'order' => 'DESC'
		);

		#PAGES
		$pages = get_pages($args);

		#RESPOND WITH JSON
		echo json_encode($pages);
		exit();

	}

	#GET OPTIONS
	public function htheme_generate_options_string(){

		#GET OPTION DATA
		$options = get_option( 'hero_theme_options' );

		#CONVERT STRING BACK TO ARRAY
		$data = unserialize($options);

		#RETURN WITH DATA
		echo json_encode($data);
		exit();

	}

	#GET OPTIONS
	public function htheme_import_options_string(){

		#POST VARIABLES
		$options = $_POST['options'];

		#SERIALIZE
		$serialize = serialize($options);

		#UPDATE OPTION
		update_option( 'hero_theme_options', $serialize );

		//RESPOND WITH JSON
		echo json_encode(unserialize($serialize));
		exit();

	}

	#DEMO INSTALL
	public function htheme_demo_install(){

		global $wpdb, $post;

		#VARIABLES
		$data_array = array(
			'product_ids' => array(),
			'faq_ids' =>  array(),
			'people_ids' =>  array(),
			'testimonial_ids' =>  array(),
			'lookbook_ids' =>  array(),
		);

		#INSTALL - THIS CHECK WHAT DATA MUST BE INSTALLED
		$install_array = array(
			'product' => true,
			'faq' =>  true,
			'people' =>  true,
			'testimonial' =>  true,
			'lookbook' =>  true,
		);

		foreach($install_array as $key => $value){
			$install_array[$key] = $this->htheme_get_status($key);
		}

		#DATA DEMO INSTALL ARRAY
		$posttype_array = array(
			array( #PRODUCTS
				'page_title' => esc_html__('Product One', 'invogue'),
				'page_content' => esc_html__('Product One Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Two', 'invogue'),
				'page_content' => esc_html__('Product Two Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Three', 'invogue'),
				'page_content' => esc_html__('Product Three Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Four', 'invogue'),
				'page_content' => esc_html__('Product Four Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Five', 'invogue'),
				'page_content' => esc_html__('Product Five Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Six', 'invogue'),
				'page_content' => esc_html__('Product Six Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Seven', 'invogue'),
				'page_content' => esc_html__('Product Seven Content', 'invogue'),
				'page_content' => 'Product Seven Content',
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Product Eight', 'invogue'),
				'page_content' => esc_html__('Product Eight Content', 'invogue'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'product',
				'header_settings' => array(),
			),
			array( #FAQ
				'page_title' => esc_html__('Question One', 'invogue'),
				'page_content' => esc_html__('Page Content', 'invogue'),
				'page_template' => '',
				'post_type' => 'faq',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Question Two', 'invogue'),
				'page_content' => esc_html__('Page Content', 'invogue'),
				'page_template' => '',
				'post_type' => 'faq',
				'header_settings' => array(),
			),
			array( #MEMBERS
				'page_title' => esc_html__('John Doe', 'invogue'),
				'page_content' => $this->htheme_get_layout('people_single_1'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'people',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Jane Doe', 'invogue'),
				'page_content' => $this->htheme_get_layout('people_single_1'),
				'page_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat, mauris faucibus ullamcorper accumsan, nisl elit laoreet enim, a ullamcorper metus magna id nulla sed sagittis.',
				'page_template' => '',
				'post_type' => 'people',
				'header_settings' => array(),
			),
			array( #TESTIMONIALS
				'page_title' => esc_html__('John Doe', 'invogue'),
				'page_content' => 'John Doe Testimonial Content',
				'page_template' => '',
				'post_type' => 'testimonial',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Jane Doe', 'invogue'),
				'page_content' => 'Jane Doe Testimonial Content',
				'page_template' => '',
				'post_type' => 'testimonial',
				'header_settings' => array(),
			),
			array( #LOOKBOOKS
				'page_title' => esc_html__('Lookbook Collection One', 'invogue'),
				'page_content' => $this->htheme_get_layout('lookbook_single_1'),
				'page_template' => '',
				'post_type' => 'lookbook',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Lookbook Collection Two', 'invogue'),
				'page_content' => $this->htheme_get_layout('lookbook_single_1'),
				'page_template' => '',
				'post_type' => 'lookbook',
				'header_settings' => array(),
			),
		);

		#LOOP DATA AND CHECK - IF OK INSTALL
		foreach($posttype_array as $data){

			#VARIABLES
			$new_page_title = $data['page_title'];
			$new_page_content = $data['page_content'];
			$new_page_excerpt = '';
			if($data['page_excerpt']){
				$new_page_excerpt = $data['page_excerpt'];
			}
			$new_page_template = $data['page_template'];
			$new_page_type = $data['post_type'];
			$install_status = $install_array[$data['post_type']];
			$new_page_header_settings = $data['header_settings'];

			#IF INSTALL IS TRUE PROCEED
			if($install_status){

				#CHECK IF PAGE EXISTS
				$page_check = get_page_by_title($new_page_title);

				#ARRAY
				$new_page = array(
					'post_type' => $new_page_type,
					'post_title' => esc_html($new_page_title),
					'post_content' => $new_page_content,
					'post_excerpt' => esc_html($new_page_excerpt),
					'post_status' => 'publish',
					'post_author' => 1,
				);

				#CHECK AND INSERT NEW PAGE
				if(!isset($page_check->ID)){

					#NEW PAGE ID
					$new_page_id = wp_insert_post($new_page);

					#POPULATE ID's
					array_push($data_array[$new_page_type.'_ids'], $new_page_id);

					#SET POST META DATA
					$this->htheme_set_meta_data($new_page_type, $new_page_id, $new_page_title, $new_page_header_settings);


					#SET TEMPLATE
					if(!empty($new_page_template)){
						update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
					}

				}

			}

		}

		#PAGE DEMO INSTALL ARRAY - THIS IS RUN AT THE END SO THAT DATA ARRAY CAN BE SETUP WITH ALL THE NECESSARY DATA
		$page_array = array(
			array( #HOME PAGE DEMOS
				'page_title' => esc_html__('Home Demo One', 'invogue'),
				'page_content' => $this->htheme_get_layout('home_default', $data_array),
				'page_template' => 'templates/template.home.php',
				'post_type' => 'page',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Home Demo Simple', 'invogue'),
				'page_content' => $this->htheme_get_layout('home_simple', $data_array),
				'page_template' => 'templates/template.home-noslider.php',
				'post_type' => 'page',
				'header_settings' => array(
					'layout' => 1,
					'row_height' => 350,
					'header_title' => 'Summer Collection',
					'header_sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					'devider' => 'x',
					'devider_color' => '#363636',
				),
			),
			array(
				'page_title' => esc_html__('Home Demo Two', 'invogue'),
				'page_content' => $this->htheme_get_layout('home_demo_2', $data_array),
				'page_template' => 'templates/template.home-noslider.php',
				'post_type' => 'page',
				'header_settings' => array(
					'layout' => 1,
					'fullscreen' => 'true',
					'header_title' => 'Black in fashion',
					'header_sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					'devider' => 'x',
					'devider_color' => '#363636',
					'font_color' => '#363636',
					'background_color' => '#DDDDDD',
				),
			),
			array(
				'page_title' => esc_html__('Home Demo Three', 'invogue'),
				'page_content' => $this->htheme_get_layout('home_demo_3', $data_array),
				'page_template' => 'templates/template.home-noslider.php',
				'post_type' => 'page',
				'header_settings' => array(
					'layout' => 1,
					'row_height' => 650,
					'header_title' => 'Summer Collection',
					'header_sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					'font_color' => '#2B2B2B',
					'font_align' => 'left',
					'background_color' => '#DDDDDD',
					'button_text' => 'Store finder',
				),
			),
			array(
				'page_title' => esc_html__('About us', 'invogue'),
				'page_content' => $this->htheme_get_layout('about_demo_1', $data_array),
				'page_template' => '',
				'post_type' => 'page',
				'header_settings' => array(
					'layout' => 1,
					'row_height' => 650,
					'header_title' => 'About us',
					'header_sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					'font_color' => '#2B2B2B',
					'font_align' => 'left',
					'background_color' => '#DDDDDD',
				),
			),
			array(
				'page_title' => esc_html__('Whats Hot', 'invogue'),
				'page_content' => $this->htheme_get_layout('what_hot_demo_1', $data_array),
				'page_template' => '',
				'post_type' => 'page',
				'header_settings' => array(
					'layout' => 1,
					'row_height' => 350,
					'header_title' => 'What\'s hot this month',
					'header_sub_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					'devider' => 'x',
					'devider_color' => '#363636',
				),
			),
			array(
				'page_title' => esc_html__('Frequently Asked Questions', 'invogue'),
				'page_content' => $this->htheme_get_layout('faq_demo_1', $data_array),
				'page_template' => 'templates/template.faq.php',
				'post_type' => 'page',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Lookbooks', 'invogue'),
				'page_content' =>'',
				'page_template' => 'templates/template.lookbook.php',
				'post_type' => 'page',
				'header_settings' => array(),
			),
			array(
				'page_title' => esc_html__('Contact', 'invogue'),
				'page_content' =>$this->htheme_get_layout('contact_demo_1', $data_array),
				'page_template' => '',
				'post_type' => 'page',
				'header_settings' => array(),
			),
		);

		#LOOP DATA AND CHECK - IF OK INSTALL
		foreach($page_array as $data){

			#VARIABLES
			$new_page_title = $data['page_title'];
			$new_page_content = $data['page_content'];
			$new_page_template = $data['page_template'];
			$new_page_type = $data['post_type'];
			$new_page_header_settings = $data['header_settings'];

			#CHECK IF PAGE EXISTS
			$page_check = get_page_by_title($new_page_title);

			#ARRAY
			$new_page = array(
				'post_type' => $new_page_type,
				'post_title' => esc_html($new_page_title),
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
			);

			#CHECK AND INSERT NEW PAGE
			if(!isset($page_check->ID)){

				#NEW PAGE ID
				$new_page_id = wp_insert_post($new_page);

				#SET POST META DATA
				$this->htheme_set_meta_data($new_page_type, $new_page_id, $new_page_title, $new_page_header_settings);

				#SET TEMPLATE
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}

			}

		}

		#CREATE MENUS
		$this->htheme_create_menus();

		#RETURN STATUS
		echo json_encode($data_array);
		exit();

	}

	#GET THE POST COUNT FOR POST TYPES
	public function htheme_get_status($type){

		#VARIABLES
		$status = true;

		#ARGUMENTS
		$args = array(
			'post_type' => $type,
			'numberposts' => 1,
			'orderby' => 'name',
			'order' => 'DESC'
		);

		#GET POSTS
		$data = get_posts($args);

		#SET TO FALSE IF DATA EXISTS
		if(count($data) > 0){
			$status = false;
		}

		#CHECK WOOCOMMERCE
		if ( $type == 'product' && !class_exists( 'WooCommerce' ) ){
			$status = false;
		}

		#RETURN COUNT
		return $status;

	}

	#GET THE POST COUNT FOR POST TYPES
	public function htheme_get_ids($type, $total){

		#VARIABLES
		$ids = '';

		#ARGUMENTS
		$args = array(
			'post_type' => $type,
			'numberposts' => $total,
			'orderby' => 'name',
			'order' => 'DESC'
		);

		#GET POSTS
		$data = get_posts($args);

		#LOOP DATA AND GET IDS
		foreach($data as $id){
			$ids .= $id->ID.',';
		}

		#RETURN IDS
		return rtrim($ids, ',');

	}

	#GET THE POST COUNT FOR POST TYPES
	public function htheme_set_meta_data($post_type, $ID, $title, $settings){

		#SET
		switch($post_type){
			case 'people':
				update_post_meta($ID, 'htheme_meta_type_position', 'Position');
				update_post_meta($ID, 'htheme_meta_type_facebook', '#');
				update_post_meta($ID, 'htheme_meta_type_twitter', '#');
				update_post_meta($ID, 'htheme_meta_type_pinterest', '#');
				update_post_meta($ID, 'htheme_meta_type_linkd', '#');
				update_post_meta($ID, 'htheme_meta_type_primary_color', '#2B2B2B');
				update_post_meta($ID, 'htheme_meta_type_secondary_color', '#999999');
				update_post_meta($ID, 'htheme_meta_social_primary_color', '#2B2B2B');
				update_post_meta($ID, 'htheme_meta_social_secondary_color', '#999999');
				break;
			case 'page':
				#DEFAULTS
				update_post_meta($ID, 'htheme_meta_height', '350');
				#CHECK SPECIFIC PAGE
				if(!empty($settings)){
					switch($title){
						case 'Home Demo One':
							update_post_meta($ID, 'htheme_meta_height', '650');
							break;
						case 'Home Demo Simple':
							update_post_meta($ID, 'htheme_meta_layout', $settings['layout']);
							update_post_meta($ID, 'htheme_meta_height', $settings['row_height']);
							update_post_meta($ID, 'htheme_meta_title', $settings['header_title']);
							update_post_meta($ID, 'htheme_meta_title_devider', $settings['devider']);
							update_post_meta($ID, 'htheme_meta_title_devider_color', $settings['devider_color']);
							update_post_meta($ID, 'htheme_meta_sub', $settings['header_sub_title']);
							break;
						case 'Home Demo Two':
							update_post_meta($ID, 'htheme_meta_layout', $settings['layout']);
							update_post_meta($ID, 'htheme_meta_fullscreen', $settings['fullscreen']);
							update_post_meta($ID, 'htheme_meta_title', $settings['header_title']);
							update_post_meta($ID, 'htheme_meta_title_devider', $settings['devider']);
							update_post_meta($ID, 'htheme_meta_title_devider_color', $settings['devider_color']);
							update_post_meta($ID, 'htheme_meta_sub', $settings['header_sub_title']);
							update_post_meta($ID, 'htheme_meta_font_color', $settings['font_color']);
							update_post_meta($ID, 'htheme_meta_bg_color', $settings['background_color']);
							break;
						case 'Home Demo Three':
							update_post_meta($ID, 'htheme_meta_layout', $settings['layout']);
							update_post_meta($ID, 'htheme_meta_height', $settings['row_height']);
							update_post_meta($ID, 'htheme_meta_title', $settings['header_title']);
							update_post_meta($ID, 'htheme_meta_sub', $settings['header_sub_title']);
							update_post_meta($ID, 'htheme_meta_font_color', $settings['font_color']);
							update_post_meta($ID, 'htheme_meta_horz', $settings['font_align']);
							update_post_meta($ID, 'htheme_meta_bg_color', $settings['background_color']);
							update_post_meta($ID, 'htheme_meta_btn_text', $settings['button_text']);
							update_post_meta($ID, 'htheme_meta_btn_url', '#');
							break;
						case 'What\'s Hot':
							update_post_meta($ID, 'htheme_meta_layout', $settings['layout']);
							update_post_meta($ID, 'htheme_meta_height', $settings['row_height']);
							update_post_meta($ID, 'htheme_meta_title', $settings['header_title']);
							update_post_meta($ID, 'htheme_meta_title_devider', $settings['devider']);
							update_post_meta($ID, 'htheme_meta_title_devider_color', $settings['devider_color']);
							update_post_meta($ID, 'htheme_meta_sub', $settings['header_sub_title']);
							break;
						case 'About us':
							update_post_meta($ID, 'htheme_meta_layout', $settings['layout']);
							update_post_meta($ID, 'htheme_meta_height', $settings['row_height']);
							update_post_meta($ID, 'htheme_meta_title', $settings['header_title']);
							update_post_meta($ID, 'htheme_meta_sub', $settings['header_sub_title']);
							update_post_meta($ID, 'htheme_meta_font_color', $settings['font_color']);
							update_post_meta($ID, 'htheme_meta_horz', $settings['font_align']);
							update_post_meta($ID, 'htheme_meta_bg_color', $settings['background_color']);
							break;
					}
				}
				break;
			case 'product':
				//update_post_meta($ID, '_sku', 'SKU-'.$ID);
				//update_post_meta($ID, '_regular_price', 1000);
				break;
		}

	}

	#CREATE MENUS
	public function htheme_create_menus(){

		#VARIABLES
		$main_menu_array = array(
			'home' => "Home Demo One",
			'about' => "About Us",
			'lookbook' => "Lookbooks",
			'hot' => "Whats Hot",
			'wishlist' => "Wishlist",
			'contact' => "Contact",
		);
		$footer_menu_array = array(
			'about' => "About Us",
			'contact' => "Contact",
		);

		#CREATE MENUS - MAIN
		if ( !has_nav_menu( 'primary' ) ) {

			// Check if the menu exists
			$menu_name = 'Main Menu';
			$menu_exists = wp_get_nav_menu_object( $menu_name );

			// If it doesn't exist, let's create it.
			if( !$menu_exists){
				$menu_id = wp_create_nav_menu($menu_name);
				foreach($main_menu_array as $key=>$value){
					#GET PAGE
					$page = get_page_by_title( $value );
					#SET PAGE IN MENU
					wp_update_nav_menu_item($menu_id, 0, array(
						'menu-item-title' =>  esc_html($page->post_title),
						'menu-item-url' => get_permalink($page->ID),
						'menu-item-status' => 'publish')
					);
				}
				#SET LOCATION
				$locations = get_theme_mod('nav_menu_locations');
				$menu = get_term_by('name', 'Main Menu', 'nav_menu');
				$locations['primary'] = $menu->term_id;
				set_theme_mod('nav_menu_locations', $locations);
			}

		}

		#CREATE MENUS - FOOTER
		if ( !has_nav_menu( 'footer' ) ) {

			// Check if the menu exists
			$menu_name = 'Footer Menu';
			$menu_exists = wp_get_nav_menu_object( $menu_name );

			// If it doesn't exist, let's create it.
			if( !$menu_exists){
				$menu_id = wp_create_nav_menu($menu_name);
				foreach($footer_menu_array as $key=>$value){
					#GET PAGE
					$page = get_page_by_title( $value );
					#SET PAGE IN MENU
					wp_update_nav_menu_item($menu_id, 0, array(
							'menu-item-title' =>  esc_html($page->post_title),
							'menu-item-url' => get_permalink($page->ID),
							'menu-item-status' => 'publish')
					);
				}
				#SET LOCATION
				$locations = get_theme_mod('nav_menu_locations');
				$menu = get_term_by('name', 'Footer Menu', 'nav_menu');
				$locations['footer'] = $menu->term_id;
				set_theme_mod('nav_menu_locations', $locations);
			}

		}

	}

}