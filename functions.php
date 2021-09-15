<?php
// Theme Support
function bootstrapthme_setup() {
	/* Sets up the content width value based on the theme's design. */
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	add_theme_support( 'title-tag' );
	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style( 'css/editor_style.css' );
	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	/* Switches default core markup for search form, comment form, and comments to output valid HTML5. */
	add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
	/* This theme supports all available post formats by default. See http://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats',
		array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);
	add_theme_support( 'custom-header',
		array(
			'default-image'          => '',
			'width'                  => 1920,
			'height'                 => 245,
			'flex-width'             => false,
			'flex-height'            => false,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '#444',
			'uploads'                => true,
			'wp-head-callback'       => 'bootstrapthme_header_style',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		)
	);
	/* This theme supports custom background color and image, and here we also set up the default background color. */
	add_theme_support( 'custom-background',
		array(
			'default-color' => 'fff',
		)
	);
	/* This theme uses a custom image size for featured images, displayed on "standard" posts. */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'best_image_content_size', 656, 9999 ); /* Unlimited height, soft crop */

	
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'bootstrapthme' ),'primary' => esc_html__( 'Primary Menu', 'bootstrapthme' ),'footer' => esc_html__( 'Footer Menu', 'bootstrapthme' )
	) );
}

if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
	function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}


function bootstrapthme_header_style() {
	$text_color   = get_header_textcolor();
	$display_text = display_header_text();
	/* If no custom options for text are set, return default. */
	if ( HEADER_TEXTCOLOR == $text_color ) {
		return;
	}
	/* If optins are set, we use them  */ ?>
	<style type="text/css">
		<?php /*If the user has set a custom color for the text use that */
		if ( 'blank' != $text_color ) { ?>
			.best-site-title,
			.best-site-title a {
				color: <?php echo '#' . $text_color . '!important'; ?>;
			}
		<?php }
		/* Display text or not */
		if ( ! $display_text ) { ?>
			.best-site-title {
				display: none;
			}
		<?php } ?>
	</style>
<?php }



 //Add HTML5 theme support.
 
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function bootstrapthme_widgets_init() {
// Area 1.
register_sidebar(
	array(
		'name'          => 'Primary Widget Area (Sidebar)',
		'id'            => 'primary_widget_area',
		'before_widget' => '<div class="card mb-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header">',
		'after_title'   => '</div>', 
	)
);

// Area 2.
register_sidebar(
	array(
		'name'          => 'Secondary Widget Area (Header Navigation)',
		'id'            => 'secondary_widget_area',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

// Area 3.
register_sidebar(
	array(
		'name'          => 'Third Widget Area (Footer)',
		'id'            => 'third_widget_area',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);
	register_sidebar( array(
		'name'          => 'Home Banner Slider',
		'id'            => 'home_banner',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Home Sidebar',
		'id'            => 'home_sidebar',		
        'description'    => 'ff',
        'class'          => 'list-unstyled mb-0',
		'before_widget' => '<div class="card mb-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header">',
		'after_title'   => '</div>', 
		
	) );
	register_sidebar( array(
		'name'          => 'Home Footer Widget',
		'id'            => 'home_footer',
		'before_widget' => '<aside class="home_sidewidget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'bootstrapthme_widgets_init' );


function slider_init() {
    $args = array(
      'label' => 'Image Slider',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'img_slider'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-media',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'img_slider', $args );
}
add_action( 'init', 'slider_init' );

function client_init() {
    $args = array(
      'label' => 'Testimonials',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'client_say'),
        'query_var' => true,
        'menu_icon' => 'dashicons-format-chat',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'client_say', $args );
}
add_action( 'init', 'client_init' );

function team_init() {
    $args = array(
      'label' => 'Team Member',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'team_member'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'team_member', $args );
}
add_action( 'init', 'team_init' );
/**
 * Enqueue scripts and styles.
 */
function theme_files(){

	    // Theme block stylesheet.
		wp_enqueue_style('mainstyle', get_template_directory_uri().'/style.css', array(), $theme_version, 'all');
		wp_enqueue_style( 'bootstrap-5','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
	    wp_enqueue_style( 'font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
		
		// Theme block Javascript.	
	    wp_enqueue_script('Bundle', get_template_directory_uri().'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',0,0,true);
	 
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
}


add_action( 'after_setup_theme', 'bootstrapthme_setup' );

add_action( 'wp_enqueue_scripts', 'theme_files' );

?>