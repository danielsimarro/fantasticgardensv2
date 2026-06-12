# Plan de migración a producción

## Estrategia general

Desarrollo completo en local (`fantasticgardensv2.test`) → revisión en staging → swap en producción.
La web actual en Dinahosting permanece intacta hasta el momento del swap.

```
[fantasticgardensv2.test]  →  [staging.fantasticgardens.net]  →  [fantasticgardens.net]
      desarrollo                    revisión final                    producción
```

---

## Fases

### Fase 1 — Desarrollo local
- Construir el tema completo en `http://fantasticgardensv2.test`
- Crear y poblar páginas con contenido mejorado
- Validar en mobile y desktop
- Validar Polylang (ES/EN)
- Validar Yoast SEO y schema de negocio local

### Fase 2 — Staging en Dinahosting
- Crear subdominio `staging.fantasticgardens.net` en Dinahosting
- Exportar con **All-in-One WP Migration** desde local
- Importar en staging y ajustar URLs
- Revisión final con cliente
- Validar formulario de contacto en entorno real

### Fase 3 — Swap a producción
- Activar modo mantenimiento en producción actual
- Exportar staging con All-in-One WP Migration
- Importar en `fantasticgardens.net`
- Ajustar URLs de staging → producción (WP-CLI `search-replace`)
- Validar SSL, formularios, redirects
- Desactivar modo mantenimiento
- **Tiempo estimado de corte:** ~20 minutos

---

## Contenido a migrar desde la web actual

| Elemento | Origen | Acción |
|---|---|---|
| Textos de páginas | `fantasticgardens.test` | Reescribir y mejorar |
| Imágenes de proyectos | `/wp-content/uploads/` | Seleccionar + optimizar + reubicar |
| Logo | Web actual | Solicitar archivo original (SVG) |
| Testimonios | Web actual | Rescatar y añadir al nuevo diseño |
| Datos de contacto | Web actual | Verificar teléfono, email, dirección |
| Metadatos SEO | Web actual (Yoast) | Revisar y mejorar title/description por página |

---

## Mapa de URLs (no cambiar para preservar SEO)

| Página | URL producción actual |
|---|---|
| Inicio | `fantasticgardens.net/` |
| Servicios | `/servicios-jardineria-paisajismo-mantenimiento-y-vivero/` |
| Diseño Paisajismo | `/fantastic-gardens-paisajismo-diseno-jardines/` |
| Mantenimiento | `/mantenimiento-a-casas-y-empresas-jardineria/` |
| Vivero propio | `/vivero-y-plantacion-propia/` |
| Proyectos | `/proyectos-realizados-jardineria-costa-del-sol-malaga/` |
| Antes y después | `/proyectos-antes-y-despues-diseno-de-jardines-paisajismo/` |
| Historia | `/historia/` |
| Contacto | `/contacto-empresa-jardineria/` |
| Política privacidad | `/politica-de-privacidad/` |
| Aviso legal | `/aviso-legal/` |
| Cookies | `/cookies/` |

> Si alguna URL cambia, añadir redirect 301 antes del swap.

---

## Comandos útiles para el swap

```bash
# Cambiar URLs tras importar (ajustar dominios según fase)
wp search-replace 'https://fantasticgardensv2.test' 'https://fantasticgardens.net' \
  --skip-columns=guid --path=/ruta/al/wp

# Flush de permalinks tras importar
wp rewrite flush --path=/ruta/al/wp

# Verificar que el tema está activo
wp theme status --path=/ruta/al/wp
```

---

## Checklist pre-lanzamiento

- [ ] Todas las páginas creadas en ES y EN (Polylang)
- [ ] Formulario de contacto funciona y llega el email
- [ ] Logo en alta calidad subido
- [ ] SSL activo en Dinahosting
- [ ] Yoast configurado: sitemap, robots.txt, title/desc por página
- [ ] Schema de negocio local (nombre, dirección, teléfono, horario)
- [ ] Google Analytics / Tag Manager configurado
- [ ] WP-Optimize configurado (caché, compresión imágenes)
- [ ] Página de política de cookies y banner RGPD activo
- [ ] Test de velocidad (PageSpeed Insights ≥ 90 mobile)
- [ ] Test en iOS Safari y Android Chrome
