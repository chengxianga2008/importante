<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO SETTINGS PANEL FOR GET WOO CONTENT
class htheme_getwoo{

	#CONSTRUCT
	public function __construct(){
		#SETUP
	}

	#GET PRODUCT CONTENT
	public function htheme_get_content_product($product){

		#VARIABLES
		$html = '';

		$return_array []= $this->htheme_get_product_array($product);

		foreach($return_array as $p){
			$html .= $this->htheme_get_content_product_html($p, 4, 'shop');
		}

		return $html;

	}

	#GET WOO PREVIEW
	public function htheme_get_preview(){

		#GLOBALS
		global $wpdb, $hmenu_helper, $woocommerce, $post;

		#SET PRODUCT
		$product = new WC_product($_POST['id']);
		$rating = $product->get_rating_html();

		#RETURN
		if($product){

			#VARIABLES
			$image_src_array = array();
			$obj = $this->htheme_get_product_array($product->post);

			#GET VARIATIONS
			if($product->product_type == 'variable'){
				$variations = $product->get_available_variations();
			}

			#BUILD IMAGE ARRAY
			$image_src = wp_get_attachment_image_src ( get_post_thumbnail_id ( $obj['id'] ), 'large' );

			#PUSH FIRST IMAGE INTO ARRAY
			array_push($image_src_array, array('image'=> $image_src[0], 'type' => 'normal', 'variation' => ''));

			#PUSH GALLERY IMAGES INTO ARRAY
			foreach($product->get_gallery_attachment_ids() as $image_id){
				$img = wp_get_attachment_url( $image_id );
				array_push($image_src_array, array('image'=> $img, 'type' => 'normal', 'variation' => ''));
			}

			#PUSH VARIATION IMAGES
			if($variations){
				foreach($variations as $var){
					array_push($image_src_array, array('image'=> $var['image_src'], 'type' => 'variation', 'variation' => $var['variation_id']));
				}
			}

			#VARIABLES
			$html = '';

			#HTML BUILDUP
			$html .= '<div class="htheme_preview_wrap woocommerce">';
				$html .= '<div class="htheme_preview_left">';
					$htheme_img_count = 1;
					foreach($image_src_array as $img){
						$html .= '<div class="htheme_preview_slide" data-id="'.esc_attr($htheme_img_count).'" style="background-image:url('.esc_url($img['image']).')"></div>';
						$htheme_img_count++;
					}
				$html .= '<div class="htheme_preview_nav"><div class="htheme_preview_btn_left htheme_preview_gal_btn" data-side="left"></div><div class="htheme_preview_btn_right htheme_preview_gal_btn" data-side="right"></div></div>';
				$html .= '</div>';
				$html .= '<div class="htheme_preview_right">';
					$html .= '<div class="htheme_preview_content">';
						$html .= '<h2>'.esc_html($obj['title']).'</h2>';
						$html .= '<span class="htheme_h2_sub">';
							$html .= $product->get_categories( ', ', '<span class="htheme_single_product_category">' . _n( 'Category:', '', 3, 'woocommerce' ) . ' ', '</span>' );
						$html .= '</span>';
						$html .= '<div class="htheme_single_product_price">';
							$html .= '<span class="htheme_single_product_price_sale">';
								$html .= $this->htheme_return_price_html($obj['id']);
							$html .= '</span>';
						$html .= '</div>';
						if( $obj['content']):
							$html .= '<span class="htheme_single_product_excerpt htheme_default_content">';
								$html .= $obj['product_description'];
							$html .= '</span>';
						endif;
						#GET TEMPLATE PART - RATING
						$html .= $rating;
						$html .= '<a href="'.esc_url($obj['url']).'" class="htheme_btn_style_1">';
							$html .= esc_html__('VIEW NOW', 'invogue');
						$html .= '</a>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';

			echo($html);
			exit();

		} else {
			echo json_encode('error');
			exit();
		}

	}

	#GET CART NAV DATA
	public function htheme_get_nav_wishlist_data(){

		#GLOBALS
		global $wpdb, $hmenu_helper, $woocommerce;

		if ( class_exists( 'WooCommerce' ) ) {

			#GET USER ID
			$user_ID = get_current_user_id();

			#GET USER WISHLIST
			$wishlist = esc_attr( get_the_author_meta( 'user_wishlist', $user_ID ) );

			#ARGS
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'offset' => 0,
				'include' => explode(',', $wishlist)
			);

			#PRODUCTS
			$products = get_posts($args);

			#ECHO JSON
			echo json_encode($products);
			exit();

		} else {

			#NOT ACTIVE
			echo json_encode(array(
				'status' => 'not'
			));

			exit();

		}

	}

	#ADD WISHLIST ITEM
	public function htheme_add_nav_wishlist_item(){

		#GLOBALS
		global $wpdb, $hmenu_helper, $woocommerce;

		if ( class_exists( 'WooCommerce' ) ) {

			#PRODUCT TO ADD TO WISHLIST
			$product_id = $_POST['id'];

			#GET USER ID
			$user_ID = get_current_user_id();

			#GET USER WISHLIST
			$wishlist = esc_attr( get_the_author_meta( 'user_wishlist', $user_ID ) );

			#CURRENT ID ARRAY
			$current_ID_array = explode(',', $wishlist);

			#PUSH VALUES
			array_push($current_ID_array, $product_id);

			#NEW PRODUCT IDS
			$new_ID_implode = implode(',', array_unique($current_ID_array));

			#UPDATE USERMETA
			update_user_meta( $user_ID, 'user_wishlist', $new_ID_implode );

			#ECHO JSON
			echo json_encode($new_ID_implode);
			exit();

		} else {

			#NOT ACTIVE
			echo json_encode(array(
				'status' => 'not'
			));

			exit();

		}

	}

	#DISPLAY WISHLIST
	public function htheme_show_wishlist(){

		#CHECK DELETE
		echo $this->htheme_delete_wishlist_item();

		#GET USER ID
		$user_ID = get_current_user_id();

		#GET USER WISHLIST
		$wishlist = esc_attr( get_the_author_meta( 'user_wishlist', $user_ID ) );

		#ARGS
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'offset' => 0,
			'include' => explode(',', $wishlist)
		);

		#PRODUCTS
		$products = get_posts($args);
		if($products){
		?>
		<div class="htheme_cart_holder">
		<div class="htheme_cart_head">
			<div class="htheme_col_8">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Product', 'woocommerce' ); ?>
				</div>
			</div>
			<div class="htheme_col_2">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Total', 'woocommerce' ); ?>
				</div>
			</div>
		</div>
		<div class="htheme_cart_content">
		<?php

			foreach($products as $product){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'medium');
				?>
				<div class="htheme_cart_row">
					<div class="htheme_col_1 htheme_position htheme_cart_image"
						 style="background-image:url(<?php echo esc_url($image[0]); ?>)">
						<div class="htheme_inner_col"></div>
					</div>
					<div class="htheme_col_5 htheme_position">
						<div class="htheme_inner_col">
							<div class="htheme_row_content_wrap">
								<h1><?php esc_html($product->post_title); ?></h1>
							</div>
						</div>
					</div>
					<div class="htheme_col_2 htheme_position">
						<div class="htheme_inner_col">

						</div>
					</div>
					<div class="htheme_col_2 htheme_position">
						<div class="htheme_inner_col">
							<?php
							echo $this->htheme_return_price_html($product->ID);
							?>
						</div>
					</div>
					<div class="htheme_col_1 htheme_position">
						<div class="htheme_inner_col">
							<a href="<?php echo esc_url(get_permalink($product->ID)); ?>" class="htheme_btn_style_1"><?php esc_html_e('VIEW', 'invogue'); ?></a>
						</div>
					</div>
					<div class="htheme_col_1 htheme_position">
						<?php $page = get_page_by_title('Wishlist'); ?>
						<a class="htheme_icon_cart_delete"
						   href="<?php echo esc_url(get_permalink($page->ID)); ?>?remove_wishlist_item=<?php echo esc_attr($product->ID); ?>"
						   data-delete-item="<?php echo esc_attr($product->ID); ?>"></a>
					</div>
				</div>
				<?php
			}

		?>
		</div>
		</div>
		<?php
			} else {
				?>
					<div class="woocommerce-error"><?php esc_html_e('Wishlist is empty.', 'invogue'); ?></div>
				<?php
			}
		?>
		<?php

	}

	public function htheme_delete_wishlist_item(){

		#CHECK IF ISSET
		if(isset($_GET['remove_wishlist_item'])){

			#GET USER ID
			$user_ID = get_current_user_id();

			#REMOVE ARRAY
			$remove_array = array($_GET['remove_wishlist_item']);

			#GET USER WISHLIST
			$wishlist = esc_attr( get_the_author_meta( 'user_wishlist', $user_ID ) );

			#NEW ARRAY
			$new = array_diff(explode(',', $wishlist), $remove_array);

			#UPDATE USERMETA
			update_user_meta( $user_ID, 'user_wishlist', implode(',', $new) );

			return '<div class="woocommerce-message">'.esc_html__('Wishlist item was removed successfully.', 'invogue').'</div>';

		}

	}

	#GET CART NAV DATA
	public function htheme_get_nav_cart_data(){

		#GLOBALS
		global $wpdb, $hmenu_helper, $woocommerce;

		if ( class_exists( 'WooCommerce' ) ) {

			#VARAIBLES
			$cart_count = $woocommerce->cart->cart_contents_count;
			$cart_link = esc_url(get_permalink(get_option('woocommerce_cart_page_id')));
			$cart = $woocommerce->cart->get_cart();
			$total_quantity = 0;

			#ARRAY OF ITEMS
			$cart_items = [];

			$cart_count = 1;

			#FOREACH CART ITEM
			foreach($cart as $item){

				$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $item['product_id'] ), 'full' );

				$cart_items[] = array(
					'id' => $item['product_id'],
					'title' => esc_html($item['data']->post->post_title),
					'quantity' => $item['quantity'],
					'total' => $item['line_subtotal'],
					'link' => get_permalink($item['product_id']),
					'price' => wc_get_price_decimals(),
					'image' => $image[0],
					'price_html' => $this->htheme_return_price_html($item['product_id']),
					'qty' => esc_html__('Qty', 'invogue'),
				);

				$total_quantity += $item['quantity'];

				$cart_count++;

			}

			#ECHO JSON
			echo json_encode(array(
				'status' => 'active',
				'count' => $total_quantity,
				'url' => $cart_link,
				'cart' => $cart_items,				
				'symbol' => get_woocommerce_currency_symbol(get_option('woocommerce_currency')),
				'total' => $woocommerce->cart->get_cart_total(),
			));
			exit();

		} else {

			#NOT ACTIVE
			echo json_encode(array(
				'status' => 'not'
			));
			exit();

		}

	}

	#REMOVE CART ITEM
	public function htheme_remove_cart_item(){

		#GLOBALS
		global $woocommerce;

		$prod_to_remove = intval($_POST['id']);

		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {

			$prod_id = $cart_item['product_id'];

			if( $prod_to_remove == $prod_id ) {
				$woocommerce->cart->set_quantity( $cart_item_key, $cart_item['quantity'] - 1, true  );
				break;
			}
		}

		#ECHO JSON
		echo json_encode(array(
			'status' => 'success',
		));
		exit();

	}

	#GET PRODUCT
	public function htheme_get_product_array($product_obj){

		#SET PRODUCT
		$product = wc_get_product( $product_obj->ID );

		#VARIABLES
		$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $product_obj->ID ), 'full' );
		$sale = false;
		$price = get_post_meta( $product_obj->ID, '_regular_price', true );
		$sale_price = get_post_meta( $product_obj->ID, '_sale_price', true );

		#CHECK IF SALE
		if($sale_price != "" && $sale_price >= 0 && $sale_price <= $price){
			$sale = true;
		}

		$variable_sale_price = $product->is_on_sale();

		$percentage = '';

		if($product->product_type != 'variable' && $sale_price != ''){
			$percentage = round((($price - $sale_price ) / $price ) * 100);
		}

		#FORMAT CONTENT
		if($product_obj->post_excerpt != ''){
			$content = rtrim(substr(__($product_obj->post_excerpt, 'invogue'), 0, 300)).'...';
		} else {
			$content = rtrim(substr(__($product_obj->post_content, 'invogue'), 0, 300));
		}

		return array(
			'id' => $product_obj->ID,
			'title' => $product_obj->post_title,
			'content' => $content,
			'product_description' => $product_obj->post_excerpt,
			'url' => esc_url(get_permalink($product_obj->ID)),
			'image' => esc_url($image[0]),
			'price' => $price,
			'sale_price' => $sale_price,
			'variable_sale_price' => $variable_sale_price,
			'currency' => get_option('woocommerce_currency'),
			'symbol' => get_woocommerce_currency_symbol(get_option('woocommerce_currency')),
			'percentage' => $percentage,
			'date' => substr($product_obj->post_date, 0, 10),
			'sale' => $sale,
			'cart_url' => $product->add_to_cart_url(),
			'cart_sku' => $product->get_sku(),
			'cart_text' => $product->add_to_cart_text(),
			'cart_type' => $product->product_type,
			'manage_stock' => $product->manage_stock,
			'stock' => $product->stock,
			'stock_status' => $product->stock_status,
			'all_data' => $product,
			'ajax' => get_option( 'woocommerce_enable_ajax_add_to_cart' )
		);

	}

	#GET HTML
	public function htheme_get_content_product_html($data, $columns = 4, $page = 'not_shop', $is_json = 'no'){

		#GLOBALS
		global $product, $woocommerce;

		#VARIABLES
		$html = '';
		$now = time(); // or your date as well
		$your_date = strtotime($data['date']);
		$datediff = $now - $your_date;
		$days = floor($datediff/(60*60*24));

		#SIDEBAR
		$sidebar = $GLOBALS['htheme_global_object']['settings']['woocommerce']['shopLayout'];

		#FADED LOAD STYLE
		$faded_style = '';
		if($is_json == 'yes'){
			$faded_style = 'htheme_faded_item';
		}

		#HTML
		$html .= '<!-- ITEM -->';
		if(is_product()){ #SINGLE PRODUCT
			$html .= '<div class="htheme_col_3 '.esc_attr($faded_style).' htheme_product_list_item" data-hover-type="hover_product_list">';
		} else if(is_cart()){
			$html .= '<div class="htheme_col_3 '.esc_attr($faded_style).' htheme_product_list_item" data-hover-type="hover_product_list">';
		} else if(is_shop() || is_product_category() || is_product_tag()){ #PRODUCT LIST
			if($page == 'shop' && $sidebar == 'no_sidebar'){
				$columns = 3;
			}
			#invogue demo site overwrite
			if($page == 'shop' && isset($_GET['sidebar']) == 'yes'){
				$columns = 4;
			}
			$html .= '<div class="htheme_col_'.esc_attr($columns).' '.esc_attr($faded_style).' htheme_product_list_item htheme_horz_slide_item" data-hover-type="hover_product_list">';
		} else {
			if($page == 'shop' && $sidebar == 'no_sidebar'){
				$columns = 3;
			}
			#invogue demo site overwrite
			if($page == 'shop' && $_GET['sidebar'] == 'yes'){
				$columns = 4;
			}
			$html .= '<div class="htheme_col_'.esc_attr($columns).' '.esc_attr($faded_style).' htheme_product_list_item htheme_horz_slide_item" data-hover-type="hover_product_list">';
		}

			$htheme_no_img = 'htheme_no_img';
			$image = '';
			if($data['image']){
				$image = 'style="background-image:url('.esc_url($data['image']).')"';
				$htheme_no_img = '';
			}
			$html .= '<div class="htheme_inner_col '.esc_attr($htheme_no_img).'" '.$image.'>';

				$htheme_meta_product_image_featured = get_post_meta( $data['id'], 'htheme_meta_product_image_featured', true );

				if($htheme_meta_product_image_featured){
					$html .= '<div class="htheme_product_secondary_img" style="background-image:url('.esc_url($htheme_meta_product_image_featured).')"></div>';
				}

				$html .= '<a class="htheme_product_item_link" href="'.esc_url($data['url']).'"></a>';

				#IF PRODUCT ON SALE SHOW TAG
				if($data['sale'] == 1 && $data['cart_type'] != 'variable'){
					$html .= '<div class="htheme_product_list_percent">-'.esc_html($data['percentage']).'%</div>';
				} else if($data['variable_sale_price'] == 1 && $data['cart_type'] == 'variable'){
					$html .= '<div class="htheme_product_list_percent">'.esc_html__('SALE!','invogue').'</div>';
				}

				#IF PRODUCT IS OLDER THAN 20 DAYS
				if($days <= 20){
					$html .= '<div class="htheme_product_list_new">'.esc_html__('NEW','invogue').'</div>';
				}

				#OPTIONS - WISHLIST, ADD, PREVIEW
				$is_ajax_add = '';
				if($data['cart_type'] == 'variable'){
					$is_ajax_add = '';
				} else if($data['cart_type'] == 'grouped'){
					$is_ajax_add = '';
				} else if($data['cart_type'] == 'external'){
					$is_ajax_add = '';
				} else if($data['stock'] == 0 && $data['manage_stock'] == 'yes'){
					$is_ajax_add = '';
				} else if($data['stock_status'] == 'outofstock'){
					$is_ajax_add = '';
				} else if($data['ajax']){
					$is_ajax_add = 'add_to_cart_button ajax_add_to_cart';
				}

				$html .= '<div class="htheme_product_list_options">';
					$html .= '<div class="htheme_icon_list_product_preview htheme_activate_preview" data-product-id="'.esc_attr($data['id']).'" data-product-url="'.esc_url($data['url']).'" data-tooltip="true" data-tooltip-text="'.esc_html__('Preview','invogue').'"></div>';
					$html .= '<a rel="nofollow" href="'.esc_url($data['cart_url']).'" data-quantity="1" data-tooltip="true" data-tooltip-text="'.esc_html($data['cart_text']).'" data-product_id="'.esc_attr($data['id']).'" data-product_sku="'.esc_attr($data['cart_sku']).'" class="htheme_icon_list_product_add product_type_'.esc_attr($data['cart_type']).' '.esc_attr($is_ajax_add).'"></a>';
				$html .= '</div>';

				$html .= '</div>';
				$html .= '<div class="htheme_product_list_content">';
					$html .= '<div class="htheme_inner_col">';
						$html .= '<a class="htheme_product_list_title" title="'.esc_attr($data['title']).'" href="'.esc_url($data['url']).'">'.esc_html($data['title']).'</a>';
						$html .= '<div class="htheme_product_list_price">'.$this->htheme_return_price_html($data['id']).'</div>';
					$html .= '</div>';
					$html .= '<div class="htheme_product_list_options">';
						#CHECK LOGIN STATUS
						$login_status = 'out';
						if(is_user_logged_in() && class_exists( 'WooCommerce' )){
							$login_status = 'in';
						}
						$html .= '<div class="htheme_icon_list_product_wishlist" data-login-status="'.esc_attr($login_status).'" data-tooltip="true" data-product-id="'.esc_attr($data['id']).'" data-tooltip-text="'.esc_html__('Wishlist','invogue').'"></div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '<!-- ITEM -->';

		return $html;

	}

	#GET PRODUCT LIST DATA
	public function htheme_get_woo_product_list($data, $loadmore_js = true){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		$term_list = '';
		$sort_value = '';
		$term_names = '';

		#ARGUMENTS
		if($loadmore_js){

			#VARIABLES
			$offset = $_POST['offset'];
			$categories = $_POST['categories'];
			$sorting = $_POST['sorting'];
			$rows = $_POST['rows'];
			$amount = $_POST['amount'];
			if($_POST['type'] == 'clear'){
				$posts_per_page =  (4*$rows);
			} else {
				$posts_per_page =  4;
			}

			$final_offset = $offset + $posts_per_page;

			#SET SORT VALUE
			$sort_value = $sorting;

			#ARGS
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $posts_per_page,
				'product_cat' => $categories,
				'offset' => $offset
			);

		} else {

			#VARIABLES
			$rows = isset($data['htheme_product_rows']) ? $data['htheme_product_rows'] : 1;
			$posts_per_page = (4*$rows);
			$term_list = '';
			$term_names = '';
			$the_offset = $posts_per_page;

			#GET TERMS
			if($data['htheme_woolist_ids']){
				foreach(explode(',', $data['htheme_woolist_ids']) as $id){
					$term = get_term(intval($id), 'product_cat', array("fields" => "ids"));
					$term_list .= $term->slug . ',';
					$term_names .= $term->name . ',';
				}
			}

			#SET SORT VALUE
			$sort_value = $data['htheme_woolist_sorting'];

			#CHECK LAYOUT TO DETERMINE AMOUNT OF PRODUCTS TO LOAD
			if($data['htheme_woolist_layout'] != 'contained_multi_caro'){
				$posts_per_page = -1;
			}

			#ARGS
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $posts_per_page,
				'product_cat' => rtrim($term_list, ','),
				'offset' => 0
			);

		}

		if($sort_value == 'title'){
			$args['orderby'] = 'title';
			$args['order'] = 'ASC';
		} else if($sort_value == 'date'){
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		} else if($sort_value == 'high_low'){
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_regular_price';
			$args['order'] = 'DESC';
		} else if($sort_value == 'low_high'){
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_regular_price';
			$args['order'] = 'ASC';
		}

		#QUERY POSTS
		$products = query_posts($args);

		#CHECK PRODUCT POSTS
		if($products){
			foreach($products as $product){
				$return_array []= $this->htheme_get_product_array($product);
			}
		}

		#HTML
		$html = '';

		#TITLE CATEGORIES
		$categories = explode(',', rtrim($term_names, ','));

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_list_' . $this->htheme_genGUID();

		#IS JS
		$is_json = 'yes';

		if($return_array){
			#IF JSON CALL ONLY LOAD THE ITEMS
			if(!$loadmore_js){

			#LOAD MORE HTML WRAP - START - TOP ------- LOADMORE
			$html .= '<!-- ROW -->';
			$html .= "<div class='htheme_row'>";

			#ALIGNMENT
			$style_align = '';
			switch(isset($data['htheme_category_align']) ? $data['htheme_category_align'] : 'left'){
				case 'left':
					$style_align = 'style="float:left;"';
					break;
				case 'right':
					$style_align = 'style="float:right;"';
					break;
				case 'center':
					$style_align = 'style="margin:0 auto;"';
					break;
			}

			#CATEGORIES
			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_product_categories_switch">';
				$html .= '<div class="htheme_categories_wrap" '.$style_align.'>';
					$html .= '<div class="htheme_inner_col">';
					if(count($categories) > 1 && $data['htheme_woolist_layout'] == 'contained_multi_caro'){
						$html .= '<span class="htheme_category_more htheme_is_active_category" data-offset="0" data-categories="'.esc_attr(rtrim($term_list, ',')).'" data-sorting="'.$data['htheme_woolist_sorting'].'" data-click-amount="'.$rows.'" data-link="'.$unique_id.'" data-type="clear">All</span>';
						foreach($categories as $name){
							$term = get_term_by('name', $name, 'product_cat');
							$html .= '<span class="htheme_category_more" data-offset="0" data-categories="'.esc_attr($term->slug).'" data-sorting="'.esc_attr($data['htheme_woolist_sorting']).'" data-click-amount="'.esc_attr($rows).'" data-link="'.esc_attr($unique_id).'" data-type="clear"> ' . $term->name . ' </span>';
						}
					}
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<!-- ROW -->';

			if($data['htheme_woolist_layout'] == 'contained_multi_caro'){

				$html .= '<div class="htheme_container">';
					$html .= '<!-- PRODUCT LIST -->';
					$html .= '<div class="htheme_product_list" data-type="htheme_contained_loader" data-rows="'.esc_attr($data['htheme_product_rows']).'" id="'.esc_attr($unique_id).'">';
						$html .= '<div class="htheme_product_list_inner">';

			} else {

				if($data['htheme_woolist_layout'] == 'contained_caro'){
					$html .= '<div class="htheme_container">';
				}

			#LOAD CAROUSEL - START - TOP ------- CAROUSEL
			$html .= '<div class="htheme_post_slider htheme_horz_slider" id="htheme_horz_slider_'.esc_attr($unique_id).'" data-items-big-desktop="6" data-items-desktop="4" data-items-tablet="3" data-items-mobile="1">';
				$html .= '<div class="htheme_post_slider_wrapper" data-height="430">';
					$html .= '<div class="htheme_post_slider_inner">';

			}
				$is_json = 'no';
			}

							foreach($return_array as $product){
								#RETURN HTML
								$html .= $this->htheme_get_content_product_html($product, 3, 'not_shop', $is_json);
							}

			#IF JSON CALL ONLY LOAD THE ITEMS
			if(!$loadmore_js){

			if($data['htheme_woolist_layout'] == 'contained_multi_caro'){

			#LOAD MORE HTML WRAP - END - BOTTOM ------- LOADMORE
						$html .= '</div>';
						$html .= '<div class="htheme_load_more" data-offset="'.esc_attr($the_offset).'" data-categories="'.esc_attr(rtrim($term_list, ',')).'" data-sorting="'.esc_attr($data['htheme_woolist_sorting']).'" data-click-amount="'.esc_attr($rows).'" data-link="'.esc_attr($unique_id).'" data-type="loadmore"><div class="htheme_load_more_btn">'.esc_html__('LOAD MORE','invogue').'<div class="htheme_icon_loadmore"></div></div></div>';
					$html .= '</div>';
					$html .= '<!-- PRODUCT LIST -->';
				$html .= '</div>';

			} else {

			#LOAD CAROUSEL - END - BOTTOM ------- CAROUSEL
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

				if($data['htheme_woolist_layout'] == 'contained_caro'){
					$html .= '</div>';
				}

			}

			$html .= '</div>';
			$html .= '<!-- ROW -->';

			}

		}


		#RETURN WOO CONTENT
		if($loadmore_js){
			echo $html;
			exit();
		} else {
			return $html;
		}

	}

	#GENERATE UNIQUE ID
	public function htheme_genGUID(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	#GET PRODUCT AJAX TEST
	public function htheme_ajax_load_test(){

		#GLOBALS
		global $woocommerce;

		#RETURN AJAX CONTENT
		echo json_encode(array('AJAX_LOAD_TEST'));
		exit();

	}

	#GET PRODUCT CATEGORY DATA
	public function htheme_get_woo_product_category($atts){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_slider_' . $this->htheme_genGUID();

		$html = '';

		if($atts['htheme_woocategory_ids']){
			$html .= '<!-- ROW -->';
			$html .= '<div class="htheme_row">';
			if($atts['htheme_woocategory_layout'] == 'contained_row'){
				$html .= '<div class="htheme_container">';
			}
			$html .= '<div class="htheme_post_slider htheme_horz_slider" id="' . esc_attr($unique_id) . '" data-items-big-desktop="6" data-items-desktop="4" data-items-tablet="3" data-items-mobile="1">';
			$html .= '<div class="htheme_post_slider_wrapper" data-height="450">';
			$html .= '<div class="htheme_post_slider_inner">';
			#GET TERMS
			foreach(explode(',', $atts['htheme_woocategory_ids']) as $id){
				$term = get_term(intval($id), 'product_cat', array("fields" => "ids"));
				$thumbnail_id = get_woocommerce_term_meta(intval($id), 'thumbnail_id', true);
				$image = wp_get_attachment_url($thumbnail_id);
				$no_image = '';
				if(!$image){
					$no_image = 'htheme_no_category_img';
				}
				$term_link = get_term_link(intval($id), 'product_cat');
				$html .= '<a href="' . esc_url($term_link) . '" class="htheme_col_2 htheme_product_category_item htheme_horz_slide_item" data-hover-type="hover_categories">';
				$html .= '<div class="htheme_inner_col ' . esc_attr($no_image) . '" style="background-image:url(' . esc_url($image) . ')">';
				$html .= '<div class="htheme_product_category_content">';
				$html .= '<div class="htheme_product_category_title">';
				$html .= '<h4>' . $term->name . '</h4>';
				$html .= '<div class="htheme_product_category_hidden">';
				$html .= '<span class="htheme_h4_sub">'.$term->count . ' ' . esc_html__('ITEMS', 'invogue').'</span>';
				$html .= '<span class="htheme_h4_sub">'.esc_html__('VIEW NOW', 'invogue').'</span>';
				$html .= '</div>';
				$html .= '<div class="htheme_cross_one"></div>';
				$html .= '<div class="htheme_cross_two"></div>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</a>';
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="htheme_horz_slider_pager">';
			$html .= '<div class="htheme_horz_slider_pager_inner">';
			$html .= '<div class="htheme_horz_pager_shifter"></div>';
			$html .= '</div>';
			$html .= '<div class="htheme_icon_horz_slider_left htheme_horz_side" data-side="left"></div>';
			$html .= '<div class="htheme_icon_horz_slider_right htheme_horz_side" data-side="right"></div>';
			$html .= '</div>';
			$html .= '</div>';
			if($atts['htheme_woocategory_layout'] == 'contained_row'){
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '<!-- ROW -->';
		} else {
			$html .= '<div class="htheme_row">';
			$html .= '<div class="htheme_container">';
			$html .= '<div class="htheme_no_data_available">'.esc_html__('Please check your element settings!', 'invogue').'</div>';
			$html .= '</div>';
			$html .= '</div>';
		}

		#RETURN WOO CONTENT
		return $html;

	}

	#GET PRODUCT COLUMN DATA
	public function htheme_get_woo_product_col($atts){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		$html = '';

		//CONVERT TO OBJECT
		$obj = urldecode($atts['htheme_woocol_cols']);
		$obj = json_decode($obj, true);

		$count = count($obj);

		#CHECK WHAT COL STRUCTURE IS REQUIRED
		$col_style = '';

		if($count == 4){
			$col_style = 'htheme_col_3';
		} else if($count == 3){
			$col_style = 'htheme_col_4';
		} else if($count == 2){
			$col_style = 'htheme_col_6';
		} else if($count == 1){
			$col_style = 'htheme_col_12';
		} else if($count > 4){
			$col_style = 'htheme_col_3';
		}

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row">';
			$html .= '<div class="htheme_container htheme_column_list">';
				$col_count = 1;
				foreach($obj as $col){
					if($col_count <= 4){ #MAXIMUM OF 4 columns
						$html .= '<div class="'.esc_attr($col_style).'">';
							$html .= '<div class="htheme_inner_col" data-hover-type="hover_column_list">';
								$html .= '<h4>';
									$html .= esc_html($col['htheme_woocol_title']);
								$html .= '</h4>';
								#ARGS
								if($col['htheme_woocol_display_type'] == 'category'){
									$term = get_term(intval($col['htheme_woocol_category']), 'product_cat', array("fields" => "ids"));
									$args = array(
										'post_type' => 'product',
										'posts_per_page' => intval($atts['htheme_woocol_display']),
										'product_cat' => $term->slug,
										'offset' => 0,
									);
								} else if($col['htheme_woocol_display_type'] == 'sale'){
									$args = array(
										'post_type' => 'product',
										'posts_per_page' => intval($atts['htheme_woocol_display']),
										'offset' => 0,
										'meta_query'     => array(
											'relation' => 'OR',
											array( // Simple products type
												'key'           => '_sale_price',
												'value'         => 0,
												'compare'       => '>',
												'type'          => 'numeric'
											),
											array( // Variable products type
												'key'           => '_min_variation_sale_price',
												'value'         => 0,
												'compare'       => '>',
												'type'          => 'numeric'
											)
										)
									);
								} else if($col['htheme_woocol_display_type'] == 'top_sales'){
									$args = array(
										'post_type' => 'product',
										'posts_per_page' => intval($atts['htheme_woocol_display']),
										'offset' => 0,
										'meta_key' => 'total_sales',
										'orderby' => 'meta_value_num',
									);
								} else if($col['htheme_woocol_display_type'] == 'rated'){
									$args = array(
										'post_type' => 'product',
										'posts_per_page' => intval($atts['htheme_woocol_display']),
										'offset' => 0,
										'meta_key' => '_wc_average_rating',
										'orderby' => 'meta_value_num',
									);
								}
								#GET PRODUCTS
								$products = query_posts($args);
								foreach($products as $product){
									$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $product->ID ), 'large' );
									$html .= '<a href="'.esc_url(get_permalink($product->ID)).'" class="htheme_product_column_item">';
										$html .= '<div class="htheme_product_column_image">';
											$html .= '<div class="htheme_product_column_image_inner" style="background-image:url('.esc_url($image[0]).')"></div>';
											$html .= '<div class="htheme_product_column_overlay"></div>';
										$html .= '</div>';
										$html .= '<div class="htheme_product_column_content">';
											$html .= '<div class="htheme_widget_content">'.esc_html($product->post_title).'</div>';
											//$html .= '<div class="htheme_widget_sub_content">Women / Dresses</div>';
											$html .= '<div class="htheme_widget_price">';
												$html .= $this->htheme_return_price_html($product->ID);
												$html .= '<div class="htheme_icon_column_arrow"></div>';
											$html .= '</div>';
										$html .= '</div>';
									$html .= '</a>';
								}
							$html .= '</div>';
						$html .= '</div>';
					}
					$col_count++;
				}
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		#RETURN WOO CONTENT
		return $html;

	}

	#GET THE LOOK DATA
	public function htheme_get_woo_look($atts){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		//CONVERT TO OBJECT
		$obj = urldecode($atts['htheme_look_looks']);
		$obj = json_decode($obj, true);

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_look_' . $this->htheme_genGUID();

		$html = '';

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row">';
			$html .= '<div class="htheme_look_holder" id="'.esc_attr($unique_id).'">';
				$html .= '<div class="htheme_look_navigation">';
					$html .= '<div class="htheme_icon_look_left htheme_icon_look_nav" data-side="left"></div>';
					$html .= '<div class="htheme_icon_look_right htheme_icon_look_nav" data-side="right"></div>';
				$html .= '</div>';
				$count = 1;
				foreach($obj as $look){
					$look_title = 'Lookbook ' . $count;
					if(isset($look['htheme_look_title'])){
						$look_title = $look['htheme_look_title'];
					}
					$html .= '<div class="htheme_look_item" data-id="'.esc_attr($count).'">';
						$html .= '<div class="htheme_look_content">';
							$html .= '<div class="htheme_look_inner_content">';
								$html .= '<h3 class="htheme_look_title">'.esc_html($look_title).'</h3>';
								#ARGUMENTS
								$args = array(
									'post_type' => 'product',
									'posts_per_page' => 10,
									'orderby'      => 'title',
									'include' => $look['htheme_look_products'],
								);
								#GET PRODUCTS
								$products = get_posts($args);

								foreach($products as $product){
									$html .= '<div class="htheme_look_inner_item">';
										$html .= '<h4 class="htheme_look_item_title">'.esc_html($product->post_title).'</h4>';
										#IF ON SALE
										$html .= '<div class="htheme_look_item_categories htheme_h4_sub">'.$this->htheme_return_price_html($product->ID).'</div>';
									$html .= '</div>';
								}
								$html .= '<div class="htheme_look_inner_item">';
									$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
									$html .= '<a href="'.esc_url($shop_page_url.'?get_title='.$look_title.'&get_look_products='.$look['htheme_look_products']).'" class="htheme_btn_style_1">'.esc_html__('VIEW ALL', 'invogue').'</a>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';

						$htheme_img_1 = '';
						if(isset($look['htheme_look_image_1'])){
							$htheme_img_1 = wp_get_attachment_url( $look['htheme_look_image_1'] );
						}
						$htheme_img_2 = '';
						if(isset($look['htheme_look_image_2'])){
							$htheme_img_2 = wp_get_attachment_url($look['htheme_look_image_2']);
						}

						if($htheme_img_1 && $htheme_img_2){
							$html .= '<div class="htheme_look_split htheme_split_1" style="background-image:url('.esc_url($htheme_img_1).')"></div>';
							$html .= '<div class="htheme_look_split htheme_split_2" style="background-image:url('.esc_url($htheme_img_2).')"></div>';
						} else if($htheme_img_1 && !$htheme_img_2){
							$html .= '<div class="htheme_look_split htheme_split_1 htheme_split_full" style="background-image:url('.esc_url($htheme_img_1).')"></div>';
						} else if($htheme_img_2 && !$htheme_img_1){
							$html .= '<div class="htheme_look_split htheme_split_1 htheme_split_full" style="background-image:url('.esc_url($htheme_img_2).')"></div>';
						}
					$html .= '</div>';
					$count++;
				}
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		#RETURN WOO CONTENT
		return $html;

	}

	#GET WOO PROMO
	public function htheme_get_woo_promo($atts){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		#UNIQUE ID GENERATE
		$unique_id = 'htheme_promo_' . $this->htheme_genGUID();

		$html = '';

		if($atts['htheme_promo_ids']){

		#ARGUMENTS
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 10,
			'orderby'      => 'title',
			'include' => $atts['htheme_promo_ids'],
		);

		#GET PRODUCTS
		$products = get_posts($args);

		$html .= '<!-- ROW -->';
		$html .= '<div class="htheme_row htheme_no_padding htheme_row_margin htheme_promo_main">';

			$html .= '<div class="htheme_promo_images">';

				$count_image = 1;
				foreach($products as $product){

					$promo_image = get_post_meta( $product->ID, 'htheme_meta_product_image', true );

					$html .= '<div class="htheme_promo_slide_bg" data-id="'.esc_attr($count_image).'" style="background-image:url('.esc_url($promo_image).')">';
					$html .= '</div>';

					$count_image++;

				}

			$html .= '</div>';

			$html .= '<div class="htheme_container htheme_promo_container">';
				$html .= '<div class="htheme_inner_col">';
					$html .= '<div class="htheme_promo_slider" id="'.esc_attr($unique_id).'">';
						$html .= '<div class="htheme_promo_slide_inner">';
							$html .= '<div class="htheme_promo_slider_nav">';
								$html .= '<div class="htheme_icon_promo_left htheme_promo_navigate" data-side="left"></div>';
								$html .= '<div class="htheme_icon_promo_right htheme_promo_navigate" data-side="right"></div>';
							$html .= '</div>';

							$count_content = 1;
							foreach($products as $product){

								$promo_image = get_post_meta( $product->ID, 'htheme_meta_product_image', true );

								$html .= '<div class="htheme_promo_slide" data-id="'.esc_attr($count_content).'">';
									$html .= '<div class="htheme_promo_content">';
										$html .= '<h2 class="htheme_promo_title">'.esc_html($product->post_title).'</h2>';
										$html .= '<h3 class="htheme_promo_price">';
											$html .= $this->htheme_return_price_html($product->ID);
										$html .= '</h3>';
										$html .= '<div class="htheme_promo_desc">';
											$html .= esc_html(strip_tags($product->post_excerpt));
										$html .= '</div>';
										$html .= '<div class="htheme_promo_title">';
											$html .= '<a href="'.esc_url(get_permalink($product->ID)).'" class="htheme_btn_style_1">'.esc_html__('VIEW PRODUCT', 'invogue').'</a>';
										$html .= '</div>';
									$html .= '</div>';
								$html .= '</div>';
								$count_content++;
							}

						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<!-- ROW -->';

		} else {
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_no_data_available">'.esc_html__('Please check your element settings!','invogue').'</div>';
				$html .= '</div>';
			$html .= '</div>';
		}

		#RETURN WOO CONTENT
		return $html;

	}

	#GET WOO PROMO
	public function htheme_get_topten_promo($atts){

		#GLOBALS
		global $wpdb, $post, $woocommerce;

		#SETUP
		@setup_postdata($post);

		$html = '';

		if($atts['htheme_topten_ids']){

		#ARGUMENTS
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'include' => $atts['htheme_topten_ids'],
		);

		?>

		<!-- ROW -->
		<div class="htheme_row">
			<div class="htheme_container">
				<div class="htheme_most_wanted_holder">

		<?php

		#GET PRODUCTS
		$products = get_posts($args);
		$count = 0;

		foreach($products as $product){

			$image_html = '';
			$content_html = '';

			$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $product->ID ), 'full' );

			$sale = false;
			$price = get_post_meta( $product->ID, '_regular_price', true );
			$sale_price = get_post_meta( $product->ID, '_sale_price', true );

			#CHECK IF SALE
			if($sale_price != "" && $sale_price >= 0 && $sale_price <= $price){
				$sale = true;
			}

			$symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));

			$html .= '<div class="htheme_most_wanted_item" data-hover-type="hover_top_ten_item">';

				$image_html .= '<a href="'.esc_url(get_permalink($product->ID)).'" class="htheme_col_6 htheme_most_wanted_image">';
					$htheme_no_img = 'htheme_no_img';
					$img = '';
					if($image[0]){
						$img = 'style="background:url('.esc_url($image[0]).') center no-repeat"';
						$htheme_no_img = '';
					}
					$image_html .= '<div class="htheme_inner_col '.esc_attr($htheme_no_img).'" '.$img.'></div>';
				$image_html .= '</a>';

				$content_html .= '<div class="htheme_col_6 htheme_most_wanted_content">';
					$content_html .= '<div class="htheme_inner_col">';
						$content_html .= '<div class="htheme_most_wanted_inner_content">';
							$content_html .= '<h2>';
								$content_html .= esc_html($product->post_title);
							$content_html .= '</h2>';
							$content_html .= '<span class="htheme_default_content">';
								$content_html .= esc_html(strip_tags($product->post_excerpt));
							$content_html .= '</span>';
							$content_html .= '<h3 class="htheme_most_wanted_price">';
								$content_html .= $this->htheme_return_price_html($product->ID);
							$content_html .= '</h3>';
						$content_html .= '</div>';
						$content_html .= '<div class="htheme_most_wanted_line_1"></div>';
						$content_html .= '<div class="htheme_most_wanted_line_2"></div>';
						$content_html .= '<div class="htheme_most_wanted_social">';
							#CHECK LOGIN STATUS
							$login_status = 'out';
							if(is_user_logged_in() && class_exists( 'WooCommerce' )){
								$login_status = 'in';
							}
							$content_html .= '<div class="htheme_icon_most_wanted_view htheme_most_wanted_icon htheme_activate_preview" data-tooltip="true" data-tooltip-text="Preview" data-product-id="'.esc_attr($product->ID).'" data-product-url="'.esc_url(get_permalink($product->ID)).'"></div>';
							$content_html .= '<div class="htheme_icon_most_wanted_wish htheme_most_wanted_icon" data-login-status="'.esc_attr($login_status).'"  data-tooltip="true" data-product-id="'.esc_attr($product->ID).'" data-tooltip-text="Wishlist"></div>';
						$content_html .= '</div>';
					$content_html .= '</div>';
				$content_html .= '</div>';

				$mod = $count % 2;

				if($mod == 0){
					$html .= $image_html;
					$html .= $content_html;
				} else {
					$html .= $content_html;
					$html .= $image_html;
				}

			$html .= '</div>';

			$count++;
		}

				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';

		} else {
			$html .= '<div class="htheme_row">';
				$html .= '<div class="htheme_container">';
					$html .= '<div class="htheme_no_data_available">'.esc_html__('Please check your element settings!','invogue').'</div>';
				$html .= '</div>';
			$html .= '</div>';
		}

		#RETURN WOO CONTENT
		return $html;

	}

	#RETURN PRODUCT HTML
	public function htheme_return_price_html($ID){
		#$product_id = new WC_Product($ID); OLD VERSION - NOT WORKING WITH SUDO REWARDS PLUGIN
		$product_id = wc_get_product($ID);
		return $product_id->get_price_html();
	}

}