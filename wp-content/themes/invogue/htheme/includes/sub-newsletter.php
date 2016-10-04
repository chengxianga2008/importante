<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.newsletter.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable newsletter popup', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Get people to sign up for your newsletter by enabling a popup.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="status" id="status" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Set for page', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="page" id="page" class="htheme_field_fixed_400">
			<option value="cover"><?php esc_html_e('Select a page', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Newsletter title', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="title" id="title" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Newsletter excerpt', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<textarea name="info" id="info" class="htheme_field_fixed_400" rows="5"></textarea>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Newsletter background image', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Upload a background image of approximately 900px x 600px.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="backgroundImage" data-multiple="false" data-size="full">
			<?php esc_html_e('Upload', 'invogue'); ?>
		</div>
		<input type="hidden" name="backgroundImage" id="backgroundImage" class="htheme_field_fixed_400">
	</div>
	<div class="htheme_form_col_12">
		<div class="htheme_image_holder" id="image_backgroundImage"></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Background size', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="backgroundSize" id="backgroundSize" class="htheme_field_fixed_400">
			<option value="cover"><?php esc_html_e('Cover', 'invogue'); ?></option>
			<option value="contain"><?php esc_html_e('Contain', 'invogue'); ?></option>
			<option value="auto"><?php esc_html_e('Auto', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Background position', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="backgroundPosition" id="backgroundPosition" class="htheme_field_fixed_400">
			<option value="center"><?php esc_html_e('Center', 'invogue'); ?></option>
			<option value="left"><?php esc_html_e('left', 'invogue'); ?></option>
			<option value="right"><?php esc_html_e('Right', 'invogue'); ?></option>
			<option value="top"><?php esc_html_e('Top', 'invogue'); ?></option>
			<option value="bottom"><?php esc_html_e('Bottom', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label"><?php esc_html_e('Newsletter data', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('All signups will be saved in your Signups database, but a copy can be sent to you if you want.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9" style="display:none">
		<input type="text" name="sendToEmail" id="sendToEmail" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->