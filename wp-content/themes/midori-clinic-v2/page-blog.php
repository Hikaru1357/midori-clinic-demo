<?php
/**
 * Template Name: お役立ち情報ページ
 * Description: ブログ一覧ページ
 */
get_header(); ?>

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
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $cat_filter = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 9,
          'paged' => $paged,
          'category__not_in' => array(get_cat_ID('お知らせ')),
          'orderby' => 'date',
          'order' => 'DESC',
        );
        if ($cat_filter > 0) {
          $args['cat'] = $cat_filter;
        }

        $blog_query = new WP_Query($args);

        if ($blog_query->have_posts()) : ?>
        <div class="blog-list-grid">
          <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
          <div class="blog-card">
            <div class="blog-card-img">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium_large'); ?>
              <?php else : ?>
                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>
            <div class="blog-card-body">
              <div class="blog-card-meta">
                <span><?php echo get_the_date('Y.m.d'); ?></span>
                <?php $cats = get_the_category(); if ($cats) : ?>
                  <span class="cat"><?php echo esc_html($cats[0]->name); ?></span>
                <?php endif; ?>
              </div>
              <h3 class="blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?></p>
            </div>
          </div>
          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
          <?php
          echo paginate_links(array(
            'total' => $blog_query->max_num_pages,
            'current' => $paged,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type' => 'plain',
          ));
          ?>
        </div>
        <?php wp_reset_postdata(); else : ?>
        <p style="text-align:center;color:var(--color-text-secondary);">記事がまだありません。</p>
        <?php endif; ?>
      </div>

      <?php get_sidebar(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
