<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<?php

	#POST VARIABLES
	$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );
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

	#BLOG VARAIBLES
	$htheme_single_layout = $GLOBALS['htheme_global_object']['settings']['blog']['singleLayout'];
	$htheme_show_author = $GLOBALS['htheme_global_object']['settings']['blog']['author'];
	$htheme_show_tags = $GLOBALS['htheme_global_object']['settings']['blog']['tags'];
	$htheme_sidebar_status = false;
	$htheme_with_sidebar = '';

	if($htheme_single_layout == 'standard_sidebar'){
		$htheme_sidebar_status = true;
		$htheme_with_sidebar = 'htheme_with_sidebar';
	}

	?>

	<!-- ROW -->
	<div class="htheme_row htheme_padding_top">
		<div class="htheme_container <?php echo esc_attr($htheme_with_sidebar); ?>">

			<!-- CHECK SIDEBAR -->
			<?php if($htheme_sidebar_status){ ?>
				<div class="htheme_col_9">
			<?php } ?>
			<!-- CHECK SIDEBAR -->

			<div class="htheme_inner_col">
				<div class="post">
					<?php if($post_image[0]){ ?>
						<div class="htheme_post_image" style="background-image:url(<?php echo esc_url($post_image[0]); ?>)"></div>
					<?php } ?>
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
									echo '&nbsp;<a href="'.$cat['link'].'">' . $cat['name'] . '</a>';
									if($inc != $count){
										echo ', ';
									}
									$inc++;
								} ?>
							</div>
						<?php } ?>
						<h2><?php esc_html(the_title()); ?></h2>
						<span class="htheme_post_sub htheme_h2_sub">
							<?php esc_html_e('By', 'invogue'); ?> <?php echo esc_html($author_nickname); ?> <span class="htheme_blog_pipe">|</span>
							<?php
								if ( comments_open() || get_comments_number() ) :
									echo get_comments_number() . ' ' . esc_html_e('Comments: ', 'invogue') . ' <span class="htheme_blog_pipe">|</span>';
								endif;
							?>
							<?php the_time(get_option( 'date_format' )); ?>
						</span>
						<div class="htheme_post_main_content htheme_default_content">
							<?php the_content(); ?>
							<div class="htheme_single_pager">
								<?php
								$defaults = array(
									'before'           => '<p>' . esc_html__( 'Pages:', 'invogue' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => esc_html__( 'Next page', 'invogue' ),
									'previouspagelink' => esc_html__( 'Previous page', 'invogue' ),
									'pagelink'         => '%',
									'echo'             => 1
								);
								wp_link_pages( $defaults );
								?>
							</div>
							<?php if($htheme_show_tags !== 'false'): ?>
								<div class="htheme_post_tags">
									<?php the_category( '' ); ?>
									<?php the_tags( '', '', '' ); ?>
								</div>
							<?php endif; ?>
							<?php do_action('icl_post_languages'); ?>
						</div>
						<?php if($htheme_show_author !== 'false'): ?>
						<!-- GREY LINE -->
						<div class="htheme_row htheme_row_margin_bottom htheme_no_padding">
							<div class="htheme_grey_line_separator"></div>
						</div>
						<!-- GREY LINE -->
						<!-- AUTHOR -->
						<div class="htheme_post_author">
							<div class="htheme_col_2">
								<div class="htheme_post_author_image" style="background-image:url(<?php echo esc_url($author_avatar); ?>)"></div>
							</div>
							<div class="htheme_col_10">
								<div class="htheme_post_author_info">
									<h6 class="htheme_post_author_name"><a><?php esc_html_e('By', 'invogue'); ?></a> <?php echo esc_html($author_nickname); ?></h6 class="htheme_post_author_name">
                                    <span class="htheme_post_author_excerpt htheme_h6_sub">
                                        <?php echo esc_html($author_desc); ?>
                                    </span>
									<div class="htheme_post_author_social">
										<?php if($author_twitter != ''){ ?>
											<a href="<?php echo esc_url($author_twitter); ?>" target="_blank" class="htheme_icon_author_social_twitter"></a>
										<?php } ?>
										<?php if($author_facebook != ''){ ?>
											<a href="<?php echo esc_url($author_facebook); ?>" target="_blank" class="htheme_icon_author_social_facebook"></a>
										<?php } ?>
										<?php if($author_pinterest != ''){ ?>
											<a href="<?php echo esc_url($author_pinterest); ?>" target="_blank" class="htheme_icon_author_social_pinterest"></a>
										<?php } ?>
										<?php if($author_linkdin != ''){ ?>
											<a href="<?php echo esc_url($author_linkdin); ?>" target="_blank" class="htheme_icon_author_social_linkdin"></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!-- AUTHOR -->
						<?php endif; ?>
						<!-- SOCIAL -->
						<?php
							#GET TEMPLATE PART - SOCIAL
							get_template_part( 'htheme/templateparts/content/post', 'social' );
						?>
						<!-- SOCIAL -->
						<!-- NEXT PREVIOUS POSTS -->
						<div class="htheme_next_prev">
							<?php
							// Previous/next post navigation.
							the_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'invogue' ) . '</span> ' .
									'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'invogue' ) . '</span> ' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'invogue' ) . '</span> ' .
									'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'invogue' ) . '</span> ' .
									'<span class="post-title">%title</span>',
							) );
							?>
						</div>
						<!-- NEXT PREVIOUS POSTS -->
						<!-- COMMENTS -->
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<!-- GREY LINE -->
							<div class="htheme_row_margin_bottom">
								<div class="htheme_row htheme_no_padding">
									<div class="htheme_grey_line_separator"></div>
								</div>
							</div>
							<!-- GREY LINE -->
							<!-- ROW -->
							<div class="htheme_row htheme_padding_bottom">
								<?php
									comments_template();
								?>
							</div>
							<!-- ROW -->
						<?php endif; ?>
						<!-- COMMENTS -->
					</div>
				</div>
			</div>
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
			<?php } ?>
			<!-- CHECK SIDEBAR -->

		</div>
	</div>
	<!-- ROW -->

</div>
<!-- CONTENT HOLDER -->