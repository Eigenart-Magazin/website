<?php

get_header();

$menu_items = wp_get_nav_menu_items('home-main-menu');

?>

<ul>
    <?php foreach ($menu_items as $item): ?>
    <li>
        <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
    </li>
    <? endforeach; ?>
</ul>

<?php

get_footer();
