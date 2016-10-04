<?php
/*
Template Name: inVogue - Basic Template
*/

get_header(); ?>

<!-- CONTENT HOLDER -->
<div class="htheme_content_holder">

	<!-- SET HEADER IF NOT SELECTED -->
	<?php get_template_part( 'htheme/templateparts/header/top', 'plain' ); ?>

	<!-- OUTPUT OTHER CONTENT -->
	<?php get_template_part( 'htheme/templateparts/content/the', 'content' ); ?>

</div>
<!-- CONTENT HOLDER -->

<?php get_footer(); ?>
