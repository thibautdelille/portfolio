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
		'posts_per_page' => -1
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
	query_posts($args); ?>
<section class="dark">
<div class="row block-thumb">
  <div class="marged padded text-centered">
    <h2>Projects</h2>
  </div>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'thumb' ); ?>
	<?php endwhile; endif; ?>
</div>
</section>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'section' ); ?>
<?php endwhile; endif; ?>
<div class="four_spacing"></div>

<section class="white">
	<div class="row block-thumb">
	  <div class="marged padded text-centered">
	    <h2>Skills & Tools</h2>
	  </div>
		<div class="row listoflinks" data-aau="listoflinks" data-title="Tap to toggle">
		  <div class="columns tablet-4">
		    <div class="padded marged">
		      <ul class="links">
		        <li>Javascript</li>
		        <li>HTML5</li>
		        <li>CSS3</li>
		        <li><a href="http://sass-lang.com/" target="_blank">SASS</a></li>
		        <li><a href="http://lesscss.org/" target="_blank">LESS</a></li>
		        <li><a href="http://compass-style.org/" target="_blank">Compass</a></li>
		        <li><a href="http://jade-lang.com/" target="_blank">Jade</a></li>
		        <li><a href="http://icanhazjs.com/" target="_blank">ICanHazJS</a></li>
		        <li><a href="http://getbootstrap.com/" target="_blank">Twitter Bootstrap</a></li>
		        <li><a href="http://foundation.zurb.com/" target="_blank">Foundation</a></li>
		      </ul>
		    </div>
		  </div>
		  <div class="columns tablet-4">
		    <div class="padded marged">
		      <ul class="links">
		        <li><a href="http://bower.io/" target="_blank">Bower</a></li>
		        <li><a href="http://angularjs.org/" target="_blank">AngularJS</a></li>
		        <li><a href="http://yeoman.io/" target="_blank">Yeoman</a></li>
		        <li><a href="http://nodejs.org/" target="_blank">NodeJS</a></li>
		        <li><a href="http://expressjs.com/" target="_blank">Express</a></li>
		        <li><a href="http://socket.io/" target="_blank">SocketIO</a></li>
		        <li><a href="http://passportjs.org/" target="_blank">PassportJS</a></li>
		        <li><a href="http://jekyllrb.com/" target="_blank">Jekyll</a></li>
		        <li><a href="http://assemble.io/" target="_blank">Assemble</a></li>
		        <li><a href="http://jquery.com/" target="_blank">JQuery</a></li>
		      </ul>
		    </div>
		  </div>
		  <div class="columns tablet-4">
		    <div class="padded marged">
		      <ul class="links">
		        <li><a href="http://gruntjs.com/" target="_blank">Grunt</a></li>
		        <li><a href="http://www.mongodb.org/" target="_blank">MongoDB</a></li>
		        <li><a href="https://wordpress.org/" target="_blank">Wordpress</a></li>
		        <li><a href="https://drupal.org/" target="_blank">Drupal</a></li>
		        <li><a href="http://www.mysql.com/" target="_blank">MySQL</a></li>
		        <li>Apache</li>
		        <li><a href="https://github.com/thibautdelille/dotfiles" target="_blank">DotFiles</a></li>
		        <li><a href="http://www.sublimetext.com/" target="_blank">Sublime</a></li>
		        <li>Photoshop</li>
		        <li>After Effects</li>
		      </ul>
		    </div>
		  </div>
		</div>
	</div>
<section>

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
            <p><a href="mailto:tdelille@gmail.com">tdelille@gmail.com</a><br/>
            <a href="https://github.com/thibautdelille" target="_blank">github</a><br/>
            <a href="https://www.linkedin.com/pub/thibaut-delille/12/a07/87b/en" target="_blank">linkedin</a><br/>
            <a href="<?php echo get_template_directory_uri();?>/assets/thibaut_delille_resume.pdf" target="_blank">resume</a><br/>
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