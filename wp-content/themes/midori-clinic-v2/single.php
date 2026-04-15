<?php get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Column</span>
      <h1 class="section-heading-jp">お役立ち情報</h1>
    </div>
  </div>
</div>

<div class="container">
  <?php midori_breadcrumb(); ?>
</div>

<section class="section section-white">
  <div class="container">
    <div class="blog-page-grid">
      <div class="blog-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-content">
          <div class="single-header">
            <div class="single-meta">
              <span><?php echo get_the_date('Y.m.d'); ?></span>
              <?php $cats = get_the_category(); if ($cats) : ?>
                <span class="cat" style="background:var(--color-bg-alt);padding:2px 10px;border-radius:2px;font-size:0.75rem;"><?php echo esc_html($cats[0]->name); ?></span>
              <?php endif; ?>
            </div>
            <h2 class="single-title"><?php the_title(); ?></h2>
          </div>

          <?php if (has_post_thumbnail()) : ?>
          <div class="single-thumbnail">
            <?php the_post_thumbnail('large'); ?>
          </div>
          <?php endif; ?>

          <div class="single-body">
            <?php the_content(); ?>
          </div>

          <nav class="single-nav">
            <div>
              <?php
              $prev = get_previous_post();
              if ($prev) :
              ?>
              <a href="<?php echo get_permalink($prev); ?>">&laquo; <?php echo esc_html(wp_trim_words($prev->post_title, 20)); ?></a>
              <?php endif; ?>
            </div>
            <div>
              <a href="<?php echo esc_url(home_url('/useful-info/')); ?>">記事一覧</a>
            </div>
            <div>
              <?php
              $next = get_next_post();
              if ($next) :
              ?>
              <a href="<?php echo get_permalink($next); ?>"><?php echo esc_html(wp_trim_words($next->post_title, 20)); ?> &raquo;</a>
              <?php endif; ?>
            </div>
          </nav>
        </article>
        <?php endwhile; endif; ?>
      </div>

      <?php get_sidebar(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
