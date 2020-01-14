<?php

/*
	@package sunset
	ADMIN ENQUEUE FUNCTIONS
*/

function sunset_load_admin_scripts($hook){

	if( 'toplevel_page_miillky_sunset' != $hook ){ return; }

	wp_register_style('sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', [], '1.0.0', 'all');
	wp_enqueue_style('sunset_admin');

}
add_action('admin_enqueue_scripts', 'sunset_load_admin_scripts');