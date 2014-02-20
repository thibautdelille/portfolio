<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section>
	<div class="full-size" data-aau="imageloader" data-src="<?php echo get_template_directory_uri();?>/assets/images/sanfrancisco.jpg" data-resize="true" data-alt="a view of san francisco"></div>
	<div class="row">
		<div class="marged padded">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
  <div class="four_spacing"></div>
</section>
<?php endwhile; endif; ?>
</section>

<section class="white">
	<?php
		wp_reset_query();
		$args = array(
			'post_type' => 'post',
			'orderby' => 'rand',
			'posts_per_page' => 3
		);
		query_posts($args);?>
	<div class="block-thumb">
	  <div class="row">
	    <div class="marged padded text-centered">
	      <h3>Projects</h3>
	    </div>
	  </div>
	  <div class="row" data-aau="related-links">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'related' ); ?>
			<?php endwhile; endif; ?>
	  </div>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>