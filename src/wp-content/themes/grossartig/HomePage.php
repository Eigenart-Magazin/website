<?php
/* Template Name: HomePage */

get_header();

$menu_items = wp_get_nav_menu_items('home-main-menu');
?>
<script type="text/javascript">
  function onMouseOverHomeButton(img) {
    img.src = img.getAttribute('data-src-active');
  }

  function onMouseLeaveHomeButton(img) {
    img.src = img.getAttribute('data-src-idle');
  }
</script>
<div class="home">
  <?php echo get_post()->post_content; ?>
  <ul class="category-list">
    <?php
    foreach ($menu_items as $pos => $item):
        $leftOrRight = ($pos % 2 === 0 ? 'left' : 'right');
        $class = implode(' ', [
            'category-list__item',
            "category-list__item--{$leftOrRight}",
            'arrow-container',
            "arrow-container--{$leftOrRight}"
        ]);
    ?>
      <li
        class="<?php echo $class; ?>"
      >
        <?php if ($pos % 2 === 0): ?>
        <div class="arrow-container__arrow arrow-container__arrow--left">
          <i class="arrow-container__arrow-head"></i>
        </div>
        <?php endif; ?>
        <a href="<?php echo $item->url; ?>">
          <?php
          $img = '';
          $imgActive = '';
          switch (strtolower($item->title)) {
              case 'morgen':
                  $img =  get_theme_file_uri('/assets/images/home-morgen.png');
                  $imgActive =  get_theme_file_uri('/assets/images/home-morgen-active.png');
                  break;
              case 'heute':
                  $img =  get_theme_file_uri('/assets/images/home-heute.png');
                  $imgActive =  get_theme_file_uri('/assets/images/home-heute-active.png');
                  break;
              case 'gestern':
                  $img =  get_theme_file_uri('/assets/images/home-gestern.png');
                  $imgActive =  get_theme_file_uri('/assets/images/home-gestern-active.png');
                  break;
              case 'about':
                  $img =  get_theme_file_uri('/assets/images/home-about.png');
                  $imgActive =  get_theme_file_uri('/assets/images/home-about-active.png');
                  break;
          }
          ?>
          <img
            onmouseover="onMouseOverHomeButton(this)"
            onmouseleave="onMouseLeaveHomeButton(this)"
            data-src-idle="<?php echo $img; ?>"
            data-src-active="<?php echo $imgActive; ?>"
            src="<?php echo $img; ?>" alt="<?php echo $item->title; ?>"
          />
        </a>
        <?php if ($pos % 2 === 1): ?>
        <div class="arrow-container__arrow arrow-container__arrow--right">
          <i class="arrow-container__arrow-head"></i>
        </div>
        <?php endif; ?>
      </li>
    <? endforeach; ?>
  </ul>
</div>

<?php

get_footer();
