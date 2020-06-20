<?php

$parent_category = get_category_by_slug('gestern');
if (null === $parent_category) {
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
  <header class="category-gestern__header">
    <div class="category-gestern__header--left">
      <span class="pill">print</span>
      <span class="pill">1991-2019</span>
    </div>
    <div class="category-gestern__header--right">
      <span class="pill">digital</span>
      <span class="pill">seit 2020</span>
    </div>
  </header>

  <div class="category-gestern__frames">
    <section class="gestern-print">
      <?php
      $print_category = get_category_by_slug('print');

      query_posts([
          'cat' => $print_category->cat_ID,
          'post_type' => 'post',
          'orderby' => 'date',
          'order' => 'DESC',
          'nopaging' => true,
      ]);
      ?>
      <ul>
        <?php while(have_posts()): the_post(); ?>
        <?php
        $year = the_date('Y', '', '', false);
        ?>
        <li class="gestern-print__post">
          <div class="gestern-print__post-head">
            <span class="pill pill--inverted"><?php echo $year; ?></span>
            <h2><?php the_title(); ?></h2>

          </div>
          <!-- featured image -->
          <?php
              echo get_the_post_thumbnail($post, 'post-thumbnail', ['class' => 'gestern-print__post-cover']);
          ?>
          <?php
              the_excerpt();
          ?>
        </li>
        <?php endwhile; ?>
      </ul>
    </section>
    <section class="gestern-digital">
    <?php
        $digital_category = get_category_by_slug('digital');
        $digital_categories = get_categories([
            'parent' => $digital_category->cat_ID,
            'orderby' => 'name',
            'order' => 'DESC'
        ]);
    ?>
    <ul>
      <?php foreach ($digital_categories as $digital_category): ?>
      <li class="gestern-digital__post">
        <?php
        // Fetch first post so we can present the year
        query_posts([
            'cat' => $digital_category->cat_ID,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'ASC',
            'nopaging' => true,
            'limit' => 1,
        ]);
        the_post();

        $year = the_date('Y', '', '', false);
        ?>
        <span class="pill pill--inverted"><?php echo $year; ?></span>
        <div>
          <h2><?php echo $digital_category->cat_name; ?></h2>
          <p><?php echo $digital_category->category_description; ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
    </section>
  </div>
</div>

<?
wp_reset_query();

get_footer();
