<?php

#POST VARIABLES
$comment_count = $post->comment_count;
$comment_status = $post->comment_status;

#AUTHOR DETAILS
$author = get_the_author();
$author_email = get_the_author_meta( 'user_email' );
$author_nickname = get_the_author_meta( 'nickname' );
$author_desc = get_the_author_meta( 'description' );
$author_twitter = get_the_author_meta( 'user_twitter' );
$author_facebook = get_the_author_meta( 'user_facebook' );
$author_pinterest = get_the_author_meta( 'user_pinterest' );
$author_linkdin = get_the_author_meta( 'user_linkdin' );
$author_avatar = get_the_author_meta( 'user_avatar' );

?>
<!-- ROW -->
<div class="htheme_row">
	<div class="htheme_container">
		<div class="htheme_inner_col">
			<div <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_post_image" style="background-image:url(<?php the_post_thumbnail(); ?>)"></a>
				<?php endif; ?>
				<div class="htheme_post_content">
					<?php
					$post_categories = wp_get_post_categories( $post->ID );
					$cats = array();
					foreach($post_categories as $c){
						$cat = get_category( $c );
						$cats[] = array( 'name' => esc_html($cat->name), 'link' => esc_url(get_term_link($c)) );
					}
					$inc = 1;
					if($cats){
						$count = count($cats);
					?>
					<div class="htheme_blog_categories">
						<span><?php esc_html_e('In', 'invogue'); ?></span>
						<?php foreach($cats as $cat){
							echo '&nbsp;<a href="'.esc_url($cat['link']).'">' . esc_html($cat['name']) . '</a>';
							if($inc != $count){
								echo ', ';
							}
							$inc++;
						} ?>
					</div>
					<?php } ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="htheme_post_heading"><h2><?php esc_html(the_title()); ?></h2></a>
					<span class="htheme_post_sub htheme_h2_sub">
						<?php esc_html_e('By', 'invogue'); ?> <?php echo esc_html($author_nickname); ?> <span class="htheme_blog_pipe">|</span>
						<?php
						if ( comments_open() || get_comments_number() ) :
							echo get_comments_number() . ' ' . esc_html_e('Comments: ', 'invogue') . ' <span class="htheme_blog_pipe">|</span>';
						endif;
						?>
						<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_time(get_option( 'date_format' )); ?></a>
					</span>
					<div class="htheme_post_excerpt htheme_default_content">
						<?php the_excerpt(); ?>
					</div>
					<!-- SOCIAL -->
						<?php
							#GET TEMPLATE PART - SOCIAL
							get_template_part( 'htheme/templateparts/content/post', 'social' );
						?>
					<!-- SOCIAL -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ROW -->