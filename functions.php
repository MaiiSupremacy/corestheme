<?php

/**
 * CORES Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CORES_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme Setup
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cores_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'cores-theme' ),
			'footer-menu'  => esc_html__( 'Footer Menu', 'cores-theme' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'cores_theme_setup' );


/**
 * Enqueue scripts and styles.
 */
function cores_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap', array(), null );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Leaflet CSS (for map)
	wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
	
	// *** NEW: Swiper.js CSS (for gallery carousel) ***
	wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );

	// Main Theme Stylesheet
	wp_enqueue_style( 'cores-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) );

	// --- Scripts ---

	// Leaflet JS (for map)
	wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );

	// Chart.js (for data viz)
	wp_enqueue_script( 'chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '4.4.0', true );
	
	// *** NEW: Swiper.js (for gallery carousel) ***
	wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

	// Main Theme JavaScript
	// We make it dependent on 'swiper-js' so our script runs after the library is loaded.
	wp_enqueue_script( 'cores-main-js', get_template_directory_uri() . '/js/main.js', array( 'leaflet-js', 'chart-js', 'swiper-js' ), filemtime( get_template_directory() . '/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'cores_enqueue_assets' );


/**
 * *** NEW: Fallback menu for main navigation ***
 * Provides a gracefully degrading menu if no menu is assigned in 'Appearance > Menus'.
 * This fixes the "Home only" bug.
 */
function cores_menu_fallback( $args ) {
	echo '<ul class="cores-menu-fallback">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#research' ) ) . '">Research</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#team' ) ) . '">Team</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#publications' ) ) . '">Publications</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#news' ) ) . '">News</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#gallery' ) ) . '">Gallery</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/#contact' ) ) . '">Contact</a></li>';
	echo '</ul>';
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cores_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'cores-theme' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'cores-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cores_widgets_init' );

?>