<?php
use function GrossArtig\get_custom_field_or_alert;
?>
<div class="category-gestern">
  <!-- Mobile only -->
  <nav class="category-gestern__mobile-navigation category-gestern__mobile-navigation--white">
    <h2><?php echo $category->name; ?></h2>
    <p><?php echo $category->description; ?></p>
  </nav>
  <a href="#" class="mobile-scroll-top">
    <img
      class="category__open-call-arrow"
      src="<?php echo get_theme_file_uri('/assets/images/short-white-arrow-right.png'); ?>"
      alt=""
    />
  </a>

  <header class="category-gestern__header" style="background: initial">
    <div class="category-gestern__header--left">
    </div>
    <div class="category-gestern__header--right" style="background: white;">
      <span class="pill">digital</span>
      <span class="pill">seit 2020</span>
    </div>
  </header>

  <div class="category-gestern__frames">
    <section class="gestern-print gestern-print--hide-mobile" id="print"></section>
    <section class="gestern-digital" id="digital">
      <header class="category-gestern__frames-header category-gestern__frames-header--hide-mobile">
        <span class="pill">digital</span>
        <span class="pill">seit 2020</span>
      </header>

      <article class="article article--gestern">
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
        <aside class="article__recommendations article__recommendations--gestern">
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
    </section>
  </div>
</div>
