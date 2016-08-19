<?php

function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyBs3x5sifohlp4Zqy3GxSv-oOF0_z2mx9s');
}

add_action('acf/init', 'my_acf_init');