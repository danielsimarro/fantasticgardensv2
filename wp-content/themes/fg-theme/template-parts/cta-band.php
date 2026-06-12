<?php
$title = $args['title'] ?? __('¿Listo para transformar tu jardín?', 'fg-theme');
$text  = $args['text']  ?? __('Cuéntanos tu proyecto y te preparamos un presupuesto personalizado sin compromiso.', 'fg-theme');
$link  = $args['link']  ?? home_url('/contacto-empresa-jardineria/');
$label = $args['label'] ?? __('Solicitar presupuesto', 'fg-theme');
?>
<section class="cta-band">
  <div class="container">
    <div class="cta-band__inner">
      <h2><?php echo esc_html($title); ?></h2>
      <p><?php echo esc_html($text); ?></p>
      <div class="cta-band__actions">
        <a href="<?php echo esc_url($link); ?>" class="btn btn--primary btn--lg">
          <?php echo esc_html($label); ?>
        </a>
        <a href="tel:+34691142679" class="btn btn--outline btn--lg">
          691 142 679
        </a>
      </div>
    </div>
  </div>
</section>
