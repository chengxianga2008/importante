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
	$reading_posts_per_page = get_option( 'posts_per_page' );

	#QUERIED OBJECT
	$get_category_obj = get_queried_object();

	#ARGUMENTS
	$args = array(
		'category_name' => $get_category_obj->slug,
		'post_type' => array( 'post' ),
		'posts_per_page' => $reading_posts_per_page,
		'paged' => $paged,
		'ignore_sticky_posts' => 1
	);

	#ADD ARGS TO QUERY
	query_posts( $args );

	$htheme_masonry = $GLOBALS['htheme_global_object']['settings']['blog']['masonry'];

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
						<div class="htheme_title">
							<h1>
								<?php echo esc_html($get_category_obj->name); ?>
							</h1>
						</div>
						<?php if ( category_description() ) : ?>
							<div class="htheme_sub_title htheme_h1_sub">
								<?php echo category_description(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- ROW -->

		<?php if ( have_posts() ) : ?>

			<?php
			#GET POST FILTER
			do_action('htheme_get_post_filter');
			?>

			<?php if($htheme_masonry == 'true'){ ?>
				<div class="htheme_masonry_holder">
			<?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- VARAIBLES -->
				<?php
				if($htheme_masonry != 'true'){
					#INCLUDE ARCHIVE POST TEMPLATE
					get_template_part( 'htheme/templateparts/content/post', 'archive' );
				} else {
					#INCLUDE MASONRY POST TEMPLATE
					get_template_part( 'htheme/templateparts/content/post', 'masonry' );
				}
				?>

			<?php endwhile; ?>

			<?php if($htheme_masonry == 'true'){ ?>
				</div>
			<?php } ?>

			<!-- IF NO POSTS -->
		<?php else : ?>

		<?php endif; wp_reset_query(); ?>

		<div class="htheme_pager_holder">
			<?php echo paginate_links($pager_args); ?>
		</div>

	<!-- IF NO POSTS -->
	<?php else : ?>
		<!-- ROW -->
		<div class="htheme_row htheme_padding_bottom">
			<div class="htheme_container">
				<div class="htheme_inner_col">
					<!-- TITLE DEFAULT -->
					<div class="htheme_title_container" data-title-type="default">
						<div class="htheme_title">
							<h1>
								<?php echo esc_html__('No posts', 'invogue'); ?>
							</h1>
						</div>
						<div class="htheme_sub_title htheme_h1_sub">
							<?php echo esc_html__('The category has no posts.', 'invogue'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ROW -->
	<?php endif; ?>

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
