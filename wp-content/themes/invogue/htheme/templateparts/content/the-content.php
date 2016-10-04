<?php if ( !defined( 'WPB_VC_VERSION' ) ) { ?>
	<!-- ROW -->
	<div class="htheme_row">
		<div class="htheme_container">
			<div class="htheme_inner_col htheme_default_content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<!-- ROW -->
<?php } else { ?>
	<?php if(strpos($post->post_content, 'vc_row') !== false){ ?>
		<!-- ROW -->
		<?php the_content(); ?>
		<!-- ROW -->
	<?php } else { ?>
		<!-- ROW -->
		<div class="htheme_row">
			<div class="htheme_container">
				<div class="htheme_inner_col htheme_default_content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<!-- ROW -->
	<?php } ?>
<?php } ?>