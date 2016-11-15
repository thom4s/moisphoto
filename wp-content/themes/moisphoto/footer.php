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

        <div class="footer__main__logo s-6col m-4col"><a href="http://mep-fr.org" target="_blank" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mep.png"> </a></div>

        <div class="footer__main__infos s-12col m-4col">
          <p>
            Le Mois de la Photo du Grand Paris est un événement organisé par la Maison Européenne de la Photographie.
          </p>
          <p>
            <strong>Maison Européenne <br>de la Photographie</strong><br>
            5/7 rue de Fourcy<br>
            75004 Paris
          </p>
        </div>


        <div class="footer__main__newsletter s-12col m-7col m-1col-push">
          <div class="row">
            <div class="s-2col m-1col square"> 
              <div class="square__content">
                <div class="table">
                  <div class="table-cell">
                    <span class="arrow--little--black"> > </span>
                  </div>
                </div>           
              </div>
            </div>

            <form action="http://maisoneuropennedelaphoto.createsend.com/t/t/s/mhudii/" method="post" id="subForm" class="s-10col m-6col">
              <input id="fieldEmail" name="cm-mhudii-mhudii" type="email" required placeholder="votre email" />
              <input type="submit" value="M'inscrire à la newsletter">
            </form>

          </div>
        </div>


        <div class="footer__main__menu s-10col m-4col s-last">
          <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
        </div>

      </div>
		</div><!-- .site-info -->

    <div>
    </div>
	</footer><!-- #colophon -->



  <div id="events-modal">
    <div class="modal__content clearfix">

        <div class="wrap">
          <div class="site-branding--big row clearfix">
            <div class="site-logo s-17col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"></a></div>
          </div><!-- .site-branding -->
        </div>
        
        <div class="clearfix modal__close--events">
          <div class="wrap row">
            <div class="s-first s-12col">
              <span class="arrow--little--white arrow--down"> > </span>
              <span class="h4"> Liste des expositions</span>
            </div>

            <div class="s-last s-6col">
              <a href="#" id="close-events" class="clearfix"> Fermer la liste <span class="icon-close"></span> </a>
            </div>
          </div>
        </div>
        
        <div class="modal__content__inner"></div>    
    </div>
  </div>



</div><!-- #page -->

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36956482-5', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
