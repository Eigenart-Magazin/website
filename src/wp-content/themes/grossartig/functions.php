<?php

namespace GrossArtig;

use WP_Term;

add_theme_support('post-thumbnails');

function get_custom_field_or_alert(string $field, string $alert_modifier = 'red'): array
{
    $custom_field = \post_custom($field);

    if (false === $custom_field) {
        $custom_field = <<<ALERT
    <div class="alert alert--{$alert_modifier}">
        The "{$field}" custom field does not exist for this page!
    </div>
ALERT;
    }

    return is_array($custom_field) ? $custom_field : [$custom_field];
}

function get_top_category(): WP_Term
{
    $parent_category = current(array_filter(get_the_category(), function (WP_Term $term) {
        return $term->parent === 0;
    }));

    return $parent_category;
}
