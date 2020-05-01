<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
    @font-face {
      font-family: 'Apercu';
      font-weight: 200;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Light.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 200;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Light\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 500;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Regular.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 500;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 600;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Medium.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 600;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Medium\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 900;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Bold.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 900;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu\ Bold\ Italic.otf'); ?>');
    }
  </style>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

  <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
</head>
<body>
<header class="header <?php echo 'header--type-' . get_post_type(); ?>">
  <a href="<?php echo get_site_url(); ?>">
    <img
      src="<?php echo get_theme_file_uri('/assets/images/logo.png'); ?>"
      alt="<?php bloginfo('name'); ?>"
    >
  </a>
</header>
<main>
