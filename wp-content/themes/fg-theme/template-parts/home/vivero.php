<?php
/**
 * Home · 05 Botánica — el vivero de Ronda y las familias que se cultivan.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$familias = [
    ['icon' => 'olivos.svg',              'label' => __('Olivos', 'fg-theme')],
    ['icon' => 'aromaticas.svg',          'label' => __('Aromáticas', 'fg-theme')],
    ['icon' => 'gramineas.svg',           'label' => __('Gramíneas', 'fg-theme')],
    ['icon' => 'especies-singulares.svg', 'label' => __('Singulares', 'fg-theme')],
];
?>
<section class="section section--arena has-wm" id="vivero">
  <?php fg_watermark([
    'src' => 'icons/botanica/aromaticas.svg', 'pos' => 'br',
    'size' => 'clamp(10rem, 20vw, 21rem)', 'opacity' => '.1',
    'float' => 40, 'rot' => -5,
  ]); ?>

  <div class="wrap home-vivero">
    <div class="home-vivero__media" data-img-reveal>
      <img data-parallax="0.06" src="<?php echo esc_url(fg_asset('hero-vivero.jpg')); ?>"
           alt="<?php esc_attr_e('Vivero propio de Fantastic Gardens en Ronda', 'fg-theme'); ?>"
           loading="lazy" decoding="async">
      <div class="home-vivero__tag">
        <span class="home-vivero__tag-label"><?php esc_html_e('Garden center', 'fg-theme'); ?></span>
        <span class="home-vivero__tag-name"><?php esc_html_e('Ronda, Málaga', 'fg-theme'); ?></span>
      </div>
    </div>

    <div>
      <?php echo fg_kicker(__('Botánica', 'fg-theme'), '05'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('La mejor selección', 'fg-theme'); ?><br><?php esc_html_e('de flores y plantas', 'fg-theme'); ?>
      </h2>
      <p class="home-vivero__text" data-reveal data-reveal-delay="140">
        <?php esc_html_e('Disponemos de viveros con plantación propia que harán de tu jardín un verdadero oasis. Especies mediterráneas seleccionadas y aclimatadas en nuestras plantaciones de Ronda, Málaga y Valencia.', 'fg-theme'); ?>
      </p>

      <div class="familias">
        <?php foreach ($familias as $i => $f) : ?>
          <div class="familia-item" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 70)); ?>">
            <img src="<?php echo esc_url(fg_asset('icons/botanica/' . $f['icon'])); ?>"
                 alt="" aria-hidden="true" width="30" height="30" loading="lazy" decoding="async">
            <span><?php echo esc_html($f['label']); ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="home-vivero__cta" data-reveal data-reveal-delay="300">
        <?php echo fg_cta(__('Descubrir especies', 'fg-theme'), fg_page_url('especies')); ?>
      </div>
    </div>
  </div>
</section>
