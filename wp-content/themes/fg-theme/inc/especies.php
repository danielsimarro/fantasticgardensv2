<?php
/**
 * Catálogo de especies del vivero — datos de la página "Descubrir especies".
 *
 * ------------------------------------------------------------------------
 * CÓMO EDITAR ESTE ARCHIVO
 * ------------------------------------------------------------------------
 * Todo el contenido de la página vive aquí: familias y fichas. Para añadir
 * una especie basta con copiar un bloque y cambiar sus campos; la página, los
 * filtros y las fichas se generan solos.
 *
 * Campos de cada especie:
 *   slug        Identificador interno (sin acentos ni espacios).
 *   nombre      Nombre común.
 *   botanico    Nombre botánico (se muestra en cursiva).
 *   img         Archivo dentro de assets/img/especies/
 *   alt         Descripción de la foto para accesibilidad y SEO.
 *   resumen     Una frase que se ve en la ficha, bajo el nombre.
 *   luz, riego, clima, crecimiento   Las cuatro fichas técnicas.
 *   cualidades  Etiquetas cortas (aroma, floración, sombra…).
 *   usos        Usos recomendados en jardín.
 *   nota        Opcional. Dato aportado por el cliente (calibres, etc.).
 *
 * AVISO: los datos de cultivo son un borrador técnico redactado por el
 * estudio con criterios generales de jardinería mediterránea. Deben ser
 * validados por Fantastic Gardens antes de publicar: son consejos que se
 * publican bajo su firma profesional. Los campos "nota" son los únicos que
 * contienen datos aportados por el cliente (web anterior).
 *
 * @package Fantastic_Gardens
 */

if (!defined('ABSPATH')) exit;

/** Familias del catálogo, en orden de aparición. */
function fg_especies_familias(): array {
    return [
        'palmeras' => [
            'nombre'  => __('Palmeras', 'fg-theme'),
            'img'     => 'washingtonia-robusta-y-filifera.jpg',
            'alt'     => __('Washingtonias de distintos portes en macetones de piedra en el vivero', 'fg-theme'),
            'intro'   => __('El porte que define el carácter de un jardín mediterráneo. Disponibles en distintas alturas de tronco, listas para trasplante.', 'fg-theme'),
        ],
        'coniferas' => [
            'nombre'  => __('Coníferas', 'fg-theme'),
            'img'     => 'coniferas.jpg',
            'alt'     => __('Cipreses y coníferas de porte columnar alineados en el vivero', 'fg-theme'),
            'intro'   => __('Estructura verde todo el año: pantallas, setos altos y acentos verticales.', 'fg-theme'),
        ],
        'arbustos' => [
            'nombre'  => __('Arbustos y setos', 'fg-theme'),
            'img'     => 'calistemo-y-viburnum-lucidum.jpg',
            'alt'     => __('Arbustos de calistemo en flor junto a viburnum de hoja brillante', 'fg-theme'),
            'intro'   => __('El volumen intermedio del jardín: setos, macizos y masas de color.', 'fg-theme'),
        ],
        'aromaticas' => [
            'nombre'  => __('Aromáticas', 'fg-theme'),
            'img'     => 'aromaticas.jpg',
            'alt'     => __('Matas de lavanda y romero en flor bajo el sol', 'fg-theme'),
            'intro'   => __('Bajo consumo de agua, aroma y flor para polinizadores. La base del jardín seco.', 'fg-theme'),
        ],
        'suculentas' => [
            'nombre'  => __('Cactus y suculentas', 'fg-theme'),
            'img'     => 'cactus.jpg',
            'alt'     => __('Colección de cactus y suculentas en macetas de barro', 'fg-theme'),
            'intro'   => __('Escultura vegetal para zonas de máxima insolación y riego mínimo.', 'fg-theme'),
        ],
        'arboles' => [
            'nombre'  => __('Olivos y árboles', 'fg-theme'),
            'img'     => 'olivos.jpg',
            'alt'     => __('Olivos de tronco grueso plantados en una explanada de grava', 'fg-theme'),
            'intro'   => __('Los ejemplares que dan edad y sombra a un jardín desde el primer día.', 'fg-theme'),
        ],
        'frutales' => [
            'nombre'  => __('Frutales', 'fg-theme'),
            'img'     => 'frutales.jpg',
            'alt'     => __('Árboles frutales con fruta madura en el vivero', 'fg-theme'),
            'intro'   => __('Cítricos y frutales de hueso adaptados al clima de la costa.', 'fg-theme'),
        ],
    ];
}

/** Fichas de especie. Cada una pertenece a una familia por su clave. */
function fg_especies(): array {
    return [
        [
            'slug' => 'washingtonia-robusta', 'familia' => 'palmeras',
            'nombre' => __('Palmera mexicana', 'fg-theme'), 'botanico' => 'Washingtonia robusta',
            'img' => 'washingtonia-robusta.jpg',
            'alt' => __('Washingtonia robusta de tronco alto y esbelto recortada contra el cielo', 'fg-theme'),
            'resumen' => __('La palmera de tronco alto y esbelto que marca la silueta del jardín a distancia.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Bajo, una vez establecida', 'fg-theme'),
            'clima' => __('Costero y cálido; tolera heladas ligeras', 'fg-theme'), 'crecimiento' => __('Rápido, hasta 20 m', 'fg-theme'),
            'cualidades' => [__('Porte vertical', 'fg-theme'), __('Resistente al viento', 'fg-theme'), __('Tolera la salinidad', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Alineaciones', 'fg-theme'), __('Accesos y avenidas', 'fg-theme'), __('Grandes ejemplares aislados', 'fg-theme')],
            'nota' => __('Disponible de 1 a 7 m de tronco.', 'fg-theme'),
        ],
        [
            'slug' => 'washingtonia-filifera', 'familia' => 'palmeras',
            'nombre' => __('Palmera de California', 'fg-theme'), 'botanico' => 'Washingtonia filifera',
            'img' => 'washingtonia-filifera.jpg',
            'alt' => __('Washingtonia filifera de tronco ancho y copa densa', 'fg-theme'),
            'resumen' => __('Más robusta y de tronco más ancho que su hermana mexicana, con copa muy densa.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Bajo; muy resistente a la sequía', 'fg-theme'),
            'clima' => __('Seco y cálido; mejor tolerancia al frío', 'fg-theme'), 'crecimiento' => __('Medio, hasta 15 m', 'fg-theme'),
            'cualidades' => [__('Porte robusto', 'fg-theme'), __('Sombra densa', 'fg-theme'), __('Muy resistente a la sequía', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Ejemplar aislado', 'fg-theme'), __('Jardines secos', 'fg-theme'), __('Grandes superficies', 'fg-theme')],
            'nota' => __('Disponible de 1 a 7 m de tronco.', 'fg-theme'),
        ],
        [
            'slug' => 'cupressus-sempervirens', 'familia' => 'coniferas',
            'nombre' => __('Ciprés común', 'fg-theme'), 'botanico' => 'Cupressus sempervirens',
            'img' => 'cupressus-sempervirens.jpg',
            'alt' => __('Cipreses columnares alineados junto a un muro de piedra', 'fg-theme'),
            'resumen' => __('La vertical clásica del paisaje mediterráneo: estrecho, oscuro y perenne.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Bajo', 'fg-theme'),
            'clima' => __('Mediterráneo; muy rústico', 'fg-theme'), 'crecimiento' => __('Medio; porte columnar', 'fg-theme'),
            'cualidades' => [__('Perenne', 'fg-theme'), __('Acento vertical', 'fg-theme'), __('Cortavientos', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Alineaciones', 'fg-theme'), __('Pantallas visuales', 'fg-theme'), __('Marcar accesos', 'fg-theme')],
            'nota' => __('Disponible hasta 5 m de altura.', 'fg-theme'),
        ],
        [
            'slug' => 'cupressus-leylandii', 'familia' => 'coniferas',
            'nombre' => __('Ciprés de Leyland', 'fg-theme'), 'botanico' => 'Cupressus × leylandii',
            'img' => 'cupressus-leylandii.jpg',
            'alt' => __('Seto tupido de ciprés de Leyland de un verde intenso', 'fg-theme'),
            'resumen' => __('El seto de crecimiento rápido cuando hace falta intimidad cuanto antes.', 'fg-theme'),
            'luz' => __('Sol o media sombra', 'fg-theme'), 'riego' => __('Medio', 'fg-theme'),
            'clima' => __('Adaptable; agradece algo de humedad', 'fg-theme'), 'crecimiento' => __('Muy rápido', 'fg-theme'),
            'cualidades' => [__('Perenne', 'fg-theme'), __('Seto denso', 'fg-theme'), __('Pantalla rápida', 'fg-theme'), __('Admite recorte', 'fg-theme')],
            'usos' => [__('Setos', 'fg-theme'), __('Cierres de parcela', 'fg-theme'), __('Pantallas visuales', 'fg-theme')],
            'nota' => __('Disponible hasta 5 m de altura.', 'fg-theme'),
        ],
        [
            'slug' => 'calistemo', 'familia' => 'arbustos',
            'nombre' => __('Limpiatubos', 'fg-theme'), 'botanico' => 'Callistemon citrinus',
            'img' => 'calistemo.jpg',
            'alt' => __('Arbusto de calistemo cubierto de flores rojas en forma de cepillo', 'fg-theme'),
            'resumen' => __('Floración roja espectacular en forma de cepillo, muy larga y muy visitada por abejas.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Bajo-medio', 'fg-theme'),
            'clima' => __('Cálido; tolera la costa', 'fg-theme'), 'crecimiento' => __('Medio, 2–4 m', 'fg-theme'),
            'cualidades' => [__('Floración larga', 'fg-theme'), __('Atrae polinizadores', 'fg-theme'), __('Perenne', 'fg-theme'), __('Tolera la salinidad', 'fg-theme')],
            'usos' => [__('Macizos de color', 'fg-theme'), __('Setos informales', 'fg-theme'), __('Maceteros grandes', 'fg-theme')],
        ],
        [
            'slug' => 'viburnum-lucidum', 'familia' => 'arbustos',
            'nombre' => __('Durillo brillante', 'fg-theme'), 'botanico' => 'Viburnum tinus «Lucidum»',
            'img' => 'viburnum-lucidum.jpg',
            'alt' => __('Viburnum lucidum de hoja grande y brillante formando un seto', 'fg-theme'),
            'resumen' => __('Hoja grande y brillante, floración blanca en invierno. El seto formal por excelencia.', 'fg-theme'),
            'luz' => __('Sol o media sombra', 'fg-theme'), 'riego' => __('Medio', 'fg-theme'),
            'clima' => __('Mediterráneo; muy adaptable', 'fg-theme'), 'crecimiento' => __('Medio, 2–3 m', 'fg-theme'),
            'cualidades' => [__('Perenne', 'fg-theme'), __('Floración invernal', 'fg-theme'), __('Admite recorte', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Setos formales', 'fg-theme'), __('Macizos', 'fg-theme'), __('Zonas de media sombra', 'fg-theme')],
        ],
        [
            'slug' => 'lentisco', 'familia' => 'arbustos',
            'nombre' => __('Lentisco', 'fg-theme'), 'botanico' => 'Pistacia lentiscus',
            'img' => 'lentisco.jpg',
            'alt' => __('Mata de lentisco de hoja pequeña y brillante junto a rocas frente al mar', 'fg-theme'),
            'resumen' => __('Autóctono, indestructible y siempre verde. La apuesta segura del jardín sin riego.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Muy bajo', 'fg-theme'),
            'clima' => __('Mediterráneo; autóctono de la zona', 'fg-theme'), 'crecimiento' => __('Lento, 1–3 m', 'fg-theme'),
            'cualidades' => [__('Autóctono', 'fg-theme'), __('Perenne', 'fg-theme'), __('Muy resistente a la sequía', 'fg-theme'), __('Tolera la salinidad', 'fg-theme')],
            'usos' => [__('Jardines secos', 'fg-theme'), __('Taludes', 'fg-theme'), __('Setos naturales', 'fg-theme')],
        ],
        [
            'slug' => 'lavanda', 'familia' => 'aromaticas',
            'nombre' => __('Lavanda', 'fg-theme'), 'botanico' => 'Lavandula angustifolia',
            'img' => 'lavanda.jpg',
            'alt' => __('Matas de lavanda en flor formando una banda morada', 'fg-theme'),
            'resumen' => __('Aroma, color y abejas. Estructura el jardín seco en masas y bordes.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Muy bajo', 'fg-theme'),
            'clima' => __('Seco; necesita suelo bien drenado', 'fg-theme'), 'crecimiento' => __('Rápido, 40–80 cm', 'fg-theme'),
            'cualidades' => [__('Aroma', 'fg-theme'), __('Floración', 'fg-theme'), __('Atrae polinizadores', 'fg-theme'), __('Muy resistente a la sequía', 'fg-theme')],
            'usos' => [__('Bordes y caminos', 'fg-theme'), __('Jardines secos', 'fg-theme'), __('Maceteros', 'fg-theme')],
        ],
        [
            'slug' => 'romero', 'familia' => 'aromaticas',
            'nombre' => __('Romero', 'fg-theme'), 'botanico' => 'Salvia rosmarinus',
            'img' => 'romero.jpg',
            'alt' => __('Mata de romero en flor azul creciendo sobre un muro de piedra', 'fg-theme'),
            'resumen' => __('Aromático todo el año y florido casi todo el invierno. También en porte rastrero.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Muy bajo', 'fg-theme'),
            'clima' => __('Mediterráneo; autóctono', 'fg-theme'), 'crecimiento' => __('Medio, 50–150 cm', 'fg-theme'),
            'cualidades' => [__('Aroma', 'fg-theme'), __('Floración invernal', 'fg-theme'), __('Autóctono', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Taludes y rocallas', 'fg-theme'), __('Bordes', 'fg-theme'), __('Jardines secos', 'fg-theme')],
        ],
        [
            'slug' => 'agave-americana', 'familia' => 'suculentas',
            'nombre' => __('Pita', 'fg-theme'), 'botanico' => 'Agave americana',
            'img' => 'agave-americana.jpg',
            'alt' => __('Agave americana de hojas azuladas y grandes creciendo entre grava', 'fg-theme'),
            'resumen' => __('Escultura viva de hojas azuladas. Presencia máxima con mantenimiento mínimo.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Prácticamente nulo', 'fg-theme'),
            'clima' => __('Seco y cálido; no tolera el encharcamiento', 'fg-theme'), 'crecimiento' => __('Lento, hasta 2 m', 'fg-theme'),
            'cualidades' => [__('Porte escultórico', 'fg-theme'), __('Muy resistente a la sequía', 'fg-theme'), __('Tolera la salinidad', 'fg-theme'), __('Bajo mantenimiento', 'fg-theme')],
            'usos' => [__('Jardines secos', 'fg-theme'), __('Rocallas', 'fg-theme'), __('Maceteros de acento', 'fg-theme')],
        ],
        [
            'slug' => 'olivo', 'familia' => 'arboles',
            'nombre' => __('Olivo', 'fg-theme'), 'botanico' => 'Olea europaea',
            'img' => 'olivo.jpg',
            'alt' => __('Olivo de tronco retorcido y copa plateada en un jardín de grava', 'fg-theme'),
            'resumen' => __('El árbol que da edad a un jardín nuevo. Tronco con carácter y hoja plateada.', 'fg-theme'),
            'luz' => __('Pleno sol', 'fg-theme'), 'riego' => __('Bajo', 'fg-theme'),
            'clima' => __('Mediterráneo; autóctono', 'fg-theme'), 'crecimiento' => __('Lento; muy longevo', 'fg-theme'),
            'cualidades' => [__('Ejemplar con carácter', 'fg-theme'), __('Perenne', 'fg-theme'), __('Sombra ligera', 'fg-theme'), __('Muy resistente a la sequía', 'fg-theme')],
            'usos' => [__('Ejemplar aislado', 'fg-theme'), __('Alineaciones', 'fg-theme'), __('Grandes maceteros', 'fg-theme')],
        ],
    ];
}

/** Etiquetas de los cuatro datos de cultivo (icono + rótulo). */
function fg_especies_datos(): array {
    return [
        'luz'         => ['label' => __('Luz', 'fg-theme'),         'icon' => 'icons/servicios/seleccion-local.svg'],
        'riego'       => ['label' => __('Riego', 'fg-theme'),       'icon' => 'icons/servicios/riego-eficiente.svg'],
        'clima'       => ['label' => __('Clima', 'fg-theme'),       'icon' => 'icons/servicios/cultivo-responsable.svg'],
        'crecimiento' => ['label' => __('Crecimiento', 'fg-theme'), 'icon' => 'icons/botanica/especies-singulares.svg'],
    ];
}

/** URL de una imagen del catálogo. */
function fg_especie_img(string $file): string {
    return fg_asset('especies/' . $file);
}
