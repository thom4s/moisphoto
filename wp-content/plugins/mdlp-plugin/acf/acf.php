<?php


function my_acf_google_map_api( $api ){
  
  $api['key'] = 'AIzaSyBs3x5sifohlp4Zqy3GxSv-oOF0_z2mx9s';
  
  return $api;
  
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
