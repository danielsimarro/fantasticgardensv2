<?php get_header(); ?>

<main id="main">

  <?php get_template_part('template-parts/hero'); ?>

  <!-- FEATURES (3 bloques de icono) -->
  <section id="servicios">
    <div class="container">
      <div class="features-grid">

        <div class="feature-block">
          <div class="feature-block__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/>
              <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
            </svg>
          </div>
          <h3 class="feature-block__title"><?php esc_html_e('Diseñamos tu Jardín', 'fg-theme'); ?></h3>
          <p><?php esc_html_e('Realizamos tu proyecto de paisajismo en 3D para que puedas ver cuál será tu resultado.', 'fg-theme'); ?></p>
          <a href="<?php echo esc_url(home_url('/fantastic-gardens-paisajismo-diseno-jardines/')); ?>" class="feature-block__arrow" aria-label="<?php esc_attr_e('Ver Diseño Paisajismo', 'fg-theme'); ?>">&#8594;</a>
        </div>

        <div class="feature-block">
          <div class="feature-block__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="8" y1="21" x2="8" y2="14"/>
              <line x1="16" y1="21" x2="16" y2="14"/>
              <path d="M5.5 14c0-2.2 1.1-4.5 2.5-4.5S10.5 11.8 10.5 14h-5z"/>
              <path d="M13.5 14c0-2.2 1.1-4.5 2.5-4.5S18.5 11.8 18.5 14h-5z"/>
              <path d="M8 18c-1.5 0-2.5-1-2.5-2"/>
              <path d="M16 17c1.5 0 2.5-1 2.5-2"/>
              <line x1="3" y1="21" x2="21" y2="21"/>
            </svg>
          </div>
          <h3 class="feature-block__title"><?php esc_html_e('Flores y Plantas', 'fg-theme'); ?></h3>
          <p><?php esc_html_e('Dispondrás de la mejor selección de flores y plantas. Disponemos de viveros con plantación propia que harán de tu jardín un verdadero oasis.', 'fg-theme'); ?></p>
          <a href="<?php echo esc_url(home_url('/vivero-y-plantacion-propia/')); ?>" class="feature-block__arrow" aria-label="<?php esc_attr_e('Ver Vivero y Plantación', 'fg-theme'); ?>">&#8594;</a>
        </div>

        <div class="feature-block">
          <div class="feature-block__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M4 20h12l1-8H3L4 20z"/>
              <path d="M7 12V9a3 3 0 0 1 6 0v3"/>
              <path d="M17 14l3.5-5.5"/>
              <line x1="19.5" y1="7.5" x2="19.5" y2="5.5"/>
              <line x1="21.5" y1="9" x2="22.5" y2="7"/>
              <line x1="17.5" y1="6.5" x2="18.5" y2="4.5"/>
            </svg>
          </div>
          <h3 class="feature-block__title"><?php esc_html_e('Mantenimiento', 'fg-theme'); ?></h3>
          <p><?php esc_html_e('Solo siéntate en tu jardín y disfruta de tu piscina, con nuestros mantenimientos todo es más fácil.', 'fg-theme'); ?></p>
          <a href="<?php echo esc_url(home_url('/mantenimiento-a-casas-y-empresas-jardineria/')); ?>" class="feature-block__arrow" aria-label="<?php esc_attr_e('Ver Mantenimiento', 'fg-theme'); ?>">&#8594;</a>
        </div>

      </div>
    </div>
  </section>

  <!-- CALIDAD Y GARANTÍA -->
  <section class="section calidad-section">
    <div class="container">
      <div class="calidad-grid">

        <div class="calidad-image">
          <?php
            $p = get_page_by_path('fantastic-gardens-paisajismo-diseno-jardines');
            if ($p && has_post_thumbnail($p)) {
              echo get_the_post_thumbnail($p, 'large', ['alt' => esc_attr__('Jardín diseñado por Fantastic Gardens', 'fg-theme')]);
            } else {
              echo '<img src="' . esc_url(get_theme_file_uri('assets/img/calidad-garden.jpg')) . '" alt="' . esc_attr__('Jardín diseñado por Fantastic Gardens', 'fg-theme') . '" loading="lazy">';
            }
          ?>
        </div>

        <div class="calidad-content">
          <span class="calidad-label"><?php esc_html_e('Somos Fantastic Gardens', 'fg-theme'); ?></span>
          <h2 class="calidad-heading"><?php esc_html_e('Calidad y Garantía', 'fg-theme'); ?></h2>
          <p><?php esc_html_e('Somos una Empresa con un equipo con gran responsabilidad en nuestros trabajos, tenemos más de 40 años de experiencia en el sector.', 'fg-theme'); ?></p>
          <p><?php esc_html_e('Todo lo necesario para tus necesidades de Jardinería. Disponemos de nuestro propio Garden Center (Ronda), oficinas (San Pedro) y plantaciones (Ronda, Málaga y Valencia), maquinaria, herramientas y productos especializados.', 'fg-theme'); ?></p>

          <div class="calidad-features">

            <div class="calidad-feature">
              <div class="calidad-feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M17 8C8 10 5.9 16.17 3.82 19.25C2.71 20.71 3.51 22 5 22c4 0 7-1 9-4 0-2 1-4 3-5"/>
                  <path d="M9 12c0 4.65 2.5 9 6 9"/>
                </svg>
              </div>
              <span><?php esc_html_e('Vivero y Plantación Propia', 'fg-theme'); ?></span>
            </div>

            <div class="calidad-feature">
              <div class="calidad-feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
              </div>
              <span><?php esc_html_e('+40 Años de Experiencia', 'fg-theme'); ?></span>
            </div>

            <div class="calidad-feature">
              <div class="calidad-feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <span><?php esc_html_e('Profesionales Especializados', 'fg-theme'); ?></span>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section class="testimonials-section" id="testimonios">
    <div class="container">
      <div class="testimonials-wrap">

        <div class="testimonial is-active">
          <div class="testimonial__quote">
            <span class="testimonial__qs" aria-hidden="true">&#10077;</span>
            <p><?php esc_html_e('Construí tres casas en España. Cada uno en un terreno de más de 2.000 m². Los tres jardines fueron diseñados, hechos y mantenidos por Fantastic Gardens. Estoy muy contento con la cooperación y el servicio. Se lo recomiendo a todos.', 'fg-theme'); ?></p>
          </div>
          <div class="testimonial__author">
            <div class="testimonial__avatar"></div>
            <div class="testimonial__info">
              <cite>Andrew</cite>
              <span class="testimonial__source"><?php esc_html_e('Propietario · Reseña extraída de MundoJardineria', 'fg-theme'); ?></span>
            </div>
          </div>
        </div>

        <div class="testimonial">
          <div class="testimonial__quote">
            <span class="testimonial__qs" aria-hidden="true">&#10077;</span>
            <p><?php esc_html_e('Supieron proyectar mis ideas y mis preferencias en mi jardín a la perfección, un trato muy cordial y cercano a la vez que profesional y eficaz, he quedado muy satisfecha.', 'fg-theme'); ?></p>
          </div>
          <div class="testimonial__author">
            <div class="testimonial__avatar"></div>
            <div class="testimonial__info">
              <cite><?php esc_html_e('Propietaria', 'fg-theme'); ?></cite>
              <span class="testimonial__source"><?php esc_html_e('Reseña extraída de MundoJardineria', 'fg-theme'); ?></span>
            </div>
          </div>
        </div>

        <div class="testimonial-dots" role="tablist">
          <button class="testimonial-dot is-active" aria-label="<?php esc_attr_e('Testimonio 1', 'fg-theme'); ?>"></button>
          <button class="testimonial-dot" aria-label="<?php esc_attr_e('Testimonio 2', 'fg-theme'); ?>"></button>
        </div>

      </div>
    </div>
  </section>

  <!-- ¿HABLAMOS? -->
  <section class="hablamos-section">
    <div class="hablamos-inner">
      <div class="hablamos-wa-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      </div>
      <h2><?php esc_html_e('¿Hablamos?', 'fg-theme'); ?></h2>
      <p class="hablamos-subtitle"><?php esc_html_e('Presupuestos sin compromiso', 'fg-theme'); ?></p>
      <p class="hablamos-text"><?php esc_html_e('Realizamos presupuestos sin compromiso, siempre ajustándonos a ellos y a los tiempos de entrega con los mejores resultados del sector.', 'fg-theme'); ?></p>
      <a href="https://wa.me/34691142679" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">
        <?php esc_html_e('Contactar', 'fg-theme'); ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      </a>
    </div>
  </section>

</main>

<?php get_footer(); ?>
