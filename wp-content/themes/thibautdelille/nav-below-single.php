<?php
/*<nav id="nav-below" class="navigation" role="navigation">
<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
</nav>*/?>


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
	      <h3>Others Projects</h3>
	    </div>
	  </div>
	  <div class="row" data-aau="related-links">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'related' ); ?>
			<?php endwhile; endif; ?>
	  </div>
	</div>
</section>