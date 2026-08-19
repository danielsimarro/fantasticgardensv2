<?php
/**
 * Home · 01 El estudio — quiénes somos, a dos columnas.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$publicos = [
    __('Particulares', 'fg-theme'),
    __('Comunidades', 'fg-theme'),
    __('Urbanizaciones', 'fg-theme'),
    __('Promotoras', 'fg-theme'),
    __('Campos de golf', 'fg-theme'),
];
?>
<section class="section has-wm" id="estudio">
  <?php fg_vlines(4); ?>
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(10rem, 18vw, 20rem)', 'opacity' => '.05',
    'float' => 34, 'rot' => -7,
  ]); ?>

  <div class="wrap home-estudio">
    <div class="home-estudio__intro">
      <?php echo fg_kicker(__('El estudio', 'fg-theme'), '01'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Te ayudamos con tu jardín, de la idea', 'fg-theme'); ?><br>
        <em class="em-verde"><?php esc_html_e('al último detalle', 'fg-theme'); ?></em>
      </h2>

      <div class="home-estudio__media" data-img-reveal data-reveal-delay="140">
        <img data-parallax="0.05" data-kenburns
             src="<?php echo esc_url(fg_asset('jardinero-cuidando-cesped-piscina-marbella.jpg')); ?>"
             alt="<?php esc_attr_e('Jardinero de Fantastic Gardens cortando el césped junto a la piscina en un jardín de Marbella', 'fg-theme'); ?>"
             loading="lazy" decoding="async">
        <div class="home-estudio__media-tag">
          <span class="home-estudio__media-tag-label"><?php esc_html_e('Estudio', 'fg-theme'); ?></span>
          <span class="home-estudio__media-tag-name"><?php esc_html_e('Fantastic Gardens', 'fg-theme'); ?></span>
        </div>
      </div>
    </div>

    <div class="home-estudio__copy">
      <p class="home-estudio__lead" data-reveal data-reveal-delay="120">
        <?php esc_html_e('Somos una empresa de jardinería, paisajismo y mantenimiento. Realizamos proyectos y diseños de jardines de todo tipo, sin compromiso.', 'fg-theme'); ?>
      </p>

      <div class="home-estudio__points">
        <div class="home-estudio__point home-estudio__point--verde" data-reveal data-reveal-delay="180">
          <span class="home-estudio__point-icon" aria-hidden="true">
            <img src="<?php echo esc_url(fg_asset('icons/servicios/salud-vegetal.svg')); ?>" alt="" loading="lazy" decoding="async">
          </span>
          <p><?php esc_html_e('Mantenimiento de jardines con técnicos especializados en tratamientos de plagas, podas, abonado y fertilización, con el uso de las herramientas y productos más modernos y eficaces.', 'fg-theme'); ?></p>
        </div>
        <div class="home-estudio__point home-estudio__point--arena" data-reveal data-reveal-delay="230">
          <span class="home-estudio__point-icon" aria-hidden="true">
            <img src="<?php echo esc_url(fg_asset('icons/servicios/cultivo-responsable.svg')); ?>" alt="" loading="lazy" decoding="async">
          </span>
          <p>
            <?php
            printf(
                /* translators: %s: enlace a la página de Vivero. */
                esc_html__('Además, disponemos de %s con plantación propia, y oficinas en San Pedro Alcántara, Marbella.', 'fg-theme'),
                '<a class="link-verde" href="' . esc_url(fg_page_url('vivero')) . '">' . esc_html__('vivero propio en Ronda', 'fg-theme') . '</a>'
            );
            ?>
          </p>
        </div>
      </div>

      <div class="tag-row" data-reveal data-reveal-delay="300">
        <?php foreach ($publicos as $i => $p) : ?>
          <span class="tag-linea<?php echo $i % 2 === 1 ? ' tag-linea--tint' : ''; ?>">
            <span class="tag-linea__icon" aria-hidden="true"></span>
            <?php echo esc_html($p); ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
