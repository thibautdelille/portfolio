<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "thibautdelille-full-width")?>
<div class="slide" data-src="<?php echo $image[0]?>">
  <div class="info">
    <div class="row">
      <div class="marged padded">
        <p class="lead"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p> 
      </div>
    </div>
  </div>
</div>