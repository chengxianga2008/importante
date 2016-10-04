<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 * DISPLAY - Page to display search resutlts
 */

get_header(); ?>

<?php

	#GLOBALS
	global $wp_query, $wp_rewrite;

	#VARAIBLES
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

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

	<!-- ROW -->
	<div class="htheme_row htheme_padding_bottom">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<!-- TITLE DEFAULT -->
				<div class="htheme_title_container" data-title-type="default">
					<div class="htheme_title"><h1><?php printf( esc_html__( 'Search Results for: %s', 'invogue' ), get_search_query() ); ?></h1></div>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->

	<!-- ROW -->
	<div class="htheme_row">
		<div class="htheme_container">
			<?php if ( have_posts() ) : ?>
			<div class="htheme_search_holder">
				<div class="htheme_search_content">
					<?php
						#START LOOP.
						while ( have_posts() ) : the_post();

							#GET TEMPLATE PART - SEARCH RESULTS
							get_template_part( 'htheme/templateparts/bits/search', 'results' );

						endwhile;
					?>
					<div class="htheme_pager_holder">
						<?php echo paginate_links($pager_args); ?>
					</div>
				</div>
			</div>
			<?php else : ?>
				<h4 class="htheme_align_center"><?php esc_html_e('No results have been found!', 'invogue'); ?></h4>
			<?php endif; ?>
		</div>
	</div>
	<!-- ROW -->

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
