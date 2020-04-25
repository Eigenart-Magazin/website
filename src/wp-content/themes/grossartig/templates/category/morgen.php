<article class="article article--morgen">
  <h1><?php the_title() ?></h1>

  <?php if(has_excerpt()): ?>
    <?php the_excerpt(); ?>
  <?php endif; ?>

  <?php echo get_post()->post_content; ?>
</article>
