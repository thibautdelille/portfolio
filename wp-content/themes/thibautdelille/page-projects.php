<?php 
/*
	Template Name: Projects
	*/
	get_header(); 
	wp_reset_query();
	$args = array(
		'post_type' => 'post'
	);
	query_posts($args);?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>