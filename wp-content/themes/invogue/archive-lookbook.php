<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
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

	#ARGUMENTS
	$args = array(
		'post_type' => array( 'lookbook' ),
		'posts_per_page' => $reading_posts_per_page,
		'paged' => $paged
	);

	#ADD ARGS TO QUERY
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

	<?php if ( have_posts() ) : ?>

		<!-- ROW -->
		<div class="htheme_row htheme_padding_bottom">
			<div class="htheme_container">
				<div class="htheme_inner_col">
					<!-- TITLE DEFAULT -->
					<div class="htheme_title_container" data-title-type="default">
						<?php
						the_archive_title( '<div class="htheme_title"><h1>', '</h1></div>' );
						the_archive_description( '<div class="htheme_sub_title htheme_h1_sub">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- ROW -->

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

</div>
<!-- CONTENT HOLDER -->

<!-- RESET QUERY -->
<?php
	wp_reset_query();
?>

<?php get_footer(); ?>
