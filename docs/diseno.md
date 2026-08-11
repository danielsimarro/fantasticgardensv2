# Sistema de diseño — Fantastic Gardens v2

> Estado: implementado en `assets/css/main.css`. Este doc refleja el estado real actual.

---

## Concepto visual

**Lujo mediterráneo editorial.** Inspirado en revistas de arquitectura y real estate premium
(Costa del Sol, Marbella). Sin page builder, sin plastilina digital — fotografía grande,
tipografía serif elegante, espacio en blanco generoso.

---

## Paleta de colores

### Tokens CSS (`:root`)

```css
/* Cremas y arenas */
--c-cream:        #F8F5F0   /* Fondo principal */
--c-cream-deep:   #F0EBE3
--c-sand:         #E8DFD0
--c-sand-dark:    #D4C8B4
--c-stone:        #C4B8A8
--c-travertine:   #B0A090

/* Bronce / dorado — lujo, decoración */
--c-bronze:       #9E8B6B
--c-bronze-dark:  #7A6850

/* Olivo / verde mediterráneo */
--c-olive:        #6B7355   /* poco usado directamente */
--c-verde:        #4D7048   /* jardín — CTAs, iconos de naturaleza */
--c-verde-dark:   #3B5737   /* hover del verde */

/* Oscuros */
--c-dark:         #1C1B19   /* textos, fondo overlay */
--c-dark-soft:    #2A2824
--c-text:         #3A3630
--c-muted:        #7A7068

/* Neutros */
--c-border:       #E0D9D0
--c-border-dark:  #C4B8A8
--c-white:        #FFFFFF
```

### Semántica del color

| Color | Rol |
|---|---|
| `--c-bronze` / `#B79A63` | Decoración — líneas hairline, eyebrows, separadores, dots, reglas |
| `--c-verde` | Acción + naturaleza — botones CTA, iconos botánicos, hovers de nav |
| `--c-dark` | Textos principales, fondo del overlay móvil |
| `--c-cream` / `#F8F6F2` | Fondos de sección, fondo base del tema |

**Regla fundamental:** bronce = lujo, verde = jardín/acción. Nunca mezclarlos en el mismo
elemento. El hover del CTA desktop usa borde bronce sobre fondo verde (combinación intencional).

---

## Tipografía

### Familias

```css
--font-head: 'Cormorant Garamond', Georgia, 'Times New Roman', serif;
--font-body: 'Inter', system-ui, -apple-system, sans-serif;
```

Cargadas desde Google Fonts:
```
Cormorant Garamond: ital,wght@0,300;0,400;0,600;1,300;1,400
Inter: wght@300;400;500
```

### Uso

| Rol | Familia | Peso | Notas |
|---|---|---|---|
| H1, H2 principales | Cormorant Garamond | 300–400 | `line-height: 1–1.1` |
| H2 editoriales en italic | Cormorant Garamond | 400 italic | `<em>` dentro del heading |
| Eyebrows / labels | Inter | 500 | uppercase, `letter-spacing: 0.2–0.35em` |
| Body / párrafos | Inter | 300–400 | `line-height: 1.7–1.9` |
| Métricas / números grandes | Cormorant Garamond | 300 | `font-size: 5–6rem` |

### Escala tipográfica

```css
--text-xs:   0.6875rem   /* ~11px — labels, eyebrows, tags */
--text-sm:   0.8125rem   /* ~13px — body secundario, notas */
--text-base: 1rem         /* 16px — body principal */
--text-lg:   1.125rem    /* ~18px */
--text-xl:   1.375rem    /* ~22px — subtítulos, nombres en tarjetas */
--text-2xl:  1.75rem     /* ~28px */
--text-3xl:  2.25rem     /* ~36px */
--text-4xl:  3rem         /* 48px */
--text-5xl:  4rem         /* 64px */
```

---

## Espaciado

Escala custom basada en unidades `rem`:

```css
--s-1:  0.25rem   --s-2:  0.5rem    --s-3:  0.75rem
--s-4:  1rem      --s-5:  1.25rem   --s-6:  1.5rem
--s-7:  1.75rem   --s-8:  2rem      --s-10: 2.5rem
--s-12: 3rem      --s-16: 4rem      --s-24: 6rem     --s-32: 8rem
```

---

## Breakpoints

```css
@media (min-width: 860px)  { /* tablet — grids 2 col en historia, etc. */ }
@media (min-width: 981px)  { /* desktop — nav visible, grids 3 col */ }

/* Algunos componentes usan sus propios breakpoints */
@media (max-width: 900px)  { /* galería proyectos → 2 col */ }
@media (max-width: 600px)  { /* móvil pequeño — ajustes de padding */ }
```

---

## Componentes — resumen

### Header / Nav

- `position: fixed; height: 72px; z-index: 200`
- Transparente sobre hero → sólido (cream + borde) al hacer scroll
- **CTA "Solicitar presupuesto"**: siempre verde sólido, hover con lift + glow verde + borde bronce
- **Mobile overlay**: fondo dark, `justify-content: flex-start`, wordmark bronce, items en serif grande

### Botones

| Clase | Descripción |
|---|---|
| `.btn--bronze` | Bronce sólido — usado en CTA final de homepage |
| `.hero__btn--primary` | Verde (`--c-verde`), icon WhatsApp |
| `.hero__btn--ghost` | Outline crema sobre fondo oscuro |
| `.nav-mobile-cta` | Verde ancho completo en overlay móvil |
| `.site-header__cta` | Verde con hover premium (lift + shadow + borde bronce) |

### Hero homepage

- `min-height: 100svh`, imagen de fondo con overlay oscuro semitransparente
- Card editorial blanca centrada: eyebrow → H1 → regla → descripción → CTAs → trust bar
- Trust bar: iconos verde + stats numéricos en serif
- Badges bar inferior: iconos verdes + etiquetas

### Sección Servicios (`.luxury-services`)

- Fondo: `#F8F6F2` con glows radiales en bronce muy suaves
- Grid: imagen izquierda (altura 640px) + lista de 3 servicios derecha
- Números decorativos grandes en bronce 18% opacidad
- Iconos de servicio en `--c-verde`

### Sección Historia (`.history-section`)

- Fondo: `#F8F6F2`
- Grid 2 col (45/55): imagen izquierda, contenido derecha
- SVG palmera decorativo en bronce
- Iconos de valores en `--c-verde`

### Galería Proyectos (`.pt-gallery`)

- Full-bleed: fuera del container, `width: 100%`, sin padding lateral
- `grid-template-columns: repeat(3, 1fr); gap: 1px; background: rgba(183,154,99,0.35)`
- Overlay **siempre visible** (no solo en hover): gradiente oscuro desde abajo
- Hover: imagen escala al 1.04, overlay ligeramente más intenso
- Mobile 900px: 2 columnas; 600px: 1 columna

### Testimonios (`.pt-testimonials`)

- Grid stacking: todos los slides en `grid-row: 1`, transición por `opacity`
- Auto-rotate cada 6000ms, pausa en hover, dots clicables
- Máx-width 900px, centrado

### CTA final (`.cta-section`)

- Fondo `--c-sand` con SVGs de palmera decorativos a los lados
- Botón `.btn--bronze` + enlace tel

---

## Animaciones

```css
--ease:      0.3s ease
--ease-fast: 0.18s ease
```

- **AOS (scroll)**: `IntersectionObserver` en JS, clase `aos-visible` con `opacity 0→1 + translateY`
- **Hover botones**: `transform: translateY(-2px)` + `box-shadow`
- **Hover CTA header**: lift + shadow verde + letra-spacing + borde bronce
- **Galería**: `transform: scale(1.04)` en imagen, 0.9s cubic-bezier
- **Nav dropdown**: `visibility/opacity/pointer-events`, `0.22s ease`

---

## Motivo decorativo recurrente

La **línea fina en bronce** (`height: 1px; background: #B79A63`) aparece en:
- Separador entre secciones de la nav desktop (dropdown border-top)
- `.pt-rule`, `.history-rule` — reglas bajo subtítulos
- `.ls-divider` — separador en servicios
- `.pt-dot.is-active` — dot activo de testimonios
- `.pt-gallery` gap entre cards
- `.history-value-sep`, `.ls-metric-sep` — separadores de métricas
- Mobile nav: separadores entre items (`rgba(183,154,99,0.14)`)

Este motivo de línea fina dorada es el hilo visual que da coherencia al sistema.
