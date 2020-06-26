<?php

$parent_category = get_category_by_slug('gestern');

if (null === $parent_category) {
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

// Print header
get_header('category');

?>

<div class="category-gestern">
  <!-- Mobile only -->
  <nav class="category-gestern__mobile-navigation">
    <p><?php echo $parent_category->description; ?></p>
    <div class="archive">
      <span class="pill pill--inverted">archiv</span>
    </div>
    <div class="category">
      <a href="#print">
        <span class="pill">print<small>1991-2019</small></span>
      </a>
    </div>
    <div class="category">
      <a href="#digital">
        <span class="pill">digital<small>seit 2020</small></span>
      </a>
    </div>

  </nav>
  <a href="#" class="mobile-scroll-top">
    <img
      class="category__open-call-arrow"
      src="<?php echo get_theme_file_uri('/assets/images/short-white-arrow-right.png'); ?>"
      alt=""
    />
  </a>

  <header class="category-gestern__header">
    <div class="category-gestern__header--left">
      <span class="pill">print</span>
      <span class="pill">1991-2019</span>
    </div>
    <div class="category-gestern__header--right">
      <span class="pill">digital</span>
      <span class="pill">seit 2020</span>
    </div>
  </header>

  <div class="category-gestern__frames">
    <section class="gestern-print" id="print">
      <header>
        <span class="pill">print</span>
        <span class="pill">1991-2019</span>
      </header>

      <?php
      $print_category = get_category_by_slug('print');

      query_posts([
          'cat' => $print_category->cat_ID,
          'post_type' => 'post',
          'orderby' => 'date',
          'order' => 'DESC',
          'nopaging' => true,
      ]);
      ?>
      <ul>
        <?php while(have_posts()): the_post(); ?>
        <?php
        $year = get_post_datetime();
        if (false === $year) {
            $year = 'unknown';
        } else {
            $year = $year->format('Y');
        }

        ?>
        <li class="gestern-print__post">
          <div class="gestern-print__post-head">
            <span class="pill pill--inverted"><?php echo $year; ?></span>
            <h2><?php the_title(); ?></h2>

          </div>
          <!-- featured image -->
          <?php
              echo get_the_post_thumbnail($post, 'post-thumbnail', ['class' => 'gestern-print__post-cover']);
          ?>
          <!-- Paragraph -->
          <?php the_excerpt(); ?>

          <!-- Attachment download links -->
          <?php
          $attached_files = get_attached_media('*');

          $attachment = false;
          if (count($attached_files) > 0) {
              $attachment = array_shift($attached_files);
          }
          ?>
          <?php if ($attachment): ?>
          <?php
          $attachment_link = wp_get_attachment_url($attachment->ID);
          $file_size = filesize(get_attached_file($attachment->ID));
          ?>
          <span class="gestern-print__download">
            <a href="<?php echo $attachment_link; ?>">
              download file: <?php echo round($file_size / 1024 / 1024, 2); ?> Mb
            </a>
          </span>
          <?php endif; ?>

          <!-- Meta items -->
          <?php
          $editor = get_post_field('editor');
          $layout = get_post_field('layout');
          $copies = get_post_field('copies');
          ?>
          <?php if ($editor || $layout || $copies): ?>
          <div class="gestern-print__meta">
            <?php if ($editor): ?>
            <div class="gestern-print__meta-item">
              <span class="gestern-print__meta-item-title">Redaktionsleitung</span>
              <div><?php echo $editor; ?></div>
            </div>
            <?php endif; ?>

            <?php if ($layout): ?>
              <div class="gestern-print__meta-item">
                <span class="gestern-print__meta-item-title">Gestaltung</span>
                <div><?php echo $layout; ?></div>
              </div>
            <?php endif; ?>

            <?php if ($copies): ?>
            <div class="gestern-print__meta-item">
              <span class="gestern-print__meta-item-title">Auflage</span>
              <div><?php echo $copies; ?></div>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </li>
        <?php endwhile; ?>
      </ul>
    </section>
    <section class="gestern-digital" id="digital">
      <header>
        <span class="pill">digital</span>
        <span class="pill">seit 2020</span>
      </header>
    <?php
        $digital_category = get_category_by_slug('digital');
        $digital_categories = get_categories([
            'parent' => $digital_category->cat_ID,
            'orderby' => 'name',
            'order' => 'DESC'
        ]);
    ?>
    <ul>
      <?php foreach ($digital_categories as $digital_category): ?>
      <li class="gestern-digital__post">
        <?php
        // Fetch first post so we can present the year
        query_posts([
            'cat' => $digital_category->cat_ID,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'ASC',
            'nopaging' => true,
            'limit' => 1,
        ]);
        the_post();

        $year = the_date('Y', '', '', false);
        ?>
        <span class="pill pill--inverted"><?php echo $year; ?></span>
        <div>
          <h2><?php echo $digital_category->cat_name; ?></h2>
          <p><?php echo $digital_category->category_description; ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
    </section>
  </div>
</div>

<?php
wp_reset_query();

get_footer();
