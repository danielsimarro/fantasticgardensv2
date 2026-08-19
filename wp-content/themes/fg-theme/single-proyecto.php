<?php
/**
 * Vista individual del CPT `proyecto`.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
get_header();

while (have_posts()) : the_post();
    $ubicacion = get_post_meta(get_the_ID(), 'ubicacion', true) ?: 'Marbella · Costa del Sol';
    $thumb     = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: fg_asset('proyecto-1.jpg');
    $numero    = max(1, (int) get_post()->menu_order);
    $detalle   = fg_proyecto_detalle(get_the_ID());

    fg_photo_hero([
        'breadcrumb' => [
            ['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')],
            ['label' => __('Proyectos', 'fg-theme'), 'url' => fg_page_url('proyectos')],
            ['label' => get_the_title()],
        ],
        'kicker'     => __('Proyecto realizado', 'fg-theme'),
        'kicker_num' => sprintf('%02d', $numero),
        'image'      => $thumb,
        'image_alt'  => get_the_title(),
        'title'      => get_the_title(),
        'subtitle'   => $ubicacion,
    ]);
    ?>

    <section class="section has-wm" id="proyecto-detalle">
      <?php fg_vlines(3); ?>
      <?php
      fg_watermark([
          'src' => 'icons/botanica/olivos.svg', 'pos' => 'tr',
          'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05',
          'float' => 50, 'rot' => -3, 'scrub' => 0.5,
      ]);
      fg_watermark([
          'src' => 'icons/botanica/gramineas.svg', 'pos' => 'bl',
          'size' => 'clamp(9rem, 20vw, 16rem)', 'opacity' => '.045',
          'float' => 28, 'rot' => 5, 'scrub' => 1.6,
      ]);
      ?>
      <div class="wrap" style="max-width:54rem">
        <?php if ($detalle) : ?>
          <?php fg_project_specs($detalle['specs']); ?>
        <?php endif; ?>

        <?php if (has_excerpt()) : ?>
          <p class="page-lead" data-reveal><?php echo esc_html(get_the_excerpt()); ?></p>
        <?php elseif ($detalle && !empty($detalle['resumen'])) : ?>
          <p class="page-lead" data-reveal><?php echo esc_html($detalle['resumen']); ?></p>
        <?php endif; ?>

        <?php the_content(); ?>

        <?php if ($detalle && !empty($detalle['reto']) && !empty($detalle['solucion'])) : ?>
          <?php fg_project_story($detalle['reto'], $detalle['solucion']); ?>
        <?php endif; ?>

        <?php if ($detalle && !empty($detalle['galeria'])) : ?>
          <?php fg_project_gallery($detalle['galeria'], get_the_title()); ?>
        <?php endif; ?>

        <?php if ($detalle && !empty($detalle['servicios'])) : ?>
          <p class="service-chips__label" data-reveal><?php esc_html_e('Servicios en este proyecto', 'fg-theme'); ?></p>
          <?php fg_service_chips($detalle['servicios']); ?>
        <?php endif; ?>

        <div class="section-cta" data-reveal>
          <?php echo fg_cta(__('Ver todos los proyectos', 'fg-theme'), fg_page_url('proyectos')); ?>
        </div>
      </div>
    </section>

    <?php
    // Proyectos relacionados: otros proyectos publicados, excluyendo el actual.
    $fg_related_q = new WP_Query([
        'post_type'      => 'proyecto',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'post__not_in'   => [get_the_ID()],
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    ]);

    if ($fg_related_q->have_posts()) :
        ?>
        <section class="section section--beige">
          <div class="wrap">
            <?php
            fg_section_heading([
                'center'     => true,
                'eyebrow'    => __('Más proyectos', 'fg-theme'),
                'title_html' => __('También te puede<br><em>interesar</em>', 'fg-theme'),
            ]);
            ?>
            <div class="grid grid--3 section-body">
              <?php
              while ($fg_related_q->have_posts()) : $fg_related_q->the_post();
                  $rel_thumb     = get_the_post_thumbnail_url(null, 'large') ?: fg_asset('proyecto-1.jpg');
                  $rel_ubicacion = get_post_meta(get_the_ID(), 'ubicacion', true) ?: 'Marbella · Costa del Sol';
                  fg_project_card([
                      'url'       => get_permalink(),
                      'image'     => $rel_thumb,
                      'image_alt' => get_the_title() . ' · ' . $rel_ubicacion,
                      'title'     => get_the_title(),
                      'meta'      => $rel_ubicacion,
                  ]);
              endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>
        </section>
    <?php endif; ?>

<?php endwhile; ?>

<?php
fg_lightbox();
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
