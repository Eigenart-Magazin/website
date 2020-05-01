<?php
/* Template Name: AboutPage */

get_header();

$post = get_post();

echo $post->post_content;

get_footer();
