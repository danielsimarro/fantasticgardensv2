<?php
/*
Template Name: Servicio Desbroce y Limpieza de Parcelas
*/
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php
fg_photo_hero([
  'image'         => fg_asset('hero-mantenimiento.jpg'),
  'image_alt'     => __('Jardinero trabajando en una parcela de la Costa del Sol', 'fg-theme'),
  'title_html'    => esc_html__('Desbroce y', 'fg-theme') . ' <em class="em-lima">' . esc_html__('limpieza de parcelas', 'fg-theme') . '</em>',
  'accent_rule'   => true,
  'subtitle'      => __('Su terreno, listo para construir, plantar o simplemente disfrutar', 'fg-theme'),
  'subtitle_lead' => true,
  'pill_cta'      => true,
  'row_plain'     => true,
  'cta'           => ['label' => __('Solicitar presupuesto', 'fg-theme'), 'url' => fg_page_url('contacto')],
]);
?>
<section class="section has-wm section--tight-b">
  <?php fg_watermark([
    'src' => 'icons/servicios/materiales-stones.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 28vw, 24rem)', 'opacity' => '.06', 'float' => 65,
  ]); ?>
  <div class="wrap split-intro">
    <div class="split-intro__aside">
      <?php echo fg_kicker(__('Qué incluye', 'fg-theme'), '01'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Desbroce de terrenos, parcelas y fincas', 'fg-theme'); ?>
      </h2>
      <p class="split-intro__lead" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Retiramos maleza, matorral y restos vegetales de parcelas, solares y fincas rústicas, dejando el terreno preparado para una obra, un jardín nuevo o simplemente para reducir el riesgo de incendio y mantener la parcela en condiciones.', 'fg-theme'); ?>
      </p>
      <div class="split-intro__media split-intro__media--compare" data-img-reveal data-reveal-delay="200">
        <?php fg_before_after([
          'before'       => fg_asset('desbroce-parcela-marbella-antes.jpg'),
          'after'        => fg_asset('desbroce-parcela-marbella-despues.jpg'),
          'after_alt'    => __('Vista aérea de una parcela en Marbella tras el desbroce, con el terreno limpio y preparado', 'fg-theme'),
          'before_label' => __('Antes', 'fg-theme'),
          'after_label'  => __('Después', 'fg-theme'),
        ]); ?>
      </div>
      <div class="split-intro__cta" data-reveal data-reveal-delay="260">
        <?php echo fg_cta(__('Cuéntenos su parcela', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
      </div>
    </div>

    <?php
    fg_numbered_grid([
      __('Desbroce mecánico de maleza y matorral', 'fg-theme'),
      __('Retirada y gestión de restos vegetales', 'fg-theme'),
      __('Limpieza de solares y parcelas abandonadas', 'fg-theme'),
      __('Preparación del terreno previa a obra o plantación', 'fg-theme'),
      __('Desbroce preventivo para reducir el riesgo de incendio', 'fg-theme'),
      __('Presupuesto según superficie y estado del terreno', 'fg-theme'),
    ]); ?>
  </div>
</section>
<?php
$features = [
  ['icon' => fg_asset('icons/servicios/materiales-stones.svg'),     'label' => __('Desbroce de parcelas', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/direccion-obra-helmet.svg'), 'label' => __('Preparación de terreno', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/poda-formacion.svg'),        'label' => __('Retirada de maleza', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/riego-eficiente.svg'),       'label' => __('Prevención de incendios', 'fg-theme')],
];
?>
<section class="section section--osc design-features">
  <div class="wrap"><?php fg_feature_row($features, 'compact'); ?></div>
</section>
<section class="section has-wm" id="video-desbroce">
  <div class="wrap video-showcase">
    <div>
      <?php echo fg_kicker(__('En acción', 'fg-theme'), '02'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Desbroce mecánico', 'fg-theme'); ?> <em class="em-verde"><?php esc_html_e('en marcha', 'fg-theme'); ?></em>
      </h2>
      <p class="video-showcase__lead" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Grabado durante uno de nuestros trabajos: despejamos parcelas grandes con maquinaria propia —miniexcavadora y desbrozadora— avanzando con precisión entre muros, arbolado y construcciones sin dañarlos.', 'fg-theme'); ?>
      </p>
      <div class="video-showcase__cta" data-reveal data-reveal-delay="240">
        <?php echo fg_cta(__('Pedir presupuesto', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
      </div>
    </div>

    <div class="video-showcase__media" data-img-reveal data-reveal-delay="200">
      <div class="video-reel" data-video-reel>
        <video class="video-reel__video"
               src="<?php echo esc_url(fg_asset('desbroce-mecanico-maquinaria-marbella.mp4')); ?>"
               poster="<?php echo esc_url(fg_asset('desbroce-mecanico-maquinaria-marbella-poster.jpg')); ?>"
               preload="none" playsinline
               aria-label="<?php esc_attr_e('Vídeo de un trabajo real de desbroce mecánico con miniexcavadora en una parcela de la Costa del Sol', 'fg-theme'); ?>"></video>
        <button type="button" class="video-reel__play" data-video-play aria-label="<?php esc_attr_e('Reproducir vídeo', 'fg-theme'); ?>"></button>
      </div>
      <p class="video-reel__cap"><?php esc_html_e('Trabajo real de desbroce con miniexcavadora · Costa del Sol', 'fg-theme'); ?></p>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
