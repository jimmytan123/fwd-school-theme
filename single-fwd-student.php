<?php

/**
 * The template for displaying single student CPT post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FWD_School_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', get_post_type());

	endwhile; // End of the loop.
	?>

	<!-- get template parts for display the link of other students in the same taxonomy -->
	<?php get_template_part('template-parts/student', 'categories'); ?>

</main><!-- #main -->

<?php
get_footer();
