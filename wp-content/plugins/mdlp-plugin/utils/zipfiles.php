<?php 



if (!function_exists('zipThoseFiles')) {
  ob_start();

  function zipThoseFiles($id){
  
    if (!function_exists('zipFilesDownload')) {
  
      function zipFilesDownload($file_names, $archive_file_name, $file_path){
  

          $files = $file_names;
          $zipname = $archive_file_name;

          $zip = new ZipArchive;
          $zip->open($zipname, ZipArchive::CREATE);

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
        
        exit; 

      }
    }

    $fileNames = array(); // create files array

    $args = array(
      'post_type'     => 'attachment',
      'posts_per_page'  => -1,
      'post_parent'     => $id,
      'orderby'     => 'title',
      'order'       => 'ASC',
    );

    $attachments = get_posts($args);

    if ($attachments) {
      foreach ($attachments as $attachment) {
          $fileNames[] = get_attached_file( $attachment->ID );
      }
    }

    $post_data = get_post($id, ARRAY_A);
    $slug = $post_data['post_name'];
    $zip_file_name = 'photos-'. $slug .'.zip';
    $file_path = dirname(__FILE__).'/files/';
  

    if( !empty($fileNames) ) {
      zipFilesDownload( $fileNames, $zip_file_name, $file_path );
    } 
    else {
      die('erreur');
    }
  }
}
