<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = $row_padding = $row_margin = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

//print_r($atts);

#VARIABLE
$inner_row_start = '';
$inner_row_end = '';

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );
$row_padding = $atts['row_padding'];
$row_margin = $atts['row_margin'];

#ARRAYS
$css_classes = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();

#ROW PADDING
switch($row_padding){
	case 'row_padding_top_bottom':
		$css_classes[] = ' htheme_row_padding_top_bottom';
		break;
	case 'row_padding_top':
		$css_classes[] = ' htheme_row_padding_top';
		break;
	case 'row_padding_bottom':
		$css_classes[] = ' htheme_row_padding_bottom';
		break;
	case 'none':
		$css_classes[] = '';
		break;
}

#ROW MARGIN
switch($row_margin){
	case 'row_margin_top_bottom':
		$css_classes[] = ' htheme_row_margin_top_bottom';
		break;
	case 'row_margin_top':
		$css_classes[] = ' htheme_row_margin_top';
		break;
	case 'row_margin_bottom':
		$css_classes[] = ' htheme_row_margin_bottom';
		break;
	case 'none':
		$css_classes[] = '';
		break;
}

if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( ! empty( $full_width ) ) {
	switch($full_width){
		case 'stretch_row':
			$css_classes[] = ' htheme_vc_row_full_content_contained';
			$inner_row_start = '<div class="htheme_vc_row_inner">';
			$inner_row_end = '</div>';
			break;
		case 'stretch_row_content':
			$css_classes[] = ' htheme_vc_row_full_content_full';
			$inner_row_start = '<div class="htheme_vc_row_inner">';
			$inner_row_end = '</div>';
			break;
		case 'stretch_row_content_no_spaces':
			$css_classes[] = ' htheme_vc_row_full_content_full_no_space';
			break;
	}
} else {
	$css_classes[] = ' htheme_vc_row_contained';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' >';
$output .= $inner_row_start;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_row_end;
$output .= '</div>';

echo $output;
