<?php 



if (!function_exists('zipThoseFiles')) {
  ob_start();

  function zipThoseFiles($id){
  
    if (!function_exists('zipFilesDownload')) {
  
      function zipFilesDownload($file_names, $archive_file_name, $file_path, $captions_file){
  

          $files = $file_names;
          $zipname = $archive_file_name;

          $zip = new ZipArchive;
          $zip->open($zipname, ZipArchive::CREATE);
          $zip->addFile($captions_file, 'legendes.txt');

          foreach ($files as $file) {
            $new_filename = substr( $file, strrpos( $file,'/' ) + 1 );
            $zip->addFile($file, $new_filename);
          }

          $zip->close();

          header('Content-Type: application/zip');
          header('Content-disposition: attachment; filename='.basename($zipname) );
          header('Content-Length: ' . filesize($zipname));
          header('Content-Transfer-Encoding: binary');

          ob_clean();
          flush();

          readfile($zipname);
          unlink(realpath($zipname));
          unlink($captions_file);

        exit; 

      }
    }

    $fileNames = array(); // create files array

    $post_data = get_post($id, ARRAY_A);
    $slug = $post_data['post_name'];
    $zip_file_name = 'photos-'. $slug .'.zip';
    $file_path = dirname(__FILE__).'/files/';

    $args = array(
      'post_type'     => 'attachment',
      'posts_per_page'  => -1,
      'post_parent'     => $id,
      'orderby'     => 'title',
      'order'       => 'ASC',
    );

    $attachments = get_posts($args);

    $captions_file = $file_path . 'legendes' . $slug . '.txt';
    $caption = fopen($captions_file, 'a') or die('Cannot open file:  '.$captions_file);
    $data = 'Légendes des visuels de l\'exposition "' . get_the_title($id) . '".'."\n"."\n";
    fwrite($caption, $data);

    if ($attachments) {
      foreach ($attachments as $attachment) {
        $fileNames[] = get_attached_file( $attachment->ID );
        $new_filename = substr( get_attached_file( $attachment->ID ), strrpos( get_attached_file( $attachment->ID ),'/' ) + 1 );
        $file_caption = $new_filename . ' : ' . get_field('legende', $attachment->ID );

        $tags = array('<p>','</p>','<em>','</em>','<br />','<div class="clearfix event__thumbnail">','</div>');
        $file_caption_clean = str_replace($tags, "", $file_caption);

        fwrite($caption, $file_caption_clean);
      }
    }


    if( !empty($fileNames) ) {
      zipFilesDownload( $fileNames, $zip_file_name, $file_path, $captions_file );
    } 
    else {
      die('<div class="wrap"><br><br><p>Aucun visuels n\'est associé à cet événement</p></div>');
    }
  }
}




