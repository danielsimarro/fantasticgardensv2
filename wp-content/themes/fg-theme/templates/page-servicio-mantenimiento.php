<?php
/*
Template Name: Servicio Mantenimiento
*/
if (!defined('ABSPATH')) exit;
get_header();

fg_photo_hero([
  'image'         => fg_asset('corte-cesped-jardin-mantenimiento-marbella.jpg'),
  'image_alt'     => __('Cortacésped profesional dejando líneas perfectas en el jardín de una villa en Marbella', 'fg-theme'),
  'title_html'    =>
    '<span data-reveal data-reveal-delay="80">' . esc_html__('Mantenimiento', 'fg-theme') . '</span>'
    . '<span class="line-2" data-reveal data-reveal-delay="200"><em class="em-lima">' . esc_html__('a medida', 'fg-theme') . '</em></span>',
  'subtitle'      => __('Mantenemos jardines de casas, villas, comunidades y empresas en la Costa del Sol. Conocimientos fitosanitarios, técnica y maquinaria propia para que solo tenga que disfrutar del jardín.', 'fg-theme'),
  'cta'           => ['label' => __('¿Hablamos?', 'fg-theme'), 'url' => fg_page_url('contacto')],
  'cta_secondary' => ['label' => __('Ver el calendario', 'fg-theme'), 'url' => '#ritmo'],
  'tags'          => [
    __('Casas y villas', 'fg-theme'),
    __('Comunidades', 'fg-theme'),
    __('Parques y empresas', 'fg-theme'),
    __('Maquinaria propia', 'fg-theme'),
  ],
]);
?>

<section class="section has-wm" id="a-medida">
  <?php fg_watermark([
    'src' => 'icons/botanica/olivos.svg', 'pos' => 'tr',
    'size' => 'clamp(11rem, 24vw, 22rem)', 'opacity' => '.06', 'float' => 55,
  ]); ?>
  <div class="wrap home-sobre" data-reveal>
    <div class="home-sobre__media" data-img-reveal>
      <img data-kenburns src="<?php echo esc_url(fg_asset('mantenimiento-jardin-mediterraneo-marbella.jpg')); ?>" alt="<?php esc_attr_e('Jardinero de Fantastic Gardens cuidando las plantas de un jardín mediterráneo con piscina en Marbella', 'fg-theme'); ?>" loading="lazy" decoding="async">
    </div>
    <div class="home-sobre__copy">
      <?php echo fg_kicker(__('El servicio', 'fg-theme'), '01'); ?>
      <h2 class="section-head__title" data-reveal data-reveal-delay="80">
        <?php esc_html_e('Mantenimiento de jardinería', 'fg-theme'); ?><br><em class="em-verde"><?php esc_html_e('a la medida de cada jardín', 'fg-theme'); ?></em>
      </h2>
      <p class="home-estudio__lead" data-reveal data-reveal-delay="140">
        <?php esc_html_e('Para que un jardín esté bonito y acogedor todo el año hacen falta conocimientos fitosanitarios, técnica y maquinaria propia. Los tenemos todos.', 'fg-theme'); ?>
      </p>
      <p class="home-sobre__text" data-reveal data-reveal-delay="190">
        <?php esc_html_e('Nuestro equipo, cualificado y experimentado, se hace cargo de los trabajos más exigentes: casas, villas, comunidades y parques en toda la Costa del Sol.', 'fg-theme'); ?>
      </p>
      <div class="quote-aside" data-reveal data-reveal-delay="240">
        <p class="quote-aside__text"><?php esc_html_e('Un jardín no se mantiene: se acompaña temporada a temporada.', 'fg-theme'); ?></p>
        <span class="quote-aside__author"><?php esc_html_e('Fantastic Gardens', 'fg-theme'); ?></span>
      </div>
      <div class="mini-stats" data-reveal data-reveal-delay="300">
        <div class="mini-stat">
          <span class="mini-stat__num" data-count="30" data-prefix="+">+30</span>
          <span class="mini-stat__label"><?php esc_html_e('Años cuidando jardines', 'fg-theme'); ?></span>
        </div>
        <div class="mini-stat">
          <span class="mini-stat__num"><?php esc_html_e('Propia', 'fg-theme'); ?></span>
          <span class="mini-stat__label"><?php esc_html_e('Flota y maquinaria', 'fg-theme'); ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
fg_quote_band([
    'image'     => fg_asset('hero-servicios.jpg'),
    'image_alt' => __('Jardín mediterráneo mantenido por Fantastic Gardens', 'fg-theme'),
    'compact'   => true,
    'text'      => sprintf(
        /* translators: %s: la frase "mejores manos" en cursiva. */
        esc_html__('Tus plantas en las %s.', 'fg-theme'),
        '<em>' . esc_html__('mejores manos', 'fg-theme') . '</em>'
    ),
]);
?>

<section class="section section--beige has-wm" id="ritmo">
  <?php fg_watermark([
    'src' => 'icons/botanica/aromaticas.svg', 'pos' => 'bl',
    'size' => 'clamp(11rem, 24vw, 22rem)', 'opacity' => '.07', 'float' => 45,
  ]); ?>
  <div class="wrap">
    <div class="section-head section-head--split">
      <div>
        <?php echo fg_kicker(__('El ritmo del jardín', 'fg-theme'), '02'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80">
          <?php esc_html_e('Qué hacemos,', 'fg-theme'); ?> <em class="em-verde"><?php esc_html_e('y cuándo', 'fg-theme'); ?></em>
        </h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Cada contrato empieza con una visita de diagnóstico: revisamos el estado de cada especie, el sistema de riego y las necesidades del espacio antes de proponer un plan, con visitas ajustadas a la temporada.', 'fg-theme'); ?>
      </p>
    </div>

    <div class="calendar-layout">
      <div class="calendar-list">
        <?php
        $labores = [
            ['num' => 'I',   'icon' => 'poda-formacion.svg',      'title' => __('Podas y formación', 'fg-theme'),               'text' => __('Podas de formación, mantenimiento y saneado en el momento adecuado del año, incluso a gran altura con camión cesta.', 'fg-theme')],
            ['num' => 'II',  'icon' => 'salud-vegetal.svg',       'title' => __('Tratamientos fitosanitarios', 'fg-theme'),      'text' => __('Nuestros ingenieros técnicos estudian cada anomalía y preparan las mezclas en su justa medida: ni en exceso, ni en defecto.', 'fg-theme')],
            ['num' => 'III', 'icon' => 'cultivo-responsable.svg', 'title' => __('Abonado y fertilización', 'fg-theme'),          'text' => __('Abonos de gran calidad, equilibrados en los tres elementos básicos del jardín: nitrógeno, fósforo y potasio.', 'fg-theme')],
            ['num' => 'IV',  'icon' => 'riego-eficiente.svg',     'title' => __('Riego y control de humedad', 'fg-theme'),       'text' => __('Ajustamos programaciones y revisamos el sistema para evitar el exceso de humedad en el suelo y el desperdicio de agua.', 'fg-theme')],
            ['num' => 'V',   'icon' => 'materiales-stones.svg',   'title' => __('Suelo limpio y sustratos sanos', 'fg-theme'),   'text' => __('Eliminamos malas hierbas, plantas enfermas y restos de cultivo; trabajamos con sustratos desinfectados y material vegetal garantizado.', 'fg-theme')],
            ['num' => 'VI',  'icon' => 'visitas-programadas.svg', 'title' => __('Visitas programadas', 'fg-theme'),              'text' => __('Un calendario propio para cada jardín, con registro de cada visita y recomendaciones antes de que el problema aparezca.', 'fg-theme')],
        ];
        foreach ($labores as $i => $l) : ?>
          <div class="calendar-item" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 60)); ?>">
            <span class="calendar-item__num" aria-hidden="true"><?php echo esc_html($l['num']); ?></span>
            <img class="calendar-item__icon" src="<?php echo esc_url(fg_asset('icons/servicios/' . $l['icon'])); ?>" alt="" loading="lazy" decoding="async">
            <div>
              <h3 class="calendar-item__title"><?php echo esc_html($l['title']); ?></h3>
              <p class="calendar-item__text"><?php echo esc_html($l['text']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="calendar-media" data-img-reveal>
        <img data-kenburns src="<?php echo esc_url(fg_asset('jardinero-plantacion-jardin-grava-marbella.jpg')); ?>" alt="<?php esc_attr_e('Jardinero de Fantastic Gardens plantando en un jardín de grava en Marbella', 'fg-theme'); ?>" loading="lazy" decoding="async">
      </div>
    </div>
  </div>
</section>

<section class="section section--osc has-wm" id="maquinaria">
  <?php fg_watermark([
    'src' => 'icons/servicios/direccion-obra-helmet.svg', 'pos' => 'tr',
    'size' => 'clamp(11rem, 22vw, 20rem)', 'opacity' => '.05', 'color' => 'var(--crema)',
    'float' => 40, 'rot' => 8,
  ]); ?>
  <?php fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(10rem, 20vw, 22rem)', 'opacity' => '.05', 'color' => 'var(--crema)',
    'float' => 30, 'rot' => -8,
  ]); ?>
  <div class="wrap">
    <div class="section-head section-head--split">
      <div>
        <?php echo fg_kicker(__('Personal y maquinaria', 'fg-theme'), '03', 'light'); ?>
        <h2 class="section-head__title" data-reveal data-reveal-delay="80">
          <?php esc_html_e('Disponemos del personal', 'fg-theme'); ?><br><em class="em-lima"><?php esc_html_e('y de la maquinaria', 'fg-theme'); ?></em>
        </h2>
      </div>
      <p class="section-head__sub" data-reveal data-reveal-delay="160">
        <?php esc_html_e('Contamos con la maquinaria más moderna y precisa para toda clase de trabajos de ajardinamiento, garantizando rapidez y eficacia.', 'fg-theme'); ?>
      </p>
    </div>

    <div class="rows-osc rows-osc--media">
      <?php
      $flota = [
          ['num' => '01', 'title' => __('Camiones cerrados', 'fg-theme'),  'img' => 'maquinaria-camion-cerrados.png',    'text' => __('Para transportar a nuestro personal y sus plantas en las condiciones más óptimas y en el menor tiempo posible.', 'fg-theme')],
          ['num' => '02', 'title' => __('Camiones de transporte', 'fg-theme'), 'img' => 'maquinaria-camion-transporte.png', 'text' => __('Traslado de materiales y plantas de gran volumen hasta la obra, en las condiciones adecuadas para que lleguen listos para plantarse.', 'fg-theme')],
          ['num' => '03', 'title' => __('Camión pluma', 'fg-theme'),       'img' => 'maquinaria-camion-pluma.png',       'text' => __('Colocación de plantas de gran porte exactamente en el lugar deseado, junto a potentes retroexcavadoras para obras de envergadura.', 'fg-theme')],
          ['num' => '04', 'title' => __('Tractores y maquinaria pesada', 'fg-theme'), 'img' => 'maquinaria-tractor.png', 'text' => __('Tractores, mini-excavadoras, bivalvas y cualquier otra maquinaria necesaria para ejecutar el trabajo de la forma más competente.', 'fg-theme')],
      ];
      foreach ($flota as $i => $m) :
        $flip = $i % 2 === 1;
        ?>
        <div class="row-osc<?php echo $flip ? ' row-osc--flip' : ''; ?>" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 70)); ?>">
          <div class="row-osc__media" data-img-reveal>
            <span class="row-osc__glow" aria-hidden="true"></span>
            <img data-parallax="0.04" src="<?php echo esc_url(fg_asset($m['img'])); ?>" alt="<?php echo esc_attr($m['title']); ?>" loading="lazy" decoding="async">
          </div>
          <div class="row-osc__body">
            <div class="row-osc__head">
              <span class="row-osc__bignum" aria-hidden="true"><?php echo esc_html($m['num']); ?></span>
              <span class="row-osc__num"><?php echo esc_html($m['num']); ?></span>
              <h3 class="row-osc__title"><?php echo esc_html($m['title']); ?></h3>
            </div>
            <p class="row-osc__text"><?php echo esc_html($m['text']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="quote-strip">
      <p class="quote-strip__text" data-reveal><span class="quote-strip__mark" aria-hidden="true">&rdquo;</span><?php esc_html_e('Conseguimos la más alta calidad para que nuestros clientes estén siempre satisfechos.', 'fg-theme'); ?></p>
      <span class="quote-strip__author"><?php esc_html_e('Fantastic Gardens', 'fg-theme'); ?></span>
    </div>
  </div>
</section>

<section class="section has-wm" id="cuidados">
  <?php fg_watermark([
    'src' => 'icons/botanica/gramineas.svg', 'pos' => 'tr',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05', 'float' => 50,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'  => __('Cuidados', 'fg-theme'),
      'num'      => '04',
      'title'    => __('Técnicos especializados, producto justo', 'fg-theme'),
      'subtitle' => __('Plagas, podas, abonado y fertilización con las herramientas y productos más modernos y eficaces, siempre con criterio técnico y sin excesos.', 'fg-theme'),
    ]); ?>
    <div class="care-grid">
      <div class="care-item" data-reveal data-reveal-delay="60">
        <span class="home-estudio__point-icon care-item__icon" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/direccion-obra-helmet.svg')); ?>" alt="" loading="lazy" decoding="async">
        </span>
        <h3 class="care-item__title"><?php esc_html_e('Ingeniería técnica', 'fg-theme'); ?></h3>
        <p class="care-item__text"><?php esc_html_e('Cada vez que se observa una anomalía en una planta, un ingeniero técnico visita el jardín, estudia el problema y aconseja qué prácticas realizar.', 'fg-theme'); ?></p>
      </div>
      <div class="care-item" data-reveal data-reveal-delay="130">
        <span class="home-estudio__point-icon care-item__icon" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/salud-vegetal.svg')); ?>" alt="" loading="lazy" decoding="async">
        </span>
        <h3 class="care-item__title"><?php esc_html_e('Herramienta moderna', 'fg-theme'); ?></h3>
        <p class="care-item__text"><?php esc_html_e('Técnicos especializados en plagas, podas, abonado y fertilización, con las herramientas y productos más eficaces del mercado.', 'fg-theme'); ?></p>
      </div>
      <div class="care-item" data-reveal data-reveal-delay="200">
        <span class="home-estudio__point-icon care-item__icon" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/cultivo-responsable.svg')); ?>" alt="" loading="lazy" decoding="async">
        </span>
        <h3 class="care-item__title"><?php esc_html_e('Cultivo limpio', 'fg-theme'); ?></h3>
        <p class="care-item__text"><?php esc_html_e('Retiramos plantas enfermas y restos de cultivo, cuidamos la humedad del suelo y trabajamos siempre pensando en el medio ambiente.', 'fg-theme'); ?></p>
      </div>
      <div class="care-item" data-reveal data-reveal-delay="270">
        <span class="home-estudio__point-icon care-item__icon" aria-hidden="true">
          <img src="<?php echo esc_url(fg_asset('icons/servicios/trazabilidad.svg')); ?>" alt="" loading="lazy" decoding="async">
        </span>
        <h3 class="care-item__title"><?php esc_html_e('Material garantizado', 'fg-theme'); ?></h3>
        <p class="care-item__text"><?php
          printf(
              /* translators: %s: enlace a "vivero y plantación propia". */
              wp_kses(__('Semillas, esquejes y bulbos sanos y garantizados desde nuestro propio %s.', 'fg-theme'), ['a' => []]),
              '<a href="' . esc_url(fg_page_url('vivero')) . '">' . esc_html__('vivero y plantación propia', 'fg-theme') . '</a>'
          );
        ?></p>
      </div>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Mantenimiento · Costa del Sol', 'fg-theme'));
get_footer();
