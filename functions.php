<?php

class Chopan_2019 {
	public function init () {
		require_once __DIR__ .'/inc/customize.php';
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets'] );
		add_filter( 'script_loader_tag', [ $this, 'filter_script_tags'], 10, 3 );
		add_filter( 'body_class', [ $this, 'filter_body_class'], 10 );
		add_action( 'after_setup_theme', [ $this, 'setup_theme'] );
	}
	public function setup_theme() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5' );
		add_theme_support( 'title-tag' );

		// add_image_size( 'archive__gallery', 760, 461, true );
		add_image_size( 'single__featured', 1170, 710, true );
		add_image_size( 'single__gallery', 1170, 9999, true );
	}
	public function filter_body_class( array $classes ) : array {
		$classes[] = 'page';
		if ( is_front_page() ) {
			$classes[] = '--index';
			$classes[] = 'preload';
		}
		if ( is_page('writings') ) {
			$classes[] = '--writings';
			$classes[] = '--blog';
		}
		if ( is_page('work') ) {
			$classes[] = '--work';
			$classes[] = '--blog';
		}
		if ( is_singular('jetpack-portfolio') ) {
			$classes[] = '--work-post';
		}
		if ( is_page('me') ) {
			$classes[] = '--me';
		}
		if ( is_single() ) {
			$classes[] = '--writings-post';
		}
		return $classes;
	}
	public function enqueue_assets() {
		wp_enqueue_style( 'fonts', 'https://use.typekit.net/jvs0wcq.css', [], 'all' );
		wp_enqueue_style( 'style', get_template_directory_uri() .'/app/dist/application.css', [ 'fonts' ], 'all' );
		wp_enqueue_script( 'site', get_template_directory_uri() .'/app/dist/index.bundle.js', [], null, false );
	}
	public function filter_script_tags( string $tag, string $handle, string $src ) : string {
		if ( $handle === 'site' ) {
			return "<script src='$src' defer></script>";
		}
		return $tag;
	}
}

( new Chopan_2019() )->init();