<?php
/**
 * @package sunsettheme
 * Gallery Post Format
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-gallery'); ?>>
	<header class="entry-header text-center">
		<?php if($attachments = sunset_get_attachment('large', 7)): ?>
            <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide sunset-carousel-thumb" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = count($attachments) - 1; ?>
                    <?php for($i = 0; $i <= $count; $i++): ?>
                        <?php
                            $active = ($i == 0) ? ' active' : '';
                            $next   = $i == $count ? 0 : $i+1;
	                        $prev   = $i == 0 ? $count : $i-1;
	                        $nextImg = wp_get_attachment_thumb_url($attachments[$next]);
                            $prevImg = wp_get_attachment_thumb_url($attachments[$prev]);
                        ?>
                        <div class="item background-image standard-featured<?php echo $active; ?>"
                             data-prev-image="<?php echo $prevImg; ?>"
                             data-next-image="<?php echo $nextImg; ?>"
                             style="background-image: url(<?php echo wp_get_attachment_url($attachments[$i]); ?>);">
                        </div>
                    <?php endfor; ?>
                </div>
                <a href="#post-gallery-<?php the_ID(); ?>" class="left carousel-control" role="button" data-slide="prev">
                    <div class="table">
                        <div class="table-cell">
                            <div class="preview-container">
                                <span class="thumbnail-container background-image"></span>
                                <span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#post-gallery-<?php the_ID(); ?>" class="right carousel-control" role="button" data-slide="next">
                    <div class="table">
                        <div class="table-cell">
                            <div class="preview-container">
                                <span class="thumbnail-container background-image"></span>
                                <span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
		<?php endif; ?>
		<?php the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>'); ?>
		<div class="entry-meta">
			<?php echo sunset_posted_meta(); ?>
		</div>
	</header>
	<div class="entry-content">
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<div class="button-container text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-sunset"><?php _e('Read More'); ?></a>
		</div>
	</div>
	<footer class="entry-footer">
		<?php echo sunset_posted_footer(); ?>
	</footer>
</article>