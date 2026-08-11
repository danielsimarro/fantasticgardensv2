<?php
/**
 * Home · Hero a pantalla completa: vídeo de fondo (escritorio), imagen en
 * móvil, titular a gran escala y banda de cifras apoyada abajo.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

// Media editable por ACF (grupo "Portada"), con fallback a los assets del tema.
$hero_mobile = fg_media_url('hero_mobile', 'hero-jardines-permanecen-movil.jpg');
$hero_poster = fg_media_url('hero_poster', 'hero-indice-poster.jpg');
$hero_video  = fg_media_url('hero_video',  'hero-indice.mp4');

$cifras = [
    ['num' => '+20',       'count' => 20, 'prefix' => '+', 'label' => __('Años de experiencia', 'fg-theme')],
    ['num' => 'Ronda',                                     'label' => __('Vivero y garden center', 'fg-theme')],
    ['num' => '3',         'count' => 3,                   'label' => __('Plantaciones propias', 'fg-theme')],
    ['num' => 'San Pedro',                                 'label' => __('Oficinas en Marbella', 'fg-theme')],
];
?>
<section class="hero" id="inicio">
  <div class="hero__media">
    <img class="hero__img hero__img--mobile"
         src="<?php echo esc_url($hero_mobile); ?>"
         alt="<?php esc_attr_e('Villa mediterránea en Marbella con piscina de borde infinito, olivos y cipreses al atardecer', 'fg-theme'); ?>"
         fetchpriority="high" decoding="async">
    <img class="hero__img hero__img--desktop"
         src="<?php echo esc_url($hero_poster); ?>"
         alt="" aria-hidden="true" fetchpriority="high" decoding="async">
    <video class="hero__video" data-hero-video
           src="<?php echo esc_url($hero_video); ?>"
           poster="<?php echo esc_url($hero_poster); ?>"
           muted loop playsinline preload="none" aria-hidden="true" tabindex="-1"></video>
  </div>

  <div class="hero__overlay" aria-hidden="true"></div>

  <div class="wrap hero__content">
    <div class="hero__eyebrow" data-reveal>
      <span class="hero__eyebrow-rule" aria-hidden="true"></span>
      <span class="hero__eyebrow-text"><?php esc_html_e('Jardinería · Paisajismo · Mantenimiento', 'fg-theme'); ?></span>
    </div>

    <h1 class="hero__title">
      <span data-reveal data-reveal-delay="80"><?php esc_html_e('Creamos tu', 'fg-theme'); ?></span>
      <span class="hero__title-2" data-reveal data-reveal-delay="200"><em><?php esc_html_e('paraíso', 'fg-theme'); ?></em></span>
    </h1>

    <div class="hero__row">
      <p class="hero__subtitle" data-reveal data-reveal-delay="300">
        <?php esc_html_e('Diseñamos, construimos y mantenemos jardines exclusivos en Marbella y la Costa del Sol.', 'fg-theme'); ?>
      </p>
      <div class="hero__cta" data-reveal data-reveal-delay="380">
        <?php
        echo fg_pill(__('Proyecto sin compromiso', 'fg-theme'), fg_page_url('contacto'), 'solid');
        echo fg_pill(__('Ver proyectos', 'fg-theme'), fg_page_url('proyectos'), 'verde');
        ?>
      </div>
    </div>
  </div>

  <div class="hero__cue" aria-hidden="true">
    <span class="hero__cue-text"><?php esc_html_e('Descubre', 'fg-theme'); ?></span>
    <span class="hero__cue-line"></span>
  </div>

  <div class="wrap hero__stats">
    <div class="hero__stats-grid">
      <?php foreach ($cifras as $i => $c) : ?>
        <div class="hero__stat" data-reveal data-reveal-delay="<?php echo esc_attr((string) (60 + $i * 80)); ?>">
          <span class="hero__stat-num"<?php
            if (isset($c['count'])) {
                echo ' data-count="' . esc_attr((string) $c['count']) . '"';
                if (!empty($c['prefix'])) echo ' data-prefix="' . esc_attr($c['prefix']) . '"';
            } ?>><?php echo esc_html($c['num']); ?></span>
          <span class="hero__stat-label"><?php echo esc_html($c['label']); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
