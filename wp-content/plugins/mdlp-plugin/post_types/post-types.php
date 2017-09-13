<?php

// Register Place Post Type
function place_post_type() {

  $labels = array(
    'name'                => _x( 'Lieux', 'Post Type General Name', 'mdlp_db' ),
    'singular_name'       => _x( 'Lieu', 'Post Type Singular Name', 'mdlp_db' ),
    'menu_name'           => __( 'Lieux', 'mdlp_db' ),
    'parent_item_colon'   => __( 'Lieu parent : ', 'mdlp_db' ),
    'all_items'           => __( 'Tous les lieux', 'mdlp_db' ),
    'view_item'           => __( 'Voir lieu', 'mdlp_db' ),
    'add_new_item'        => __( 'Ajouter nouveau lieu', 'mdlp_db' ),
    'add_new'             => __( 'Ajouter un lieu', 'mdlp_db' ),
    'edit_item'           => __( 'Editer', 'mdlp_db' ),
    'update_item'         => __( 'Mettre à jour', 'mdlp_db' ),
    'search_items'        => __( 'Chercher', 'mdlp_db' ),
    'not_found'           => __( 'Not found', 'mdlp_db' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'mdlp_db' ),
  );
  $args = array(
    'label'               => __( 'place', 'mdlp_db' ),
    'description'         => __( 'Lieux des événements', 'mdlp_db' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'author', 'thumbnail', 'revisions', ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'place', $args );

}

// Hook into the 'init' action
add_action( 'init', 'place_post_type', 0 );



// Register Place Post Type
function weekend_post_type() {

  $labels = array(
    'name'                => _x( 'Weekends', 'Post Type General Name', 'mdlp_db' ),
    'singular_name'       => _x( 'Weekend', 'Post Type Singular Name', 'mdlp_db' ),
    'menu_name'           => __( 'Weekends', 'mdlp_db' ),
    'parent_item_colon'   => __( 'weekend parent : ', 'mdlp_db' ),
    'all_items'           => __( 'Tous les weekends', 'mdlp_db' ),
    'view_item'           => __( 'Voir weekend', 'mdlp_db' ),
    'add_new_item'        => __( 'Ajouter nouveau weekend', 'mdlp_db' ),
    'add_new'             => __( 'Ajouter un weekend', 'mdlp_db' ),
    'edit_item'           => __( 'Editer', 'mdlp_db' ),
    'update_item'         => __( 'Mettre à jour', 'mdlp_db' ),
    'search_items'        => __( 'Chercher', 'mdlp_db' ),
    'not_found'           => __( 'Not found', 'mdlp_db' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'mdlp_db' ),
  );
  $args = array(
    'label'               => __( 'weekend', 'mdlp_db' ),
    'description'         => __( 'weekend', 'mdlp_db' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'revisions', 'editor', 'thumbnail',  ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 8,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'weekend', $args );

}

// Hook into the 'init' action
add_action( 'init', 'weekend_post_type', 0 );



// Register Place Post Type
function edition_post_type() {

  $labels = array(
    'name'                => _x( 'Editions', 'Post Type General Name', 'mdlp_db' ),
    'singular_name'       => _x( 'Edition', 'Post Type Singular Name', 'mdlp_db' ),
    'menu_name'           => __( 'Editions', 'mdlp_db' ),
    'parent_item_colon'   => __( 'Edition parente : ', 'mdlp_db' ),
    'all_items'           => __( 'Tous les Editions', 'mdlp_db' ),
    'view_item'           => __( 'Voir Edition', 'mdlp_db' ),
    'add_new_item'        => __( 'Ajouter nouvelle Edition', 'mdlp_db' ),
    'add_new'             => __( 'Ajouter une édition', 'mdlp_db' ),
    'edit_item'           => __( 'Editer', 'mdlp_db' ),
    'update_item'         => __( 'Mettre à jour', 'mdlp_db' ),
    'search_items'        => __( 'Chercher', 'mdlp_db' ),
    'not_found'           => __( 'Not found', 'mdlp_db' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'mdlp_db' ),
  );
  $args = array(
    'label'               => __( 'edition', 'mdlp_db' ),
    'description'         => __( 'Editions', 'mdlp_db' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'revisions', 'editor' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 7,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'edition', $args );

}

// Hook into the 'init' action
add_action( 'init', 'edition_post_type', 0 );



// Register Curiosité Post Type
function curiosite_post_type() {

  $labels = array(
    'name'                => _x( 'Curiosités', 'Post Type General Name', 'mdlp_db' ),
    'singular_name'       => _x( 'Curiosité', 'Post Type Singular Name', 'mdlp_db' ),
    'menu_name'           => __( 'Curiosités', 'mdlp_db' ),
    'parent_item_colon'   => __( 'Curiosité parente : ', 'mdlp_db' ),
    'all_items'           => __( 'Toutes les Curiosités', 'mdlp_db' ),
    'view_item'           => __( 'Voir Curiosité', 'mdlp_db' ),
    'add_new_item'        => __( 'Ajouter nouvelle curiosité', 'mdlp_db' ),
    'add_new'             => __( 'Ajouter une curiosité', 'mdlp_db' ),
    'edit_item'           => __( 'Editer', 'mdlp_db' ),
    'update_item'         => __( 'Mettre à jour', 'mdlp_db' ),
    'search_items'        => __( 'Chercher', 'mdlp_db' ),
    'not_found'           => __( 'Not found', 'mdlp_db' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'mdlp_db' ),
  );
  $args = array(
    'label'               => __( 'curiosite', 'mdlp_db' ),
    'description'         => __( 'Lieux des Curiosités', 'mdlp_db' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'thumbnail', 'revisions', ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 10,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'curiosite', $args );

}

// Hook into the 'init' action
add_action( 'init', 'curiosite_post_type', 0 );




// Register Event Post Type
function event_post_type() {

    $labels = array(
        'name'                => _x( 'Evénements', 'Post Type General Name', 'mdlp_db' ),
        'singular_name'       => _x( 'Evénement', 'Post Type Singular Name', 'mdlp_db' ),
        'menu_name'           => __( 'Evénéments', 'mdlp_db' ),
        'parent_item_colon'   => __( 'Evénement parent', 'mdlp_db' ),
        'all_items'           => __( 'Tous les événements', 'mdlp_db' ),
        'view_item'           => __( 'Voir événement', 'mdlp_db' ),
        'add_new_item'        => __( 'Ajouter nouvel événement', 'mdlp_db' ),
        'add_new'             => __( 'Ajouter un événement', 'mdlp_db' ),
        'edit_item'           => __( 'Editer', 'mdlp_db' ),
        'update_item'         => __( 'Mettre à jour', 'mdlp_db' ),
        'search_items'        => __( 'Chercher', 'mdlp_db' ),
        'not_found'           => __( 'Not found', 'mdlp_db' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'mdlp_db' ),
    );
    $args = array(
        'label'               => __( 'event', 'mdlp_db' ),
        'description'         => __( 'Evénements', 'mdlp_db' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', ),
        'taxonomies'          => array( '' ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'event_post_type', 0 );

?>
