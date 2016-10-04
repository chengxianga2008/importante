<!-- SEARCH HOLDER OVERLAY -->
<div class="htheme_search_overlay">
	<div class="htheme_icon_search_close"></div>
	<div class="htheme_search_inner">
		<form action="<?php echo home_url( '/' ); ?>" method="get">
			<div class="htheme_search_item">
				<input type="text" value="<?php esc_attr(get_search_query()); ?>" name="s" id="s">
				<label for="s" class="">
					<?php esc_html_e('Search', 'invogue') ?>
				</label>
				<div class="htheme_icon_search_btn"></div>
			</div>
		</form>
	</div>
</div>
<!-- SEARCH HOLDER OVERLAY -->

<!-- SUPER ZOOM -->
<div class="htheme_superzoom">
	<div class="htheme_superzoom_close"></div>
	<div class="htheme_superzoom_wrap">
		<div class="htheme_image_box" style=""></div>
	</div>
</div>
<!-- SUPER ZOOM -->

<!-- POPUP HOLDER OVERLAY -->
<div class="htheme_popup_overlay">
	<div class="htheme_icon_popup_close"></div>
	<div class="htheme_popup_inner">
		<div class="htheme_popup_arrows htheme_popup_left" data-side="left"></div>
		<div class="htheme_popup_arrows htheme_popup_right" data-side="right"></div>
	</div>
</div>
<!-- POPUP HOLDER OVERLAY -->

<!-- POPUP PREVIEW OVERLAY -->
<div class="htheme_popup_preview">
	<div class="htheme_icon_popup_close"></div>
	<div class="htheme_preview_load">
		<!-- LOAD PREVIEW HERE -->
	</div>
</div>
<!-- POPUP PREVIEW OVERLAY -->

<!-- POPUP VIDEO OVERLAY -->
<div class="htheme_video_overlay">
	<div class="htheme_icon_popup_close"></div>
	<div class="htheme_video_load">
		<!-- LOAD VIDEO -->
	</div>
</div>
<!-- POPUP PREVIEW OVERLAY -->

<!-- SIGNUP OVERLAY -->
<?php
	#GET TEMPLATE PART - NAVIGATION
	get_template_part( 'htheme/templateparts/bits/signup', 'form' );
?>
<!-- SIGNUP OVERLAY -->

<!-- BACK TO TOP -->
<div class="htheme_icon_backtop"></div>
<!-- BACK TO TOP -->