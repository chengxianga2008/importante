<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.import.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('inVogue Export', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Create a export file.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<textarea name="exportOptions" rows="6" id="exportOptions" class="htheme_field_lrg" style="box-sizing:border-box !important;"></textarea>
	</div>
	<div class="htheme_form_col_2" style="margin-top:15px;">
		<div class="htheme_button htheme_dark_btn" id="htheme_export_options">
			<?php esc_html_e('Generate Export Options', 'invogue'); ?>
		</div>
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- CAUTION BOX -->
<div class="htheme_caution_box htheme_box_red htheme_margin_bottom_20">
	<?php esc_html_e('PLEASE NOTE - Proceed with caution, keep a backup of your generated options.', 'invogue'); ?>
</div>
<!-- CAUTION BOX -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('inVogue Import', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Upload export file here.', 'invogue'); ?></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<textarea name="importOptions" rows="6" id="importOptions" class="htheme_field_lrg" style="box-sizing:border-box !important;"></textarea>
	</div>
	<div class="htheme_form_col_2" style="margin-top:15px;">
		<div class="htheme_button htheme_dark_btn" id="htheme_import_options">
			<?php esc_html_e('Import Options', 'invogue'); ?>
		</div>
	</div>
</div>
<!-- ROW -->
<!-- ROW SPLIT -->
<div class="htheme_row_split"></div>
<!-- ROW SPLIT -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_label htheme_red_heading"><?php esc_html_e('Signup Export', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Export a list of signups.', 'invogue'); ?> <a><?php esc_html_e('Create export file', 'invogue'); ?></a></div>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<div class="htheme_button htheme_dark_btn create_export" id="htheme_export_signup">
			<?php esc_html_e('Create Signup CSV', 'invogue'); ?>
		</div>
		<div class="htheme_button htheme_blue_btn htheme_download_export" data-file="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/signups/signups.csv">
			<?php esc_html_e('Download File', 'invogue'); ?>
		</div>
	</div>
</div>
<!-- ROW -->