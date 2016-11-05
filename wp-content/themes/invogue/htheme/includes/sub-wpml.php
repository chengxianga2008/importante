<script type="text/javascript" src="<?php echo HEROTHEME_FRAMEWORK_DIR; ?>includes/js/sub.wpml.js"></script>
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_12">
		<a target="_blank" href="https://wpml.org/?aid=146518&affiliate_key=djYvyztoGbnC" title="Turn your WordPress site multilingual" class="htheme_wpml"></a>
	</div>
</div>
<!-- ROW -->
<!-- ROW -->
<div class="htheme_form_row">
	<div class="htheme_form_col_3">
		<div class="htheme_label"><?php esc_html_e('Enable WPML selector in eyebrow', 'invogue'); ?></div>
		<div class="htheme_label_excerpt"><?php esc_html_e('Add a language selector to the eyebrow menu. (This requires WPML Multilingual plugin to be installed)', 'invogue'); ?></div>
	</div>
	<div class="htheme_form_col_9">
		<input type="checkbox" name="wpmlSelector" id="wpmlSelector" value="true">
	</div>
</div>
<!-- ROW -->
<div class="htheme_form_row htheme_wpml_holder">
<?php
	$config['template'] = 'compact'; //required
	$config['product_name'] = 'WPML';
	$config['box_title'] = esc_html__('Multilingual inVogue', 'invogue');
	$config['name'] = 'GoodDay'; //name of theme/plugin
	$config['box_description'] =  esc_html__('inVogue theme is fully compatible with WPML - the WordPress Multilingual plugin. WPML lets you add languages to your existing sites and includes advanced translation management.', 'invogue');
	$config['repository'] = 'wpml'; // required
	$config['package'] = 'multilingual-cms'; // required
	$config['product'] = 'multilingual-cms'; // required
	WP_Installer_Show_Products($config);
?>
</div>
