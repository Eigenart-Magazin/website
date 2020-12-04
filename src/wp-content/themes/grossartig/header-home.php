<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>Eigenart Magazine</title>

  <meta name="description" content="Spore Initiative">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
  <link rel="shortcut icon" href="<?php echo get_theme_file_uri('/assets/images/favicon.png') ?>">

  <meta property="og:site_name" content="Eigenart Magazine" />
  <meta property="og:title" content="Eigenart Magazine" />
  <meta property="og:type" content="website" />

  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/home.css'; ?>">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>

  <?php if (\GrossArtig\is_dev_mode_on() === false): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168196029-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-168196029-1');
    </script>
  <?php endif; ?>
</head>

<body class="iffs-debug">
<header class="logo">
  <a class="header-logo" href="/">
    <img class="logo" src="<?php echo get_theme_file_uri('/assets/images/eigenart-logo.svg') ?>" alt="eigenart">
  </a>

  <span class="home-headline">
    <p class="pill">Das Studierendenmagazin der Universität der Künste Berlin</p>
  </span>
</header>
