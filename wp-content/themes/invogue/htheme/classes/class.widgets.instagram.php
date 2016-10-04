<?php
/**
 * THEME - Hello Friday
 * AUTHOR - HeroPlugins
 * URL - http://heroplugins.com/
 */

#EXTEND WIDGET CLASS
class htheme_widgets_instagram extends WP_Widget{

	#CONSTRUCT
	public function __construct(){
		parent::__construct(
			'htheme_image_instagram_widget', // Base ID
			esc_html__( 'inVogue Instagram Widget', 'invogue' ), // Name
			array( 'description' => esc_html__( 'Custom inVogue instagram widget for the sidebar.', 'invogue' ), ) // Args
		);
	}

	#WIDGET FRONT END
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['htheme_image_count'] ) || ! empty( $instance['htheme_instagram_title'] ) ) {
			?>
				<?php if($instance['htheme_instagram_title']){ ?>
				<h2><span> <?php echo esc_html($instance['htheme_instagram_title']); ?> </span></h2>
				<?php } ?>
				<div class="htheme_image_instagram_widget">
					<?php
					#RUN INSTAGRAM
					$htheme_instagram = new htheme_getcontent();
					echo $htheme_instagram->htheme_get_instagram(false, $instance['htheme_instagram_id'], $instance['htheme_instagram_access'], $instance['htheme_image_count'], 'widget');
					?>
				</div>
			<?php
		}
		echo $args['after_widget'];
	}

	#WIDGET BACK END
	public function form( $instance ) {
		$htheme_instagram_title = ! empty( $instance['htheme_instagram_title'] ) ? $instance['htheme_instagram_title'] : esc_html__( '', 'invogue' );
		$htheme_instagram_id = ! empty( $instance['htheme_instagram_id'] ) ? $instance['htheme_instagram_id'] : esc_html__( '', 'invogue' );
		$htheme_instagram_access = ! empty( $instance['htheme_instagram_access'] ) ? $instance['htheme_instagram_access'] : esc_html__( '', 'invogue' );
		$htheme_image_count = ! empty( $instance['htheme_image_count'] ) ? $instance['htheme_image_count'] : esc_html__( '', 'invogue' );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'invogue' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'htheme_instagram_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'htheme_instagram_title' )); ?>" type="text" value="<?php echo esc_attr( $htheme_instagram_title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Instagram User ID:', 'invogue' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'htheme_instagram_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'htheme_instagram_id' )); ?>" type="text" value="<?php echo esc_attr( $htheme_instagram_id ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Instagram Access Token:', 'invogue' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'htheme_instagram_access' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'htheme_instagram_access' )); ?>" type="text" value="<?php echo esc_attr( $htheme_instagram_access ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'htheme_image_count' )); ?>"><?php esc_html_e( 'Image count:', 'invogue' ); ?></label>
			<?php $options = array(3,6,9,12); ?>
			<select name="<?php echo esc_attr($this->get_field_name( 'htheme_image_count' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'htheme_image_count' )); ?>">
				<?php foreach($options as $opt){ ?>
					<option <?php selected( esc_attr( $htheme_image_count ), $opt ) ?> value="<?php echo esc_attr($opt); ?>"><?php esc_html_e('Images to show', 'invogue') ?> - <?php echo esc_attr($opt); ?></option>
				<?php } ?>
			</select>
		</p>
		<?php

	}

	#WIDGET SAVE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['htheme_instagram_title'] = ( ! empty( $new_instance['htheme_instagram_title'] ) ) ? strip_tags( $new_instance['htheme_instagram_title'] ) : '';
		$instance['htheme_instagram_id'] = ( ! empty( $new_instance['htheme_instagram_id'] ) ) ? strip_tags( $new_instance['htheme_instagram_id'] ) : '';
		$instance['htheme_instagram_access'] = ( ! empty( $new_instance['htheme_instagram_access'] ) ) ? strip_tags( $new_instance['htheme_instagram_access'] ) : '';
		$instance['htheme_image_count'] = ( ! empty( $new_instance['htheme_image_count'] ) ) ? strip_tags( $new_instance['htheme_image_count'] ) : '';
		return $instance;
	}


}