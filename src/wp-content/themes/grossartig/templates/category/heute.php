<article class="article article--heute">
    <span class="article__author">
        <?php echo get_custom_field_or_alert('article_author', 'red'); ?>
    </span>

    <h1 class="article__title"><?php the_title() ?></h1>

    <?php if(has_excerpt()): ?>
        <?php the_excerpt(); ?>
    <?php endif; ?>

    <?php echo get_post()->post_content; ?>
</article>
