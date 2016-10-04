<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO SETTINGS PANEL FOR GET CONTENT
class htheme_getcontent{

	#CONSTRUCT
	public function __construct(){
	}

	#GENERATE UNIQUE ID
	public function htheme_genGUID(){
		return sprintf('%04x%04x_%04x_%04x_%04x_%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	#GET PEOPLE
	public function htheme_get_people($atts){

		#GLOBALS
		global $post;

		#ARGUMENTS
		$args = array(
			'post_type' => 'people',
			'post__in' => explode(',' ,$atts['htheme_people_ids']),
			'numberposts' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'offset' => 0
		);

		#QUERY POSTS
		query_posts($args);

		if ( have_posts() ) : ?>
			<!-- ROW -->
			<div class="htheme_row">
				<div class="htheme_container">
					<div class="htheme_inner_col">
						<div class="htheme_people_holder">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
								#META
								$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'medium' );
								$htheme_meta_type_position = get_post_meta($post->ID, 'htheme_meta_type_position', true);
								$htheme_meta_type_facebook = get_post_meta($post->ID, 'htheme_meta_type_facebook', true);
								$htheme_meta_type_twitter = get_post_meta($post->ID, 'htheme_meta_type_twitter', true);
								$htheme_meta_type_pinterest = get_post_meta($post->ID, 'htheme_meta_type_pinterest', true);
								$htheme_meta_type_linkd = get_post_meta($post->ID, 'htheme_meta_type_linkd', true);
								?>

								<div class="htheme_col_people_item">
									<div class="htheme_inner_col htheme_people_item" data-hover-type="hover_people_item">
										<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="htheme_people_image">
											<?php
											$htheme_no_img = 'htheme_no_img';
											$img = '';
											if($image[0]){
												$img = 'style="background-image:url('.esc_url($image[0]).');"';
												$htheme_no_img = '';
											}
											?>
											<div class="htheme_people_image_inner <?php echo esc_attr($htheme_no_img); ?>" <?php echo $img; ?>></div>
										</a>
										<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="htheme_people_content">
											<h3><?php the_title(); ?></h3>
											<?php if($htheme_meta_type_position): ?>
												<span class="htheme_h3_sub"><?php echo esc_html($htheme_meta_type_position); ?></span>
											<?php endif; ?>
											<?php if($post->post_excerpt): ?>
												<?php
												if($post->post_excerpt != ''){
													$content = rtrim(substr(esc_html($post->post_excerpt), 0, 100));
												} else {
													$content = rtrim(substr(esc_html($post->post_excerpt), 0, 100));
												}
												?>
												<span class="htheme_default_content">
											<?php echo esc_html($content); ?>
										</span>
											<?php endif; ?>
										</a>
										<div class="htheme_people_social">
											<?php
											#GET TEMPLATE PART - SOCIAL PEOPLE
											get_template_part( 'htheme/templateparts/content/people', 'social' );
											?>
										</div>
									</div>
								</div>

							<?php endwhile; // end of the loop. ?>

						</div>
					</div>
				</div>
			</div>
			<!-- ROW -->
		<?php endif;

		#RESET QUERY
		wp_reset_query();

	}

	#GET CONTACT FORM
	public function htheme_get_line($atts){

		#SETUP DATA
		$htheme_line_layout = $atts['htheme_line_layout'];
		$htheme_line_color = $atts['htheme_line_color'];

		?>
		<!-- GREY LINE -->
		<div class="htheme_row">
			<?php if($htheme_line_layout == 'contained'){ ?>
			<div class="htheme_container">
				<div class="htheme_inner_col">
			<?php }  ?>
					<div class="htheme_grey_line_separator" style="background-color:<?php echo esc_attr($htheme_line_color); ?>"></div>
			<?php if($htheme_line_layout == 'contained'){ ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- GREY LINE -->
		<?php

	}

	#GET CONTACT FORM
	public function htheme_get_map($atts){

		#VARIABLES
		$html = '';
		$marker_img = wp_get_attachment_url( $atts['htheme_map_marker_image'] );

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_map_' . $this->htheme_genGUID();

		#MARKERS
		$obj = urldecode($atts['htheme_map_markers']);
		$obj = json_decode($obj, true);

		?>

		<!-- ROW -->
		<div class="htheme_row">
			<div class="htheme_container">
				<div class="htheme_contact_details_holder">
					<div class="htheme_contact_details_item">
						<div class="htheme_col_12 htheme_contact_map">
							<div class="htheme_inner_col">
								<div class="htheme_map_holder" id="<?php echo esc_attr($unique_id); ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ROW -->
		<?php
			$htheme_zoom_level = 10;
			if(isset($atts['htheme_map_zoom'])){
				$htheme_zoom_level = $atts['htheme_map_zoom'];
			}
		?>
		<script type="text/javascript">

			function htheme_initMap() {

				//CREATE MAP
				var map_<?php echo esc_attr($unique_id); ?> = new google.maps.Map(document.getElementById('<?php echo esc_attr($unique_id); ?>'), {
					center: {lat: <?php echo esc_attr($atts['htheme_map_center_lat']); ?>, lng: <?php echo esc_attr($atts['htheme_map_center_long']); ?>},
					scrollwheel: true,
					zoom: <?php echo esc_attr($htheme_zoom_level); ?>
				});

				<?php

					//STYLES

					$style = '';

					switch($atts['htheme_map_styles']){
						case 'original':
							$style = '""';
						break;
						case 'ShadesOfGrey':
							$style = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
						break;
						case 'CoolGrey':
							$style = '[{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]';
						break;
						case 'PastelTones':
							$style = '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":60}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"lightness":30}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ef8c25"},{"lightness":40}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#b6c54c"},{"lightness":40},{"saturation":-40}]},{}]';
						break;
						case 'MostlyGrayscale':
							$style = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"administrative","elementType":"labels","stylers":[{"saturation":"-100"}]},{"featureType":"administrative","elementType":"labels.text","stylers":[{"gamma":"0.75"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"lightness":"-37"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f9f9f9"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"saturation":"-100"},{"lightness":"40"},{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"labels.text.fill","stylers":[{"saturation":"-100"},{"lightness":"-37"}]},{"featureType":"landscape.natural","elementType":"labels.text.stroke","stylers":[{"saturation":"-100"},{"lightness":"100"},{"weight":"2"}]},{"featureType":"landscape.natural","elementType":"labels.icon","stylers":[{"saturation":"-100"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":"-100"},{"lightness":"80"}]},{"featureType":"poi","elementType":"labels","stylers":[{"saturation":"-100"},{"lightness":"0"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"lightness":"-4"},{"saturation":"-100"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"},{"visibility":"on"},{"saturation":"-95"},{"lightness":"62"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road","elementType":"labels","stylers":[{"saturation":"-100"},{"gamma":"1.00"}]},{"featureType":"road","elementType":"labels.text","stylers":[{"gamma":"0.50"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"saturation":"-100"},{"gamma":"0.50"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"},{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"lightness":"-13"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"lightness":"0"},{"gamma":"1.09"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"},{"saturation":"-100"},{"lightness":"47"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"lightness":"-12"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"saturation":"-100"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"},{"lightness":"77"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"lightness":"-5"},{"saturation":"-100"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"saturation":"-100"},{"lightness":"-15"}]},{"featureType":"transit.station.airport","elementType":"geometry","stylers":[{"lightness":"47"},{"saturation":"-100"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"water","elementType":"geometry","stylers":[{"saturation":"53"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-42"},{"saturation":"17"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"lightness":"61"}]}]';
						break;
						case 'AppleMapsEsque':
							$style = '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]';
						break;
					}

				?>

				var styles_<?php echo esc_attr($unique_id); ?> = <?php echo $style; ?>;

				map_<?php echo esc_attr($unique_id); ?>.setOptions({styles: styles_<?php echo esc_attr($unique_id); ?>});

				//ADD MARKERS
				<?php $count = 0; ?>

				<?php if($obj){ ?>

					<?php foreach($obj as $marker){ ?>

						<?php if($marker){ ?>

							<?php
							$m_heading = '';
							if(!empty($marker['htheme_map_marker_heading'])){
								$m_heading = $marker['htheme_map_marker_heading'];
							}
							?>

							//WINDOW INFO
							var contentString<?php echo esc_attr($count); ?> = '<div id="content">'+

								'<h4 class="htheme_map_heading">'+
									'<?php echo esc_html($m_heading); ?>'+
								'</h4>'+
								'<div class="htheme_default_content">'+
									'<?php echo esc_html($marker['htheme_map_marker_info']); ?>'+
								'</div>'+
								'</div>';

							var infowindow<?php echo esc_attr($count); ?> = new google.maps.InfoWindow({
								content: contentString<?php echo esc_attr($count); ?>
							});

							//MARKER
							var marker<?php echo esc_attr($count); ?> = new google.maps.Marker({
								map: map_<?php echo esc_attr($unique_id); ?>,
								position: {lat: <?php echo esc_attr($marker['htheme_map_marker_lat']); ?>, lng: <?php echo esc_attr($marker['htheme_map_marker_long']); ?>},
								icon: '<?php echo esc_url($marker_img); ?>'
							});

							//ADD LISTENERS
							marker<?php echo esc_attr($count); ?>.addListener('click', function() {
								infowindow<?php echo esc_attr($count); ?>.open(map_<?php echo esc_attr($unique_id); ?>, marker<?php echo esc_attr($count); ?>);
							});

							<?php $count++; ?>

						<?php } ?>

					<?php } ?>
				<?php } ?>

			}
		</script>

		<?php wp_enqueue_script( 'herothememapapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDDt1Fm617cqcy8gfXMqN8_7JpyAz362F4&callback=htheme_initMap' ); ?>
		
		<?php

	}

	#GET CONTACT FORM
	public function htheme_get_signup_form($atts){

		#SETUP DATA
		$htheme_signup_title = isset($atts['htheme_signup_title']) ? $atts['htheme_signup_title'] : '';
		$htheme_signup_excerpt = isset($atts['htheme_signup_excerpt']) ? $atts['htheme_signup_excerpt'] : '';
		$htheme_signup_subject = isset($atts['htheme_signup_subject']) ? $atts['htheme_signup_subject'] : 'Sign-up';

		#VARIABLES
		$html = '';

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_signup_form_' . $this->htheme_genGUID();

		$html .= '<!-- ROW -->';
		$html .= '<form id="'.esc_attr($unique_id).'" class="htheme_signup_form" data-subject="'.esc_html($htheme_signup_subject).'">';
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_signup_container">';
						if($htheme_signup_title){
							$html .= '<h2>'.esc_html($htheme_signup_title).'</h2>';
						}
						$html .= '<div class="htheme_icon_signup"></div>';
						if($htheme_signup_title){
							$html .= '<span class="htheme_h2_sub">' . esc_html($htheme_signup_excerpt) . '</span>';
						}
						$html .= '<div class="htheme_signup_form_holder">';
							$html .= '<div class="htheme_signup_controls">';
								$html .= '<div class="htheme_form_status_message"></div>';
							$html .= '</div>';
							$html .= '<div class="htheme_signup_fields">';
								$html .= '<div class="htheme_signup_field_item">';
									$html .= '<input type="text" name="user_signup_email" id="user_signup_email">';
									$html .= '<label for="user_signup_email" class="">';
										$html .= esc_html__('Email Address', 'invogue');
										$html .= '<span class="htheme_icon_signup_btn"></span>';
									$html .= '</label>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</form>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET CONTACT FORM
	public function htheme_get_contact_form($atts){

		#SETUP DATA
		$htheme_form_subject = $atts['htheme_contact_subject'];

		/*$htheme_contact_show_name = $atts['htheme_contact_show_name'];
		$htheme_contact_show_last_name = $atts['htheme_contact_show_last_name'];
		$htheme_contact_show_email = $atts['htheme_contact_show_email'];
		$htheme_contact_show_type = $atts['htheme_contact_show_type'];
		$htheme_contact_show_message = $atts['htheme_contact_show_message'];*/

		#COUNT
		$count = 0;
		$col_style = 'htheme_col_6';

		#VARIABLES
		$html = '';

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_contact_form_' . $this->htheme_genGUID();

		#FORM
		$html .= '<!-- ROW -->';
		$html .= '<form id="'.esc_attr($unique_id).'" class="htheme_contact_form" data-subject="'.esc_attr($htheme_form_subject).'">';
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_inner_col">';
						$html .= '<div class="htheme_form_holder">';

							$html .= '<div class="'.esc_attr($col_style).' htheme_form_field_item">';
								$html .= '<input type="text" name="user_name" id="user_name">';
								$html .= '<label for="user_name" class="">';
									$html .= esc_html__('First Name', 'invogue');
								$html .= '</label>';
							$html .= '</div>';
							$html .= '<div class="'.esc_attr($col_style).' htheme_form_field_item">';
								$html .= '<input type="text" name="user_last" id="user_last">';
								$html .= '<label for="user_last" class="">';
									$html .= esc_html__('Last Name', 'invogue');
								$html .= '</label>';
							$html .= '</div>';
							$html .= '<div class="'.esc_attr($col_style).' htheme_form_field_item">';
								$html .= '<input type="text" name="user_email" id="user_email">';
								$html .= '<label for="user_email" class="">';
									$html .= esc_html__('Email Address', 'invogue');
								$html .= '</label>';
							$html .= '</div>';
							$html .= '<div class="'.esc_attr($col_style).' htheme_form_field_item">';
								$html .= '<input type="text" name="user_message_type" id="user_message_type">';
								$html .= '<label for="user_message_type" class="">';
									$html .= esc_html__('Message Type', 'invogue');
								$html .= '</label>';
							$html .= '</div>';
							$html .= '<div class="htheme_col_12 htheme_form_field_item htheme_form_textarea_item">';
								$html .= '<textarea name="user_message" id="user_message"></textarea>';
								$html .= '<label for="user_message" class="">';
									$html .= esc_html__('Message', 'invogue');
								$html .= '</label>';
							$html .= '</div>';
							$html .= '<div class="htheme_form_status_message"></div>';
							$html .= '<div class="htheme_btn_style_1" id="htheme_button_submit">SEND</div>';
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</form>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET INSTAGRAM CONTENT
	public function htheme_get_instagram($atts = false, $id = false, $access = false, $count = 6, $layout = false){

		$htheme_instagram_uid = '';
		$htheme_instagram_token = '';
		$htheme_instagram_title = '';
		$htheme_instagram_layout = '';
		$htheme_instagram_bg = '';
		$photo_count = $count;

		#SETUP DATA
		if($atts){
			$htheme_instagram_title = $atts['htheme_instagram_title'];
			$htheme_instagram_uid = $atts['htheme_instagram_uid'];
			$htheme_instagram_token = $atts['htheme_instagram_token'];
			//LAYOUT
			if(!isset($atts['htheme_instagram_layout'])){
				$htheme_instagram_layout = 'default';
			} else {
				$htheme_instagram_layout = $atts['htheme_instagram_layout'];
			}
			//BG
			if(!isset($atts['htheme_instagram_bg'])){
				$htheme_instagram_bg = '';
			} else {
				$htheme_instagram_bg = $atts['htheme_instagram_bg'];
			}
		} else {
			$htheme_instagram_uid = $id;
			$htheme_instagram_token = $access;
			$photo_count = $count;
		}

		#USER ID
		$instagram_uid = $htheme_instagram_uid;

		##ACCESS TOKEN
		$access_token = $htheme_instagram_token;

		#JSON LINK
		$json_link="https://api.instagram.com/v1/users/{$instagram_uid}/media/recent/?";
		$json_link.="access_token={$access_token}&count={$photo_count}";

		#GET FILE CONTENTS
		$json = wp_remote_fopen($json_link);
		$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

		$html = '';

		#LAYOUTS
		if($layout == false){

			switch($htheme_instagram_layout){
				case 'default':
					$html .= '<!-- ROW -->';
					$html .= '<div class="htheme_row">';
						$html .= '<div class="htheme_pinterest_holder">';
							$html .= '<div class="htheme_pinterest_images">';
								$count = 1;
								if($obj['data']){
									foreach($obj['data'] as $media){
										$html .= '
										<a target="_blank" href="'.esc_url($media['link']).'" data-instagram="'.esc_attr($count).'" class="htheme_col_2" style="background-image:url('.esc_url($media['images']['low_resolution']['url']).');">
											<div class="htheme_instagram_social">
												<div class="htheme_instagram_social_item htheme_instagram_likes">'.$media['likes']['count'].'</div>
												<div class="htheme_instagram_social_item htheme_instagram_comments">'.$media['comments']['count'].'</div>
											</div>
										</a>
										';
										$count++;
									}
								}
							$html .= '</div>';
							$html .= '<a target="_blank" href="'.esc_url('https://www.instagram.com/'.$htheme_instagram_title.'/').'" class="htheme_pinterest_content" data-hover-type="hover_pinterest_block">';
								$html .= '<span class="htheme_h3_sub">'.esc_html__('FIND US ON INSTAGRAM','invogue').'</span>';
								$html .= '<h3>@'.esc_html($htheme_instagram_title).'</h3>';
							$html .= '</a>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<!-- ROW -->';
				break;
				case 'mosaic':
					$html .= '<!-- ROW -->';
					$html .= '<div class="htheme_row">';
						$html .= '<div class="htheme_container">';
							$html .= '<div class="htheme_instagram_holder_mosaic">';
								$htheme_img = wp_get_attachment_url( $htheme_instagram_bg );
								$html .= '<div class="htheme_instagram_holder_mosaic_content">';
									$html .= '<div class="htheme_instagram_mosaic_inner" style="background-image:url('.esc_url($htheme_img).');">';
										$html .= '<div class="htheme_instagram_mosaic_details">';
											$html .= '<div class="htheme_instagram_mosaic_icon">';
												$html .= wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_instagram.svg');
											$html .= '</div>';
											$html .= '<h3>@'.esc_html($htheme_instagram_title).'</h3>';
											$html .= '<a href="'.esc_url('https://www.instagram.com/'.$htheme_instagram_title.'/').'" class="htheme_btn_style_1">'.esc_html__('BROWSE', 'invogue').'</a>';
										$html .= '</div>';
									$html .= '</div>';
								$html .= '</div>';

								$html .= '<div class="htheme_mosaic_images">';
									$count = 1;
									if($obj['data']){
										foreach($obj['data'] as $media){
											$html .= '
												<a style="background-image:url('.esc_url($media['images']['standard_resolution']['url']).');" target="_blank" href="'.esc_url($media['link']).'" data-mosaic="htheme_mosaic_'.$count.'">
													
												</a>
											';
											$count++;
										}
									}
								$html .= '</div>';

							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<!-- ROW -->';
				break;
			}

		} else {

			$count = 1;
			if($obj['data']){
				foreach($obj['data'] as $media){
					$html .= '<a target="_blank" href="'.esc_url($media['link']).'" data-instagram="'.esc_attr($count).'" style="background-image:url('.esc_url($media['images']['low_resolution']['url']).');"></a>';
					$count++;
				}
			}

		}

		return $html;

	}

	#GET BANNER CONTENT
	public function htheme_get_content_banner($atts){

		#SETUP DATA
		$htheme_banner_title = $atts['htheme_banner_title'];
		$htheme_banner_excerpt = $atts['htheme_banner_excerpt'];
		$htheme_banner_button = $atts['htheme_banner_button'];
		$htheme_banner_url = $atts['htheme_banner_url'];
		$htheme_banner_url_target = $atts['htheme_banner_url_target'];
		$htheme_banner_image = $atts['htheme_banner_image'];
		$htheme_banner_height = $atts['htheme_banner_height'];
		$htheme_banner_layout = isset($atts['htheme_banner_layout']) ? $atts['htheme_banner_layout'] : 'contained_row';
		$htheme_banner_position = isset($atts['htheme_banner_content_position']) ? $atts['htheme_banner_content_position'] : 'left';
		$htheme_banner_btn_text = isset($atts['htheme_banner_button_text']) ? $atts['htheme_banner_button_text'] : 'Read More';
		$htheme_img = wp_get_attachment_url( $htheme_banner_image );

		$html = '';

		#BUTTON CONTENT
		$button_content = '';
		if($htheme_banner_button){
			$button_content .= '<div class="htheme_banner_inner_button htheme_button_position_'.esc_attr($htheme_banner_position).'">';
				$button_content .= '<a href="' . esc_url($htheme_banner_url) . '" target="' . esc_attr($htheme_banner_url_target) . '" class="htheme_btn_style_1">';
					$button_content .= esc_html($htheme_banner_btn_text);
				$button_content .= '</a>';
			$button_content .= '</div>';
		}

		#BANNER CONTENT
		$banner_content = '';
		$banner_content .= '<div class="htheme_banner_inner_content htheme_content_position_'.esc_attr($htheme_banner_position).'">';
			$banner_content .= '<h3>'.esc_html($htheme_banner_title).'</h3>';
			$banner_content .= '<span class="htheme_h3_sub">'.esc_html($htheme_banner_excerpt).'</span>';
		$banner_content .= '</div>';

		$html .= '<!-- ROW-->';
		$html .= '<div class="htheme_row">';

			if($htheme_banner_layout == 'contained_row' || $htheme_banner_layout == ''){
			$html .= '<div class="htheme_container">';
				$html .= '<div class="htheme_inner_col">';
			}

					$html .= '<div class="htheme_banner_holder" style="background-image:url('.esc_url($htheme_img).'); height:'.esc_attr($htheme_banner_height).'px;">';
						if($htheme_banner_position == 'left'){
							$html .= $button_content;
							$html .= $banner_content;
						} else if($htheme_banner_position == 'right'){
							$html .= $banner_content;
							$html .= $button_content;
						} else if($htheme_banner_position == 'center'){
							$html .= '<div class="htheme_banner_wrap">';
								$html .= $banner_content;
								$html .= $button_content;
							$html .= '</div>';
						} else {
							$html .= $banner_content;
							$html .= $button_content;
						}
					$html .= '</div>';

			if($htheme_banner_layout == 'contained_row' || $htheme_banner_layout == ''){
				$html .= '</div>';
			$html .= '</div>';
			}

		$html .= '</div>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET LAUNCH CONTENT
	public function htheme_get_content_launch($atts){

		#SETUP DATA
		$htheme_launch_align = 'center';
		if($atts['htheme_launch_align'] != ''){
			$htheme_launch_align = $atts['htheme_launch_align'];
		}

		$html = '';

		$obj = urldecode($atts['htheme_pad_launch']);
		$obj = json_decode($obj, true);
		$count = count($obj);
		$col_style = 'htheme_col_4';

		if($count == 4){
			$col_style = 'htheme_col_3';
		} else if($count == 3){
			$col_style = 'htheme_col_4';
		} else if($count == 2){
			$col_style = 'htheme_col_6';
		} else if($count == 1){
			$col_style = 'htheme_col_12';
		}

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row">';
			$html .= '<div class="htheme_container">';
				$html .= '<div class="htheme_launch_pads_holder">';

				foreach($obj as $pad){

					$htheme_img = wp_get_attachment_url( $pad['htheme_pad_image'] );

					$html .= '<a href="'.esc_url($pad['htheme_pad_url']).'" class="'.esc_attr($col_style).'">';
						$html .= '<div class="htheme_inner_col">';
							$html .= '<div class="htheme_launch_item" data-hover-type="hover_launch_pads" style="background-image:url('.$htheme_img.');">';
								$html .= '<div class="htheme_launch_content">';
										$html .= '<h3 style="text-align:'.esc_attr($htheme_launch_align).'">'.esc_html($pad['htheme_pad_title']).'</h3>';
										$html .= '<span class="htheme_h3_sub" style="text-align:'.esc_attr($htheme_launch_align).'">'.esc_html($pad['htheme_pad_excerpt']).'</span>';
										if($htheme_launch_align == 'center'){
											$html .= '<div class="htheme_icon_launch_arrow"></div>';
										}
									$html .= '</div>';
								$html .= '<div class="htheme_launch_overlay"></div>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</a>';
				}

				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET TITLES
	public function htheme_get_titles($atts){

		#SETUP DATA
		$title = isset($atts['htheme_title_title']) ? $atts['htheme_title_title'] : '';
		$excerpt = isset($atts['htheme_title_excerpt']) ? $atts['htheme_title_excerpt'] : '';
		$layout = isset($atts['htheme_title_layout']) ? $atts['htheme_title_layout'] : 'default';
		$devider = isset($atts['htheme_title_devider']) ? $atts['htheme_title_devider'] : 'none';
		//$devider_color = isset($atts['htheme_title_devider_color']) ? $atts['htheme_title_devider_color'] : '#EEEEEE';
		$unique_id = 'htheme_title_devider_color_' . $this->htheme_genGUID();

		$html = '';

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row">';
			$html .= '<div class="htheme_container">';
				$html .= '<div class="htheme_inner_col">';
					switch($layout){
						case 'side_by_side_icon':
							$html .= '<!-- TITLE SIDE BY SIDE ICON -->';
							$html .= '<div class="htheme_title_container" data-title-type="side_by_side_icon">';
								$html .= '<div class="htheme_title"><h2>'.esc_html($title).'</h2></div>';
								if($devider != 'none'){
									$html .= '<div class="htheme_svg_holder" id="'.esc_attr($unique_id).'">';
									$html .= wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$devider.'.svg');
									$html .= '</div>';
								}
								if($excerpt != ''){
									$html .= '<div class="htheme_sub_title htheme_h2_sub">'.esc_html($excerpt).'</div>';
								}
							$html .= '</div>';
						break;
						case 'default':
							$html .= '<!-- TITLE DEFAULT -->';
							$html .= '<div class="htheme_title_container" data-title-type="default">';
								$html .= '<div class="htheme_title"><h2>'.esc_html($title).'</h2></div>';
								if($devider != 'none'){
									$html .= '<div class="htheme_svg_holder" id="'.esc_attr($unique_id).'">';
									$html .= wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$devider.'.svg');
									$html .= '</div>';
								}
								if($excerpt != ''){
									$html .= '<div class="htheme_sub_title htheme_h2_sub">'.esc_html($excerpt).'</div>';
								}
							$html .= '</div>';
						break;
						case 'side_by_side':
							$html .= '<!-- TITLE SIDE BY SIDE -->';
							$html .= '<div class="htheme_title_container" data-title-type="side_by_side">';
								$html .= '<div class="htheme_title"><h2>'.esc_html($title).'</h2></div>';
								if($devider != 'none'){
									$html .= '<div class="htheme_svg_holder" id="'.$unique_id.'">';
									$html .= wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$devider.'.svg');
									$html .= '</div>';
								}
								if($excerpt != ''){
									$html .= '<div class="htheme_sub_title htheme_h2_sub">'.esc_html($excerpt).'</div>';
								}
							$html .= '</div>';
						break;
						case 'top_bottom':
							$html .= '<!-- TITLE DOUBLE TOP BOTTOM -->';
							$html .= '<div class="htheme_title_container" data-title-type="top_bottom">';
								$html .= '<div class="htheme_title"><h2>'.esc_html($title).'</h2></div>';
								if($devider != 'none'){
									$html .= '<div class="htheme_svg_holder" id="'.esc_attr($unique_id).'">';
										$html .= wp_remote_fopen(get_template_directory_uri().'/htheme/assets/svg/htheme_'.$devider.'.svg');
									$html .= '</div>';
								}
							$html .= '</div>';
						break;
					}
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET TESTIMONIALS
	public function htheme_get_testimonials($atts){

		#GLOBALS
		global $post;

		#ARGUMENTS
		$args = array(
			'post_type' => 'testimonial',
			'post__in' => explode(',' ,$atts['htheme_testimonial_ids']),
			'numberposts' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'offset' => 0
		);

		#QUERY POSTS
		$the_posts = get_posts($args);

		#SETUP DATA
		$height = 350;
		if(isset($atts['htheme_testimonial_height']) || isset($atts['htheme_testimonial_height']) != ''){
			$height = $atts['htheme_testimonial_height'];
		}
		$bgimage = isset($atts['htheme_testimonial_bg']) ? $atts['htheme_testimonial_bg'] : '';
		$htheme_img = wp_get_attachment_url( $bgimage );
		$title = $atts['htheme_testimonial_title'];
		$rating = $atts['htheme_testimonial_rating'];
		$excerpt = $atts['htheme_testimonial_excerpt'];

		$html = '';

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row" style="background-image:url('.esc_url($htheme_img).');">';
			$html .= '<div class="htheme_container">';
				$html .= '<div class="htheme_inner_col">';
					$html .= '<div class="htheme_testimonial_holder" style="height:'.esc_attr($height).'px;" id="testimonial_slider_1">';

						$html .= '<div class="htheme_testimonail_nav">';
							$html .= '<div class="htheme_icon_testimonial_left htheme_testimonial_navigate" data-side="left"></div>';
							$html .= '<div class="htheme_icon_testimonial_right htheme_testimonial_navigate" data-side="right"></div>';
						$html .= '</div>';
						$html .= '<div class="htheme_testimonial_pager">';
							$html .= '<div class="htheme_testimonial_pager_inner">';

								$pager_count = 1;

								foreach($the_posts as $pager){
									$html .= '<div class="htheme_testimonial_pager_btn" data-id="'.esc_attr($pager_count).'"></div>';
									$pager_count++;
								}

							$html .= '</div>';
						$html .= '</div>';

						$monial_count = 1;

						foreach($the_posts as $monial){
							$htheme_meta_name = get_post_meta($monial->ID, 'htheme_meta_name', true);
							$htheme_meta_company = get_post_meta($monial->ID, 'htheme_meta_company', true);
							$htheme_meta_rating = get_post_meta($monial->ID, 'htheme_meta_rating', true);
							$image_details = wp_get_attachment_image_src ( get_post_thumbnail_id ( $monial->ID ), 'medium' );
							$html .= '<div class="htheme_testimonial_item" data-id="'.$monial_count.'">';
								$html .= '<div class="htheme_testimonial_image" ';
								if($image_details[0]){
									$html .= 'style="background-image:url(' . esc_url($image_details[0]) . ')"';
								}
								$html .= '></div>';
								if($title){
									$html .= '<div class="htheme_testimonial_title">' . esc_html($htheme_meta_name) . '</div>';
								}
								$html .= '<div class="htheme_testimonial_company">'.esc_html($htheme_meta_company).'</div>';
								if($rating){
									$html .= '<div class="htheme_testimonial_stars">';
										$html .= '<div class="htheme_stars">';
											for($i = 1; $i <= $htheme_meta_rating; $i++){
												$html .= '<div class="htheme_icon_star"></div>';
											}
										$html .= '</div>';
									$html .= '</div>';
								}
								if($excerpt){
									$html .= '<div class="htheme_testimonial_excerpt">';
										$html .= esc_html($monial->post_excerpt);
									$html .= '</div>';
								}
							$html .= '</div>';
							$monial_count++;
						}

						//$html .= '</div>'; //WRAPPER

					$html .= '</div>';

				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		return $html;

	}

	#GET BLOG SPLIT
	public function htheme_get_content_blog_split($atts){

		$html = '';

		$categories = isset($atts['htheme_blog_category']) ? $atts['htheme_blog_category'] : '';

		$args = array(
			'post_type' => 'post',
			'numberposts' => 2,
			'orderby' => 'date',
			'taxonomy' => 'category',
			'category' => $categories,
			'order' => 'DESC'
		);

		$the_posts = get_posts($args);

		if($the_posts){

			$blog_style = '';
			if(count($the_posts) < 2){
				$blog_style = 'htheme_blog_item_full';
			}

			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_inner_col">';
						$html .= '<div class="htheme_blog_item_holder">';
							foreach($the_posts as $post){
								$image_details = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full' );
								$no_image = '';
								if(!$image_details[0]){
									$no_image = 'htheme_no_category_img';
								}
								$html .= '<a href="'.get_permalink($post->ID).'" class="htheme_blog_item '.esc_attr($blog_style).'" data-hover-type="hover_blog_split">';
									$html .= '<div class="htheme_blog_item_inner">';
										$html .= '<h4>'.esc_html($post->post_title).'</h4>';
										$html .= '<span class="htheme_h4_sub">'.mysql2date(get_option( 'date_format' ), $post->post_date).'</span>';										
									$html .= '</div>';
									$html .= '<div class="htheme_blog_image '.esc_attr($no_image).'" style="background-image:url('.esc_url($image_details[0]).')"></div>';
								$html .= '</a>';
							}
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<!-- ROW -->';

		}

		return $html;

	}

	#GET BLOG CAROUSEL
	public function htheme_get_content_blog_carousel($atts){

		$html = '';

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_horz_slider_' . $this->htheme_genGUID();

		$args = array(
			'post_type' => 'post',
			'numberposts' => -1,
			'orderby' => 'date',
			'taxonomy' => 'category',
			'category' => $atts['htheme_blog_carousel_category'],
			'order' => 'DESC'
		);

		$the_posts = get_posts($args);

		if($the_posts){

			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_row">';
				if($atts['htheme_blog_carousel_layout'] == 'contained_row'){ $html .= '<div class="htheme_container">'; }
					$html .= '<div class="htheme_post_slider htheme_horz_slider" id="'.esc_attr($unique_id).'" data-items-big-desktop="6" data-items-desktop="4" data-items-tablet="3" data-items-mobile="1">';
						$html .= '<div class="htheme_post_slider_wrapper" data-height="372">';
							$html .= '<div class="htheme_post_slider_inner">';
								foreach($the_posts as $post){
									$image_details = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );
									$no_image = '';
									if(!$image_details[0]){
										$no_image = 'htheme_no_category_img';
									}
									$term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "ids"));
									$html .= '<a href="'.esc_url(get_permalink($post->ID)).'" class="htheme_post_slider_item htheme_horz_slide_item" data-hover-type="hover_slider_item">';
										$html .= '<div class="htheme_post_slider_image '.esc_attr($no_image).'" style="background-image:url('.esc_url($image_details[0]).')">';
											$html .= '<div class="htheme_post_slider_overlay">';
												$html .= '<div class="htheme_icon_slider_arrow"></div>';
											$html .= '</div>';
										$html .= '</div>';
										$html .= '<div class="htheme_post_slider_heading">';
											$html .= '<h4>'.esc_html($post->post_title).'</h4>';
											$html .= '<div class="htheme_post_slider_category htheme_h4_sub">';												
												$html .= mysql2date(get_option( 'date_format' ), $post->post_date);
											$html .= '</div>';
										$html .= '</div>';
										#CHECK EXCERPT
										$html .= '<div class="htheme_post_slider_excerpt">'.$this->htheme_get_content_snippet($post->post_excerpt, $post->post_content, 0, 90).'</div>';
									$html .= '</a>';
								}
							$html .= '</div>';
						$html .= '</div>';

						$html .= '<div class="htheme_horz_pager_wrapper">';
							$html .= '<div class="htheme_horz_slider_pager">';
								$html .= '<div class="htheme_horz_slider_pager_inner">';
									$html .= '<div class="htheme_horz_pager_shifter"></div>';
								$html .= '</div>';
								$html .= '<div class="htheme_icon_horz_slider_left htheme_horz_side" data-side="left"></div>';
								$html .= '<div class="htheme_icon_horz_slider_right htheme_horz_side" data-side="right"></div>';
							$html .= '</div>';
						$html .= '</div>';

					$html .= '</div>';
				if($atts['htheme_blog_carousel_layout'] == 'contained_row'){ $html .= '</div>'; }
			$html .= '</div>';
			$html .= '<!-- ROW -->';

		}

		return $html;

	}

	#GET BLOG CAROUSEL
	public function htheme_image_carousel($atts){

		$html = '';

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_horz_slider_' . $this->htheme_genGUID();

		$img_ids = explode(',', $atts['htheme_imgcarousel_images']);
		$height = $atts['htheme_image_carousel_height'];
		$htheme_image_carousel_size = 'contain';
		if(isset($atts['htheme_image_carousel_size'])){
			$htheme_image_carousel_size = $atts['htheme_image_carousel_size'];
		}

		if($img_ids){

			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_row">';
				if($atts['htheme_image_carousel_layout'] == 'contained_row'){ $html .= '<div class="htheme_container">'; }
					$html .= '<div class="htheme_post_slider htheme_horz_slider" id="'.esc_attr($unique_id).'" data-items-big-desktop="6" data-items-desktop="4" data-items-tablet="3" data-items-mobile="2">';
						$html .= '<div class="htheme_post_slider_wrapper">';
							$html .= '<div class="htheme_post_slider_inner">';
								#FOREACH ID
								foreach($img_ids as $id){
									#GET IMAGE
									$image = wp_get_attachment_image_src( $id, 'medium');
									$html .= '<div class="htheme_post_slider_item htheme_horz_slide_item" data-hover-type="hover_slider_item">';
									$html .= '<div class="htheme_image_carousel_item" style="background-image:url('.esc_url($image[0]).'); height:'.esc_attr($height).'px; background-size:'.esc_attr($htheme_image_carousel_size).'"></div>';
									$html .= '</div>';
								}
							$html .= '</div>';
						$html .= '</div>';

						$html .= '<div class="htheme_horz_pager_wrapper">';
							$html .= '<div class="htheme_horz_slider_pager">';
								$html .= '<div class="htheme_horz_slider_pager_inner">';
									$html .= '<div class="htheme_horz_pager_shifter"></div>';
									$html .= '</div>';
								$html .= '<div class="htheme_icon_horz_slider_left htheme_horz_side" data-side="left"></div>';
								$html .= '<div class="htheme_icon_horz_slider_right htheme_horz_side" data-side="right"></div>';
								$html .= '</div>';
							$html .= '</div>';

						$html .= '</div>';
					if($atts['htheme_image_carousel_layout'] == 'contained_row'){ $html .= '</div>'; }
				$html .= '</div>';
			$html .= '<!-- ROW -->';

		}

		return $html;

	}

	public function htheme_get_content_snippet($excerpt, $content, $start, $end){

		#VARIABLES
		$return = '';

		#CHECK EXCERPT
		if($excerpt != ''){
			$return = rtrim(substr(strip_tags(esc_html($excerpt)), $start, $end), ' ').'...';
		} else {
			$return = rtrim(substr(strip_tags(esc_html($content)), $start, $end), ' ').'...';
		}

		#RETURN
		return $return;

	}

	#GET LOOKBOOKS
	public function htheme_get_lookbooks($atts){

		$html = '';

		//CONVERT TO OBJECT
		$obj = urldecode($atts['htheme_lookbooks']);
		$obj = json_decode($obj, true);
		$page = get_page_by_title( 'Lookbook' );

		$args = array(
			'post_type' => 'lookbook',
			'numberposts' => -1,
			'post_in' => $atts['htheme_lookbooks'],
		);

		$the_posts = get_posts($args);

		if($the_posts){
			#HTML START
			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_inner_col">';

						$html .= '<div class="htheme_category_slider"  id="htheme_category_slider_1">';
							$html .= '<div class="htheme_category_slider_inner">';
								$count_image = 1;
								foreach($the_posts as $book){
									$image_details = wp_get_attachment_image_src ( get_post_thumbnail_id ( $book->ID ), 'large' );
									$htheme_no_img = 'htheme_no_img';
									$image = '';
									if($image_details[0]){
										$image = 'style="background-image:url('.esc_url($image_details[0]).')"';
										$htheme_no_img = '';
									}
									$html .= '<a href="'.get_permalink($book->ID).'" class="htheme_category_slider_item '.esc_attr($htheme_no_img).'" data-id="'.esc_attr($count_image++).'" '.$image.'></a>';
								}
							$html .= '</div>';
							$html .= '<div class="htheme_category_slider_navigation">';
								$html .= '<div class="htheme_category_left htheme_icon_category_left htheme_category_button" data-side="left"></div>';
								$html .= '<div class="htheme_category_right htheme_icon_category_right htheme_category_button" data-side="right"></div>';
							$html .= '</div>';
							$html .= '<div class="htheme_category_slider_title_inner">';
								$html .= '<div class="htheme_category_slider_title_item" data-id="1">';
									$html .= '<h3>'.esc_html__('LOOK BOOKS','invogue').'</h3>';
									$html .= '<div class="htheme_category_slider_sub_item">';
										$count_title = 1;
										foreach($the_posts as $book){
											$html .= '<span class="htheme_category_span" data-id="'.$count_title++.'"><a href="'.esc_url(get_permalink($book->ID)).'" class="htheme_h3_sub">'.esc_html($book->post_title).'</a></span>';
										}
									$html .= '</div>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';

					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<!-- ROW -->';
		}

		return $html;

	}

}