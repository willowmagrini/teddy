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

////////////////slider////////////////


function slider_cpt(){
	$slider = new Odin_Post_Type(
	    'Slide', // Nome (Singular) do Post Type.
	    'slider' // Slug do Post Type.
	);
	$slider->set_labels(
	    array(
	        'menu_name' => __( 'Slider', 'odin' )
	    )
	);
	$slider->set_arguments(
        array(
		 	'menu_icon' => 'dashicons-format-gallery',
	  		'supports' => array( 'title', 'editor', 'thumbnail' )
    	)
	);
	
}
add_action( 'init', 'slider_cpt', 1 );
///////////////////////////////////////////////////////////////
////////////////Custom post types////////////////
////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
////////////////Custom Field videos////////////////
////////////////////////////////////////////////////////////////


function my_register_fields()
{
    include_once( get_stylesheet_directory().'/assets/php/acf-video.php');
}
add_action('acf/register_fields', 'my_register_fields');

///////////////////////////////////////////////////////////////
/////////////Custom Field videos////
////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////
////////////////scripts////////////////
////////////////////////////////////////////////////////////////


function scripts() {
if ( is_page_template( 'page-portfolio.php' )) { 
		wp_register_script('portfolio-js', ( get_bloginfo('template_url').'/assets/js/portfolioscript.js'), array('jquery')); 
		wp_enqueue_script('portfolio-js'); 
	}

	elseif ( is_page_template( 'page-clientes.php' )) { 
		wp_register_script('clientes-js', ( get_bloginfo('template_url').'/assets/js/clientescript.js'), array('jquery')); 
		wp_enqueue_script('clientes-js'); 
	}
	elseif  (is_page_template( 'page-contato.php' )){
	//maps
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js');

	//	wp_enqueue_script('formulario-ajax', plugins_url( 'formulario-ajax/formulario-ajax.js' ), array('jquery'));


		// $localize = array(
		// 			'ajaxurl' => admin_url( 'admin-ajax.php' )
		// 			);
		// 		wp_localize_script('formulario-ajax', 'SCF', $localize);
		// 		
	
	}
	
}
add_action( 'wp_print_scripts', 'scripts'); // now just run the function
///////////////////////////////////////////////////////////////
////////////////scripts////////////////
////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////
//////////////////paginacao///////////////////////////////////   /
/////////////////////////////////////////////////////////////////////////////

function base_pagination() {
    global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}

//////////////////////////////////////////////////////////////////
//////////////////paginacao///////////////////////////////////   /
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////thumsize///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_image_size( 'slider', 665, 350, true ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
/////////////////////thumsize///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////
//////////////////shortcode [slider]///////////////////////////////////   /

			    
/////////////////////////////////////////////////////////////////////////////
//willowloop para exibir posts com thumbnail como shotcode
remove_filter( 'the_content', 'wpautop' );

	function willow_loop_shortcode( $atts ) {
	    extract( shortcode_atts( array(
	        'tipo' => 'slider',
			'categoria'=> '',
			'tag' => '',
			'pula'=> '',
	    ), $atts ) );
	   $args = array(
	        'post_type' => $tipo,
			'category' => $categoria,
			'offset' => $pula,
			'tag'    => $tag,
			'orderby' => 'menu_order',
			'order'=>'ASC'
	    );
	    $willow_query = new  WP_Query( $args );
		$num=$willow_query->post_count;
		$count=0;
		echo '<div id="myCarousel" class="col-sm-6 carousel slide" data-ride="carousel">';
		
	
		$count=0;
	    echo '</ol>';
		echo '<div class="carousel-inner">';
		while ( $willow_query->have_posts() ) : $willow_query->the_post();
	    	echo '<div class="item';
				if ($count == 0){
					echo ' active';
				}
				echo'">
					<div class="img-carousel">';
			    		the_post_thumbnail('slider');
					echo '</div>
					<div class="carousel-caption ">
		           	  	<div class="titulo-carousel">
			           		<h3>';
								the_title();
							echo '</h3>
						</div>
			 		</div>';
			echo '</div><!--item-->';
					
			$count++;
	    endwhile;
	
	    wp_reset_query();
		echo '</div>
		<!-- Carousel items -->
	
	
	    <!-- Carousel nav -->
	    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left"></span>
	    </a>
	    <a class="carousel-control right" href="#myCarousel" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right"></span>
	    </a>
	</div><!--carousel-inner-->';
		
	}
	add_shortcode('willowloop', 'willow_loop_shortcode');
// fim do willowloop

///////////////////////////////////////////////////////////////////
//////////////////shortcode [slider]///////////////////////////////////   /
/////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////	///////////////////////////////////////////////////////////////
	/////////////////////custom logo/////////////////////////////
		///////////////////////////////////////////////////////////////

		function my_login_logo() { ?>
		    <style type="text/css">
		        body.login div#login h1 a {
		            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-preto.png);
		            padding-bottom: 0;
					padding-bottom: 0;
					width: 180px;
					height: 180px;
					background-size: 180px;
					
		        }
				body, #loginform{
					background:#000;
				}
		    </style>
		<?php }
		add_action( 'login_enqueue_scripts', 'my_login_logo' );

//////////////////////////////////////////////////////////////	///////////////////////////////////////////////////////////////
/////////////////////custom logo/////////////////////////////
///////////////////////////////////////////////////////////////
		
add_filter('show_admin_bar', '__return_false');
/////////////////////////////////////////////////////////////
////////////////////qtranslate custom taxonomy///////////////
/////////////////////////////////////////////////////////////

function qtranslate_edit_taxonomies(){
   $args=array(
      'public' => true ,
      '_builtin' => false
   );
   $output = 'object'; // or objects
   $operator = 'and'; // 'and' or 'or'

   $taxonomies = get_taxonomies($args,$output,$operator); 

   if  ($taxonomies) {
     foreach ($taxonomies  as $taxonomy ) {
         add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
         add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');        

     }
   }

}
add_action('admin_init', 'qtranslate_edit_taxonomies');
/////////////////////////////////////////////////////////////
////////////////////qtranslate custom taxonomy///////////////
/////////////////////////////////////////////////////////////		