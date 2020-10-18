<?php
/*
 * Template Name: HeuteArticle
 * Template Post Type: post
 */

use function GrossArtig\{get_custom_field_or_alert};

get_header();
the_post();

$category = get_the_category()[0];
$is_gestern = false;

if ($category) {
    $topMost = $category;
    while ($topMost->parent) {
        $topMost = get_category($topMost->parent);
    }

    $is_gestern = $topMost->slug === 'gestern';
}
?>
<article class="article article--heute <?php echo $is_gestern ? 'article--gestern' : ''; ?>">
  <div class="article__header">
    <button class="article__back-button" onclick="window.history.go(-1);">
      <img src="<?php echo get_theme_file_uri('/assets/images/short-arrow-left.png'); ?>" alt="Go Back" />
    </button>
    <h1 class="article__title"><?php the_title() ?></h1>

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

    <?php if(has_excerpt()): ?>
    <div class="article__excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>
  </div>

  <div class="article__content"><?php the_content(); ?></div>
</article>
<?php
$recommended_articles = query_posts([
  'cat' => $category->term_id,
  'post__not_in' => [get_post_field('ID')],
  'posts_per_page' => 5,
]) ?: [];

wp_reset_query();
?>
<?php if (count($recommended_articles) > 0): ?>
<aside class="article__recommendations article__recommendations--heute">
  <header class="article__recommendations-header">
    <div class="arrow-container arrow-container--thin arrow-container--left">
    <div class="arrow-container__arrow arrow-container__arrow--left">
      <i class="arrow-container__arrow-head"></i>
    </div>
    </div>
    <h2>mehr & much more</h2>
  </header>
  <ul class="article__recommendations-list">
    <?php foreach ($recommended_articles as $recommended): ?>
    <li class="article__recommended-list-item">
      <a href="<?php echo get_permalink($recommended); ?>">
        <?php echo get_the_post_thumbnail($recommended, 'post-thumbnail', ['loading' => 'lazy']) ?>
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
