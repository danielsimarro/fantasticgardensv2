<?php
/**
 * Home · 04 Proyectos — tres fichas en retrato (proyectos reales del CPT) y el
 * comparador Antes/Después.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$url_realizados = fg_page_url('proyectos');

$proyectos_query = new WP_Query([
    'post_type'      => 'proyecto',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
]);

$items = [];
if ($proyectos_query->have_posts()) {
    while ($proyectos_query->have_posts()) {
        $proyectos_query->the_post();
        $items[] = [
            'title'     => get_the_title(),
            'meta'      => get_post_meta(get_the_ID(), 'ubicacion', true) ?: __('Marbella · Costa del Sol', 'fg-theme'),
            'image'     => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: fg_asset('proyecto-1.jpg'),
            'image_alt' => get_the_title(),
        ];
    }
    wp_reset_postdata();
} else {
    // Fallback estático si aún no hay proyectos publicados en el CPT.
    $items = [
        ['title' => __('Villa Mediterránea', 'fg-theme'), 'meta' => __('Marbella · Costa del Sol', 'fg-theme'), 'image' => fg_asset('proyecto-1.jpg'), 'image_alt' => __('Villa Mediterránea en Marbella', 'fg-theme')],
        ['title' => __('Jardín con Palmeras', 'fg-theme'), 'meta' => __('Benahavís · Málaga', 'fg-theme'), 'image' => fg_asset('proyecto-2.jpg'), 'image_alt' => __('Jardín con Palmeras en Benahavís', 'fg-theme')],
        ['title' => __('Jardín en Ronda', 'fg-theme'), 'meta' => __('Ronda · Málaga', 'fg-theme'), 'image' => fg_asset('proyecto-3.jpg'), 'image_alt' => __('Jardín en Ronda', 'fg-theme')],
    ];
}
?>
<section class="section has-wm" id="proyectos">
  <?php fg_vlines(3); ?>
  <?php
  fg_watermark([
    'src' => 'icons/botanica/olivos.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 24vw, 26rem)', 'opacity' => '.08',
    'float' => 95, 'rot' => 5,
  ]);
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'br', 'ratio' => '581 / 690',
    'size' => 'clamp(11rem, 24vw, 24rem)', 'opacity' => '.04',
    'float' => 24, 'rot' => -6,
  ]); ?>

  <div class="wrap">
    <div class="section-head section-head--split">
      <div>
        <?php echo fg_kicker(__('Proyectos', 'fg-theme'), '04'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80"><?php esc_html_e('Calidad y diseño', 'fg-theme'); ?></h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="150">
        <?php esc_html_e('Trabajamos junto con particulares, comunidades, promotoras y constructoras. Proyectos y diseños de todo tipo de jardines y campos de golf, con presupuesto sin compromiso.', 'fg-theme'); ?>
      </p>
    </div>

    <div class="grid grid--3 section-body proyectos-retrato">
      <?php foreach ($items as $i => $it) : ?>
        <a class="project-card" href="<?php echo esc_url($url_realizados); ?>"
           data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 110)); ?>">
          <div class="project-card__media fx-frame" data-img-reveal>
            <img src="<?php echo esc_url($it['image']); ?>"
                 alt="<?php echo esc_attr($it['image_alt']); ?>" loading="lazy" decoding="async">
          </div>
          <div class="project-card__body">
            <h3 class="project-card__title"><?php echo esc_html($it['title']); ?></h3>
            <span class="project-card__meta"><?php echo esc_html($it['meta']); ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="home-ba">
      <div>
        <?php echo fg_kicker(__('Antes y después', 'fg-theme')); ?>
        <h3 class="home-ba__title" data-reveal data-reveal-delay="70">
          <?php esc_html_e('La transformación,', 'fg-theme'); ?><br><em class="em-verde"><?php esc_html_e('al descubierto', 'fg-theme'); ?></em>
        </h3>
        <p class="home-ba__text" data-reveal data-reveal-delay="130">
          <?php esc_html_e('Arrastra la guía para ver el solar en obra y el jardín terminado. Reforma de jardín con piscina, Marbella.', 'fg-theme'); ?>
        </p>
        <div data-reveal data-reveal-delay="180">
          <?php echo fg_cta(__('Ver todos los antes y después', 'fg-theme'), fg_page_url('antes-despues')); ?>
        </div>
      </div>

      <div data-reveal data-reveal-delay="120">
        <?php fg_before_after([
          'before'       => fg_asset('reforma-jardin-piscina-marbella-antes.jpg'),
          'before_alt'   => __('Solar en obra junto a la piscina antes de la reforma', 'fg-theme'),
          'after'        => fg_asset('reforma-jardin-piscina-marbella-despues.jpg'),
          'after_alt'    => __('Jardín terminado en Marbella con césped natural, piscina y palmeras junto a un porche, reforma de Fantastic Gardens', 'fg-theme'),
          'before_label' => __('Antes', 'fg-theme'),
          'after_label'  => __('Después', 'fg-theme'),
        ]); ?>
      </div>
    </div>
  </div>
</section>
