<?php

$parent_category = current(array_filter(get_categories(), function (WP_Term $term) {
    return $term->parent === 0;
}));

$category = get_the_category()[0] ?? null;
if (true === is_null($category)) {
    wp_redirect('/404', 404);
    exit;
}

$posts = query_posts("cat={$category->ID}");

?>
<article>
    <p><?php echo $parent_category->description; ?></p>
    <hr>
    <h1><?php echo $category->name; ?></h1>
    <p><?php echo $category->description; ?></p>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <?php echo $post->post_title; ?>
            <a href="<?php echo get_permalink($post); ?>">
                <!-- img -->
                <?php echo get_the_post_thumbnail($post) ?>

                <!-- pill -->
                <?php foreach (get_the_tags($post) as $tag): ?>
                    <span><?php echo $tag->name; ?></span>
                <?php endforeach; ?>

                <?php
                $custom = get_post_custom($post->ID) ?? [];
                $meta = $custom['article_author'] ?? [];
                $date = new DateTimeImmutable($post->post_date);
                $meta = array_merge([$date->format('d.m.Y')], $meta);
                ?>
                <!-- meta -->
                <span><?php echo implode(' / ', $meta); ?></span>

                <!-- title -->
                <h2><?php echo $post->post_title; ?></h2>
                <!-- paragraph -->
                <p><?php echo $post->post_excerpt; ?></p>
            </a>
        </li>
        <?php
        endforeach;
        ?>
    </ul>
</article>

<?php
wp_reset_query();
