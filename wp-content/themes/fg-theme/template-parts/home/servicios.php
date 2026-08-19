<?php
/**
 * Home · 02 Servicios — tres filas anchas alternadas, numeradas en romanos.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

$items = [
    [
        'title' => __('Diseño y paisajismo', 'fg-theme'),
        'body'  => __('Realizamos tu proyecto de paisajismo con infografía y 3D para que puedas ver el resultado final de tu jardín.', 'fg-theme'),
        'cta'   => __('Diseño paisajismo', 'fg-theme'),
        'url'   => fg_page_url('diseno'),
        'image' => fg_asset('diseno-paisajismo-planos-jardin-marbella.jpg'),
        'image_alt' => __('Diseñador de Fantastic Gardens comparando el plano de un jardín con el resultado final en Marbella', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/concepto-pencil.svg'),
    ],
    [
        'title' => __('Mantenimiento', 'fg-theme'),
        'body'  => __('Solo siéntate en tu jardín y disfruta de tu piscina. Tratamientos de plagas, podas, abonado y fertilización con visitas programadas.', 'fg-theme'),
        'cta'   => __('Mantenimiento', 'fg-theme'),
        'url'   => fg_page_url('mantenimiento'),
        'image' => fg_asset('mantenimiento-jardin-mediterraneo-marbella.jpg'),
        'image_alt' => __('Jardinero de Fantastic Gardens cuidando las plantas de un jardín mediterráneo con piscina en Marbella', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/poda-formacion.svg'),
    ],
    [
        'title' => __('Vivero y plantación propia', 'fg-theme'),
        'body'  => __('Dispondrás de la mejor selección de flores y plantas en nuestro vivero de Ronda. Cultivamos también en Málaga y Valencia, con trazabilidad completa y ejemplares aclimatados que llegan a tu jardín con raíz fuerte.', 'fg-theme'),
        'cta'   => __('Vivero y plantación propia', 'fg-theme'),
        'url'   => fg_page_url('vivero'),
        'image' => fg_asset('vivero-garden-center-ronda-fantastic-gardens.jpg'),
        'image_alt' => __('Invernaderos del vivero y garden center de Fantastic Gardens en Ronda con árboles y plantas en maceta', 'fg-theme'),
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
        <?php esc_html_e('Tres disciplinas, un mismo equipo. Del proyecto en 3D al cuidado diario, todo se resuelve dentro de casa.', 'fg-theme'); ?>
      </p>
    </div>

    <?php fg_service_rows($items); ?>
  </div>
</section>
