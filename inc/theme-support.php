<?php

/*
	@package sunset
	THEME SUPPORT OPTIONS
*/

$options = get_option('post_formats');
if(!empty($options)){
	$formats = ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'];
	$output = [];
	foreach($formats as $format){
		$output[] = (@$options[$format] == 1 ? $format : '');
	}
	add_theme_support('post-formats', $output);
}

$header = get_option('custom_header');
if($header){
	add_theme_support('custom-header');
}

$background = get_option('custom_background');
if($background){
	add_theme_support('custom-background');
}

add_theme_support('post-thumbnails');

// Activate Nav Menu Option
function sunset_register_nav_menu(){
	register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'sunset_register_nav_menu');

/**
 * BLOG LOOP POST META
 * @return string
 */
function sunset_posted_meta(){
	$posted_on  = human_time_diff(get_the_time('U'), current_time('timestamp'));
	$categories = get_the_category();
	$separator  = ', ';
	$output     = '';
	$i          = 1;
	if(!empty($categories)):
		foreach($categories as $category):
			if($i > 1):
				$output .= $separator;
			endif;
			$output .= '<a href="' . esc_url( get_category_link($category->term_id) ) . '">' . esc_html($category->name) . '</a>';
			$i++;
		endforeach;
	endif;
	return '<span class="posted-on">Posted <a href="' . esc_url(get_permalink()) . '">' . $posted_on . '</a> ago</span> / <span class="posted-on">' . $output . '</span>';
}

/**
 * BLOG LOOP POST FOOTER
 * @return string
 */
function sunset_posted_footer(){

    $comments_num = get_comments_number();
    if(comments_open()){
        if($comments_num == 0){
            $comments = __('No Comments');
        } elseif($comments_num > 1) {
            $comments = $comments_num . __(' Comments');
        } else {
            $comments = __('1 Comment');
        }
        $comments = '<a href="' . get_comments_link() . '" class="comments-link">' . $comments . ' <span class="sunset-icon sunset-comment"></span></a>';
    } else {
        $comments = __('Comments are closed');
    }

	ob_start(); ?>

		<div class="post-footer-container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<?php the_tags('<div class="tags-list"><span class="sunset-icon sunset-tag"></span>', ' ', '</span></div>'); ?>
				</div>
				<div class="col-xs-12 col-sm-6 text-right">
					<?php echo $comments; ?>
				</div>
			</div>
		</div>

	<?php
	return ob_get_clean();
}

/**
 * @return false|mixed|string
 * Return Image URL from post content
 */
function sunset_get_attachment(){

    $output = '';

	if( has_post_thumbnail() ):
		$output = wp_get_attachment_url(get_post_thumbnail_id( get_the_ID() ) );
	else:

		/*
		    global $post;
		    preg_match_all('/img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		    $output = $matches[1][0];
		*/

		$attachments = get_posts([
			'post_type'         => 'attachment',
			'posts_per_page'    => 1,
			'post_parent'       => get_the_ID()
		]);

		if($attachments):
			foreach($attachments as $attachment):
				$output = wp_get_attachment_url($attachment->ID);
			endforeach;
		endif;

		wp_reset_postdata();

	endif;

	return $output;
}