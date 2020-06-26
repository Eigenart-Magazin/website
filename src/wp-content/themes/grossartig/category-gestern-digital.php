<?php

$category = get_queried_object();

if (null === $category) {
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

// Print header
get_header('category');

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
      <ul>
      <?php while (have_posts()): the_post();?>
        <li class="gestern-digital__post gestern-digital__post--no-padding">
          <div>
            <?php
                $custom = get_post_custom($post->ID) ?? [];
                $meta = $custom['article_author'] ?? [];
                $date = new DateTimeImmutable($post->post_date);
                $meta = array_merge([$date->format('d.m.Y')], $meta);
            ?>
            <!-- meta -->
            <span class="gestern-digital__post-meta"><?php echo implode(' / ', $meta); ?></span>

            <!-- title -->
            <h2><?php the_title(); ?></h2>

            <!-- excerpt -->
            <p><?php the_excerpt(); ?></p>
          </div>
        </li>
      <?php endwhile;?>
      </ul>
    </section>
  </div>
</div>

<?php
wp_reset_query();

get_footer();
