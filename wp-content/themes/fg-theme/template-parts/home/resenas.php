<?php
/**
 * Home · 06 Clientes — carrusel de reseñas.
 *
 * Los dos testimonios son reseñas reales publicadas en MundoJardinería,
 * confirmadas por el cliente. No añadir aquí texto que no venga de una
 * reseña verificada.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$resenas = [
    [
        'tone'   => 'claro',
        'icon'   => fg_asset('icons/botanica/olivos.svg'),
        'quote'  => __('Construí tres casas en España, cada una en un terreno de más de 2.000 m². Los tres jardines fueron diseñados, hechos y mantenidos por Fantastic Gardens. Estoy muy contento con la cooperación y el servicio. Se lo recomiendo a todos.', 'fg-theme'),
        'author' => __('Andrew', 'fg-theme'),
        'meta'   => __('Propietario · tres villas, +2.000 m² · reseña en MundoJardinería', 'fg-theme'),
    ],
    [
        'tone'   => 'oscuro',
        'icon'   => fg_asset('icons/servicios/concepto-pencil.svg'),
        'quote'  => __('Supieron proyectar mis ideas y mis preferencias en mi jardín a la perfección. Un trato muy cordial y cercano, a la vez que profesional y eficaz. He quedado muy satisfecha.', 'fg-theme'),
        'author' => __('Ana', 'fg-theme'),
        'meta'   => __('Propietaria · diseño y ejecución · reseña en MundoJardinería', 'fg-theme'),
    ],
    [
        'kind'      => 'cta',
        'image'     => fg_asset('villa-jardin-piscina-marbella-vista-aerea.jpg'),
        'image_alt' => __('Vista aérea de una villa en Marbella con piscina, palmeras y jardín mediterráneo', 'fg-theme'),
        'title'     => __('El próximo jardín puede ser el tuyo', 'fg-theme'),
        'cta_label' => __('Cuéntanos tu proyecto', 'fg-theme'),
        'cta_url'   => fg_page_url('contacto'),
    ],
];
?>
<section class="section has-wm" id="clientes">
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(11rem, 24vw, 26rem)', 'opacity' => '.08', 'flip' => true,
    'float' => 60, 'rot' => -6,
  ]); ?>
  <span class="home-resenas__mark" aria-hidden="true" data-parallax="0.03">&rdquo;</span>

  <div class="wrap">
    <?php echo fg_kicker(__('Clientes', 'fg-theme'), '06'); ?>

    <div class="section-head section-head--split home-resenas__head">
      <h2 class="section-head__title" data-reveal>
        <?php esc_html_e('Lo que dicen', 'fg-theme'); ?><br><em class="em-verde"><?php esc_html_e('quienes ya lo viven', 'fg-theme'); ?></em>
      </h2>
      <?php fg_rail_controls(); ?>
    </div>

    <?php fg_testimonial_rail($resenas); ?>
  </div>
</section>
