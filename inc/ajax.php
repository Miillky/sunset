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
	$prev = $_POST['prev'];

	if( $prev == 1 && $_POST['page'] != 1 ){
	    $paged = $_POST['page'] - 1;
    }

	$query = new WP_Query([
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'paged'         => $paged
	]);

	if( $query->have_posts() ): ?>

		<div class="page-limit" data-page="/page/<?php echo $paged; ?>">
			<?php
				while( $query->have_posts() ): $query->the_post();
					get_template_part('template-parts/content', get_post_format());
				endwhile;
			?>
		</div>

	<?php
    else:

        echo 0;

	endif;

	wp_reset_postdata();

	die();
}
add_action('wp_ajax_nopriv_sunset_load_more', 'sunset_load_more');
add_action('wp_ajax_sunset_load_more', 'sunset_load_more');

/**
 * @param null $num
 * @return string
 */
function sunset_check_page($num = null){

    $output = '';

    if( is_paged() ){
        $output = 'page/' . get_query_var('paged');
    }

    if( $num == 1 ){
        return get_query_var('paged') == 0 ? 1 : get_query_var('paged');
    } else {
        return $output;
    }
}