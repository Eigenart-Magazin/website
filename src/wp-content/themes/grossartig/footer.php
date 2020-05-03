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
</body>
</html>
