<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.header.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Navigation layout', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a normal navigation or an eyebrow navigation.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_layout_selector" data-value="1" id="htheme_layout_1"></div>
		<div class="htheme_layout_selector" data-value="2" id="htheme_layout_2"></div>
		<!--<div class="htheme_layout_selector" data-value="3" id="htheme_layout_3"></div>-->
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Use image for logo', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="imageForLogo" id="imageForLogo" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Logo upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt">
			<?php esc_html_e('Upload a logo that\'s approximately 150px in height, to make sure it\'s crisp on all retina screens.', 'invogue'); ?>
		</div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcLogo" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcLogo" id="srcLogo" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcLogo"></div>
		<span class="htheme_remove_image" data-input="srcLogo"><?php esc_html_e('Remove image [x]', 'invogue'); ?></span>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Logo retina upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt">
			<?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?>
		</div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcLogoRetina" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcLogoRetina" id="srcLogoRetina" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcLogoRetina"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Logo height', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This is the size that the uploaded logo will display at in the navigation.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="logoHeight" id="logoHeight" class="htheme_field_fixed_400">
			<option value="20px"><?php esc_html_e('20px', 'invogue'); ?></option>
			<option value="30px"><?php esc_html_e('30px', 'invogue'); ?></option>
			<option value="40px"><?php esc_html_e('40px', 'invogue'); ?></option>
			<option value="50px"><?php esc_html_e('50px', 'invogue'); ?></option>
			<option value="60px"><?php esc_html_e('60px', 'invogue'); ?></option>
			<option value="70px"><?php esc_html_e('70px', 'invogue'); ?></option>
			<option value="80px"><?php esc_html_e('80px', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Header padding', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="logoPadding" id="logoPadding" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Sticky Navigation', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('You can have different sticky settings than your main navigation', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Logo upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt">
			<?php esc_html_e('Upload a logo that\'s approximately 150px in height, to make sure it\'s crisp on all retina screens.', 'invogue'); ?>
		</div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcStickyLogo" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcStickyLogo" id="srcStickyLogo" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcStickyLogo"></div>
		<span class="htheme_remove_image" data-input="srcStickyLogo"><?php esc_html_e('Remove image [x]', 'invogue'); ?></span>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Retina logo upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcStickyLogoRetina" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcStickyLogoRetina" id="srcStickyLogoRetina" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcStickyLogoRetina"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Logo height', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This is the size that the uploaded logo will display at in the navigation.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="logoStickyHeight" id="logoStickyHeight" class="htheme_field_fixed_400">
			<option value="20px"><?php esc_html_e('20px', 'invogue'); ?></option>
			<option value="30px"><?php esc_html_e('30px', 'invogue'); ?></option>
			<option value="40px"><?php esc_html_e('40px', 'invogue'); ?></option>
			<option value="50px"><?php esc_html_e('50px', 'invogue'); ?></option>
			<option value="60px"><?php esc_html_e('60px', 'invogue'); ?></option>
			<option value="70px"><?php esc_html_e('70px', 'invogue'); ?></option>
			<option value="80px"><?php esc_html_e('80px', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Header padding', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="logoStickyPadding" id="logoStickyPadding" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Header sticky on mobile', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="stickOnMobile" id="stickOnMobile" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ///////////////////////////////////// -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Mobile', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Some mobile settings.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Mobile logo upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('You can upload a different version of your logo to cater for the smaller space that it would be in.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcMobileLogo" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcMobileLogo" id="srcMobileLogo" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcMobileLogo"></div>
		<span class="htheme_remove_image" data-input="srcMobileLogo"><?php esc_html_e('Remove image [x]', 'invogue'); ?></span>
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Layout Options', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Enable some extra navigational items.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Full width header', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionFullWidth" id="optionFullWidth" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show login and account', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This displays as text in the top left corner of the eyebrow.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionAccount" id="optionAccount" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show cart', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Display cart icon in the main navigation.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionCart" id="optionCart" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show wishlist', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Display wishlist icon in the main navigation.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionWishlist" id="optionWishlist" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show search', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Display search icon in the main navigation.', 'invogue'); ?> </div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionSearch" id="optionSearch" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable desktop hamburger menu', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This transforms your navigation into a mobile like menu on desktop views.', 'invogue'); ?> </div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="hamburger" id="hamburger" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Hamburger menu logo upload', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('You can upload a different version of your logo to cater for the smaller space that it would be in.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="srcHamburgerLogo" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="srcHamburgerLogo" id="srcHamburgerLogo" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_srcHamburgerLogo"></div>
		<span class="htheme_remove_image" data-input="srcHamburgerLogo"><?php esc_html_e('Remove image [x]', 'invogue'); ?></span>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show language selector', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="optionLanguage" id="optionLanguage" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Header color scheme', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Color scheme', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="colorScheme" id="colorScheme" class="htheme_field_fixed_400">
			<option value="dark"><?php esc_html_e('Dark', 'invogue'); ?></option>
			<option value="light"><?php esc_html_e('Light', 'invogue'); ?></option>
			<option value="custom"><?php esc_html_e('Custom', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_load_header_styles" style="width:100%;"></div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Social icons', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Add social icons to your eyebrow navigation.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW <textarea name="textarea" id="textarea" class="htheme_field_fixed_400" rows="5"></textarea> -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable social icons', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Toggle social icons to show or hide.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="socialIcons" id="socialIcons" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Primary social icon color', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This is the color that all icons will be.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input name="socialPrimaryColor" id="socialPrimaryColor" class="htheme_color_picker">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Select social icons', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Here you\'ll find a list to choose from to show in the navigation.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_load_social">
			<!-- LOAD SOCIAL -->
		</div>
	</div>
</div>
<!-- ROW -->