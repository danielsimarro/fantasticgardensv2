<?php
/*
Template Name: Vivero y Plantación Propia
*/
if (!defined('ABSPATH')) exit;
get_header();

fg_split_hero([
  'image'        => fg_asset('vivero-garden-center-fantastic-gardens-ronda-fachada.jpg'),
  'image_alt'    => __('Fachada de los invernaderos del vivero y garden center de Fantastic Gardens en Ronda', 'fg-theme'),
  'mobile_image_first' => true,
  'title'        => __('Vivero y Plantación Propia', 'fg-theme'),
  'subtitle'     => __('Nuestro Garden Center de Ronda, una selección botánica con carácter mediterráneo', 'fg-theme'),
  'body'         => '<div class="split-hero__actions">' . fg_pill(__('Descubrir especies', 'fg-theme'), fg_page_url('especies'), 'verde') . '</div>',
  'overlay_note' => '<div id="leaf-field" class="leaf-field" aria-hidden="true"></div>',
  'watermark'    => [
    'src' => 'hojita.svg', 'pos' => 'bl', 'ratio' => '581 / 690',
    'size' => 'clamp(13rem, 26vw, 22rem)', 'opacity' => '.07', 'float' => 45,
  ],
]);

// Banda de cifras (contadores animados): datos reales del vivero.
fg_stats_band([
  ['num' => '4.000 m²', 'count' => 4000,  'sep' => '.', 'suffix' => ' m²', 'label' => __('Cubiertos en Ronda', 'fg-theme')],
  ['num' => '+40 ha',   'count' => 40,    'prefix' => '+', 'suffix' => ' ha', 'label' => __('De plantación propia', 'fg-theme')],
  ['num' => '17.000',   'count' => 17000, 'sep' => '.',    'label' => __('Especies distintas', 'fg-theme')],
  ['num' => '+30',      'count' => 30,    'prefix' => '+', 'label' => __('Años de experiencia', 'fg-theme')],
], [
  'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
  'size' => 'clamp(10rem, 22vw, 20rem)', 'opacity' => '.10', 'color' => 'var(--crema)', 'float' => 40,
], 2800);
?>

<section class="section has-wm">
  <?php fg_watermark([
    'src'     => 'hojita.svg', 'pos' => 'br', 'ratio' => '581 / 690',
    'size'    => 'clamp(11rem, 24vw, 20rem)', 'opacity' => '.06', 'float' => 50,
  ]); ?>
  <div class="wrap home-sobre" data-reveal>
    <div class="home-sobre__media" data-img-reveal>
      <img data-kenburns src="<?php echo esc_url(fg_asset('garden-center-ronda-invernaderos-vista-aerea.jpg')); ?>" alt="<?php esc_attr_e('Vista aérea de los invernaderos del Garden Center de Fantastic Gardens en Ronda', 'fg-theme'); ?>" loading="lazy" decoding="async">
    </div>
    <div class="home-sobre__copy">
      <?php fg_section_heading([
        'eyebrow'  => __('Garden Center · Ronda', 'fg-theme'),
        'title'    => __('4.000 m² cubiertos de la mejor selección', 'fg-theme'),
        'subtitle' => __('Palmeras, árboles, coníferas, frutales, trepadoras, arbustos, acuáticas, cactus y herbáceas: toda la variedad botánica del mercado, con la mayor calidad.', 'fg-theme'),
      ]); ?>
      <?php
      $garden_center = [
        ['icon' => fg_asset('icons/botanica/especies-singulares.svg'),  'label' => __('Selección botánica', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/materiales-stones.svg'),   'label' => __('Complementos de jardín', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/cafeteria.svg'),           'label' => __('Cafetería', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/parking.svg'),             'label' => __('Parking', 'fg-theme')],
      ];
      fg_feature_row($garden_center, 'compact', true); ?>
    </div>
  </div>
</section>

<!-- Marquee de especies -->
<div class="marquee" aria-hidden="true">
 <div class="marquee__viewport">
  <div class="marquee__track" data-marquee>
    <span class="marquee__item">Washingtonia robusta</span>
    <span class="marquee__item">Washingtonia filifera</span>
    <span class="marquee__item">Cupressus sempervirens</span>
    <span class="marquee__item">Cupressus leylandii</span>
    <span class="marquee__item">Calistemo</span>
    <span class="marquee__item">Viburnum lucidum</span>
    <span class="marquee__item">Olivos</span>
    <span class="marquee__item">Aromáticas</span>
    <span class="marquee__item">Cactus</span>
    <span class="marquee__item">Frutales</span>
    <span class="marquee__item">Coníferas</span>
  </div>
 </div>
</div>

<!-- Galería horizontal fijada (pin + scroll, GSAP — solo en esta página) -->
<section class="hgallery" data-hgallery>
  <div class="hgallery__head wrap">
    <?php fg_section_heading([
      'eyebrow' => __('Un paseo por el vivero', 'fg-theme'),
      'title'   => __('Especies que cobran vida', 'fg-theme'),
    ]); ?>
  </div>
  <div class="hgallery__viewport">
    <div class="hgallery__track" data-hgallery-track>
      <?php
      $panels = [
        ['img' => 'plantacion-1.jpg',                    'name' => __('Flor de temporada', 'fg-theme'),    'meta' => __('Color bajo cubierta todo el año', 'fg-theme'),     'alt' => __('Parterres de flores de temporada en el invernadero', 'fg-theme')],
        ['img' => 'plantacion-3.jpg',                    'name' => __('Palmeras y coníferas', 'fg-theme'), 'meta' => __('Washingtonia y Cupressus en cultivo', 'fg-theme'), 'alt' => __('Palmeras y cipreses en la plantación de Ronda', 'fg-theme')],
        ['img' => 'plantacion-4.jpg',                    'name' => __('Grandes ejemplares', 'fg-theme'),   'meta' => __('Porte listo para trasplante', 'fg-theme'),         'alt' => __('Grandes ejemplares en macetón en la explanada del Garden Center', 'fg-theme')],
        ['img' => 'flores-plantas-invernadero-vivero-ronda.jpg',  'name' => __('Bajo cubierta', 'fg-theme'),        'meta' => __('4.000 m² de instalaciones', 'fg-theme'),           'alt' => __('Invernadero del vivero de Fantastic Gardens en Ronda con flores y plantas de temporada', 'fg-theme')],
        ['img' => 'plantacion-2.jpg',                    'name' => __('El Garden Center', 'fg-theme'),     'meta' => __('Un jardín para pasear', 'fg-theme'),               'alt' => __('Pabellón de madera dentro del Garden Center', 'fg-theme')],
      ];
      foreach ($panels as $p) : ?>
        <figure class="hpanel">
          <div class="hpanel__media fx-frame">
            <div class="hpanel__inner"><img src="<?php echo esc_url(fg_asset($p['img'])); ?>" alt="<?php echo esc_attr($p['alt']); ?>" loading="lazy" decoding="async"></div>
          </div>
          <figcaption class="hpanel__cap">
            <h3 class="hpanel__name"><?php echo esc_html($p['name']); ?></h3>
            <p class="hpanel__meta"><?php echo esc_html($p['meta']); ?></p>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Producción propia: qué cultivamos (foto real por familia) + cómo lo cultivamos -->
<section class="section section--beige has-wm" id="plantacion-propia">
  <?php fg_watermark([
    'src' => 'icons/botanica/olivos.svg', 'pos' => 'cl', 'ratio' => '96 / 80',
    'size' => 'clamp(14rem, 32vw, 28rem)', 'opacity' => '.06', 'float' => 70,
  ]); ?>
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow'  => __('Producción propia · Ronda', 'fg-theme'),
      'title'    => __('Más de 40 hectáreas y hasta 17.000 especies', 'fg-theme'),
      'subtitle' => __('En nuestra plantación de Ronda controlamos el correcto crecimiento de cada ejemplar, produciendo la variedad botánica que encontrará en el Garden Center con el mismo criterio de calidad.', 'fg-theme'),
    ]); ?>

    <div class="species-grid" data-reveal>
      <?php
      $especies_familias = [
        ['img' => 'especies/washingtonia-robusta-y-filifera.jpg', 'label' => __('Palmeras', 'fg-theme'), 'desc' => __('Washingtonia robusta y filifera, de 1 a 7 m de tronco.', 'fg-theme'), 'alt' => __('Washingtonias de distintos portes en macetones de piedra', 'fg-theme')],
        ['img' => 'especies/coniferas.jpg',                       'label' => __('Coníferas', 'fg-theme'), 'desc' => __('Cupressus sempervirens, leylandii y stricta, hasta 5 m de altura.', 'fg-theme'), 'alt' => __('Cipreses y coníferas de porte columnar en el vivero', 'fg-theme')],
        ['img' => 'especies/calistemo-y-viburnum-lucidum.jpg',    'label' => __('Arbustos', 'fg-theme'), 'desc' => __('Calistemo, viburnum lucidum y otras variedades de porte medio.', 'fg-theme'), 'alt' => __('Arbustos de calistemo en flor junto a viburnum de hoja brillante', 'fg-theme')],
      ];
      foreach ($especies_familias as $f) : ?>
        <figure class="species-card">
          <div class="species-card__media fx-frame" data-img-reveal>
            <img src="<?php echo esc_url(fg_asset($f['img'])); ?>" alt="<?php echo esc_attr($f['alt']); ?>" loading="lazy" decoding="async">
          </div>
          <figcaption>
            <h3 class="species-card__title"><?php echo esc_html($f['label']); ?></h3>
            <p class="species-card__desc"><?php echo esc_html($f['desc']); ?></p>
          </figcaption>
        </figure>
      <?php endforeach; ?>
      <figure class="species-card">
        <div class="species-card__media fx-frame" data-img-reveal>
          <img src="<?php echo esc_url(fg_asset('complementos-jardin-macetas-sustratos-vivero.jpg')); ?>" alt="<?php esc_attr_e('Estanterías de maceteros, sustratos y herramientas de jardín en el Garden Center de Fantastic Gardens', 'fg-theme'); ?>" loading="lazy" decoding="async">
        </div>
        <figcaption>
          <h3 class="species-card__title"><?php esc_html_e('Complementos', 'fg-theme'); ?></h3>
          <p class="species-card__desc"><?php esc_html_e('Maceteros, sustratos, herramientas y mobiliario de jardín.', 'fg-theme'); ?></p>
        </figcaption>
      </figure>
    </div>

    <div class="species-cultivo">
      <?php echo fg_kicker(__('Cómo cultivamos', 'fg-theme')); ?>
      <?php
      $plantacion = [
        ['icon' => fg_asset('icons/servicios/seleccion-local.svg'),     'label' => __('Selección local', 'fg-theme'),       'description' => __('Especies adaptadas al clima y al carácter del lugar.', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/cultivo-responsable.svg'), 'label' => __('Cultivo responsable', 'fg-theme'),   'description' => __('Prácticas sostenibles que cuidan el suelo, el agua y la biodiversidad.', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/trazabilidad.svg'),        'label' => __('Trazabilidad', 'fg-theme'),          'description' => __('Controlamos cada ejemplar desde su origen hasta su plantación.', 'fg-theme')],
        ['icon' => fg_asset('icons/servicios/plantacion-destino.svg'),  'label' => __('Plantación en destino', 'fg-theme'), 'description' => __('Equipo especializado para garantizar el mejor inicio y desarrollo.', 'fg-theme')],
      ];
      fg_feature_row($plantacion, 'detailed', true); ?>
    </div>
  </div>
</section>

<section class="section has-wm section--tight-b">
  <?php fg_watermark([
    'src' => 'icons/botanica/especies-singulares.svg', 'pos' => 'tr',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.06', 'float' => 50,
  ]); ?>
  <div class="wrap home-sobre" data-reveal>
    <div class="home-sobre__media" data-img-reveal>
      <img data-kenburns src="<?php echo esc_url(fg_asset('plantacion-pabellon.jpg')); ?>" alt="<?php esc_attr_e('Pabellón de madera dentro del Garden Center de Ronda, rodeado de flores y topiarios', 'fg-theme'); ?>" loading="lazy" decoding="async">
    </div>
    <div class="home-sobre__copy">
      <p class="eyebrow section-head__eyebrow"><?php esc_html_e('Vivero y plantación, una sola cadena', 'fg-theme'); ?></p>
      <h2 class="section-head__title"><?php esc_html_e('De la plantación de Ronda a su jardín', 'fg-theme'); ?></h2>
      <span class="accent-rule"></span>
      <p class="home-sobre__text"><?php esc_html_e('Todo lo que se cultiva en nuestras 40 hectáreas de Ronda tiene dos destinos: el Garden Center, donde puede visitarlo y elegirlo en persona, o directamente los proyectos de diseño de paisajes que desarrollamos para nuestros clientes. Un mismo origen, cuidado con el mismo criterio, sea cual sea el camino que tome cada ejemplar.', 'fg-theme'); ?></p>
      <div class="home-sobre__cta">
        <?php echo fg_cta(__('Concertar una visita', 'fg-theme'), fg_page_url('contacto')); ?>
      </div>
    </div>
  </div>
</section>

<div class="chapter-mark" aria-hidden="true">
  <span class="chapter-mark__line"></span>
  <img class="chapter-mark__leaf" src="<?php echo esc_url(fg_asset('hojita.svg')); ?>" alt="" width="14" height="17" loading="lazy" decoding="async">
  <span class="chapter-mark__line"></span>
</div>

<!-- Dos ubicaciones reales: Garden Center Ronda + oficinas San Pedro -->
<style>
.location-card .card-link__media iframe { display: block; width: 100%; height: 100%; border: 0; }
.location-card address { font-style: normal; margin-top: .75rem; color: var(--ink-soft); font-size: .875rem; line-height: 1.6; }
.location-card .cta { margin-top: 1.25rem; }
</style>
<section class="section section--tight-t">
  <div class="wrap">
    <?php fg_section_heading([
      'eyebrow' => __('Dos ubicaciones', 'fg-theme'),
      'title'   => __('Ronda y San Pedro de Alcántara', 'fg-theme'),
    ]); ?>
    <div class="grid grid--2" style="margin-top:2.5rem">

      <div class="card-link location-card" data-reveal>
        <div class="card-link__media">
          <iframe src="https://www.google.com/maps?q=<?php echo esc_attr(rawurlencode(fg_opt('address2'))); ?>&output=embed"
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen
                  title="<?php esc_attr_e('Garden Center Ronda', 'fg-theme'); ?>"></iframe>
        </div>
        <div class="card-link__body">
          <h3 class="card-link__title"><?php esc_html_e('Garden Center Ronda', 'fg-theme'); ?></h3>
          <p class="card-link__text"><?php esc_html_e('4.000 m² cubiertos con todo tipo de plantas, complementos de jardín, cafetería y zona infantil.', 'fg-theme'); ?></p>
          <address>
            <?php echo esc_html(fg_opt('address2')); ?>
          </address>
          <?php echo fg_cta(fg_opt('phone_ronda'), 'tel:' . fg_opt('phone_ronda_href')); ?>
        </div>
      </div>

      <div class="card-link location-card" data-reveal>
        <div class="card-link__media">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3207.3127471065086!2d-4.986322684412576!3d36.498311980011934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd732a044c2a3671%3A0x2200435eafdf7cf6!2sFantastic%20Gardens!5e0!3m2!1ses!2ses!4v1596282349459!5m2!1ses!2ses"
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen
                  title="<?php esc_attr_e('Oficinas San Pedro de Alcántara', 'fg-theme'); ?>"></iframe>
        </div>
        <div class="card-link__body">
          <h3 class="card-link__title"><?php esc_html_e('Oficinas San Pedro de Alcántara', 'fg-theme'); ?></h3>
          <p class="card-link__text"><?php esc_html_e('Nuestras oficinas en pleno corazón de la Costa del Sol para atenderle de forma personalizada.', 'fg-theme'); ?></p>
          <address>
            <?php echo esc_html(fg_opt('address')); ?>
          </address>
          <?php echo fg_cta(fg_opt('phone_sanpedro'), 'tel:' . fg_opt('phone_sanpedro_href')); ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
fg_site_closing(__('Selección · Suministro · Asesoramiento', 'fg-theme'));
get_footer();
