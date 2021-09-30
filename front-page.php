<?php

/**
 * The template for displaying home page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_School_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		//outputting 3 most recent blog posts using WP_Query()
		//each block has a title, featured image, and link to the single post page
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
		);
		$blog_query = new WP_Query($args);
		if ($blog_query->have_posts()) : ?>
			<section class='recent-news'>
				<h2>Recent News</h2>
				<?php while ($blog_query->have_posts()) :
					$blog_query->the_post(); ?>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title() ?></h3>
						<?php the_post_thumbnail('medium'); ?>
					</a>
				<?php endwhile; ?>
				<p>
					<a href="<?php the_permalink(8); ?>" class='all-news-link'>See All News</a>
				</p>
			</section>
		<?php endif; ?>


	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
