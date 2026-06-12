# Sistema de diseño

> **Estado:** definido e implementado en `assets/css/main.css`.

---

## Tokens

### Colores

```css
:root {
  --color-primary:       #2d5a27;   /* verde principal — navbar, botones, fondos hero interior */
  --color-primary-light: #3d7a35;   /* hover del primario */
  --color-accent:        #7ab648;   /* verde brillante — CTAs secundarios, números stats, comillas */
  --color-dark:          #1a1a1a;   /* textos oscuros, headings */
  --color-text:          #333333;   /* texto base */
  --color-text-muted:    #666666;   /* texto secundario, subtítulos */
  --color-bg:            #ffffff;   /* fondo principal */
  --color-bg-soft:       #f5f7f2;   /* fondo alternativo suave (secciones alternas) */
  --color-border:        #e0e6d8;   /* bordes y separadores */
}
```

### Tipografía

| Uso | Familia | Pesos |
|---|---|---|
| Headings | Poppins | 600, 700 |
| Body | Inter | 400, 500 |

### Escala tipográfica

| Token | Valor |
|---|---|
| `--text-xs` | 0.75rem |
| `--text-sm` | 0.875rem |
| `--text-base` | 1rem |
| `--text-lg` | 1.125rem |
| `--text-xl` | 1.25rem |
| `--text-2xl` | 1.5rem |
| `--text-3xl` | 1.875rem |
| `--text-4xl` | 2.25rem |
| `--text-5xl` | 3rem |

### Espaciado (escala 4px)

`--space-1` (4px) → `--space-2` → `--space-3` → `--space-4` → `--space-6` → `--space-8` → `--space-10` → `--space-12` → `--space-16` → `--space-20` → `--space-24`

### Bordes y sombras

| Token | Valor |
|---|---|
| `--radius-sm` | 4px |
| `--radius-md` | 8px |
| `--radius-lg` | 16px |
| `--radius-full` | 9999px |
| `--shadow-sm` | 0 1px 3px rgba(0,0,0,.08) |
| `--shadow-md` | 0 4px 12px rgba(0,0,0,.10) |
| `--shadow-lg` | 0 8px 24px rgba(0,0,0,.12) |

---

## Componentes implementados

### Header
- Sticky, backdrop-filter: blur(8px), altura 72px
- Logo + nav desktop + CTA "Solicitar presupuesto" + hamburger mobile
- Nav mobile: overlay full-screen al pulsar hamburger (`.is-open`)

### Botones

| Clase | Uso |
|---|---|
| `.btn--primary` | CTA principal (verde oscuro) |
| `.btn--accent` | CTA de contraste (verde brillante) — WhatsApp, destacados |
| `.btn--outline` | Secundario (borde verde, fondo transparente) |
| `.btn--outline-white` | Sobre fondos oscuros (hero, contact-strip) |
| `.btn--lg` | Tamaño grande para heroes y CTAs prominentes |

### Hero (homepage)
- `min-height: 85svh`, imagen de fondo con `opacity: 0.55`
- Label (píldora verde acento) + H1 clamp(2rem→3.5rem) + subtítulo + 2 CTAs
- Botón primario: "Solicitar presupuesto" → `/contacto-empresa-jardineria/`
- Botón secundario: "Ver proyectos" → `/proyectos-realizados-jardineria-costa-del-sol-malaga/`

### Page Hero (páginas interiores)
- Fondo `--color-primary`, texto blanco, centrado
- Título: `the_title()` + subtítulo: `get_the_excerpt()`

### Contact Strip
- Fondo `--color-primary`
- Tel: **691 142 679** (`tel:+34691142679`)
- WhatsApp: **691 142 679** (`https://wa.me/34691142679`)

### CTA Band (genérico)
- Fondo `--color-bg-soft`
- Acepta `$args`: title, text, link, label
- Botón primario + teléfono secundario

### Service Cards
- Grid: 1 col (mobile) → 2 cols (tablet) → 3 cols (desktop)
- Imagen 16:9 + body con h3, descripción, link "Ver servicio →"
- Hover: elevación + escala de imagen

### Stats Band
- Fondo `--color-primary`, texto blanco, números en `--color-accent`
- 4 stats: **+40 años** · **+40 ha vivero** · **17.000 especies** · **Costa del Sol**

### Projects Grid
- Grid: 1→2→3 cols
- Aspect ratio 4:3, overlay en hover con título

### Testimonials Grid
- Grid: 1→2 cols
- Comilla decorativa, texto en itálica, cite + fuente

### Footer
- Grid: 1→2→4 cols
- Teléfonos: 691 142 679 / 952 78 44 29
- Email: info@fantasticgardens.net
- Dirección: San Pedro de Alcántara, Marbella

---

## Estructura de secciones — Homepage

| Orden | Sección | Componente |
|---|---|---|
| 1 | Hero | `template-parts/hero.php` |
| 2 | Nuestros servicios | Inline en `front-page.php` |
| 3 | Stats / credenciales | Inline en `front-page.php` |
| 4 | Proyectos recientes | Query CPT `proyecto` |
| 5 | Testimonios | Inline en `front-page.php` |
| 6 | Contact strip | `template-parts/contact-strip.php` |

---

## Breakpoints

| Nombre | Ancho | Notas |
|---|---|---|
| Mobile | `< 768px` | Diseño base — mobile-first |
| Tablet | `768px – 980px` | 2 columnas en grids |
| Desktop | `≥ 981px` | 3-4 columnas, nav visible |

---

## Principios visuales

- Mobile-first en todo — sin breakpoints `max-width`
- Alta conversión: teléfono siempre visible, CTAs claros, formulario accesible
- Sin hover-only interactions en mobile
- Dos acciones CTA en hero siempre: contacto + ver trabajo
- Diferenciador clave a reflejar: **diseño en 3D antes de ejecutar**
- Testimonios reales de MundoJardineria en homepage

---

## Datos de contacto oficiales

| | |
|---|---|
| Móvil / WhatsApp | 691 142 679 |
| Tel. San Pedro | 952 78 44 29 |
| Tel. Ronda | 952 00 68 41 |
| Email | info@fantasticgardens.net |
| Oficinas | Pol. Industrial San Pedro de Alcántara, Marbella |
| Vivero | Ctra. Ronda – Setenil, Ronda (Garden Center 4.000 m²) |
