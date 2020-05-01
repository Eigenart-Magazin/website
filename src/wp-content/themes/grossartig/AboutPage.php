<?php
/* Template Name: AboutPage */

get_header();

$post = get_post();

?>

<article class="about">
  <?php echo $post->post_content; ?>
</article>

<?php
get_footer();
