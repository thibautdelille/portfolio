<section>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full");
	$link = get_post_meta($post->ID, 'link', true);
	?>
	<a href="<?php echo $link ?>" target="_blank"><div class="full-size" data-aau="imageloader" data-resize="true" data-src="<?php echo $image[0]?>" data-alt="<?php the_title(); ?>"></div></a>
	<div class="row">
		<div class="marged padded">
			<h1 class="entry-title"><?php the_title(); ?></h1>
      <p><a href="<?php echo $link ?>" target="_blank" class="btn btn-primary">Go to the Site</a></p>
			<?php the_content(); ?>
		</div>
	</div>
	<div class="four_spacing"></div>
</section>