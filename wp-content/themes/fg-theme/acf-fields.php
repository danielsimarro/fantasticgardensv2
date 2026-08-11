<?php
/**
 * Campos ACF (opcionales). Si Advanced Custom Fields no está activo, el tema usa
 * los assets incluidos como fallback, así que sigue funcionando sin ACF.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
if (!function_exists('acf_add_local_field_group')) return;

/* ── Portada (home) — media del hero ─────────────────────────────── */
acf_add_local_field_group([
    'key'      => 'group_fg_home',
    'title'    => 'Portada — Hero',
    'location' => [[
        ['param' => 'page_type', 'operator' => '==', 'value' => 'front_page'],
    ]],
    'menu_order'      => 0,
    'position'        => 'normal',
    'label_placement' => 'top',
    'fields' => [
        [
            'key'          => 'field_fg_hero_video',
            'name'         => 'hero_video',
            'label'        => 'Hero — Vídeo de fondo (escritorio)',
            'instructions' => 'MP4 apaisado (16:9), sin audio recomendado, ligero (< 2 MB). Se reproduce en bucle solo en escritorio. Si se deja vacío, se usa el vídeo incluido en el tema.',
            'type'         => 'file',
            'return_format'=> 'id',
            'mime_types'   => 'mp4',
            'required'     => 0,
        ],
        [
            'key'          => 'field_fg_hero_poster',
            'name'         => 'hero_poster',
            'label'        => 'Hero — Póster (escritorio)',
            'instructions' => 'Imagen apaisada. Debe coincidir con el primer fotograma del vídeo. Es la imagen que se muestra mientras carga el vídeo (y su fallback).',
            'type'         => 'image',
            'return_format'=> 'id',
            'preview_size' => 'medium',
            'required'     => 0,
        ],
        [
            'key'          => 'field_fg_hero_mobile',
            'name'         => 'hero_mobile',
            'label'        => 'Hero — Imagen móvil (vertical 3:4)',
            'instructions' => 'Imagen vertical 3:4. Se muestra en móvil en lugar del vídeo. Mínimo 1000 × 1330 px.',
            'type'         => 'image',
            'return_format'=> 'id',
            'preview_size' => 'medium',
            'required'     => 0,
        ],
    ],
]);
