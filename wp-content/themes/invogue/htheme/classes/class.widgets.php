<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO ACTIVATION CLASS
class htheme_widgets extends WP_Widget{

	#CONSTRUCT
	public function __construct(){
		parent::__construct(
			'htheme_image_text_widget', // Base ID
			esc_html__( 'InVogue Custom Image & Text', 'invogue' ), // Name
			array( 'description' => esc_html__( 'Custom inVogue widget for sidebars, add an image and text.', 'invogue' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) || ! empty( $instance['sub_title'] ) || ! empty( $instance['excerpt'] ) || ! empty( $instance['widget_image'] )  ) {
			?>
				<div class="htheme_image_text_widget">
					<?php if($instance['widget_image']){ ?>
					<div class="htheme_image_text_img" style="background-image:url(<?php echo esc_url($instance['widget_image']); ?>)"></div>
					<?php } ?>
					<?php if($instance['title']){ ?>
					<h3 class="htheme_image_text_title"><?php echo esc_html($instance['title']); ?></h3>
					<?php } ?>
					<?php if($instance['sub_title']){ ?>
					<span class="htheme_image_text_sub htheme_h3_sub"><?php echo esc_html($instance['sub_title']); ?></span>
					<?php } ?>
					<?php if($instance['excerpt']){ ?>
					<div class="htheme_image_text_content">
						<?php echo esc_html($instance['excerpt']); ?>
					</div>
					<?php } ?>
				</div>
			<?php
		}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'invogue' );
		$sub_title = ! empty( $instance['sub_title'] ) ? $instance['sub_title'] : esc_html__( '', 'invogue' );
		$excerpt = ! empty( $instance['excerpt'] ) ? $instance['excerpt'] : esc_html__( '', 'invogue' );
		$widget_image = ! empty( $instance['widget_image'] ) ? $instance['widget_image'] : esc_html__( '', 'invogue' );
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'invogue' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'sub_title' )); ?>"><?php esc_html_e( 'Sub Title:', 'invogue' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'sub_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sub_title' )); ?>" type="text" value="<?php echo esc_attr( $sub_title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'excerpt' )); ?>"><?php esc_html_e( 'Excerpt:', 'invogue' ); ?></label>
			<textarea rows="4" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'excerpt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'excerpt' )); ?>"><?php echo esc_attr( $excerpt ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'widget_image' )); ?>"><?php esc_html_e( 'Image:', 'invogue' ); ?></label>
			<input class="widefat" data-widget-field="htheme_widget_image_input" id="<?php echo esc_attr($this->get_field_id( 'widget_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_image' )); ?>" type="text" value="<?php echo esc_attr( $widget_image ); ?>">
		</p>

		<div class="htheme_form_col_12" style="width:100%; padding-bottom:15px;">
			<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="<?php echo esc_attr($this->get_field_id( 'widget_image' )); ?>" data-multiple="false" data-size="full">
				<?php echo esc_html__('Upload Image', 'invogue'); ?>
			</div>
			<div class="htheme_widget_image" style="background-image:url(<?php echo esc_url( $widget_image ); ?>);"></div>
		</div>

		<script type="text/javascript">
			//CONVERT COMPONENTS
			htheme_convert_components();
			//SET META DATA
			htheme_set_meta_data();
			//SET UPDATE DATA
			htheme_set_meta_update();
		</script>

		<?php

		wp_enqueue_media();

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['sub_title'] = ( ! empty( $new_instance['sub_title'] ) ) ? strip_tags( $new_instance['sub_title'] ) : '';
		$instance['excerpt'] = ( ! empty( $new_instance['excerpt'] ) ) ? strip_tags( $new_instance['excerpt'] ) : '';
		$instance['widget_image'] = ( ! empty( $new_instance['widget_image'] ) ) ? strip_tags( $new_instance['widget_image'] ) : '';

		return $instance;
	}


}