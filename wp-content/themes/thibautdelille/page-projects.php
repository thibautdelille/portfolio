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
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section>
<?php get_template_part( 'block' ); ?>
</section>
<?php endwhile; endif; ?>

<?php get_template_part( 'nav', 'below' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>