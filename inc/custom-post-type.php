<?php

/*
	@package sunset
	THEME CUSTOM POST TYPES
*/

$contact = get_option('activate_contact');
if($contact){
	add_action('init', 'sunset_contact_custom_post_type');

	add_filter('manage_sunset-contact_posts_columns', 'sunset_set_contact_columns' );
	add_action('manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2);
}

/*Contact Custom Post Type*/
function sunset_contact_custom_post_type(){
	$labels = [
		'name' 				=> 'Messages',
		'singular_name' 	=> 'Message',
		'menu_name'			=> 'Messages',
		'name_admin_bar'	=> 'Message'
	];

	$args = [
		'labels' 			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capatibility_type' => 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'show_in_rest' 		=> true,
		'supports'			=> ['title', 'editor', 'author'],
	];

	register_post_type('sunset-contact', $args);

}

function sunset_set_contact_columns($columns){
	$newColumns = [];
	$newColumns['title'] 	= 'Full name';
	$newColumns['message'] 	= 'Message';
	$newColumns['email']	= 'Email';
	$newColumns['date']		= 'Date';
	return $newColumns;
}

function sunset_contact_custom_column($column, $post_id){
	switch($column):
		case 'message':
			echo get_the_excerpt();
			break;
		case 'email':
			echo 'email address';
			break;
	endswitch;
}