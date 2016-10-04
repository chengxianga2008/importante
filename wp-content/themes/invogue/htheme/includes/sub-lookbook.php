<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.lookbook.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Lookbook list', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Lookbook archive layout', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="layout" id="layout" class="htheme_field_fixed_400">
			<option value="default"><?php esc_html_e('Original Layout', 'invogue'); ?></option>
			<option value="layout_one"><?php esc_html_e('Mosaic Layout', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Lookbook divider', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="divider" id="divider" class="htheme_field_fixed_400">
			<option value=""><?php esc_html_e('None', 'invogue'); ?></option>
			<option value="zigzag"><?php esc_html_e('zigzag', 'invogue'); ?></option>
			<option value="hearts"><?php esc_html_e('hearts', 'invogue'); ?></option>
			<option value="diagonal"><?php esc_html_e('diagonal', 'invogue'); ?></option>
			<option value="line"><?php esc_html_e('line', 'invogue'); ?></option>
			<option value="plus"><?php esc_html_e('plus', 'invogue'); ?></option>
			<option value="circles"><?php esc_html_e('circles', 'invogue'); ?></option>
			<option value="spiral"><?php esc_html_e('spiral', 'invogue'); ?></option>
			<option value="x"><?php esc_html_e('x', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Divider color', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input name="dividerColor" id="dividerColor" class="htheme_color_picker">
	</div>
</div>
<!-- ROW -->