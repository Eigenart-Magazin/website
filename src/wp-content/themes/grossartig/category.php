<?php

use function GrossArtig\get_top_category;

get_header();

$parent_category = get_top_category();

$posts = query_posts([
    'cat' => $parent_category->cat_ID,
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC'
]);

?>
  <article class="category">
    <p class="category__description">
      <?php echo $parent_category->description; ?>
    </p>
    <h1><?php echo $parent_category->name; ?></h1>
    <ul class="articles-list">
      <?php foreach ($posts as $post): ?>
        <hr class="articles-list__divider">
        <li class="articles-list__item">
          <a href="<?php echo get_permalink($post); ?>">
            <!-- img -->
            <?php echo get_the_post_thumbnail($post) ?>

            <!-- pill -->
            <?php foreach (get_the_tags($post) as $tag): ?>
              <div class="articles-list__item-tags">
                <span class="pill"><?php echo $tag->name; ?></span>
              </div>
            <?php endforeach; ?>

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
          </a>
        </li>
      <?php
      endforeach;
      ?>
    </ul>
  </article>

<?php
wp_reset_query();

get_footer();
