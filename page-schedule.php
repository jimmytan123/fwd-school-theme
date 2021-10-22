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
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header><!-- .entry-header -->

			<?php fwdshool_post_thumbnail(); ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'fwdshool'),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

			<!-- // ACF Repeator field for schedule
			// check if the repeater field has rows of data
			//course_schedule is the field name -->
			<?php if (have_rows('course_schedule')) : ?>
				<table>
					<?php
					// loop through the rows of data
					while (have_rows('course_schedule')) :
						the_row(); ?>

						<!-- display a sub field value -->
						<tr>
							<td><strong>
									<?php if (function_exists('get_sub_field')) :
										if (get_sub_field('date')) :
											the_sub_field('date');
										endif;
									endif;
									?>
								</strong></td>
							<td>Course: <strong>
									<?php if (function_exists('get_sub_field')) :
										if (get_sub_field('course')) :
											the_sub_field('course');
										endif;
									endif;
									?>
								</strong></td>
							<td>Instructor: <strong>
									<?php if (function_exists('get_sub_field')) :
										if (get_sub_field('instructor')) :
											the_sub_field('instructor');
										endif;
									endif;
									?>
								</strong></td>
						</tr>

					<?php endwhile; ?>
				</table>
		<?php endif;


		endwhile; // End of the loop.
		?>

		</article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php
get_footer();
