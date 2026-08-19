<?php
/*
Template Name: Contacto
*/
if (!defined('ABSPATH')) exit;

$fg_form_result = fg_process_contact_form(); // 'ok' | 'invalid' | 'mail-error' | ''
$fg_wa_href      = str_replace('+', '', fg_opt('phone_href'));

// Selector visual de servicio: icono real del sitio (mismo trazo verde que
// en Servicios/Botánica) + etiqueta, en vez de una simple píldora de texto.
$fg_servicio_chips = [
    [
        'label' => __('Diseño y paisajismo', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/concepto-pencil.svg'),
    ],
    [
        'label' => __('Mantenimiento', 'fg-theme'),
        'icon'  => fg_asset('icons/servicios/riego-eficiente.svg'),
    ],
    [
        'label' => __('Vivero y plantación', 'fg-theme'),
        'icon'  => fg_asset('icons/botanica/especies-singulares.svg'),
    ],
    [
        'label' => __('Otra consulta', 'fg-theme'),
        'icon'  => '',
    ],
];

$fg_faqs = [
    [
        'q' => __('¿El presupuesto tiene coste?', 'fg-theme'),
        'a' => __('No. La visita técnica y el presupuesto son gratuitos y sin compromiso, tanto en proyectos nuevos como en mantenimiento.', 'fg-theme'),
    ],
    [
        'q' => __('¿En qué zonas trabajan?', 'fg-theme'),
        'a' => __('En toda la Costa del Sol y la provincia de Málaga: Marbella, San Pedro de Alcántara, Estepona, Benahavís y Ronda, entre otras.', 'fg-theme'),
    ],
    [
        'q' => __('¿Cuánto tardan en responder?', 'fg-theme'),
        'a' => __('Menos de 24 horas laborables. Si es urgente, llámenos directamente a nuestras oficinas de San Pedro de Alcántara.', 'fg-theme'),
    ],
    [
        'q' => __('¿Puedo visitar el vivero y comprar plantas?', 'fg-theme'),
        'a' => __('Sí. Nuestro Garden Center de Ronda atiende visitas con cita previa; contamos con plantación propia y ejemplares de gran porte.', 'fg-theme'),
    ],
];

get_header();
?>

<?php
fg_photo_hero([
    'image'      => fg_asset('tumbonas-piscina-jardin-villa-marbella.jpg'),
    'image_alt'  => __('Tumbonas y sombrilla junto a la piscina en el jardín de una villa en Marbella', 'fg-theme'),
    'kicker'     => __('Contacto', 'fg-theme'),
    'title_html' => esc_html__('Hablemos de', 'fg-theme') . ' <em class="em-lima">' . esc_html__('su jardín', 'fg-theme') . '</em>',
    'subtitle'   => __('Presupuesto y primera visita sin compromiso en Marbella, San Pedro de Alcántara y toda la Costa del Sol. Elija cómo prefiere hablar con nosotros.', 'fg-theme'),
    'compact'    => true,
]);
?>

<!-- Cuatro vías de contacto con el mismo peso visual, superpuestas al borde
     inferior del hero: la llamada (panel oscuro), WhatsApp y correo (tarjetas
     claras) y el formulario (arena) — seguidas de las cifras de confianza. -->
<section class="contact-tiles-section">
  <div class="wrap">
    <div class="contact-tiles">

      <a class="contact-tile contact-tile--dark" href="tel:<?php echo esc_attr(fg_opt('phone_sanpedro_href')); ?>" data-reveal>
        <span class="contact-tile__num" aria-hidden="true">01</span>
        <span class="contact-tile__head">
          <span class="contact-tile__icon" aria-hidden="true">
            <?php echo fg_icon('phone'); ?>
            <span class="contact-tile__dot"><span class="contact-tile__pulse"></span></span>
          </span>
          <span class="contact-tile__eyebrow"><?php esc_html_e('Llamar ahora', 'fg-theme'); ?></span>
        </span>
        <span class="contact-tile__body">
          <span class="contact-tile__value contact-tile__value--lg"><?php echo esc_html(fg_opt('phone_sanpedro')); ?></span>
          <span class="contact-tile__foot">
            <?php echo esc_html(fg_opt('hours')); ?>
            <?php echo fg_arrow('contact-tile__arrow'); ?>
          </span>
        </span>
      </a>

      <a class="contact-tile contact-tile--light" href="https://wa.me/<?php echo esc_attr($fg_wa_href); ?>" data-reveal data-reveal-delay="80">
        <span class="contact-tile__num" aria-hidden="true">02</span>
        <span class="contact-tile__head">
          <span class="contact-tile__icon" aria-hidden="true"><?php echo fg_icon('whatsapp'); ?></span>
          <span class="contact-tile__eyebrow"><?php esc_html_e('WhatsApp', 'fg-theme'); ?></span>
        </span>
        <span class="contact-tile__body">
          <span class="contact-tile__value contact-tile__value--accent"><?php esc_html_e('Contáctenos', 'fg-theme'); ?><br><?php esc_html_e('por WhatsApp', 'fg-theme'); ?></span>
          <span class="contact-tile__foot">
            <?php esc_html_e('Respuesta el mismo día', 'fg-theme'); ?>
            <?php echo fg_arrow('contact-tile__arrow'); ?>
          </span>
        </span>
      </a>

      <a class="contact-tile contact-tile--light" href="mailto:<?php echo esc_attr(fg_opt('email')); ?>" data-reveal data-reveal-delay="160">
        <span class="contact-tile__num" aria-hidden="true">03</span>
        <span class="contact-tile__head">
          <span class="contact-tile__icon" aria-hidden="true"><?php echo fg_icon('mail'); ?></span>
          <span class="contact-tile__eyebrow"><?php esc_html_e('Correo', 'fg-theme'); ?></span>
        </span>
        <span class="contact-tile__body">
          <span class="contact-tile__value contact-tile__value--sm contact-tile__value--accent"><?php echo esc_html(fg_opt('email')); ?></span>
          <span class="contact-tile__foot">
            <?php esc_html_e('Para planos y documentación', 'fg-theme'); ?>
            <?php echo fg_arrow('contact-tile__arrow'); ?>
          </span>
        </span>
      </a>

      <a class="contact-tile contact-tile--verde" href="#formulario" data-reveal data-reveal-delay="240">
        <span class="contact-tile__num" aria-hidden="true">04</span>
        <span class="contact-tile__head">
          <span class="contact-tile__icon" aria-hidden="true"><?php echo fg_icon('form'); ?></span>
          <span class="contact-tile__eyebrow"><?php esc_html_e('Formulario · 1 minuto', 'fg-theme'); ?></span>
        </span>
        <span class="contact-tile__body">
          <span class="contact-tile__value"><?php esc_html_e('Pedir', 'fg-theme'); ?><br><?php esc_html_e('presupuesto', 'fg-theme'); ?></span>
          <span class="contact-tile__foot">
            <?php esc_html_e('Le llamamos en 24 h', 'fg-theme'); ?>
            <?php echo fg_arrow('contact-tile__arrow'); ?>
          </span>
        </span>
      </a>

    </div>

    <div class="contact-tiles-stats" data-reveal data-reveal-delay="80">
      <div class="stats-grid">
        <div class="stat"><span class="stat__num" data-count="24"><?php esc_html_e('24', 'fg-theme'); ?></span><span class="stat__label"><?php esc_html_e('Horas de respuesta laborables', 'fg-theme'); ?></span></div>
        <div class="stat"><span class="stat__num" data-count="30" data-prefix="+">+30</span><span class="stat__label"><?php esc_html_e('Años en la Costa del Sol', 'fg-theme'); ?></span></div>
        <div class="stat"><span class="stat__num" data-count="0" data-suffix=" €">0 €</span><span class="stat__label"><?php esc_html_e('Visita y presupuesto', 'fg-theme'); ?></span></div>
        <div class="stat"><span class="stat__num" data-count="2">2</span><span class="stat__label"><?php esc_html_e('Sedes: Marbella y Ronda', 'fg-theme'); ?></span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section--osc section--tight-t section--tight-b has-wm">
  <?php fg_watermark([
    'src' => 'icons/botanica/olivos.svg', 'pos' => 'tr', 'size' => 'clamp(14rem, 26vw, 29rem)',
    'opacity' => '.07', 'float' => 70, 'rot' => 3, 'scrub' => 0.35,
  ]); ?>
  <div class="wrap">
    <?php echo fg_kicker(__('Qué pasa después', 'fg-theme'), '', 'light'); ?>
    <ol class="steps steps--panel" data-reveal>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <?php echo fg_icon('phone'); ?>
          <span class="step__num">01</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Nos escribe o llama', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Un miembro del equipo recoge su solicitud el mismo día laborable.', 'fg-theme'); ?></p>
      </li>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <?php echo fg_icon('pin'); ?>
          <span class="step__num">02</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Visitamos su jardín', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Revisamos el terreno, la orientación y el riego. Sin coste y sin compromiso.', 'fg-theme'); ?></p>
      </li>
      <li class="step">
        <span class="step__ring" aria-hidden="true">
          <?php echo fg_icon('form'); ?>
          <span class="step__num">03</span>
        </span>
        <h3 class="step__title"><?php esc_html_e('Presupuesto por escrito', 'fg-theme'); ?></h3>
        <p class="step__text"><?php esc_html_e('Partidas detalladas, plazos claros y plantas de nuestro propio vivero de Ronda.', 'fg-theme'); ?></p>
      </li>
    </ol>
  </div>
</section>

<section class="form-split form-split--image-left" id="formulario">
  <div class="form-split__media" data-img-reveal>
    <img data-kenburns src="<?php echo esc_url(fg_asset('page-contacto-hero.jpg')); ?>" alt="<?php esc_attr_e('Detalle de un jardín mediterráneo con lavanda y olivos', 'fg-theme'); ?>" loading="lazy" decoding="async">
    <div class="form-split__scrim" aria-hidden="true"></div>
    <div class="form-split__quote">
      <p><?php esc_html_e('Cada jardín empieza con una conversación y un paseo por el terreno.', 'fg-theme'); ?></p>
      <div class="form-split__tags">
        <span><?php esc_html_e('Visita gratuita', 'fg-theme'); ?></span>
        <span><?php esc_html_e('Sin compromiso', 'fg-theme'); ?></span>
        <span><?php esc_html_e('Equipo propio', 'fg-theme'); ?></span>
      </div>
    </div>
  </div>

  <div class="form-split__col">
    <?php fg_section_heading([
        'eyebrow'    => __('Formulario', 'fg-theme'),
        'title_html' => esc_html__('Pida su', 'fg-theme') . ' <em class="em-verde">' . esc_html__('presupuesto', 'fg-theme') . '</em>',
        'subtitle'   => __('Cuatro datos y nos ocupamos del resto. Le llamamos en menos de 24 horas laborables.', 'fg-theme'),
    ]); ?>

    <?php if ($fg_form_result === 'ok') : ?>
      <div class="contact-form-card">
        <div class="form-notice--ok">
          <span class="form-notice__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12.5 9.5 18 20 6"/></svg>
          </span>
          <div>
            <p class="form-notice__title"><?php esc_html_e('Solicitud enviada', 'fg-theme'); ?></p>
            <p><?php esc_html_e('Gracias. Le llamamos en menos de 24 horas laborables.', 'fg-theme'); ?></p>
            <p><?php
              printf(
                /* translators: %s: enlace de WhatsApp */
                esc_html__('Si prefiere adelantar fotos del espacio, envíelas por %s y las revisamos antes de la visita.', 'fg-theme'),
                '<a href="https://wa.me/' . esc_attr($fg_wa_href) . '">WhatsApp</a>'
              );
            ?></p>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="contact-form-card">
        <?php if ($fg_form_result === 'invalid') : ?>
          <div class="form-notice--error">
            <span class="form-notice__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v5"/><circle cx="12" cy="16.2" r=".6" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="9.5"/></svg>
            </span>
            <p><?php esc_html_e('Revise los campos obligatorios (nombre, teléfono, correo y privacidad) e inténtelo de nuevo.', 'fg-theme'); ?></p>
          </div>
        <?php elseif ($fg_form_result === 'mail-error') : ?>
          <div class="form-notice--error">
            <span class="form-notice__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v5"/><circle cx="12" cy="16.2" r=".6" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="9.5"/></svg>
            </span>
            <p><?php esc_html_e('No hemos podido enviar su mensaje en este momento. Inténtelo de nuevo o llámenos directamente.', 'fg-theme'); ?></p>
          </div>
        <?php endif; ?>

        <form class="contact-form" method="post" novalidate>
          <?php wp_nonce_field('fg_contact', 'fg_contact_nonce'); ?>

          <fieldset class="field field--chips">
            <legend class="field__label"><?php esc_html_e('¿Qué necesita?', 'fg-theme'); ?></legend>
            <div class="chip-group">
              <?php foreach ($fg_servicio_chips as $fg_chip) : ?>
                <label class="chip">
                  <input type="radio" name="servicio" value="<?php echo esc_attr($fg_chip['label']); ?>">
                  <span>
                    <?php if ($fg_chip['icon']) : ?>
                      <img src="<?php echo esc_url($fg_chip['icon']); ?>" alt="" width="18" height="18" loading="lazy" decoding="async">
                    <?php else : ?>
                      <svg viewBox="0 0 24 24" fill="none" stroke="#4D7048" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 9.5a3.5 3.5 0 1 1 4.7 3.3c-.9.35-1.7 1.05-1.7 2v.4"/><circle cx="11.5" cy="18" r=".6" fill="#4D7048" stroke="none"/></svg>
                    <?php endif; ?>
                    <?php echo esc_html($fg_chip['label']); ?>
                  </span>
                </label>
              <?php endforeach; ?>
            </div>
          </fieldset>

          <div class="field-row">
            <div class="field">
              <label for="nombre" class="field__label"><?php esc_html_e('Nombre', 'fg-theme'); ?></label>
              <input type="text" id="nombre" name="nombre" autocomplete="name" placeholder="<?php esc_attr_e('María García', 'fg-theme'); ?>" required>
            </div>

            <div class="field">
              <label for="telefono" class="field__label"><?php esc_html_e('Teléfono', 'fg-theme'); ?></label>
              <input type="tel" id="telefono" name="telefono" autocomplete="tel" placeholder="<?php esc_attr_e('600 000 000', 'fg-theme'); ?>" required>
            </div>
          </div>

          <div class="field">
            <label for="email" class="field__label"><?php esc_html_e('Correo electrónico', 'fg-theme'); ?></label>
            <input type="email" id="email" name="email" autocomplete="email" placeholder="<?php esc_attr_e('maria@ejemplo.com', 'fg-theme'); ?>" required>
          </div>

          <div class="field">
            <label for="localidad" class="field__label"><?php esc_html_e('Localidad', 'fg-theme'); ?> <span class="field__optional"><?php esc_html_e('(opcional)', 'fg-theme'); ?></span></label>
            <input type="text" id="localidad" name="localidad" autocomplete="address-level2" placeholder="<?php esc_attr_e('Marbella, Estepona…', 'fg-theme'); ?>">
          </div>

          <div class="field">
            <label for="mensaje" class="field__label"><?php esc_html_e('Cuéntenos su espacio', 'fg-theme'); ?> <span class="field__optional"><?php esc_html_e('(opcional)', 'fg-theme'); ?></span></label>
            <textarea id="mensaje" name="mensaje" rows="3" placeholder="<?php esc_attr_e('Superficie aproximada, qué le gustaría conseguir…', 'fg-theme'); ?>"></textarea>
          </div>

          <label class="field-check">
            <input type="checkbox" name="privacidad" value="1" required>
            <span><?php
              printf(
                /* translators: %s: enlace a la política de privacidad */
                esc_html__('He leído y acepto la %s. Sus datos solo se usan para responder a esta solicitud.', 'fg-theme'),
                '<a href="' . esc_url(fg_page_url('privacidad')) . '" target="_blank">' . esc_html__('política de privacidad', 'fg-theme') . '</a>'
              );
            ?></span>
          </label>

          <button type="submit" class="btn-submit">
            <span><?php esc_html_e('Solicitar presupuesto gratis', 'fg-theme'); ?></span>
            <?php echo fg_arrow('btn-submit__arrow'); ?>
          </button>

          <p class="form-trust">
            <?php echo fg_icon('phone'); ?>
            <span><?php
              printf(
                /* translators: %s: teléfono de contacto */
                esc_html__('O llámenos al %s', 'fg-theme'),
                '<a href="tel:' . esc_attr(fg_opt('phone_sanpedro_href')) . '">' . esc_html(fg_opt('phone_sanpedro')) . '</a>'
              );
            ?></span>
          </p>
        </form>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Dos sedes reales: oficinas de San Pedro y Garden Center/vivero de Ronda -->
<section class="section section--beige has-wm" id="ubicaciones">
  <?php
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
    'size' => 'clamp(12rem, 26vw, 22rem)', 'opacity' => '.05',
    'float' => 85, 'rot' => 3, 'scrub' => 0.35,
  ]);
  fg_watermark([
    'src' => 'icons/botanica/aromaticas.svg', 'pos' => 'br',
    'size' => 'clamp(10rem, 22vw, 18rem)', 'opacity' => '.05',
    'float' => 24, 'rot' => -6, 'scrub' => 2.3,
  ]); ?>
  <div class="wrap">
    <?php
    fg_section_heading([
      'eyebrow'  => __('Visítenos', 'fg-theme'),
      'title'    => __('Dos sedes en la provincia de Málaga', 'fg-theme'),
      'subtitle' => __('Le atendemos en las oficinas de San Pedro de Alcántara y le abrimos las puertas de nuestro Garden Center y vivero de más de 40 hectáreas en Ronda.', 'fg-theme'),
    ]);

    $fg_sedes = [
      [
        'kicker'      => __('Oficinas', 'fg-theme'),
        'title'       => __('San Pedro de Alcántara', 'fg-theme'),
        'meta'        => sprintf(
            /* translators: %s: horario de atención */
            __('Marbella · atención al cliente y presupuestos · %s', 'fg-theme'),
            fg_opt('hours')
        ),
        'address'     => fg_opt('address'),
        'phone'       => fg_opt('phone_sanpedro'),
        'phone_href'  => fg_opt('phone_sanpedro_href'),
        'maps_query'  => fg_opt('address'),
        'map_title'   => __('Oficinas San Pedro de Alcántara', 'fg-theme'),
        'map_src'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3207.3127471065086!2d-4.986322684412576!3d36.498311980011934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd732a044c2a3671%3A0x2200435eafdf7cf6!2sFantastic%20Gardens!5e0!3m2!1ses!2ses!4v1596282349459!5m2!1ses!2ses',
      ],
      [
        'kicker'      => __('Garden Center y vivero', 'fg-theme'),
        'title'       => __('Ronda', 'fg-theme'),
        'meta'        => sprintf(
            /* translators: %s: horario del vivero de Ronda */
            __('4.000 m² cubiertos · plantación propia · %s', 'fg-theme'),
            fg_opt('hours_ronda')
        ),
        'address'     => fg_opt('address2'),
        'phone'       => fg_opt('phone_ronda'),
        'phone_href'  => fg_opt('phone_ronda_href'),
        'maps_query'  => fg_opt('address2'),
        'map_title'   => __('Garden Center Ronda', 'fg-theme'),
        'map_src'     => 'https://www.google.com/maps?q=' . rawurlencode(fg_opt('address2')) . '&output=embed',
      ],
    ];
    ?>
    <div class="location-grid section-body">
      <?php foreach ($fg_sedes as $i => $sede) : ?>
        <article class="location-card" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 100)); ?>">
          <div class="location-card__media">
            <iframe src="<?php echo esc_url($sede['map_src']); ?>"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen
                    title="<?php echo esc_attr($sede['map_title']); ?>"></iframe>
          </div>
          <div class="location-card__body">
            <span class="location-card__num" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
            <div class="location-card__head">
              <span class="location-card__icon" aria-hidden="true"><?php echo fg_icon('pin'); ?></span>
              <div>
                <span class="location-card__kicker"><?php echo esc_html($sede['kicker']); ?></span>
                <h3 class="location-card__title"><?php echo esc_html($sede['title']); ?></h3>
              </div>
            </div>
            <p class="location-card__meta"><?php echo esc_html($sede['meta']); ?></p>
            <address class="location-card__address"><?php echo esc_html($sede['address']); ?></address>
            <div class="location-card__footer">
              <?php echo fg_pill($sede['phone'], 'tel:' . $sede['phone_href'], 'verde'); ?>
              <?php echo fg_pill(__('Cómo llegar', 'fg-theme'), 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($sede['maps_query']), 'ghost'); ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--arena has-wm" id="faq">
  <?php
  fg_watermark([
    'src' => 'icons/servicios/dudas-question.svg', 'pos' => 'cr',
    'size' => 'clamp(11rem, 24vw, 20rem)', 'opacity' => '.06', 'float' => 55, 'rot' => 4,
  ]);
  fg_watermark([
    'src' => 'icons/servicios/dudas-question.svg', 'pos' => 'cl', 'flip' => true,
    'size' => 'clamp(9rem, 19vw, 16rem)', 'opacity' => '.05', 'float' => 40, 'rot' => -5,
  ]);
  ?>
  <div class="wrap">
    <div class="grid grid--2" style="align-items:start">
      <div>
        <?php fg_section_heading([
          'eyebrow' => __('Dudas frecuentes', 'fg-theme'),
          'title'   => __('Antes de escribirnos', 'fg-theme'),
        ]); ?>
        <p class="section-head__sub"><?php esc_html_e('Si su pregunta no está aquí, escríbanos o llámenos directamente.', 'fg-theme'); ?></p>
        <div class="faq-call" data-reveal data-reveal-delay="120">
          <span class="faq-call__icon" aria-hidden="true"><?php echo fg_icon('phone'); ?></span>
          <div>
            <span class="faq-call__label"><?php esc_html_e('¿No encuentra su respuesta?', 'fg-theme'); ?></span>
            <a class="faq-call__phone" href="tel:<?php echo esc_attr(fg_opt('phone_sanpedro_href')); ?>"><?php echo esc_html(fg_opt('phone_sanpedro')); ?></a>
          </div>
        </div>
      </div>
      <div class="faq-list">
        <?php foreach ($fg_faqs as $i => $faq) : ?>
          <details class="faq-item" data-reveal data-reveal-delay="<?php echo esc_attr((string) ($i * 50)); ?>"<?php echo $i === 0 ? ' open' : ''; ?>>
            <summary>
              <span class="faq-item__num" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
              <h3 class="faq-item__q"><?php echo esc_html($faq['q']); ?></h3>
              <span class="faq-item__toggle" aria-hidden="true">+</span>
            </summary>
            <p class="faq-item__body"><?php echo esc_html($faq['a']); ?></p>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script type="application/ld+json"><?php echo wp_json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(static function (array $f): array {
        return [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ];
    }, $fg_faqs),
]); ?></script>

<?php
fg_zones_marquee([
    ['label' => __('Marbella', 'fg-theme')],
    ['label' => __('San Pedro Alcántara', 'fg-theme'), 'destacada' => true],
    ['label' => __('Estepona', 'fg-theme')],
    ['label' => __('Ronda', 'fg-theme')],
    ['label' => __('Costa del Sol', 'fg-theme'), 'destacada' => true],
    ['label' => __('Málaga', 'fg-theme')],
]);

get_footer();
