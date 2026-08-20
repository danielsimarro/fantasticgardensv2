<?php
/*
Template Name: Servicio Desbroce y Limpieza de Parcelas
*/
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php
fg_photo_hero([
  'image'         => fg_asset('hero-desbroce-mecanico-parcela-marbella.jpg'),
  'image_alt'     => __('Miniexcavadora desbrozando una parcela con maleza al atardecer en Marbella, con una villa mediterránea al fondo', 'fg-theme'),
  'title_html'    => esc_html__('Desbroce y', 'fg-theme') . ' <em class="em-lima">' . esc_html__('limpieza de parcelas', 'fg-theme') . '</em>',
  'accent_rule'   => true,
  'subtitle'      => __('Su terreno, listo para construir, plantar o simplemente disfrutar', 'fg-theme'),
  'subtitle_lead' => true,
  'pill_cta'      => true,
  'row_plain'     => true,
  'cta'           => ['label' => __('Solicitar presupuesto', 'fg-theme'), 'url' => fg_page_url('contacto')],
]);
?>
<section class="section has-wm section--tight-b" id="que-incluye">
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
        <?php esc_html_e('Retiramos maleza, matorral y restos vegetales, dejando la parcela lista para construir, plantar o simplemente disfrutar.', 'fg-theme'); ?>
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
      __('Preparación del terreno previa a obra o plantación', 'fg-theme'),
      __('Desbroce preventivo para reducir el riesgo de incendio', 'fg-theme'),
    ]); ?>
  </div>
</section>
<section class="section has-wm" id="video-desbroce">
  <img class="video-desbroce__bg" src="<?php echo esc_url(fg_asset('textura-jardin-tropical-claro.jpg')); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
  <div class="video-desbroce__scrim" aria-hidden="true"></div>
  <div class="wrap video-showcase">
    <div>
      <?php echo fg_kicker(__('En acción', 'fg-theme'), '02'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Desbroce mecánico', 'fg-theme'); ?> <em class="em-verde"><?php esc_html_e('en marcha', 'fg-theme'); ?></em>
      </h2>
      <div class="video-showcase__divider" aria-hidden="true">
        <span class="video-showcase__divider-line"></span>
        <span class="video-showcase__divider-dot"></span>
        <span class="video-showcase__divider-line"></span>
      </div>
      <p class="video-showcase__lead" data-reveal data-reveal-delay="160">
        <?php echo wp_kses(
          __('Grabado durante uno de nuestros trabajos: despejamos parcelas <strong>de maleza, cañas y arbustos</strong> con maquinaria ligera, minimizando el impacto ambiental y dejando el terreno listo para avanzar con precisión entre muros, arbolado y construcciones en entornos delicados.', 'fg-theme'),
          ['strong' => []]
        ); ?>
      </p>
      <div class="video-showcase__cta" data-reveal data-reveal-delay="240">
        <?php echo fg_cta(__('Ver servicio completo', 'fg-theme'), '#que-incluye'); ?>
      </div>
    </div>

    <div class="video-showcase__media" data-img-reveal data-reveal-delay="200">
      <div class="video-reel-wrap">
        <div class="video-reel" data-video-reel>
          <video class="video-reel__video"
                 src="<?php echo esc_url(fg_asset('desbroce-mecanico-maquinaria-marbella.mp4')); ?>"
                 poster="<?php echo esc_url(fg_asset('desbroce-mecanico-maquinaria-marbella-poster.jpg')); ?>"
                 preload="none" playsinline
                 aria-label="<?php esc_attr_e('Vídeo de un trabajo real de desbroce mecánico con miniexcavadora en una parcela de la Costa del Sol', 'fg-theme'); ?>"></video>
          <button type="button" class="video-reel__play" data-video-play aria-label="<?php esc_attr_e('Reproducir vídeo', 'fg-theme'); ?>"></button>
          <div class="video-reel__badge">
            <span class="video-reel__badge-icon"><?php echo fg_icon('pin'); ?></span>
            <span class="video-reel__badge-text"><strong><?php esc_html_e('Trabajo real de desbroce', 'fg-theme'); ?></strong><?php esc_html_e('Costa del Sol', 'fg-theme'); ?></span>
          </div>
        </div>
        <div class="video-seal">
          <svg class="video-seal__ring" viewBox="0 0 120 120">
            <defs><path id="video-seal-path" d="M60,60 m-48,0 a48,48 0 1,1 96,0 a48,48 0 1,1 -96,0" /></defs>
            <text class="video-seal__text"><textPath href="#video-seal-path" startOffset="0%"><?php esc_html_e('Fantastic Gardens · Trabajo real · Fantastic Gardens · Trabajo real · ', 'fg-theme'); ?></textPath></text>
          </svg>
          <span class="leaf-mask video-seal__icon" style="--leaf-src:url('<?php echo esc_url(fg_asset('hojita.svg')); ?>')"></span>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$features = [
  ['icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21v-9"/><path d="M12 12c0-3.5-2.5-6-6-6 0 3.5 2.5 6 6 6z"/><path d="M12 12c0-3.5 2.5-6 6-6 0 3.5-2.5 6-6 6z"/></svg>', 'label' => __('Maquinaria ligera', 'fg-theme'),  'description' => __('Accedemos a cualquier punto sin dañar el entorno.', 'fg-theme')],
  ['icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18 9 8l4 6 2-3 6 7z"/></svg>', 'label' => __('Máxima precisión', 'fg-theme'), 'description' => __('Trabajamos con cuidado entre muros, arbolado y construcciones.', 'fg-theme')],
  ['icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 19c8 0 14-6 14-14-8 0-14 6-14 14z"/><path d="M5 19c3-5 6-8 11-11"/></svg>', 'label' => __('Impacto mínimo', 'fg-theme'), 'description' => __('Respetamos el paisaje y la biodiversidad del terreno.', 'fg-theme')],
  ['icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>', 'label' => __('Terreno listo', 'fg-theme'), 'description' => __('Dejamos tu parcela preparada para seguir avanzando.', 'fg-theme')],
];
?>
<section class="section section--osc action-features">
  <img class="action-features__bg" src="<?php echo esc_url(fg_asset('textura-jardin-tropical-oscuro.jpg')); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
  <div class="action-features__scrim" aria-hidden="true"></div>
  <div class="wrap"><?php fg_feature_row($features, 'action'); ?></div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
