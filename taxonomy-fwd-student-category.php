<?php

/**
 * The template for displaying Student posts in custom taxonomy term(designer & developer)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
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
        /* Start the Loop */
        while (have_posts()) :
            the_post();
        ?>
            <article>
                <a href="<?php the_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                </a>
                <?php the_post_thumbnail('portrait-student-taxonomy'); ?>
                <?php the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'fwdshool'),
                        'after'  => '</div>',
                    )
                ); ?>

            </article>
    <?php
        endwhile;

        the_posts_navigation();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #primary -->

<?php
get_footer();
