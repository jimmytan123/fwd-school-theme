<?php

/**
 * The template for displaying page schedule
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

		// ACF Repeator field for schedule
		// check if the repeater field has rows of data
		//course_schedule is the field name
		if (have_rows('course_schedule')) : ?>
			<table>
				<?php
				// loop through the rows of data
				while (have_rows('course_schedule')) :
					the_row(); ?>

					<!-- display a sub field value -->
					<tr>
						<td><strong><?php the_sub_field('date'); ?></strong></td>
						<td>Course: <strong><?php the_sub_field('course'); ?></strong></td>
						<td>Instructor: <strong><?php the_sub_field('instructor'); ?></strong></td>
					</tr>

				<?php endwhile; ?>
			</table>
	<?php endif;


	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
