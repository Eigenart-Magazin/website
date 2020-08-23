<?php
/* Template Name: AboutPage */

get_header('category');

$post = get_post();

?>

<article class="about article">
  <div class="article__content">
    <?php echo $post->post_content; ?>
  </div>
</article>

<?php
get_footer();
