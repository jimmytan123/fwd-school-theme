<?php

/**
 * The template for displaying Student archive page (this page also add the link into navs)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_School_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</header><!-- .page-header -->

		<?php
		//displaying all students from Student CPT order by their firstname order by asc
		$args = array(
			'post_type' => 'fwd-student',
			'post_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);

		$query = new WP_Query($args);
		if ($query->have_posts()) : ?>
			<section class='students'>
				<?php while ($query->have_posts()) :
					$query->the_post(); ?>
					<article class='student-item'>
						<h2><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_post_thumbnail('medium') ?>
						<?php the_excerpt(); ?>
						<!-- Modified by myself from https://support.advancedcustomfields.com/forums/topic/get-taxonomy-terms-from-custom-loop/ -->
						<?php $terms = get_the_term_list(get_the_ID(), 'fwd-student-category');
						if ($terms) : ?>
							<p>Specialty: <?php echo $terms; ?></p>
						<?php endif; ?>
					</article>
			<?php endwhile;

				wp_reset_postdata();
				echo "</section>";
			endif;
			?>
			</section>
		<?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
