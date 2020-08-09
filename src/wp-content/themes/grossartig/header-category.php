<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
    @font-face {
      font-family: 'Founders';
      font-weight: 200;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/Founders\ Grotesk\ Light.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders';
      font-weight: 400;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/Founders\ Grotesk\ Regular.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders';
      font-weight: 600;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/Founders\ Grotesk\ Medium.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders';
      font-weight: 800;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/Founders\ Grotesk\ Semibold.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders Mono';
      font-weight: 200;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/FoundersGroteskMonoLight.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders Mono';
      font-weight: 400;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/FoundersGroteskMonoRegular.otf'); ?>');
    }

    @font-face {
      font-family: 'Founders Mono';
      font-weight: 600;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Founders/FoundersGroteskMonoMedium.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 200;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Light.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 200;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Light\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 500;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Regular.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 500;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 600;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Medium.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 600;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Medium\ Italic.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 900;
      font-style: normal;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Bold.otf'); ?>');
    }

    @font-face {
      font-family: 'Apercu';
      font-weight: 900;
      font-style: italic;
      src: url('<?php echo get_theme_file_uri('/assets/fonts/Apercu/Apercu\ Bold\ Italic.otf'); ?>');
    }
  </style>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript">
    function toggleMenu(button) {
        button.parentNode.classList.toggle('header__menu--active');
        var imgs = button.children;
        for (var i = 0; i < imgs.length; i++) {
          imgs[i].classList.toggle('header__menu-icon--hidden');
        }
    }
  </script>

  <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
</head>
<body>
<header class="header <?php echo 'header--type-' . get_post_type(); ?>">
  <a class="header__logo" href="<?php echo get_site_url(); ?>">
    <img
      src="<?php echo get_theme_file_uri('/assets/images/logo.png'); ?>"
      alt="<?php bloginfo('name'); ?>"
    >
  </a>


  <ul class="header__menu">
    <li class="header__menu-search search__input-wrapper">
      <a href="#" onclick="toggleSearch && toggleSearch();">
        <img
          src="<?php echo get_theme_file_uri("/assets/images/search-icon.png"); ?>"
          alt="Search"
        />
      </a>
      <form method="GET" action="<?php get_site_url(); ?>">
        <input class="search__input" type="text" name="s" placeholder="suchen..." autofocus>
        <button class="search__button">
          <img
            src="<?php echo get_theme_file_uri('/assets/images/search-icon-black.png'); ?>"
            alt="Search button"
          />
        </button>
      </form>
    </li>
    <?php foreach (wp_get_nav_menu_items('header-menu') ?: [] as $menu_item): ?>
    <li>
      <a href="<?php echo $menu_item->url ?: '#'; ?>">
        <?php $item = strtolower($menu_item->title); ?>
        <img
          src="<?php echo get_theme_file_uri("/assets/images/menu-{$item}.png"); ?>"
          alt="<?php echo $item; ?>"
        />
      </a>
    </li>
    <?php endforeach; ?>
    <button class="header__menu-button" onclick="toggleMenu(this)">
      <img
        class="header__menu-icon"
        src="<?php echo get_theme_file_uri('/assets/images/hamburger-menu-icon.png'); ?>"
        alt="Open Menu"
      />
      <img
        class="header__menu-icon header__menu-icon--hidden"
        src="<?php echo get_theme_file_uri('/assets/images/cross-icon.png'); ?>"
        alt="Close Menu"
      />
    </button>
  </ul>
</header>
<?php echo get_search_form(['echo' => false]); ?>
<main class="category-page">
