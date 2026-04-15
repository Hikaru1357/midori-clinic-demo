<?php
/**
 * Template Name: クリニック紹介ページ
 * Description: クリニック紹介・設備・アクセス
 */
get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Clinic</span>
      <h1 class="section-heading-jp">クリニック紹介</h1>
    </div>
  </div>
</div>

<div class="container">
  <?php midori_breadcrumb(); ?>
</div>

<!-- Intro -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <p class="clinic-intro"><?php echo nl2br(esc_html(midori_get('clinic_intro_text', '当院は、消化器内科・内視鏡内科を専門とするクリニックです。清潔で落ち着いた空間と最新の医療設備で、患者様に安心して検査・治療を受けていただける環境を整えております。'))); ?></p>
    </div>
  </div>
</section>

<!-- Exterior -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Exterior</span>
        <h2 class="section-heading-jp">外観</h2>
      </div>
    </div>
    <div class="clinic-exterior-grid fade-in">
      <?php for ($i = 1; $i <= 2; $i++) :
        $img = get_theme_mod("clinic_exterior_image{$i}");
      ?>
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="クリニック外観<?php echo $i; ?>">
        <?php else : ?>
          <div class="placeholder-img" style="height:320px;">外観写真 <?php echo $i; ?></div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- Interior -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Interior</span>
        <h2 class="section-heading-jp">院内風景</h2>
      </div>
    </div>
    <div class="clinic-interior-grid fade-in">
      <?php
      $interior_defaults = array(
        '受付・待合室', '診察室', '内視鏡室', 'リカバリールーム', '廊下・通路',
      );
      for ($i = 1; $i <= 5; $i++) :
        $img = get_theme_mod("clinic_interior_image{$i}");
        $label = midori_get("clinic_interior_label{$i}", $interior_defaults[$i - 1]);
      ?>
      <div class="clinic-interior-item">
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($label); ?>">
        <?php else : ?>
          <div class="placeholder-img" style="height:220px;"><?php echo esc_html($label); ?></div>
        <?php endif; ?>
        <div class="label"><?php echo esc_html($label); ?></div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- Equipment -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Equipment</span>
        <h2 class="section-heading-jp">医療設備</h2>
      </div>
    </div>
    <div class="clinic-equip-grid fade-in">
      <?php
      $equip_defaults = array(
        array('内視鏡システム EVIS X1', '最新の高精細内視鏡で微小な病変も発見'),
        array('炭酸ガス送気装置', '検査後のお腹の張りを大幅に軽減'),
        array('超音波診断装置', '腹部臓器をリアルタイムで観察'),
        array('デジタルX線撮影装置', '低被ばくで鮮明な画像を撮影'),
      );
      for ($i = 1; $i <= 4; $i++) :
        $img = get_theme_mod("clinic_equip{$i}_image");
        $title = midori_get("clinic_equip{$i}_title", $equip_defaults[$i - 1][0]);
        $text = midori_get("clinic_equip{$i}_text", $equip_defaults[$i - 1][1]);
      ?>
      <div class="clinic-equip-card">
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
        <?php else : ?>
          <div class="placeholder-img" style="height:180px;"><?php echo esc_html($title); ?></div>
        <?php endif; ?>
        <div class="clinic-equip-card-body">
          <h4><?php echo esc_html($title); ?></h4>
          <p><?php echo esc_html($text); ?></p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- Access -->
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

        <div style="margin-top:32px;">
          <h4 style="font-size:0.9375rem;margin-bottom:12px;color:var(--color-primary);">交通アクセス</h4>
          <ul style="font-size:0.875rem;color:var(--color-text-secondary);">
            <?php midori_render_list('clinic_access_transport', "東京メトロ銀座線・半蔵門線「青山一丁目」駅 4番出口 徒歩3分\n都営大江戸線「青山一丁目」駅 徒歩5分"); ?>
          </ul>
        </div>

        <div style="margin-top:20px;">
          <h4 style="font-size:0.9375rem;margin-bottom:12px;color:var(--color-primary);">周辺の目印</h4>
          <ul style="font-size:0.875rem;color:var(--color-text-secondary);">
            <?php midori_render_list('clinic_access_landmarks', "○○銀行の隣のビル3階\n1階に△△薬局があるビルです"); ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Timetable -->
    <div class="fade-in" style="margin-top:60px;">
      <div class="section-heading">
        <span class="section-heading-en">Hours</span>
        <h2 class="section-heading-jp">診療時間</h2>
      </div>
      <div style="max-width:700px;margin:0 auto;">
        <?php midori_timetable(); ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
