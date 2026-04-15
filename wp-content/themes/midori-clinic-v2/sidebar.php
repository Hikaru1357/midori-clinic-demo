<aside class="sidebar">
  <!-- Categories -->
  <div class="sidebar-widget">
    <h3>カテゴリー</h3>
    <ul>
      <?php
      $categories = get_categories(array(
        'exclude' => get_cat_ID('お知らせ'),
        'hide_empty' => false,
      ));
      if ($categories) :
        foreach ($categories as $cat) :
      ?>
      <li>
        <a href="<?php echo esc_url(home_url('/useful-info/?cat=' . $cat->term_id)); ?>">
          <?php echo esc_html($cat->name); ?>
          <span style="float:right;color:var(--color-text-secondary);">(<?php echo $cat->count; ?>)</span>
        </a>
      </li>
      <?php endforeach; else : ?>
      <li><a href="#">健康コラム</a></li>
      <li><a href="#">検査のご案内</a></li>
      <li><a href="#">消化器の病気</a></li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- Recent Posts -->
  <div class="sidebar-widget">
    <h3>最近の記事</h3>
    <ul>
      <?php
      $recent = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'category__not_in' => array(get_cat_ID('お知らせ')),
      ));
      if ($recent->have_posts()) :
        while ($recent->have_posts()) : $recent->the_post();
      ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endwhile; wp_reset_postdata(); else : ?>
      <li><a href="#">胃カメラ検査を受ける前に知っておきたいこと</a></li>
      <li><a href="#">ピロリ菌と胃がんの関係について</a></li>
      <li><a href="#">大腸がん検診の重要性</a></li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- Timetable -->
  <div class="sidebar-widget">
    <h3>診療時間</h3>
    <?php midori_timetable(); ?>
  </div>
</aside>
