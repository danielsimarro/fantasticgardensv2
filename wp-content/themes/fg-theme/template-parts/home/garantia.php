<?php
/**
 * Home · 03 Calidad y garantía — bloque oscuro con el sello de Ronda.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$avales = [
    ['icon' => 'direccion-obra-helmet.svg', 'label' => __('Dirección de obra propia', 'fg-theme')],
    ['icon' => 'riego-eficiente.svg',       'label' => __('Riego eficiente', 'fg-theme')],
    ['icon' => 'salud-vegetal.svg',         'label' => __('Salud vegetal', 'fg-theme')],
    ['icon' => 'trazabilidad.svg',          'label' => __('Trazabilidad del ejemplar', 'fg-theme')],
];
?>
<section class="section section--osc has-wm" id="garantia">
  <img class="home-garantia__bg" src="<?php echo esc_url(fg_asset('textura-jardin-tropical-oscuro.jpg')); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
  <div class="home-garantia__scrim" aria-hidden="true"></div>

  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
    'size' => 'clamp(10rem, 22vw, 24rem)', 'opacity' => '.06', 'color' => 'var(--crema)',
    'float' => 44, 'rot' => 6,
  ]); ?>

  <div class="wrap home-garantia">
    <div>
      <?php echo fg_kicker(__('Calidad y garantía', 'fg-theme'), '03', 'light'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Más de treinta años', 'fg-theme'); ?><br><em class="em-lima"><?php esc_html_e('de oficio', 'fg-theme'); ?></em>
      </h2>

      <div class="home-garantia__media photo-frame" data-img-reveal data-reveal-delay="200" data-tilt="3">
        <img src="<?php echo esc_url(fg_asset('calidad-garden.jpg')); ?>"
             alt="<?php esc_attr_e('Pérgola y jardín terminado por Fantastic Gardens', 'fg-theme'); ?>"
             loading="lazy" decoding="async">
      </div>
    </div>

    <div class="home-garantia__copy">
      <p data-reveal data-reveal-delay="120">
        <?php echo wp_kses(
          __('Somos una empresa con un equipo de gran responsabilidad en sus trabajos. El cliente siempre tiene la <em>decisión final</em> de modificar cualquier diseño y paisajismo a su gusto personal, siempre aconsejado por nosotros.', 'fg-theme'),
          ['em' => []]
        ); ?>
      </p>
      <p data-reveal data-reveal-delay="170">
        <?php echo wp_kses(
          __('Disponemos de nuestro <em>propio garden center en Ronda</em>, oficinas en San Pedro, plantaciones en Ronda, Málaga y Valencia, y maquinaria, herramientas y productos especializados para trabajar con la mayor profesionalidad y rapidez.', 'fg-theme'),
          ['em' => []]
        ); ?>
      </p>
      <p data-reveal data-reveal-delay="215">
        <?php echo wp_kses(
          __('Para cualquier duda, nuestro equipo estará encantado de atenderle <em>sin ningún compromiso</em>.', 'fg-theme'),
          ['em' => []]
        ); ?>
      </p>

      <div class="avales">
        <div class="avales__grid">
          <?php foreach ($avales as $i => $a) : ?>
            <div class="aval" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 70)); ?>">
              <span class="aval__icon" aria-hidden="true">
                <img src="<?php echo esc_url(fg_asset('icons/servicios/' . $a['icon'])); ?>"
                     alt="" loading="lazy" decoding="async">
              </span>
              <span class="aval__label"><?php echo esc_html($a['label']); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
