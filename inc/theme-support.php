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
 * @param string $size
 * @param int $num
 * @return false|mixed|string
 * Return Image URL from post content
 */
function sunset_get_attachment($size = 'src', $num = 1){

	$output = $num == 1 ? '' : [];

	if( has_post_thumbnail() && $num == 1 ):

		$output = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size)[0];

    elseif( has_block('gallery', get_the_ID()) ):

		$post_blocks = parse_blocks(get_the_content());
		foreach($post_blocks as $block):
			if($block['blockName'] == 'core/gallery' ):
				foreach($block['attrs']['ids'] as $index => $attachment_id):
					if($num == 1):
						$output = $attachment_id;
						break;
                    elseif($num > 1):
						if($index < $num):
							$output[] = $attachment_id;
						else:
							break;
						endif;
					endif;
				endforeach;
			endif;
		endforeach;

    elseif( get_post_gallery( get_the_ID(), false ) ):

		if($num == 1):
			$output = get_post_gallery_images(get_the_ID())[0];
		else:
			$output = get_post_gallery_images(get_the_ID());
		endif;

	else:

		/*
		    global $post;
		    preg_match_all('/img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		    $output = $matches[1][0];
		*/

		$attachments = get_posts([
			'post_type'         => 'attachment',
			'posts_per_page'    => $num,
			'post_parent'       => get_the_ID()
		]);

		if($attachments && $num == 1):
			foreach($attachments as $attachment):
				$output = wp_get_attachment_image_src($attachment->ID, $size)[0];
			endforeach;
        elseif($attachments && $num > 1):
			$output = $attachments;
		endif;

		wp_reset_postdata();

	endif;

	return $output;
}

/**
 * @param array $type
 * @return string|string[]
 * Get embedded media from post content
 */
function sunset_get_embedded_media( $type = [] ){

	$content = do_shortcode(apply_filters('the_content', get_the_content()));
	$embed = get_media_embedded_in_content($content, $type);

	if(in_array('audio', $type)):
        $output = str_replace( '?visual=true', '?visual=false', $embed[0]);
	else:
        $output = $embed[0];
	endif;

	return $output;
}

/**
 * @param $attachments
 * @return array
 * Get gallery carousel slides
 */
function sunset_get_bs_slide($attachments){

    $output = [];
    $count = count($attachments) - 1;

    for($i = 0; $i <= $count; $i++):

        $active = ($i == 0) ? ' active' : '';
        $next   = $i == $count ? 0 : $i+1;
        $prev   = $i == 0 ? $count : $i-1;
        $nextImg = wp_get_attachment_thumb_url($attachments[$next]);
        $prevImg = wp_get_attachment_thumb_url($attachments[$prev]);

        $output[$i] = [
            'class'     => $active,
            'url'       => wp_get_attachment_url($attachments[$i]),
            'next_img'  => $nextImg,
            'prev_img'  => $prevImg,
            'caption'   => get_the_excerpt($attachments[$i])
        ];

    endfor;

    return $output;
}


/**
 * @return false|mixed|string
 * Get first URL in content
 */
function sunset_grab_url(){
    if( !preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links) ){
	    return false;
    }
    return esc_url_raw($links[1]);
}