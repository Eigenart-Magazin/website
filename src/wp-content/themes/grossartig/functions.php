<?php

namespace GrossArtig;

use WP_Term;

add_theme_support('post-thumbnails');

function is_dev_mode_on(): bool
{
    return 'eigenart.dev' === ($_SERVER['SERVER_NAME'] ?? '');
}

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

function grossartig_block_wrapper(string $block_content, array $block): string
{
    if ('core/gallery' === $block['blockName']) {
        $arrowImageUrl = get_theme_file_uri('/assets/images/gallery-arrow-right.png');
        $arrowImg = "<img src='{$arrowImageUrl}' />";
        $leftButton = '<button onClick="galleryOnClickPrevious(this)" class="gallery__button gallery__button--left">'
            . $arrowImg . '</button>';
        $rightButton = '<button onClick="galleryOnClickNext(this)" class="gallery__button gallery__button--right">'
            . $arrowImg . '</button>';

        $block_content = str_replace(
            '<ul class="blocks-gallery-grid">',
            $leftButton . '<ul class="blocks-gallery-grid">',
            $block_content
        );

        $block_content = str_replace(
            '</ul>',
            '</ul>' . $rightButton,
            $block_content
        );
    }

    return $block_content;
}

function grossartig_unsafe_image_url(string $imageUrl) {
    return str_replace('https', 'http', $imageUrl);
}

/**
 * Podcast plugin
 */
add_filter('ssp_feed_item_image', 'GrossArtig\grossartig_unsafe_image_url');

/**
 * Gallery
 */
add_filter('render_block', 'GrossArtig\\grossartig_block_wrapper', 10, 2);
