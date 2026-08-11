<?php
/**
 * Contenido ampliado de cada ficha del CPT `proyecto` — resumen, reto y
 * solución, cifras y galería de la vista individual (single-proyecto.php).
 *
 * ------------------------------------------------------------------------
 * CÓMO EDITAR ESTE ARCHIVO
 * ------------------------------------------------------------------------
 * Cada proyecto se identifica por su ID de WordPress (fijo, no cambia aunque
 * se edite el slug o el título). Para añadir un proyecto nuevo, añade una
 * clave más al array de fg_proyecto_detalle().
 *
 * Campos:
 *   resumen    Entradilla de una o dos frases bajo las cifras.
 *   reto       ['titulo' => ..., 'texto' => ...] — el punto de partida.
 *   solucion   ['titulo' => ..., 'texto' => ...] — lo que se hizo.
 *   specs      Cifras con icono: [ 'icon' => clave de fg_icon() o ruta de
 *              imagen, 'label' => ..., 'value' => ... ].
 *   servicios  Chips de servicio con enlace: [ 'icon' => ruta de imagen,
 *              'label' => ..., 'url' => fg_page_url(clave) ].
 *   galeria    Fotos adicionales a la destacada: [ 'img' => archivo en
 *              assets/img/, 'alt' => ... ].
 *
 * AVISO: los proyectos 24 (Villa Mediterránea) y 25 (Jardín con Palmeras)
 * son obras reales (fotografía real del cliente), pero sus cifras de
 * superficie y duración son estimaciones redactadas por el estudio a falta
 * de datos exactos del cliente — pendientes de confirmar antes de tratarlas
 * como dato verificado (ver Pendientes en CLAUDE.md). El proyecto 26
 * ("Jardín en Ronda") usa en su lugar las cifras reales del vivero/Garden
 * Center de Ronda (superficie de cultivo, especies, nave cubierta) ya
 * publicadas en el resto del sitio, porque su fotografía real es del propio
 * vivero — no de un jardín de cliente instalado — y no había una cifra de
 * proyecto que inventar sin contradecir la foto.
 *
 * @package Fantastic_Gardens
 */

if (!defined('ABSPATH')) exit;

/** Detalle ampliado de un proyecto por ID de post. Null si no hay ficha. */
function fg_proyecto_detalle(int $post_id): ?array {
    $data = [
        // Villa Mediterránea · Marbella
        24 => [
            'resumen'  => __('Una parcela recién construida junto a la piscina, todavía en obra, transformada en un jardín mediterráneo de líneas limpias: césped natural, palmeras washingtonia y un porche envuelto en vegetación.', 'fg-theme'),
            'reto'     => [
                'titulo' => __('El reto', 'fg-theme'),
                'texto'  => __('La parcela llegaba recién construida: tierra suelta, sin una sola planta y una piscina todavía sin vestir. El jardín tenía que sentirse maduro desde el primer día, no años después.', 'fg-theme'),
            ],
            'solucion' => [
                'titulo' => __('La solución', 'fg-theme'),
                'texto'  => __('Césped natural envolviendo el vaso, palmeras washingtonia como eje visual junto al porche y un perímetro de seto bajo que enmarca la parcela sin robarle vistas a la piscina.', 'fg-theme'),
            ],
            'specs'    => [
                ['icon' => 'pin',      'label' => __('Ubicación', 'fg-theme'), 'value' => __('Marbella · Costa del Sol', 'fg-theme')],
                ['icon' => 'area',     'label' => __('Superficie', 'fg-theme'), 'value' => __('≈ 1.200 m²', 'fg-theme')],
                ['icon' => 'calendar', 'label' => __('Duración de la obra', 'fg-theme'), 'value' => __('4 meses', 'fg-theme')],
            ],
            'servicios' => [
                ['icon' => 'icons/servicios/concepto-pencil.svg',     'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
                ['icon' => 'icons/servicios/plantacion-destino.svg',  'label' => __('Plantación', 'fg-theme'), 'url' => fg_page_url('vivero')],
                ['icon' => 'icons/servicios/poda-formacion.svg',      'label' => __('Mantenimiento', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ],
            'galeria' => [
                ['img' => 'villa-mediterranea-marbella-piscina-pergola-jardin.jpg', 'alt' => __('Jardín de Villa Mediterránea en Marbella con piscina, pérgola y palmeras', 'fg-theme')],
            ],
        ],

        // Jardín con Palmeras · Benahavís
        25 => [
            'resumen'  => __('Un jardín pensado alrededor de sus propias palmeras: sombra natural, vegetación mediterránea de bajo mantenimiento y un césped que resiste el sol de Benahavís todo el año.', 'fg-theme'),
            'reto'     => [
                'titulo' => __('El reto', 'fg-theme'),
                'texto'  => __('La parcela ya contaba con ejemplares de palmera consolidados, pero el resto del jardín no estaba a su altura: vegetación dispersa, sin un diseño que los pusiera en valor.', 'fg-theme'),
            ],
            'solucion' => [
                'titulo' => __('La solución', 'fg-theme'),
                'texto'  => __('Se reorganizó la plantación alrededor de las palmeras existentes, con macizos de vegetación mediterránea de bajo consumo de agua y un césped continuo que unifica la parcela.', 'fg-theme'),
            ],
            'specs'    => [
                ['icon' => 'pin',      'label' => __('Ubicación', 'fg-theme'), 'value' => __('Benahavís · Málaga', 'fg-theme')],
                ['icon' => 'area',     'label' => __('Superficie', 'fg-theme'), 'value' => __('≈ 950 m²', 'fg-theme')],
                ['icon' => 'calendar', 'label' => __('Duración de la obra', 'fg-theme'), 'value' => __('3 meses', 'fg-theme')],
            ],
            'servicios' => [
                ['icon' => 'icons/servicios/concepto-pencil.svg',    'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
                ['icon' => 'icons/servicios/vegetacion-sprig.svg',   'label' => __('Plantación', 'fg-theme'), 'url' => fg_page_url('vivero')],
                ['icon' => 'icons/servicios/riego-eficiente.svg',    'label' => __('Riego eficiente', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ],
            'galeria' => [
                ['img' => 'detalle-hoja-palmera-mediterranea-jardin.jpg', 'alt' => __('Detalle de una hoja de palmera mediterránea', 'fg-theme')],
            ],
        ],

        // Jardín en Ronda (vivero / Garden Center — ver aviso arriba)
        26 => [
            'resumen'  => __('Antes de llegar a cualquier jardín, cada planta pasa por nuestro vivero de Ronda: 40 hectáreas de cultivo propio en plena Serranía, con más de 17.000 especies disponibles.', 'fg-theme'),
            'reto'     => [
                'titulo' => __('El reto', 'fg-theme'),
                'texto'  => __('Encontrar planta mediterránea bien aclimatada, en la cantidad y el calibre exactos que pide cada proyecto, sin depender de terceros ni de plazos de importación.', 'fg-theme'),
            ],
            'solucion' => [
                'titulo' => __('La solución', 'fg-theme'),
                'texto'  => __('Cultivamos nuestra propia planta en el vivero de Ronda — 40 ha y 4.000 m² cubiertos — y seleccionamos ahí mismo cada ejemplar antes de llevarlo al jardín del cliente.', 'fg-theme'),
            ],
            'specs'    => [
                ['icon' => 'pin',  'label' => __('Ubicación', 'fg-theme'), 'value' => __('Ronda · Málaga', 'fg-theme')],
                ['icon' => 'area', 'label' => __('Superficie de cultivo', 'fg-theme'), 'value' => __('40 ha', 'fg-theme')],
                ['icon' => 'icons/botanica/especies-singulares.svg', 'label' => __('Especies disponibles', 'fg-theme'), 'value' => __('+17.000', 'fg-theme')],
            ],
            'servicios' => [
                ['icon' => 'icons/servicios/plantacion-destino.svg', 'label' => __('Vivero y plantación propia', 'fg-theme'), 'url' => fg_page_url('vivero')],
                ['icon' => 'icons/servicios/concepto-pencil.svg',    'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
                ['icon' => 'icons/servicios/poda-formacion.svg',     'label' => __('Mantenimiento', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ],
            'galeria' => [
                ['img' => 'vivero-ronda-campos-cultivo-fantastic-gardens-aereo.jpg', 'alt' => __('Vista aérea de los campos de cultivo del vivero de Fantastic Gardens en Ronda', 'fg-theme')],
            ],
        ],
    ];

    return $data[$post_id] ?? null;
}
