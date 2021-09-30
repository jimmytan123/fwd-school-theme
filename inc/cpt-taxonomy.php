<?php

//For Custom Post Types
function fwd_register_custom_post_types()
{
    // Add Staff CPT
    $labels = array(
        'name'               => _x('Staffs', 'post type general name'),
        'singular_name'      => _x('Staff', 'post type singular name'),
        'menu_name'          => _x('Staffs', 'admin menu'),
        'name_admin_bar'     => _x('Staff', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Staff'),
        'add_new_item'       => __('Add New Staff'),
        'new_item'           => __('New Staff'),
        'edit_item'          => __('Edit Staff'),
        'view_item'          => __('View Staff'),
        'all_items'          => __('All Staffs'),
        'search_items'       => __('Search Staffs'),
        'parent_item_colon'  => __('Parent Staffs:'),
        'not_found'          => __('No staffs found.'),
        'not_found_in_trash' => __('No staffs found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'staffs'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title'), //only support title, not even editior since we will use ACF for the content
    );

    register_post_type('fwd-staff', $args);

    // Add Student CPT
    $labels = array(
        'name'                  => _x('Students', 'post type general name'),
        'singular_name'         => _x('Student', 'post type singular name'),
        'menu_name'             => _x('Students', 'admin menu'),
        'name_admin_bar'        => _x('Student', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'student'),
        'add_new_item'          => __('Add New Student'),
        'new_item'              => __('New Student'),
        'edit_item'             => __('Edit Student'),
        'view_item'             => __('View Student'),
        'all_items'             => __('All Students'),
        'search_items'          => __('Search Students'),
        'parent_item_colon'     => __('Parent Students:'),
        'not_found'             => __('No students found.'),
        'not_found_in_trash'    => __('No students found in Trash.'),
        'archives'              => __('Student Archives'),
        'insert_into_item'      => __('Insert into student'),
        'uploaded_to_this_item' => __('Uploaded to this student'),
        'filter_item_list'      => __('Filter students list'),
        'items_list_navigation' => __('Students list navigation'),
        'items_list'            => __('Students list'),
        'featured_image'        => __('Student featured image'),
        'set_featured_image'    => __('Set student featured image'),
        'remove_featured_image' => __('Remove student featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'students'), //URL Slug, creates the URL for typing in the browser.
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title', 'thumbnail', 'editor'), //support a title, thumbnail and the block editor
        'template'           => array(array('core/paragraph'), array('core/button')), //setting the customize block editor template
        'template_lock'      => 'all',
    );

    //fwd-work which is the Post Type Key, the unique id if we want to target
    register_post_type('fwd-student', $args);
}

//action hooks, hooks cpt into init
add_action('init', 'fwd_register_custom_post_types');


//For Registar Taxonomy
function fwd_register_taxonomies()
{
    // Add Staff Category taxonomy for CPT Staff
    $labels = array(
        'name'              => _x('Staff Categories', 'taxonomy general name'),
        'singular_name'     => _x('Staff Category', 'taxonomy singular name'),
        'search_items'      => __('Search Staff Categories'),
        'all_items'         => __('All Staff Category'),
        'parent_item'       => __('Parent Staff Category'),
        'parent_item_colon' => __('Parent Staff Category:'),
        'edit_item'         => __('Edit Staff Category'),
        'view_item'         => __('View Staff Category'),
        'update_item'       => __('Update Staff Category'),
        'add_new_item'      => __('Add New Staff Category'),
        'new_item_name'     => __('New Staff Category Name'),
        'menu_name'         => __('Staff Category'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'staff-categories'),
    );

    register_taxonomy('fwd-staff-category', array('fwd-staff'), $args);

    // Add Student Category custom taxonomy for CPT Student
    $labels = array(
        'name'              => _x('Student Categories', 'taxonomy general name'),
        'singular_name'     => _x('Student Category', 'taxonomy singular name'),
        'search_items'      => __('Search Student Categories'),
        'all_items'         => __('All Student Category'),
        'parent_item'       => __('Parent Student Category'),
        'parent_item_colon' => __('Parent Student Category:'),
        'edit_item'         => __('Edit Student Category'),
        'view_item'         => __('View Student Category'),
        'update_item'       => __('Update Student Category'),
        'add_new_item'      => __('Add New Student Category'),
        'new_item_name'     => __('New Student Category Name'),
        'menu_name'         => __('Student Category'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'student-categories'),
    );
    register_taxonomy('fwd-student-category', array('fwd-student'), $args); // the second params is the CPT we want to use
}
//action hooks
add_action('init', 'fwd_register_taxonomies');
