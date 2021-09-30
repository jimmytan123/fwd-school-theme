<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_School_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<!-- showing ACF content for search result of the CPT -->
		<?php if ('fwd-staff' === get_post_type()) {
			if (function_exists('get_field')) :
				if (get_field('staff_biography')) : ?>
					<p><?php the_field('staff_biography'); ?></p>
		<?php endif;
			endif;
		} ?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php
				fwdshool_posted_on();
				fwdshool_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php fwdshool_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php fwdshool_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->