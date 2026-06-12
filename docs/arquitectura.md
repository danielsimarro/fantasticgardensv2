# Arquitectura del tema

## Estructura de archivos

```
wp-content/themes/fg-theme/
├── style.css               # Solo cabecera del tema (no añadir CSS aquí)
├── functions.php           # Setup, enqueue, CPTs, limpieza de <head>
├── index.php               # Fallback requerido por WordPress
├── front-page.php          # Homepage (layout único)
├── page.php                # Template genérico (páginas legales, etc.)
├── archive.php             # Listado de novedades / blog
├── single.php              # Post individual de novedades
├── header.php              # <head> + nav sticky
├── footer.php              # Footer + wp_footer()
│
├── templates/              # Templates de página específicos
│   ├── page-servicios.php       # Hub de servicios (overview)
│   ├── page-servicio.php        # Detalle de servicio (reutilizable)
│   ├── page-proyectos.php       # Portfolio — galería de proyectos (CPT)
│   ├── page-antes-despues.php   # Comparador antes/después
│   ├── page-historia.php        # Sobre nosotros / Historia empresa
│   └── page-contacto.php        # Formulario de contacto + mapa
│
├── template-parts/         # Parciales reutilizables
│   ├── hero.php                 # Hero de portada (homepage)
│   ├── page-hero.php            # Hero interior (título + subtítulo)
│   ├── contact-strip.php        # Banda CTA con teléfono y WhatsApp
│   └── cta-band.php             # Banda genérica de llamada a la acción
│
└── assets/
    ├── css/
    │   └── main.css             # Todo el CSS del tema
    ├── js/
    │   └── main.js              # JS mínimo (nav mobile, interacciones)
    └── img/                     # Imágenes del tema (no del contenido)
```

---

## Mapa de templates por página

| Página (ES) | Página (EN) | Template | URL slug (ES) |
|---|---|---|---|
| Inicio | Home | `front-page.php` | `/` |
| Servicios | Our Services | `templates/page-servicios.php` | `/servicios-jardineria-paisajismo-mantenimiento-y-vivero/` |
| Diseño Paisajismo | Landscaping Design | `templates/page-servicio.php` | `/fantastic-gardens-paisajismo-diseno-jardines/` |
| Mantenimiento | Maintenance | `templates/page-servicio.php` | `/mantenimiento-a-casas-y-empresas-jardineria/` |
| Vivero propio | Own Plantation | `templates/page-servicio.php` | `/vivero-y-plantacion-propia/` |
| Proyectos | Projects Done | `templates/page-proyectos.php` | `/proyectos-realizados-jardineria-costa-del-sol-malaga/` |
| Antes y después | Before & After | `templates/page-antes-despues.php` | `/proyectos-antes-y-despues-diseno-de-jardines-paisajismo/` |
| Historia | Our History | `templates/page-historia.php` | `/historia/` |
| Contacto | Contact | `templates/page-contacto.php` | `/contacto-empresa-jardineria/` |
| Novedades | — | `archive.php` | `/novedades/` |
| Legales | — | `page.php` | varios |

> **Importante:** los slugs deben ser idénticos a los de producción actual para no perder posicionamiento SEO.

---

## Custom Post Types

### `proyecto`
Gestiona el portfolio de trabajos realizados. Sustituye a la página estática de "Proyectos realizados".

| Campo | Tipo | Notas |
|---|---|---|
| Título | `post_title` | Nombre del proyecto |
| Imagen destacada | `thumbnail` | Foto principal |
| Descripción | `excerpt` | Resumen corto para listados |
| Categoría | taxonomía (pendiente) | Tipo: diseño, mantenimiento, etc. |

**Slug de archivo:** `/proyectos/`
**Template de listado:** `templates/page-proyectos.php`
**Template individual:** `single-proyecto.php` (pendiente de crear)

---

## Menús registrados

| Location | Uso |
|---|---|
| `primary-menu` | Navegación principal del header |
| `footer-menu` | Links del footer |

Polylang duplica automáticamente las locations por idioma (`primary-menu`, `primary-menu___en`).

---

## Decisiones de arquitectura

- **Sin page builder**: el HTML lo generan los templates PHP directamente. Más rendimiento, más control.
- **Un template por tipo de layout**, no por página: `page-servicio.php` sirve a los 3 servicios.
- **Novedades como blog nativo**: usa el sistema de posts de WordPress en lugar de una página estática Divi.
- **Proyectos como CPT**: permite añadir proyectos nuevos sin tocar código, y cada uno indexa en Google de forma independiente.
