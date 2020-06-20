<?php

$parent_category = get_category_by_slug('gestern');
if (null === $parent_category) {
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

$posts = query_posts([
    'cat' => $parent_category->cat_ID,
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'nopaging' => true,
]);

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
      Print stuff
    </section>
    <section class="gestern-digital">
      Digital stuff
    </section>
  </div>
</div>

<?
wp_reset_query();

get_footer();
