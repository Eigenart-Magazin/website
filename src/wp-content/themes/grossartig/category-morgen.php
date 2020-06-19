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

?>
<div class="category-morgen">
  <div class="category">
    <aside class="category__aside"></aside>
    <article class="category__main">
      <div class="category__description">
        <p>
          <img
            class="arrow"
            src="<?php echo get_theme_file_uri('/assets/images/short-white-arrow-right.png'); ?>"
            alt=""
          />
          <?php echo $parent_category->description; ?>
        </p>
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
              <p>
                <?php echo $post->post_excerpt; ?>
                <img
                  class="articles-list__read-more"
                  src="<?php echo get_theme_file_uri('/assets/images/arrow-read-more.png'); ?>"
                  alt=""
                />
                <img
                  class="articles-list__read-more articles-list__read-more--inverted"
                  src="<?php echo get_theme_file_uri('/assets/images/short-white-arrow-right.png'); ?>"
                  alt=""
                />
              </p>
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
