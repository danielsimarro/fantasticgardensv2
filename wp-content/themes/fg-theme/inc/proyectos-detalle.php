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
 *   plano      Opcional. Comparador "del plano al jardín construido"
 *              (fg_before_after): [ 'before' => archivo en assets/img/,
 *              'before_alt', 'after' => archivo en assets/img/, 'after_alt',
 *              'before_label', 'after_label', 'caption' ].
 *
 * AVISO: los proyectos 24 (Villa Mediterránea), 25 (Jardín con Palmeras),
 * 26 (Villa Tortuga) y 40 (Villa Estrella) son obras reales del cliente,
 * pero sus cifras de superficie y duración son estimaciones redactadas por
 * el estudio a falta de datos exactos del cliente — pendientes de confirmar
 * antes de tratarlas como dato verificado (ver Pendientes en CLAUDE.md). La
 * fotografía destacada y el comparador plano↔resultado de Villa Estrella (40)
 * son fotos reales retocadas con IA a petición del cliente, no renders
 * generados desde cero.
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

        // Villa Tortuga · Marbella
        26 => [
            'resumen'  => __('Una villa mediterránea con arbolado ya consolidado, donde el reto era integrar una piscina nueva y todo su entorno sin perder la sombra ni el carácter del jardín existente.', 'fg-theme'),
            'reto'     => [
                'titulo' => __('El reto', 'fg-theme'),
                'texto'  => __('La parcela ya tenía árboles maduros y una piscina recién construida, pero el espacio alrededor seguía sin resolver: tierra suelta, sin césped ni vegetación que acompañara la casa y respetara el arbolado existente.', 'fg-theme'),
            ],
            'solucion' => [
                'titulo' => __('La solución', 'fg-theme'),
                'texto'  => __('Césped natural en línea recta hasta el vaso, una palmera como pieza central junto al solárium y un perímetro de vegetación mediterránea de bajo mantenimiento —agaves, cactus y arbustos— sobre gravilla blanca que enmarca la parcela.', 'fg-theme'),
            ],
            'specs'    => [
                ['icon' => 'pin',      'label' => __('Ubicación', 'fg-theme'), 'value' => __('Marbella · Costa del Sol', 'fg-theme')],
                ['icon' => 'area',     'label' => __('Superficie', 'fg-theme'), 'value' => __('≈ 400 m²', 'fg-theme')],
                ['icon' => 'calendar', 'label' => __('Duración de la obra', 'fg-theme'), 'value' => __('6 semanas', 'fg-theme')],
            ],
            'servicios' => [
                ['icon' => 'icons/servicios/concepto-pencil.svg',     'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
                ['icon' => 'icons/servicios/plantacion-destino.svg',  'label' => __('Plantación', 'fg-theme'), 'url' => fg_page_url('vivero')],
                ['icon' => 'icons/servicios/poda-formacion.svg',      'label' => __('Mantenimiento', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ],
            'plano' => [
                'before'       => 'plano-diseno-jardin-piscina-plantas.png',
                'before_alt'   => __('Plano de diseño del jardín de Villa Tortuga con piscina y leyenda numerada de especies vegetales', 'fg-theme'),
                'after'        => 'vista-aerea-jardin-piscina-villa-tortuga-marbella.jpg',
                'after_alt'    => __('Vista aérea del jardín de Villa Tortuga ya construido, con piscina, césped y vegetación mediterránea', 'fg-theme'),
                'before_label' => __('Plano', 'fg-theme'),
                'after_label'  => __('Resultado', 'fg-theme'),
                'caption'      => __('Villa Tortuga · del plano al jardín construido', 'fg-theme'),
            ],
        ],

        // Villa Estrella · Marbella
        40 => [
            'resumen'  => __('Una villa contemporánea de líneas minimalistas, donde el jardín tenía que acompañar la arquitectura sin competir con ella: verde continuo, bordes limpios y una piscina infinity que parece prolongar el césped.', 'fg-theme'),
            'reto'     => [
                'titulo' => __('El reto', 'fg-theme'),
                'texto'  => __('La arquitectura ya era muy fuerte por sí sola —volúmenes de cristal, líneas rectas, una piscina infinity a nivel de suelo— y el jardín no podía competir con ella ni quedarse en un simple relleno verde alrededor de la piscina.', 'fg-theme'),
            ],
            'solucion' => [
                'titulo' => __('La solución', 'fg-theme'),
                'texto'  => __('Césped continuo hasta el borde del vaso para prolongar visualmente el agua, un perímetro de palmeras y vegetación tropical que da intimidad sin tapar las vistas, y bordes muy definidos que respetan la geometría de la arquitectura.', 'fg-theme'),
            ],
            'specs'    => [
                ['icon' => 'pin',      'label' => __('Ubicación', 'fg-theme'), 'value' => __('Marbella · Costa del Sol', 'fg-theme')],
                ['icon' => 'area',     'label' => __('Superficie', 'fg-theme'), 'value' => __('≈ 600 m²', 'fg-theme')],
                ['icon' => 'calendar', 'label' => __('Duración de la obra', 'fg-theme'), 'value' => __('5 meses', 'fg-theme')],
            ],
            'servicios' => [
                ['icon' => 'icons/servicios/concepto-pencil.svg',    'label' => __('Diseño de paisajismo', 'fg-theme'), 'url' => fg_page_url('diseno')],
                ['icon' => 'icons/servicios/plantacion-destino.svg', 'label' => __('Plantación', 'fg-theme'), 'url' => fg_page_url('vivero')],
                ['icon' => 'icons/servicios/riego-eficiente.svg',    'label' => __('Riego eficiente', 'fg-theme'), 'url' => fg_page_url('mantenimiento')],
            ],
            'plano' => [
                'before'       => 'plano-diseno-jardin-piscina-villa-estrella.png',
                'before_alt'   => __('Plano de diseño del jardín de Villa Estrella con piscina infinity, césped y vegetación tropical de borde', 'fg-theme'),
                'after'        => 'vista-aerea-jardin-piscina-villa-estrella-marbella.jpg',
                'after_alt'    => __('Vista aérea del jardín de Villa Estrella ya construido, con piscina infinity, césped continuo y palmeras', 'fg-theme'),
                'before_label' => __('Plano', 'fg-theme'),
                'after_label'  => __('Resultado', 'fg-theme'),
                'caption'      => __('Villa Estrella · del plano al jardín construido', 'fg-theme'),
            ],
        ],
    ];

    return $data[$post_id] ?? null;
}
