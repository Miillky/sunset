<?php
/**
 * @package sunsettheme
 * Aside Post Format
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-aside'); ?>>
    <div class="aside-container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-2 text-center">
			    <?php if($attachment = sunset_get_attachment()): ?>
                    <div class="aside-featured background-image" style="background-image: url('<?php echo $attachment; ?>')"></div>
			    <?php endif; ?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <header class="entry-header text-center">
                    <div class="entry-meta">
					    <?php echo sunset_posted_meta(); ?>
                    </div>
                </header>
                <div class="entry-content">
                    <div class="entry-excerpt">
					    <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="entry-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
				    <?php echo sunset_posted_footer(); ?>
                </div>
            </div>
        </footer>
    </div>
</article>