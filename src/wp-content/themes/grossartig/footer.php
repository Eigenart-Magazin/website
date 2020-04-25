<footer>
    © Copyright 2020 - <?php bloginfo('name'); ?>
    <ul>
    <?php foreach (wp_get_nav_menu_items('footer') ?: [] as $menu_item): ?>
        <li>
            <a href="<?php echo $menu_item->url ?: '#'; ?>"><?php echo $menu_item->title; ?></a>
        </li>
    <?php endforeach; ?>
    </ul>
</footer>
</body>
</html>
