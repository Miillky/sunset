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
	};
	add_theme_support('post-formats', $output);
}