<?php
/*
Template Name: Historia y Nosotros
*/
if (!defined('ABSPATH')) exit;
get_header();

/* Antigüedad unificada a "más de treinta años" en todo el sitio (decisión del
   cliente, ago. 2026, actualiza la cifra de "veinte años" de jul. 2026). La
   referencia a "finales de los años ochenta" se retira porque contradecía esa
   cifra; el año exacto de fundación sigue pendiente de confirmar por el cliente. */
$fg_publicos_historia = [
  __('Particulares', 'fg-theme'),
  __('Comunidades', 'fg-theme'),
  __('Campos de golf', 'fg-theme'),
];

$body  = '<div class="split-hero__prose">';
$body .= '<p>' . esc_html__('Desde hace más de treinta años convertimos el amor por la naturaleza en jardines con ', 'fg-theme')
        . '<em class="em-verde">' . esc_html__('identidad, cuidado y permanencia', 'fg-theme') . '</em>.</p>';
$body .= '<p>' . esc_html__('Lo que comenzó como una afición por las plantas y el paisaje se transformó en Fantastic Gardens A.J. S.L., una empresa dedicada al ', 'fg-theme')
        . '<em class="em-verde">' . esc_html__('diseño, realización y mantenimiento', 'fg-theme') . '</em>'
        . esc_html__(' de espacios verdes.', 'fg-theme') . '</p>';
$body .= '<p>' . esc_html__('Nuestra experiencia incluye soluciones integrales y profesionales especializados para:', 'fg-theme') . '</p>';
$body .= '<div class="tag-row">';
foreach ($fg_publicos_historia as $fg_i_pub => $fg_p) {
    $body .= '<span class="tag-linea' . ($fg_i_pub % 2 === 1 ? ' tag-linea--tint' : '') . '"><span class="tag-linea__icon" aria-hidden="true"></span>' . esc_html($fg_p) . '</span>';
}
$body .= '</div>';
$body .= '</div>';

fg_split_hero([
  'image'               => fg_asset('vivero-ronda-vista-aerea-olivares-invernaderos.jpg'),
  'image_alt'           => __('Vista aérea del vivero de Fantastic Gardens en Ronda entre olivares', 'fg-theme'),
  'title'               => __('Nuestra Historia', 'fg-theme'),
  'title_class'         => 'is-verde',
  'subtitle'            => __('Una historia nacida en la Costa del Sol', 'fg-theme'),
  'body'                => $body,
  'mobile_image_first'  => true,
]);
?>
<section class="section section--beige has-wm" id="origen">
  <?php fg_vlines(3); ?>
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
    'size' => 'clamp(12rem, 26vw, 20rem)', 'opacity' => '.06', 'float' => 60,
  ]); ?>
  <div class="wrap">
    <div class="origin-story">
      <div class="origin-story__media" data-img-reveal>
        <img src="<?php echo esc_url(fg_asset('equipo-fantastic-gardens-vivero-ronda.jpg')); ?>" alt="<?php esc_attr_e('Equipo de Fantastic Gardens reunido en el vivero de Ronda', 'fg-theme'); ?>" loading="lazy" decoding="async">
      </div>
      <div class="origin-story__body">
        <?php echo fg_kicker(__('Nuestros orígenes', 'fg-theme'), '01'); ?>
        <p class="origin-story__quote" data-reveal data-reveal-delay="80">
          <span class="origin-story__mark" aria-hidden="true">&ldquo;</span>
          <span class="origin-story__quote-text"><?php esc_html_e('Todo empezó con una afición por las plantas, mucho antes de que existiera la empresa.', 'fg-theme'); ?></span>
        </p>
        <div class="origin-story__prose" data-reveal data-reveal-delay="160">
          <p>
            <?php esc_html_e('A finales de los años 80, esa afición familiar por la naturaleza y el paisajismo de la Costa del Sol se convirtió en Fantastic Gardens A.J. S.L. Antes de ser una empresa, fue una forma de mirar los jardines: con ', 'fg-theme'); ?><em class="em-verde"><?php esc_html_e('paciencia, oficio y cariño', 'fg-theme'); ?></em><?php esc_html_e(' por cada planta.', 'fg-theme'); ?>
          </p>
          <p><?php esc_html_e('Ese origen sigue presente en cómo trabajamos hoy, en cada uno de estos frentes:', 'fg-theme'); ?></p>
        </div>
        <?php fg_service_chips([
          ['icon' => 'icons/servicios/plantacion-destino.svg', 'label' => __('Vivero de Ronda', 'fg-theme'), 'url' => fg_page_url('vivero')],
          ['icon' => 'icons/servicios/concepto-pencil.svg',    'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
          ['icon' => 'icons/servicios/poda-formacion.svg',     'label' => __('Mantenimiento diario', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
        ]); ?>
        <span class="origin-story__caption" data-reveal data-reveal-delay="220"><?php esc_html_e('Origen · Costa del Sol', 'fg-theme'); ?></span>
      </div>
    </div>
  </div>
</section>

<?php
$valores = [
  ['icon' => 'calendar', 'title' => __('Más de treinta años de oficio', 'fg-theme'), 'desc' => __('Más de treinta años creando y cuidando jardines en la Costa del Sol.', 'fg-theme')],
  ['icon' => 'icons/servicios/concepto-pencil.svg', 'title' => __('Diseño y paisajismo', 'fg-theme'),          'desc' => __('Proyectamos espacios con identidad mediterránea, funcionales, elegantes y sostenibles.', 'fg-theme')],
  ['icon' => 'icons/servicios/poda-formacion.svg',  'title' => __('Mantenimiento especializado', 'fg-theme'),  'desc' => __('Cuidado constante, equipos propios y atención cercana para jardines que perduran en el tiempo.', 'fg-theme')],
];
?>
<section class="section section--arena has-wm">
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'cl', 'ratio' => '581 / 690',
    'size' => 'clamp(15rem, 34vw, 30rem)', 'opacity' => '.07', 'float' => 70,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'    => __('Reconocimiento', 'fg-theme'),
      'num'        => '02',
      'title_html' => esc_html__('Un reconocimiento que', 'fg-theme') . ' <em class="em-verde">' . esc_html__('compartimos con nuestros clientes', 'fg-theme') . '</em>',
      'subtitle'   => __('El Excmo. Ayuntamiento de Ronda reconoció nuestra contribución, como empresa, al desarrollo de la ciudad. Un reconocimiento institucional que sumamos a las recomendaciones que, con los años, nos han hecho llegar tantos clientes satisfechos con sus jardines.', 'fg-theme'),
    ]); ?>
    <div class="valores section-body" data-reveal>
      <?php foreach ($valores as $v) : ?>
        <div class="valor">
          <span class="valor__icon" aria-hidden="true"><?php echo fg_icon_or_asset($v['icon']); ?></span>
          <h2 class="valor__title"><?php echo esc_html($v['title']); ?></h2>
          <p class="valor__desc"><?php echo esc_html($v['desc']); ?></p>
        </div>
      <?php endforeach; ?>
      <div class="valor valor--seal">
        <img class="valor__seal" src="<?php echo esc_url(fg_asset('escudo-ronda.png')); ?>" alt="<?php esc_attr_e('Escudo del Ayuntamiento de Ronda', 'fg-theme'); ?>" loading="lazy" decoding="async">
        <h2 class="valor__title"><?php esc_html_e('Reconocimiento del Ayuntamiento de Ronda', 'fg-theme'); ?></h2>
      </div>
    </div>
  </div>
</section>

<section class="section has-wm">
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'br', 'ratio' => '581 / 690',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05', 'float' => 50,
  ]); ?>
  <div class="wrap">
    <?php
    fg_section_heading([
        'eyebrow' => __('Trayectoria', 'fg-theme'),
        'num'     => '03',
        'title'   => __('Nuestra trayectoria', 'fg-theme'),
    ]);
    fg_timeline([
        [
            'icon'  => 'icons/servicios/vegetacion-sprig.svg',
            'year'  => __('Origen', 'fg-theme'),
            'title' => __('Los orígenes', 'fg-theme'),
            'text'  => __('Inicio de actividad en la Costa del Sol. Los fundadores comienzan a trabajar en jardinería de villas y urbanizaciones de alto standing en Marbella.', 'fg-theme'),
        ],
        [
            'icon'  => 'area',
            'year'  => __('Crecimiento', 'fg-theme'),
            'title' => __('Expansión y campos de golf', 'fg-theme'),
            'text'  => __('Ampliación del equipo y los servicios. Inicio de trabajos en campos de golf de la Costa del Sol, elevando el nivel de exigencia y profesionalidad del sector.', 'fg-theme'),
        ],
        [
            'icon'  => 'icons/servicios/plantacion-destino.svg',
            'year'  => __('Vivero propio', 'fg-theme'),
            'title' => __('Vivero y plantación propia', 'fg-theme'),
            'text'  => __('Adquisición de las 40 hectáreas en Ronda. Apertura del Garden Center con 4.000 m² cubiertos y oficinas en San Pedro de Alcántara.', 'fg-theme'),
        ],
        [
            'icon'  => 'award',
            'year'  => __('Reconocimiento', 'fg-theme'),
            'title' => __('Reconocimiento y crecimiento', 'fg-theme'),
            'text'  => __('Reconocimiento oficial del Ayuntamiento de Ronda. +1.000 proyectos completados. Incorporación de tecnología 3D al servicio de diseño paisajístico.', 'fg-theme'),
        ],
        [
            'icon'  => 'pin',
            'year'  => __('Hoy', 'fg-theme'),
            'title' => __('Empresa de referencia en la Costa del Sol', 'fg-theme'),
            'text'  => __('Más de treinta años de experiencia, plantaciones en Ronda, Málaga y Valencia, equipo de ingenieros técnicos y la misma pasión por la naturaleza que nos fundó.', 'fg-theme'),
        ],
    ]);
    ?>
    <div class="section-cta" data-reveal>
      <?php echo fg_cta(__('Ver nuestros proyectos', 'fg-theme'), fg_page_url('proyectos')); ?>
      <?php echo fg_cta(__('Pedir presupuesto', 'fg-theme'), fg_page_url('contacto')); ?>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Origen · Cuidado · Permanencia', 'fg-theme'));
get_footer();
