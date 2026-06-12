<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container site-header__inner">

    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
      <?php if (has_custom_logo()): the_custom_logo(); else: ?>
        <span><?php bloginfo('name'); ?></span>
      <?php endif; ?>
    </a>

    <nav class="site-nav" aria-label="<?php esc_attr_e('Menú principal', 'fg-theme'); ?>">
      <?php wp_nav_menu(['theme_location' => 'primary-menu', 'container' => false]); ?>
    </nav>

    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contacto-empresa-jardineria'))); ?>" class="btn btn--primary site-header__cta">
      <?php esc_html_e('Solicitar presupuesto', 'fg-theme'); ?>
    </a>

    <button class="nav-toggle" aria-label="<?php esc_attr_e('Abrir menú', 'fg-theme'); ?>" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>
