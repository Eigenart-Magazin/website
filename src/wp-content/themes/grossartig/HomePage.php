<?php
/* Template Name: HomePage_ */

get_header('home');

$menu_items = wp_get_nav_menu_items('home-main-menu');

$featured_post = query_posts([
    'post_type' => 'post',
    'category_name' => 'featured-posts',
    'orderby' => 'date',
    'order' => 'DESC',
    'nopaging' => false,
    'posts_per_page' => 1,
])[0] ?? null;

$current_open_call = query_posts([
    'post_type' => 'post',
    'category_name' => 'open-call',
    'orderby' => 'date',
    'order' => 'DESC',
    'nopaging' => false,
    'posts_per_page' => 1,
])[0] ?? null;
?>

<section id="front" class="mainsection">
    <ul class="category-list">
    <?php
    if ($featured_post):
        $custom = get_post_custom($featured_post->ID) ?? [];
        $meta = $custom['article_author'] ?? [];
        $date = new DateTimeImmutable($featured_post->post_date);
        $meta = array_merge([$date->format('d.m.Y')], $meta);
    ?>
      <li id="featured-story" class="category-list-item featured-content-single">
        <div class="content" id="featured-story-content">
          <a class="url" href="<?php echo get_the_permalink($featured_post); ?>">
            <div class="column">
              <div class="image-container">
                <img
                  class="featured-content"
                  src="<?php echo get_the_post_thumbnail_url($featured_post); ?>"
                  alt="<?php echo get_the_post_thumbnail_caption($featured_post); ?>"
                />
              </div>
              <div class="text-container">
                <h2 class="title"><?php echo get_the_title($featured_post); ?></h2>
                <span class="author"><?php echo implode(' / ', $meta); ?></span>
                <p class="excerpt"><?php echo get_the_excerpt($featured_post); ?></p>
              </div>
            </div>
          </a>
        </div>
      </li>
    <?php endif; ?>
    <?php if ($current_open_call): ?>
      <div id="open-call-stamp" class="open-call">
        <button class="close-open-call" onclick="closeOpenCallPromo()">&#215;</button>
        <a class="url" href="<?php echo get_the_permalink($current_open_call); ?>">
          <span class="open-call"><?php echo get_the_title($current_open_call); ?></span>
        </a>
        <img class="open-call" src="<?php echo get_theme_file_uri('/assets/images/open-call.svg'); ?>" alt="open-call">
      </div>
    <?php endif; ?>
    <?php
    foreach ($menu_items as $pos => $item):
        $leftOrRight = ($pos % 2 === 0 ? 'left' : 'right');
        $category = get_category($item->object_id);
        $category_name = strtolower($category->slug);

        $posts = query_posts([
            'cat' => $category->cat_ID,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'nopaging' => false,
            'posts_per_page' => 3,
        ]);

        if (count($posts) === 0) {
            continue;
        }
    ?>
      <li class="category-list-item">
        <div class="category-container">
          <div id="<?php echo $category_name; ?>" class="arrow-container arrow-<?php echo $leftOrRight; ?>">
            <hr class="arrow-<?php echo $leftOrRight; ?> <?php echo $category_name ?>-line">
            <div
              class="arrow-head-container arrow-<?php echo $leftOrRight; ?> <?php echo $category_name === 'gestern' ? 'double-case' : ''; ?>"
            >
              <img class="arrow" src="<?php echo get_theme_file_uri('/assets/images/arrow.svg'); ?>" alt="arrow">
            </div>
          </div>
          <div class="category-title category-title-<?php echo $leftOrRight; ?>">
            <a class="categories" href="<?php echo get_category_link($category); ?>">
              <span>
                <img
                  class="categories initial"
                  src="<?php echo get_theme_file_uri("/assets/images/categories/{$category_name}.svg"); ?>"
                  alt="<?php echo $category_name; ?>"
                />
                <img
                  class="categories on-hover"
                  src="<?php echo get_theme_file_uri("/assets/images/categories/{$category_name}-stroke.svg"); ?>"
                  alt="<?php echo $category_name; ?>"
                />
              </span>
              <span class="category-description on-hover" id="<?php echo $category_name ?>-description">
                <?php echo $category->description; ?>
              </span>
            </a>
          </div>
          <div class="content" id="<?php echo $category_name ?>-content">
            <?php
            foreach ($posts as $post):
                $custom = get_post_custom($featured_post->ID) ?? [];
                $meta = $custom['article_author'] ?? [];
                $date = new DateTimeImmutable($featured_post->post_date);
                $meta = array_merge([$date->format('d.m.Y')], $meta);
            ?>
            <a class="url" href="<?php the_permalink($post); ?>">
              <div class="column">
                <div class="image-container">
                  <img
                    class="featured-content"
                    src="<?php echo get_the_post_thumbnail_url($post) ?>"
                    alt="<?php echo get_the_post_thumbnail_caption($post); ?>"
                  />
                </div>
                <h2 class="title">
                  <?php echo get_the_title($post); ?>
                </h2>
                <span class="author"><?php echo implode(' / ', $meta); ?></span>
                <p class="excerpt">
                  <?php echo get_the_excerpt($post); ?>
                </p>
              </div>
            </a>
            <?php
            endforeach;
            ?>
            <?php if ($category_name !== 'events'): ?>
            <div class="column more-stories">
              <a class="more-stories pill" href="<?php echo get_category_link($category); ?>">More Stories</a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </li>
    <?php
    endforeach;
    ?>
    </ul>
</section>

<?php

get_footer('home');
