<?php

use function GrossArtig\get_top_category;

get_header();

$category = get_top_category();

switch (strtolower($category->name)) {
    case 'heute':
        require_once get_template_directory() . '/templates/article/heute.php';
        break;
    case 'morgen':
        require_once get_template_directory() . '/templates/article/morgen.php';
        break;
    case 'gestern':
        require_once get_template_directory() . '/templates/article/gestern.php';
        break;
    default:
        wp_redirect('/404', 404);
        exit;
        break;
}

get_footer();
