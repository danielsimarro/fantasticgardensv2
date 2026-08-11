<?php
/**
 * Plantilla de respaldo genérica, requerida por WordPress. No se usa en la
 * práctica: todo el contenido real del sitio tiene una plantilla propia.
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="section wrap">
      <h1 class="page-title"><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
