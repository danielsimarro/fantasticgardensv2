<?php
/**
 * Componentes reutilizables (heroes, tarjetas, breadcrumb, feature-row, tagline).
 * Todos hacen echo del markup. Reproducen el diseño del proyecto de referencia (Next).
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

/** Ruta de un asset de imagen del tema (atajo). */
function fg_img_url(string $path): string {
    return fg_asset($path);
}

/** Breadcrumb. $items = [['label'=>..., 'url'=>...|null], ...]. $tone: 'dark'|'light'. */
function fg_breadcrumb(array $items, string $tone = 'dark'): void {
    if (!$items) return;
    echo '<nav class="breadcrumb breadcrumb--' . esc_attr($tone) . '" aria-label="' . esc_attr__('Migas de pan', 'fg-theme') . '">';
    $last = count($items) - 1;
    foreach ($items as $i => $item) {
        if (!empty($item['url']) && $i !== $last) {
            echo '<a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a>';
        } else {
            echo '<span aria-current="page">' . esc_html($item['label']) . '</span>';
        }
        if ($i !== $last) echo '<span class="breadcrumb__sep" aria-hidden="true">/</span>';
    }
    echo '</nav>';
}

/**
 * Selector de idioma (ES activo + EN "Pronto"): mismo markup para el hueco de
 * escritorio (dentro de nav-desktop) y para la barra móvil con el menú
 * cerrado — placeholder funcional hasta configurar Polylang. $extra_class
 * distingue el hueco (p.ej. 'nav-lang--header' para el que va junto al
 * botón de menú, oculto en escritorio vía CSS).
 */
function fg_lang_switcher(string $current_url, string $extra_class = ''): void {
    ?>
    <div class="nav-item nav-item--lang has-children<?php echo $extra_class ? ' ' . esc_attr($extra_class) : ''; ?>">
      <button type="button" class="nav-link nav-lang__trigger" aria-haspopup="true" aria-expanded="false" aria-label="<?php esc_attr_e('Seleccionar idioma', 'fg-theme'); ?>">
        <?php esc_html_e('ES', 'fg-theme'); ?>
        <svg class="nav-caret" viewBox="0 0 10 6" width="10" height="6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="nav-dropdown nav-dropdown--lang">
        <ul>
          <li>
            <a href="<?php echo esc_url($current_url); ?>" class="is-current" aria-current="true">
              <?php esc_html_e('Español', 'fg-theme'); ?>
              <span class="nav-dropdown__check" aria-hidden="true">✓</span>
            </a>
          </li>
          <li class="nav-dropdown__soon">
            <span><?php esc_html_e('English', 'fg-theme'); ?></span>
            <span class="nav-dropdown__badge"><?php esc_html_e('Pronto', 'fg-theme'); ?></span>
          </li>
        </ul>
      </div>
    </div>
    <?php
}

/**
 * Rótulo de sección: número de orden, filete y epígrafe en versalitas.
 *   01 ──── EL ESTUDIO
 * Es el gesto que ordena la lectura de todo el sitio. El número es opcional.
 */
function fg_kicker(string $eyebrow, string $num = '', string $tone = 'dark'): string {
    $out = '<div class="kicker' . ($tone === 'light' ? ' kicker--light' : '') . '" data-reveal>';
    if ($num !== '') $out .= '<span class="kicker__num">' . esc_html($num) . '</span>';
    $out .= '<span class="kicker__rule" aria-hidden="true"></span>';
    $out .= '<span class="kicker__label">' . esc_html($eyebrow) . '</span>';
    $out .= '</div>';
    return $out;
}

/**
 * Encabezado de sección.
 * $a: eyebrow, title, subtitle, num (orden de sección), tone ('dark'|'light'),
 *     center (bool), title_html (titular con marcado propio, ya escapado).
 */
function fg_section_heading(array $a): void {
    $center = !empty($a['center']);
    $tone   = $a['tone'] ?? 'dark';
    echo '<div class="section-head' . ($center ? ' section-head--center' : '')
       . ($tone === 'light' ? ' section-head--light' : '') . '">';
    if (!empty($a['eyebrow'])) echo fg_kicker($a['eyebrow'], $a['num'] ?? '', $tone);
    echo '<h2 class="section-head__title" data-reveal data-reveal-delay="80">'
       . (!empty($a['title_html']) ? $a['title_html'] : esc_html($a['title']))
       . '</h2>';
    if (!empty($a['subtitle'])) {
        echo '<p class="section-head__sub" data-reveal data-reveal-delay="160">' . esc_html($a['subtitle']) . '</p>';
    }
    echo '</div>';
}

/** Flecha larga de marca (el mismo trazo en CTAs, píldoras y tarjetas). */
function fg_arrow(string $class = ''): string {
    return '<img class="' . esc_attr($class) . '" src="' . esc_url(fg_asset('arrow-right.svg'))
         . '" alt="" aria-hidden="true" width="34" height="12" loading="lazy" decoding="async">';
}

/** CTA editorial (enlace en versalitas con filete y flecha). $tone: 'dark'|'light'. */
function fg_cta(string $label, string $url, string $tone = 'dark', bool $arrow = true): string {
    $cls = 'cta' . ($tone === 'light' ? ' cta--light' : '');
    $out = '<a class="' . esc_attr($cls) . '" href="' . esc_url($url) . '">';
    $out .= '<span class="cta__label">' . esc_html($label) . '</span>';
    if ($arrow) $out .= fg_arrow('cta__arrow');
    $out .= '</a>';
    return $out;
}

/**
 * Píldora: la llamada fuerte. $variant: 'solid' (crema sobre oscuro),
 * 'verde' (sobre claro) o 'ghost' (contorno, hereda el color del contexto).
 */
function fg_pill(string $label, string $url, string $variant = 'solid', bool $arrow = true): string {
    $out = '<a class="pill pill--' . esc_attr($variant) . '" href="' . esc_url($url) . '">';
    $out .= '<span>' . esc_html($label) . '</span>';
    if ($arrow) $out .= fg_arrow('pill__arrow');
    $out .= '</a>';
    return $out;
}

/**
 * Rejilla de filetes verticales de fondo (decorativa). Se trazan de arriba
 * abajo al entrar en pantalla; en móvil no se pintan.
 */
function fg_vlines(int $cols = 4): void {
    echo '<div class="vlines" aria-hidden="true" style="--vl-cols:' . (int) $cols . '">';
    for ($i = 1; $i < $cols; $i++) {
        echo '<span data-vline data-vline-delay="' . ($i * 120) . '"></span>';
    }
    echo '<span></span></div>';
}

/** Imagen de hero: usa la Imagen destacada de la página si existe; si no, el asset indicado. */
function fg_hero_image(string $fallback): string {
    if (is_page() && has_post_thumbnail()) {
        $url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($url) return $url;
    }
    return (strpos($fallback, '://') !== false) ? $fallback : fg_asset($fallback);
}

/**
 * Hero fotográfico full-bleed con overlay (servicios, mantenimiento, diseño).
 *
 * Además del uso simple (title/subtitle/cta), admite una variante más rica
 * —de momento solo Mantenimiento— con kicker numerado, titular en dos líneas
 * (title_html), una segunda píldora (cta_secondary) y una tira de etiquetas
 * al pie (tags): basta con pasar esas claves, el resto de páginas que solo
 * usan title/subtitle/cta quedan exactamente igual que antes. `title_html`
 * por sí solo NO activa la variante alta/rica —solo `cta_secondary` lo hace—
 * así que se puede usar para un acento en cursiva sin heredar el alto de
 * Mantenimiento. `compact` (bool) da un banner editorial más bajo y contenido
 * (de momento solo Contacto), pensado para heroes sin CTA propio. `breadcrumb`
 * (opcional, mismo formato que fg_breadcrumb()) añade las migas de pan sobre
 * el kicker/titular — de momento solo Diseño de paisajismo; el resto de
 * páginas sin esa clave quedan exactamente igual que antes. `pill_cta` (bool)
 * activa la misma fila alta subtítulo+píldora que Mantenimiento pero con una
 * sola píldora (sin `cta_secondary` ni `tags`) — de momento solo Diseño de
 * paisajismo. `accent_rule` (bool) fuerza el filete de acento también cuando
 * se usa `title_html` (por defecto ese filete solo aparece con `title` plano,
 * para no tocar el look ya validado de Contacto/Mantenimiento). `row_plain`
 * (bool) quita el filete divisorio de `.hero__row` sobre el subtítulo/CTA;
 * `subtitle_lead` (bool) pasa el subtítulo a entradilla grande en cursiva
 * serif en vez del texto de apoyo pequeño — ambos de momento solo Diseño.
 * `stat` (opcional, ['count'=>int,'label'=>string]): cifra animada al lado
 * opuesto del subtítulo en la fila alta, en vez de (o además de) el CTA —
 * de momento solo Servicios («4 áreas de trabajo»).
 */
function fg_photo_hero(array $a): void {
    $image   = fg_hero_image($a['image']);
    $rich    = !empty($a['cta_secondary']) || !empty($a['pill_cta']) || !empty($a['stat']);
    $compact = !empty($a['compact']);
    $cls     = 'photo-hero' . ($rich ? ' photo-hero--tall' : '') . ($compact ? ' photo-hero--compact' : '') . (!empty($a['extra_class']) ? ' ' . $a['extra_class'] : '');
    ?>
    <section class="<?php echo esc_attr($cls); ?>">
      <img class="photo-hero__img" data-img-reveal data-kenburns src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" fetchpriority="high" decoding="async">
      <div class="photo-hero__overlay" aria-hidden="true"></div>
      <div class="wrap photo-hero__content" data-reveal>
        <?php if (!empty($a['breadcrumb'])) fg_breadcrumb($a['breadcrumb'], 'light'); ?>
        <?php if (!empty($a['kicker'])) echo fg_kicker($a['kicker'], $a['kicker_num'] ?? '', 'light'); ?>

        <?php if (!empty($a['title_html'])) : ?>
          <h1 class="photo-hero__title photo-hero__title--stack"><?php echo $a['title_html']; ?></h1>
          <?php if (!empty($a['accent_rule'])) : ?><span class="accent-rule accent-rule--lima"></span><?php endif; ?>
        <?php else : ?>
          <h1 class="photo-hero__title"><?php echo esc_html($a['title']); ?></h1>
          <span class="accent-rule"></span>
        <?php endif; ?>

        <?php if ($rich) : ?>
          <div class="hero__row<?php echo !empty($a['row_plain']) ? ' hero__row--plain' : ''; ?>">
            <?php if (!empty($a['subtitle'])) : ?><p class="hero__subtitle<?php echo !empty($a['subtitle_lead']) ? ' hero__subtitle--lead' : ''; ?>" data-reveal data-reveal-delay="300"><?php echo esc_html($a['subtitle']); ?></p><?php endif; ?>
            <?php if (!empty($a['cta']) || !empty($a['cta_secondary'])) : ?>
              <div class="hero__cta" data-reveal data-reveal-delay="360">
                <?php if (!empty($a['cta'])) echo fg_pill($a['cta']['label'], $a['cta']['url'], 'solid'); ?>
                <?php if (!empty($a['cta_secondary'])) echo fg_pill($a['cta_secondary']['label'], $a['cta_secondary']['url'], 'ghost'); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($a['stat'])) : ?>
              <div class="hero__solo-stat" data-reveal data-reveal-delay="360">
                <span class="hero__solo-stat-num" data-count="<?php echo esc_attr((int) $a['stat']['count']); ?>"><?php echo esc_html((int) $a['stat']['count']); ?></span>
                <?php echo esc_html($a['stat']['label']); ?>
              </div>
            <?php endif; ?>
          </div>
          <?php if (!empty($a['tags'])) : ?>
            <div class="tag-strip" data-reveal data-reveal-delay="400">
              <?php foreach ($a['tags'] as $tag) : ?><span><?php echo esc_html($tag); ?></span><?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php else : ?>
          <?php if (!empty($a['subtitle'])) : ?><p class="photo-hero__sub"><?php echo esc_html($a['subtitle']); ?></p><?php endif; ?>
          <?php if (!empty($a['cta'])) : ?><div class="photo-hero__cta"><?php echo fg_cta($a['cta']['label'], $a['cta']['url'], 'light'); ?></div><?php endif; ?>
        <?php endif; ?>
      </div>
    </section>
    <?php
}

/** Hero partido: columna de texto crema + fotografía. $portrait para fuentes 3:4.
 *  $a['watermark'] (opcional): array de argumentos para fg_watermark(), filigrana
 *  de fondo tras el texto. $a['mobile_image_first'] (opcional, bool): en móvil
 *  (donde el grid es de una sola columna) muestra la imagen antes que el texto;
 *  no afecta al orden en escritorio. Por defecto false (orden actual: texto,
 *  luego imagen, en todos los anchos). */
function fg_split_hero(array $a): void {
    $side = ($a['image_side'] ?? 'right') === 'left' ? 'split-hero--image-left' : '';
    $mobile_first = !empty($a['mobile_image_first']) ? ' split-hero--mobile-media-first' : '';
    $portrait = !empty($a['portrait']) ? ' split-hero__media--portrait' : '';
    $image = fg_hero_image($a['image']);
    $title_class = 'split-hero__title' . (!empty($a['title_class']) ? ' ' . $a['title_class'] : '');
    $text_class = 'split-hero__text' . (!empty($a['watermark']) ? ' has-wm' : '');
    ?>
    <section class="split-hero <?php echo esc_attr($side . $mobile_first); ?>">
      <div class="<?php echo esc_attr($text_class); ?>">
        <?php if (!empty($a['watermark'])) fg_watermark($a['watermark']); ?>
        <div class="split-hero__inner" data-reveal>
          <h1 class="<?php echo esc_attr($title_class); ?>"><?php echo esc_html($a['title']); ?></h1>
          <span class="accent-rule"></span>
          <?php if (!empty($a['subtitle'])) : ?><p class="split-hero__sub"><?php echo esc_html($a['subtitle']); ?></p><?php endif; ?>
          <?php if (!empty($a['body'])) echo $a['body']; // markup ya escapado por el llamador ?>
        </div>
      </div>
      <div class="split-hero__media<?php echo $portrait; ?>" data-img-reveal>
        <img data-kenburns src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" fetchpriority="high" decoding="async">
        <?php if (!empty($a['overlay_note'])) echo $a['overlay_note']; ?>
      </div>
    </section>
    <?php
}

/**
 * Tarjeta grande numerada de la rejilla de Servicios: foto a sangre + overlay
 * oscuro + número al vuelo + título y flecha al pie (mismo lenguaje de
 * gradiente que .photo-hero__overlay).
 */
function fg_service_tile(array $a): void {
    ?>
    <a class="service-tile" href="<?php echo esc_url($a['url']); ?>" data-reveal>
      <span class="service-tile__num"><?php echo esc_html($a['num']); ?></span>
      <div class="service-tile__media" data-img-reveal>
        <img src="<?php echo esc_url($a['image']); ?>" alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" loading="lazy" decoding="async">
        <span class="service-tile__scrim" aria-hidden="true"></span>
      </div>
      <span class="service-tile__foot">
        <span class="service-tile__title"><?php echo esc_html($a['title']); ?></span>
        <?php echo fg_arrow('service-tile__arrow'); ?>
      </span>
    </a>
    <?php
}

/** Tarjeta de acceso grande (foto + título + cuerpo + flecha). */
function fg_card_link(array $a): void {
    ?>
    <a class="card-link" href="<?php echo esc_url($a['url']); ?>" data-reveal>
      <div class="card-link__media fx-frame" data-img-reveal>
        <img src="<?php echo esc_url($a['image']); ?>" alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" loading="lazy" decoding="async">
      </div>
      <div class="card-link__body">
        <h3 class="card-link__title"><?php echo esc_html($a['title']); ?></h3>
        <p class="card-link__text"><?php echo esc_html($a['body']); ?></p>
        <?php echo fg_arrow('card-link__arrow'); ?>
      </div>
    </a>
    <?php
}

/** Tarjeta de proyecto (foto + título + meta). Enlaza si $a['url'] viene informado. */
function fg_project_card(array $a): void {
    $tag = !empty($a['url']) ? 'a' : 'article';
    ?>
    <<?php echo $tag; ?> class="project-card"<?php echo !empty($a['url']) ? ' href="' . esc_url($a['url']) . '"' : ''; ?>>
      <div class="project-card__media fx-frame" data-img-reveal>
        <img src="<?php echo esc_url($a['image']); ?>" alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" loading="lazy" decoding="async">
        <?php if (!empty($a['badge'])) : ?><span class="project-card__zoom" aria-hidden="true"><?php echo esc_html($a['badge']); ?></span><?php endif; ?>
      </div>
      <div class="project-card__body">
        <h2 class="project-card__title"><?php echo esc_html($a['title']); ?></h2>
        <div class="project-card__foot">
          <?php if (!empty($a['meta'])) : ?><span class="project-card__meta"><?php echo esc_html($a['meta']); ?></span><?php endif; ?>
          <span class="project-card__cta">
            <span class="project-card__cta-label"><?php esc_html_e('Ver proyecto', 'fg-theme'); ?></span>
            <?php echo fg_arrow('project-card__cta-arrow'); ?>
          </span>
        </div>
      </div>
    </<?php echo $tag; ?>>
    <?php
}

/**
 * Fila de features/valores con icono. $variant 'compact'|'detailed'.
 * $it['icon'] admite una URL (se envuelve en <img>) o marcado SVG ya
 * construido por el llamador, detectado por el prefijo "<".
 */
function fg_feature_row(array $items, string $variant = 'compact', bool $icon_ring = false): void {
    echo '<div class="feature-row feature-row--' . esc_attr($variant) . ($icon_ring ? ' feature-row--ring' : '') . '" data-reveal>';
    foreach ($items as $it) {
        echo '<div class="feature">';
        if (!empty($it['icon'])) {
            $is_markup = str_starts_with(ltrim($it['icon']), '<');
            echo '<span class="feature__icon" aria-hidden="true">'
               . ($is_markup ? $it['icon'] : '<img src="' . esc_url($it['icon']) . '" alt="">') // phpcs:ignore WordPress.Security.EscapeOutput
               . '</span>';
        }
        echo '<p class="feature__label">' . wp_kses($it['label'], ['br' => []]) . '</p>';
        if (!empty($it['description'])) echo '<p class="feature__desc">' . esc_html($it['description']) . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

/** Iconos de línea (24×24, stroke=currentColor salvo detalle relleno puntual) para el footer: ubicación, teléfono, email y redes. */
function fg_icon(string $name): string {
    $icons = [
        'pin'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>',
        'phone'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3h3l1.5 4.5-2 1.5a12 12 0 0 0 6 6l1.5-2 4.5 1.5v3a2 2 0 0 1-2.1 2A17.5 17.5 0 0 1 4.5 5.1 2 2 0 0 1 6.5 3z"/></svg>',
        'mail'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="5" width="19" height="14" rx="2.5"/><path d="M3.5 6.5 12 13l8.5-6.5"/></svg>',
        'whatsapp'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 0 0-7.8 13.5L3 21l4.6-1.2A9 9 0 1 0 12 3z"/><path d="M8.3 8.6c.2-.4.5-.4.8-.4h.5c.2 0 .4.1.5.4.2.4.6 1.4.6 1.6s0 .3-.2.5c-.2.2-.4.4-.5.5-.2.2-.3.3-.1.6.2.4 1.4 1.8 2.6 2.3.3.1.5.1.6-.1.2-.2.4-.5.6-.7.2-.2.3-.2.6-.1.2.1 1.4.7 1.7.8.2.1.4.1.4.3 0 .3-.1.9-.5 1.3-.5.4-1.1.7-1.9.6-.9-.2-2.5-.9-3.8-2.2-1.3-1.3-2-2.7-2.2-3.6-.1-.7.2-1.4.6-1.8z" fill="currentColor" stroke="none"/></svg>',
        'form'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16"/><path d="M14.2 4.8 18 8.6 8.4 18.2H4.6v-3.8z"/></svg>',
        'instagram' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.3" cy="6.7" r=".6" fill="currentColor" stroke="none"/></svg>',
        'facebook'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9.5"/><path d="M14 8.5h-1.3a1.7 1.7 0 0 0-1.7 1.7V12H9v2h2v7h2v-7h2.1l.4-2H13v-1.3c0-.4.3-.7.7-.7H15V8.5z" fill="currentColor" stroke="none"/></svg>',
        'area'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9V4h5M20 15v5h-5M4 15v5h5M20 9V4h-5"/></svg>',
        'award'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8.5" r="5"/><path d="M8.7 12.8 7 21l5-2.6 5 2.6-1.7-8.2"/></svg>',
        'calendar'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="5" width="17" height="16" rx="2.5"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/></svg>',
    ];
    return $icons[$name] ?? '';
}

/** Icono de fg_icon() o ruta de imagen en assets/img/ — usado por specs/servicios de ficha de proyecto. */
function fg_icon_or_asset(string $icon): string {
    $svg = fg_icon($icon);
    if ($svg !== '') return $svg;
    return '<img src="' . esc_url(fg_asset($icon)) . '" alt="" loading="lazy">';
}

/** Fila de cifras con icono (ubicación, superficie, duración…) de una ficha de proyecto. */
function fg_project_specs(array $items): void {
    ?>
    <div class="project-specs" data-reveal>
      <?php foreach ($items as $it) : ?>
        <div class="project-specs__item">
          <span class="project-specs__icon" aria-hidden="true"><?php echo fg_icon_or_asset($it['icon']); ?></span>
          <span class="project-specs__text">
            <span class="project-specs__label"><?php echo esc_html($it['label']); ?></span>
            <span class="project-specs__value"><?php echo esc_html($it['value']); ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
    <?php
}

/** Par de tarjetas "El reto / La solución" de una ficha de proyecto. */
function fg_project_story(array $reto, array $solucion): void {
    ?>
    <div class="project-story">
      <div class="project-story__card" data-reveal>
        <span class="project-story__num">01</span>
        <h3 class="project-story__title"><?php echo esc_html($reto['titulo']); ?></h3>
        <p class="project-story__text"><?php echo esc_html($reto['texto']); ?></p>
      </div>
      <div class="project-story__card" data-reveal data-reveal-delay="120">
        <span class="project-story__num">02</span>
        <h3 class="project-story__title"><?php echo esc_html($solucion['titulo']); ?></h3>
        <p class="project-story__text"><?php echo esc_html($solucion['texto']); ?></p>
      </div>
    </div>
    <?php
}

/** Chips de servicios implicados en un proyecto, enlazando a su página real. */
function fg_service_chips(array $items): void {
    ?>
    <div class="service-chips" data-reveal>
      <?php foreach ($items as $it) : ?>
        <a class="service-chip" href="<?php echo esc_url($it['url']); ?>">
          <span class="service-chip__icon" aria-hidden="true"><?php echo fg_icon_or_asset($it['icon']); ?></span>
          <?php echo esc_html($it['label']); ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php
}

/** Galería de fotos adicionales de un proyecto, con lightbox (requiere fg_lightbox() en la página). */
function fg_project_gallery(array $items, string $titulo_proyecto): void {
    $cls = 'project-gallery' . (count($items) === 1 ? ' project-gallery--single' : '');
    ?>
    <div class="<?php echo esc_attr($cls); ?>">
      <?php foreach ($items as $it) :
          $src = fg_asset($it['img']);
      ?>
        <button type="button" class="project-gallery__item fx-frame" data-img-reveal
          data-lightbox
          data-lb-src="<?php echo esc_url($src); ?>"
          data-lb-alt="<?php echo esc_attr($it['alt'] ?? ''); ?>"
          data-lb-title="<?php echo esc_attr($titulo_proyecto); ?>"
          data-lb-meta="<?php echo esc_attr($it['alt'] ?? ''); ?>">
          <img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($it['alt'] ?? ''); ?>" loading="lazy" decoding="async">
        </button>
      <?php endforeach; ?>
    </div>
    <?php
}

/**
 * Comparador antes/después con divisoria arrastrable (plano ↔ render 3D, o
 * fotografía antes ↔ después). $a: before, before_alt, after, after_alt,
 * before_label, after_label. El JS (main.js → compareSliders) hace la
 * divisoria arrastrable/con teclado.
 */
function fg_before_after(array $a): void {
    $before = $a['before_label'] ?? __('Antes', 'fg-theme');
    $after  = $a['after_label'] ?? __('Después', 'fg-theme');
    ?>
    <div class="ba" data-compare-slider style="--pos:50%">
      <img class="ba__base" src="<?php echo esc_url($a['after']); ?>" alt="<?php echo esc_attr($a['after_alt'] ?? ''); ?>" loading="lazy" decoding="async">
      <div class="ba__top" aria-hidden="true">
        <img src="<?php echo esc_url($a['before']); ?>" alt="" loading="lazy" decoding="async">
      </div>
      <span class="ba__label ba__label--before"><?php echo esc_html($before); ?></span>
      <span class="ba__label ba__label--after"><?php echo esc_html($after); ?></span>
      <button type="button" class="ba__handle" role="slider" tabindex="0"
        aria-label="<?php esc_attr_e('Arrastre para comparar el antes con el después', 'fg-theme'); ?>"
        aria-valuemin="0" aria-valuemax="100" aria-valuenow="50">
        <span class="ba__handle-grip" aria-hidden="true"></span>
      </button>
    </div>
    <?php
}

/**
 * Ventana para ver una fotografía a tamaño grande.
 *
 * Se imprime una sola vez por página; main.js la rellena al pulsar cualquier
 * elemento con [data-lightbox] (que debe traer data-lb-src, data-lb-alt,
 * data-lb-title y data-lb-meta).
 */
function fg_lightbox(): void {
    ?>
    <dialog class="lightbox" data-lightbox-modal aria-label="<?php esc_attr_e('Fotografía ampliada', 'fg-theme'); ?>">
      <button type="button" class="lightbox__cerrar" data-lightbox-cerrar aria-label="<?php esc_attr_e('Cerrar', 'fg-theme'); ?>">&times;</button>
      <figure class="lightbox__figure">
        <img data-lightbox-img src="" alt="">
        <figcaption class="lightbox__cap">
          <span class="lightbox__title" data-lightbox-title></span>
          <span class="lightbox__meta" data-lightbox-meta></span>
        </figcaption>
      </figure>
    </dialog>
    <?php
}

/**
 * Banda verde de cifras con contadores animados.
 *
 * El HTML ya trae el número final escrito, así que se lee bien sin JavaScript
 * y con "reducir movimiento"; main.js solo lo anima al entrar en pantalla.
 *
 * @param array $stats    Cada elemento: num (texto final), count (valor numérico),
 *                        prefix, suffix, sep (separador de millares), label.
 * @param array $wm       Filigrana opcional para la banda (ver fg_watermark).
 * @param int   $duration Duración del conteo en ms (por defecto, la de main.js: 1600).
 */
function fg_stats_band(array $stats, array $wm = [], int $duration = 0): void {
    if (!$stats) return;
    echo '<section class="stats-band' . ($wm ? ' has-wm' : '') . '">';
    if ($wm) fg_watermark($wm);
    echo '<div class="wrap"><div class="stats-grid stats-grid--' . count($stats) . '" data-reveal>';
    foreach ($stats as $s) {
        echo '<div class="stat"><span class="stat__num"'
           . ' data-count="' . esc_attr((string) $s['count']) . '"'
           . (!empty($s['prefix']) ? ' data-prefix="' . esc_attr($s['prefix']) . '"' : '')
           . (!empty($s['suffix']) ? ' data-suffix="' . esc_attr($s['suffix']) . '"' : '')
           . (!empty($s['sep'])    ? ' data-sep="' . esc_attr($s['sep']) . '"' : '')
           . ($duration          ? ' data-duration="' . esc_attr((string) $duration) . '"' : '')
           . '>' . esc_html($s['num']) . '</span>'
           . '<span class="stat__label">' . esc_html($s['label']) . '</span></div>';
    }
    echo '</div></div></section>';
}

/**
 * Filigrana botánica de fondo (decorativa, sin peso semántico).
 *
 * Pinta una silueta de planta a gran tamaño y muy baja opacidad detrás del
 * contenido. El SVG se aplica como máscara, así que se tiñe con el color de
 * marca que se le pase (no depende del color original del archivo).
 * La sección que la contiene debe llevar la clase `has-wm`.
 *
 * @param array $a src (ruta en assets/img), pos (tr|tl|br|bl|cl|cr), size (CSS),
 *                 ratio (aspect-ratio CSS), opacity, color (CSS), flip (bool),
 *                 shadow (bool: desenfoca la silueta y la funde en --ink por
 *                         multiply, para leerse como sombra de follaje en vez
 *                         de motivo botánico trazado — ver .wm--shadow),
 *                 float (int: px de deriva vertical al hacer scroll; 0 = quieta),
 *                 rot (grados de giro a lo largo del recorrido),
 *                 scrub (inercia: 0 = pegada al scroll, 1.5 = va rezagada y
 *                        sigue moviéndose un instante después; con valores
 *                        distintos por filigrana se consigue profundidad).
 */
function fg_watermark(array $a = []): void {
    $src   = fg_asset($a['src'] ?? 'hojita.svg');
    $pos   = $a['pos'] ?? 'br';
    $style = "--wm-src:url('" . esc_url($src) . "')";
    foreach (['size' => '--wm-size', 'ratio' => '--wm-ratio', 'opacity' => '--wm-opacity', 'color' => '--wm-color'] as $k => $var) {
        if (!empty($a[$k])) $style .= ';' . $var . ':' . $a[$k];
    }
    $cls   = 'wm wm--' . preg_replace('/[^a-z-]/', '', $pos)
           . (!empty($a['flip']) ? ' wm--flip' : '')
           . (!empty($a['shadow']) ? ' wm--shadow' : '');
    $float = isset($a['float']) ? (int) $a['float'] : 60;

    echo '<span class="' . esc_attr($cls) . '" style="' . esc_attr($style) . '"'
       . ($float ? ' data-wm-float="' . esc_attr((string) $float) . '"' : '')
       . (isset($a['rot'])   ? ' data-wm-rot="' . esc_attr((string) $a['rot']) . '"' : '')
       . (isset($a['scrub']) ? ' data-wm-scrub="' . esc_attr((string) $a['scrub']) . '"' : '')
       . ' aria-hidden="true"></span>';
}

/**
 * Banda de cita a sangre: fotografía con parallax y una frase grande encima.
 * $a: image, image_alt, text (marcado ya escapado por el llamador).
 *
 * La comilla gigante lleva su propio data-parallax, más lento que el de la
 * foto (0.09 frente a 0.32): dos planos que se desplazan a distinta
 * velocidad son lo que el ojo lee como profundidad real, no solo un fondo
 * que se mueve solo.
 */
function fg_quote_band(array $a): void {
    $cls = 'quote-band' . (!empty($a['compact']) ? ' quote-band--compact' : '');
    ?>
    <section class="<?php echo esc_attr($cls); ?>">
      <img class="quote-band__img" data-parallax="0.32"
           src="<?php echo esc_url($a['image']); ?>"
           alt="<?php echo esc_attr($a['image_alt'] ?? ''); ?>" loading="lazy" decoding="async">
      <div class="quote-band__scrim" aria-hidden="true"></div>
      <div class="wrap quote-band__inner">
        <div class="quote-band__quote">
          <span class="quote-band__mark" aria-hidden="true" data-parallax="0.09">&ldquo;</span>
          <p class="quote-band__text" data-reveal><?php echo $a['text']; ?></p>
        </div>
      </div>
    </section>
    <?php
}

/**
 * Servicios en filas anchas alternadas (texto ↔ fotografía), numeradas con
 * romanos. Es el módulo que sustituye a la rejilla de cuatro tarjetas: cada
 * servicio ocupa su franja y se lee como un índice de revista.
 *
 * $items: title, body, url, cta (rótulo del enlace), image, image_alt, icon,
 * eyebrow (rótulo corto opcional en versalitas sobre el título — p. ej. la
 * ubicación de un proyecto).
 * $extra_class: clase adicional en el contenedor (p. ej. 'service-rows--projects').
 */
function fg_service_rows(array $items, string $extra_class = ''): void {
    $romanos = ['I', 'II', 'III', 'IV', 'V', 'VI'];
    echo '<div class="service-rows' . ($extra_class ? ' ' . esc_attr($extra_class) : '') . '">';
    foreach ($items as $i => $it) {
        $flip = $i % 2 === 1; // las impares llevan la foto a la izquierda
        ?>
        <a class="service-row<?php echo $flip ? ' service-row--flip' : ''; ?>" href="<?php echo esc_url($it['url']); ?>">
          <div class="service-row__text">
            <span class="service-row__bignum" aria-hidden="true"><?php echo esc_html($romanos[$i] ?? (string) ($i + 1)); ?></span>
            <span class="service-row__num" aria-hidden="true"><?php echo esc_html($romanos[$i] ?? (string) ($i + 1)); ?></span>
            <div>
              <?php if (!empty($it['eyebrow'])) : ?>
                <span class="service-row__eyebrow"><?php echo esc_html($it['eyebrow']); ?></span>
              <?php endif; ?>
              <h3 class="service-row__title" data-reveal><?php echo esc_html($it['title']); ?></h3>
              <p class="service-row__body"><?php echo esc_html($it['body']); ?></p>
              <span class="cta service-row__cta">
                <span class="cta__label"><?php echo esc_html($it['cta'] ?? $it['title']); ?></span>
                <?php echo fg_arrow('cta__arrow'); ?>
              </span>
            </div>
          </div>
          <div class="service-row__media fx-frame" data-img-reveal>
            <img src="<?php echo esc_url($it['image']); ?>" alt="<?php echo esc_attr($it['image_alt'] ?? ''); ?>"
                 loading="lazy" decoding="async">
            <?php if (!empty($it['icon'])) : ?>
              <span class="service-row__icon" aria-hidden="true">
                <img src="<?php echo esc_url($it['icon']); ?>" alt="" loading="lazy" decoding="async">
              </span>
            <?php endif; ?>
          </div>
        </a>
        <?php
    }
    echo '</div>';
}

/**
 * Carrusel de reseñas: se arrastra con el ratón, se desliza con el dedo y
 * avanza solo mientras está a la vista. La tarjeta central se destaca; las
 * laterales se atenúan (main.js → rail).
 *
 * $items: quote, author, meta, icon, tone ('claro'|'oscuro'), y para la
 * tarjeta final de llamada a la acción: kind => 'cta', image, title, cta_label,
 * cta_url.
 */
function fg_testimonial_rail(array $items): void {
    ?>
    <div class="rail" data-rail>
      <?php foreach ($items as $i => $it) :
        $num = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
        if (($it['kind'] ?? '') === 'cta') : ?>
          <figure class="rail-card rail-card--foto" data-rail-item>
            <img class="rail-card__bg" src="<?php echo esc_url($it['image']); ?>"
                 alt="<?php echo esc_attr($it['image_alt'] ?? ''); ?>" loading="lazy" decoding="async">
            <span class="rail-card__scrim" aria-hidden="true"></span>
            <div class="rail-card__cta-body">
              <span class="rail-card__medal">
                <img src="<?php echo esc_url(fg_asset('hojita.svg')); ?>" alt="" aria-hidden="true" width="16" height="19">
              </span>
              <p class="rail-card__cta-title"><?php echo esc_html($it['title']); ?></p>
              <?php echo fg_pill($it['cta_label'], $it['cta_url'], 'solid'); ?>
            </div>
          </figure>
        <?php else : ?>
          <figure class="rail-card rail-card--<?php echo esc_attr($it['tone'] ?? 'claro'); ?>" data-rail-item>
            <span class="rail-card__mark" aria-hidden="true">&rdquo;</span>
            <div class="rail-card__head">
              <span class="rail-card__medal">
                <img src="<?php echo esc_url($it['icon']); ?>" alt="" aria-hidden="true" width="28" height="28" loading="lazy" decoding="async">
              </span>
              <span class="rail-card__num"><?php echo esc_html($num); ?></span>
            </div>
            <blockquote class="rail-card__quote"><?php echo esc_html($it['quote']); ?></blockquote>
            <figcaption class="rail-card__foot">
              <span class="rail-card__author"><?php echo esc_html($it['author']); ?></span>
              <span class="rail-card__meta"><?php echo esc_html($it['meta']); ?></span>
            </figcaption>
          </figure>
        <?php endif;
      endforeach; ?>
    </div>
    <div class="rail-hint" aria-hidden="true">
      <span><?php esc_html_e('Desliza', 'fg-theme'); ?></span>
      <span class="rail-hint__rule"></span>
    </div>
    <?php
}

/** Controles del carrusel (contador, progreso y flechas). */
function fg_rail_controls(): void {
    ?>
    <div class="rail-nav">
      <span class="rail-nav__counter" data-rail-counter>01 / 01</span>
      <span class="rail-nav__track"><span data-rail-progress></span></span>
      <button type="button" class="rail-nav__btn rail-nav__btn--prev" data-rail-prev
              aria-label="<?php esc_attr_e('Reseña anterior', 'fg-theme'); ?>"><?php echo fg_arrow('rail-nav__arrow'); ?></button>
      <button type="button" class="rail-nav__btn rail-nav__btn--next" data-rail-next
              aria-label="<?php esc_attr_e('Siguiente reseña', 'fg-theme'); ?>"><?php echo fg_arrow('rail-nav__arrow'); ?></button>
    </div>
    <?php
}

/**
 * Marquesina de zonas de trabajo: cinta continua sobre verde oscuro.
 * main.js duplica la pista para que el bucle no tenga costura.
 */
/** Zonas de trabajo por defecto (Marbella, San Pedro, Estepona, Ronda, Costa del Sol, Málaga). */
function fg_default_zones(): array {
    return [
        ['label' => __('Marbella', 'fg-theme')],
        ['label' => __('San Pedro Alcántara', 'fg-theme'), 'destacada' => true],
        ['label' => __('Estepona', 'fg-theme')],
        ['label' => __('Ronda', 'fg-theme')],
        ['label' => __('Costa del Sol', 'fg-theme'), 'destacada' => true],
        ['label' => __('Málaga', 'fg-theme')],
    ];
}

function fg_zones_marquee(array $zonas): void {
    $hoja = esc_url(fg_asset('hojita.svg'));
    ?>
    <section class="zones" aria-label="<?php esc_attr_e('Zonas de trabajo', 'fg-theme'); ?>">
      <div class="zones__viewport">
        <div class="zones__track" data-marquee>
          <?php foreach ($zonas as $z) :
            $destacada = !empty($z['destacada']); ?>
            <span class="zones__item<?php echo $destacada ? ' zones__item--em' : ''; ?>"><?php echo esc_html($z['label']); ?></span>
            <img class="zones__leaf" src="<?php echo $hoja; ?>" alt="" aria-hidden="true" width="12" height="14" loading="lazy" decoding="async">
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php
}

/**
 * Bloque de contacto enmarcado sobre fotografía. Es el cierre del sitio: la
 * portada y todas las páginas de contenido terminan igual, de modo que la
 * llamada a la acción se lee siempre en el mismo sitio y con el mismo gesto.
 *
 * @param string $tab Rótulo del marco (arriba a la izquierda). Cada página
 *                    pone el suyo; sin él se usa el de marca.
 */
function fg_contact_band(string $tab = ''): void {
    $tab = $tab !== '' ? $tab : sprintf(
        /* translators: %s: nombre del sitio. */
        __('%s · Marbella', 'fg-theme'),
        get_bloginfo('name') ?: 'Fantastic Gardens'
    );
    ?>
    <section class="contact-band" id="contacto">
      <img class="contact-band__img" data-parallax="0.1"
           src="<?php echo esc_url(fg_asset('hero-contacto.jpg')); ?>"
           alt="" aria-hidden="true" loading="lazy" decoding="async">
      <div class="contact-band__scrim" aria-hidden="true"></div>

      <div class="wrap">
        <div class="contact-band__frame">
          <span class="contact-band__tab" aria-hidden="true"><?php echo esc_html($tab); ?></span>
          <span class="contact-band__motif" aria-hidden="true"
                style="--motif-src:url('<?php echo esc_url(fg_asset('logo-fg.svg')); ?>')"
                data-wm-float="22" data-wm-rot="4"></span>

          <div class="contact-band__grid">
            <div>
              <div class="kicker kicker--light" data-reveal>
                <span class="kicker__rule" aria-hidden="true"></span>
                <span class="kicker__label"><?php esc_html_e('Presupuestos sin compromiso', 'fg-theme'); ?></span>
              </div>
              <h2 class="contact-band__title" data-reveal data-reveal-delay="70">
                <?php esc_html_e('¿Hablamos', 'fg-theme'); ?><em class="em-lima">?</em>
              </h2>
              <p class="contact-band__lead" data-reveal data-reveal-delay="140">
                <?php esc_html_e('Realizamos presupuestos sin compromiso, siempre ajustándonos a ellos y a los tiempos de entrega, con los mejores resultados del sector.', 'fg-theme'); ?>
              </p>
            </div>

            <div>
              <div class="contact-band__sedes">
                <div data-reveal data-reveal-delay="180">
                  <span class="contact-band__sede-label"><?php esc_html_e('Oficinas', 'fg-theme'); ?></span>
                  <span class="contact-band__sede-name"><?php esc_html_e('San Pedro Alcántara', 'fg-theme'); ?></span>
                </div>
                <div data-reveal data-reveal-delay="230">
                  <span class="contact-band__sede-label"><?php esc_html_e('Garden center', 'fg-theme'); ?></span>
                  <span class="contact-band__sede-name"><?php esc_html_e('Ronda, Málaga', 'fg-theme'); ?></span>
                </div>
              </div>
              <div class="contact-band__acciones">
                <span data-reveal data-reveal-delay="270"><?php echo fg_pill(__('Solicitar presupuesto', 'fg-theme'), fg_page_url('contacto'), 'solid'); ?></span>
                <span data-reveal data-reveal-delay="310"><?php echo fg_pill(__('Ver datos de contacto', 'fg-theme'), fg_page_url('contacto'), 'ghost'); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
}

/**
 * Cierre estándar de página: marquesina de zonas + bloque de contacto.
 * Sustituye a la antigua barra fina de tagline, que se quedaba corta como
 * final de página en el lenguaje nuevo.
 */
function fg_site_closing(string $tab = ''): void {
    fg_zones_marquee(fg_default_zones());
    fg_contact_band($tab);
}

/**
 * Línea de tiempo vertical (hitos reales de la empresa, página Historia).
 * $items: [['year','title','text'], ...].
 */
function fg_timeline(array $items): void {
    $romanos = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII'];
    echo '<div class="timeline">';
    foreach ($items as $i => $it) {
        echo '<div class="timeline__item" data-reveal>';
        echo '<span class="timeline__bignum" aria-hidden="true">' . esc_html($romanos[$i] ?? (string) ($i + 1)) . '</span>';
        echo '<span class="timeline__dot" aria-hidden="true"></span>';
        echo '<span class="timeline__year">';
        if (!empty($it['icon'])) echo '<span class="timeline__icon" aria-hidden="true">' . fg_icon_or_asset($it['icon']) . '</span>';
        echo esc_html($it['year']) . '</span>';
        echo '<div class="timeline__content">';
        echo '<h3 class="timeline__title">' . esc_html($it['title']) . '</h3>';
        echo '<p class="timeline__text">' . esc_html($it['text']) . '</p>';
        echo '</div></div>';
    }
    echo '</div>';
}

/** Lista ordenada de pasos numerados en romanos (proceso de trabajo de una página de servicio). */
function fg_numbered_grid(array $pasos): void {
    $romanos = ['I', 'II', 'III', 'IV', 'V', 'VI'];
    echo '<ol class="numbered-grid">';
    foreach ($pasos as $i => $paso) {
        $num = $romanos[$i] ?? sprintf('%02d', $i + 1);
        echo '<li class="numbered-grid__item" data-reveal data-reveal-delay="' . esc_attr((string) (60 + $i * 40)) . '">';
        echo '<span class="numbered-grid__bignum" aria-hidden="true">' . esc_html($num) . '</span>';
        echo '<span class="numbered-grid__num" aria-hidden="true">' . esc_html($num) . '</span>';
        echo '<span class="numbered-grid__text">' . esc_html($paso) . '</span>';
        echo '</li>';
    }
    echo '</ol>';
}
