<?php 
/*
	Template Name: Home
	*/
	get_header(); 
	?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>


<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php endwhile; endif; ?>
</section>
<?php
	wp_reset_query();
	$args = array(
		'post_type' => 'post'
	);
	query_posts($args);?>
<div class="carousel" data-aau="carousel" data-begin="0" data-arrow="true">
  <div class="slides">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'slide' ); ?>
		<?php endwhile; endif; ?>
		<?php get_template_part( 'nav', 'below' ); ?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>