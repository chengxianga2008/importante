<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO WALKER CLASS
class htheme_walker extends Walker{

	var $htheme_global_opts;
	var $htheme_global_enable;

	#CONSTRUCT
	function __construct(){
		$this->htheme_global_opts = $GLOBALS['htheme_global_object']['settings']['megamenu']['menuItems'];
		$this->htheme_global_enable = $GLOBALS['htheme_global_object']['settings']['megamenu']['enable'];
	}

	#HAS CHILDREN
	public $has_children;

	#WHAT THE CLASS HANDLES
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	#DATABASE FILEDS TO USE
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	#STARTS THE LIST BEFORE THE ELEMENTS ARE ADDED
	public function start_lvl( &$output, $depth = 0, $args = array() , $id = 0) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	#ENDS THE LIST AFTER THE ELEMENTS ARE ADDED
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	#START ELEMENT OUTPUT
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$htheme_mobile_class = '';
		foreach($this->htheme_global_opts as $i){
			if($i['id'] == $item->ID){
				$classes[] = 'htheme_has_mega';
			}
			if($i['enableMobile'] == 'no' && $i['id'] == $item->ID){
				$classes[] = 'htheme_mega_not_mobile';
			}
		}
		$classes[] = 'menu-item-' . $item->ID;

		#FILTERS THE ARGUMENTS FOR A SINGLE NAV MENU ITEM
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		#FILTERS THE CSS CLASS(ES) APPLIED TO A MENU ITEM'S LIST ITEM ELEMENT
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		#FILTERS THE ID APPLIED
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		#FILTERS THE HTML ATTR APPLIED TO A MENU ITEM'S ANCHOR ELEMENT
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		#THIS FILTER IS DOCUMENTED IN (wp-includes/post-template.php)
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		

		#FILTERS THE MENU ITEMS TITLE
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</span></a>';

		#MEGA MENU
		foreach($this->htheme_global_opts as $i){
			if($i['id'] == $item->ID && $i['enable'] == 'on' && $this->htheme_global_enable == 'true'){
				$item_output .= '<div class="htheme_mm_holder sub-menu htheme_mega_'.$i['id'].'" style="background-image:url('.$i['backgroundImage'].'); background-position:'.$i['backgroundPosition'].'; background-color:'.$i['backgroundColor'].'">'; #
					$item_output .= $this->htheme_get_mega($i['menuData']);
				$item_output .= '</div>';
			}
		}

		$item_output .= $args->after;

		#FILTERS THE MENU ITEMS STARTING OUTPUT
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;
		
		// changed by jack
		if($id == "1667"){
			$element->title = "<strong>MY ACCOUNT</strong>";
		}
		
		
		if(!is_user_logged_in()){
			if($id == "1667" || $id == "1485"){
				$this->clear_children($children_elements, $id);
				return;
			}
		}

		//display this element
		$this->has_children = ! empty( $children_elements[ $id ] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Back-compat.
		}

		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		#REMOVE CHILDREN IF MEGA MENU
		foreach($this->htheme_global_opts as $i){
			if($i['id'] == $element->ID && $i['enable'] == 'on' && $this->htheme_global_enable == 'true'){
				$this->clear_children($children_elements, $id);
			}
		}

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach ( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);

	}

	#CLEAR THE CHILDREN
	function clear_children( &$children_elements , $id ){

		if( empty( $children_elements[ $id ] ) ) return;

		foreach( $children_elements[ $id ] as $child ){
			$this->clear_children( $children_elements , $child->ID );
		}
		unset( $children_elements[ $id ] );
	}

	#END THE ELEMENT OUTPUT IF NEEDED
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	#GET MEGA
	public function htheme_get_mega($data){

		$html = '';

		if($data){

			$count = count($data);
			$style = '';

			switch($count){
				case 1:
					$style = '12';
				break;
				case 2:
					$style = '6';
				break;
				case 3:
					$style = '4';
				break;
				case 4:
					$style = '3';
				break;
			}

			foreach($data as $col){
				$html .= '<div class="htheme_col_'.esc_attr($style).'">';
					$html .= '<div class="htheme_inner_col">';
						if($col['title'] != ''):
							$html .= '<div class="htheme_mega_title">'.$col['title'].'</div>';
						endif;
						$html .= '<div class="htheme_mega_content">'.$this->htheme_get_mega_content($col).'</div>';
					$html .= '</div>';
				$html .= '</div>';
			}

		} else {

			$html .= '<div class="htheme_col_12">';
				$html .= '<div class="htheme_inner_col">';
					$html .= '<div class="htheme_mega_title">'.esc_html('Error!').'.</div>';
				$html .= '</div>';
			$html .= '</div>';

		}

		return $html;

	}

	#GET MEGA
	public function htheme_get_mega_content($data){

		#VARAIBLES
		$html = '';

		if($data){

			switch($data['type']){
				case 'posts':
					$html .= $this->htheme_get_mega_posts($data['type'],$data['showType']);
					break;
				case 'pages':
					$html .= $this->htheme_get_mega_pages($data['type'],$data['showPages']);
					break;
				case 'products':
					$html .= $this->htheme_get_mega_products($data['type'],$data['showType']);
					break;
				case 'categories':
					$html .= 'Categories';
					break;
				case 'plainHtml':
					$html .= $this->htheme_get_html($data['type'],$data['showHtml']);
					break;
			}

		} else {

			$html .= esc_html('Error!');

		}


		return $html;

	}

	#GET MEGA
	public function htheme_get_html($type, $show){

		#VARIABLES
		$html = '';

		$html .= $show;

		return $html;

	}

	#GET MEGA
	public function htheme_get_mega_posts($type, $show){

		#GLOBALS
		global $post;
		setup_postdata( $post );

		#VARIABLES
		$html = '';

		#ARGUMENTS
		$mega_args = array(
			'post_type' => array( 'post' ),
			'posts_per_page' => 4,
			'post_status' => 'publish',
			'post__not_in' => get_option( 'sticky_posts' )
		);

		#ADD ARGS TO QUERY
		$posts = get_posts($mega_args);

		if ( $posts ) :

			foreach($posts as $p){
				$html .= '<div class="htheme_mega_item">';
					$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $p->ID ), 'small' );
					if ( $post_image ) :
						$html .= '<div class="htheme_mega_item_image" style="background-image:url('.$post_image[0].')"></div>';
					endif;
					$html .= '<div class="htheme_mega_item_content">';
						$html .= '<a href="'.get_permalink($p->ID).'">' . $p->post_title . '</a>';
						$html .= '<span class="htheme_mega_date">'.mysql2date(get_option( 'date_format' ), $p->post_date).'</span>';
					$html .= '</div>';
				$html .= '</div>';
			}

		endif;

		return $html;

	}

	#GET MEGA
	public function htheme_get_mega_pages($type, $show){

		#GLOBALS
		global $post, $woocommerce, $product;
		setup_postdata( $post );

		#VARIABLES
		$html = '';

		#ARGUMENTS
		$mega_args = array(
			'post_type' => 'page',
			'post__in' => explode(',' ,$show),
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'DESC',
		);

		#ADD ARGS TO QUERY
		$pages = get_posts($mega_args);

		foreach($pages as $p){
			$html .= '<div class="htheme_mega_item">';
				$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $p->ID ), 'small' );
				if ( $post_image ) :
					$html .= '<div class="htheme_mega_item_image" style="background-image:url('.$post_image[0].')"></div>';
				endif;
				$html .= '<div class="htheme_mega_item_content">';
					$html .= '<a href="'.get_permalink($p->ID).'">' . esc_html($p->post_title) . '</a>';
				$html .= '</div>';
			$html .= '</div>';
		}

		return $html;

	}

	#GET MEGA
	public function htheme_get_mega_products($type, $show){

		#VARIABLES
		$html = '';

		if ( class_exists( 'WooCommerce' ) ){

			#GLOBALS
			global $post, $woocommerce, $product;
			setup_postdata( $post );

			$mega_args = [];

			switch($show){
				case 'Latest':
					$mega_args = array(
						'post_type' => 'product',
						'post_status' => 'publish',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);
					break;
				case 'Top Sales':
					#ARGUMENTS
					$mega_args = array(
						'post_type' => 'product',
						'posts_per_page' => 4,
						'offset' => 0,
						'meta_key' => 'total_sales',
						'orderby' => 'meta_value_num',
					);
					break;
				case 'Top Rated':
					$mega_args = array(
						'post_type' => 'product',
						'posts_per_page' => 4,
						'offset' => 0,
						'meta_key' => '_wc_average_rating',
						'orderby' => 'meta_value_num',
					);
					break;
				default:
					$mega_args = array(
						'post_type' => 'product',
						'post_status' => 'publish',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);
					break;
			}

			#ADD ARGS TO QUERY
			$pages = get_posts($mega_args);

			foreach($pages as $p){
				$html .= '<div class="htheme_mega_item">';
				$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $p->ID ), 'small' );
				if ( $post_image ) :
					$html .= '<div class="htheme_mega_item_image" style="background-image:url('.$post_image[0].')"></div>';
				endif;
				$html .= '<div class="htheme_mega_item_content">';
				$html .= '<a href="'.get_permalink($p->ID).'">' . $p->post_title . '</a>';
				$product_id = wc_get_product($p->ID);
				$html .= '<span class="htheme_mega_date">'.$product_id->get_price_html().'</span>';
				$html .= '</div>';
				$html .= '</div>';
			}


		} else {
			$html .= '';
		}

		return $html;

	}

}