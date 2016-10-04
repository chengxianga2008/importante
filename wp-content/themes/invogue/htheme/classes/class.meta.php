<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO SETUP FOR METABOXES
class htheme_meta{

	#CONSTRUCT
	public function __construct(){

		#CUSTOM METABOXES FOR PAGES AND PRODUCTS
		add_action( 'add_meta_boxes', array($this, 'htheme_add_metabox') );
		add_action( 'save_post', array( $this, 'htheme_save_metabox' ) );

		#CUSTOM USER PROFILE FIELDS
		add_action( 'show_user_profile', array( $this, 'htheme_custom_user_fields') );
		add_action( 'edit_user_profile', array( $this, 'htheme_custom_user_fields') );
		add_action( 'personal_options_update',  array( $this, 'htheme_save_custom_user_fields') );
		add_action( 'edit_user_profile_update',  array( $this, 'htheme_save_custom_user_fields') );

	}

	/*
	 * CUSTOM PAGE/PRODUCT METABOXES
	 */

	#ADD METABOX
	public function htheme_add_metabox( $post_type ) {

		#ADD METABOX TO THE FOLLOWING
		$types = array('page', 'lookbook');

		#PAGE & POST TYPE META
		if(in_array($post_type, $types)){
			add_meta_box(
				'htheme_heading_meta'
				, esc_html__('Header Settings', 'invogue')
				, array($this, 'htmeme_output_metabox')
				, $post_type
				, 'normal'
				, 'low'
			);
		}

		#PRODUCT METABOX
		if ( in_array( $post_type, array('product') )) {
			add_meta_box(
				'htheme_heading_meta'
				,__( 'Additional Image Upload', 'invogue' )
				,array( $this, 'htmeme_output_product_metabox' )
				,$post_type
				,'advanced'
				,'high'
			);
		}

		#PRODUCT METABOX
		if ( in_array( $post_type, array('product') )) {
			add_meta_box(
				'htheme_additional_meta'
				,__( 'Additional Product Settings', 'invogue' )
				,array( $this, 'htmeme_output_additional_metabox' )
				,$post_type
				,'advanced'
				,'high'
			);
		}

	}

	#RENDER METABOX
	public function htmeme_output_metabox( $post ) {

		// ADD NONCE
		wp_nonce_field( 'htheme_inner_custombox', 'htheme_inner_custombox_nonce' );

		// USER get_post_meta TO GET AN EXISTING VALUE FROM DB
		$htheme_meta_layout = get_post_meta( $post->ID, 'htheme_meta_layout', true );
		if($htheme_meta_layout == ''){
			$htheme_meta_layout = 1;
		}
		$htheme_meta_background_image = get_post_meta( $post->ID, 'htheme_meta_image', true );
		$htheme_meta_fullscreen = get_post_meta( $post->ID, 'htheme_meta_fullscreen', true );
		$htheme_meta_title = get_post_meta( $post->ID, 'htheme_meta_title', true );
		$htheme_meta_title_devider = get_post_meta( $post->ID, 'htheme_meta_title_devider', true );

		$htheme_meta_btn_text = get_post_meta( $post->ID, 'htheme_meta_btn_text', true );
		$htheme_meta_btn_url = get_post_meta( $post->ID, 'htheme_meta_btn_url', true );
		$htheme_meta_btn_target = get_post_meta( $post->ID, 'htheme_meta_btn_target', true );
		if($htheme_meta_btn_target == ''){
			$htheme_meta_btn_target = '_blank';
		}
		$htheme_meta_sub_title = get_post_meta( $post->ID, 'htheme_meta_sub', true );
		$htheme_meta_horz = get_post_meta( $post->ID, 'htheme_meta_horz', true );
		$htheme_meta_bg_position = get_post_meta( $post->ID, 'htheme_meta_bg_position', true );
		$htheme_meta_header_color = get_post_meta( $post->ID, 'htheme_meta_bg_color', true );
		if($htheme_meta_header_color == ''){
			$htheme_meta_header_color = '#FFFFFF';
		}
		$htheme_meta_font_color = get_post_meta( $post->ID, 'htheme_meta_font_color', true );
		if($htheme_meta_font_color == ''){
			$htheme_meta_font_color = '#2B2B2B';
		}
		$htheme_meta_height = get_post_meta( $post->ID, 'htheme_meta_height', true );
		$htheme_meta_shortcode = get_post_meta( $post->ID, 'htheme_meta_shortcode', true );

		$htheme_meta_top_padding = get_post_meta( $post->ID, 'htheme_meta_top_padding', true );
		if($htheme_meta_top_padding == ''){
			$htheme_meta_top_padding = 'yes';
		}

		echo '<script>';
			echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		echo '<div class="htheme_metabox_holder">';

		//ROW LAYOUT
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_12">';
				echo '<div class="htheme_label">'.esc_html__('Background layout', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Select which type of header layout you would like for your current page.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_12">';
				echo '<div class="htheme_meta_layout">';
					echo '<div class="htheme_meta_layout_selector" data-value="1" id="htheme_meta_layout_1"></div>';
					//echo '<div class="htheme_meta_layout_selector" data-value="2" id="htheme_meta_layout_2"></div>';
					echo '<div class="htheme_meta_layout_selector" data-value="3" id="htheme_meta_layout_3"></div>';
					//HIDDEN INPUT
					echo '<input type="hidden" name="htheme_meta_layout" id="htheme_meta_layout" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_layout ) . '">';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		//ROW BACKGROUND IMAGE
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Background image upload', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results. Click "Browse" to upload and then "Insert into Post".', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				echo '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="htheme_meta_image" data-multiple="false" data-size="full">';
					echo 'Upload';
				echo '</div>';
				//HIDDEN INPUT
				echo '<input type="hidden" name="htheme_meta_image" id="htheme_meta_image" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_background_image ) . '">';
			echo '</div>';
			echo '<div class="htheme_form_col_12">';
				echo '<div class="htheme_image_holder" id="image_htheme_meta_image"></div>';
				echo '<span class="htheme_remove_image" data-input="htheme_meta_image">'.esc_html__('Remove', 'invogue').' [X]</span>';
			echo '</div>';
		echo '</div>';

		//BACKGROUND POSITION
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Background position', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Set the positioning of your background.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//SELECT
		echo '<select name="htheme_meta_bg_position" id="htheme_meta_bg_position" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_bg_position ) . '">';
		$options_meta_position = array("center", "left", "right", "bottom", "top");
		foreach($options_meta_position as $option){
			echo '<option '.selected( esc_attr( $htheme_meta_bg_position ), $option ).' value="'.$option.'">'.esc_html($option).'</option>';
		}
		echo '</select>';
		echo '</div>';
		echo '</div>';

		//ROW FULLSCREEN HEIGHT
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Fullscreen height', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the header to be the height of the current window.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				?>
					<input type="checkbox" <?php checked( esc_attr( $htheme_meta_fullscreen ), 'true' ); ?> name="htheme_meta_fullscreen" id="htheme_meta_fullscreen" value="true">
				<?php
			echo '</div>';
		echo '</div>';

		//ROW TITLE
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Row Height', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Set the height for your row.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//INPUT
		echo '<input type="text" name="htheme_meta_height" id="htheme_meta_height" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_height ) . '">';
		echo '</div>';
		echo '</div>';

		//ROW TITLE
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header title', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the page header.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input type="text" name="htheme_meta_title" id="htheme_meta_title" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_title ) . '">';
			echo '</div>';
		echo '</div>';

		//DEVIDER
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Title/Excerpt divider', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Set the divider for your title element.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//SELECT
		echo '<select name="htheme_meta_title_devider" id="htheme_meta_title_devider" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_title_devider ) . '">';
		$options_meta_deviders = array("none", "zigzag", "hearts", "diagonal", "line", "plus", "circles", "spiral", "x");

		foreach($options_meta_deviders as $option){
			echo '<option '.selected( esc_attr( $htheme_meta_title_devider ), $option ).' value="'.esc_attr($option).'">'.esc_html($option).'</option>';
		}
		echo '</select>';
		echo '</div>';
		echo '</div>';

		//ROW SUB HEADING
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header sub title', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the sub page header.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input type="text" name="htheme_meta_sub" id="htheme_meta_sub" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_sub_title ) . '">';
			echo '</div>';
		echo '</div>';

		//ROW BUTTON TEXT
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header button text', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the button display text. (Button wont show if empty)', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input type="text" name="htheme_meta_btn_text" id="htheme_meta_btn_text" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_btn_text ) . '">';
			echo '</div>';
		echo '</div>';

		//ROW BUTTON URL
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header button url', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the button url. (Button wont show if empty)', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input type="text" name="htheme_meta_btn_url" id="htheme_meta_btn_text_url" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_btn_url ) . '">';
			echo '</div>';
		echo '</div>';

		//ROW TITLE
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Header button target', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Set the target location for your url.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		echo '<div class="htheme_label">'.esc_html__('Target', 'invogue').'</div>';
		//SELECT
		echo '<select name="htheme_meta_btn_target" id="htheme_meta_btn_target" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_btn_target ) . '">';
		$options_meta_target = array("_blank", "_self");
		foreach($options_meta_target as $option){
			echo '<option '.selected( esc_attr( $htheme_meta_btn_target ), $option ).' value="'.esc_attr($option).'">'.esc_html($option).'</option>';
		}
		echo '</select>';
		echo '</div>';
		echo '</div>';

		//ROW TITLE
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header Content Alignment', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the position and alignment for your header content.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				echo '<div class="htheme_label">'.esc_html__('Horizontal Alignment', 'invogue').'</div>';
				//SELECT
				echo '<select name="htheme_meta_horz" id="htheme_meta_horz" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_horz ) . '">';
					$options_meta_horz = array("center", "left", "right");
					foreach($options_meta_horz as $option){
						echo '<option '.selected( esc_attr( $htheme_meta_horz ), $option ).' value="'.esc_attr($option).'">'.esc_html($option).'</option>';
					}
				echo '</select>';
			echo '</div>';
		echo '</div>';

		//HEADER BACKGROUND COLOR
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header Background Color', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the background color for your header.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input name="htheme_meta_bg_color" id="htheme_meta_bg_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_header_color ) . '">';
			echo '</div>';
		echo '</div>';

		//HEADER FONT COLOR
		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_3">';
				echo '<div class="htheme_label">'.esc_html__('Header Font Color', 'invogue').'</div>';
				echo '<div class="htheme_label_excerpt">'.esc_html__('Set the font color for your header.', 'invogue').'</div>';
			echo '</div>';
			echo '<div class="htheme_form_col_9">';
				//INPUT
				echo '<input name="htheme_meta_font_color" id="htheme_meta_font_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_font_color ) . '">';
			echo '</div>';
		echo '</div>';

		//ROW SHORTCODE
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Slider shortcode', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Replace current header layout with a custom slider shortcode.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//INPUT
		echo '<input type="text" name="htheme_meta_shortcode" id="htheme_meta_shortcode" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_shortcode ) . '"><span style="font-size:12px;" class="htheme_red">(Please take note: This overwrites background layout selection and Home Slider)</span>';
		echo '</div>';
		echo '</div>';

		//HEADER PADDING TOP
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Header bottom padding', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Enable/disable header bottom padding.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//SELECT
		echo '<select name="htheme_meta_top_padding" id="htheme_meta_top_padding" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_top_padding ) . '">';
		$options_meta_padding = array("yes" => "Enable", "no" => "Disable");
		foreach($options_meta_padding as $key=>$option){
			echo '<option '.selected( esc_attr( $htheme_meta_top_padding ), $key ).' value="'.esc_attr($key).'">'.esc_html($option).'</option>';
		}
		echo '</select>';
		echo '</div>';
		echo '</div>';

		echo '</div>';

	}

	#RENDER METABOX
	public function htmeme_output_product_metabox( $post ) {

		// ADD NONCE
		wp_nonce_field( 'htheme_inner_custombox', 'htheme_inner_custombox_nonce' );

		// USER get_post_meta TO GET AN EXISTING VALUE FROM DB
		$htheme_meta_product_image = get_post_meta( $post->ID, 'htheme_meta_product_image', true );
		$htheme_meta_product_image_featured = get_post_meta( $post->ID, 'htheme_meta_product_image_featured', true );

		echo '<script>';
		echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		echo '<div class="htheme_metabox_holder">';

		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_12">';
				echo '<div class="htheme_label">'.esc_html__('Secondary Product Image', 'invogue').'</div>';
				echo '<input type="hidden" name="htheme_meta_image_featured" id="htheme_meta_image_featured" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_product_image_featured ) . '">';
				echo '<div class="htheme_image_product_holder htheme_media_uploader" data-connect="htheme_meta_image_featured" data-multiple="false" data-size="full" id="image_htheme_meta_image_featured"></div>';
				echo '<span class="htheme_remove_image" data-input="htheme_meta_image_featured">'.esc_html__('Remove image [x]', 'invogue') .'</span>';
			echo '</div>';
		echo '</div>';

		echo '<div class="htheme_form_row">';
			echo '<div class="htheme_form_col_12">';
				echo '<div class="htheme_label">'.esc_html__('Promo Slide Image', 'invogue').'</div>';
				echo '<input type="hidden" name="htheme_meta_image" id="htheme_meta_image" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_product_image ) . '">';
				echo '<div class="htheme_image_product_holder htheme_media_uploader" data-connect="htheme_meta_image" data-multiple="false" data-size="full" id="image_htheme_meta_image"></div>';
				echo '<span class="htheme_remove_image" data-input="htheme_meta_image">'.esc_html__('Remove image [x]', 'invogue') .'</span>';
			echo '</div>';
		echo '</div>';

		echo '</div>';

	}

	#RENDER METABOX
	public function htmeme_output_additional_metabox( $post ) {

		// ADD NONCE
		wp_nonce_field( 'htheme_inner_custombox', 'htheme_inner_custombox_nonce' );

		// USER get_post_meta TO GET AN EXISTING VALUE FROM DB
		$htheme_meta_video_url = get_post_meta( $post->ID, 'htheme_meta_video_url', true );
		$htheme_meta_superzoom = get_post_meta( $post->ID, 'htheme_meta_superzoom', true );

		echo '<script>';
		echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		echo '<div class="htheme_metabox_holder">';

		//ROW SHORTCODE
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Video URL', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Add a YouTube or Vimeo URL to add a video for your product.', 'invogue').'</div>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		echo '<input type="text" name="htheme_meta_video_url" id="htheme_meta_video_url" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_video_url ) . '"><span style="font-size:12px;" class="htheme_red">'.esc_html__('Example URL', 'invogue').': https://www.youtube.com/watch?v=tntOCGkgt98</span>';
		echo '</div>';
		echo '</div>';

		//ROW SEPERZOOM
		echo '<div class="htheme_form_row">';
		echo '<div class="htheme_form_col_3">';
		echo '<div class="htheme_label">'.esc_html__('Enable superzoom', 'invogue').'</div>';
		echo '<div class="htheme_label_excerpt">'.esc_html__('Enable the superzoom for the current product, this will use the full size image.', 'invogue').'</div>';
		echo '<span style="font-size:12px;" class="htheme_red">'.esc_html__('Recommended image size (2000px x 2000px)', 'invogue').'</span>';
		echo '</div>';
		echo '<div class="htheme_form_col_9">';
		//INPUT
		?>
		<input type="checkbox" <?php checked( esc_attr( $htheme_meta_superzoom ), 'true' ); ?> name="htheme_meta_superzoom" id="htheme_meta_superzoom" value="true">
		<?php
		echo '</div>';
		echo '</div>';

		echo '</div>';

	}

	#SAVE METABOX DATA
	public function htheme_save_metabox( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// CHECK IF NONCE IS SET
		if(!isset($_POST['htheme_inner_custombox_nonce']))
			return $post_id;

		$nonce = $_POST['htheme_inner_custombox_nonce'];

		// VERIFY THAT NONCE IS VALID
		if(!wp_verify_nonce($nonce, 'htheme_inner_custombox'))
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// CHECK THE USERS PERMISSIONS
		if('page' == $_POST['post_type']){
			if(!current_user_can('edit_page', $post_id))
				return $post_id;
		} else if('product' == $_POST['post_type']){
			if(!current_user_can('edit_page', $post_id))
				return $post_id;
		} else {
			if(!current_user_can('edit_post', $post_id))
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		if('page' == $_POST['post_type'] || 'lookbook' == $_POST['post_type']){

			// Sanitize the user input.
			$val_htheme_meta_layout = sanitize_text_field($_POST['htheme_meta_layout']);
			$val_htheme_meta_image = sanitize_text_field($_POST['htheme_meta_image']);
			$val_htheme_meta_fullscreen = '';
			if(isset($_POST['htheme_meta_fullscreen']) && !empty($_POST['htheme_meta_fullscreen'])){
				$val_htheme_meta_fullscreen = sanitize_text_field($_POST['htheme_meta_fullscreen']);
			}
			$val_htheme_meta_title = sanitize_text_field($_POST['htheme_meta_title']);
			$val_htheme_meta_title_devider = sanitize_text_field($_POST['htheme_meta_title_devider']);

			//$val_htheme_meta_title_devider_color = sanitize_text_field($_POST['htheme_meta_title_devider_color']);

			$val_htheme_meta_sub = sanitize_text_field($_POST['htheme_meta_sub']);
			$val_htheme_meta_horz = sanitize_text_field($_POST['htheme_meta_horz']);
			$val_htheme_meta_bg_position = sanitize_text_field($_POST['htheme_meta_bg_position']);
			$val_htheme_meta_bg_color = sanitize_text_field($_POST['htheme_meta_bg_color']);
			$val_htheme_meta_font_color = sanitize_text_field($_POST['htheme_meta_font_color']);
			$val_htheme_meta_height = '650';
			if(isset($_POST['htheme_meta_height']) && !empty($_POST['htheme_meta_height'])){
				$val_htheme_meta_height = sanitize_text_field($_POST['htheme_meta_height']);
			}
			$val_htheme_meta_btn_text = sanitize_text_field($_POST['htheme_meta_btn_text']);
			$val_htheme_meta_btn_url = sanitize_text_field($_POST['htheme_meta_btn_url']);
			$val_htheme_meta_btn_target = sanitize_text_field($_POST['htheme_meta_btn_target']);
			$val_htheme_meta_shortcode = sanitize_text_field($_POST['htheme_meta_shortcode']);
			$val_htheme_meta_top_padding = sanitize_text_field($_POST['htheme_meta_top_padding']);

			// Update the meta field.
			update_post_meta($post_id, 'htheme_meta_layout', $val_htheme_meta_layout);
			update_post_meta($post_id, 'htheme_meta_image', $val_htheme_meta_image);
			update_post_meta($post_id, 'htheme_meta_fullscreen', $val_htheme_meta_fullscreen);
			update_post_meta($post_id, 'htheme_meta_title', $val_htheme_meta_title);
			update_post_meta($post_id, 'htheme_meta_title_devider', $val_htheme_meta_title_devider);
			//update_post_meta($post_id, 'htheme_meta_title_devider_color', $val_htheme_meta_title_devider_color);
			update_post_meta($post_id, 'htheme_meta_sub', $val_htheme_meta_sub);
			update_post_meta($post_id, 'htheme_meta_horz', $val_htheme_meta_horz);
			update_post_meta($post_id, 'htheme_meta_bg_position', $val_htheme_meta_bg_position);
			update_post_meta($post_id, 'htheme_meta_bg_color', $val_htheme_meta_bg_color);
			update_post_meta($post_id, 'htheme_meta_font_color', $val_htheme_meta_font_color);
			update_post_meta($post_id, 'htheme_meta_height', $val_htheme_meta_height);
			update_post_meta($post_id, 'htheme_meta_btn_text', $val_htheme_meta_btn_text);
			update_post_meta($post_id, 'htheme_meta_btn_url', $val_htheme_meta_btn_url);
			update_post_meta($post_id, 'htheme_meta_btn_target', $val_htheme_meta_btn_target);
			update_post_meta($post_id, 'htheme_meta_btn_target', $val_htheme_meta_btn_target);
			update_post_meta($post_id, 'htheme_meta_shortcode', $val_htheme_meta_shortcode);
			update_post_meta($post_id, 'htheme_meta_top_padding', $val_htheme_meta_top_padding);

		} else if('product' == $_POST['post_type']){

			// Sanitize the user input.
			$val_htheme_meta_image = sanitize_text_field($_POST['htheme_meta_image']);
			$val_htheme_meta_image_featured = sanitize_text_field($_POST['htheme_meta_image_featured']);
			$val_htheme_meta_video_url = sanitize_text_field($_POST['htheme_meta_video_url']);
			$val_htheme_meta_superzoom = sanitize_text_field($_POST['htheme_meta_superzoom']);

			// Update the meta field.
			update_post_meta($post_id, 'htheme_meta_product_image', $val_htheme_meta_image);
			update_post_meta($post_id, 'htheme_meta_product_image_featured', $val_htheme_meta_image_featured);
			update_post_meta($post_id, 'htheme_meta_video_url', $val_htheme_meta_video_url);
			update_post_meta($post_id, 'htheme_meta_superzoom', $val_htheme_meta_superzoom);

		}

	}

	/*
	 * CUSTOM USER FIELDS
	 */

	#SAVE USER DATA
	public function htheme_save_custom_user_fields( $user_id ) {

		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
		update_user_meta( $user_id, 'user_twitter', $_POST['twitter'] );
		update_user_meta( $user_id, 'user_facebook', $_POST['facebook'] );
		update_user_meta( $user_id, 'user_pinterest', $_POST['pinterest'] );
		update_user_meta( $user_id, 'user_linkdin', $_POST['linkdin'] );
		update_user_meta( $user_id, 'user_wishlist', $_POST['wishlist'] );
		update_user_meta( $user_id, 'user_avatar', $_POST['htheme_meta_image'] );

	}

	#CUSTOM USER META FIELDS
	public function htheme_custom_user_fields( $user )  {  wp_enqueue_media(); ?>

		<h3><?php esc_html_e('Extra profile information', 'invogue'); ?></h3>

		<table class="form-table">

			<tr>
				<th><label for="twitter"><?php esc_html_e('Twitter', 'invogue'); ?></label></th>

				<td>
					<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'user_twitter', $user->ID ) ); ?>" class="regular-text" />
					<span class="description"><?php esc_html_e('Please enter your Twitter username.', 'invogue'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="twitter"><?php esc_html_e('Facebook', 'invogue'); ?></label></th>

				<td>
					<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'user_facebook', $user->ID ) ); ?>" class="regular-text" />
					<span class="description"><?php esc_html_e('Please enter your Facebook page url.', 'invogue'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="twitter"><?php esc_html_e('Pinterest', 'invogue'); ?></label></th>

				<td>
					<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'user_pinterest', $user->ID ) ); ?>" class="regular-text" />
					<span class="description"><?php esc_html_e('Please enter your Pinterest tag/ID.', 'invogue'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="twitter"><?php esc_html_e('Linkdin', 'invogue'); ?></label></th>

				<td>
					<input type="text" name="linkdin" id="linkdin" value="<?php echo esc_attr( get_the_author_meta( 'user_linkdin', $user->ID ) ); ?>" class="regular-text" />
					<span class="description"><?php esc_html_e('Please enter your Linkdin url.', 'invogue'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="twitter"><?php esc_html_e('Avatar', 'invogue'); ?></label></th>

				<td>
					<input type="hidden" name="htheme_meta_image" id="htheme_meta_image" class="htheme_field_fixed_400" value="<?php echo esc_attr( get_the_author_meta( 'user_avatar', $user->ID ) ); ?>">
					<div class="htheme_image_holder htheme_media_uploader htheme_user_avatar" data-connect="htheme_meta_image" data-multiple="false" data-size="full" id="image_htheme_meta_image"></div>
				</td>
			</tr>

			<tr>
				<!-- <th><label for="twitter">Wishlist</label></th> -->
				<td>
					<input type="hidden" name="wishlist" id="wishlist" value="<?php echo esc_attr( get_the_author_meta( 'user_wishlist', $user->ID ) ); ?>" class="regular-text" />
				</td>
			</tr>

		</table>

	<?php }

}