<?php

use function GrossArtig\get_top_category;

get_header('category');

$parent_category = get_top_category();

$posts = query_posts([
    'cat' => $parent_category->cat_ID,
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'nopaging' => true,
]);

$category = get_the_category()[0];
?>

<div class="category-heute">
  <div class="category">
    <aside class="category__aside"></aside>
    <article class="category__main">
      <div class="category__description">
        <p><?php echo $parent_category->description; ?></p>
      </div>
      <div class="category__description category__description--contrast-background">
        <div class="category__description--open-call">
          <h1>
            <img
              class="category__open-call-arrow"
              src="<?php echo get_theme_file_uri('/assets/images/arrow-right.png'); ?>"
              alt=""
            />
            <span><?php echo $category->name; ?></span>
          </h1>
          <p><?php echo $category->description; ?></p>
        </div>
      </div>
      <ul class="articles-list">
        <?php foreach ($posts as $post): ?>
        <li class="articles-list__item">
          <a href="<?php echo get_permalink($post); ?>">
            <!-- img -->
            <?php
                echo get_the_post_thumbnail($post, 'post-thumbnail', [
                    'class' => 'articles-list__cover'
                ]);
            ?>

            <div class="bubble-container">
              <!-- pill -->
              <?php foreach (get_the_tags($post) as $tag): ?>
              <div class="articles-list__item-tags">
                <span class="pill"><?php echo $tag->name; ?></span>
              </div>
              <?php endforeach; ?>
            </div>

            <div class="container">
              <?php
                  $custom = get_post_custom($post->ID) ?? [];
                  $meta = $custom['article_author'] ?? [];
                  $date = new DateTimeImmutable($post->post_date);
                  $meta = array_merge([$date->format('d.m.Y')], $meta);
              ?>
              <!-- meta -->
              <span class="articles-list__item-meta"><?php echo implode(' / ', $meta); ?></span>

              <!-- title -->
              <h2><?php echo $post->post_title; ?></h2>
              <!-- paragraph -->
              <p><?php echo $post->post_excerpt; ?></p>
            </div>
          </a>
        </li>
        <?php endforeach; ?>
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
wp_reset_query();

get_footer();
