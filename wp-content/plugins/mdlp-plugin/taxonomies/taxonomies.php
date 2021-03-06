<?php


// Register Thème Taxonomy
//////////////////////////

function theme_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Thématiques', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Thématique', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Thématique', 'mdlp_db' ),
    'all_items'                  => __( 'Toutes les Thématique', 'mdlp_db' ),
    'parent_item'                => __( 'Thématique parente', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Thématique parente :', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouvelle Thématique', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter une Thématique', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer Thématique', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour la Thématique', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Séparer les Thématiques avec une virgule', 'mdlp_db' ),
    'search_items'               => __( 'Cherche la Thématique', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Ajouter ou retirer une Thématique', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
  );
  register_taxonomy( 'theme', 'event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'theme_taxonomy', 0 );





// Register Type de curiosité Taxonomy
//////////////////////////

function curiosite_cat_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Type de curiosité', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Type de curiosité', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Type de curiosité', 'mdlp_db' ),
    'all_items'                  => __( 'Toutes les types', 'mdlp_db' ),
    'parent_item'                => __( 'Type de curiosité parente', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Type de curiosité parente :', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouveau Type de curiosité', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter un Type de curiosité', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer Type de curiosité', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Séparer les types avec une virgule', 'mdlp_db' ),
    'search_items'               => __( 'Cherche la types', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Ajouter ou retirer une types', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
  );
  register_taxonomy( 'curiosite-cat', 'curiosite', $args );

}

// Hook into the 'init' action
add_action( 'init', 'curiosite_cat_taxonomy', 0 );



// Register Event Type Taxonomy
///////////////////////////////

function event_type_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Types événement', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Type événement', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Type d\'événement', 'mdlp_db' ),
    'all_items'                  => __( 'Tous les types', 'mdlp_db' ),
    'parent_item'                => __( 'Type parent', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Type parent : ', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouveau type', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter un type', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer un type', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour le type', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Séparer les types avec une virgule', 'mdlp_db' ),
    'search_items'               => __( 'Chercher types', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Ajouter ou retirer un type', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'event-type', 'event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'event_type_taxonomy', 0 );






// Register Semainiers Taxonomy
///////////////////////////////

function semaine_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Semaines', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Semaine', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Semainiers', 'mdlp_db' ),
    'all_items'                  => __( 'Toutes les semaines', 'mdlp_db' ),
    'parent_item'                => __( 'Semaine parente', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Semaine parente : ', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouvelle semaine', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter une semaine', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer une semaine', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour la semaine', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'mdlp_db' ),
    'search_items'               => __( 'Search Items', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'semainiers', 'event', $args );

}

// Hook into the 'init' action
//add_action( 'init', 'semaine_taxonomy', 0 );



// Register Auteur Taxonomy
////////////////////////////////

function auteur_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Auteurs', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Auteur', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Auteurs', 'mdlp_db' ),
    'all_items'                  => __( 'Tous les Auteurs', 'mdlp_db' ),
    'parent_item'                => __( 'Parent Item', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Parent Item:', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouvel Auteur', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter un Auteur', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer un Auteur', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour Auteur', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'mdlp_db' ),
    'search_items'               => __( 'Search Items', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'auteur', 'event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'auteur_taxonomy', 0 );







// Register Place Type Taxonomy
///////////////////////////////

function place_type_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Types de lieu', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Type de lieu', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Type de lieu', 'mdlp_db' ),
    'all_items'                  => __( 'Tous les types de lieu', 'mdlp_db' ),
    'parent_item'                => __( 'Parent Item', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Parent Item:', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouveau type de lieu', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter un type de lieu', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'mdlp_db' ),
    'search_items'               => __( 'Search Items', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'place-type', 'place', $args );

}

// Hook into the 'init' action
add_action( 'init', 'place_type_taxonomy', 0 );





// Register Place Arrondissement Taxonomy
///////////////////////////////

function place_arrondissement_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Arrondissements', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Arrondissement', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Arrondissements', 'mdlp_db' ),
    'all_items'                  => __( 'Tous les Arrondissements', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouveau ', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter ', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer ', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour ', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Séparer avec une virgule', 'mdlp_db' ),
    'search_items'               => __( 'Chercher ', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Ajouter ou retirer ', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'place-arr', array('place', 'event'), $args );

}

// Hook into the 'init' action
//add_action( 'init', 'place_arrondissement_taxonomy', 0 );



// Register Authors Type Taxonomy
///////////////////////////////

function text_type_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Taille texte', 'Taxonomy General Name', 'mdlp_db' ),
    'singular_name'              => _x( 'Texte...', 'Taxonomy Singular Name', 'mdlp_db' ),
    'menu_name'                  => __( 'Textes...', 'mdlp_db' ),
    'all_items'                  => __( 'Tous les textes', 'mdlp_db' ),
    'parent_item'                => __( 'Parent Item', 'mdlp_db' ),
    'parent_item_colon'          => __( 'Parent Item:', 'mdlp_db' ),
    'new_item_name'              => __( 'Nouveau', 'mdlp_db' ),
    'add_new_item'               => __( 'Ajouter', 'mdlp_db' ),
    'edit_item'                  => __( 'Editer', 'mdlp_db' ),
    'update_item'                => __( 'Mettre à jour', 'mdlp_db' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'mdlp_db' ),
    'search_items'               => __( 'Search Items', 'mdlp_db' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'mdlp_db' ),
    'choose_from_most_used'      => __( 'Choose from the most used items', 'mdlp_db' ),
    'not_found'                  => __( 'Not Found', 'mdlp_db' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'textsize', 'page', $args );

}

// Hook into the 'init' action
//add_action( 'init', 'text_type_taxonomy', 0 );





