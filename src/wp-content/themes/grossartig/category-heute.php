<?php

$post_categories = get_the_category();
$open_call_category = count($post_categories) > 0 ? $post_categories[0] : null;
if (null === $open_call_category) {
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

$posts = query_posts([
    'cat' => $open_call_category->cat_ID,
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'nopaging' => true,
]);

$parent_category = get_category_by_slug('heute');

// Print header
get_header('category');
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
            <span><?php echo $open_call_category->name; ?></span>
          </h1>
          <p><?php echo $open_call_category->description; ?></p>
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
