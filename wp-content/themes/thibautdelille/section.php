<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "thumbnail");
  $link = get_post_meta($post->ID, 'link', true);
  $github = get_post_meta($post->ID, 'github', true);?>
<section class="project">
  <div class="row block-text">
    <div class="columns tablet-3">
      <div class="marged">
        <div data-aau="imageloader" data-src="<?php echo $image[0]?>" data-alt="some description"></div>
      </div>
    </div>
    <div class="columns tablet-9">
      <div class="marged padded">
        <h3><?php the_title();?></h3>
        <p class="small">
        <?php
        $posttags = get_the_tags();
        if ($posttags) {
          foreach($posttags as $tag) {
            echo  '<span class="tag">'.$tag->name.'</span>';
          }
        }
        ?></p>
        <p><?php the_content();?></p>
        <?php if($link!=''){?>
          <p><a href="<?php echo $link ?>" target="_blank" class="btn btn-primary">Visit to the Site</a></p>
        <?php }?>
        <?php if($github!=''){?>
          <p><a href="<?php echo $github ?>" target="_blank" class="btn btn-standard">View on Github</a></p>
        <?php }?>
      </div>
    </div>
  </div>
</section>