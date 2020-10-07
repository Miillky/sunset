<?php
/*
	@package sunset
	AJAX FUNCTIONS
*/

/**
 * Get current page posts
 */
function sunset_load_more(){

	$paged = $_POST['page'] + 1;

	$query = new WP_Query([
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'paged'         => $paged
	]);

	if( $query->have_posts() ):
		while( $query->have_posts() ): $query->the_post();
			get_template_part('template-parts/content', get_post_format());
		endwhile;
	endif;

	wp_reset_postdata();

	die();
}
add_action('wp_ajax_nopriv_sunset_load_more', 'sunset_load_more');
add_action('wp_ajax_sunset_load_more', 'sunset_load_more');