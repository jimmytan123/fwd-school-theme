<?php

/**
 * Template part for displaying the links to the other student with the same taxonomy term in the single student post
 */
$terms = get_terms(
    array(
        'taxonomy' => 'fwd-student-category',
    )
);
//make sure it is not empty and no errors
?><section>
    <?php if ($terms && !is_wp_error($terms)) : ?>
        <!-- the following code is modifed from https://wordpress.stackexchange.com/questions/220511/correct-use-of-get-the-terms -->
        <!-- retrieve the terms of the taxonomy that are attached to the post -->
        <?php foreach (get_the_terms(get_the_ID(), 'fwd-student-category') as $studentCat) :
            //store the current post id into an variable called $currentID
            $currentID = get_the_ID();

            $args = array(
                'post_type' => 'fwd-student',
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'fwd-student-category',
                        'field' => 'slug',
                        'terms' => $studentCat->slug, //terms is the slug of the current single student's category slug
                    ),
                ),
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) : ?>
                <h3>Meet Other <?php echo $studentCat->name; ?> Students:</h3>
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    //output the other student under the same taxonomy term (current post student not be included)
                    if (get_the_ID() !== $currentID) : ?>
                        <section>
                            <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                        </section>
    <?php
                    endif;
                endwhile;
            endif;
        endforeach;
    endif;
    ?>



</section>