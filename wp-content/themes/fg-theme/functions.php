<?php

defined('ABSPATH') || exit;

/* ----------------------------------------------------------------
   Theme setup
---------------------------------------------------------------- */
function fg_setup(): void {
    load_theme_textdomain('fg-theme', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');

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
    $v = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'fg-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style('fg-main', get_template_directory_uri() . '/assets/css/main.css', ['fg-fonts'], $v);

    wp_enqueue_script('fg-main', get_template_directory_uri() . '/assets/js/main.js', [], $v, true);
}
add_action('wp_enqueue_scripts', 'fg_enqueue_assets');

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
        'supports'      => ['title', 'thumbnail', 'excerpt'],
        'menu_icon'     => 'dashicons-image-rotate',
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'fg_register_cpt_proyectos');

/* ----------------------------------------------------------------
   Remove WordPress junk from <head>
---------------------------------------------------------------- */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
add_filter('the_generator', '__return_empty_string');
