<?php
use function GrossArtig\get_custom_field_or_alert;
?>
<article class="article article--heute">
    <h1 class="article__title"><?php the_title() ?></h1>

    <?php if(has_excerpt()): ?>
        <div class="article__excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>

    <span class="article__meta">
        <?php
            $date = get_post_datetime() ?: new DateTimeImmutable();
            $fields = array_merge(
                [$date->format('d.m.Y')],
                get_custom_field_or_alert('article_author', 'red')
            );

            echo implode(' / ', $fields);
        ?>
    </span>

    <?php echo get_post()->post_content; ?>
</article>

<?php
$category = get_post()->post_category[0];
$recommended_articles = query_posts("cat={$category}&posts_per_page=2") ?: [];
wp_reset_query();
?>
<aside class="article article__recommendations">
    <h1>mehr & much more</h1>
    <ul class="article__recommendations-list">
        <?php foreach ($recommended_articles as $recommended): ?>
        <li class="article__recommended-list-item">
            <a href="<?php echo get_permalink($recommended); ?>">
                <?php echo get_the_post_thumbnail($recommended) ?>
                <?php
                $custom = get_post_custom($recommended->ID) ?? [];
                $meta = $custom['article_author'] ?? [];
                $date = new DateTimeImmutable($recommended->post_date);
                $meta = array_merge([$date->format('d.m.Y')], $meta);
                ?>
                <span><?php echo implode(' / ', $meta); ?></span>

                <h2><?php echo $recommended->post_title; ?></h2>
                <p><?php echo $recommended->post_excerpt; ?></p>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</aside>
