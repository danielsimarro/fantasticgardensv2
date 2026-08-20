<?php
/*
Template Name: Proyectos Antes y Después
*/
if (!defined('ABSPATH')) exit;
get_header();

fg_photo_hero([
  'extra_class'   => 'photo-hero--soft-overlay',
  'image'         => fg_asset('transformacion-jardin-antes-despues-piscina-marbella.jpg'),
  'image_alt'     => __('Transformación de un jardín en la Costa del Sol: de solar en obra a jardín terminado con piscina, césped y palmeras', 'fg-theme'),
  'breadcrumb'    => [['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')], ['label' => __('Antes y Después', 'fg-theme')]],
  'title_html'    => esc_html__('Antes y', 'fg-theme') . ' <em class="em-lima">' . esc_html__('Después', 'fg-theme') . '</em>',
  'accent_rule'   => true,
  'subtitle'      => __('La transformación de un paisaje se empieza a ver desde el primer día', 'fg-theme'),
  'subtitle_lead' => true,
  'pill_cta'      => true,
  'row_plain'     => true,
  'cta'           => ['label' => __('Ver proyectos realizados', 'fg-theme'), 'url' => fg_page_url('proyectos')],
]);

// Cifras reales ya usadas en otras páginas del sitio (home, Contacto, Vivero).
fg_stats_band([
  ['num' => '+30',    'count' => 30,   'prefix' => '+',            'label' => __('Años de experiencia', 'fg-theme')],
  ['num' => '+1.000', 'count' => 1000, 'prefix' => '+', 'sep' => '.', 'label' => __('Proyectos realizados', 'fg-theme')],
  ['num' => '2',      'count' => 2,                                'label' => __('Sedes: Marbella y Ronda', 'fg-theme')],
  ['num' => '0 €',    'count' => 0,    'suffix' => ' €',           'label' => __('Visita y presupuesto', 'fg-theme')],
], [
  'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
  'size' => 'clamp(10rem, 22vw, 20rem)', 'opacity' => '.10', 'color' => 'var(--crema)', 'float' => 40,
], 2400);
?>
<section class="section has-wm" id="resultados">
  <?php
  fg_watermark([
    'src' => 'icons/botanica/especies-singulares.svg', 'pos' => 'tr',
    'size' => 'clamp(11rem, 24vw, 20rem)', 'opacity' => '.06',
    'float' => 90, 'rot' => -4, 'scrub' => 0.35,
  ]);
  fg_watermark([
    'src' => 'icons/botanica/gramineas.svg', 'pos' => 'br',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05',
    'float' => 26, 'rot' => 6, 'scrub' => 2.3,
  ]);
  ?>
  <div class="wrap">
    <div class="section-head section-head--split">
      <div>
        <?php echo fg_kicker(__('Resultados reales', 'fg-theme'), '01'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80">
          <?php esc_html_e('Cada jardín tiene un', 'fg-theme'); ?> <em class="em-verde"><?php esc_html_e('potencial único', 'fg-theme'); ?></em>
        </h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Combinamos diseño, plantación y mantenimiento para crear espacios que evolucionan, maduran y perduran en el tiempo.', 'fg-theme'); ?>
      </p>
    </div>

    <p class="ba-hint" data-reveal><?php esc_html_e('Arrastre la línea para ver la transformación completa.', 'fg-theme'); ?></p>

    <div class="ba-list">
      <figure class="ba-item ba-item--framed" data-reveal>
        <h3 class="compare__name"><?php esc_html_e('Jardín Villa Costa del Sol', 'fg-theme'); ?></h3>
        <span class="accent-rule"></span>
        <div class="ba-item__slider">
          <?php fg_before_after([
            'before'       => fg_asset('page-antes.jpg'),
            'after'        => fg_asset('page-despues.jpg'),
            'after_alt'    => __('Jardín de Villa Costa del Sol terminado, con césped natural, piscina y palmeras', 'fg-theme'),
            'before_label' => __('Antes', 'fg-theme'),
            'after_label'  => __('Después', 'fg-theme'),
          ]); ?>
        </div>
        <figcaption class="ba-item__cap"><?php esc_html_e('Obra en tierra · jardín terminado con césped, piscina y palmeras', 'fg-theme'); ?></figcaption>
      </figure>

      <figure class="ba-item ba-item--framed" data-reveal>
        <h3 class="compare__name"><?php esc_html_e('Reforma de jardín con piscina', 'fg-theme'); ?></h3>
        <span class="accent-rule"></span>
        <div class="ba-item__slider">
          <?php fg_before_after([
            'before'       => fg_asset('reforma-jardin-piscina-marbella-antes.jpg'),
            'after'        => fg_asset('reforma-jardin-piscina-marbella-despues.jpg'),
            'after_alt'    => __('Jardín terminado en Marbella con césped natural, piscina y palmeras junto a un porche, reforma de Fantastic Gardens', 'fg-theme'),
            'before_label' => __('Antes', 'fg-theme'),
            'after_label'  => __('Después', 'fg-theme'),
          ]); ?>
        </div>
        <figcaption class="ba-item__cap"><?php esc_html_e('Solar en obra junto a la piscina · jardín terminado con césped natural y palmeras', 'fg-theme'); ?></figcaption>
      </figure>

      <figure class="ba-item ba-item--framed" data-reveal>
        <h3 class="compare__name"><?php esc_html_e('Jardín de villa con palmera en Marbella', 'fg-theme'); ?></h3>
        <span class="accent-rule"></span>
        <div class="ba-item__slider">
          <?php fg_before_after([
            'before'       => fg_asset('jardin-villa-palmeras-marbella-antes.jpg'),
            'after'        => fg_asset('jardin-villa-palmeras-marbella-despues.jpg'),
            'after_alt'    => __('Jardín de villa en Marbella terminado, con césped natural, palmera y zona ajardinada junto al porche', 'fg-theme'),
            'before_label' => __('Antes', 'fg-theme'),
            'after_label'  => __('Después', 'fg-theme'),
          ]); ?>
        </div>
        <figcaption class="ba-item__cap"><?php esc_html_e('Parcela en obra con acopio de tierra · jardín terminado con césped natural, palmera y arriates', 'fg-theme'); ?></figcaption>
      </figure>
    </div>

    <div class="section-cta" data-reveal>
      <?php echo fg_cta(__('Empezar mi proyecto', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Transformación · Diseño · Permanencia', 'fg-theme'));
get_footer();
