<?php
/**
 * Pie de página: cuatro columnas sobre verde noche, con el lockup de marca a
 * la izquierda y una barra legal fina abajo.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$fg_phone_href_wa       = fg_opt('phone_href');
$fg_wa_href             = str_replace('+', '', $fg_phone_href_wa);
$fg_phone               = fg_opt('phone');
$fg_phone_sanpedro      = fg_opt('phone_sanpedro');
$fg_phone_sanpedro_href = fg_opt('phone_sanpedro_href');
$fg_phone_ronda         = fg_opt('phone_ronda');
$fg_phone_ronda_href    = fg_opt('phone_ronda_href');
$fg_email               = fg_opt('email');
$fg_address             = fg_opt('address');
$fg_address2            = fg_opt('address2');
$fg_instagram           = fg_opt('instagram');
$fg_facebook            = fg_opt('facebook');

// Enlace universal de Google Maps: en móvil abre la app de mapas del dispositivo
// (Google Maps / Apple Maps según el navegador la resuelva), en escritorio abre Google Maps web.
$fg_maps_sanpedro = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($fg_address);
$fg_maps_ronda    = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($fg_address2);
?>
</main>

<footer class="site-footer has-wm" id="contacto-footer">
  <?php
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
    'size' => 'clamp(15rem, 28vw, 32rem)', 'opacity' => '.07', 'color' => 'var(--crema)',
    'float' => 46, 'rot' => 5,
  ]);
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(9rem, 16vw, 17rem)', 'opacity' => '.05', 'color' => 'var(--crema)',
    'flip' => true, 'float' => 18, 'rot' => -6,
  ]); ?>

  <div class="wrap">
    <div class="footer-grid">

      <div class="footer-brand">
        <img class="footer-mark" src="<?php echo esc_url(fg_asset('logo-fg.svg')); ?>"
             alt="<?php echo esc_attr(fg_opt('brand')); ?>"
             width="88" height="82" loading="lazy" decoding="async">
        <p class="footer-tagline">
          <?php esc_html_e('Jardinería y paisajismo de lujo en la Costa del Sol. Diseño, mantenimiento y vivero propio en Ronda.', 'fg-theme'); ?>
        </p>
        <?php if ($fg_instagram || $fg_facebook) : ?>
          <div class="footer-social">
            <?php if ($fg_instagram) : ?><a class="footer-social__link" href="<?php echo esc_url($fg_instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram"><?php echo fg_icon('instagram'); ?></a><?php endif; ?>
            <?php if ($fg_facebook) : ?><a class="footer-social__link" href="<?php echo esc_url($fg_facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook"><?php echo fg_icon('facebook'); ?></a><?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="footer-col">
        <h3 class="footer-heading"><?php esc_html_e('Servicios', 'fg-theme'); ?></h3>
        <ul>
          <li><a href="<?php echo esc_url(fg_page_url('diseno')); ?>"><?php esc_html_e('Diseño y paisajismo', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('mantenimiento')); ?>"><?php esc_html_e('Mantenimiento', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('vivero')); ?>"><?php esc_html_e('Vivero y plantación propia', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('especies')); ?>"><?php esc_html_e('Descubrir especies', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('servicios')); ?>"><?php esc_html_e('Todos los servicios', 'fg-theme'); ?></a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3 class="footer-heading"><?php esc_html_e('Estudio', 'fg-theme'); ?></h3>
        <ul>
          <li><a href="<?php echo esc_url(fg_page_url('proyectos')); ?>"><?php esc_html_e('Proyectos realizados', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('antes-despues')); ?>"><?php esc_html_e('Antes y Después', 'fg-theme'); ?></a></li>
          <li><a href="<?php echo esc_url(fg_page_url('historia')); ?>"><?php esc_html_e('Historia', 'fg-theme'); ?></a></li>
        </ul>
      </div>

      <div class="footer-col footer-col--contact">
        <h3 class="footer-heading"><?php esc_html_e('Contacto', 'fg-theme'); ?></h3>
        <ul class="footer-contact-list">
          <?php if ($fg_address) : ?>
            <li>
              <span class="footer-contact-list__icon" aria-hidden="true"><?php echo fg_icon('pin'); ?></span>
              <span class="footer-contact-list__text">
                <a href="<?php echo esc_url($fg_maps_sanpedro); ?>" target="_blank" rel="noopener"><?php echo esc_html($fg_address); ?></a>
                <?php if ($fg_phone_sanpedro) : ?><a href="tel:<?php echo esc_attr($fg_phone_sanpedro_href); ?>"><?php echo esc_html($fg_phone_sanpedro); ?></a><?php endif; ?>
              </span>
            </li>
          <?php endif; ?>
          <?php if ($fg_address2) : ?>
            <li>
              <span class="footer-contact-list__icon" aria-hidden="true"><?php echo fg_icon('pin'); ?></span>
              <span class="footer-contact-list__text">
                <a href="<?php echo esc_url($fg_maps_ronda); ?>" target="_blank" rel="noopener"><?php echo esc_html($fg_address2); ?></a>
                <?php if ($fg_phone_ronda) : ?><a href="tel:<?php echo esc_attr($fg_phone_ronda_href); ?>"><?php echo esc_html($fg_phone_ronda); ?></a><?php endif; ?>
              </span>
            </li>
          <?php endif; ?>
          <?php if ($fg_phone) : ?>
            <li>
              <span class="footer-contact-list__icon" aria-hidden="true"><?php echo fg_icon('phone'); ?></span>
              <a href="https://wa.me/<?php echo esc_attr($fg_wa_href); ?>"><?php echo esc_html($fg_phone); ?> · WhatsApp</a>
            </li>
          <?php endif; ?>
          <?php if ($fg_email) : ?>
            <li>
              <span class="footer-contact-list__icon" aria-hidden="true"><?php echo fg_icon('mail'); ?></span>
              <a href="mailto:<?php echo esc_attr($fg_email); ?>"><?php echo esc_html($fg_email); ?></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <span>© <?php echo esc_html(wp_date('Y')); ?> Fantastic Gardens A.J. S.L. · <?php esc_html_e('Todos los derechos reservados', 'fg-theme'); ?></span>
      <div class="footer-legal">
        <a href="<?php echo esc_url(fg_page_url('cookies')); ?>"><?php esc_html_e('Política de cookies', 'fg-theme'); ?></a>
        <a href="<?php echo esc_url(fg_page_url('aviso-legal')); ?>"><?php esc_html_e('Aviso legal', 'fg-theme'); ?></a>
        <a href="<?php echo esc_url(fg_page_url('privacidad')); ?>"><?php esc_html_e('Política de privacidad', 'fg-theme'); ?></a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
