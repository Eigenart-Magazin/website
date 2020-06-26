<?php

$category = get_queried_object();

if (null === $category || 'category' !== $category->taxonomy) {
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

$parents = get_category_parents($category->cat_ID);

if (null !== $category->parent) {
    $direct_parent = get_term($category->parent, 'category');

    if ('digital' === strtolower($direct_parent->name)) {
        $gestern_parent = get_term($direct_parent->parent, 'category');

        if (null !== $gestern_parent && 'gestern' === strtolower($gestern_parent->name)) {
            get_template_part('category', 'gestern-digital');
        }
    }
}
