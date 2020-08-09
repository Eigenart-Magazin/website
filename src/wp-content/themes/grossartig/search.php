<?php

global $wp_query;
$total_results = $wp_query->found_posts;

get_header('category');
?>
<div class="category-heute">
  <div class="category">
    <article class="category__main">
      <ul class="articles-list">
        <?php while (have_posts()): the_post(); ?>
          <li class="articles-list__item">
            <a href="<?php echo get_post_permalink(); ?>">
              <!-- img -->
              <?php
              echo get_the_post_thumbnail(null, 'post-thumbnail', [
                'class' => 'articles-list__cover',
                'loading' => 'lazy',
              ]);
              ?>

              <div class="bubble-container">
                <!-- pill -->
                <?php foreach (get_the_tags() as $tag): ?>
                  <div class="articles-list__item-tags">
                    <span class="pill"><?php echo $tag->name; ?></span>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="container">
                <?php

                $custom = get_post_custom() ?? [];
                $meta = $custom['article_author'] ?? [];
                $date = new DateTimeImmutable($post->post_date);
                $meta = array_merge([$date->format('d.m.Y')], $meta);
                ?>
                <!-- meta -->
                <span class="articles-list__item-meta"><?php echo implode(' / ', $meta); ?></span>

                <!-- title -->
                <h2><?php echo get_the_title(); ?></h2>
                <!-- paragraph -->
                <p><?php echo get_the_excerpt(); ?></p>
              </div>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <a href="#" class="category__scroll-top">
        <img
          src="<?php echo get_theme_file_uri('/assets/images/arrow-top.png'); ?>"
          alt="Scroll to Top"
        />
      </a>
    </article>
  </div>
</div>

<?php
get_footer();
