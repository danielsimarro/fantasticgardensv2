<?php get_header(); ?>

<main id="main">

  <?php while (have_posts()): the_post(); ?>

    <?php get_template_part('template-parts/page-hero'); ?>

    <section class="page-content">
      <div class="container">
        <div class="page-content__body">
          <?php the_content(); ?>
        </div>
      </div>
    </section>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>
