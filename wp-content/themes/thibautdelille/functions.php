<?php

/**********************************************************************
*                               ACTIONS                               *
***********************************************************************/

/**
* SETUP
*/
add_action( 'after_setup_theme', 'thibautdelille_setup' );

function thibautdelille_setup(){
	load_theme_textdomain( 'thibautdelille', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'thibautdelille-full-width', 1038, 576, true );

	global $content_width;
	if ( ! isset( $content_width ) ) 
		$content_width = 640;

	register_nav_menus(	array( 'main-menu' => __( 'Main Menu', 'thibautdelille' ) )	);
}

/**
* LOAD SCRIPTS
*/

add_action( 'wp_enqueue_scripts', 'thibautdelille_load_scripts' );

function thibautdelille_load_scripts()
{
	wp_enqueue_script( 'jquery' );
}

/**
* COMMENT REPLY SCRIPTS
*/

add_action( 'comment_form_before', 'thibautdelille_enqueue_comment_reply_script' );

function thibautdelille_enqueue_comment_reply_script()
{
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

/**
* WIDGETS
*/

add_action( 'widgets_init', 'thibautdelille_widgets_init' );

function thibautdelille_widgets_init()
{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'thibautdelille' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

/**********************************************************************
*                               FILTERS                               *
***********************************************************************/

/**
* THE TITLE 
*/

add_filter( 'the_title', 'thibautdelille_title' );

function thibautdelille_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

/**
* WP TITLE
*/

add_filter( 'wp_title', 'thibautdelille_filter_wp_title' );


function thibautdelille_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

/**
* COMMENT NUMBER
*/

add_filter( 'get_comments_number', 'thibautdelille_comments_number' );
function thibautdelille_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

/**********************************************************************
*                              FUNCTIONS                              *
***********************************************************************/

function thibautdelille_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}