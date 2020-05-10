<?php
/* Template Name: HomePage */

get_header();

$menu_items = wp_get_nav_menu_items('home-main-menu');
?>
<div class="home">
  <?php echo get_post()->post_content; ?>
  <ul class="category-list">
    <?php foreach ($menu_items as $item): ?>
      <li class="category-list__item">
        <a href="<?php echo $item->url; ?>">
          <?php
          $img = '';
          switch (strtolower($item->title)) {
              case 'morgen':
                  $img =  get_theme_file_uri('/assets/images/home-morgen.png');
                  break;
              case 'heute':
                  $img =  get_theme_file_uri('/assets/images/home-heute.png');
                  break;
              case 'gestern':
                  $img =  get_theme_file_uri('/assets/images/home-gestern.png');
                  break;
              case 'about':
                  $img =  get_theme_file_uri('/assets/images/home-about.png');
                  break;
          }
          ?>
          <img src="<?php echo $img; ?>" alt="<?php echo $item->title; ?>" />
        </a>
      </li>
    <? endforeach; ?>
  </ul>
</div>

<?php

get_footer();
