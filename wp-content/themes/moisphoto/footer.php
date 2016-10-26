<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package moisphoto
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="footer__main clearfix">
      <div class="footer__main__inner row wrap clearfix">

        <div class="footer__main__logo l-4col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mep.png"> </a></div>

        <div class="footer__main__infos l-4col">
          <p>
            Le Mois de la Photo du Grand Paris est un événement organisé par la Maison Européenne de la Photographie.
          </p>
          <p>
            <strong>Maison Européenne <br>de la Photographie</strong><br>
            5/7 rue de Fourcy<br>
            75004 Paris
          </p>
        </div>


        <div class="footer__main__newsletter l-7col l-1col-push">
          <div class="row">
            <div class="pict--rounded--little l-1col">-></div>
            <div class="input-group l-6col">
              <input type="email" placeholder="votre mail">
              <input type="submit" value="M'inscrire à la newsletter">
            </div>
          </div>
        </div>


        <div class="footer__main__menu l-4col l-last">
          <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
        </div>

      </div>
		</div><!-- .site-info -->

    <div>
    </div>
	</footer><!-- #colophon -->



  <div id="events-modal">
    <div class="modal__content clearfix">
        <a href="#" id="close-events" class="clearfix close-events"></a>
        <div class="modal__content__inner"></div>    
    </div>
  </div>



</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
