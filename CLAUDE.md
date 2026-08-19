# CLAUDE.md — Fantastic Gardens v2

Documento de contexto para Claude Code. Mantenerlo actualizado es prioritario — pero **solo con estado actual y decisiones que siguen vigentes**: el historial de cambios (qué se hizo, cuándo y por qué) vive en `git log`, no aquí.

---

## El proyecto en una frase

Rediseño premium de **Fantastic Gardens** (empresa de jardinería y paisajismo de lujo, Marbella · Costa del Sol). Sustituirá a la web de producción actual. Enfoque editorial/luxury — sin page builders, todo PHP + CSS custom.

**Origen del sistema de componentes actual:** adaptado de una plantilla de referencia aportada por el cliente ("v5", entregada como tema WordPress completo pensado para instalarse desde cero), portando su sistema visual y de componentes sobre la arquitectura de datos y URLs ya validada de v2 (CPT `proyecto`, slugs SEO, 3 teléfonos reales, Polylang, navegación editable desde wp-admin). Ver Gotchas técnicos para las decisiones concretas que no hay que deshacer.

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

Fotos de proyectos reales del cliente ya extraídas a v2 (`uploads/2020/07/` → CPT `proyecto`): `Fantastic-Gardens-Proyectos.jpg` → `proyecto-1.jpg` (Villa Mediterránea · Marbella), `Fantastic-Gardens-Proyectos-5.jpg` → `proyecto-2.jpg` (Jardín con Palmeras · Benahavís), `GARDEN-RONDA.jpg` → `proyecto-3.jpg` (Jardín en Ronda — en realidad el interior del Garden Center, no un jardín instalado, ver Pendientes).

### v2 — Este proyecto (desarrollo activo)

| | |
|---|---|
| **Ruta local** | `/home/daniel/proyectos/fantasticgardensv2` |
| **URL local** | `http://fantasticgardensv2.test` |
| **Admin WP** | `http://fantasticgardensv2.test/wp-admin` · user: `danielsimarro` |
| **BD MySQL** | `fg_nuevo` · user: `danielsimarro` · pass: `danielsimarro` |
| **Tema** | `wp-content/themes/fg-theme/` |
| **Git** | Rama única `main`, remoto `github.com/danielsimarro/fantasticgardensv2` |

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| CMS | WordPress 7.0 |
| PHP | 8.1 (entorno local corre con `php8.0` vía WP-CLI, ver Comandos) |
| Servidor local | Apache + mod_rewrite |
| CSS | Vanilla CSS con custom properties — todo en `assets/css/main.css` |
| JS | Vanilla JS (`assets/js/main.js`), sin dependencias en casi todo el sitio. GSAP + ScrollTrigger + Splitting vendorizados en `assets/js/vendor/`, cargados **solo** en la página de Vivero (`assets/js/vivero.js`) |
| Fuentes | Google Fonts: **Cormorant Garamond** (títulos) + **Jost** (texto y rótulos) |
| Plugins | Polylang, Yoast SEO, Contact Form 7, WP-Optimize, Advanced Custom Fields (ACF) |
| Multilingüe | Polylang instalado, sin configurar — el selector "ES" de la cabecera es un placeholder estático |
| SEO técnico | Yoast SEO activo (controla title/meta/OG reales) + Schema.org LocalBusiness JSON-LD propio del tema — ver sección SEO |
| Ajustes del tema | Apariencia → **FG Ajustes** (`inc/admin-settings.php`): marca, teléfonos, direcciones, email, CIF, horario, redes, geo — leídos con `fg_opt()` |
| Tests automatizados | No hay — validar manualmente en navegador (ver Reglas de trabajo) |

---

## Comandos

### WP-CLI

El binario vive en `/usr/local/bin/wp`. **En zsh, `WP="wp --path=..."; $WP comando` no funciona** (zsh no separa palabras de una variable sin comillas) — escribe el comando completo cada vez.

```bash
# Listar páginas / proyectos
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
wp --path=/home/daniel/proyectos/fantasticgardensv2 rewrite flush

# Ver ubicación de un menú (confirmar que primary-menu sigue asignado)
wp --path=/home/daniel/proyectos/fantasticgardensv2 menu list
```

### Verificación rápida sin curl

Este entorno no tiene `curl` ni siempre `tail`/`rm` disponibles en pipes encadenados, y `status` es variable reservada en zsh (no usarla como nombre). Tampoco hay `identify`/`convert`/`cwebp`/`jpegoptim` (ImageMagick) — para redimensionar/comprimir imágenes usar **Pillow (Python)**.

```bash
wget -O /dev/null "http://fantasticgardensv2.test/slug-de-la-pagina/"   # imprime "200 OK" / error en stderr
file /ruta/a/imagen.jpg                                                 # dimensiones/formato básico (sin ImageMagick)
```

---

## Reglas de trabajo

- Modificar **solo** archivos dentro de `wp-content/themes/fg-theme/` (más `docs/`, `CLAUDE.md` cuando aplique)
- CSS → `assets/css/main.css` únicamente. Nunca en `style.css`
- JS externo permitido de forma acotada: GSAP + ScrollTrigger + Splitting, vendorizados en `assets/js/vendor/` (sin CDN), y **solo cargados en las páginas que realmente los necesitan** (Vivero) — no añadir más dependencias JS sin acordarlo antes. Google Fonts sigue siendo la única dependencia CSS externa
- ACF está instalado y activo — úsalo solo para medios opcionales (vídeo/póster/imagen móvil del hero); el tema debe seguir funcionando si se desactiva (fallback a assets del tema)
- No tocar WordPress core ni plugins salvo instalación/activación acordada explícitamente
- **Mobile-first, pero responsive de verdad**: todo diseño/feature nuevo se piensa primero para móvil, pero el resultado final tiene que verse bien en **todos** los dispositivos. Arrancar por la maqueta/comportamiento en móvil y comprobar después que escala hacia arriba con `min-width`. **Limitación de entorno conocida**: las herramientas de navegador de esta sesión no emulan de forma fiable un viewport estrecho (el redimensionado de ventana no afecta al layout renderizado) — la validación visual real en móvil sigue pendiente de un dispositivo que sí lo permita
- Todo CSS debe ser language-agnostic (Polylang gestiona ES/EN)
- Cambios incrementales y reversibles. Crear commits de git con mensajes descriptivos agrupados por tema (no un único commit gigante) — ver `git log` para el criterio ya seguido

---

## Sistema de diseño

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

**Regla de uso de color:** `--verde` es el único acento de marca. `--lima` es un acento claro reservado a fondos oscuros (títulos, `em-lima`). Nunca negro puro (`#000`) — siempre `--ink`.

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

Mobile-first (`min-width`), sin variables `--bp-*` dedicadas; rango real de `@media` entre 560px y 1100px. Header/nav conmuta a escritorio en **981px**.

### El gesto de marca: el "kicker" numerado

Cada bloque de página se abre con un rótulo `01 ──── EL ESTUDIO` (número de orden + filete + epígrafe en versalitas), generado por `fg_kicker()` / `fg_section_heading(['num' => ...])`. Es el hilo conductor que ordena la lectura de todo el sitio.

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
│   ├── components.php      ← Librería de componentes reutilizables (kickers, before/after, stats band,
│   │                          service rows, testimonial rail, zones marquee, timeline, ficha de proyecto...)
│   ├── especies.php        ← Datos del catálogo de especies (familias + fichas) — "Descubrir especies"
│   ├── admin-settings.php  ← Página Apariencia → FG Ajustes
│   ├── legal-content.php   ← fg_render_legal() + textos legales por defecto
│   └── proyectos-detalle.php ← Fichas ampliadas del CPT proyecto (resumen, reto/solución, cifras, galería)
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
│   ├── page-servicio-soluciones-integrales.php ← Nueva (ago. 2026, mejoras Maria), sin fotos reales aún
│   ├── page-servicio-desbroce-limpieza.php     ← Nueva (ago. 2026, mejoras Maria), sin fotos reales aún
│   ├── page-servicio-vivero.php        ← Vivero + Plantación propia + Nuestra plantación, FUSIONADAS
│   ├── page-catalogo-especies.php      ← Catálogo interactivo "Descubrir especies"
│   ├── page-proyectos.php              ← "Proyectos realizados"
│   ├── page-antes-despues.php
│   ├── page-historia.php
│   ├── page-contacto.php
│   ├── page-aviso-legal.php    ← usa fg_render_legal('aviso-legal', …)
│   ├── page-cookies.php        ← usa fg_render_legal('cookies', …)
│   └── page-privacidad.php     ← usa fg_render_legal('privacidad', …)
│
└── assets/
    ├── css/main.css        ← TODO el CSS del tema, sistema de diseño v5
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

`header.php` añade además `fg_get_primary_nav()` / `fg_default_nav()`: la navegación se lee del menú real asignado a la ubicación `primary-menu` (Apariencia → Menús), reconstruido como árbol `label/url/children`; solo cae al array hardcodeado de `fg_default_nav()` si no hay ningún menú asignado (decisión explícita para mantener la cabecera editable desde wp-admin, ver Gotchas).

---

## Inventario de imágenes (`assets/img/`)

Los iconos (`icons/servicios/*.svg`, `icons/botanica/*.svg`) llevan el verde ya fijado en el propio SVG, no son `currentColor`. Piezas principales por uso:

| Archivo(s) | Uso |
|---|---|
| `proyecto-1/2/3.jpg` | Fotos reales del CPT `proyecto` (ver v1 arriba) — no tocar sin motivo |
| `hero-indice.mp4` / `hero-indice-poster.jpg` | Vídeo/póster del hero de portada |
| `hero-jardines-permanecen.jpg` / `-movil.jpg` | Banda de cita a sangre del home; el `-movil` también sirve de fallback de `hero_mobile` |
| `hero-nuestra-historia.jpg`, `hero-servicios.jpg`, `hero-diseno-paisajes.jpg`, `hero-mantenimiento.jpg`, `hero-vivero.jpg`, `hero-contacto.jpg` | Heroes de páginas |
| `calendario-ritmo-del-jardin.jpg` | Sección "Cómo trabajamos" de Mantenimiento |
| `maquinaria-camion-*.png`, `maquinaria-tractor.png` | Fotos reales de flota, sección "Personal y maquinaria" |
| `plantacion-1/2/3/4.jpg`, `plantacion-interior-invernadero.jpg`, `plantacion-pabellon.jpg` | Galería horizontal fijada y secciones de Plantación propia (página Vivero) |
| `diseno-plano-1/2.jpg`, `diseno-render-1/2.jpg` | Comparador antes/después (plano↔render 3D) de Diseño de paisajismo |
| `page-antes.jpg`/`page-despues.jpg`, `transformacion-jardin-antes-despues-piscina-marbella.jpg` (hero, fotomontaje), `reforma-jardin-piscina-marbella-antes/despues.jpg` | Las 3 parejas/piezas reales de Antes y Después — no tocar sin motivo |
| `villa-mediterranea-marbella-piscina-pergola-jardin.jpg`, `detalle-hoja-palmera-mediterranea-jardin.jpg`, `vivero-ronda-campos-cultivo-fantastic-gardens-aereo.jpg` | Fotos reales adicionales de v1, usadas en las fichas ampliadas de proyecto |
| `equipo-fantastic-gardens-vivero-ronda.jpg` | Foto real del equipo en el vivero de Ronda, en "Nuestros orígenes" (Historia) — sustituye al placeholder de stock; no identifica a los fundadores concretos, ver Pendientes |
| `escudo-ronda.png`, `page-contacto-hero.jpg` | Piezas reales ya validadas, sin cambios |
| `especies/*.jpg` (20 archivos) | **Única excepción a la convención plana** — catálogo "Descubrir especies", backed por `inc/especies.php` |
| `hojita.svg`, `wordmark-olivo.svg`, `arrow-right.svg`, `chevron-down.svg` | Iconografía/motivos de marca |

**Limpieza pendiente:** hay imágenes huérfanas de versiones anteriores del tema (`hero-jardines-*` viejas, `sobre-historia.jpg`, `vivero-*.jpg`, `svc-*.jpg`, `page-*-2/3/4.jpg`, `page-antes-despues-hero.jpg`, `page-antes-despues-2.jpg`, etc.) sin referenciar por ningún PHP — ver Pendientes.

---

## Páginas WordPress (publicadas)

| ID | Título | Slug | Template |
|---|---|---|---|
| — | Inicio | `/` (sin página estática asignada; `front-page.php` se sirve igualmente por prioridad de WP) | `front-page.php` |
| 5 | Servicios | `/servicios-jardineria-paisajismo-mantenimiento-y-vivero/` | `templates/page-servicios.php` |
| 6 | Diseño Paisajismo | `/fantastic-gardens-paisajismo-diseno-jardines/` | `templates/page-servicio-diseno.php` |
| 7 | Mantenimiento | `/mantenimiento-a-casas-y-empresas-jardineria/` | `templates/page-servicio-mantenimiento.php` |
| 33 | Soluciones integrales | `/soluciones-integrales-jardineria-marbella/` | `templates/page-servicio-soluciones-integrales.php` |
| 34 | Desbroce y limpieza de parcelas | `/desbroce-y-limpieza-de-parcelas-marbella/` | `templates/page-servicio-desbroce-limpieza.php` |
| 8 | Vivero y Plantación propia | `/vivero-y-plantacion-propia/` | `templates/page-servicio-vivero.php` |
| 31 | Descubrir especies | `/catalogo-especies-plantas-vivero-marbella/` | `templates/page-catalogo-especies.php` |
| 9 | Proyectos realizados | `/proyectos-realizados-jardineria-costa-del-sol-malaga/` | `templates/page-proyectos.php` |
| 10 | Proyectos antes/después | `/proyectos-antes-y-despues-diseno-de-jardines-paisajismo/` | `templates/page-antes-despues.php` |
| 11 | Historia | `/historia/` | `templates/page-historia.php` |
| 12 | Contacto | `/contacto-empresa-jardineria/` | `templates/page-contacto.php` |
| 29 | Aviso Legal | `/aviso-legal/` | `templates/page-aviso-legal.php` |
| 30 | Política de Cookies | `/politica-de-cookies/` | `templates/page-cookies.php` |
| 3 | Política de Privacidad | `/politica-de-privacidad/` | `templates/page-privacidad.php` |

> Los slugs son idénticos a producción para preservar SEO — excepciones: `catalogo-especies-plantas-vivero-marbella`, `soluciones-integrales-jardineria-marbella` y `desbroce-y-limpieza-de-parcelas-marbella`, páginas nuevas sin equivalente previo. Ver `fg_page_slugs()` en `functions.php` para el mapa clave→slug completo.

## CPT: `proyecto`

| ID | Título | Ubicación | menu_order |
|---|---|---|---|
| 24 | Villa Mediterránea · Marbella | Marbella · Costa del Sol | 1 |
| 25 | Jardín con Palmeras · Benahavís | Benahavís · Málaga | 2 |
| 26 | Jardín en Ronda | Ronda · Málaga | 3 |

Meta field `ubicacion` (texto libre, registrado con `register_post_meta()` para REST). `supports` incluye `page-attributes` (para que el campo Orden sea visible en el admin). Cada proyecto tiene además una ficha ampliada en `inc/proyectos-detalle.php` (resumen, reto/solución, cifras, chips de servicio, galería) — ver Pendientes para qué datos son reales y cuáles son estimaciones del estudio.

---

## Homepage — secciones (`front-page.php`)

Encadena, en este orden: **Hero** (vídeo ACF con fallback) → **01 El estudio** (quiénes somos + públicos) → **Banda de cita** (`fg_quote_band()`, parallax) → **02 Servicios** (`fg_service_rows()`, 4 filas numeradas) → **03 Calidad y garantía** (bloque oscuro, sello de Ronda) → **04 Proyectos** (3 fichas reales del CPT + `fg_before_after()`) → **05 Botánica** (vivero + CTA a Descubrir especies) → **06 Clientes** (`fg_testimonial_rail()`, reseñas reales de MundoJardinería) → **Zonas** (`fg_zones_marquee()`) → **Contacto** (`fg_contact_band()`).

## Header y navegación

- Barra de progreso de lectura (`.scroll-progress`), rellenada por scroll en `main.js`.
- Cabecera flotante transparente sobre hero fotográfico (`fg_has_over_header()` → `.site-header--over`), se asienta en crema al bajar (`.is-solid`).
- Navegación de escritorio con dropdowns, alimentada por `fg_get_primary_nav()` (menú real de wp-admin).
- Selector de idioma: placeholder estático "ES" (Polylang pendiente de configurar).
- Overlay móvil fullscreen en verde oscuro, con wordmark, nav completa y pie con ubicaciones.
- Footer: 4 columnas sobre `--verde-noche` (marca + NAP completo, Servicios, Estudio, Contacto+redes) + barra legal de cierre.

## JS implementado

| Archivo | Cuándo se carga | Módulos |
|---|---|---|
| `assets/js/main.js` | Siempre, sin dependencias | Barra de progreso + solidez de cabecera · menú móvil fullscreen · comparador arrastrable (`compareSliders`) · lightbox nativo (`<dialog>`) · contadores animados · marquesina · carrusel de reseñas (`rail`) · reveals (`data-reveal`/`data-img-reveal`) · línea de tiempo (`lineaTiempo()`) · magnetismo en CTAs (solo puntero fino) |
| `assets/js/vivero.js` | Solo Vivero (GSAP + ScrollTrigger + Splitting) | Título por letras · partículas de hojas (canvas propio) · galería horizontal fijada (pin+scrub) |
| `assets/js/especies.js` | Solo Descubrir especies (dep. `fg-main`) | Filtros por familia · `<details>` elevado a modal `<dialog>` · bandeja de selección con `localStorage` |

Todo respeta `prefers-reduced-motion`. Si el JS no llega a ejecutarse, nada queda oculto (las clases que esconden lo animable las añade el propio script). **No hay Lenis** (smooth-scroll) — se retiró en la migración v5; el scroll es nativo en todo el sitio.

---

## SEO técnico

⚠️ **Yoast SEO está activo** → controla title/meta description/OG reales de cada página (Apariencia en buscadores en wp-admin, o `wp option patch update wpseo_titles <clave> "<valor>"`) — el bloque `fg_seo_head()` de `functions.php` es solo fallback para si Yoast se desactiva. El JSON-LD `LocalBusiness` (dos ubicaciones: San Pedro + Ronda, con `review[]` reales y `aggregateRating` hardcodeado por decisión de negocio preexistente) del tema sí se emite siempre, en paralelo al schema de Yoast — no hay conflicto, Google combina ambos `<script type="application/ld+json">`.

---

## Datos de la empresa (usar en contenido)

| | |
|---|---|
| Móvil / WhatsApp | **691 142 679** |
| Tel. San Pedro | 952 78 44 29 |
| Tel. Ronda | 952 00 68 41 |
| Email | info@fantasticgardens.net |
| Oficinas | San Pedro de Alcántara, Marbella — Pol. Industrial San Pedro, El Potril parcela nº 6 |
| Vivero / Garden Center | 796 Partida, Ctra. Ronda-Setenil, 29394 La Cimada, Málaga · 40 ha · +17.000 especies · 4.000 m² cubiertos |
| Horario San Pedro (oficinas) | Lu–Vi 8:00–16:00 · cerrado sáb. y dom. |
| Horario Ronda (vivero) | Lu–Vi 7:00–15:00 · Sáb. 9:00–14:00 · cerrado dom. |
| Antigüedad | "+30 años" (unificado en todo el sitio, actualizado ago. 2026 desde "+20 años" — mejoras propuestas por Maria) — año exacto de fundación **pendiente de confirmar por el cliente** |
| Proyectos | +1.000 |
| CIF | B-92065101 (**pendiente de confirmar por el cliente**) |
| Denominación social | Fantastic Gardens A.J. S.L. (**pendiente de confirmar**) |

---

## Gotchas técnicos

- **CSS Grid + `order` no es seguro para alternar posiciones si las columnas tienen tamaños distintos** (p. ej. pista angosta + `1fr`): invertir `order` también invierte qué pista de la grid ocupa cada hijo. Usar `grid-template-areas` con una plantilla por variante.
- **`grid-template-areas` debe declararse en TODOS los breakpoints donde el hijo participe en el grid**: un `grid-area: <nombre>` sin ese nombre definido en el `grid-template-areas` activo crea líneas implícitas y descuadra el grid (se manifiesta solo en el breakpoint sin la declaración).
- **Especificidad de modificadores CSS**: un modificador de una sola clase (`.ba-list--pair`) puede perder la cascada frente a la clase base (`.ba-list`) si esta se define más abajo en el archivo. Cualificarlo junto a la base (`.ba-list.ba-list--pair`).
- **No reintroducir `content-visibility: auto` en secciones**: rompe el sistema de reveals de scroll. `reveals()` en `main.js` mide `getBoundingClientRect()` a propósito (no `IntersectionObserver`, porque elementos ocultos con `clip-path`/`scaleY(0)` tienen intersección vacía); con `content-visibility: auto` un elemento "no relevante" devuelve un rect vacío que el chequeo interpreta como "ya visible".
- **Enlaces de WhatsApp**: usar siempre `https://wa.me/<número sin "+">` (`str_replace('+', '', fg_opt('phone_href'))`), nunca `tel:` aunque el texto diga "WhatsApp".
- **No reintroducir un array de navegación hardcodeado**: `fg_get_primary_nav()` lee el menú real de wp-admin (ubicación `primary-menu`) — ya se descartó dos veces la alternativa hardcodeada.
- **No usar `fg_split_hero()` fuera del `<h1>` real de la página** (duplica el heading) — para secciones partidas foto/formulario que no sean el hero, usar `.form-split` u otro marcado propio.
- Mapas de Ronda usan `https://www.google.com/maps?q=<dirección>&output=embed` (se regeneran solos si cambia `fg_opt('address2')`); los de San Pedro siguen con un embed `pb=` fijo — no unificar sin necesidad.
- No hay ImageMagick/cwebp/jpegoptim en este entorno — usar Pillow (Python) para redimensionar/comprimir imágenes.
- **Vivero, Plantación propia y Nuestra plantación son deliberadamente una sola página** (`/vivero-y-plantacion-propia/`), no tres separadas — decisión explícita para no perder la URL SEO ya indexada. No volver a dividirla sin acordarlo.
- **El CPT `proyecto` es la fuente de datos real de Proyectos** (con fallback estático solo si la query no devuelve nada) — no sustituirlo por arrays hardcodeados de contenido de relleno.

---

## Pendiente / próximos pasos

- [x] Placeholder de stock sustituido por una foto real del equipo (`equipo-fantastic-gardens-vivero-ronda.jpg`) en "Nuestros orígenes" de Historia — pendiente aún una foto específica de los fundadores si el cliente la aporta
- [ ] Validar visualmente en viewport móvil real (ver limitación de entorno en Reglas de trabajo), incluyendo que los reveals de scroll animan correctamente tras quitar `content-visibility`
- [ ] Configurar SMTP (WP Mail SMTP u otro) — en local `wp_mail()` no envía nada; el formulario ya distingue ese caso (`'mail-error'`)
- [ ] Configurar Polylang de verdad: duplicar menús y páginas en EN, sustituir el placeholder estático "ES" por un selector real
- [ ] Confirmar con el cliente: año exacto de fundación, CIF y denominación social exactos (`B-92065101` / "Fantastic Gardens A.J. S.L." vienen de la plantilla de referencia, no verificados de forma independiente)
- [ ] Validar con el cliente los datos técnicos de cultivo del catálogo de especies (`inc/especies.php`) — borrador redactado con criterios generales de jardinería mediterránea
- [ ] Catálogo real de "Proyectos realizados": solo hay 3 proyectos en el CPT; añadir más conforme el cliente aporte material
- [ ] Confirmar con el cliente la superficie y duración de obra de Villa Mediterránea (≈1.200 m² / 4 meses) y Jardín con Palmeras (≈950 m² / 3 meses) en `inc/proyectos-detalle.php` — estimaciones del estudio, no dato real
- [ ] Conseguir una fotografía real de un jardín de cliente en Ronda: la ficha "Jardín en Ronda" del CPT usa en realidad una foto del interior del Garden Center/vivero (no un jardín instalado)
- [ ] Decidir qué hacer con las imágenes huérfanas de `assets/img/` (~30 MB+, ver Inventario de imágenes)
- [ ] Optimizar/comprimir imágenes en uso (convertir a WebP, redimensionar) — sin herramientas de optimización instaladas en este entorno
- [ ] Añadir campo meta `categoria` al CPT proyecto + filtro real en la galería de "Proyectos realizados" (los filtros actuales son solo decorativos)
- [ ] Plan de migración a producción (ver `docs/migracion.md`)
- [ ] Tests de rendimiento (Lighthouse) antes de go-live — no medido aún
- [ ] `docs/diseno.md` y `docs/arquitectura.md` están desactualizados (reflejan el sistema previo a la migración v5) — revisar o retirar para que no contradigan este documento

### Mejoras propuestas por Maria (docx recibido ago. 2026) — pendientes de fotos reales

- [ ] Nuevo proyecto destacado "Villa Tortuga" para el CPT `proyecto` — Ericka mandará infografía/planos; las fotos están en Drive (referencia interna del cliente para localizarlas: "Magestic, 86" — **no publicar ese dato**, es solo para encontrar el material)
- [ ] Foto real para la sección "01 El estudio" del home (`template-parts/home/estudio.php`), sustituyendo la actual de stock
- [ ] Foto real para la fila "Diseño y paisajismo" del home y de `templates/page-servicio-diseno.php` (el texto de la fila del home ya está actualizado)
- [ ] Retocar/sustituir la foto de "Mantenimiento" (fila del home y página propia): tono más mediterráneo, más vegetación, valorar incluir una persona trabajando
- [ ] Confirmar y sustituir la foto de la fila "Vivero y garden center" del home (`card-vivero-min.jpg`) — Maria aportó una foto real de referencia, pero no está claro si es para esta fila o para "El estudio"; revisar con ella antes de aplicarla
- [ ] Fotos reales para "Coníferas" y "Palmáceas" en `templates/page-servicio-vivero.php` (sección "Más de 40 hectáreas...") — Maria adjuntó capturas de referencia en baja resolución (no aptas para producción), pendiente de los archivos originales
- [x] Banda de cifras del home: "+30 años de experiencia" y "40 hectáreas de plantación propia" (`template-parts/home/hero.php`) — aplicado, y unificado en el resto del sitio (antes "+20 años")
- [x] Tarjeta "Mediterráneo" eliminada de la galería "Especies que cobran vida" (`templates/page-servicio-vivero.php`)
- [x] Nuevas páginas de servicio "Soluciones integrales" y "Desbroce y limpieza de parcelas" creadas y enlazadas en el menú — contenido genérico de partida (sin fotos ni copy definitivo del cliente), revisar antes de darlas por definitivas. El nombre "parcelas" (en vez de "terreno") se eligió por ser el término más buscado en el sector (ver competidores en Málaga/Costa del Sol)
