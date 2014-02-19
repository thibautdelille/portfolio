<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID))?>
<div class="slide" data-src="<?php echo $image[0]?>"></div>