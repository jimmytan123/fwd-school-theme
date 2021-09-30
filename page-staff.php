<?php

/**
 * The template for displaying Page Staff
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
		the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header>

			<?php
			// For displaying staff cst based on administrative and faculty terms
			// now we have 2 taxonomy for CPT Staff, Faculty and Administrative
			$terms = get_terms(
				array(
					'taxonomy' => 'fwd-staff-category',
				)
			);

			if ($terms && !is_wp_error($terms)) :
				foreach ($terms as $term) : //loop through each staff taxonomy terms
					$args = array(
						'post_type' => 'fwd-staff',
						'post_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'fwd-staff-category',
								'field' => 'slug',
								'terms' => $term->slug,
							),
						),
					);

					$query = new WP_Query($args);
					if ($query->have_posts()) : ?>
						<section class='staff-wrapper'>
							<h2><?php echo $term->name; ?></h2>
							<?php while ($query->have_posts()) :
								$query->the_post();
								if (function_exists('get_field')) :
									if (get_field('staff_biography')) : ?>
										<article class='single-staff'>
											<h3><?php the_title(); ?></h3>
											<p><?php the_field('staff_biography'); ?></p>
											<?php endif;
										//if current term is faculty, show courses and links info
										if ($term->slug === 'faculty') :
											if (get_field('courses')) : ?>
												<p class='course-list'>Courses: <?php the_field('courses'); ?></p>
											<?php endif;
											if (get_field('website_link')) : ?>
												<a class='instructor-link' href="<?php the_field('website_link'); ?>" target="_blank">Instructor Website</a>
										<?php endif;
										endif; ?>
										</article>
								<?php
								endif;
							endwhile; ?>
						</section>
			<?php endif;
				endforeach;
			endif; ?>
		</article>
	<?php endwhile; ?>
</main><!-- #main -->

<?php
get_footer();
