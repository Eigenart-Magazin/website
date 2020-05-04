<?php get_header();  ?>

<article class="article">
  <div class="article__header">
    <h1 class="article__title"><?php the_title() ?></h1>
  </div>

  <div class="article__content">
    <?php the_content(); ?>
  </div>
</article>

<?php
get_footer();
