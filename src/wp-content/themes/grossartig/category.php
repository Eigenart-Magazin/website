<?php

use function GrossArtig\get_top_category;

get_header();

$parent_category = get_top_category();

switch (strtolower($parent_category->name)) {
    case 'heute':
        require_once get_template_directory() . '/templates/category/heute.php';
        break;
    case 'morgen':
        require_once get_template_directory() . '/templates/category/morgen.php';
        break;
    case 'gestern':
        require_once get_template_directory() . '/templates/category/gestern.php';
        break;
}

get_footer();
