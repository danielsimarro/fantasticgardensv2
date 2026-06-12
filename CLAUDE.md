# CLAUDE.md — Fantastic Gardens v2

Guía de contexto para Claude Code en este proyecto.
Documentación detallada en [`docs/`](./docs/).

---

## Qué es este proyecto

Rediseño completo de **Fantastic Gardens** (empresa de jardinería y paisajismo en Marbella).
Sustituirá a la web de producción actual (`fantasticgardens.net`), que está en WordPress con Divi (2013).

**Objetivo:** mayor conversión, mejor SEO, mejor rendimiento — sin gestores de página (Divi/Elementor).
**Enfoque:** tema WordPress 100% custom en PHP + CSS vanilla.

---

## Stack

| Capa | Tecnología |
|---|---|
| CMS | WordPress 7.0 |
| PHP | 8.1 |
| Servidor local | Apache + mod_rewrite |
| Base de datos | MySQL — `fg_nuevo` |
| Tema | `fg-theme` (custom, sin page builder) |
| CSS | Vanilla CSS con custom properties |
| JS | Vanilla JS mínimo |
| Plugins | Polylang, Yoast SEO, Contact Form 7, WP-Optimize |
| Multilingüe | Polylang (ES / EN) |

**URL local:** `http://fantasticgardensv2.test`
**Admin:** `http://fantasticgardensv2.test/wp-admin` — user: `danielsimarro`

---

## Comandos frecuentes

```bash
# Siempre usar --path y --skip-themes para evitar conflictos
wp post list --post_type=page --path=/home/daniel/proyectos/fantasticgardensv2 --skip-themes
wp post list --post_type=proyecto --path=/home/daniel/proyectos/fantasticgardensv2 --skip-themes

# Crear página
wp post create --post_type=page --post_title='Título' --post_status=draft \
  --path=/home/daniel/proyectos/fantasticgardensv2 --skip-themes

# Flush de reglas de reescritura (tras crear CPTs o cambiar slugs)
wp rewrite flush --path=/home/daniel/proyectos/fantasticgardensv2 --skip-themes
```

---

## Reglas de trabajo

- Modificar **solo** archivos dentro de `wp-content/themes/fg-theme/`
- CSS va en `assets/css/main.css` — nunca en `style.css` (solo contiene la cabecera del tema)
- No introducir frameworks CSS ni JS externos (salvo Google Fonts)
- No tocar WordPress core ni plugins
- Todo CSS debe ser mobile-first y language-agnostic (Polylang)
- Los cambios deben ser incrementales y reversibles

---

## Documentación detallada

- [`docs/arquitectura.md`](./docs/arquitectura.md) — estructura del tema, templates, CPTs
- [`docs/diseno.md`](./docs/diseno.md) — sistema de diseño (tokens, tipografía, colores)
- [`docs/migracion.md`](./docs/migracion.md) — plan de migración a producción
