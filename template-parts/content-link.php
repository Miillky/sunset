<?php
/**
 * @package sunsettheme
 * Link Post Format
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-link'); ?>>
	<header class="entry-header text-center">
		<?php
            the_title('<h1 class="entry-title">
                <a href="'. sunset_grab_url() .'" target="_blank">', '
                    <div class="link-icon">
                        <span class="sunset-icon sunset-link"></span>
                    </div>
                </a>
            </h1>');
        ?>
	</header>
</article>