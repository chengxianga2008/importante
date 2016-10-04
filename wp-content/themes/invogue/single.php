<?php
get_header(); ?>

<?php

	#START LOOP
	while ( have_posts() ) : the_post();

		#INCLUDE SINGLE POST TEMPLATE
		get_template_part( 'htheme/templateparts/content/post', 'single' );

	#END LOOP
	endwhile;

?>

<?php get_footer(); ?>
