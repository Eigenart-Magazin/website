<?php
/* Template Name: HomePage */

use function GrossArtig\get_custom_field_or_alert;

get_header();

$menu_items = wp_get_nav_menu_items('home-main-menu');

$marquee_text = get_custom_field_or_alert('marquee')[0];
?>
<div class="home">
  <marquee behavior="" direction=""><?php echo $marquee_text; ?></marquee>
  <ul class="category-list">
    <?php foreach ($menu_items as $item): ?>
      <li class="category-list__item">
        <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
      </li>
    <? endforeach; ?>
  </ul>
</div>

<?php

get_footer();
