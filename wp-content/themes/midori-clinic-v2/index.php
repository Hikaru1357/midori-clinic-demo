<?php get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Contents</span>
      <h1 class="section-heading-jp"><?php wp_title('', true); ?></h1>
    </div>
  </div>
</div>

<section class="section section-white">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article>
        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php get_footer(); ?>
