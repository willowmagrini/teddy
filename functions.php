<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since  2.2.0
	 *
	 * @return void
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap.
	wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

	// General scripts.
	// FitVids.
	wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

	// Main jQuery.
	wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );

	// Grunt main file with Bootstrap, FitVids and others libs.
	// wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/plugins-support.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';
////////google-fonts
function load_fonts() {
            wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext');
            wp_enqueue_style( 'googleFonts');
        }
    
    add_action('wp_print_styles', 'load_fonts');

//////////////////////google-fonts//////////////////////////
////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////
////////////////Opcoes do tema////////////////
////////////////////////////////////////////////////////////////
$odin_theme_options = new Odin_Theme_Options( 
    'opcoes', // Slug/ID da página (Obrigatório)
    __( 'Opções do tema', 'odin' ), // Titulo da página (Obrigatório)
    'manage_options' // Nível de permissão (Opcional) [padrão é manage_options]
);
$odin_theme_options->set_tabs(
    array(
		array(
			'id' => 'socials', // ID da aba e nome da entrada no banco de dados.
			'title' => __( 'Configurações', 'odin' ), // Título da aba.
		),
    )
);
$odin_theme_options->set_fields(
    array(
        'general_section' => array(
            'tab'   => 'socials', // Sessão da aba odin_general
            'title' => __( 'Redes Sociais', 'odin' ),
            'fields' => array(
                array(
                    'id' => 'facebook',
                    'label' => __( 'Facebook', 'odin' ),
                    'type' => 'text',
                    'default' => '',
                ),
                array(
                    'id' => 'instagram',
                    'label' => __( 'Instagram', 'odin' ),
                    'type' => 'text'
                ),
				array(
                    'id' => 'youtube',
                    'label' => __( 'Youtube', 'odin' ),
                    'type' => 'text'
                )
            )
        ),        
    )
);
function coloca_http($endereco){
	$http = substr ($endereco, 0 , 7);
	if ($http == 'http://'){
		return $endereco;
	}
	else {
		return 'http://'.$endereco;
	}
}

////////////////////////////////////////////////////////////////
////////////////Opcoes do tema////////////////
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
////////////////Custom post types////////////////
////////////////////////////////////////////////////////////////

////////////////Portfolio////////////////


function portfolio_cpt(){
	$portfolio = new Odin_Post_Type(
	    'Item de Portfólio', // Nome (Singular) do Post Type.
	    'portfolio' // Slug do Post Type.
	);
	$portfolio->set_labels(
	    array(
	        'menu_name' => __( 'Itens de Portfólio', 'odin' )
	    )
	);
	$portfolio->set_arguments(
        array(
		 	'menu_icon' => 'dashicons-video-alt3',
      		'supports' => array( 'title', 'editor' )
    	)
	);
	$porfolio_cat = new Odin_Taxonomy(
	    'Categoria', // Nome (Singular) da nova Taxonomia.
	    'port_categoria', // Slug do Taxonomia.
	    'portfolio' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
	);
	$porfolio_cat->set_labels(
		array(
			'add_new_item' => 'Adicionar Nova'
		)
	);
}
add_action( 'init', 'portfolio_cpt', 1 );



////////////////Portfolio////////////////

////////////////Clientes////////////////


function clientes_cpt(){
	$clientes = new Odin_Post_Type(
	    'Cliente', // Nome (Singular) do Post Type.
	    'clientes' // Slug do Post Type.
	);
	$clientes->set_labels(
	    array(
	        'menu_name' => __( 'Clientes', 'odin' )
	    )
	);
	$clientes->set_arguments(
        array(
		 	'menu_icon' => 'dashicons-universal-access',
	  		'supports' => array( 'title', 'editor' )
    	)
	);
	$clientes_cat = new Odin_Taxonomy(
	    'Categoria', // Nome (Singular) da nova Taxonomia.
	    'clie_categoria', // Slug do Taxonomia.
	    'clientes' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
	);
	$clientes_cat->set_labels(
		array(
			'add_new_item' => 'Adicionar Nova'
		)
	);
}
add_action( 'init', 'clientes_cpt', 1 );
///////////////////////////////////////////////////////////////
////////////////Custom post types////////////////
////////////////////////////////////////////////////////////////