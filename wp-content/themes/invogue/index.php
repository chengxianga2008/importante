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

$big = 999999999; // need an unlikely integer

#PAGER ARGS
$pager_args = array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, $paged ),
	'total' => $wp_query->max_num_pages,
	'prev_next' => true,
	'prev_text' => esc_html__('', 'invogue'),
	'next_text' => esc_html__('', 'invogue'),
);

$htheme_single_layout = $GLOBALS['htheme_global_object']['settings']['blog']['layout'];
$htheme_masonry = $GLOBALS['htheme_global_object']['settings']['blog']['masonry'];
$htheme_sidebar_status = false;
$htheme_with_sidebar = '';

if($htheme_single_layout == 'standard_sidebar'){
	$htheme_sidebar_status = true;
	$htheme_with_sidebar = 'htheme_with_sidebar';
}

?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- ROW -->
	<div class="htheme_row htheme_padding_bottom">
		<div class="htheme_container">
			<div class="htheme_inner_col">
				<!-- TITLE DEFAULT -->
				<div class="htheme_title_container" data-title-type="default">
					<div class="htheme_title"><h1><?php esc_html(single_post_title()); ?></h1></div>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->
	<!-- CHECK SIDEBAR -->
	<?php if($htheme_sidebar_status){ ?>
	<!-- ROW -->
	<div class="htheme_row htheme_padding_top">
		<div class="htheme_container <?php echo esc_attr($htheme_with_sidebar); ?>">
			<div class="htheme_col_9">
	<?php } ?>
	<!-- CHECK SIDEBAR -->

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

		<div class="htheme_pager_holder">
			<?php echo paginate_links($pager_args); ?>
		</div>

	<!-- IF NO POSTS -->
	<?php else : ?>
		<div class="htheme_caution_yellow"><?php esc_html_e('NO POSTS HAVE BEEN FOUND!', 'invogue'); ?></div>
	<?php endif; ?>

	<!-- CHECK SIDEBAR -->
	<?php if($htheme_sidebar_status){ ?>
			</div>
			<div class="htheme_col_3">
				<div class="htheme_inner_col">
					<div class="htheme_sidebar_right">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ROW -->
	<?php } ?>
	<!-- CHECK SIDEBAR -->

</div>
<!-- CONTENT HOLDER -->
<?php get_footer(); ?>
