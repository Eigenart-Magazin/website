<?php
/*
 * Template Name: HeuteArticle
 * Template Post Type: post
 */

use function GrossArtig\{
    get_custom_field_or_alert,
    get_top_category
};

get_header();

the_post();

$category = get_top_category();
$post = get_post();

?>
  <article class="article article--heute">
    <div class="article__header">
      <h1 class="article__title"><?php the_title() ?></h1>

      <?php if(has_excerpt()): ?>
        <div class="article__excerpt"><?php the_excerpt(); ?></div>
      <?php endif; ?>

      <span class="article__meta">
        <?php
        $date = get_post_datetime() ?: new DateTimeImmutable();
        $fields = array_merge(
            [$date->format('d.m.Y')],
            get_custom_field_or_alert('article_author', 'red')
        );

        echo implode(' / ', $fields);
        ?>
      </span>
    </div>

    <div class="article__content">
      <?php the_content(); ?>
    </div>
  </article>

<?php

$recommended_articles = query_posts([
  'cat' => $category->term_id,
  'post__not_in' => [$post->ID],
  'posts_per_page' => 5,
]) ?: [];

wp_reset_query();
?>
  <?php if (count($recommended_articles) > 0): ?>
  <aside class="article article__recommendations article__recommendations--heute">
    <header class="article__recommendations-header">
      <img src="<?php echo get_theme_file_uri('/assets/images/mehr-und-more-arrow.png'); ?>" alt="" />
      <h2>mehr & much more</h2>
    </header>
    <ul class="article__recommendations-list">
      <?php foreach ($recommended_articles as $recommended): ?>
        <li class="article__recommended-list-item">
          <a href="<?php echo get_permalink($recommended); ?>">
            <?php echo get_the_post_thumbnail($recommended) ?>
            <?php
            $custom = get_post_custom($recommended->ID) ?? [];
            $meta = $custom['article_author'] ?? [];
            $date = new DateTimeImmutable($recommended->post_date);
            $meta = array_merge([$date->format('d.m.Y')], $meta);
            ?>
            <span><?php echo implode(' / ', $meta); ?></span>

            <h3><?php echo $recommended->post_title; ?></h3>
            <p><?php echo $recommended->post_excerpt; ?></p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </aside>
  <?php endif; ?>

  <a href="#" class="category__scroll-top">
    <img
      src="<?php echo get_theme_file_uri('/assets/images/arrow-top.png'); ?>"
      alt="Scroll to Top"
    />
  </a>

<?php
get_footer();
