<?php
/**
 * Plantilla genérica para cualquier página de WordPress sin plantilla propia.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
get_header();

while (have_posts()) : the_post(); ?>

  <section class="section">
    <div class="wrap">
      <?php fg_breadcrumb([['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')], ['label' => get_the_title()]]); ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
      <span class="accent-rule"></span>
      <?php if (has_excerpt()) : ?>
        <p class="page-lead"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
      <?php endif; ?>
      <div class="legal-prose"><?php the_content(); ?></div>
    </div>
  </section>

<?php endwhile;

fg_site_closing();
get_footer();
