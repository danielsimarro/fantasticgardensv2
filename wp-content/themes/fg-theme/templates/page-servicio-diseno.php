<?php
/*
Template Name: Servicio Diseño Paisajismo
*/
if (!defined('ABSPATH')) exit;
get_header();

fg_photo_hero([
  'image'         => fg_asset('jardin-mediterraneo-villa-piscina-marbella.jpg'),
  'image_alt'     => __('Jardín mediterráneo de una villa en Marbella con piscina, palmeras y vistas a la montaña', 'fg-theme'),
  'title_html'    => esc_html__('Diseño de', 'fg-theme') . ' <em class="em-lima">' . esc_html__('paisajes', 'fg-theme') . '</em>',
  'accent_rule'   => true,
  'subtitle'      => __('Espacios pensados para vivir el exterior', 'fg-theme'),
  'subtitle_lead' => true,
  'pill_cta'      => true,
  'row_plain'     => true,
  'cta'           => ['label' => __('Ver proyectos', 'fg-theme'), 'url' => fg_page_url('proyectos')],
]);
?>
<section class="section has-wm section--tight-b">
  <?php fg_watermark([
    'src' => 'icons/servicios/vegetacion-sprig.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 28vw, 24rem)', 'opacity' => '.06', 'float' => 65,
  ]); ?>
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'br', 'ratio' => '581 / 690',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05', 'float' => 45,
  ]); ?>
  <div class="wrap split-intro">
    <div class="split-intro__aside">
      <?php echo fg_kicker(__('Cuéntanos qué necesitas', 'fg-theme'), '01'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Vea su jardín terminado', 'fg-theme'); ?> <em class="em-verde"><?php esc_html_e('antes de empezar', 'fg-theme'); ?></em>
      </h2>
      <p class="split-intro__lead" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Nuestro equipo de diseño realiza proyectos en AutoCAD, 3D y fotomontajes, para que pueda ver el resultado final de su jardín sin ningún compromiso. Del clásico más sereno al contemporáneo más audaz, siempre en armonía con su vivienda.', 'fg-theme'); ?>
      </p>
      <div class="split-intro__media" data-img-reveal data-reveal-delay="200">
        <img src="<?php echo esc_url(fg_asset('plano-diseno-jardin-piscina-plantas.png')); ?>" alt="<?php esc_attr_e('Plano de diseño de jardín con piscina y leyenda numerada de especies vegetales', 'fg-theme'); ?>" loading="lazy" decoding="async">
      </div>
      <div class="split-intro__cta" data-reveal data-reveal-delay="260">
        <?php echo fg_cta(__('Cuéntenos su proyecto', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
      </div>
    </div>

    <ol class="numbered-grid">
      <?php
      $pasos = [
        __('Proyecto en AutoCAD con planos técnicos precisos', 'fg-theme'),
        __('Visualización 3D fotorrealista antes de empezar la obra', 'fg-theme'),
        __('Fotomontaje personalizado sobre fotos reales de su propiedad', 'fg-theme'),
        __('Selección de plantas directas de nuestro vivero propio', 'fg-theme'),
        __('Presupuesto detallado, partida a partida, sin costes ocultos', 'fg-theme'),
        __('Ejecución completa: movimientos de tierra, riego, plantación y pavimentación', 'fg-theme'),
      ];
      $romanos = ['I', 'II', 'III', 'IV', 'V', 'VI'];
      foreach ($pasos as $i => $paso) :
        $num = $romanos[$i] ?? sprintf('%02d', $i + 1);
        ?>
        <li class="numbered-grid__item" data-reveal data-reveal-delay="<?php echo esc_attr((string) (60 + $i * 40)); ?>">
          <span class="numbered-grid__bignum" aria-hidden="true"><?php echo esc_html($num); ?></span>
          <span class="numbered-grid__num" aria-hidden="true"><?php echo esc_html($num); ?></span>
          <span class="numbered-grid__text"><?php echo esc_html($paso); ?></span>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
<?php
$features = [
  ['icon' => fg_asset('icons/servicios/concepto-pencil.svg'),       'label' => __('Concepto', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/materiales-stones.svg'),     'label' => __('Materiales', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/vegetacion-sprig.svg'),      'label' => __('Vegetación', 'fg-theme')],
  ['icon' => fg_asset('icons/servicios/direccion-obra-helmet.svg'), 'label' => __('Dirección de obra', 'fg-theme')],
];
?>
<section class="section section--osc design-features">
  <div class="wrap"><?php fg_feature_row($features, 'compact'); ?></div>
</section>

<section class="section section--beige has-wm section--tight-t">
  <?php fg_watermark([
    'src' => 'icons/servicios/concepto-pencil.svg', 'pos' => 'tr',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05', 'float' => 45,
  ]); ?>
  <div class="wrap">
    <div class="section-head section-head--split">
      <div>
        <?php echo fg_kicker(__('Antes de decidir', 'fg-theme'), '02'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80">
          <?php
          printf(
            /* translators: %s: "3D" en cursiva verde. */
            esc_html__('Vea su proyecto en %s', 'fg-theme'),
            '<em class="em-verde">' . esc_html__('3D', 'fg-theme') . '</em>'
          );
          ?>
        </h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Realizamos renders y fotomontajes en 3D de su jardín para que imaginar el resultado final sea mucho más sencillo. Nuestro equipo de diseñadores y paisajistas le acompaña y aconseja en cada decisión, hasta obtener resultados de ensueño.', 'fg-theme'); ?>
      </p>
    </div>

    <p class="ba-hint" data-reveal><?php esc_html_e('Arrastre la línea para pasar del plano de diseño al resultado en 3D.', 'fg-theme'); ?></p>

    <div class="ba-list ba-list--pair">
      <figure class="ba-item" data-reveal>
        <?php fg_before_after([
          'before'     => fg_asset('diseno-plano-1.jpg'),
          'after'      => fg_asset('diseno-render-1.jpg'),
          'after_alt'  => __('Render 3D fotorrealista de una villa tropical con piscina infinita, atrio ajardinado y estanque', 'fg-theme'),
        ]); ?>
        <figcaption class="ba-item__cap"><?php esc_html_e('Villa tropical · del plano al render 3D', 'fg-theme'); ?></figcaption>
      </figure>
      <figure class="ba-item" data-reveal>
        <?php fg_before_after([
          'before'     => fg_asset('diseno-plano-2.jpg'),
          'after'      => fg_asset('diseno-render-2.jpg'),
          'after_alt'  => __('Render 3D fotorrealista de un proyecto de jardín y paisajismo', 'fg-theme'),
        ]); ?>
        <figcaption class="ba-item__cap"><?php esc_html_e('Proyecto de paisajismo · del plano al render 3D', 'fg-theme'); ?></figcaption>
      </figure>
    </div>

    <div class="section-cta" data-reveal>
      <?php echo fg_cta(__('Solicitar un proyecto 3D', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
