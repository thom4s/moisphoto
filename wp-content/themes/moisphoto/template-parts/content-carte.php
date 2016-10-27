<?php
/**
 * Template part for displaying page content in page-carte.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */


    $front_page_id = get_option('page_on_front');
    $current_edition = get_field('edition_courante', $front_page_id); 

    $type_relation = get_field('type_relation', $current_edition);      
    $events = array();
    $places = array();

    if( $type_relation == 'Weekends') : 
      $weekends = get_field('weekends',  $current_edition); // ID

      foreach ($weekends as $we) {
        $events_list = get_field('events_list', $we);
        $color_we = get_field('color', $we);
        $color_we = str_replace('#', '', $color_we); 
          
        foreach ($events_list as $e) {
          $events[] = $e;
          $places_events_array[$e] = array( get_field('lieu', $e), $color_we );
        }            
      }
      $is_weekend = true; 

    elseif ( $type_relation == 'Événements' ) :
      $events = get_field('evenements', $current_edition);

      foreach ($events as $e) {
        $places_events_array[$e] = array( get_field('lieu', $e), 'default' );
      }    
      $is_weekend = false; 

    endif; 
    $is_weekend = false; 

    set_query_var('events', $events); 
    set_query_var('places_events_array', $places_events_array); 
    set_query_var('is_weekend', $is_weekend); 

    get_template_part( 'template-parts/modules/module', 'map' ); 

    // END MAP ?>