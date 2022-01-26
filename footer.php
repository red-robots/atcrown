        <div class="clearfix"></div>
      </div>

      <footer class="page__footer  page-footer" role="contentinfo">
        <div class="page-footer__inner">
          <div class="page-footer__contact-form contact-form">
            <header class="contact-form__header">
              <h2 class="contact-form__title">Your inbox deserves better</h2>
              <h3 class="contact-form__blurb">Do yourself a favor. Sign up to receive our newsletter.</h3>
            </header>
            <div class="contact-form__form">
              <?= atc10k_get_element('/email-capture') ?>
            </div>
          </div>
          <?php wp_nav_menu([
            'walker' => new Walker_Nav(),
            'theme_location' => 'main-menu',
            'container' => 'nav',
            'container_class' => 'page-footer__nav nav',
            'menu_class' => 'nav__list nav__list--root',
          ]); ?>
          <div class="page-footer__copyright">
            <?= sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'blankslate' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
          </div>
          <div class="page-footer__social-links  social-links">
            <?= atc10k_social_media_nav() ?>
          </div>
        </div>
      </footer>
    </div>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
      attribution=install_email
      page_id="2047798548840809"
      theme_color="#df3a3e"
      logged_in_greeting="Howdy! Anything we can help with today?"
      logged_out_greeting="Howdy! Anything we can help with today?">
    </div>
    <?php wp_footer(); ?>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '207246270413839');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=207246270413839&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <!-- flywheel -->
  </body>
</html>