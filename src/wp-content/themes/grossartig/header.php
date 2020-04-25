<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>
<header class="header <?php echo 'header--type-' . get_post_type(); ?>">
  <img
    src="<?php echo get_theme_file_uri('/assets/images/logo.png'); ?>"
    alt="<?php bloginfo('name'); ?>"
  >
</header>
<main>
