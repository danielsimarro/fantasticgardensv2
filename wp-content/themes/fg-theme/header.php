<?php
/**
 * Cabecera. Flota siempre; sobre un hero fotográfico a sangre va transparente
 * y en claro, y se asienta en crema al bajar (clase .is-solid desde main.js).
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

/**
 * Navegación por defecto (fallback), solo si no hay un menú real asignado a la
 * ubicación 'primary-menu' en Apariencia → Menús. Estructura plana: sin hub de
 * Proyectos, tal y como está publicado hoy el sitio.
 */
function fg_default_nav(): array {
    return [
        ['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')],
        ['label' => __('Servicios', 'fg-theme'), 'url' => fg_page_url('servicios'), 'children' => [
            ['label' => __('Diseño de paisajes', 'fg-theme'), 'url' => fg_page_url('diseno')],
            ['label' => __('Mantenimiento', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ['label' => __('Vivero y plantación propia', 'fg-theme'), 'url' => fg_page_url('vivero')],
            ['label' => __('Descubrir especies', 'fg-theme'), 'url' => fg_page_url('especies')],
        ]],
        ['label' => __('Proyectos realizados', 'fg-theme'), 'url' => fg_page_url('proyectos')],
        ['label' => __('Antes y Después', 'fg-theme'), 'url' => fg_page_url('antes-despues')],
        ['label' => __('Historia', 'fg-theme'), 'url' => fg_page_url('historia')],
        ['label' => __('Contacto', 'fg-theme'), 'url' => fg_page_url('contacto')],
    ];
}

/**
 * Estructura de navegación real, leída del menú asignado a 'primary-menu'
 * (Apariencia → Menús), para que siga siendo editable desde el admin. Si no
 * hay ningún menú asignado, cae al array de fg_default_nav().
 */
function fg_get_primary_nav(): array {
    $locations = get_nav_menu_locations();
    if (empty($locations['primary-menu'])) return fg_default_nav();

    $items = wp_get_nav_menu_items($locations['primary-menu']);
    if (!$items) return fg_default_nav();

    $nodes = [];
    foreach ($items as $mi) {
        $nodes[$mi->ID] = [
            'label'  => $mi->title,
            'url'    => $mi->url,
            'parent' => (int) $mi->menu_item_parent,
        ];
    }

    $tree = [];
    foreach ($nodes as $id => $node) {
        if ($node['parent'] && isset($nodes[$node['parent']])) continue;
        $entry = ['label' => $node['label'], 'url' => $node['url'], 'children' => []];
        foreach ($nodes as $child) {
            if ($child['parent'] === $id) {
                $entry['children'][] = ['label' => $child['label'], 'url' => $child['url']];
            }
        }
        $tree[] = $entry;
    }
    return $tree;
}

$fg_home = is_front_page();
$fg_over = fg_has_over_header(); // hero a sangre bajo la cabecera
$fg_nav  = fg_get_primary_nav();

// Página actual (para el estado activo del menú): compara solo por la ruta
// (sin esquema/host), así que da igual que el enlace del menú sea relativo
// ("/") o absoluto, y funciona igual venga la navegación del admin o del fallback.
$fg_path = static function (string $url): string {
    $path = wp_parse_url($url, PHP_URL_PATH);
    return trailingslashit($path ? $path : '/');
};
$fg_current = $fg_path((string) (get_permalink() ?: ($_SERVER['REQUEST_URI'] ?? '/')));
$fg_is_active = static function (array $item) use ($fg_current, $fg_path): bool {
    if (empty($item['url'])) return false;
    if ($fg_path($item['url']) === $fg_current) return true;
    foreach ($item['children'] ?? [] as $child) {
        if ($fg_path($child['url']) === $fg_current) return true;
    }
    return false;
};

$fg_body_class = [];
if ($fg_home) $fg_body_class[] = 'is-home';
if ($fg_over) $fg_body_class[] = 'has-over-header';

$fg_brand       = fg_opt('brand');
$fg_brand_sub   = fg_opt('brand_sub');
// En la cabecera contraída de móvil no cabe la línea completa ("Marbella ·
// Costa del Sol"): se muestra solo el último tramo ("Costa del Sol"). El
// menú a pantalla completa sigue mostrando la línea entera.
$fg_brand_sub_short = $fg_brand_sub;
if (strpos($fg_brand_sub, '·') !== false) {
    $fg_brand_sub_parts = explode('·', $fg_brand_sub);
    $fg_brand_sub_short = trim(end($fg_brand_sub_parts));
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class($fg_body_class); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e('Saltar al contenido', 'fg-theme'); ?></a>

<div class="scroll-progress" aria-hidden="true"><span data-progress></span></div>

<header class="site-header<?php echo $fg_over ? ' site-header--over' : ''; ?>" id="site-header" data-header>
  <?php if ($fg_over) : ?><div class="site-header__veil" aria-hidden="true"></div><?php endif; ?>
  <div class="wrap site-header__inner">

    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr($fg_brand); ?>">
      <?php if (get_theme_mod('custom_logo')) : ?>
        <?php fg_logo(['loading' => 'eager']); ?>
      <?php else : ?>
        <img class="brand__mark" src="<?php echo esc_url(fg_asset('logo-fg.svg')); ?>"
             alt="<?php echo esc_attr($fg_brand); ?>" width="65" height="60" fetchpriority="high" decoding="async">
        <span class="brand__word">
          <span class="brand__sub">
            <span class="brand__sub-full"><?php echo esc_html($fg_brand_sub); ?></span>
            <span class="brand__sub-short"><?php echo esc_html($fg_brand_sub_short); ?></span>
          </span>
        </span>
      <?php endif; ?>
    </a>

    <nav class="nav-desktop" aria-label="<?php esc_attr_e('Navegación principal', 'fg-theme'); ?>">
      <?php foreach ($fg_nav as $item) :
        $active = $fg_is_active($item);
        $has_children = !empty($item['children']); ?>
        <div class="nav-item<?php echo $has_children ? ' has-children' : ''; ?>">
          <a class="nav-link<?php echo $active ? ' is-active' : ''; ?>" href="<?php echo esc_url($item['url']); ?>"<?php echo $active ? ' aria-current="page"' : ''; ?>>
            <?php echo esc_html($item['label']); ?>
            <?php if ($has_children) : ?>
              <svg class="nav-caret" viewBox="0 0 10 6" width="10" height="6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php endif; ?>
          </a>
          <?php if ($has_children) : ?>
            <div class="nav-dropdown">
              <ul>
                <?php foreach ($item['children'] as $child) : ?>
                  <li><a href="<?php echo esc_url($child['url']); ?>"><?php echo esc_html($child['label']); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <?php fg_lang_switcher($fg_current); ?>

      <a class="pill pill--verde nav-cta" href="<?php echo esc_url(fg_page_url('contacto')); ?>">
        <span><?php esc_html_e('Presupuesto', 'fg-theme'); ?></span>
        <?php echo fg_arrow('pill__arrow'); ?>
      </a>
    </nav>

    <div class="header-mobile-actions">
      <?php fg_lang_switcher($fg_current, 'nav-lang--header'); ?>
      <button class="nav-toggle" aria-label="<?php esc_attr_e('Abrir menú', 'fg-theme'); ?>" aria-expanded="false" aria-controls="nav-mobile">
        <span class="nav-toggle__bars" aria-hidden="true"></span>
        <?php esc_html_e('Menú', 'fg-theme'); ?>
      </button>
    </div>
  </div>
</header>

<div class="nav-overlay" id="nav-mobile">
  <?php
  fg_watermark([
    'src' => 'hojita.svg', 'pos' => 'tr', 'ratio' => '581 / 690',
    'size' => 'clamp(13rem, 46vw, 20rem)', 'opacity' => '.08', 'color' => 'var(--crema)',
    'float' => 26, 'rot' => 5,
  ]); ?>

  <div class="nav-overlay__top">
    <span class="nav-overlay__brand">
      <span class="nav-overlay__word"><?php echo esc_html($fg_brand); ?></span>
      <?php if ($fg_brand_sub) : ?><span class="nav-overlay__tagline"><?php echo esc_html($fg_brand_sub); ?></span><?php endif; ?>
    </span>
    <button type="button" class="nav-overlay__close" data-nav-close><?php esc_html_e('Cerrar', 'fg-theme'); ?></button>
  </div>

  <div class="kicker kicker--light nav-overlay__kicker" aria-hidden="true">
    <span class="kicker__rule"></span>
    <span class="kicker__label"><?php esc_html_e('Menú', 'fg-theme'); ?></span>
  </div>

  <nav class="nav-overlay__nav" aria-label="<?php esc_attr_e('Menú móvil', 'fg-theme'); ?>">
    <?php $fg_i = 0; foreach ($fg_nav as $item) :
      $fg_i++;
      $active = $fg_is_active($item);
      $has_children = !empty($item['children']);
      $num = str_pad((string) $fg_i, 2, '0', STR_PAD_LEFT);
    ?>
      <div class="nav-overlay__item<?php echo $has_children ? ' has-children' : ''; ?><?php echo $active ? ' is-active' : ''; ?>">
        <div class="nav-overlay__row">
          <a class="nav-overlay__link" href="<?php echo esc_url($item['url']); ?>"<?php echo $active ? ' aria-current="page"' : ''; ?>>
            <span class="nav-overlay__num" aria-hidden="true"><?php echo esc_html($num); ?></span>
            <span class="nav-overlay__label"><?php echo esc_html($item['label']); ?></span>
          </a>
          <?php if ($has_children) : ?>
            <button type="button" class="nav-overlay__caret" data-nav-accordion aria-expanded="false"
                    aria-label="<?php echo esc_attr(sprintf(__('Mostrar submenú de %s', 'fg-theme'), $item['label'])); ?>">
              <svg viewBox="0 0 10 6" width="10" height="6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          <?php endif; ?>
        </div>
        <?php if ($has_children) : ?>
          <div class="nav-overlay__sub" data-nav-panel>
            <div class="nav-overlay__sub-inner">
              <?php foreach ($item['children'] as $child) : ?>
                <a href="<?php echo esc_url($child['url']); ?>"><?php echo esc_html($child['label']); ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </nav>

  <div class="nav-overlay__cta">
    <a class="pill pill--verde" href="<?php echo esc_url(fg_page_url('contacto')); ?>">
      <span><?php esc_html_e('Presupuesto sin compromiso', 'fg-theme'); ?></span>
      <?php echo fg_arrow('pill__arrow'); ?>
    </a>
    <?php $fg_wa = fg_opt('phone_href'); if ($fg_wa) : ?>
      <a class="nav-overlay__whatsapp" href="https://wa.me/<?php echo esc_attr(str_replace('+', '', $fg_wa)); ?>">
        <?php echo fg_icon('phone'); ?>
        <span><?php echo esc_html(fg_opt('phone')); ?> · WhatsApp</span>
      </a>
    <?php endif; ?>
  </div>

  <div class="nav-overlay__foot">
    <span><?php esc_html_e('San Pedro Alcántara · Marbella', 'fg-theme'); ?></span>
    <span><?php esc_html_e('Vivero en Ronda', 'fg-theme'); ?></span>
  </div>
</div>

<main id="main">
