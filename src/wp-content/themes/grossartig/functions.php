<?php

function get_custom_field_or_alert(string $field, string $alert_modifier = 'red'): string
{
    $custom_field = post_custom($field);

    if (false === $custom_field) {
        $custom_field = <<<ALERT
    <div class="alert alert--{$alert_modifier}">
        The "{$field}" custom field does not exist for this page!
    </div>
ALERT;
    }

    return $custom_field;
}