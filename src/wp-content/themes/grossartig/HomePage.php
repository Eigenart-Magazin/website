<?php
/* Template Name: HomePage */

use function GrossArtig\get_custom_field_or_alert;

get_header();

$menu_items = wp_get_nav_menu_items('home-main-menu');
?>
<div class="home">
  <?php echo get_post()->post_content; ?>
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
