<?php
/**
 * @package sunsettheme
 * Gallery Post Format
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-gallery'); ?>>
	<header class="entry-header text-center">
		<?php if($attachments = sunset_get_attachment(7)): ?>
            <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $active = true; ?>
                    <?php foreach($attachments as $attachment): ?>
                        <?php $active = $active ? ' active' : ''; ?>
                        <div class="item background-image standard-featured<?php echo $active; ?>" style="background-image: url(<?php echo $attachment; ?>);"></div>
                        <?php $active = $active && false; ?>
                    <?php endforeach; ?>
                </div>
                <a href="#post-gallery-<?php the_ID(); ?>" class="left carousel-control" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#post-gallery-<?php the_ID(); ?>" class="right carousel-control" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
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