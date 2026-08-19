<?php

defined('ABSPATH') || exit;

define('FG_VERSION', wp_get_theme()->get('Version') ?: '2.0.0');

/* ----------------------------------------------------------------
   Theme setup
---------------------------------------------------------------- */
function fg_setup(): void {
    load_theme_textdomain('fg-theme', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', [
        'height'      => 90,
        'width'       => 260,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary-menu' => __('Menú principal', 'fg-theme'),
        'footer-menu'  => __('Menú footer', 'fg-theme'),
    ]);
}
add_action('after_setup_theme', 'fg_setup');

/* ----------------------------------------------------------------
   Enqueue assets
---------------------------------------------------------------- */
function fg_enqueue_assets(): void {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();

    // Tipografías de marca: Cormorant Garamond (títulos) + Jost (texto y rótulos).
    wp_enqueue_style(
        'fg-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'fg-main',
        $uri . '/assets/css/main.css',
        ['fg-fonts'],
        file_exists($dir . '/assets/css/main.css') ? filemtime($dir . '/assets/css/main.css') : FG_VERSION
    );

    // Script del tema: sin librerías. Los reveals, la deriva de las filigranas, el
    // parallax y los contadores van con IntersectionObserver y un único manejador
    // de scroll, así que en la mayoría de páginas no se descarga ningún vendor.
    wp_enqueue_script(
        'fg-main',
        $uri . '/assets/js/main.js',
        [],
        file_exists($dir . '/assets/js/main.js') ? filemtime($dir . '/assets/js/main.js') : FG_VERSION,
        true
    );

    $slugs = fg_page_slugs();

    // Escaparate dinámico: SOLO en la página de Vivero se cargan las librerías, y
    // únicamente porque su galería horizontal fijada (pin + scrub) y el título por
    // letras no se resuelven razonablemente sin ellas.
    if (is_page($slugs['vivero'])) {
        wp_enqueue_script('fg-gsap', $uri . '/assets/js/vendor/gsap.min.js', [], null, true);
        wp_enqueue_script('fg-scrolltrigger', $uri . '/assets/js/vendor/ScrollTrigger.min.js', ['fg-gsap'], null, true);
        wp_enqueue_script('fg-splitting', $uri . '/assets/js/vendor/splitting.min.js', [], null, true);
        wp_enqueue_script(
            'fg-vivero',
            $uri . '/assets/js/vivero.js',
            ['fg-gsap', 'fg-scrolltrigger', 'fg-main', 'fg-splitting'],
            file_exists($dir . '/assets/js/vivero.js') ? filemtime($dir . '/assets/js/vivero.js') : FG_VERSION,
            true
        );
    }

    // Catálogo interactivo de especies: filtros, fichas modales y bandeja de selección. Sin librerías.
    if (is_page($slugs['especies'])) {
        wp_enqueue_script(
            'fg-especies',
            $uri . '/assets/js/especies.js',
            ['fg-main'],
            file_exists($dir . '/assets/js/especies.js') ? filemtime($dir . '/assets/js/especies.js') : FG_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'fg_enqueue_assets');

/* La hoja de Google Fonts descubre fonts.gstatic.com solo después de descargarse;
   el preconnect adelanta el saludo TLS y quita ~100-200 ms al primer texto pintado. */
add_filter('wp_resource_hints', function (array $urls, string $relation): array {
    if ($relation === 'preconnect') {
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous'];
    }
    return $urls;
}, 10, 2);

/* ----------------------------------------------------------------
   Custom Post Type: Proyectos
---------------------------------------------------------------- */
function fg_register_cpt_proyectos(): void {
    register_post_type('proyecto', [
        'labels' => [
            'name'          => 'Proyectos',
            'singular_name' => 'Proyecto',
            'add_new_item'  => 'Añadir proyecto',
            'edit_item'     => 'Editar proyecto',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'proyectos'],
        'supports'      => ['title', 'thumbnail', 'excerpt', 'page-attributes'],
        'menu_icon'     => 'dashicons-image-rotate',
        'show_in_rest'  => true,
    ]);

    register_post_meta('proyecto', 'ubicacion', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => static fn (): bool => current_user_can('edit_posts'),
    ]);
}
add_action('init', 'fg_register_cpt_proyectos');

/* ----------------------------------------------------------------
   Ajustes del tema (Apariencia → FG Ajustes) con fallback a datos reales
---------------------------------------------------------------- */
function fg_defaults(): array {
    return [
        // Móvil / WhatsApp — número de contacto principal, visible en toda la web.
        'phone'      => '691 142 679',
        'phone_href' => '+34691142679',
        // Sede · Oficinas San Pedro de Alcántara (Marbella) — destino del formulario.
        'phone_sanpedro'      => '952 78 44 29',
        'phone_sanpedro_href' => '+34952784429',
        'address'    => 'Oficinas San Pedro de Alcántara · Pol. Industrial San Pedro, El Potril parcela nº 6, Marbella (Málaga)',
        // Sede · Garden Center y vivero de Ronda.
        'phone_ronda'         => '952 00 68 41',
        'phone_ronda_href'    => '+34952006841',
        'address2'   => 'Garden Center Ronda · 796 Partida, Ctra. Ronda-Setenil, 29394 La Cimada, Málaga',
        'email'      => 'info@fantasticgardens.net',
        'cif'        => 'B-92065101',
        // Horario de atención — San Pedro (oficinas) cierra sábados y domingos;
        // Ronda (vivero) abre también los sábados en horario reducido.
        'hours'       => 'Lunes a Viernes, 8:00–16:00',
        'hours_ronda' => 'Lunes a Viernes, 7:00–15:00 · Sábados, 9:00–14:00',
        'instagram'  => '',
        'facebook'   => '',
        'geo_lat'    => '36.4897',
        'geo_lng'    => '-4.9996',
        // Marca escrita de la cabecera y del menú móvil. Va aparte del título del
        // sitio de WordPress a propósito: así el lockup dice siempre lo que debe
        // aunque el título esté sin configurar o lo cambien en Ajustes.
        'brand'      => 'Fantastic Gardens',
        'brand_sub'  => 'Marbella · Costa del Sol',
    ];
}

function fg_opt(string $key, string $fallback = ''): string {
    $val = get_option('fg_' . $key, '');
    if ($val === '' || $val === false) {
        $defaults = fg_defaults();
        $val = $fallback !== '' ? $fallback : ($defaults[$key] ?? '');
    }
    return (string) $val;
}

/**
 * ¿La cabecera flota sobre un hero fotográfico a sangre?
 *
 * En esas páginas va transparente y en claro (y se asienta al bajar). En las
 * demás arranca ya asentada. La lista debe coincidir con las páginas que usan
 * fg_photo_hero(): los heroes partidos (fg_split_hero, columna de texto clara a
 * la izquierda) no entran, porque un menú en blanco no se leería sobre ellos.
 */
function fg_has_over_header(): bool {
    if (is_front_page()) return true;
    $slugs = fg_page_slugs();
    return is_page([
        $slugs['servicios'],
        $slugs['diseno'],
        $slugs['mantenimiento'],
        $slugs['especies'],
    ]);
}

/* ----------------------------------------------------------------
   Helpers
---------------------------------------------------------------- */
function fg_asset(string $path): string {
    return get_template_directory_uri() . '/assets/img/' . ltrim($path, '/');
}

/**
 * Renderiza una imagen editable por ACF envuelta en <img>. Si ACF no está activo
 * o el campo está vacío, usa una imagen del tema como fallback.
 */
function fg_img(string $field, string $fallback = '', string $alt = '', string $class = ''): string {
    $img_id = function_exists('get_field') ? get_field($field) : null;
    if ($img_id) {
        return wp_get_attachment_image($img_id, 'full', false, [
            'alt'      => esc_attr($alt),
            'class'    => esc_attr($class),
            'loading'  => 'lazy',
            'decoding' => 'async',
        ]);
    }
    if ($fallback) {
        return '<img src="' . esc_url(fg_asset($fallback)) . '" alt="' . esc_attr($alt) . '"'
            . ($class ? ' class="' . esc_attr($class) . '"' : '')
            . ' loading="lazy" decoding="async">';
    }
    return '';
}

/**
 * URL de un archivo (imagen/vídeo) desde un campo ACF, con fallback a un asset del tema.
 * Los campos ACF devuelven el ID del adjunto (return_format 'id').
 */
function fg_media_url(string $field, string $fallback): string {
    $id = function_exists('get_field') ? get_field($field) : null;
    $url = $id ? wp_get_attachment_url($id) : '';
    return $url ?: fg_asset($fallback);
}

/**
 * Mapa de slugs reales de v2 (idénticos a producción v1 por SEO, salvo 'especies'
 * que es contenido nuevo sin URL previa). fg_page_url() es la única fuente de
 * verdad para enlazar entre páginas internas del tema.
 */
function fg_page_slugs(): array {
    return [
        'servicios'      => 'servicios-jardineria-paisajismo-mantenimiento-y-vivero',
        'diseno'         => 'fantastic-gardens-paisajismo-diseno-jardines',
        'mantenimiento'  => 'mantenimiento-a-casas-y-empresas-jardineria',
        'soluciones-integrales' => 'soluciones-integrales-jardineria-marbella',
        'desbroce-limpieza'     => 'desbroce-y-limpieza-de-parcelas-marbella',
        'vivero'         => 'vivero-y-plantacion-propia',
        'especies'       => 'catalogo-especies-plantas-vivero-marbella',
        'proyectos'      => 'proyectos-realizados-jardineria-costa-del-sol-malaga',
        'antes-despues'  => 'proyectos-antes-y-despues-diseno-de-jardines-paisajismo',
        'historia'       => 'historia',
        'contacto'       => 'contacto-empresa-jardineria',
        'aviso-legal'    => 'aviso-legal',
        'privacidad'     => 'politica-de-privacidad',
        'cookies'        => 'politica-de-cookies',
    ];
}

/** Permalink de una página interna por clave lógica (ver fg_page_slugs()). */
function fg_page_url(string $key): string {
    if ($key === '' || $key === 'home') return home_url('/');
    static $cache = [];
    if (isset($cache[$key])) return $cache[$key];
    $slugs = fg_page_slugs();
    $slug  = $slugs[$key] ?? $key;
    $page  = get_page_by_path($slug);
    return $cache[$key] = ($page ? (get_permalink($page->ID) ?: home_url('/' . $slug . '/')) : home_url('/' . $slug . '/'));
}

/** Logo del sitio: custom-logo si está definido; si no, el lockup de marca (wordmark-olivo.svg). */
function fg_logo(array $args = []): void {
    $loading = $args['loading'] ?? 'lazy';
    $class   = trim('site-logo__img brand-logo ' . ($args['class'] ?? ''));

    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        echo wp_get_attachment_image($logo_id, 'full', false, [
            'class'    => esc_attr($class),
            'alt'      => esc_attr(get_bloginfo('name')),
            'loading'  => $loading,
            'decoding' => 'async',
        ]);
        return;
    }
    printf(
        '<img class="%s" src="%s" alt="%s" width="171" height="60" loading="%s" decoding="async">',
        esc_attr($class),
        esc_url(fg_asset('wordmark-olivo.svg')),
        esc_attr(get_bloginfo('name') ?: 'Fantastic Gardens · Marbella'),
        esc_attr($loading)
    );
}

/* ----------------------------------------------------------------
   Formulario de contacto (página Contacto) — wp_mail + nonce
---------------------------------------------------------------- */
/**
 * Procesa el formulario de contacto. Devuelve:
 *   ''          → no se ha enviado el formulario
 *   'invalid'   → faltan campos obligatorios o el nonce no es válido
 *   'mail-error'→ los campos eran correctos pero wp_mail() no pudo enviar (SMTP/sendmail sin configurar)
 *   'ok'        → enviado correctamente
 */
function fg_process_contact_form(): string {
    if (!isset($_POST['fg_contact_nonce'])) return '';
    if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['fg_contact_nonce'])), 'fg_contact')) return 'invalid';

    $nombre     = sanitize_text_field(wp_unslash($_POST['nombre']    ?? ''));
    $email      = sanitize_email(wp_unslash($_POST['email']          ?? ''));
    $telefono   = sanitize_text_field(wp_unslash($_POST['telefono']  ?? ''));
    $localidad  = sanitize_text_field(wp_unslash($_POST['localidad'] ?? ''));
    $servicio   = sanitize_text_field(wp_unslash($_POST['servicio']  ?? ''));
    $mensaje    = sanitize_textarea_field(wp_unslash($_POST['mensaje'] ?? ''));
    $privacidad = !empty($_POST['privacidad']);

    if (!$nombre || !is_email($email) || !$telefono || !$privacidad) return 'invalid';

    $to      = fg_opt('email');
    $subject = 'Nueva consulta desde la web — ' . $nombre;
    $body    = "NUEVA CONSULTA\n" . str_repeat('─', 40) . "\n\n"
             . "Nombre:    $nombre\n"
             . "Email:     $email\n"
             . "Teléfono:  $telefono\n"
             . ($localidad !== '' ? "Localidad: $localidad\n" : '')
             . ($servicio  !== '' ? "Servicio:  $servicio\n"  : '')
             . "\nMensaje:\n" . ($mensaje !== '' ? $mensaje : '(sin mensaje adicional)') . "\n";
    $headers = ['Reply-To: ' . $nombre . ' <' . $email . '>'];

    return wp_mail($to, $subject, $body, $headers) ? 'ok' : 'mail-error';
}

/* ----------------------------------------------------------------
   SEO — <title> de portada, sin depender de un plugin
   El filtro title-tag de WP añade blogname + tagline en la portada; aquí se
   sustituye por un título con la keyword principal por delante (mejor CTR en
   resultados de búsqueda) cuando no hay Rank Math / Yoast controlando el título.
---------------------------------------------------------------- */
function fg_seo_title(array $title): array {
    $has_seo_plugin = defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION') || class_exists('WPSEO_Frontend');
    if (!$has_seo_plugin && is_front_page()) {
        $title = ['title' => __('Jardinería y Paisajismo de Lujo en Marbella', 'fg-theme')];
    }
    return $title;
}
add_filter('document_title_parts', 'fg_seo_title');

/* ----------------------------------------------------------------
   SEO — meta description + Open Graph + Twitter Card + JSON-LD
   Se desactiva parcialmente si hay un plugin SEO (Rank Math / Yoast) para no
   duplicar etiquetas; el schema LocalBusiness se emite siempre.
---------------------------------------------------------------- */
function fg_seo_head(): void {
    $has_seo_plugin = defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION') || class_exists('WPSEO_Frontend');

    if (!$has_seo_plugin && is_front_page()) {
        $desc = 'Jardinería y paisajismo de lujo en Marbella y Costa del Sol. Diseño 3D, vivero propio y +30 años de experiencia. Presupuesto sin compromiso.';
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta name="robots" content="index, follow">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name') ?: 'Fantastic Gardens') . '">' . "\n";
        echo '<meta property="og:locale" content="es_ES">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
        $front_id = (int) get_option('page_on_front');
        $og_image = ($front_id && has_post_thumbnail($front_id))
            ? (wp_get_attachment_image_src(get_post_thumbnail_id($front_id), 'large')[0] ?? '')
            : fg_asset('hero-indice-poster.jpg');
        if ($og_image) {
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
            echo '<meta property="og:image:width" content="1920">' . "\n";
            echo '<meta property="og:image:height" content="1080">' . "\n";
            echo '<meta property="og:image:alt" content="' . esc_attr__('Jardín mediterráneo diseñado por Fantastic Gardens en Marbella', 'fg-theme') . '">' . "\n";
        }
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    }

    if (is_front_page()) {
        $lat = fg_opt('geo_lat');
        $lng = fg_opt('geo_lng');
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'LocalBusiness',
            'name'        => 'Fantastic Gardens',
            'description' => 'Empresa de jardinería y paisajismo de lujo en Marbella y la Costa del Sol. Más de 30 años de experiencia diseñando y manteniendo jardines exclusivos para villas de alto nivel.',
            'url'         => home_url('/'),
            'telephone'   => '+34' . preg_replace('/\D+/', '', fg_opt('phone')),
            'email'       => fg_opt('email'),
            'logo'        => ['@type' => 'ImageObject', 'url' => fg_asset('wordmark-olivo.svg')],
            'areaServed'  => ['Marbella', 'Costa del Sol', 'Málaga', 'Benahavís', 'Estepona', 'San Pedro de Alcántara', 'Ronda'],
            'address'     => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => fg_opt('address'),
                'addressLocality' => 'Marbella',
                'addressRegion'   => 'Málaga',
                'addressCountry'  => 'ES',
            ],
            'location'    => [
                [
                    '@type'     => 'Place',
                    'name'      => 'Oficinas San Pedro de Alcántara',
                    'address'   => [
                        '@type'           => 'PostalAddress',
                        'streetAddress'   => fg_opt('address'),
                        'addressLocality' => 'Marbella',
                        'addressRegion'   => 'Málaga',
                        'addressCountry'  => 'ES',
                    ],
                    'telephone' => fg_opt('phone_sanpedro'),
                    'openingHoursSpecification' => [
                        [
                            '@type'     => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                            'opens'     => '08:00',
                            'closes'    => '16:00',
                        ],
                    ],
                ],
                [
                    '@type'     => 'Place',
                    'name'      => 'Garden Center y vivero de Ronda',
                    'address'   => [
                        '@type'           => 'PostalAddress',
                        'streetAddress'   => fg_opt('address2'),
                        'addressLocality' => 'Ronda',
                        'addressRegion'   => 'Málaga',
                        'addressCountry'  => 'ES',
                    ],
                    'telephone' => fg_opt('phone_ronda'),
                    'openingHoursSpecification' => [
                        [
                            '@type'     => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                            'opens'     => '07:00',
                            'closes'    => '15:00',
                        ],
                        [
                            '@type'     => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Saturday'],
                            'opens'     => '09:00',
                            'closes'    => '14:00',
                        ],
                    ],
                ],
            ],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => '4.9',
                'bestRating'  => '5',
                'ratingCount' => '1000',
            ],
            // Reseñas reales publicadas en MundoJardinería (mismo texto que
            // template-parts/home/resenas.php) — mantener ambas en sync.
            'review' => [
                [
                    '@type'         => 'Review',
                    'author'        => ['@type' => 'Person', 'name' => 'Andrew'],
                    'reviewBody'    => 'Construí tres casas en España, cada una en un terreno de más de 2.000 m². Los tres jardines fueron diseñados, hechos y mantenidos por Fantastic Gardens. Estoy muy contento con la cooperación y el servicio. Se lo recomiendo a todos.',
                    'reviewRating'  => ['@type' => 'Rating', 'ratingValue' => '5', 'bestRating' => '5'],
                ],
                [
                    '@type'         => 'Review',
                    'author'        => ['@type' => 'Person', 'name' => 'Ana'],
                    'reviewBody'    => 'Supieron proyectar mis ideas y mis preferencias en mi jardín a la perfección. Un trato muy cordial y cercano, a la vez que profesional y eficaz. He quedado muy satisfecha.',
                    'reviewRating'  => ['@type' => 'Rating', 'ratingValue' => '5', 'bestRating' => '5'],
                ],
            ],
            'sameAs'      => array_values(array_filter([
                'https://fantasticgardens.net',
                fg_opt('instagram') ?: null,
                fg_opt('facebook') ?: null,
            ])),
            'priceRange'  => '€€€',
            'hasMap'      => 'https://maps.google.com/?q=San+Pedro+Alcantara+Marbella',
            // Horario de la sede principal (San Pedro); Ronda tiene el suyo propio
            // dentro de su entrada en location[] (abre también los sábados).
            'openingHoursSpecification' => [
                [
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens'     => '08:00',
                    'closes'    => '16:00',
                ],
            ],
        ];
        if ($lat && $lng) {
            $schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float) $lat, 'longitude' => (float) $lng];
        }
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
add_action('wp_head', 'fg_seo_head', 1);

/* ----------------------------------------------------------------
   Remove WordPress junk from <head>
---------------------------------------------------------------- */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
add_filter('the_generator', '__return_empty_string');

/* ----------------------------------------------------------------
   Includes
---------------------------------------------------------------- */
$fg_inc = [
    '/inc/components.php',
    '/inc/especies.php',
    '/inc/proyectos-detalle.php',
    '/inc/legal-content.php',
    '/inc/admin-settings.php',
    '/acf-fields.php',
];
foreach ($fg_inc as $fg_inc_file) {
    $fg_inc_path = get_template_directory() . $fg_inc_file;
    if (file_exists($fg_inc_path)) require_once $fg_inc_path;
}
unset($fg_inc, $fg_inc_file, $fg_inc_path);
