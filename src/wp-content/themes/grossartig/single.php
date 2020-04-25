<?php

get_header();

$post = get_post();
$category = strtolower(get_the_category_by_ID($post->post_category[0]));

switch ($category) {
    case 'heute':
        require_once get_template_directory() . '/templates/category/heute.php';
        break;
    case 'morgen':
        require_once get_template_directory() . '/templates/category/morgen.php';
        break;
    case 'gestern':
        require_once get_template_directory() . '/templates/category/gestern.php';
        break;
    default:
        wp_redirect('/404', 404);
        exit;
        break;
}

get_footer();
