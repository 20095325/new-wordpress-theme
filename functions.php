<?php

if(!function_exists('camnewtheme_setup')){

    // theme setup

    function camnewtheme_setup() {

        load_theme_textdomain('camnewtheme', get_template_directory().'/languages');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('responsive-embeds');

        register_nav_menus(
                array(
                    'primary' => esc_html__('Primary Menu', 'camnewtheme')
                )
            );

    }

    require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';

    add_action('after_setup_theme', 'camnewtheme_setup');
}

// enqueue scripts and styles

function cam_scripts_styles() {

    // enqueue css files
    wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), '1.0.0', false);
    wp_enqueue_style( 'bootstrap', get_theme_file_uri('css/bootstrap.min.css'), array(), '5.3.0', false);
    wp_enqueue_style( 'flaticon', get_theme_file_uri('fonts/flaticon.css'), array(), '1.0.0', false);

    // main css file
    wp_enqueue_style( 'cam-new-theme', get_theme_file_uri('style.css'), array('bootstrap'), '1.0.0', false);

    // enqueue js files
    wp_enqueue_script( 'bootstrap', get_theme_file_uri('js/bootstrap.bundle.js'), array(), '5.3.0', true);
    wp_enqueue_script( 'cam-new-theme-js', get_theme_file_uri('js/main.js'), array('jquery', 'jquery-ui-core', 'jquery-ui-selectmenu'), '1.0.0', true);
    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
        wp_enqueue_script( 'comments-reply' );
    }

}

add_action( 'wp_enqueue_scripts', 'cam_scripts_styles');

// custom read more text

function camnewtheme_excerpt_readmore($more){
    return '...';
}

add_filter('excerpt_more', 'camnewtheme_excerpt_readmore');

// pagination

function camnewtheme_pagination() {
    global $wp_query;
    $links = paginate_links(
        array(
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'list',
            'prev_text' => '<-',
            'next_text' => '->'
        )
    );
    $links = '<nav class="camnewtheme-pagination">' . $links;
    $links .= '</nav>';
    echo wp_kses_post($links);
}

// Remove junk from head

remove_action( 'wp_head', '_wp_render_title_tag', 1 );
//remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action( 'publish_future_post', 'check_and_publish_future_post', 10);
remove_action( 'wp_head', 'wp_robots', 1 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'wp_print_styles', 2 );
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'wp_custom_css_cb', 101 );
remove_action( 'wp_head', 'wp_site_icon', 99 );
//remove_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
//remove_action( 'wp_print_footer_scripts', '_wp_footer_scripts' );
remove_action( 'init', '_register_core_block_patterns_and_categories' );
remove_action( 'init', 'check_theme_switched', 99 );
remove_action( 'init', array( 'WP_Block_Supports', 'init' ), 22 );
remove_action( 'switch_theme', array( 'WP_Theme_JSON_Resolver', 'clean_cached_data' ) );
remove_action( 'start_previewing_theme', array( 'WP_Theme_JSON_Resolver', 'clean_cached_data' ) );
remove_action( 'after_switch_theme', '_wp_menus_changed' );
remove_action( 'after_switch_theme', '_wp_sidebars_changed' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Fix for bootstrap 5 dropdown menu items

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}