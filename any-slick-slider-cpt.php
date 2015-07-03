<?php defined('ABSPATH') or die(); 

add_theme_support('post-thumbnails', array('slick-image'));


// Register Custom Post Type

function any_slick_custom_posts() {

	$labels = array(
		'name'                => _x( 'Slick Images', 'Post Type General Name', 'slick-slider' ),
		'singular_name'       => _x( 'Slick Image', 'Post Type Singular Name', 'slick-slider' ),
		'menu_name'           => __( 'Slick Images', 'slick-slider' ),
		'parent_item_colon'   => __( 'Parent Slide:', 'slick-slider' ),
		'all_items'           => __( 'All Slides', 'slick-slider' ),
		'view_item'           => __( 'View Slide', 'slick-slider' ),
		'add_new_item'        => __( 'Add New Slide', 'slick-slider' ),
		'add_new'             => __( 'Add New', 'slick-slider' ),
		'edit_item'           => __( 'Edit Slide', 'slick-slider' ),
		'update_item'         => __( 'Update Slide', 'slick-slider' ),
		'search_items'        => __( 'Search Slide', 'slick-slider' ),
		'not_found'           => __( 'Not found', 'slick-slider' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'slick-slider' ),
	);
	$args = array(
		'label'               => __( 'slick-image', 'slick-slider' ),
		'description'         => __( 'Here are the Slicky Slides', 'slick-slider' ),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'			  => 'dashicons-slides',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'slick-image', $args );

}


add_action( 'init', 'any_slick_custom_posts');