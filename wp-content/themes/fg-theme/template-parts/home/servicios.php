<?php
/**
 * Home · 02 Servicios — cuatro filas anchas alternadas, numeradas en romanos.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$items = [
    [
        'title' => __('Diseño y paisajismo', 'fg-theme'),
        'body'  => __('Realizamos tu proyecto de paisajismo en 3D para que puedas ver cuál será tu resultado antes de mover una sola piedra.', 'fg-theme'),
        'cta'   => __('Diseño paisajismo', 'fg-theme'),
        'url'   => fg_page_url('diseno'),
        'image' => fg_asset('card-diseno.jpg'),
        'image_alt' => __('Jardín mediterráneo con piscina diseñado por Fantastic Gardens', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/concepto-pencil.svg'),
    ],
    [
        'title' => __('Mantenimiento', 'fg-theme'),
        'body'  => __('Solo siéntate en tu jardín y disfruta de tu piscina. Tratamientos de plagas, podas, abonado y fertilización con visitas programadas.', 'fg-theme'),
        'cta'   => __('Mantenimiento', 'fg-theme'),
        'url'   => fg_page_url('mantenimiento'),
        'image' => fg_asset('card-mantenimiento-min.jpg'),
        'image_alt' => __('Jardinero podando setos en un jardín cuidado', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/poda-formacion.svg'),
    ],
    [
        'title' => __('Vivero y garden center', 'fg-theme'),
        'body'  => __('Dispondrás de la mejor selección de flores y plantas. Nuestro vivero en Ronda hará de tu jardín un verdadero oasis.', 'fg-theme'),
        'cta'   => __('Vivero', 'fg-theme'),
        'url'   => fg_page_url('vivero'),
        'image' => fg_asset('card-vivero-min.jpg'),
        'image_alt' => __('Vivero con olivos y plantas en macetas de barro', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/seleccion-local.svg'),
    ],
    [
        'title' => __('Plantación propia', 'fg-theme'),
        'body'  => __('Cultivamos en Ronda, Málaga y Valencia. Trazabilidad completa y ejemplares aclimatados que llegan al jardín con raíz fuerte.', 'fg-theme'),
        'cta'   => __('Plantación propia', 'fg-theme'),
        'url'   => fg_page_url('vivero'),
        'image' => fg_asset('card-plantacion.jpg'),
        'image_alt' => __('Plantación propia de olivos y aromáticas', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/cultivo-responsable.svg'),
    ],
];
?>
<section class="section section--beige has-wm" id="servicios">
  <?php
  // Dos planos de profundidad: la de delante recorre más y responde rápido;
  // la del fondo apenas se mueve. Esa diferencia es la que da profundidad.
  fg_watermark([
    'src' => 'icons/botanica/aromaticas.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 26vw, 28rem)', 'opacity' => '.07',
    'float' => 90, 'rot' => 4,
  ]);
  fg_watermark([
    'src' => 'icons/botanica/gramineas.svg', 'pos' => 'br',
    'size' => 'clamp(11rem, 22vw, 23rem)', 'opacity' => '.08',
    'float' => 26, 'rot' => -6,
  ]); ?>

  <div class="wrap">
    <div class="section-head section-head--split section-head--rule">
      <div>
        <?php echo fg_kicker(__('Servicios', 'fg-theme'), '02'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80">
          <?php esc_html_e('Diseñaremos el jardín', 'fg-theme'); ?><br><?php esc_html_e('de tus sueños', 'fg-theme'); ?>
        </h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Cuatro disciplinas, un mismo equipo. Del proyecto en 3D al cuidado diario, todo se resuelve dentro de casa.', 'fg-theme'); ?>
      </p>
    </div>

    <?php fg_service_rows($items); ?>
  </div>
</section>
