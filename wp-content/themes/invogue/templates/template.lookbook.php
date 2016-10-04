<?php
/*
Template Name: inVogue - Lookbook Template
*/

get_header(); ?>

<!-- ALTER QUERY -->
<?php

	#GLOBALS
	global $wp_query, $wp_rewrite;

	#VARAIBLES
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$htheme_lookbook_layout = $GLOBALS['htheme_global_object']['settings']['lookbook']['layout'];
	$reading_posts_per_page = get_option( 'posts_per_page' );

	#QUERIED OBJECT
	$get_category_obj = get_queried_object();

	#ARGS
	$args = array(
		'post_type' => 'lookbook',
		'posts_per_page' => $reading_posts_per_page,
		'paged' => $paged,
		'orderby'=> 'menu_order',
		'order' => 'ASC',
		'offset' => 0
	);

	#GET POSTS
	query_posts($args);

?>

<?php

	$big = 999999999; // need an unlikely integer

	#PAGER ARGS
	$pager_args = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $wp_query->max_num_pages,
		'prev_next'          => true,
		'prev_text'          => esc_html__('', 'invogue'),
		'next_text'          => esc_html__('', 'invogue'),
	);

?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- SET HEADER IF ON IS NOT SELECTED -->
	<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				switch($htheme_lookbook_layout){
					case 'default':
						#INCLUDE ARCHIVE LOOKBOOK TEMPLATE
						get_template_part( 'htheme/templateparts/content/post', 'archive-lookbook' );
						break;
					case 'layout_one':
						#INCLUDE ARCHIVE LOOKBOOK TEMPLATE
						get_template_part( 'htheme/templateparts/content/post', 'archive-lookbook-layout-one' );
						break;
				}
			?>

		<?php endwhile; ?>

		<div class="htheme_pager_holder">
			<?php echo paginate_links($pager_args); ?>
		</div>

		<!-- IF NO POSTS -->
		<?php else : ?>
			NO POSTS
		<?php endif; ?>

	<!-- RESET QUERY -->
	<?php wp_reset_query(); ?>

	<!-- OUTPUT OTHER CONTENT -->
	<?php get_template_part( 'htheme/templateparts/content/the', 'content' ); ?>

</div>
<!-- CONTENT HOLDER -->



<?php get_footer(); ?>
