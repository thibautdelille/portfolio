<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "thumbnail");?>
<div class="columns tablet-4 box-link-item">
  <div class="row">
    <a href="<?php the_permalink(); ?>">
      <div class="columns small-4 tablet-12 small-push-8 tablet-unpush">
        <div class="marged">
          <div data-aau="imageloader" data-src="<?php echo $image[0]?>" data-resize="true" data-alt="some description"></div>
        </div>
      </div>
      <div class="columns small-8 tablet-12 small-pull-4 tablet-unpull">
        <div class="marged padded info">
          <p><?php the_title();?></p>
        </div>
      </div>
    </a>
  </div>
</div>