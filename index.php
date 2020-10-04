<?php

/**
 * @package sunsetheme
 */

?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container sunset-posts-container">
				<?php
					if( have_posts() ):
						while( have_posts() ): the_post();
							get_template_part('template-parts/content', get_post_format());
						endwhile;
					endif;
				?>
			</div>
            <div class="container text-center">
                <button class="btn btn-lg btn-default sunset-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <span class="sunset-icon sunset-loading"></span> Load More</button>
            </div>
		</main>
	</div>

<?php get_footer(); ?>