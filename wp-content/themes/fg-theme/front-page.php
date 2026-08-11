<?php
/**
 * Portada. Compone las secciones de la home en el orden del index de
 * referencia: hero, 01 estudio, cita, 02 servicios, 03 garantía, 04 proyectos,
 * 05 botánica, 06 clientes, zonas y contacto.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
get_header();

get_template_part('template-parts/home/hero');
get_template_part('template-parts/home/estudio');

fg_quote_band([
    'image'     => fg_asset('hero-jardines-permanecen.jpg'),
    'image_alt' => __('Jardín mediterráneo diseñado por Fantastic Gardens', 'fg-theme'),
    'text'      => sprintf(
        /* translators: %s: la palabra "permanecen" en cursiva. */
        esc_html__('Los jardines que %s se piensan antes de plantarse.', 'fg-theme'),
        '<em>' . esc_html__('permanecen', 'fg-theme') . '</em>'
    ),
]);

get_template_part('template-parts/home/servicios');
get_template_part('template-parts/home/garantia');
get_template_part('template-parts/home/proyectos');
get_template_part('template-parts/home/vivero');
get_template_part('template-parts/home/resenas');
get_template_part('template-parts/home/zonas');
get_template_part('template-parts/home/contacto');

get_footer();
