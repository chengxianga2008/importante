<?php
$htheme_meta_type_facebook = get_post_meta($post->ID, 'htheme_meta_type_facebook', true);
$htheme_meta_type_twitter = get_post_meta($post->ID, 'htheme_meta_type_twitter', true);
$htheme_meta_type_pinterest = get_post_meta($post->ID, 'htheme_meta_type_pinterest', true);
$htheme_meta_type_linkd = get_post_meta($post->ID, 'htheme_meta_type_linkd', true);
?>

<?php if($htheme_meta_type_facebook){ ?>
	<a href="<?php echo esc_url($htheme_meta_type_facebook); ?>" target="_blank" class="htheme_icon_people_1"></a>
<?php } ?>
<?php if($htheme_meta_type_twitter){ ?>
	<a href="<?php echo esc_url($htheme_meta_type_twitter); ?>" target="_blank" class="htheme_icon_people_2"></a>
<?php } ?>
<?php if($htheme_meta_type_pinterest){ ?>
	<a href="<?php echo esc_url($htheme_meta_type_pinterest); ?>" target="_blank" class="htheme_icon_people_3"></a>
<?php } ?>
<?php if($htheme_meta_type_linkd){ ?>
	<a href="<?php echo esc_url($htheme_meta_type_linkd); ?>" target="_blank" class="htheme_icon_people_4"></a>
<?php } ?>