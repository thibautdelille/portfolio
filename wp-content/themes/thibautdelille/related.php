<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "thumbnail")?>
<div class="columns related-link">
  <a href="<?php the_permalink();?>">
    <div class="marged">
      <div data-aau="imageloader" data-src="<?php echo $image[0]?>" data-resize="true" data-alt="some description"></div>
    </div>
    <div class="marged padded text-centered info">
      <p><?php the_title();?></p>
    </div>
  </a>
</div>