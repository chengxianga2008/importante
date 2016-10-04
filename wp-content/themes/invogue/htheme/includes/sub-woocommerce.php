<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.woocommerce.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('WooCommerce settings', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Shop layout', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose with or without sidebar.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="shopLayout" id="shopLayout" class="htheme_field_fixed_400">
			<option value="with_sidebar"><?php esc_html_e('With sidebar', 'invogue'); ?></option>
			<option value="no_sidebar"><?php esc_html_e('No Sidebar', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable product next/previous', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This will enable a next and previous navigation on the edge of the page.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="nextPrev" id="nextPrev" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Enable Social', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Enable social for single product pages.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable social icons', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="socialIcons" id="socialIcons" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Wishlist', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Default wishlist settings.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Wishlist page URL', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This will link the wishlist icon to the selected page.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="wishlistPage" id="wishlistPage" class="htheme_field_fixed_400"></select>
	</div>
</div>
<!-- ROW -->