<?php
setlocale(LC_TIME, "fr_FR");
require_once( dirname(__FILE__) . "/dompdf/dompdf_config.inc.php");
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

  ?>

<style type="text/css">

  html, table, tr, td { margin: 0; padding: 0; }
  body { 
    margin: 40pt; 
    font-family: Verdana,Geneva,sans-serif;
    font-size: 14px;
  }
  h1 {
    font-size: 22px;
    font-weight: 100;
    text-transform: uppercase;
    margin-bottom: 0;
  }
  h2 {
    font-weight: 100;
    font-size: 18px;
  }


</style>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <body>

    <!-- PAGE FRANÇAISE -->

    <h1><?php moisphoto_get_artists_list($auteurs); ?></h1>
    <h2><?php the_title( ); ?></h2>
    <h3><?php 
        if($sous_titres) {
          foreach ($sous_titres as $st) {
            echo $st['sous-titre'];
          }
        }
      ?> </h3>

    <p><?php echo get_the_title( $lieu ); ?> <br>
     <?php echo $lieu_adresse; ?></p>
    <p><?php 
      if($date_fixe) {
        the_field('date'); 
      } else {
        the_field('date_debut');
        echo ' - ';
        the_field('date_fin');
      }
    ?> </p> 

    <p>--</p>


    <h3 class="h3">L'exposition</h3>

    <p><?php the_field('nom_commissaire'); ?></p>

    <?php if( get_field('chapo') != '' ) : ?>
      <div class="p--big event__extract">
        <?php the_field('chapo'); ?>
      </div>
    <?php endif; ?>

    <div>
      <?php the_content(); ?>
    </div>

    <p>--</p>


    <h3 class="h3">Où ça se passe ?</h3>

            <h5>
              <?php echo get_the_title( $lieu ); ?><br>
              <?php $type_lieu = get_field('type_de_lieu', $lieu); moisphoto_get_artists_list($type_lieu); ?>
            </h5>

            <p><?php echo $lieu_adresse; ?></p>
            
            <p><?php the_field('complement_adresse', $lieu); ?></p>


      <h4>Informations pratiques</h4>
        <?php 
        if( get_field('transport', $lieu) ) {
          the_field('transport', $lieu);
        }

        if( get_field('horaires', $lieu) !='' ) {
          the_field('horaires', $lieu);
          echo '<br>';
        }

        if(get_field('accès', $lieu)) {
          the_field('accès', $lieu);
        }             

        if(get_field('telephone', $lieu)) {
          the_field('telephone', $lieu);
          echo '<br>';
        }

        if(get_field('email', $lieu)) {
          the_field('email', $lieu);
          echo '<br>';
        }

        if( get_field('website', $lieu)) { ?>
          <a href="<?php the_field('website', $lieu); ?>">Site internet</a>
        <?php } 


        if(get_field('date_vernissage', $lieu)) {
          echo 'Date du vernissage : ';
          the_field('date_vernissage', $lieu);
          echo '<br>';
        } ?>



    <div style="page-break-before: always;"></div>


 
  </body>
</html>

<?php
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper('a4', 'portrait');
$dompdf->render();
$dompdf->stream("sample.pdf", array("Attachment" => 0));
?>