<?php
/*
Template Name: Catálogo de Especies
*/
/**
 * Página · Descubrir especies (catálogo interactivo del vivero).
 *
 * Los datos viven en inc/especies.php. Cada ficha se imprime dentro de un
 * <details> para que funcione sin JavaScript y sea navegable con teclado;
 * si hay JavaScript, especies.js la eleva a una ventana modal (<dialog>).
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
get_header();

$familias = fg_especies_familias();
$especies = fg_especies();
$datos    = fg_especies_datos();

fg_photo_hero([
  'image'      => fg_especie_img('aromaticas-cactus-y-frutales.jpg'),
  'image_alt'  => __('Aromáticas, cactus y frutales agrupados en el vivero de Ronda', 'fg-theme'),
  'title'      => __('Descubrir especies', 'fg-theme'),
  'subtitle'   => __('Una selección del vivero, familia a familia. Abra cualquier ficha para ver sus necesidades de luz, riego y clima, y los usos que mejor le sientan en un jardín.', 'fg-theme'),
]);
?>

<section class="section especies-section has-wm">
  <?php
  fg_watermark([
    'src' => 'icons/botanica/aromaticas.svg', 'pos' => 'tr',
    'size' => 'clamp(11rem, 24vw, 20rem)', 'opacity' => '.055',
    'float' => 90, 'rot' => -4, 'scrub' => 0.35,
  ]);
  fg_watermark([
    'src' => 'icons/botanica/especies-singulares.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 26vw, 22rem)', 'opacity' => '.05', 'float' => 70,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'  => __('Catálogo', 'fg-theme'),
      'title'    => __('Elija por familia', 'fg-theme'),
      'subtitle' => __('Filtre por el tipo de planta que busca y pulse sobre cualquier fotografía para abrir su ficha.', 'fg-theme'),
      'center'   => true,
    ]); ?>

    <!-- Filtros -->
    <div class="especies-filtros" role="group" aria-label="<?php esc_attr_e('Filtrar por familia', 'fg-theme'); ?>" data-especies-filtros>
      <button type="button" class="chip is-active" data-filtro="todas" aria-pressed="true"><?php esc_html_e('Todas', 'fg-theme'); ?></button>
      <?php foreach ($familias as $key => $f) : ?>
        <button type="button" class="chip" data-filtro="<?php echo esc_attr($key); ?>" aria-pressed="false"><?php echo esc_html($f['nombre']); ?></button>
      <?php endforeach; ?>
    </div>

    <p class="especies-aviso" data-especies-vacio hidden><?php esc_html_e('No hay especies en esa familia todavía.', 'fg-theme'); ?></p>

    <?php foreach ($familias as $key => $f) :
      $de_familia = array_values(array_filter($especies, static fn($e) => $e['familia'] === $key)); ?>
      <section class="familia" data-familia="<?php echo esc_attr($key); ?>">
        <div class="familia__head" data-reveal>
          <div class="familia__media">
            <img data-img-reveal src="<?php echo esc_url(fg_especie_img($f['img'])); ?>" alt="<?php echo esc_attr($f['alt']); ?>" loading="lazy" decoding="async">
          </div>
          <div class="familia__text">
            <h2 class="familia__title"><?php echo esc_html($f['nombre']); ?></h2>
            <span class="accent-rule"></span>
            <p class="familia__intro"><?php echo esc_html($f['intro']); ?></p>
          </div>
        </div>

        <?php if ($de_familia) : ?>
          <div class="especies-grid">
            <?php foreach ($de_familia as $e) : ?>
              <details class="especie" data-especie="<?php echo esc_attr($e['slug']); ?>">
                <summary class="especie__card">
                  <span class="especie__media fx-frame">
                    <img src="<?php echo esc_url(fg_especie_img($e['img'])); ?>" alt="<?php echo esc_attr($e['alt']); ?>" loading="lazy" decoding="async">
                  </span>
                  <span class="especie__cap">
                    <span class="especie__nombre"><?php echo esc_html($e['nombre']); ?></span>
                    <em class="especie__botanico"><?php echo esc_html($e['botanico']); ?></em>
                    <span class="especie__mas" aria-hidden="true"><?php esc_html_e('Ver ficha', 'fg-theme'); ?></span>
                  </span>
                </summary>

                <div class="ficha" data-ficha>
                  <div class="ficha__media">
                    <img src="<?php echo esc_url(fg_especie_img($e['img'])); ?>" alt="<?php echo esc_attr($e['alt']); ?>" loading="lazy" decoding="async">
                  </div>
                  <div class="ficha__body">
                    <p class="eyebrow ficha__familia"><?php echo esc_html($f['nombre']); ?></p>
                    <h3 class="ficha__nombre"><?php echo esc_html($e['nombre']); ?></h3>
                    <p class="ficha__botanico"><em><?php echo esc_html($e['botanico']); ?></em></p>
                    <span class="accent-rule"></span>
                    <p class="ficha__resumen"><?php echo esc_html($e['resumen']); ?></p>

                    <dl class="ficha__datos">
                      <?php foreach ($datos as $campo => $meta) : ?>
                        <div class="dato">
                          <dt class="dato__label">
                            <img class="dato__icon" src="<?php echo esc_url(fg_asset($meta['icon'])); ?>" alt="" aria-hidden="true">
                            <?php echo esc_html($meta['label']); ?>
                          </dt>
                          <dd class="dato__valor"><?php echo esc_html($e[$campo]); ?></dd>
                        </div>
                      <?php endforeach; ?>
                    </dl>

                    <div class="ficha__bloque">
                      <h4 class="ficha__sub"><?php esc_html_e('Cualidades', 'fg-theme'); ?></h4>
                      <ul class="tags">
                        <?php foreach ($e['cualidades'] as $c) : ?><li class="tag"><?php echo esc_html($c); ?></li><?php endforeach; ?>
                      </ul>
                    </div>

                    <div class="ficha__bloque">
                      <h4 class="ficha__sub"><?php esc_html_e('Usos recomendados', 'fg-theme'); ?></h4>
                      <ul class="tags tags--linea">
                        <?php foreach ($e['usos'] as $u) : ?><li class="tag tag--linea"><?php echo esc_html($u); ?></li><?php endforeach; ?>
                      </ul>
                    </div>

                    <?php if (!empty($e['nota'])) : ?>
                      <p class="ficha__nota"><?php echo esc_html($e['nota']); ?></p>
                    <?php endif; ?>

                    <div class="ficha__acciones">
                      <?php echo fg_cta(
                        __('Consultar disponibilidad', 'fg-theme'),
                        add_query_arg('especie', rawurlencode($e['nombre'] . ' (' . $e['botanico'] . ')'), fg_page_url('contacto'))
                      ); ?>
                      <button type="button" class="btn-seleccion" data-add-especie="<?php echo esc_attr($e['nombre'] . ' (' . $e['botanico'] . ')'); ?>">
                        <?php esc_html_e('Incluir en mi proyecto', 'fg-theme'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </details>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <p class="familia__pendiente">
            <?php esc_html_e('Consúltenos las variedades disponibles de esta familia.', 'fg-theme'); ?>
            <?php echo fg_cta(__('Preguntar por disponibilidad', 'fg-theme'), fg_page_url('contacto')); ?>
          </p>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  </div>
</section>

<!-- Bandeja de selección: se muestra sola al añadir la primera especie -->
<div class="seleccion" data-seleccion hidden>
  <div class="wrap seleccion__inner">
    <p class="seleccion__texto">
      <span class="seleccion__num" data-seleccion-num>0</span>
      <span data-seleccion-label><?php esc_html_e('especies en su proyecto', 'fg-theme'); ?></span>
    </p>
    <ul class="seleccion__lista" data-seleccion-lista></ul>
    <div class="seleccion__acciones">
      <button type="button" class="seleccion__vaciar" data-seleccion-vaciar><?php esc_html_e('Vaciar', 'fg-theme'); ?></button>
      <a class="seleccion__enviar" href="<?php echo esc_url(fg_page_url('contacto')); ?>" data-seleccion-enviar><?php esc_html_e('Pedir presupuesto', 'fg-theme'); ?></a>
    </div>
  </div>
</div>

<!-- Ventana de ficha (la rellena especies.js) -->
<dialog class="ficha-modal" data-ficha-modal aria-label="<?php esc_attr_e('Ficha de la especie', 'fg-theme'); ?>">
  <button type="button" class="ficha-modal__cerrar" data-ficha-cerrar aria-label="<?php esc_attr_e('Cerrar ficha', 'fg-theme'); ?>">&times;</button>
  <div class="ficha-modal__contenido" data-ficha-destino></div>
</dialog>

<?php
fg_site_closing(__('Selección · Suministro · Asesoramiento', 'fg-theme'));
get_footer();
