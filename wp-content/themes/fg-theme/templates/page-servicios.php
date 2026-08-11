<?php
/*
Template Name: Página de Servicios
*/
if (!defined('ABSPATH')) exit;
get_header();

fg_photo_hero([
    'image'         => 'hero-servicios.jpg',
    'image_alt'     => __('Jardín mediterráneo de una villa al atardecer', 'fg-theme'),
    'breadcrumb'    => [['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')], ['label' => __('Servicios', 'fg-theme')]],
    'title'         => __('Servicios', 'fg-theme'),
    'subtitle'      => __('Diseñamos, cuidamos y hacemos crecer espacios extraordinarios', 'fg-theme'),
    'subtitle_lead' => true,
    'row_plain'     => true,
    'stat'          => ['count' => 4, 'label' => __('áreas de trabajo', 'fg-theme')],
]);

$items = [
    ['num' => '01', 'title' => __('Diseño de paisajes', 'fg-theme'), 'url' => fg_page_url('diseno'),        'image' => fg_asset('card-diseno.jpg'),            'image_alt' => __('Jardín mediterráneo con piscina y escalinata de piedra', 'fg-theme')],
    ['num' => '02', 'title' => __('Mantenimiento', 'fg-theme'),      'url' => fg_page_url('mantenimiento'), 'image' => fg_asset('card-mantenimiento-min.jpg'), 'image_alt' => __('Jardinero podando un seto redondeado', 'fg-theme')],
    ['num' => '03', 'title' => __('Vivero', 'fg-theme'),             'url' => fg_page_url('vivero'),        'image' => fg_asset('card-vivero-min.jpg'),        'image_alt' => __('Camino de vivero con olivos y plantas en maceta', 'fg-theme')],
    ['num' => '04', 'title' => __('Plantación propia', 'fg-theme'),  'url' => fg_page_url('vivero'),        'image' => fg_asset('card-plantacion.jpg'),        'image_alt' => __('Hileras de olivos en plantación propia', 'fg-theme')],
];
?>
<section class="section" id="servicios">
  <div class="wrap">
    <h2 class="sr-only"><?php esc_html_e('Nuestros servicios', 'fg-theme'); ?></h2>
    <div class="grid grid--4">
      <?php foreach ($items as $it) fg_service_tile($it); ?>
    </div>
  </div>
</section>

<section class="section section--arena has-wm" id="obra">
  <?php fg_watermark([
    'src' => 'icons/botanica/olivos.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 26vw, 22rem)', 'opacity' => '.07', 'float' => 40,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'    => __('Y además', 'fg-theme'),
      'num'        => '05',
      'title_html' => esc_html__('Obra y proyecto', 'fg-theme') . ' <em class="em-verde">' . esc_html__('a medida', 'fg-theme') . '</em>',
      'subtitle'   => __('Más allá del jardín, resolvemos la obra que lo sostiene y le mostramos el resultado antes de empezar.', 'fg-theme'),
    ]);
    $extra = [
      ['icon' => fg_asset('icons/servicios/materiales-stones.svg'),     'label' => __('Tratamiento de taludes', 'fg-theme'),    'description' => __('Estabilización y ajardinamiento de desniveles y pendientes.', 'fg-theme')],
      ['icon' => fg_asset('icons/servicios/direccion-obra-helmet.svg'), 'label' => __('Muros y rocalla', 'fg-theme'),           'description' => __('Muros de piedra blanca y rocalla, y escaleras con vigas de madera.', 'fg-theme')],
      ['icon' => fg_asset('icons/servicios/concepto-pencil.svg'),       'label' => __('Proyectos en AutoCAD y 3D', 'fg-theme'), 'description' => __('Planos y fotomontajes para ver su jardín terminado sin compromiso.', 'fg-theme')],
      ['icon' => fg_asset('icons/servicios/riego-eficiente.svg'),       'label' => __('Riego y automatización', 'fg-theme'),    'description' => __('Sistemas eficientes que cuidan el agua y simplifican el mantenimiento.', 'fg-theme')],
    ];
    fg_feature_row($extra, 'grid'); ?>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
