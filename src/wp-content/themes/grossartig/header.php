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

    function galleryOnClickPrevious(button) {
        var gallery = button.parentElement.querySelector('ul');
        var scrollX = gallery.scrollWidth / gallery.childElementCount;
        gallery.scroll({ left: gallery.scrollLeft - scrollX, behavior: 'smooth' });
    }

    function galleryOnClickNext(button) {
        var gallery = button.parentElement.querySelector('ul');
        var scrollX = gallery.scrollWidth / gallery.childElementCount;
        gallery.scroll({ left: gallery.scrollLeft + scrollX, behavior: 'smooth' });
    }

    window.addEventListener('DOMContentLoaded', function () {
        var galleries = Array.prototype.slice.apply(document.querySelectorAll('.wp-block-gallery'));

        for (var i = 0; i < galleries.length; i++) {
            var gallery = galleries[i];
            var columns = 1;
            if (gallery.classList.contains('columns-2')) {
                columns = 2;
            } else if (gallery.classList.contains('columns-3')) {
                columns = 3;
            } else if (gallery.classList.contains('columns-4')) {
                columns = 4;
            } else if (gallery.classList.contains('columns-5')) {
                columns = 5;
            }

            var elements = gallery.querySelector('.blocks-gallery-grid').childElementCount;
            if (elements === columns) {
                gallery.querySelector('.gallery__button--left').style.display = 'none';
                gallery.querySelector('.gallery__button--right').style.display = 'none';
            }
        }
    });
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

  <?php if (!in_array(pathinfo(get_page_template(), PATHINFO_FILENAME), ['HomePage', 'AboutPage'])): ?>
  <ul class="header__menu">
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
  <?php endif; ?>
</header>
<main>
<?php if ('HomePage' === pathinfo(get_page_template(), PATHINFO_FILENAME)): ?>
<span class="home-headline">
  Das Studierendenmagazin der Universität der Künste Berlin
</span>
<?php endif; ?>
