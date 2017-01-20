<?php
setlocale(LC_TIME, "fr_FR");
require_once TEMPLATEPATH . "/inc/dompdf/dompdf_config.inc.php";
ob_start(); 

  // Get Variables
  $auteurs = get_field('auteurs'); 
  $sous_titres = get_field('sous_titres'); 
  $date_fixe = get_field('date_fixe');
  $curiosites_liste = get_field('curiosites_liste');
  $evenements_lies = get_field('evenements_lies');  
  $lieu = get_field('lieu');
  $lieu_adresse_group = get_field('adresse', $lieu);
  $lieu_adresse = $lieu_adresse_group['address'];
  $weekends = get_posts(array(
    'post_type' => 'weekend',
    'meta_query' => array(
      array(
        'key' => 'events_list', 
        'value' => '"' . get_the_ID() . '"', 
        'compare' => 'LIKE'
      )
    )
  ));
?>

<style type="text/css">

  html, table, tr, td { margin: 0; padding: 0; }
  body { 
    margin: 60pt; 
    font-family: Verdana, Geneva, sans-serif;
    font-size: 13px;
    line-height: 10px;
  }
  h1 {
    font-size: 18px;
    font-weight: 900;
    text-transform: uppercase;
    margin-bottom: 0;
    line-height: 5px;
  }
  h2 {
    font-size: 22px;
    font-weight: 900;
    font-size: 16px;
    line-height: 5px;
  }
  h3 {
    font-weight: 900;
    font-size: 14px;
    line-height: 5px;
  }
  h4 {
    font-weight: 900;
    font-size: 14px;
    margin-top: 30pt;
    line-height: 5px;
  }
  img {
    display: block;
    max-width: 100%;
    height: auto;
  }
  p {
    font-size: 13px;
    margin-bottom: 10px;
    line-height: 18px;
  }
  strong {
    font-weight: 900;
  }
  .logo img {
    width: 400px;
    margin-bottom: 50px;
  }

  .bloc {
    margin-bottom: 10px;
  }

  .partners img {
    display: block;
    width: 75px;
    max-height: 40px;
    margin-right: 20px;
    margin-bottom: 30px;
    float: left;
    height: auto;
  }


</style>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <body>

    <div class="logo bloc">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png">
    </div>

    <div class="bloc">
      <h1><?php moisphoto_get_artists_list($auteurs); ?></h1>
      <h2><?php the_title( ); ?></h2>
      <h3><?php 
          if($sous_titres) {
            foreach ($sous_titres as $st) {
              echo $st['sous-titre'];
            }
          }
        ?> </h3>
    </div>
    
    <div class="bloc">
      <h2><?php echo get_the_title( $lieu ); ?></h2>
      <?php echo $lieu_adresse; ?><br><br><br>
    </div>

    <div class="bloc">
    <?php 
      if($date_fixe) {
        the_field('date'); 
      } else {
        the_field('date_debut');
        echo ' - ';
        the_field('date_fin');
      }
    ?><br><br>
    <?php echo get_the_title( $weekends[0]->ID ); ?>

    </div>

    <?php if( get_field('nom_commissaire') != '' ) : ?>
      <div class="bloc">
        <p>Commissariat : <br>
         <?php the_field('nom_commissaire'); ?></p>
      </div>
    <?php endif; ?>

    <div class="bloc">
      <p>Contact presse : <br>
        <?php the_field('nom_contact', $lieu); ?>, <?php the_field('email_contact', $lieu); ?></p>
      </p> 
    </div>

<br>
<br>

    <div class="bloc">
    <?php if( get_field('chapo') != '' ) : ?>
        <p><strong><?php the_field('chapo'); ?></strong></p>
    <?php endif; ?>

    <p>
      <?php $page_data = get_page( get_the_ID() );
        if ($page_data) {
          echo strip_shortcodes($page_data->post_content);
      } ?>
    </p></div>


<br>
<br>

    <div class="bloc partners">
      <?php the_field('mentions'); ?>
    </div>
  
  </body>
</html>

<?php
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper('a4', 'portrait');
$dompdf->render();
$dompdf->stream("sample.pdf", array("Attachment" => 0));
?>