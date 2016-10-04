<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.slider.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Slider settings', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('This will be the slider that can be added to your home page.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Slide transition', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set slide animation type.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="transition" id="transition" class="htheme_field_fixed_400">
			<option value="fade"><?php esc_html_e('Fade', 'invogue'); ?></option>
			<option value="slide"><?php esc_html_e('Slide', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Slide transition speed', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Animation speed of each slide.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="transitionSpeed" id="transitionSpeed" class="htheme_field_fixed_400">
			<option value="1"><?php esc_html_e('1 sec', 'invogue'); ?></option>
			<option value="2"><?php esc_html_e('2 sec', 'invogue'); ?></option>
			<option value="3"><?php esc_html_e('3 sec', 'invogue'); ?></option>
			<option value="4"><?php esc_html_e('4 sec', 'invogue'); ?></option>
			<option value="5"><?php esc_html_e('5 sec', 'invogue'); ?></option>
			<option value="6"><?php esc_html_e('6 sec', 'invogue'); ?></option>
			<option value="7"><?php esc_html_e('7 sec', 'invogue'); ?></option>
			<option value="8"><?php esc_html_e('8 sec', 'invogue'); ?></option>
			<option value="9"><?php esc_html_e('9 sec', 'invogue'); ?></option>
			<option value="10"><?php esc_html_e('10 sec', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Slider height', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set home slider height.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="text" name="height" id="height" class="htheme_field_fixed_400">
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Idle time', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Set the idle time for the slider before it animates to next slide.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<select name="idle" id="idle" class="htheme_field_fixed_400">
			<option value="0"><?php esc_html_e('Disable Idle', 'invogue'); ?></option>
			<option value="5"><?php esc_html_e('5 sec', 'invogue'); ?></option>
			<option value="10"><?php esc_html_e('10 sec', 'invogue'); ?></option>
			<option value="15"><?php esc_html_e('15 sec', 'invogue'); ?></option>
			<option value="20"><?php esc_html_e('20 sec', 'invogue'); ?></option>
			<option value="30"><?php esc_html_e('30 sec', 'invogue'); ?></option>
			<option value="40"><?php esc_html_e('40 sec', 'invogue'); ?></option>
			<option value="50"><?php esc_html_e('50 sec', 'invogue'); ?></option>
			<option value="60"><?php esc_html_e('60 sec', 'invogue'); ?></option>
		</select>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Show idle timer', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Show and hide the idle timer on the frontend.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="idleDisplay" id="idleDisplay" value="true">
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_9">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Slides', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Choose between a navigation bar that runs the full width of the screen, or at a fixed width.', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_3">
		<div class="htheme_button htheme_dark_btn" id="htheme_add_slide">
			<?php esc_html_e('Add new slide', 'invogue'); ?> [+]
		</div>
	</div>
</div>
<!-- ROW -->
<!-- ROW - SLIDE -->
<div class="htheme_form_row">
	<div class="htheme_load_slides">
		<!-- LOAD SLIDES -->
	</div>
</div>
<!-- ROW - SLIDE -->