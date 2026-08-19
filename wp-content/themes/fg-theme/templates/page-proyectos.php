<?php
/*
Template Name: Proyectos Realizados
*/
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="section has-wm section--tight-t-mobile">
  <?php
  fg_watermark([
    'src' => 'icons/botanica/especies-singulares.svg', 'pos' => 'tr',
    'size' => 'clamp(12rem, 26vw, 22rem)', 'opacity' => '.06',
    'float' => 95, 'rot' => 4, 'scrub' => 0.35,
  ]);
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(11rem, 24vw, 20rem)', 'opacity' => '.05', 'flip' => true,
    'float' => 28, 'rot' => -7, 'scrub' => 2.2,
  ]); ?>
  <div class="wrap">
    <h1 class="page-title page-title--flush"><?php esc_html_e('Proyectos realizados', 'fg-theme'); ?></h1>
    <span class="accent-rule"></span>
    <p class="page-lead"><?php esc_html_e('Una selección de paisajes que ya forman parte de una historia', 'fg-theme'); ?></p>

    <p class="tipologias"><?php esc_html_e('Jardines particulares · Comunidades · Campos de golf', 'fg-theme'); ?></p>

    <?php
    $fg_proyectos_q = new WP_Query([
        'post_type'      => 'proyecto',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    if ($fg_proyectos_q->have_posts()) :
        ?>
        <div class="grid grid--3 section-body" data-reveal>
          <?php
          while ($fg_proyectos_q->have_posts()) : $fg_proyectos_q->the_post();
              $thumb     = get_the_post_thumbnail_url(null, 'large') ?: fg_asset('proyecto-1.jpg');
              $ubicacion = get_post_meta(get_the_ID(), 'ubicacion', true) ?: 'Marbella · Costa del Sol';
              fg_project_card([
                  'url'       => get_permalink(),
                  'image'     => $thumb,
                  'image_alt' => get_the_title() . ' · ' . $ubicacion,
                  'title'     => get_the_title(),
                  'meta'      => $ubicacion,
              ]);
          endwhile;
          wp_reset_postdata();
          ?>
        </div>
    <?php else :
        $fg_static_projects = [
            ['img' => fg_asset('proyecto-1.jpg'), 'title' => __('Villa Mediterránea', 'fg-theme'), 'ubicacion' => __('Marbella · Costa del Sol', 'fg-theme')],
            ['img' => fg_asset('proyecto-2.jpg'), 'title' => __('Jardín con Palmeras', 'fg-theme'), 'ubicacion' => __('Benahavís · Málaga', 'fg-theme')],
            ['img' => fg_asset('proyecto-3.jpg'), 'title' => __('Jardín en Ronda', 'fg-theme'), 'ubicacion' => __('Ronda · Málaga', 'fg-theme')],
        ];
        ?>
        <div class="grid grid--3 section-body" data-reveal>
          <?php foreach ($fg_static_projects as $p) :
              fg_project_card([
                  'url'       => fg_page_url('proyectos'),
                  'image'     => $p['img'],
                  'image_alt' => $p['title'] . ' · ' . $p['ubicacion'],
                  'title'     => $p['title'],
                  'meta'      => $p['ubicacion'],
              ]);
          endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="section-cta" data-reveal>
      <p class="projects-nota"><?php esc_html_e('¿Quiere ver cómo empezaron estos jardines?', 'fg-theme'); ?></p>
      <?php echo fg_cta(__('Ver las transformaciones', 'fg-theme'), fg_page_url('antes-despues')); ?>
    </div>
  </div>
</section>

<section class="section section--beige">
  <div class="wrap">
    <?php fg_section_heading([
        'eyebrow'  => __('Cómo trabajamos', 'fg-theme'),
        'title'    => __('De la idea al jardín, en tres pasos', 'fg-theme'),
        'subtitle' => __('Le acompañamos en todo el proceso creativo, siempre con presupuestos sin compromiso.', 'fg-theme'),
    ]); ?>
    <ol class="steps steps--cards" data-reveal>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <?php echo fg_icon('phone'); ?>
          <span class="step__num">01</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Hablamos', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Cuéntenos qué necesita; le escuchamos y le asesoramos sin ningún compromiso.', 'fg-theme'); ?></p>
      </li>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/concepto-pencil.svg')); ?>" alt="">
          <span class="step__num">02</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Diseño y presupuesto', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Elaboramos su proyecto a medida, con planos y 3D para que lo vea antes de empezar.', 'fg-theme'); ?></p>
      </li>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/direccion-obra-helmet.svg')); ?>" alt="">
          <span class="step__num">03</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Realización', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Creamos el jardín de sus sueños mientras usted disfruta del proceso.', 'fg-theme'); ?></p>
      </li>
    </ol>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
