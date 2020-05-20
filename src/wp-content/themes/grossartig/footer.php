<?php
use function GrossArtig\is_dev_mode_on;
?>
</main>
<footer class="footer">
  <ul>
  <?php foreach (wp_get_nav_menu_items('footer') ?: [] as $menu_item): ?>
    <li>
      <a class="pill pill--inverted" href="<?php echo $menu_item->url ?: '#'; ?>">
        <?php echo $menu_item->title; ?>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>

  <span>© Copyright 2020 - <?php bloginfo('name'); ?></span>
</footer>
<?php

if (is_dev_mode_on()) {
    $elements = '';
    foreach (range(1, 10) as $i) {
        $elements .= "<div class='virtual-grid__item virtual-grid-item-{$i}'></div>";
    }
    echo "<div class='virtual-grid'>{$elements}</div>";
}

?>
</body>
</html>
