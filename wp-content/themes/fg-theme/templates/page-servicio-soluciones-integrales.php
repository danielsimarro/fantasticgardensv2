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
      <div class="split-intro__media" data-img-reveal data-reveal-delay="200">
        <img src="<?php echo esc_url(fg_asset('vista-aerea-jardin-piscina-villa-mediterranea-marbella.jpg')); ?>" alt="<?php esc_attr_e('Vista aérea de una villa mediterránea en Marbella con jardín, piscina y palmeras', 'fg-theme'); ?>" loading="lazy" decoding="async">
      </div>
      <div class="split-intro__cta" data-reveal data-reveal-delay="260">
        <?php echo fg_cta(__('Cuéntenos su proyecto', 'fg-theme'), fg_page_url('contacto') . '#formulario'); ?>
      </div>
    </div>

    <?php
    fg_numbered_grid([
      __('Diseño de paisajismo en AutoCAD, 3D y fotomontaje', 'fg-theme'),
      __('Obra y preparación del terreno', 'fg-theme'),
      __('Plantación con ejemplares de nuestro vivero propio en Ronda', 'fg-theme'),
      __('Riego y automatización', 'fg-theme'),
      __('Mantenimiento programado tras la entrega', 'fg-theme'),
      __('Un único punto de contacto durante todo el proceso', 'fg-theme'),
    ]); ?>
  </div>
</section>
<?php
$obra_extra = [
  [
    'title'     => __('Muros y escaleras', 'fg-theme'),
    'body'      => __('Construcción y diseño de muros y escaleras que combinan funcionalidad con estética: muros robustos que garantizan privacidad y seguridad, y escaleras que se integran con armonía en el paisaje.', 'fg-theme'),
    'cta'       => __('Consultar muros y escaleras', 'fg-theme'),
    'image'     => fg_asset('muro-piedra-escalinata-jardin-villa-marbella.jpg'),
    'image_alt' => __('Muro de piedra natural con escalinata de madera en el jardín de una villa en Marbella', 'fg-theme'),
    'icon'      => fg_asset('icons/servicios/direccion-obra-helmet.svg'),
    'url'       => fg_page_url('contacto') . '#formulario',
  ],
  [
    'title'     => __('Caminos', 'fg-theme'),
    'body'      => __('Caminos de piedra de canto rodado decorativa, en distintos colores y tamaños, que conectan las zonas del jardín con durabilidad y un atractivo visual pensado para complementar el entorno natural.', 'fg-theme'),
    'cta'       => __('Consultar caminos', 'fg-theme'),
    'image'     => fg_asset('camino-piedra-jardin-palmeras-marbella.jpg'),
    'image_alt' => __('Camino de piedra decorativa entre palmeras junto a un muro de piedra natural en un jardín de Marbella', 'fg-theme'),
    'url'       => fg_page_url('contacto') . '#formulario',
  ],
  [
    'title'     => __('Taludes', 'fg-theme'),
    'body'      => __('Estabilización y ajardinamiento de desniveles y pendientes, con soluciones de contención y plantación que se adaptan a la topografía de cada parcela.', 'fg-theme'),
    'cta'       => __('Consultar taludes', 'fg-theme'),
    'image'     => fg_asset('talud-ajardinado-muro-contencion-jardin-marbella.jpg'),
    'image_alt' => __('Talud ajardinado en terrazas con muros de contención, escalera y palmeras en el jardín de una villa en Marbella', 'fg-theme'),
    'icon'      => fg_asset('icons/servicios/materiales-stones.svg'),
    'url'       => fg_page_url('contacto') . '#formulario',
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
      'num'      => '02',
      'title'    => __('La obra que sostiene cada jardín', 'fg-theme'),
      'subtitle' => __('Muros, escaleras, caminos y taludes: la parte constructiva del jardín, resuelta con el mismo criterio de calidad que el diseño y la plantación.', 'fg-theme'),
    ]); ?>
    <div style="margin-top:2.5rem">
      <?php fg_service_rows($obra_extra); ?>
    </div>
  </div>
</section>
<?php
fg_site_closing(__('Marbella · Costa del Sol', 'fg-theme'));
get_footer();
