<?php 
/*
	Template Name: Home
	*/
	get_header(); 
	?>
<section id="content" role="main">
		<div class="row">
			<div class="marged padded">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>


<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php endwhile; endif; ?>
		</div>
	</div>
</section>
<?php
	wp_reset_query();
	$args = array(
		'post_type' => 'post',
		'orderby' => 'rand',
		'posts_per_page' => 5
	);
	query_posts($args);?>
<div class="carousel" data-aau="carousel" data-begin="0" data-arrow="true">
  <div class="slides">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'slide' ); ?>
		<?php endwhile; endif; ?>
	</div>
</div>

<?php
	wp_reset_query();
	$args = array(
		'post_type' => 'post', 
		'posts_per_page' => -1
	);
	query_posts($args);?>
<div class="row block-thumb">
  <div class="marged padded text-centered">
    <h2>Projects</h2>
  </div>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'thumb' ); ?>
	<?php endwhile; endif; ?>
</div>

<section class="gray-light">
	<div class="full-size light blur" data-aau="imageloader" data-src="<?php echo get_template_directory_uri();?>/assets/images/sanfrancisco.jpg" data-resize="true" data-alt="a view of san francisco">
    <div class="row">
    	<div class="four_spacing"></div>
      <div class="columns small-8 small-offset-2 tablet-4">
        <div class="marged">
          <div data-aau="imageloader" class="rounded" data-src="https://2.gravatar.com/avatar/145dd7cf2fec34c4fad31f278f77769d?d=https%3A%2F%2Fidenticons.github.com%2F937445367afbf563e96f39d77136d07f.png&r=x&s=600"></div>
        </div>
      </div>
      <div class="columns tablet-6">
        <div class="marged padded text-centered">
          <h3>Get in Touch</h3>
          <div>
            <p><strong>Thibaut Delille</strong></p>
            <p>tdelille@gmail.com<br/>
            (415)706-4532<br/>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="four_spacing"></div>
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>