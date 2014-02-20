<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "thumbnail")?>
<div class="row block-image">
  <div class="columns tablet-6">
    <div class="marged">
      <div data-aau="imageloader" data-src="<?php echo $image[0]?>"></div>
    </div>
  </div>
  <div class="columns tablet-6 text-centered_small text-left_tablet">
    <div class="info">
      <div class="marged padded">
        <h2><?php the_title();?></h2>
        <p><?php the_content();?></p>
        <p><a href="#" class="btn btn-standard">button</a></p>
      </div>
    </div>
  </div>
</div>