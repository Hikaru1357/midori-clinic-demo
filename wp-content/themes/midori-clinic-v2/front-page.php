<?php
/**
 * Template Name: トップページ（テンプレート）
 * Description: 竹プラン：トップページテンプレート（消化器・内視鏡専門）
 */
get_header(); ?>

<!-- ========== Hero Slider ========== -->
<section class="hero-slider-section">
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      <?php for ($i = 1; $i <= 3; $i++) :
        $img = get_theme_mod("hero_image{$i}");
      ?>
      <div class="swiper-slide">
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="ファーストビュー画像<?php echo $i; ?>">
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:100%;">
            <span>スライド画像 <?php echo $i; ?><br>1920 x 800 推奨</span>
          </div>
        <?php endif; ?>
      </div>
      <?php endfor; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <div class="hero-overlay"></div>

  <div class="hero-content">
    <div class="hero-content-inner">
      <p class="hero-subtitle"><?php echo esc_html(midori_get('hero_subtitle', 'Gastroenterology & Endoscopy')); ?></p>
      <h1 class="hero-heading">
        <span><?php echo esc_html(midori_get('hero_heading_line1', '患者様に寄り添った')); ?></span>
        <span><?php echo esc_html(midori_get('hero_heading_line2', '安心の内視鏡検査を')); ?></span>
      </h1>
      <p class="hero-desc"><?php echo nl2br(esc_html(midori_get('hero_description', "最新鋭の内視鏡システムと豊富な経験を持つ専門医が\n苦痛の少ない検査で、あなたの健康をお守りします。"))); ?></p>
    </div>
  </div>

  <!-- Hero Timetable (PC only) -->
  <div class="hero-timetable">
    <h3>診療時間</h3>
    <?php midori_timetable(); ?>
  </div>
</section>

<!-- ========== News ========== -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">News</span>
        <h2 class="section-heading-jp">お知らせ</h2>
      </div>
    </div>
    <div class="fade-in">
      <div class="fp-news-list">
        <?php
        $news_query = new WP_Query(array(
          'post_type' => 'post',
          'category_name' => 'news',
          'posts_per_page' => 4,
          'orderby' => 'date',
          'order' => 'DESC',
        ));
        if ($news_query->have_posts()) :
          while ($news_query->have_posts()) : $news_query->the_post();
        ?>
        <a href="<?php the_permalink(); ?>" class="fp-news-item">
          <span class="fp-news-date"><?php echo get_the_date('Y.m.d'); ?></span>
          <span class="fp-news-cat">
            <?php
            $cats = get_the_category();
            echo $cats ? esc_html($cats[0]->name) : 'お知らせ';
            ?>
          </span>
          <span class="fp-news-title"><?php the_title(); ?></span>
        </a>
        <?php
          endwhile;
          wp_reset_postdata();
        else :
        ?>
          <a href="#" class="fp-news-item">
            <span class="fp-news-date">2026.04.01</span>
            <span class="fp-news-cat">お知らせ</span>
            <span class="fp-news-title">ホームページを開設いたしました</span>
          </a>
          <a href="#" class="fp-news-item">
            <span class="fp-news-date">2026.03.15</span>
            <span class="fp-news-cat">お知らせ</span>
            <span class="fp-news-title">内視鏡検査のWEB予約を開始しました</span>
          </a>
          <a href="#" class="fp-news-item">
            <span class="fp-news-date">2026.03.01</span>
            <span class="fp-news-cat">お知らせ</span>
            <span class="fp-news-title">最新内視鏡システム EVIS X1 を導入しました</span>
          </a>
          <a href="#" class="fp-news-item">
            <span class="fp-news-date">2026.02.15</span>
            <span class="fp-news-cat">お知らせ</span>
            <span class="fp-news-title">大腸カメラ検査の鎮静剤対応を開始いたしました</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ========== Features ========== -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Features</span>
        <h2 class="section-heading-jp">当院の特長</h2>
      </div>
    </div>
    <div class="fp-features fade-in">
      <?php
      $features = array(
        array(
          'num' => 'Feature 01',
          'title' => midori_get('feature1_title', '経験豊富な専門医'),
          'text' => midori_get('feature1_text', '消化器内視鏡専門医が全ての検査を担当。年間1,000件以上の実績があります。'),
          'icon' => '<svg viewBox="0 0 24 24"><path d="M12 2a5 5 0 015 5v1a5 5 0 01-10 0V7a5 5 0 015-5zm-7 18a7 7 0 0114 0H5z"/></svg>',
        ),
        array(
          'num' => 'Feature 02',
          'title' => midori_get('feature2_title', '苦痛の少ない検査'),
          'text' => midori_get('feature2_text', '鎮静剤を使用した検査で、眠っている間に検査が終了。不安なく受けていただけます。'),
          'icon' => '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
        ),
        array(
          'num' => 'Feature 03',
          'title' => midori_get('feature3_title', '最新の内視鏡設備'),
          'text' => midori_get('feature3_text', 'オリンパス最新内視鏡システムEVIS X1を導入。高精細な画像で早期発見に貢献します。'),
          'icon' => '<svg viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58a.49.49 0 00.12-.61l-1.92-3.32a.49.49 0 00-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94L14.4 2.81a.49.49 0 00-.48-.41h-3.84c-.24 0-.43.17-.47.41L9.25 5.35c-.59.24-1.13.57-1.62.94l-2.39-.96a.49.49 0 00-.59.22L2.73 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58a.49.49 0 00-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6A3.6 3.6 0 1115.6 12 3.6 3.6 0 0112 15.6z"/></svg>',
        ),
      );
      foreach ($features as $f) : ?>
      <div class="fp-feature-card">
        <div class="fp-feature-num"><?php echo esc_html($f['num']); ?></div>
        <div class="fp-feature-icon"><?php echo $f['icon']; ?></div>
        <h3><?php echo esc_html($f['title']); ?></h3>
        <p><?php echo esc_html($f['text']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ========== Greeting ========== -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Greeting</span>
        <h2 class="section-heading-jp">院長ご挨拶</h2>
      </div>
    </div>
    <div class="fp-greeting fade-in">
      <div class="fp-greeting-img">
        <?php $greeting_img = get_theme_mod('greeting_doctor_image'); ?>
        <?php if ($greeting_img) : ?>
          <img src="<?php echo esc_url($greeting_img); ?>" alt="院長">
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:400px;">院長写真</div>
        <?php endif; ?>
      </div>
      <div class="fp-greeting-text">
        <h3><?php echo nl2br(esc_html(midori_get('greeting_heading', "地域の皆様の\n「おなかの健康」を守ります"))); ?></h3>
        <p><?php echo nl2br(esc_html(midori_get('greeting_text1', '当院は消化器内科・内視鏡内科を専門とするクリニックです。「胃が痛い」「お腹の調子が悪い」といった日常的な消化器症状から、胃カメラ・大腸カメラによる精密検査まで、幅広く対応しております。'))); ?></p>
        <p><?php echo nl2br(esc_html(midori_get('greeting_text2', '患者様お一人おひとりに丁寧に向き合い、わかりやすい説明と苦痛の少ない検査で、安心して受診いただける環境づくりに努めてまいります。'))); ?></p>
        <p style="font-size:0.8125rem;color:var(--color-text-secondary);margin-top:4px;">※当サイトはデモサイトです。実在するクリニックではありません。</p>
        <div class="fp-greeting-sign">
          <span class="role">院長</span><br>
          <span class="name"><?php echo esc_html(midori_get('doctor_name', '緑川 太郎')); ?></span>
        </div>
        <div style="margin-top:24px;">
          <a href="<?php echo esc_url(home_url('/doctor/')); ?>" class="btn btn-outline btn-sm btn-arrow">ドクター紹介</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== Medical Departments ========== -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Medical</span>
        <h2 class="section-heading-jp">診療科目</h2>
      </div>
    </div>
    <div class="fp-dept-grid fade-in">
      <?php
      $depts = array(
        array(
          'slug' => 'shokaki',
          'name' => '消化器内科',
          'desc' => '食道・胃・大腸・肝臓・胆のう・膵臓など消化器全般の診断・治療を行います。腹痛、胃もたれ、便秘・下痢などお気軽にご相談ください。',
          'icon' => '<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1a2 2 0 002 2v1.93zm6.9-2.54A1.99 1.99 0 0016 16h-1v-3a1 1 0 00-1-1H8v-2h2a1 1 0 001-1V7h2a2 2 0 002-2v-.41A7.997 7.997 0 0120 12c0 2.08-.8 3.97-2.1 5.39z" fill="currentColor"/></svg>',
        ),
        array(
          'slug' => 'naishikyo',
          'name' => '内視鏡内科',
          'desc' => '胃カメラ・大腸カメラによる精密検査を行います。鎮静剤使用で苦痛を軽減。早期発見・早期治療に取り組んでいます。',
          'icon' => '<svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/></svg>',
        ),
      );
      foreach ($depts as $d) :
        $img = get_theme_mod("shinryou_{$d['slug']}_image");
      ?>
      <a href="<?php echo esc_url(home_url('/shinryou/#' . $d['slug'])); ?>" class="fp-dept-card">
        <div class="fp-dept-card-img">
          <?php if ($img) : ?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($d['name']); ?>">
          <?php else : ?>
            <div class="placeholder-img" style="width:100%;height:100%;"><?php echo esc_html($d['name']); ?></div>
          <?php endif; ?>
          <div class="dept-label">
            <h4><?php echo esc_html($d['name']); ?></h4>
          </div>
        </div>
        <div class="fp-dept-card-body">
          <p><?php echo esc_html($d['desc']); ?></p>
          <span class="dept-more">詳しく見る →</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ========== Timetable & Visit Info ========== -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Information</span>
        <h2 class="section-heading-jp">診療時間・ご来院の方へ</h2>
      </div>
    </div>
    <div class="fp-schedule fade-in">
      <div class="fp-timetable-wrap">
        <?php midori_timetable(); ?>
      </div>
      <div class="fp-visit-info">
        <h3>ご来院の方へ</h3>
        <dl>
          <dt>初診の方</dt>
          <dd><?php echo wp_kses_post(midori_get('visit_info_firstvisit', '保険証をお持ちの上、受付時間内にお越しください。')); ?></dd>
          <dt>受付時間</dt>
          <dd><?php echo wp_kses_post(midori_get('visit_info_reception', '午前 9:00〜12:00 / 午後 14:00〜17:30')); ?></dd>
          <dt>予約について</dt>
          <dd><?php echo wp_kses_post(midori_get('visit_info_reservation', '内視鏡検査は完全予約制です。お電話またはWEB予約をご利用ください。')); ?></dd>
          <dt>お支払い方法</dt>
          <dd><?php echo wp_kses_post(midori_get('visit_info_payment', '各種保険取扱い・各種クレジットカード対応')); ?></dd>
        </dl>
      </div>
    </div>
  </div>
</section>

<!-- ========== Blog / Useful Info ========== -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Column</span>
        <h2 class="section-heading-jp">お役立ち情報</h2>
      </div>
      <p class="section-desc">消化器の健康に関する情報をわかりやすくお届けします。</p>
    </div>
    <div class="blog-grid fade-in">
      <?php
      $blog_query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'category__not_in' => array(get_cat_ID('お知らせ')),
        'orderby' => 'date',
        'order' => 'DESC',
      ));
      if ($blog_query->have_posts()) :
        while ($blog_query->have_posts()) : $blog_query->the_post();
      ?>
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
          <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?></p>
        </div>
      </div>
      <?php
        endwhile;
        wp_reset_postdata();
      else :
        $dummy_blogs = array(
          array('title' => '胃カメラ検査を受ける前に知っておきたいこと', 'cat' => '検査のご案内', 'img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop'),
          array('title' => 'ピロリ菌と胃がんの関係について', 'cat' => '消化器の病気', 'img' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=600&h=400&fit=crop'),
          array('title' => '大腸がん検診の重要性と検査の流れ', 'cat' => '検査のご案内', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop'),
        );
        foreach ($dummy_blogs as $blog) :
      ?>
      <div class="blog-card">
        <div class="blog-card-img">
          <img src="<?php echo esc_url($blog['img']); ?>" alt="<?php echo esc_attr($blog['title']); ?>">
        </div>
        <div class="blog-card-body">
          <div class="blog-card-meta">
            <span>2026.03.10</span>
            <span class="cat"><?php echo esc_html($blog['cat']); ?></span>
          </div>
          <h3 class="blog-card-title"><a href="#"><?php echo esc_html($blog['title']); ?></a></h3>
          <p class="blog-card-excerpt">消化器の健康に関する情報をわかりやすくお伝えします。日々の生活で気をつけるべきポイントや、検査を受けるタイミングについて解説します。</p>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
    <div class="fp-news-more fade-in">
      <a href="<?php echo esc_url(home_url('/useful-info/')); ?>" class="btn btn-outline btn-arrow">記事一覧を見る</a>
    </div>
  </div>
</section>

<!-- ========== Access ========== -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Access</span>
        <h2 class="section-heading-jp">アクセス</h2>
      </div>
    </div>
    <div class="fp-access fade-in">
      <div class="fp-access-map">
        <?php $map_url = midori_get('google_maps_embed_url', ''); ?>
        <?php if ($map_url) : ?>
          <iframe src="<?php echo esc_url($map_url); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:100%;">Google Map</div>
        <?php endif; ?>
      </div>
      <div class="fp-access-info">
        <h3><?php echo esc_html(midori_get('clinic_name', 'みどり内科クリニック')); ?></h3>
        <table class="fp-access-table">
          <tr>
            <th>住所</th>
            <td><?php echo nl2br(esc_html(midori_get('clinic_address_full', "〒107-0062\n東京都港区南青山1-2-3\nメディカルビル3F"))); ?></td>
          </tr>
          <tr>
            <th>電話</th>
            <td><a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>"><?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?></a></td>
          </tr>
          <tr>
            <th>最寄駅</th>
            <td><?php echo esc_html(midori_get('clinic_nearest_station', '東京メトロ 青山一丁目駅 徒歩3分')); ?></td>
          </tr>
          <tr>
            <th>駐車場</th>
            <td><?php echo esc_html(midori_get('clinic_parking', '提携駐車場あり（2時間まで無料）')); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- ========== CTA ========== -->
<section class="fp-cta">
  <div class="container">
    <div class="fade-in">
      <h2><?php echo esc_html(midori_get('cta_heading', 'まずはお気軽にご相談ください')); ?></h2>
      <p><?php echo esc_html(midori_get('cta_text', '消化器の不調や内視鏡検査について、お気軽にお電話ください。')); ?></p>
      <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="cta-tel-btn">
        <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
        <?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?>
      </a>
      <p class="cta-hours"><?php echo esc_html(midori_get('reception_note', '受付は診療終了30分前まで')); ?></p>
    </div>
  </div>
</section>

<?php get_footer(); ?>
