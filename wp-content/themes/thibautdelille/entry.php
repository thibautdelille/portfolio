<section>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full");
  $link = get_post_meta($post->ID, 'link', true);
  $github = get_post_meta($post->ID, 'github', true);?>
	<a href="<?php echo $link ?>" target="_blank"><div class="full-size" data-aau="imageloader" data-resize="true" data-src="<?php echo $image[0]?>" data-alt="<?php the_title(); ?>"></div></a>
	<div class="row">
		<div class="marged padded">
			<h1 class="entry-title"><?php the_title(); ?></h1>
      <p class="small">
      <?php
      $posttags = get_the_tags();
      if ($posttags) {
        foreach($posttags as $tag) {
          echo  '<span class="tag">'.$tag->name.'</span>';
        }
      }
      ?></p>
			<?php the_content(); ?>
      <?php if($link!=''){?>
        <p><a href="<?php echo $link ?>" target="_blank" class="btn btn-primary">Visit to the Site</a></p>
      <?php }?>
      <?php if($github!=''){?>
        <p><a href="<?php echo $github ?>" target="_blank" class="btn btn-standard">View on Github</a></p>
      <?php }?>
		</div>
	</div>
	<div class="four_spacing"></div>
</section>