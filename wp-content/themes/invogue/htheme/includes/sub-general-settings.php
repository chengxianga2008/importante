<script src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>assets/js/ace.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.general-settings.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('General page settings', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('General/basic site settings.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row" style="display:none">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Theme skin', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" disabled="disabled" name="theme" id="theme" class="htheme_field_fixed_400" disabled>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Favicon', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('An icon associated with your website. Preferably a PNG, no bigger than 30px x 30px and file size no bigger than 100kb.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="favIcon" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="favIcon" id="favIcon" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_favIcon"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable page transition fade', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Fading in and out of pages.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="pageLoader" id="pageLoader" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Back to top button', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Allows users to smoothly scroll back to the top of a page.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="toTop" id="toTop" value="true">
	</div>
</div>
<!-- ROW -->

<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('404 Page Details', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Change the 404 page content if you like.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Page title', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the page title.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="page_404_title" id="page_404_title" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Page sub title', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the page sub title.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="page_404_sub" id="page_404_sub" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Page sub description', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the page sub description/excerpt.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<textarea name="page_404_description" id="page_404_description" class="htheme_field_fixed_400" rows="5"></textarea>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Page button text', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the text for the button.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="page_404_button_text" id="page_404_button_text" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Page button URL', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the URL for the button.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="page_404_button_url" id="page_404_button_url" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Advanced code settings', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Please proceed with caution, for advanced users/developers only.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Code before closing head tag', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Add your custom functions here. For advanced users.', 'invogue'); ?> <br><br><span class="htheme_red"><?php esc_html_e('(Wrapping Script tags not required!)', 'invogue'); ?></span></div>
	</div>
	<div class="htheme_form_col_9">
		<textarea name="codeHead" id="codeHead" class="htheme_field_fixed_400" rows="5"></textarea>
		<div id="_codeHead"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Code before closing body tag', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Add your custom functions here. For advanced users.', 'invogue'); ?> <br><br><span class="htheme_red"><?php esc_html_e('(Wrapping Script tags not required!)', 'invogue'); ?></span></div>
	</div>
	<div class="htheme_form_col_9" style="position:relative">
		<textarea name="codeBody" id="codeBody" class="htheme_field_fixed_400" rows="5"></textarea>
		<div id="_codeBody"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Custom CSS', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('You can use the CSS editor to customize the appearance of the theme. For advanced users.', 'invogue'); ?>  <br><br><span class="htheme_red"><?php esc_html_e('(Wrapping Style tags not required!)', 'invogue'); ?></span></div>
	</div>
	<div class="htheme_form_col_9">
		<textarea name="codeCss" id="codeCss" class="htheme_field_fixed_400" rows="5"></textarea>
		<div id="_codeCss"></div>
	</div>
</div>
<!-- ROW -->