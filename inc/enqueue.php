<?php

/*
	@package sunset
	ADMIN ENQUEUE FUNCTIONS
*/

function sunset_load_admin_scripts($hook){

	if( 'toplevel_page_miillky_sunset' == $hook ){

		wp_register_style('sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', [], '1.0.0', 'all');
		wp_enqueue_style('sunset_admin');

		wp_enqueue_media();

		wp_register_script('sunset-admin-script', get_template_directory_uri() . '/js/sunset.admin.js', ['jquery'], '1.0.0', true);
		wp_enqueue_script('sunset-admin-script');

	} else if( 'sunset_page_miillky_sunset_css' == $hook ) {

		wp_enqueue_style('ace', get_template_directory_uri() . '/css/sunset.ace.css', [], '1.0.0', 'all');

		wp_enqueue_script('ace', get_template_directory_uri() . '/js/ace/ace.js', ['jquery'], '14.01.20', true);
		wp_enqueue_script('sunset-custom-css-script', get_template_directory_uri() . '/js/sunset.custom_css.js', ['jquery'], '1.0.0', true);

	} else { return; }
}
add_action('admin_enqueue_scripts', 'sunset_load_admin_scripts');


/**
 * FRONT-END ENQUEUE FUNCTIONS
 */

function sunset_load_scripts(){

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], '3.4.1', 'all');
	wp_enqueue_style('sunset', get_template_directory_uri() . '/css/sunset.css', ['bootstrap'], '1.0.0', 'all');
	wp_enqueue_style('raleway', 'https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500&display=swap');

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', [], '3.5.1', true);
	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], '3.4.1', true);
	wp_enqueue_script('sunset', get_template_directory_uri() . '/js/sunset.js', ['jquery'], '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'sunset_load_scripts');