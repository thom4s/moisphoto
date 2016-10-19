<?php
setlocale(LC_TIME, "fr_FR");
require_once( dirname(__FILE__) . "/vendors/dompdf/dompdf_config.inc.php");
ob_start(); ?>

<style type="text/css">

  html, table, tr, td { margin: 0; padding: 0; }
  body { margin: 20pt; }

</style>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <body>

    <!-- PAGE FRANÇAISE -->
    <table width="100%" border="0" cellpadding="10">
      <tr id="">
        <td width="30%" valign="top">
          
        </td>
        <td width="70%" valign="top" class="color-1">
          <h1><?php the_title( ); ?></h1>
        </td>
      </tr>
    </table>

    <table width="100%" border="0" cellpadding="10">  
      <tr style="margin-bottom: 40px;">
        <td width="30%" valign="top" class="place">
          
        </td>
        <td width="70%" valign="top" class="content">

        </td>
      </tr>
    </table>
    <div style="page-break-before: always;"></div>


    <!-- PAGE ANGLAISE -->
    <table width="100%" border="0" cellpadding="10">
      <tr id="">
        <td width="30%" valign="top"></td>
        <td width="70%" valign="top" class="">

        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellpadding="10">
      <tr style="margin-bottom: 40px;">
        <td width="30%" valign="top" class="place">
  
        </td>
        <td width="70%" valign="top" class="content">

        </td>
      </tr>
    </table>
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