<?php
use function GrossArtig\get_custom_field_or_alert;
?>
<div class="category-gestern">
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
            <img src="<?php echo get_theme_file_uri('/assets/images/short-white-arrow-right.png'); ?>" alt="Go Back" />
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
    </section>
  </div>
</div>
