<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO WIDGET OVERWRITE
class htheme_recentreviews extends WC_Widget_Recent_Reviews {

	public function widget( $args, $instance ) {
		global $comments, $comment;

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			$this->widget_start( $args, $instance );

			echo '<ul class="product_list_widget">';

			foreach ( (array) $comments as $comment ) {

				$_product = wc_get_product( $comment->comment_post_ID );

				$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $_product->ID ), 'small' );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = $_product->get_rating_html( $rating );

				echo '<li><a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" class="htheme_sidebar_post_item">';

				?>
				<div class="htmeme_sidebar_post_image" style="background-image:url(<?php echo esc_url($image[0]); ?>);"></div>
				<div class="htheme_sidebar_post_heading">
					<?php echo esc_html($_product->get_title()); ?>
					<span>
						<?php printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'woocommerce' ) . '</span>', get_comment_author() ); ?>
					</span>
				</div>
				<?php echo $rating_html; ?>
				<?php

				echo '</a>';

				echo '</li>';
			}

			echo '</ul>';

			$this->widget_end( $args );
		}

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}

}