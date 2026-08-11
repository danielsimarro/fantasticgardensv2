# CLAUDE.md — Fantastic Gardens v2

Documento de contexto completo para Claude Code. Mantenerlo actualizado es prioritario.

---

## El proyecto en una frase

Rediseño premium de **Fantastic Gardens** (empresa de jardinería y paisajismo de lujo, Marbella · Costa del Sol).
Sustituirá a la web de producción actual. El enfoque es editorial/luxury — sin page builders, todo PHP + CSS custom.

---

## Las dos versiones del proyecto

### v1 — Producción actual (solo lectura, referencia)

| | |
|---|---|
| **Ruta local** | `/home/daniel/proyectos/fantasticgardens` |
| **URL producción** | `fantasticgardens.net` |
| **CMS** | WordPress + Divi (2013, obsoleto) |
| **BD MySQL** | `fantasticgardens` · user: `danielsimarro` · pass: `danielsimarro` |
| **Imágenes útiles** | `/home/daniel/proyectos/fantasticgardens/wp-content/uploads/` |
| **Uso** | Extraer contenido real (textos, datos, imágenes) para alimentar v2 |

Imágenes de proyectos reales del cliente, extraídas de `uploads/2020/07/` y usadas como thumbnails del CPT `proyecto` en v2:
- `Fantastic-Gardens-Proyectos.jpg` → `assets/img/proyecto-1.jpg` (Villa Mediterránea · Marbella)
- `Fantastic-Gardens-Proyectos-5.jpg` → `assets/img/proyecto-2.jpg` (Jardín con Palmeras · Benahavís)
- `GARDEN-RONDA.jpg` → `assets/img/proyecto-3.jpg` (Jardín en Ronda)

### v2 — Este proyecto (desarrollo activo)

| | |
|---|---|
| **Ruta local** | `/home/daniel/proyectos/fantasticgardensv2` |
| **URL local** | `http://fantasticgardensv2.test` |
| **Admin WP** | `http://fantasticgardensv2.test/wp-admin` · user: `danielsimarro` |
| **BD MySQL** | `fg_nuevo` · user: `danielsimarro` · pass: `danielsimarro` |
| **Tema** | `wp-content/themes/fg-theme/` |

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| CMS | WordPress 7.0 |
| PHP | 8.1 (entorno local corre con `php8.0` vía WP-CLI, ver nota WP-CLI abajo) |
| Servidor local | Apache + mod_rewrite |
| CSS | Vanilla CSS con custom properties — todo en `assets/css/main.css` |
| JS | Vanilla JS (`assets/js/main.js`), sin dependencias en casi todo el sitio. GSAP + ScrollTrigger + Splitting vendorizados en `assets/js/vendor/`, cargados **solo** en la página de Vivero (`assets/js/vivero.js`) |
| Fuentes | Google Fonts: **Cormorant Garamond** (títulos) + **Jost** (texto y rótulos) |
| Plugins | Polylang, Yoast SEO, Contact Form 7, WP-Optimize, Advanced Custom Fields (ACF) |
| Multilingüe | Polylang (ES / EN) — instalado pero sin configurar; el selector de la cabecera sigue siendo un placeholder estático "ES" |
| SEO técnico | Schema.org LocalBusiness JSON-LD (dos ubicaciones: San Pedro + Ronda) en `functions.php` |
| Ajustes del tema | Apariencia → **FG Ajustes** (`inc/admin-settings.php`): marca, teléfonos (3 líneas), direcciones (2 sedes), email, CIF, horario, redes, geo — leídos con `fg_opt()` |

> **Origen del rediseño (2026-07-26):** la estructura de componentes (`inc/components.php`), el sistema de ajustes, las páginas legales, ACF y el motor GSAP/Lenis vendorizados se adaptaron de una plantilla de referencia (`fantastic-gardens`, diseño "2MOONS/Growlanding") aportada por el cliente, reutilizando su arquitectura pero manteniendo el contenido real, el CPT `proyecto` y los slugs SEO ya existentes en v2.
>
> **Migración completa al rediseño v5 (2026-07-31):** el cliente aprobó un rediseño completo del sitio a partir de un nuevo index de referencia (tipografía Cormorant Garamond + Jost en vez de Mulish, paleta ampliada con verdes de sección/noche, cabecera flotante con barra de progreso, footer a 4 columnas, filas de servicio alternadas numeradas, comparador drag antes/después, carrusel de reseñas arrastrable, marquesina de zonas, bloque de cierre "¿Hablamos?"). Marco entregó ese rediseño como un tema WordPress completo en `/home/daniel/Descargas/fantastic-gardens-pruebas-2026-07-30-v5/`, pensado para instalarse desde cero (slugs cortos, sin Polylang, sin CPT, sin los 3 teléfonos reales, con datos de proyectos de relleno). Se ha portado **el sistema visual y de componentes completo** sobre la arquitectura de datos y URLs ya validada de v2 (ver sección "Migración a v5" más abajo para el detalle completo de qué se adoptó, qué se conservó y por qué).

---

## Sistema de diseño — estado real implementado (v5, 2026-07-31)

### Paleta de colores

```css
--verde:        #4d7048   /* Verde de marca — CTAs, iconos, acentos */
--verde-700:    #3f5d3b   /* Hover del verde */
--verde-900:    #2c4129   /* Verde oscuro puntual */
--verde-osc:    #1f2e22   /* Fondo de secciones oscuras (p.ej. "Calidad y garantía") */
--verde-noche:  #16211a   /* Fondo del footer y la marquesina de zonas */
--lima:         #a7cf6f   /* Acento claro — SOLO sobre fondo oscuro (títulos en verde-osc/noche) */
--beige:        #efe9dc
--arena:        #ded7c8
--beige-line:   #d8ccb6
--crema:        #f6f2e9   /* Fondo principal de secciones claras */
--ink:          #252522   /* Texto principal (nunca negro puro) */
--ink-soft:     #5c5c53   /* Texto secundario/muted */
```

**Regla de uso de color:** `--verde` es el único acento de marca (lujo/decoración y naturaleza/acción a la vez — ya no hay bronce separado). `--lima` es un acento claro reservado a fondos oscuros (títulos, `em-lima`). Nunca negro puro (`#000`) — siempre `--ink`.

### Tipografía

| Rol | Familia | Pesos |
|---|---|---|
| Headings / editorial | Cormorant Garamond | 300, 400, 500, 600 + italic 300/400 |
| Body / UI / rótulos | Jost | 300, 400, 500 |

```css
--serif: "Cormorant Garamond", ui-serif, Georgia, "Times New Roman", serif;
--sans:  "Jost", ui-sans-serif, system-ui, sans-serif;
```

Los títulos bajan a peso ligero (300) y suben mucho de tamaño (`clamp()`): el peso lo da la escala, no el trazo.

### Otros tokens

```css
--track: .2em; --track-wide: .28em;   /* letter-spacing de rótulos en versalitas */
--header-h: 5.5rem;
--wrap: 97.5rem;                       /* 1560px, ancho máximo de contenido */
--gutter: clamp(1.125rem, 4vw, 3.75rem);
--ease: cubic-bezier(.22, 1, .36, 1);
```

### Breakpoints

Mobile-first (`min-width`), sin variables `--bp-*` dedicadas; rango real de `@media` entre 560px y 1100px. Header/nav conmuta a escritorio en **981px**.

### El gesto de marca: el "kicker" numerado

Cada bloque de la portada se abre con un rótulo `01 ──── EL ESTUDIO` (número de orden + filete + epígrafe en versalitas), generado por `fg_kicker()` / `fg_section_heading(['num' => ...])`. Es el hilo conductor que ordena la lectura de todo el sitio.

---

## Estructura de archivos del tema

```
wp-content/themes/fg-theme/
├── style.css               ← SOLO cabecera del tema. Nunca añadir CSS aquí.
├── functions.php           ← Setup, enqueue, CPT proyecto, ajustes (fg_opt), helpers, SEO, Schema.org JSON-LD
├── acf-fields.php          ← Campos ACF (hero_video, hero_poster, hero_mobile). No-op si ACF no está activo
├── index.php               ← Fallback vacío requerido por WP
├── page.php                ← Template genérico (hero simple + the_content + fg_site_closing)
├── front-page.php          ← Homepage completa (layout único)
├── single-proyecto.php     ← Vista individual de CPT proyecto
├── header.php              ← <head> + barra de progreso + header (over-header en hero) + overlay móvil
├── footer.php               ← Footer a 4 columnas + wp_footer()
│
├── inc/
│   ├── components.php      ← Librería de componentes reutilizables (ver tabla más abajo)
│   ├── especies.php        ← Datos del catálogo de especies (familias + fichas) — "Descubrir especies"
│   ├── admin-settings.php  ← Página Apariencia → FG Ajustes
│   └── legal-content.php   ← fg_render_legal() + textos legales por defecto
│
├── template-parts/
│   └── home/               ← Secciones de la portada, en orden
│       ├── hero.php · estudio.php · servicios.php · garantia.php
│       ├── proyectos.php · vivero.php · resenas.php · zonas.php · contacto.php
│
├── templates/               ← Templates de páginas específicas (asignación manual, _wp_page_template)
│   ├── page-servicios.php
│   ├── page-servicio-diseno.php
│   ├── page-servicio-mantenimiento.php
│   ├── page-servicio-vivero.php        ← Vivero + Plantación propia + Nuestra plantación, FUSIONADAS
│   ├── page-catalogo-especies.php      ← NUEVO — catálogo interactivo "Descubrir especies"
│   ├── page-proyectos.php              ← "Proyectos realizados"
│   ├── page-antes-despues.php
│   ├── page-historia.php
│   ├── page-contacto.php
│   ├── page-aviso-legal.php    ← usa fg_render_legal('aviso-legal', …)
│   ├── page-cookies.php        ← usa fg_render_legal('cookies', …)
│   └── page-privacidad.php     ← usa fg_render_legal('privacidad', …)
│
└── assets/
    ├── css/main.css        ← TODO el CSS del tema (~1470 líneas), sistema de diseño v5
    ├── js/main.js          ← JS del tema, SIN dependencias (barra de progreso, menú fullscreen,
    │                          drag-comparator, lightbox, contadores, marquesina, carrusel, magnetismo)
    ├── js/vivero.js        ← Solo se carga en la página de Vivero: título por letras (Splitting.js),
    │                          partículas de hojas (canvas propio) y galería horizontal fijada (GSAP)
    ├── js/especies.js      ← Solo se carga en Descubrir especies: filtros, fichas modales, bandeja de selección
    ├── js/vendor/          ← gsap.min.js, ScrollTrigger.min.js, splitting.min.js (sin CDN; SIN Lenis)
    └── img/                ← Imágenes del tema (plano, salvo assets/img/especies/ — ver inventario)
```

### Helpers clave (`functions.php`)

| Función | Uso |
|---|---|
| `fg_opt($key, $fallback)` | Lee un ajuste de FG Ajustes (marca, teléfonos, direcciones, horario, redes, geo) |
| `fg_page_url($key)` | Permalink de una página interna por clave lógica — ver `fg_page_slugs()` |
| `fg_page_slugs()` | Mapa clave→slug real (SEO). Única fuente de verdad para enlazar entre páginas |
| `fg_asset($path)` | URL de un archivo en `assets/img/` |
| `fg_img($field, $fallback, $alt, $class)` | `<img>` editable por ACF con fallback a un asset del tema |
| `fg_media_url($field, $fallback)` | URL de archivo/vídeo ACF con fallback |
| `fg_logo($args)` | Logo: custom-logo del Customizer o el lockup `wordmark-olivo.svg` |
| `fg_has_over_header()` | Bool: ¿la cabecera flota transparente sobre un hero fotográfico a sangre? |
| `fg_process_contact_form()` | Procesa el formulario de contacto (nonce + `wp_mail`). Devuelve `''\|'invalid'\|'mail-error'\|'ok'` |

`header.php` añade además `fg_get_primary_nav()` / `fg_default_nav()`: la navegación se lee del menú real asignado a la ubicación `primary-menu` (Apariencia → Menús), reconstruido como árbol `label/url/children`; solo cae al array hardcodeado de `fg_default_nav()` si no hay ningún menú asignado. Esto mantiene la cabecera editable desde wp-admin (decisión explícita: no repetir el patrón de nav hardcodeado que trajo la plantilla de Marco).

### Inventario de imágenes (`assets/img/`) — piezas nuevas del rediseño v5

Además de los iconos ya existentes (`icons/servicios/*.svg`, `icons/botanica/*.svg`, idénticos a los de Marco, no se tocan) y de las 3 fotos reales del CPT (`proyecto-1/2/3.jpg`), se incorporaron de la plantilla v5 (aplanadas a la convención del proyecto):

| Archivo(s) | Uso |
|---|---|
| `hero-indice.mp4` / `hero-indice-poster.jpg` | Vídeo/póster del hero de portada (sustituyen a `hero-jardines.mp4`) |
| `hero-jardines-permanecen.jpg` / `-movil.jpg` | Banda de cita a sangre del home; el `-movil` también sirve de fallback de `hero_mobile` |
| `hero-nuestra-historia.jpg` | Hero de la página Historia |
| `hero-servicios.jpg`, `hero-diseno-paisajes.jpg`, `hero-mantenimiento.jpg`, `hero-vivero.jpg` | Heroes de páginas de servicio |
| `calendario-ritmo-del-jardin.jpg` | Sección "Cómo trabajamos" de Mantenimiento |
| `plantacion-1/2/3/4.jpg`, `plantacion-interior-invernadero.jpg`, `plantacion-pabellon.jpg` | Galería horizontal fijada (hgallery) y secciones de Plantación propia, dentro de la página de Vivero fusionada |
| `diseno-plano-1/2.jpg`, `diseno-render-1/2.jpg` | Comparador antes/después (plano↔render 3D) de Diseño de paisajismo |
| `especies/*.jpg` (20 archivos) | **Única excepción a la convención plana** — fotos del catálogo "Descubrir especies" (familias + fichas individuales), backed por `inc/especies.php` |
| `hojita.svg`, `olive-motif.svg`, `wordmark-olivo.svg`, `arrow-right.svg`, `chevron-down.svg` | Iconografía/motivos de marca del sistema nuevo |

Las imágenes reales/aprobadas que ya estaban en v2 (`proyecto-1/2/3.jpg`, `escudo-ronda.png`, `page-antes.jpg`/`page-despues.jpg`/`page-antes-despues-hero.jpg`/`page-antes-despues-2.jpg` de las comparativas Antes/Después, `page-contacto-hero.jpg`) se mantuvieron sin cambios. El resto de imágenes que traía v2 antes de esta migración (`hero-jardines-*` viejas, `sobre-historia.jpg`, `vivero-*.jpg`, `svc-*.jpg`, `page-*-2/3/4.jpg`, etc.) quedaron **huérfanas** — engordan el pendiente histórico de limpieza de `assets/img/` (ver Pendientes).


---

## Páginas WordPress (publicadas)

| ID | Título | Slug | Template |
|---|---|---|---|
| — | Inicio | `/` (sin página estática asignada; `front-page.php` se sirve igualmente por prioridad de WP) | `front-page.php` |
| 5 | Servicios | `/servicios-jardineria-paisajismo-mantenimiento-y-vivero/` | `templates/page-servicios.php` |
| 6 | Diseño Paisajismo | `/fantastic-gardens-paisajismo-diseno-jardines/` | `templates/page-servicio-diseno.php` |
| 7 | Mantenimiento | `/mantenimiento-a-casas-y-empresas-jardineria/` | `templates/page-servicio-mantenimiento.php` |
| 8 | Vivero y Plantación propia | `/vivero-y-plantacion-propia/` | `templates/page-servicio-vivero.php` |
| **31** | **Descubrir especies** | **`/catalogo-especies-plantas-vivero-marbella/`** | **`templates/page-catalogo-especies.php`** (página nueva, creada 2026-07-31) |
| 9 | Proyectos realizados | `/proyectos-realizados-jardineria-costa-del-sol-malaga/` | `templates/page-proyectos.php` |
| 10 | Proyectos antes/después | `/proyectos-antes-y-despues-diseno-de-jardines-paisajismo/` | `templates/page-antes-despues.php` |
| 11 | Historia | `/historia/` | `templates/page-historia.php` |
| 12 | Contacto | `/contacto-empresa-jardineria/` | `templates/page-contacto.php` |
| 29 | Aviso Legal | `/aviso-legal/` | `templates/page-aviso-legal.php` |
| 30 | Política de Cookies | `/politica-de-cookies/` | `templates/page-cookies.php` |
| 3 | Política de Privacidad | `/politica-de-privacidad/` | `templates/page-privacidad.php` |

> Los slugs son idénticos a producción para preservar SEO — con la única excepción de la página nueva `catalogo-especies-plantas-vivero-marbella`, que no tiene equivalente previo. Ver `fg_page_slugs()` en `functions.php` para el mapa clave→slug (incluye ahora la clave `'especies'`).

## CPT: `proyecto`

| ID | Título | Ubicación | menu_order |
|---|---|---|---|
| 24 | Villa Mediterránea · Marbella | Marbella · Costa del Sol | 1 |
| 25 | Jardín con Palmeras · Benahavís | Benahavís · Málaga | 2 |
| 26 | Jardín en Ronda | Ronda · Málaga | 3 |

Meta field: `ubicacion` (texto libre, ahora registrado con `register_post_meta()` para exponerlo correctamente a REST). `supports` incluye `page-attributes` desde la migración v5 (antes no lo tenía) para que el campo Orden sea visible en el admin.

Desde el 2026-08-10, cada uno de los 3 proyectos tiene además una ficha ampliada en `inc/proyectos-detalle.php` (resumen, reto/solución, cifras con icono, chips de servicio, galería) — ver la entrada "Ficha de proyecto individual ampliada" más abajo para el detalle completo, incluido qué contenido es real y cuál es un borrador inventado pendiente de confirmar.

---

## Dirección de Ronda corregida + mapas dinámicos (2026-08-05)

La dirección del vivero/Garden Center de Ronda (`fg_opt('address2')`, por defecto en `fg_defaults()` de `functions.php`) tenía mal la ubicación real (usaba "Los Prados, 29400 Málaga"; la correcta es "796 Partida, Ctra. Ronda-Setenil, 29394 La Cimada, Málaga"). Esto solo afecta a Ronda — la dirección de San Pedro (`fg_opt('address')`) ya estaba bien y no se ha tocado.

Los dos `<iframe>` de Google Maps de Ronda (en `templates/page-servicio-vivero.php` y `templates/page-contacto.php`) usaban un embed `maps/embed?pb=...` con coordenadas y un Place ID fijados a mano, generados una vez para la dirección antigua — de ahí que quedara desincronizado sin que nadie lo notara. Se sustituyeron por `https://www.google.com/maps?q=<address2 codificada>&output=embed`, que geocodifica la dirección de `fg_opt('address2')` en cada carga: si el cliente vuelve a corregir la dirección en Ajustes, el mapa se autoactualiza sin tocar código. Los iframes de San Pedro siguen con el `pb=` fijo de siempre (no estaban rotos, no se han cambiado).

---

## Rediseño de Contacto (2026-08-05)

`templates/page-contacto.php` se rehízo por completo (solo esa plantilla — no se tocó `header.php`/`footer.php`) tomando como referencia una maqueta HTML aportada por el cliente, adaptada a los componentes y datos reales del tema en vez de copiar sus estilos inline. Flujo de la página: hero (`fg_photo_hero`) → 4 tarjetas de contacto directo (llamar/WhatsApp/correo/formulario) superpuestas al hero → banda de cifras (`fg_stats_band`: 24h, +20 años, 0€ visita, 2 sedes) → 3 pasos "Qué pasa después" (mismo patrón `.steps` que `page-proyectos.php`) → sección partida foto+cita/formulario (`#formulario`) → dos sedes reales (ya existía) con nuevos enlaces "Cómo llegar" a Google Maps → FAQ con `<details>/<summary>` nativos + JSON-LD `FAQPage` → cierre con `fg_zones_marquee` (sin repetir `fg_contact_band`, como ya era el caso).

Piezas nuevas en `assets/css/main.css`: `.contact-tiles`/`.contact-tile` (tarjetas de canal), `.chip`/`.field--chips` (selector de servicio en el formulario, radios nativos estilizados como píldoras), `.faq-item` (acordeón sin JS) y `.form-split` (la sección partida foto/formulario, hermana de `.split-hero` pero con `<h2>` en vez de `<h1>` — no reutilizar `fg_split_hero()` para secciones que no sean el hero real de la página, o se duplica el `<h1>`).

El formulario ganó los campos `servicio` (chips) y `localidad` (opcional) — `fg_process_contact_form()` en `functions.php` los añade al cuerpo del correo si vienen informados. El campo `mensaje` dejó de ser obligatorio (fricción menor); a cambio `telefono` pasó a ser obligatorio, ya que es el canal de respuesta prioritario ("le llamamos en 24h"). El número de WhatsApp usado en toda la página es el móvil real (`fg_opt('phone_href')`, 691 142 679) — la maqueta de referencia enlazaba por error el fijo de San Pedro a WhatsApp.

SEO: título y meta description propios en Yoast para esta página (`_yoast_wpseo_title`/`_yoast_wpseo_metadesc` del post 12), más el JSON-LD `FAQPage` ya mencionado.

**Rediseño del formulario (2026-08-05, mismo día):** el formulario en sí (dentro de `#formulario`) se elevó a una tarjeta blanca (`.contact-form-card`, sombra + filete, mismo lenguaje de elevación que `.contact-tile`/`.card-link`) en vez de campos sueltos directamente sobre el beige del split. Los 4 campos obligatorios (chips de servicio, nombre, teléfono, correo) llevan ahora una etiqueta tipo "kicker" numerada (`.field__label` → `field__num` + `field__rule` + `field__text`, el mismo gesto de `fg_kicker()`), y nombre/teléfono se muestran en fila de 2 columnas (`.field-row`) en vez de apilados — los campos opcionales (localidad, mensaje) se quedan deliberadamente con el `<label>` plano de antes y van tras un separador `.field-divider` ("Detalles opcionales"), para que la tipografía marque qué es obligatorio y qué no. Los chips de servicio ahora llevan icono real del sitio (`icons/servicios/concepto-pencil.svg`, `riego-eficiente.svg`, `icons/botanica/especies-singulares.svg`; "Otra consulta" usa un SVG inline) — al seleccionarse, el icono se invierte a blanco con `filter: brightness(0) invert(1)` (mismo truco que `.pill--verde .pill__arrow` y `.brand-logo` sobre header transparente) en vez de intentar recolorear el SVG. El botón de envío pasó a ancho completo con flecha (`fg_arrow('btn-submit__arrow')`, mismo filtro de inversión) y los avisos de éxito/error (`.form-notice--ok`/`.form-notice--error`) ganaron un icono circular a la izquierda. Todo esto vive en clases nuevas o reescritas dentro del bloque "Formulario de contacto" de `main.css`; no se tocó `.chip`/`.especies-filtros` de la página de Descubrir especies, que reutiliza el nombre de clase `.chip` para una cosa distinta (botones de filtro, no radios) — los estilos de icono del formulario están deliberadamente anidados bajo `.field--chips` para no cruzarse con esos.

---

**"Qué pasa después" más visual y compacto (2026-08-07):** los 3 pasos de esa sección (dentro de `#formulario`'s panel oscuro, justo antes del split de formulario) llevaban solo un numeral fantasma enorme (`.steps--ghost`) — se sustituyó por una variante nueva, `.steps--panel`: cada paso lleva un anillo con icono real (`fg_icon('phone')`, `fg_icon('pin')`, `fg_icon('form')` — ya existían en `fg_icon()` para las tarjetas de contacto de más arriba, ninguno nuevo) y el numeral pasó a una insignia lima pequeña superpuesta en la esquina del anillo, con una línea horizontal fina a modo de hilo de proceso. La sección también ganó `.section--tight-t` + `.section--tight-b` (utilidades que ya existían sin usar en el CSS) para reducir su padding vertical — el motivo era puramente de altura de página: el numeral fantasma ocupaba mucho más alto que un anillo de 3.75rem. `.steps--ghost` no se ha tocado ni eliminado (sigue siendo la variante por defecto si algún día se reutiliza tal cual en otra página).

El hilo entre anillos **no** es una única línea de centro a centro del `.wrap` (`.steps--panel::before` con `left/right` en `%`): con 3 columnas de ancho variable eso deja huecos o solapes según el ancho real de cada columna, y en la primera versión no llegaba a tocar los anillos limpiamente. Se sustituyó por un segmento por paso (`.steps--panel .step:not(:last-child)::after`), anclado al propio `.step` (que sí tiene un ancho conocido = el de su columna del grid): nace en `left: 3.75rem` (el borde derecho del anillo, que mide justo eso) y mide `calc(100% - 3.75rem + 2.5rem)` — el resto de la columna más el gap real de `.steps` (2.5rem desde 720px) — así termina exactamente en el borde izquierdo del anillo de la columna siguiente, sea cual sea el ancho de columna que reparta el grid.

---

## Fotos reales de flota en "Personal y maquinaria" (2026-08-06)

La sección `#maquinaria` de `templates/page-servicio-mantenimiento.php` (las 4 filas oscuras `rows-osc`, antes solo texto) incorporó fotografías reales de la flota aportadas por el cliente (recortes PNG con fondo transparente y el logo de Fantastic Gardens ya rotulado en el vehículo — no son fotos de stock). Los 4 originales (`/home/daniel/Descargas/{camion-cerrados,camion-transporte,camion-pluma,tractor}.png`, ~2048px) se redujeron a 1100px de ancho y se recomprimieron a paleta indexada con Pillow (no hay ImageMagick/pngquant/cwebp en este entorno, ver nota de WP-CLI) — de 150–460 KB a 47–72 KB conservando la transparencia — y se copiaron a `assets/img/` como `maquinaria-camion-cerrados.png`, `maquinaria-camion-transporte.png`, `maquinaria-camion-pluma.png`, `maquinaria-tractor.png`.

Al ser recortes (no fotos a sangre), no se reutilizó el tratamiento `object-fit: cover` de `.service-row__media`/`.card-link__media`: se creó `.row-osc__media` con un "pódium" (degradado radial suave + sombra de suelo elíptica difuminada bajo el vehículo + `filter: drop-shadow` en la imagen) para que el vehículo se asiente visualmente sobre el verde oscuro de la sección en vez de flotar. `.rows-osc--media .row-osc` pasa de fila de texto a tarjeta horizontal con la imagen alternando lado par/impar (`--flip`, misma cadencia que `.service-row`), apilada en móvil y en 2 columnas desde 720px. El hover de la imagen usa la propiedad `scale` (no `transform`) a propósito, igual que `.fx-frame img`: el sistema de reveal (`data-img-reveal` → `.rv-img`) ya anima `transform` en el asentado, así que un hover con `transform` lo pisaría.

La primera versión sacaba el vehículo casi a sangre dentro de un panel grande (columna hasta 22rem, poco padding) y el cliente la vio "demasiado grande" y poco cuidada — se redujo el panel a un cuadrado contenido (máx. 15.5rem, columna de pista 12–14.5rem en escritorio) con mucho más aire alrededor (`padding: clamp(2rem, 16%, 3rem)` en la imagen) y sombras más suaves (`drop-shadow` de .2–.26 de opacidad en vez de .32–.4), para una lectura más de "vitrina"/plaquita que de foto de catálogo. De paso se corrigió un bug real del primer intento: el flip usaba `order` para invertir imagen/texto, pero con columnas asimétricas (`minmax(12rem,14.5rem) 1fr`) invertir el `order` de los hijos también invierte qué PISTA de la grid les toca — la fila impar acababa con la imagen ocupando la columna ancha (`1fr`), gigante. Se sustituyó por `grid-template-areas` (una plantilla `"media body"` normal y otra `"body media"` en `.row-osc--flip`), que sí mantiene la pista angosta siempre asignada al área `media` sea cual sea el lado. **Lección general**: no usar `order` para alternar posiciones en un grid con columnas de distinto tamaño — solo es seguro si las columnas son iguales (como en `.service-row`, que usa `1fr 1fr`).

**Segundo bug, solo visible en móvil (2026-08-06, mismo día):** el `grid-template-areas` de arriba solo se definía dentro del `@media (min-width: 720px)`; en móvil (`grid-template-columns: 1fr`, sin `grid-template-areas`) la imagen y el texto se solapaban por completo. Causa: `.row-osc__media { grid-area: media }` / `.row-osc__body { grid-area: body }` son nombres de área que no existían en ese breakpoint — y por la spec de CSS Grid, un `grid-area` con un nombre que no aparece en ningún `grid-template-areas` no se ignora, sino que crea implícitamente líneas con ese nombre (`media-start`/`media-end`, etc.), lo que descuadraba el número de columnas/filas del grid y acababa poniendo ambos elementos en la misma celda. Solución: declarar `grid-template-areas: "media" "body"` también en la regla base (fuera del media query), para que exista siempre una definición explícita que case con los `grid-area` de los hijos. Confirmado con emulación móvil real (resize de ventana a 390×844) antes y después del fix. **Lección general**: si algún hijo usa `grid-area: <nombre>`, ese nombre tiene que estar cubierto por un `grid-template-areas` en TODOS los breakpoints donde ese hijo participe en el grid — nunca darlo por hecho solo en el breakpoint donde se pensó el layout.

Los textos de las 4 filas se reescribieron para ser fieles a la foto real de cada una (antes eran genéricos/no verificados contra ninguna imagen): fila 02 pasó de "Camiones con cesta" (mencionaba una cesta de poda que esa foto no muestra) a "Camiones de transporte" describiendo el camión de caja abierta real; fila 04 pasó de "Todo lo que necesite" a "Tractores y maquinaria pesada" para dar cabida al tractor real aportado (que no es una mini-excavadora, aunque el texto ya cubre "cualquier otra maquinaria"). Filas 01 (furgón cerrado) y 03 (camión pluma) ya encajaban tal cual con su foto.

---

## Bloque "Nuestros orígenes" en Historia + timeline más visual (2026-08-06)

`templates/page-historia.php` tenía, tras el hero, una página bastante plana en texto (una rejilla de "valores" y una línea de tiempo de solo texto) para ser la página que más debería transmitir la parte humana/familiar de la empresa. Se añadió una sección nueva justo debajo del hero — kicker `01 — Nuestros orígenes`, foto a la izquierda + cita editorial grande (comilla fantasma, mismo lenguaje que `.quote-band__mark`) y dos párrafos de contexto a la derecha — y se numeraron las 3 secciones de la página (01 orígenes → 02 reconocimiento → 03 trayectoria) según el patrón de kickers numerados ya establecido en el resto del sitio (`fg_kicker()`), que esta página apenas usaba.

El texto de esa sección (afición familiar anterior a la empresa, finales de los 80, Costa del Sol) está parafraseado del contenido real de `https://fantasticgardens.net/historia/` (v1) — comprobado con WebFetch y navegación directa el mismo día; v1 no tiene más datos que los que ya estaban portados a v2 (no hay nombres de fundadores, cifras adicionales ni testimonios citados literalmente en esa página).

**La fotografía es un placeholder, no la familia real:** por petición explícita del cliente ("pon alguna imagen de la familia por ahora cualquiera"), se usó `familia-1.jpg` de `fantasticgardens/wp-content/uploads/2020/08/` (v1) — un recorte de foto de stock de una familia genérica que el propio v1 ya usaba como imagen de marketing, NO una fotografía real de los fundadores. Se copió redimensionada a `assets/img/familia-fundadores.jpg` (1400px, JPEG ~330 KB) y se recorta con `object-position: 80% 42%` en `.origin-story__media img` porque el grupo familiar está en el lado derecho de la foto original, no centrado. **Pendiente**: sustituir por una fotografía real cuando el cliente la aporte — el `alt=""` se dejó vacío a propósito (imagen decorativa/placeholder) y no se le puso ningún pie de foto que afirme identidad (el rótulo bajo el texto dice solo "Origen · Costa del Sol", no "la familia fundadora").

De paso se le dio más peso visual a la línea de tiempo (`fg_timeline()` en `inc/components.php`): cada hito lleva ahora detrás un numeral romano fantasma (I–V) en serif itálica traslúcida, el mismo lenguaje que `.service-row__bignum`, y el punto de la línea temporal (`.timeline__dot`) ganó un anillo (`box-shadow` concéntrico) para leerse mejor. Nota técnica: `.timeline` necesitó un `max-width` explícito (antes ocupaba todo el ancho del `.wrap`) porque el numeral se posiciona con `right: 0` respecto a `.timeline__item` — sin ese límite de ancho, el numeral aparecía a cientos de píxeles de su texto en vez de solaparlo.

**Se "encienden" al bajar (mismo día):** el numeral y el punto de cada hito empiezan apagados (numeral casi invisible, punto hueco) y se encienden de uno en uno según se baja por el scroll, como si la trayectoria fuera un progreso — no se apagan si se vuelve a subir. Nuevo módulo `lineaTiempo()` en `assets/js/main.js`, justo después de `reveals()` y con su mismo estilo: un array de pendientes, un job en el `scrollJobs` compartido que compara `getBoundingClientRect().top` contra `window.innerHeight * 0.65` y va añadiendo `.is-lit` (nunca se quita). No usa `IntersectionObserver` a propósito, por consistencia con `reveals()` (mismo motivo: aquí no hace falta, pero mantener un único patrón de "scroll → clase" es más simple de mantener que mezclar dos mecanismos). Con `prefers-reduced-motion` se marcan todos como encendidos de golpe, sin animación.

**Página completa más dinámica y premium, con palabras destacadas e iconos (2026-08-10):** a petición del usuario, se revisaron las tres secciones de la página (hero, orígenes, reconocimiento y trayectoria) para que se lean menos como texto plano:

- **Frases destacadas en verde**: varios párrafos del hero y de "Nuestros orígenes" ganaron una frase clave envuelta en `<em class="em-verde">` (p. ej. "identidad, cuidado y permanencia", "paciencia, oficio y cariño"). Hasta ahora `em-verde`/`em-lima` solo se usaban en titulares (`title_html`) en todo el tema; esta es la primera vez que se usan dentro de un párrafo de cuerpo — funciona igual porque esas clases solo ponen `font-style`/`color`, sin tocar `font-size`, así que heredan el tamaño del párrafo en vez del de un titular.
- **"Particulares · Comunidades · Campos de golf" pasó de frase suelta a `.tag-row`/`.tag-linea`** (el mismo componente de píldoras con punto que ya usaba "El estudio" del home) — más visual, mismo componente reutilizado, sin CSS nuevo.
- **La enumeración "en el vivero de Ronda, en cada proyecto de diseño y en el mantenimiento diario" se sustituyó por `fg_service_chips()`** (el componente de píldoras con icono creado para la ficha de proyecto, ver esa entrada) enlazando a Vivero/Diseño/Mantenimiento — de frase pasiva a 3 accesos directos con icono real. Se le recortó el `margin-bottom` grande de serie (pensado para cerrar una sección) con `.origin-story__body .service-chips`, porque aquí le sigue la etiqueta de pie "Origen · Costa del Sol", no un cierre de sección.
- **Las 3 tarjetas de "valores"** tenían una hojita genérica repetida (`hojita.png`) sin relación con el contenido — pasaron a un icono real por tarjeta (calendario para "veinte años de oficio", lápiz de concepto para "Diseño y paisajismo", poda para "Mantenimiento especializado") dentro de una insignia circular verde 12%, nueva clase `.valor__icon` con el mismo lenguaje que `.project-specs__icon`/`.contact-tile__icon`. `fg_icon()` ganó una clave nueva, `calendar`, reutilizando el helper `fg_icon_or_asset()` ya creado para la ficha de proyecto.
- **`fg_timeline()` ganó un campo opcional `icon`** por hito (icono pequeño junto al año, dentro de `.timeline__year`) — cada era de la trayectoria lleva ahora un icono acorde (brote para "Origen", el icono `area` para "Crecimiento", plantación para "Vivero propio", el icono nuevo `award` para "Reconocimiento", `pin` para "Hoy"). `fg_icon()` ganó esa clave `award` (medalla de línea). `fg_timeline()` solo se usa en esta página, así que el cambio no afecta a nada más.
- **Resplandor ambiental de fondo** en la sección "Nuestros orígenes" (`#origen::before`/`::after`, mismo par de halos verde+lima que `#resultados`/`#proyecto-detalle`) y filetes verticales de revista (`fg_vlines(3)`, mismo componente que "04 Proyectos" del home) — ya no es solo la sección de fondo la que se apoya en un único watermark plano.
- Se retiró la variable `$leaf`/`hojita.png` del bucle de valores al quedar sin uso.

**Transición de color entre "01 Orígenes" y "02 Reconocimiento" (mismo día):** ambas secciones usaban `section--beige` — el mismo fondo, sin ninguna costura entre ellas. La de Reconocimiento pasó a `section--arena` (un tono distinto, ya usado en el home entre "Servicios" y "Vivero" con la misma cadencia beige→arena) y se añadió entre las dos el `.chapter-mark` (filete + hojita) que ya existía sin usarse fuera de la página de Vivero — mismo componente, mismo criterio ("costura discreta entre dos secciones que si no quedarían unidas solo por el aire").

---

## Migración a v5 (2026-07-31) — qué se adoptó, qué se conservó, y por qué

Sustitución completa del sistema visual/de componentes del tema por el de Marco (v5), preservando la arquitectura de datos y URLs ya validada. Decisiones tomadas con el usuario:

1. **Vivero/Plantación**: se mantuvo **una sola página** en la URL SEO ya indexada `/vivero-y-plantacion-propia/`, fusionando ahí el contenido de las tres páginas de Marco (`page-vivero.php` + `page-plantacion-propia.php` + `page-nuestra-plantacion.php`): hero con efecto de hojas (GSAP, conservado tal cual porque el cliente pidió explícitamente no tocarlo), banda de cifras, marquesina de especies, galería horizontal fijada (hgallery, GSAP), feature rows de botánica y de plantación propia, sección "de la plantación de Ronda a su jardín", y las 2 tarjetas de sede reales con mapas embebidos (Ronda + San Pedro) que ya existían en v2 y que Marco no tenía. El catálogo interactivo **"Descubrir especies"** sí se creó como página nueva (`catalogo-especies-plantas-vivero-marbella`) por ser una pieza funcional autocontenida (filtros, fichas modales, bandeja de selección con localStorage) que no encajaba como sección de una página existente.
2. **Proyectos**: se mantuvo la estructura plana actual (Proyectos realizados y Antes/Después como páginas hermanas) — **no** se adoptó la página hub "Proyectos" de Marco.
3. **Idioma ES/EN**: se mantiene Polylang como sistema real (selector "ES" placeholder sin cambios) — se **descartó** el selector `fg_url_en` de Marco (un simple enlace manual a una URL externa, no un sistema de contenido bilingüe real).
4. **Teléfonos**: se mantuvieron las 3 líneas reales (Móvil/WhatsApp, San Pedro, Ronda) en `inc/admin-settings.php` — Marco las había reducido a 2 (sin la línea de WhatsApp).
5. **CPT `proyecto`**: se portó tal cual desde el tema anterior (Marco no tenía CPT — usaba arrays hardcodeados con datos de relleno inconsistentes entre archivos). Las plantillas nuevas (`template-parts/home/proyectos.php`, `templates/page-proyectos.php`) leen del CPT real con `WP_Query`, con fallback estático a `proyecto-1/2/3.jpg` si la consulta no devuelve nada.
6. **Menú de navegación**: se mantiene `wp_nav_menu()`-equivalente real (vía `fg_get_primary_nav()`, ver arriba) en vez del array `$fg_nav` hardcodeado de Marco — ya se había tomado esta misma decisión una vez antes con una versión anterior de Marco.
7. **Fotografía**: se adoptó la fotografía nueva de Marco para heroes y secciones de atmósfera (toda de la misma procedencia que la ya usada en v2 en pasadas anteriores). Se conservaron intactas las únicas piezas de fotografía verdaderamente irremplazables: las 3 fotos reales de proyectos del CPT y las comparativas Antes/Después ya existentes.
8. **Cifra "+20 años"**: se adoptó la unificación de cifras ya aprobada por el cliente en el paquete de Marco (antes "+30/+40 años" y "finales de los años 80" en distintos sitios del tema; ahora "+20 años" en todo el sitio, sin inventar fecha de fundación exacta — sigue pendiente que el cliente la confirme). La línea de tiempo de Historia se conservó (contenido real que Marco no tenía) pero sus hitos se relabelaron de décadas fijas ("Finales 80s", "2000s"…) a etapas relativas ("Origen", "Crecimiento", "Vivero propio"…) para no contradecir la nueva política de "no inventar fecha".
9. **Textdomain**: se mantuvo `fg-theme` (el ya usado en `style.css`) en vez de adoptar el `fg` de Marco.
10. **CIF y datos legales**: Marco incluyó en su paquete un CIF (`B-92065101`) y una denominación social completa ("Fantastic Gardens A.J. S.L.") que no estaban en v2 antes. Se adoptaron como nuevos valores por defecto — **siguen sin confirmar por el cliente** (su propio LEEME así lo indica), no son datos verificados de forma independiente.
11. **`aggregateRating` hardcodeado** en el JSON-LD (4.9/5, 1000 reviews, no ligado a reseñas reales): se mantiene sin cambios — decisión de negocio preexistente, no parte de esta migración.

Componentes nuevos clave adoptados de Marco (`inc/components.php`, reescrito): `fg_kicker`, `fg_pill`, `fg_vlines`, `fg_overlay_card_hero`, `fg_before_after` (sustituye al antiguo `fg_compare` estático — divisoria arrastrable real), `fg_stats_band`, `fg_watermark`, `fg_quote_band`, `fg_service_rows`, `fg_testimonial_rail` + `fg_rail_controls`, `fg_zones_marquee`, `fg_contact_band` + `fg_site_closing` (cierre estándar de página: marquesina + "¿Hablamos?", sustituye a `fg_tagline_bar()` como cierre — `fg_tagline_bar()` se conserva para uso puntual). Se añadieron de vuelta `fg_timeline()` y `fg_icon_machine()` (contenido real que Marco no tenía: hitos de Historia y maquinaria de Mantenimiento) — `fg_feature_row()` ahora acepta tanto una URL de icono como marcado SVG ya construido, para soportar ambos casos.

---

## Homepage — secciones implementadas (v5)

`front-page.php` encadena, en este orden:

1. **Hero** (`template-parts/home/hero.php`) — vídeo de fondo a pantalla completa (ACF `hero_video`/`hero_poster`/`hero_mobile`, con fallback a los assets del tema), titular "Creamos tu *paraíso*", cifras integradas (+20 años · Ronda · 3 plantaciones propias · San Pedro), 2 píldoras CTA.
2. **01 El estudio** (`estudio.php`) — quiénes somos a dos columnas + fila de públicos (Particulares/Comunidades/Promotoras/Campos de golf).
3. **Banda de cita** (`fg_quote_band()`, llamada directa en `front-page.php`, no template-part) — "Los jardines que *permanecen* se piensan antes de plantarse", parallax a sangre.
4. **02 Servicios** (`servicios.php`) — `fg_service_rows()`: 4 filas anchas alternadas numeradas I–IV (ya no la rejilla de 4 tarjetas).
5. **03 Calidad y garantía** (`garantia.php`) — bloque oscuro (`section--osc`) con el sello de Ronda (`escudo-ronda.png`) y 4 avales.
6. **04 Proyectos** (`proyectos.php`) — 3 fichas en retrato **con datos reales del CPT** (`WP_Query`, no relleno) + comparador `fg_before_after()` con la comparativa real "Villa Costa del Sol".
7. **05 Botánica** (`vivero.php`) — foto del vivero de Ronda + 4 familias de plantas + CTA a "Descubrir especies".
8. **06 Clientes** (`resenas.php`) — `fg_testimonial_rail()`: carrusel arrastrable con las 2 reseñas reales de MundoJardinería (Andrew, Ana) + 1 tarjeta CTA con foto real de proyecto.
9. **Zonas** (`zonas.php`) — `fg_zones_marquee()`, marquesina continua de zonas de trabajo.
10. **Contacto** (`contacto.php`) — `fg_contact_band()`, "¿Hablamos?" enmarcado sobre fotografía.

---

## Header y navegación (v5)

### Estructura (`header.php`)
- Barra de progreso de lectura de 2px (`.scroll-progress`) en el borde superior, rellenada por scroll en `main.js`.
- Cabecera flotante: transparente y en claro sobre hero fotográfico (`fg_has_over_header()` → clase `.site-header--over`), se asienta en crema al bajar (`.is-solid`, vía JS).
- Navegación de escritorio (`.nav-desktop`) con dropdowns (Servicios, y sus hijas) — alimentada por `fg_get_primary_nav()` (menú real de wp-admin), no hardcodeada.
- Píldora "Presupuesto" (`pill--ghost`) enlazando a Contacto.
- Selector de idioma: placeholder estático "ES" (Polylang pendiente de configurar).
- Overlay móvil fullscreen (`.nav-overlay`) en verde oscuro, con wordmark, nav completa (incluye subenlaces) y pie con ubicaciones.

### Footer (`footer.php`)
4 columnas sobre `--verde-noche`: marca + NAP completo (ambas sedes, 3 teléfonos, email) · Servicios · Estudio · Contacto + redes. Barra legal fina de cierre (copyright + Cookies/Aviso legal/Privacidad). Se retiró el botón flotante de WhatsApp que tenía la versión anterior — sus vías de contacto (WhatsApp, ambos teléfonos) siguen presentes en el NAP del footer y en `fg_contact_band()`.

---

## JS implementado (v5)

| Archivo | Cuándo se carga | Módulos |
|---|---|---|
| `assets/js/main.js` | Siempre, sin dependencias | Barra de progreso + solidez de cabecera al bajar · menú móvil fullscreen (foco, Escape, bloqueo de scroll) · prefill de `?especie=` en el formulario de contacto · comparador arrastrable (`compareSliders`, ratón/dedo/teclado) · lightbox nativo (`<dialog>`) · contadores animados (IntersectionObserver) · marquesina sin costura · carrusel de reseñas (`rail`: drag, autoplay solo visible, pausa en hover) · reveals (`data-reveal`/`data-img-reveal`, con red de seguridad a 7s) · deriva de filigranas (`data-wm-float`/`data-parallax`) · magnetismo en CTAs/píldoras (solo con puntero fino) · reproducción del vídeo del hero (solo escritorio) |
| `assets/js/vivero.js` | Solo en la página de Vivero (GSAP + ScrollTrigger + Splitting) | Título por letras (`Splitting.js` + GSAP) · partículas de hojas (canvas propio, sin librería — tsParticles se descartó por pesar 195 KB) · galería horizontal fijada (`ScrollTrigger` pin+scrub) |
| `assets/js/especies.js` | Solo en Descubrir especies (dep. `fg-main`, sin librerías) | Filtros por familia (chips) · eleva cada `<details>` a modal `<dialog>` · bandeja de selección con `localStorage` (`fg_seleccion_especies`) |

Todo respeta `prefers-reduced-motion`: sin él, ni el magnetismo ni los reveals ni la marquesina ni el autoplay se activan — el contenido se ve directamente. Si el JS no llega a ejecutarse, nada queda oculto (las clases que esconden lo animable las añade el propio script).

**Ya no existe Lenis** (smooth-scroll) en el tema: se retiró por completo en la migración v5 — interceptaba la rueda/trackpad e introducía retardo en todas las páginas. El scroll es nativo del navegador en todo el sitio.

---

## SEO técnico (`functions.php`)

- Meta description + Open Graph + Twitter Card: solo si no hay Rank Math ni Yoast activos (`RANK_MATH_VERSION`, `WPSEO_VERSION`, `WPSEO_Frontend`).
- **Schema.org LocalBusiness JSON-LD**: se emite siempre (independientemente de plugins SEO), con **dos ubicaciones** (`location[]`): Oficinas San Pedro de Alcántara y Garden Center/vivero de Ronda, cada una con su propia dirección y teléfono via `fg_opt()`. `aggregateRating` hardcodeado (4.9/5, 1000 reviews — ver nota en "Migración a v5" sobre por qué no se ha tocado). Incluye también `review[]` con las 2 reseñas reales de MundoJardinería (Andrew, Ana — mismo texto que `template-parts/home/resenas.php`, mantener ambos en sync) y `sameAs` dinámico (producción + Instagram/Facebook si están rellenos en FG Ajustes).

> ⚠️ **Yoast SEO (`wordpress-seo`) está activo** (confirmado 2026-08-03) → `$has_seo_plugin` es `true` en runtime, así que todo el bloque de `fg_seo_head()` que imprime `<meta name="description">` + Open Graph + Twitter Card (y el filtro `fg_seo_title` sobre `document_title_parts`) **es código muerto mientras Yoast siga activo**: Yoast genera su propio `<title>`, meta description y OG tags para la portada a partir de **Ajustes SEO → Apariencia en buscadores → Página de inicio** (opción `wpseo_titles`: `title-home-wpseo`, `metadesc-home-wpseo`, `open_graph_frontpage_*`) y del fallback global `wpseo_social.og_default_image*`. El código del tema queda como fallback correcto por si Yoast se desactiva, pero **para cambiar el title/description/OG-image reales de la home hay que editar esas opciones de Yoast** (wp-admin o `wp option patch update wpseo_titles <clave> "<valor>"`), no `functions.php`. El JSON-LD LocalBusiness del tema sí se emite siempre, en paralelo al `yoast-schema-graph` (CollectionPage/WebSite/BreadcrumbList) — no hay conflicto, Google combina ambos `<script type="application/ld+json">`.
> Revisión 2026-08-03: el `metadesc-home-wpseo` y `open_graph_frontpage_desc` de Yoast estaban desactualizados (mencionaban "Más de 40 años", contradiciendo la unificación a "+20 años" de la migración v5) y `open_graph_frontpage_image` estaba vacío (sin imagen de preview al compartir la home en redes/WhatsApp). Corregido: descripción con copy actual (~140 caracteres), imagen fijada a `hero-indice-poster.jpg` importada a la media library (adjunto ID 32) para que Yoast calcule `og:image:width/height` automáticamente.

---

## Datos de la empresa (usar en contenido)

| | |
|---|---|
| Móvil / WhatsApp | **691 142 679** |
| Tel. San Pedro | 952 78 44 29 |
| Tel. Ronda | 952 00 68 41 |
| Email | info@fantasticgardens.net |
| Oficinas | San Pedro de Alcántara, Marbella — Pol. Industrial San Pedro, El Potril parcela nº 6 |
| Vivero / Garden Center | 796 Partida, Ctra. Ronda-Setenil, 29394 La Cimada, Málaga (corregida 2026-08-05, antes "Los Prados, 29400 Málaga") · 40 ha · +17.000 especies · 4.000 m² cubiertos |
| Horario San Pedro (oficinas) | Lu–Vi 8:00–16:00 · cerrado sáb. y dom. |
| Horario Ronda (vivero) | Lu–Vi 7:00–15:00 · Sáb. 9:00–14:00 · cerrado dom. |
| Antigüedad | "+20 años" (unificado en todo el sitio, jul. 2026) — año exacto de fundación **pendiente de confirmar por el cliente** |
| Proyectos | +1.000 |
| CIF | B-92065101 (aportado por Marco, **pendiente de confirmar por el cliente**) |
| Denominación social | Fantastic Gardens A.J. S.L. (idem, pendiente de confirmar) |

> **Horarios (2026-08-05):** datos reales aportados por el cliente (perfil de Google Business de cada sede), sustituyen al horario genérico "Lunes a Viernes, 8:00–18:00" que traía el tema desde la migración v5. Editables en Apariencia → FG Ajustes → Horario (`fg_hours` / `fg_hours_ronda`, con fallback a `fg_defaults()` en `functions.php`). Se reflejan en `templates/page-contacto.php` (tarjeta "Llamar ahora" + las 2 fichas de sede) y en el `openingHoursSpecification` del JSON-LD `LocalBusiness` (ahora uno por sede en `location[]`, en vez del único genérico Lu–Vi 8–18 anterior).

---

## WP-CLI — comandos frecuentes

```bash
# El binario vive en /usr/local/bin/wp. OJO: en zsh, "WP=\"wp --path=...\"; $WP comando"
# NO funciona (zsh no separa palabras de una variable sin comillas) — escribe el
# comando completo cada vez, o usa un array zsh si hace falta reutilizarlo.
wp --path=/home/daniel/proyectos/fantasticgardensv2 post list --post_type=page --fields=ID,post_title,post_status,post_name
wp --path=/home/daniel/proyectos/fantasticgardensv2 post list --post_type=proyecto --fields=ID,post_title,menu_order

# Crear página
wp --path=/home/daniel/proyectos/fantasticgardensv2 post create --post_type=page --post_title='Título' --post_status=publish

# Importar imagen a la media library
wp --path=/home/daniel/proyectos/fantasticgardensv2 media import /ruta/imagen.jpg --title="Título" --porcelain

# Asignar imagen destacada / meta / template
wp --path=/home/daniel/proyectos/fantasticgardensv2 post meta update POST_ID _thumbnail_id ATTACHMENT_ID
wp --path=/home/daniel/proyectos/fantasticgardensv2 post meta update POST_ID ubicacion "Marbella · Costa del Sol"
wp --path=/home/daniel/proyectos/fantasticgardensv2 post meta update PAGE_ID _wp_page_template "templates/page-contacto.php"

# Flush rewrite (tras crear CPTs o cambiar slugs) — SIN --skip-themes, si no el CPT no se registra
# y las reglas de reescritura de 'proyecto' no se regeneran correctamente
wp --path=/home/daniel/proyectos/fantasticgardensv2 rewrite flush

# Ver ubicación de un menú (para confirmar que primary-menu sigue asignado)
wp --path=/home/daniel/proyectos/fantasticgardensv2 menu list
```

### Verificación rápida sin curl

El shell de este entorno no tiene `curl` ni siempre `tail`/`rm` disponibles en pipes encadenados, y `status` es variable reservada en zsh (no usarla como nombre). `identify`/`convert`/`cwebp`/`jpegoptim` (ImageMagick) **tampoco están disponibles** (contradice una nota anterior de este documento — confirmado de nuevo el 2026-07-31). Para comprobar que una página carga:

```bash
wget -O /dev/null "http://fantasticgardensv2.test/slug-de-la-pagina/"   # imprime "200 OK" / error en stderr
file /ruta/a/imagen.jpg                                                 # dimensiones/formato básico (sin ImageMagick)
```

---

## Rediseño de Diseño de paisajismo (2026-08-07)

`templates/page-servicio-diseno.php` se rehízo tomando como referencia la maqueta HTML del cliente `Diseno Paisajismo.dc.html` (misma carpeta de referencias que originó la migración v5), desde el hero hasta el CTA "Solicitar un proyecto 3D" — footer/header no se tocaron, ya son globales. De paso se corrigió un bug real: el hero usaba `card-diseno.jpg` (la miniatura de tarjeta que también usan `page-servicios.php` y el home) en vez de `hero-diseno-paisajes.jpg`, que ya existía en `assets/img/` desde la migración v5 pero nunca se había referenciado en ningún PHP.

La sección "Cuéntanos qué necesitas" pasó de una lista de puntos plana (`.dot-list`, eliminada del CSS por quedar sin ningún otro uso en el tema) a un patrón nuevo de introducción partida: aside con kicker/titular/CTA fijo en pantallas anchas (`.split-intro`, sticky desde 900px, mismo criterio que `.calendar-media`) junto a una rejilla de 6 pasos numerados con separadores de 1px y fondo que se aclara al pasar el ratón (`.numbered-grid`), igual que en la maqueta de referencia. La fila de iconos (Concepto/Materiales/Vegetación/Dirección de obra) pasó de fondo claro a una franja oscura (`section--osc`) para que se lea como transición entre secciones, tal como en la maqueta — `fg_feature_row()` ya soportaba fondo oscuro sin cambios (usado en "Calidad y garantía" del home).

El comparador antes/después (`fg_before_after`, sin tocar) ganó un modificador `.ba-list--pair` para mostrar las 2 comparativas de esta página en 2 columnas desde 720px — `page-antes-despues.php` reutiliza la misma clase base `.ba-list` pero sin el modificador, así que sigue apilada tal cual (cada ficha ahí lleva su propio título y puede tener cualquier número de comparativas). **Nota de especificidad**: el primer intento del modificador (`.ba-list--pair` con una sola clase) tenía la misma especificidad que la regla base `.ba-list` definida más abajo en el archivo, así que perdía la cascada por orden de aparición — hubo que escribirlo como `.ba-list.ba-list--pair` para que ganara. Confirmado en navegador con `getComputedStyle` en ambas páginas tras el fix.

**Segunda pasada, mismo día — ajustes tras comparar en navegador contra la maqueta:**
- `fg_photo_hero()` ganó una clave opcional `breadcrumb` (mismo formato que `fg_breadcrumb()`) para mostrar las migas de pan "Inicio / Diseño de paisajes" sobre el titular del hero, como en la maqueta. El CSS `.photo-hero__content .breadcrumb` ya existía sin usar (preparado en la migración v5); el resto de páginas con `fg_photo_hero()` no pasan esa clave y quedan exactamente igual que antes.
- La franja de iconos (Concepto/Materiales/Vegetación/Dirección de obra) llevaba el layout apilado de serie de `fg_feature_row()` (icono encima, filete divisorio) — muy distinto de la fila horizontal sin filetes de la maqueta. Se añadió un scope `.design-features` (misma sección) que reescribe `.feature`/`.feature__icon`/`.feature__label` a fila horizontal con icono invertido a blanco, sin tocar `fg_feature_row()` ni sus otros usos en el tema (mismo patrón de override por clase de sección que ya usa `.species-cultivo` para su propia variante).
- La cabecera "Antes de decidir · Vea su proyecto en 3D" usaba `fg_section_heading()` (título y subtítulo apilados en una columna); la maqueta los pone en una fila partida (título a la izquierda, subtítulo a la derecha). Se sustituyó por el marcado manual `.section-head.section-head--split` que ya usa Mantenimiento en "Qué hacemos, y cuándo" — mismo componente CSS, sin crear nada nuevo.

**Tercera pasada, mismo día — el hero seguía sin igualar la maqueta pixel a pixel (subtítulo pequeño en vez de entradilla itálica grande, CTA como enlace subrayado en vez de píldora sólida, sin acento en cursiva en "paisajes").** `fg_photo_hero()` ganó 4 claves opcionales más, todas con comportamiento por defecto idéntico al actual (ninguna página existente las pasa, así que nada más cambia):
  - `pill_cta` (bool): activa la misma fila alta subtítulo+píldora que ya usaba Mantenimiento (`$rich`, antes solo disparada por `cta_secondary`) pero con una sola píldora — sin `cta_secondary` ni `tags` no se renderizan, así que no hereda el resto del look de Mantenimiento.
  - `subtitle_lead` (bool): pasa el subtítulo a entradilla grande en Cormorant Garamond itálica (`.hero__subtitle--lead`) en vez del texto de apoyo pequeño de serie.
  - `row_plain` (bool): quita el filete divisorio de `.hero__row` (`.hero__row--plain`) — la maqueta separa subtítulo y CTA solo con aire, sin línea, a diferencia de Mantenimiento.
  - `accent_rule` (bool): fuerza el filete de acento bajo el titular también cuando se usa `title_html` (antes ese filete solo salía con `title` plano — Contacto y Mantenimiento usan `title_html` sin filete a propósito y siguen igual). Combinado con la clase nueva `.accent-rule--lima`, el filete queda en lima en vez de crema, a juego con el acento `em-lima` de "paisajes".
  Confirmado en navegador que Servicios, Mantenimiento y Contacto (los otros 3 usos de `fg_photo_hero()`) se ven exactamente igual que antes de este cambio.

---

## Rediseño de Servicios — hero a rejilla numerada (2026-08-07)

`templates/page-servicios.php` se rehízo (hero, rejilla de servicios y "Obra y proyecto a medida") tomando como referencia la maqueta del cliente `Servicios.dc.html` (misma carpeta que originó la migración v5 y el rediseño de Diseño de paisajismo). El cierre de página (marquesina de zonas + "¿Hablamos?" vía `fg_site_closing()`) **no se tocó a propósito**: la maqueta de Marco lo resuelve con una banda oscura simple de una sola píldora, pero v2 ya estandarizó ese cierre en todas las páginas (ver "Migración a v5" más arriba) — sustituirlo solo aquí habría reintroducido la inconsistencia entre páginas que esa decisión ya resolvió.

- **Hero**: ganó breadcrumb (Inicio / Servicios), entradilla itálica grande (`subtitle_lead`, `row_plain`) y una cifra animada nueva junto al subtítulo ("4 áreas de trabajo"). `fg_photo_hero()` ganó la clave opcional `stat` (`['count'=>int,'label'=>string]`), que activa el modo alto igual que `pill_cta`/`cta_secondary` y pinta un bloque `.hero__solo-stat` al lado opuesto del subtítulo en vez del CTA — nombrado así (no `.hero__stat`) porque esa clase ya existía para la cuadrícula de cifras del hero de portada; reutilizar el nombre habría pisado ese estilo. El bloque `.hero__cta` pasó a ser condicional (antes se imprimía siempre en el modo alto, vacío si no había `cta`/`cta_secondary`) para poder alternar con `stat` sin dejar un `<div>` fantasma en el `flex` del `.hero__row`.
- **Rejilla de servicios**: sustituida la `.service-card` genérica (foto clara con título encima, pensada para páginas de listado tipo Proyectos) por un componente nuevo, `fg_service_tile()` + `.service-tile`, que reproduce la ficha oscura a sangre de la maqueta: número al vuelo, overlay degradado (mismo lenguaje de `rgba(22,33,26,*)` que `.photo-hero__overlay`), título y flecha invertida a blanco al pie. El hover (zoom lento + atenuado) usa `scale` en vez de `transform` a propósito, mismo motivo que `.fx-frame img` — el sistema de reveal ya anima `transform` en el asentado.
- **"Obra y proyecto a medida"**: ganó el número de kicker que le faltaba (`05`) y el acento en cursiva de la maqueta (`<em class="em-verde">a medida</em>`). La rejilla de 4 iconos pasó de `fg_feature_row(..., 'detailed')` (filete superior, fondo crema liso) a una variante nueva, `fg_feature_row(..., 'grid')`: celdas con gap de 1px sobre fondo oscuro (el hueco actúa de filete horizontal Y vertical) que se aclaran al pasar el ratón — y la sección pasó a fondo `--arena` (`.section--arena`, nueva utilidad junto a `.section--beige`) en vez de `--crema`, como en la maqueta. La filigrana decorativa de esta sección cambió de `hojita.svg` a `icons/botanica/olivos.svg` (ya usada como marca de agua en Mantenimiento) para acercarse al motivo de olivo de la maqueta — no existe un asset `olive-motif.svg` en el tema pese a mencionarlo una entrada anterior de este documento.
- De paso, `.breadcrumb--light [aria-current]` (la miga de pan de la página actual, p. ej. "Servicios") pasó a lima en vez de crema — así es en todas las maquetas de Marco (Servicios, Diseño de paisajismo…) y no tenía sentido limitarlo a esta página; el resto de usos de `fg_breadcrumb(..., 'light')` en el tema quedan iguales salvo por ese detalle de color, que ya faltaba por aplicar en todos.

---

## Rediseño de Antes y Después (2026-08-07)

`templates/page-antes-despues.php` era la única página de servicio que seguía con el patrón viejo (`<h1 class="page-title">` suelto en vez de `fg_photo_hero()`) — se llevó al mismo nivel que Diseño de paisajismo: hero fotográfico rico (breadcrumb, título con acento `em-lima`, entradilla itálica grande, píldora sólida, `pill_cta`/`row_plain`/`accent_rule`, las mismas claves opcionales de `fg_photo_hero()` añadidas para Diseño), banda de cifras animadas (`fg_stats_band()`, cifras reales ya usadas en otras páginas: +20 años, +1.000 proyectos, 2 sedes, 0€ visita) y cabecera de sección partida (`.section-head--split`) antes del comparador.

**Bug de contenido real encontrado y corregido de paso**: `page-antes-despues-hero.jpg` (nombre heredado de la tanda `page-X-hero.jpg` de antes de la migración v5, la misma familia que `page-diseno-hero.jpg`/`page-mantenimiento-hero.jpg`/etc., todas huérfanas tras v5 salvo esta) estaba mal wireada como mitad "antes" de la segunda comparativa — y su pareja `page-antes-despues-2.jpg` (un solar en tierra con solo el vaso de la piscina) hacía de "después", es decir, la comparativa mostraba el jardín *empeorando*. Esto pasó desapercibido porque esta página nunca se tocó en la migración v5 (ver nota en "Migración a v5"/"Reglas de trabajo" de este documento). Se retiró esa segunda comparativa (sin una pareja "después" real que le corresponda, no se ha inventado ninguna) y `page-antes-despues-hero.jpg` — un jardín terminado con césped, piscina y vistas, exactamente lo que su nombre indica — pasó a ser el hero de la página, su uso original. La única comparativa que queda (Jardín Villa Costa del Sol, `page-antes.jpg` → `page-despues.jpg`) sí es una pareja real y coherente (obra en tierra → jardín terminado), verificada visualmente. `page-antes-despues-2.jpg` queda huérfana — sumada al pendiente de limpieza de `assets/img/` ya existente.

De paso se corrigió que `.ba-item__slider`/`.compare__name` de este comparador nunca habían tenido `margin-inline:auto`/`text-align:center` pese a que el comentario en `main.css` decía "se limitan y se centran" — ahora sí quedan centrados bajo el título, en vez de pegados al margen izquierdo del `.wrap`.

**Hero sustituido (2026-08-10):** el cliente aportó una fotografía nueva (`assets/img/transformacion-jardin-antes-despues-piscina-marbella.jpg`, convertida de WEBP a JPEG con Pillow) que es en sí misma un fotomontaje antes/después (solar en obra → jardín con piscina, césped y palmeras) en una sola imagen. Pasó a ser el `image` del hero (`fg_photo_hero()`) de esta página, sustituyendo a `page-antes-despues-hero.jpg` (que queda huérfana, sumada al pendiente de limpieza). El hero de esta página ganó además su propia variante de scrim, `.photo-hero--soft-overlay` (nueva clave opcional `extra_class` en `fg_photo_hero()`, sin efecto en el resto de páginas que no la pasan): oscurece algo menos la foto para que se lea mejor al ser un fotomontaje ya de por sí con mucho detalle.

**Sección "01 — Resultados reales" más visual (2026-08-10, mismo día):** ganó resplandor ambiental de fondo (`#resultados::before`/`::after`, mismo par de halos círculo verde+lima que ya usan el footer y `#maquinaria`, pero muy suaves — opacidad .10–.12 — al ser fondo claro) y una variante "enmarcada" del comparador, `.ba-item--framed .ba-item__slider` (mat blanco, borde sutil, sombra amplia difusa — mismo lenguaje de elevación que `.contact-tile`/`.card-link` — en vez del recorte suelto de antes). Cada ficha ganó también una leyenda editorial (`figcaption.ba-item__cap`, clase que ya existía sin usar aquí — sí la usa Diseño de paisajismo). Todo con `clamp()` para escalar en móvil sin tocar `.ba-item__slider`/`.ba-list` a secas (Diseño de paisajismo, que reutiliza esas mismas clases base, queda igual).

**Segunda comparativa real añadida (2026-08-10, mismo día):** el cliente aportó una pareja real antes/después de la misma villa del fotomontaje del hero (mismo encuadre de palmera y porche, dos fotos WEBP separadas y alineadas — a diferencia del collage ya fusionado del hero, esta sí encaja en `fg_before_after()`). Convertidas a JPEG con Pillow (1272×716, calidad 85) y guardadas como `assets/img/reforma-jardin-piscina-marbella-antes.jpg` / `-despues.jpg` (nombres con palabras clave SEO, mismo criterio que el resto de `assets/img/`). Se añadió como segunda ficha del `.ba-list`, con el mismo tratamiento `.ba-item--framed` que la comparativa de Villa Costa del Sol.

---

## Ficha de proyecto individual ampliada (2026-08-10)

`single-proyecto.php` era muy pobre (hero + `the_content()` casi siempre vacío + relacionados) para los 3 proyectos reales del CPT. Se amplió a una ficha completa con cifras, storytelling e icono, sin tocar la vista de listado (`templates/page-proyectos.php`) ni el CPT en sí:

- **Nuevo archivo de datos, `inc/proyectos-detalle.php`** (añadido a `$fg_inc` en `functions.php`, mismo patrón que `inc/especies.php`): un array por ID de post con `resumen`, `reto`/`solucion`, `specs` (cifras con icono), `servicios` (chips enlazando a la página real de cada servicio) y `galeria` (fotos adicionales). Se eligió ID de post en vez de slug porque el `post_name` de dos de los tres proyectos queda con el carácter "·" mal codificado (`villa-mediterranea-%c2%b7-marbella`) — el ID es estable y ya se usa en otras partes del tema (thumbnail, menu_order).
- **Componentes nuevos en `inc/components.php`**: `fg_project_specs()` (fila de cifras icono+etiqueta+valor), `fg_project_story()` (par de tarjetas "El reto"/"La solución" con numeral en insignia lima, mismo gesto que la insignia de `.steps--panel`), `fg_service_chips()` (píldoras con icono enlazando a Diseño/Mantenimiento/Vivero) y `fg_project_gallery()` (fotos adicionales que abren `fg_lightbox()` — el diálogo ya existía en el tema desde antes de esta migración pero **no lo llamaba ninguna plantilla**; esta es su primera vez en uso real). `fg_icon()` ganó dos claves nuevas, `area` y `calendar` (SVG de línea, mismo estilo que las ya existentes). `fg_icon_or_asset()` es el pequeño helper que decide entre un icono de `fg_icon()` y una ruta de imagen en `assets/img/` (los iconos de `icons/servicios/*.svg`/`icons/botanica/*.svg` llevan el verde ya fijado en el propio SVG, no son `currentColor`).
- **CSS nuevo en `main.css`** (bloque "Ficha de proyecto individual"): `.project-specs` (fila de cifras, insignia circular verde 12%, mismo lenguaje que `.contact-tile__icon`), `.project-story` (tarjetas beige, 1 columna en móvil → 2 desde 720px), `.project-gallery` (grid de fotos con lightbox; `.project-gallery--single` cuando solo hay una) y `.service-chips`/`.service-chip` (píldora con borde, se tiñe de verde al pasar el ratón). `.project-gallery__item` se añadió a la lista compartida `:is(...)` de `.fx-frame` (línea ~832 y siguientes) para heredar el mismo Ken Burns/marco que `.card-link`/`.project-card`, en vez de duplicar esas reglas.
- **Hero**: ganó `kicker`/`kicker_num` ("Proyecto realizado" + 01/02/03 según `menu_order`), sin cambios en `fg_photo_hero()` (esas claves ya existían).
- **Filetes verticales de fondo**: `fg_vlines(3)` (mismo componente y número de columnas que "04 Proyectos" del home) al inicio de la sección, para el mismo efecto "rejilla de revista" que se dibuja de arriba abajo al entrar en pantalla — no se creó nada nuevo, ya existía en `inc/components.php` sin usarse aquí.
- **Fondo más pulido (mismo día):** segunda filigrana botánica (`icons/botanica/gramineas.svg`, esquina inferior izquierda) para equilibrar con la de `olivos.svg` que ya estaba arriba a la derecha, más resplandor ambiental de fondo (`#proyecto-detalle::before`/`::after`, mismo par de halos verde+lima que `#resultados`/`#maquinaria`, en las esquinas opuestas a las filigranas). `.project-story__card` ganó una sombra amplia difusa y `.project-specs__icon` un anillo sutil de 1px — mismo lenguaje de elevación que el resto del sitio, sin inventar un tratamiento nuevo.

**Qué contenido es real y cuál es un borrador (importante para no tratarlo como dato verificado):**
- **Villa Mediterránea (24) y Jardín con Palmeras (25)** son obras reales — fotografía real del cliente — pero **la superficie (≈1.200 m² / ≈950 m²) y la duración de obra (4 / 3 meses) son estimaciones redactadas por el estudio**, no datos aportados por el cliente; igual que el texto de "El reto"/"La solución" de estos dos, que es narrativa plausible pero no verificada. Pendiente de confirmar con el cliente antes de publicarlo como hecho (añadido a Pendientes).
- Se importaron **2 fotos reales adicionales** desde `fantasticgardens` (v1, `wp-content/uploads/2020/·`), recomprimidas con Pillow: `villa-mediterranea-marbella-piscina-pergola-jardin.jpg` (`Fantastic-Gardens-Proyectos-2.jpg`, misma tanda de fotos que ya dio `proyecto-1.jpg`, ángulo distinto de la piscina con pérgola) y `detalle-hoja-palmera-mediterranea-jardin.jpg` (`Palmera-Fantastic-Gardens.jpg`, un macro de hoja de palmera de la v1, genérico — su `alt` no afirma que sea la parcela de Benahavís, solo "detalle de una hoja de palmera mediterránea").
- **Jardín en Ronda (26)**: al revisar la foto real de este proyecto (`proyecto-3.jpg` = `GARDEN-RONDA.jpg` de v1) para escribir su ficha, se descubrió que **no es un jardín de cliente instalado**: es el interior del propio Garden Center/vivero de Ronda (nave con topiaria y flores en venta). Esta etiqueta ya venía así de antes de esta sesión (no se ha cambiado el CPT ni la foto). En vez de inventar cifras de un "proyecto de jardín" que contradirían la foto, la ficha de este proyecto reutiliza **cifras reales ya publicadas en el resto del sitio** sobre el vivero (40 ha de cultivo, +17.000 especies, 4.000 m² cubiertos — ver "Datos de la empresa") y se importó una segunda foto real, `vivero-ronda-campos-cultivo-fantastic-gardens-aereo.jpg` (`Ronda-3.jpg` de v1, vista aérea de los campos de cultivo), que sí encaja con ese enfoque. Ningún dato inventado en esta ficha en particular.

---

## Bug real: los reveals de scroll no animaban en móvil (2026-08-10)

El usuario reportó que, en móvil, las secciones no se animaban al hacer scroll (en escritorio sí). Causa raíz encontrada: `main.css` tenía, desde antes de esta sesión, `.section + .section, .quote-band + .section { content-visibility: auto; contain-intrinsic-size: auto 40rem; }` — un ahorro de pintado para páginas largas, con un comentario que afirmaba "sin efecto visible" (nunca verificado).

El sistema de reveals (`reveals()` en `main.js`) **no usa `IntersectionObserver`** a propósito: el propio código explica que un elemento oculto con `clip-path`/`scaleY(0)` (los titulares, los filetes verticales) tiene un rectángulo de intersección vacío, así que la IO nunca lo notificaría. En su lugar mide `getBoundingClientRect()` en cada fotograma de scroll. Ese es justo el punto ciego de `content-visibility: auto`: mientras una sección no es "relevante" para el navegador, salta su layout entero, y `getBoundingClientRect()` de lo que hay dentro devuelve un rectángulo vacío (top ≈ 0) en vez de la posición real. El chequeo de `reveals()` que decide "esto ya está a la vista, no lo animes" (`rect.top <= innerHeight*0.9`) interpretaba ese `0` como "ya visible" y le ponía `is-in` de golpe al cargar la página, sin transición — el contenido aparecía ya puesto, nunca animado.

Esto pasaba en escritorio también, pero se notaba mucho menos: con las rejillas a varias columnas las secciones son más bajas y se acercan más al `contain-intrinsic-size` de 40rem (640px) que se les había asignado a todas por igual. En móvil, con todo apilado a una columna (specs, tarjetas, galerías…), las secciones reales son mucho más altas que esos 640px — se quedaban "no relevantes" durante mucho más scroll, así que muchas más secciones por página arrancaban con ese diagnóstico erróneo de "ya visible".

**Corrección**: se retiró la regla `content-visibility`/`contain-intrinsic-size` por completo (línea ~594 de `main.css`, comentario explicativo dejado en su lugar). No se ha medido el coste de pintado sin ella (sigue pendiente el Lighthouse general del sitio), pero la animación de scroll es un pilar de diseño explícito del sitio — se prioriza la corrección sobre un ahorro de pintado que nunca se había verificado y que además tenía un efecto secundario tan visible. No hacía falta tocar `main.js`: quitando la causa (el layout saltado), `getBoundingClientRect()` vuelve a devolver la posición real en todas las secciones, de todas las páginas, en cualquier ancho.

---

## "Marbella · Costa del Sol" en el menú móvil (2026-08-10)

Esa línea (`fg_opt('brand_sub')`, `.brand__sub` junto al logo) ya existía en la cabecera, pero se oculta con `display:none` en `@media (max-width: 560px)` para dejarle sitio al botón de menú en pantallas muy estrechas — no aparecía en ningún sitio del menú móvil (overlay a pantalla completa) que la sustituyera. Se añadió junto al wordmark de `.nav-overlay__top` (`header.php`), envuelta en `.nav-overlay__brand` (columna: nombre + línea de ubicación), con su propio estilo `.nav-overlay__tagline` — mismo tamaño/tracking que `.brand__sub` pero en el tono apagado que ya usa `.nav-overlay__foot` para texto secundario sobre el verde oscuro del overlay (`color-mix(crema 65%)`), en vez de reutilizar tal cual `.brand__sub` (pensado para la cabecera clara/transparente, no para este fondo). **Y también en la cabecera contraída (mismo día):** el usuario pidió que se viera ahí también, no solo en el overlay. Primer intento: quitar el `display:none` de `@media (max-width: 560px)` reduciendo `letter-spacing` y añadiendo `text-overflow:ellipsis` como red de seguridad. El usuario pidió después acortar el texto en vez de arriesgarse a que se corte: en la cabecera contraída de móvil se muestra solo el último tramo tras el "·" ("Costa del Sol"), no la línea completa.

Implementación: `header.php` calcula `$fg_brand_sub_short` partiendo `$fg_brand_sub` por "·" y quedándose con el último trozo (con *fallback* al texto completo si no hay "·" — no se puede asumir el separador si algún día se edita el ajuste desde FG Ajustes). El lockup de marca imprime ambas versiones, `.brand__sub-full` y `.brand__sub-short`, dentro del mismo `.brand__sub`; el CSS alterna cuál se ve por breakpoint (`.brand__sub-short` oculto por defecto, visible solo en `@media (max-width: 560px)`, donde `.brand__sub-full` se oculta a la inversa). El `.nav-overlay__tagline` del menú a pantalla completa **no** se ha tocado — sigue usando `$fg_brand_sub` completo siempre, porque ahí sí hay sitio de sobra y el usuario solo pidió acortarlo en la cabecera contraída.

---

## Bug real: el enlace "WhatsApp" del footer marcaba, no abría WhatsApp (2026-08-10)

En `footer.php`, el NAP del pie tenía `<a href="tel:...">691 142 679 · WhatsApp</a>` — el texto decía WhatsApp pero el `href` era un `tel:`, así que abría el marcador de teléfono en vez de WhatsApp. El resto del sitio (`templates/page-contacto.php`) ya resolvía esto bien con `https://wa.me/<número sin el "+">`; se aplicó el mismo patrón aquí: `$fg_wa_href = str_replace('+', '', fg_opt('phone_href'))` y `href="https://wa.me/<?php echo esc_attr($fg_wa_href); ?>"`. Sin `target="_blank"` a propósito, igual que en Contacto (no es una inconsistencia nueva, es el mismo comportamiento ya establecido en el resto del sitio).

---

## Reglas de trabajo

- Modificar **solo** archivos dentro de `wp-content/themes/fg-theme/`
- CSS → `assets/css/main.css` únicamente. Nunca en `style.css`
- JS externo permitido de forma acotada: GSAP + ScrollTrigger + Splitting, vendorizados en `assets/js/vendor/` (sin CDN), y **solo cargados en las páginas que realmente los necesitan** (Vivero) — no añadir más dependencias JS sin acordarlo antes. Google Fonts sigue siendo la única dependencia CSS externa
- ACF está instalado y activo — úsalo solo para medios opcionales (vídeo/póster/imagen móvil del hero); el tema debe seguir funcionando si se desactiva (fallback a assets del tema)
- No tocar WordPress core ni plugins salvo instalación/activación acordada explícitamente
- **Mobile-first, pero responsive de verdad**: todo diseño/feature nuevo se piensa primero para móvil (es el punto de partida de la maquetación y de las decisiones de layout), pero el resultado final tiene que verse bien en **todos** los dispositivos (tablet, escritorio, pantallas grandes) — mobile-first no significa "solo móvil", significa "móvil primero, luego se escala hacia arriba con `min-width`". Al pedir o construir algo nuevo, arrancar por la maqueta/comportamiento en móvil y comprobar después que escala correctamente en el resto de anchos. **Limitación de entorno conocida**: las herramientas de navegador de esta sesión no han permitido emular de forma fiable un viewport estrecho (el redimensionado de ventana no afecta al layout renderizado) — la validación visual real en móvil sigue pendiente de una sesión/dispositivo que sí lo permita. El CSS es mobile-first y hereda breakpoints ya usados en pasadas anteriores, pero no se ha *visto* en un viewport real de teléfono.
- Todo CSS debe ser language-agnostic (Polylang gestiona ES/EN)
- Cambios incrementales y reversibles

---

## Pendiente / próximos pasos

- [ ] Sustituir `assets/img/familia-fundadores.jpg` (placeholder de stock de v1) por una fotografía real de los fundadores en la sección "Nuestros orígenes" de Historia — ver detalle en la entrada del 2026-08-06
- [ ] Validar visualmente en viewport móvil real (ver limitación de entorno arriba — sigue sin poderse hacer desde esta sesión de Claude Code), incluyendo que los reveals de scroll ya animan correctamente tras quitar `content-visibility` (ver "Bug real: los reveals de scroll no animaban en móvil", 2026-08-10) — el diagnóstico y la corrección son sólidos por razonamiento sobre el motor de reveals y la spec de `content-visibility`, pero no se ha podido confirmar visualmente en un teléfono real desde esta sesión
- [ ] Configurar SMTP (WP Mail SMTP u otro) — en local `wp_mail()` no envía nada porque no hay sendmail/SMTP configurado; el formulario ya distingue ese caso (`'mail-error'`)
- [ ] Configurar Polylang de verdad: duplicar menús y páginas en EN, sustituir el placeholder estático "ES" de la cabecera por un selector real
- [ ] Confirmar con el cliente: año exacto de fundación (para poder poner una cifra de antigüedad definitiva en vez de "+20 años" genérico), CIF y denominación social exactos (`B-92065101` / "Fantastic Gardens A.J. S.L." vienen del paquete de Marco, no verificados de forma independiente)
- [ ] Validar con el cliente los datos técnicos de cultivo del catálogo de especies (`inc/especies.php`) — son un borrador redactado con criterios generales de jardinería mediterránea, se publican bajo la firma profesional de la empresa
- [ ] Catálogo real de "Proyectos realizados": ahora mismo solo hay 3 proyectos en el CPT; añadir más conforme el cliente aporte material
- [ ] Confirmar con el cliente la superficie y duración de obra de Villa Mediterránea (≈1.200 m² / 4 meses) y Jardín con Palmeras (≈950 m² / 3 meses) en `inc/proyectos-detalle.php` — son estimaciones del estudio, no dato real (ver "Ficha de proyecto individual ampliada", 2026-08-10)
- [ ] Conseguir una fotografía real de un jardín de cliente en Ronda: la ficha "Jardín en Ronda" del CPT usa en realidad una foto del interior del Garden Center/vivero (no un jardín instalado) — descubierto al redactar su ficha ampliada el 2026-08-10, ver detalle ahí. De momento su contenido se reescribió para no contradecir la foto (cifras del vivero, no de un proyecto de jardín)
- [ ] Decidir qué hacer con las imágenes huérfanas de `assets/img/` — el pendiente ya venía de antes (~30 MB) y ha crecido con esta migración (todas las imágenes de la v5 anterior — `hero-jardines-*` viejas, `sobre-historia.jpg`, `vivero-*.jpg`, `svc-*.jpg`, `page-*-2/3/4.jpg`, etc. — quedaron sin referenciar por ningún PHP)
- [ ] Optimizar/comprimir imágenes en uso (convertir a WebP, redimensionar) — sigue sin haber herramientas de optimización de imagen instaladas en este entorno
- [ ] Añadir campo meta `categoria` al CPT proyecto + filtro real en la galería de "Proyectos realizados" (los filtros de esa página son actualmente solo decorativos, no filtran)
- [ ] Plan de migración a producción (ver `docs/migracion.md`)
- [ ] Tests de rendimiento (Lighthouse) antes de go-live — la migración v5 debería mejorarlo bastante (JS sin dependencias en casi todo el sitio, GSAP solo en una página), pero no se ha medido
