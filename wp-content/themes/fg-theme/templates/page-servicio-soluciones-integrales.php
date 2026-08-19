<?php
/*
Template Name: Servicio Soluciones Integrales
*/
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php
fg_photo_hero([
  'image'         => fg_asset('hero-servicios.jpg'),
  'image_alt'     => __('Jardín mediterráneo de una villa al atardecer', 'fg-theme'),
  'title_html'    => esc_html__('Soluciones', 'fg-theme') . ' <em class="em-lima">' . esc_html__('integrales', 'fg-theme') . '</em>',
  'accent_rule'   => true,
  'subtitle'      => __('Un único interlocutor, del diseño al mantenimiento', 'fg-theme'),
  'subtitle_lead' => true,
  'pill_cta'      => true,
  'row_plain'     => true,
  'cta'           => ['label' => __('Contarnos su proyecto', 'fg-theme'), 'url' => fg_page_url('contacto')],
]);
?>
<section class="section has-wm section--tight-b">
  <?php fg_watermark([
    'src' => 'icons/servicios/vegetacion-sprig.svg', 'pos' => 'cl',
    'size' => 'clamp(12rem, 28vw, 24rem)', 'opacity' => '.06', 'float' => 65,
  ]); ?>
  <div class="wrap split-intro">
    <div class="split-intro__aside">
      <?php echo fg_kicker(__('Cómo trabajamos', 'fg-theme'), '01'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Todo su jardín, con un solo equipo', 'fg-theme'); ?>
      </h2>
      <p class="split-intro__lead" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Diseño, obra, plantación con vivero propio y mantenimiento continuado: coordinamos cada fase para que no tenga que gestionar distintos proveedores. Un mismo equipo acompaña su jardín desde la primera idea hasta el cuidado del día a día.', 'fg-theme'); ?>
      </p>
      <div class="split-intro__cta" data-reveal data-reveal-delay="260">
        <?php echo fg_cta(__('Cuéntenos su proyecto', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
      </div>
    </div>

    <ol class="numbered-grid">
      <?php
      $pasos = [
        __('Diseño de paisajismo en AutoCAD, 3D y fotomontaje', 'fg-theme'),
        __('Obra y preparación del terreno', 'fg-theme'),
        __('Plantación con ejemplares de nuestro vivero propio en Ronda', 'fg-theme'),
        __('Riego y automatización', 'fg-theme'),
        __('Mantenimiento programado tras la entrega', 'fg-theme'),
        __('Un único punto de contacto durante todo el proceso', 'fg-theme'),
      ];
      $romanos = ['I', 'II', 'III', 'IV', 'V', 'VI'];
      foreach ($pasos as $i => $paso) :
        $num = $romanos[$i] ?? sprintf('%02d', $i + 1);
        ?>
        <li class="numbered-grid__item" data-reveal data-reveal-delay="<?php echo esc_attr((string) (60 + $i * 40)); ?>">
          <span class="numbered-grid__bignum" aria-hidden="true"><?php echo esc_html($num); ?></span>
          <span class="numbered-grid__num" aria-hidden="true"><?php echo esc_html($num); ?></span>
          <span class="numbered-grid__text"><?php echo esc_html($paso); ?></span>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
<?php
$servicios_relacionados = [
  ['num' => '01', 'title' => __('Diseño de paisajes', 'fg-theme'), 'url' => fg_page_url('diseno'),        'image' => fg_asset('diseno-paisajismo-planos-jardin-marbella.jpg'), 'image_alt' => __('Diseñador de Fantastic Gardens comparando el plano de un jardín con el resultado final en Marbella', 'fg-theme')],
  ['num' => '02', 'title' => __('Mantenimiento', 'fg-theme'),      'url' => fg_page_url('mantenimiento'), 'image' => fg_asset('mantenimiento-jardin-mediterraneo-marbella.jpg'), 'image_alt' => __('Jardinero de Fantastic Gardens cuidando las plantas de un jardín mediterráneo con piscina en Marbella', 'fg-theme')],
  ['num' => '03', 'title' => __('Vivero y plantación propia', 'fg-theme'), 'url' => fg_page_url('vivero'), 'image' => fg_asset('card-plantacion.jpg'),   'image_alt' => __('Hileras de olivos en plantación propia', 'fg-theme')],
];
?>
<section class="section section--beige">
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow' => __('El servicio, por partes', 'fg-theme'),
      'num'     => '02',
      'title'   => __('Cada fase, explicada', 'fg-theme'),
    ]); ?>
    <div class="grid grid--3">
      <?php foreach ($servicios_relacionados as $it) fg_service_tile($it); ?>
    </div>
  </div>
</section>
<?php
$obra_extra = [
  [
    'title'     => __('Muros y escaleras', 'fg-theme'),
    'body'      => __('Construcción y diseño de muros y escaleras que combinan funcionalidad con estética: muros robustos que garantizan privacidad y seguridad, y escaleras que se integran con armonía en el paisaje.', 'fg-theme'),
    'image'     => fg_asset('muro-piedra-escalinata-jardin-villa-marbella.jpg'),
    'image_alt' => __('Muro de piedra natural con escalinata de madera en el jardín de una villa en Marbella', 'fg-theme'),
  ],
  [
    'title'     => __('Caminos', 'fg-theme'),
    'body'      => __('Caminos de piedra de canto rodado decorativa, en distintos colores y tamaños, que conectan las zonas del jardín con durabilidad y un atractivo visual pensado para complementar el entorno natural.', 'fg-theme'),
    'image'     => fg_asset('camino-piedra-jardin-palmeras-marbella.jpg'),
    'image_alt' => __('Camino de piedra decorativa entre palmeras junto a un muro de piedra natural en un jardín de Marbella', 'fg-theme'),
  ],
  [
    'title'     => __('Taludes', 'fg-theme'),
    'body'      => __('Estabilización y ajardinamiento de desniveles y pendientes, con soluciones de contención y plantación que se adaptan a la topografía de cada parcela.', 'fg-theme'),
    'image'     => fg_asset('villa-mediterranea-marbella-piscina-pergola-jardin.jpg'),
    'image_alt' => __('Jardín de una villa mediterránea en Marbella con muro de contención de piedra y desnivel ajardinado', 'fg-theme'),
  ],
];
?>
<section class="section section--arena has-wm">
  <?php fg_watermark([
    'src' => 'icons/servicios/materiales-stones.svg', 'pos' => 'br',
    'size' => 'clamp(11rem, 22vw, 20rem)', 'opacity' => '.06', 'float' => 45,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'  => __('Obra y estructura', 'fg-theme'),
      'num'      => '03',
      'title'    => __('Muros, escaleras, caminos y taludes', 'fg-theme'),
      'subtitle' => __('La parte constructiva del jardín, con el mismo criterio de calidad que el diseño y la plantación.', 'fg-theme'),
    ]); ?>
    <div class="grid grid--3" style="margin-top:2.5rem">
      <?php foreach ($obra_extra as $it) : ?>
        <?php fg_card_link([
          'title'     => $it['title'],
          'body'      => $it['body'],
          'image'     => $it['image'],
          'image_alt' => $it['image_alt'],
          'url'       => fg_page_url('contacto') . '#formulario',
        ]); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
