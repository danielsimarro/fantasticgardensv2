<section class="page-hero">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <?php if (has_excerpt()): ?>
      <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
    <?php endif; ?>
  </div>
</section>
