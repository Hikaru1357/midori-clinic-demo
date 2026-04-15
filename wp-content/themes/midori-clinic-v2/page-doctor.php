<?php
/**
 * Template Name: ドクター紹介ページ
 * Description: 院長プロフィール・診療方針
 */
get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Doctor</span>
      <h1 class="section-heading-jp">ドクター紹介</h1>
    </div>
  </div>
</div>

<div class="container">
  <?php midori_breadcrumb(); ?>
</div>

<!-- Profile -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Profile</span>
        <h2 class="section-heading-jp">院長プロフィール</h2>
      </div>
    </div>
    <div class="doctor-profile fade-in">
      <div class="doctor-photo">
        <?php $photo = get_theme_mod('doctor_photo'); ?>
        <?php if ($photo) : ?>
          <img src="<?php echo esc_url($photo); ?>" alt="院長 <?php echo esc_attr(midori_get('doctor_name', '緑川 太郎')); ?>">
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:480px;">院長写真</div>
        <?php endif; ?>
      </div>
      <div class="doctor-info">
        <div class="doctor-name-area">
          <h3>院長 <?php echo esc_html(midori_get('doctor_name', '緑川 太郎')); ?></h3>
          <p class="name-en"><?php echo esc_html(midori_get('doctor_name_en', 'Taro Midorikawa')); ?></p>
        </div>

        <div class="doctor-message">
          <?php echo nl2br(esc_html(midori_get('doctor_message', "消化器疾患でお悩みの患者様に、専門的な知識と最新の医療技術を用いて、安全で苦痛の少ない検査・治療をご提供したいと考えております。\n\n「お腹の調子が悪い」「検査が怖い」そんな不安をお持ちの方も、まずはお気軽にご相談ください。患者様一人ひとりに丁寧に向き合い、わかりやすい説明を心がけています。"))); ?>
        </div>

        <div class="doctor-details">
          <div class="doctor-detail-section">
            <h4>経歴</h4>
            <ul>
              <?php midori_render_list('doctor_career', "2000年 東京大学医学部卒業\n2000年 東京大学医学部附属病院 研修医\n2002年 同 消化器内科 入局\n2008年 国立がん研究センター 消化器内視鏡科\n2015年 みどり内科クリニック 開院"); ?>
            </ul>
          </div>
          <div class="doctor-detail-section">
            <h4>資格・認定</h4>
            <ul>
              <?php midori_render_list('doctor_qualifications', "日本内科学会 認定内科医\n日本消化器内視鏡学会 専門医・指導医\n日本消化器病学会 専門医\n日本肝臓学会 専門医"); ?>
            </ul>
          </div>
          <div class="doctor-detail-section">
            <h4>所属学会</h4>
            <ul>
              <?php midori_render_list('doctor_societies', "日本内科学会\n日本消化器内視鏡学会\n日本消化器病学会\n日本肝臓学会"); ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Policy -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Policy</span>
        <h2 class="section-heading-jp">診療方針</h2>
      </div>
    </div>
    <div class="doctor-policies fade-in">
      <?php
      $policies = array(
        array(
          'title' => midori_get('policy1_title', '丁寧な説明と対話'),
          'text' => midori_get('policy1_text', '検査前後に画像を見ながら、わかりやすくご説明いたします。不安や疑問があればいつでもご質問ください。'),
        ),
        array(
          'title' => midori_get('policy2_title', '苦痛の少ない検査'),
          'text' => midori_get('policy2_text', '鎮静剤の使用や経鼻内視鏡など、患者様の負担を最小限にする検査方法をご提案します。'),
        ),
        array(
          'title' => midori_get('policy3_title', '早期発見・早期治療'),
          'text' => midori_get('policy3_text', '最新の内視鏡設備で微小な病変も見逃さず、早期発見・早期治療につなげます。'),
        ),
      );
      foreach ($policies as $idx => $p) : ?>
      <div class="doctor-policy-card">
        <div class="doctor-policy-num"><?php echo sprintf('%02d', $idx + 1); ?></div>
        <h4><?php echo esc_html($p['title']); ?></h4>
        <p><?php echo esc_html($p['text']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
