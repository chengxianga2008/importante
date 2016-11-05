<?php if(!is_404() && isset($post) && $post->ID > 0 && !is_search()): ?>
<meta property="og:url" content="<?php echo esc_url(get_permalink($post->ID)); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:description" content="<?php echo esc_html($post->post_excerpt); ?>" />
<?php $post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'htheme-image-500' ); ?>
<?php if($post_image[0]){ ?>
	<meta property="og:image" content="<?php echo esc_url($post_image[0]); ?>" />
<?php } ?>
<?php endif; ?>