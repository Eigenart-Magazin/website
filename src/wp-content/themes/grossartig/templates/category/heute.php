<article class="article article--heute">
    <h1 class="article__title"><?php the_title() ?></h1>

    <?php if(has_excerpt()): ?>
        <div class="article__excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>

    <span class="article__meta">
        <?php $date = get_post_datetime(); echo $date ? $date->format('d.m.Y') . ' / ' : ''; ?>
        <?php echo get_custom_field_or_alert('article_author', 'red'); ?>
    </span>

    <?php echo get_post()->post_content; ?>
</article>
