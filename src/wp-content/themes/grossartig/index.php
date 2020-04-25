<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <h1><?php bloginfo('name'); ?></h1>
    <h2><?php bloginfo('description') ?></h2>

    <?php while (have_posts()): the_post(); ?>
    <h3><?php the_title(); ?></h3>

    <?php the_content(); ?>
    <?php wp_link_pages(); ?>

    <?php endwhile; ?>
</body>
</html>
