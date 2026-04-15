<?php
/**
 * Template Name: 診療科目ページ
 * Description: 消化器内科・内視鏡内科の2科目
 */
get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Medical</span>
      <h1 class="section-heading-jp">診療科目</h1>
    </div>
  </div>
</div>

<div class="container">
  <?php midori_breadcrumb(); ?>
</div>

<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <p class="clinic-intro"><?php echo nl2br(esc_html(midori_get('shinryou_intro', '当院では消化器内科・内視鏡内科を専門とし、食道・胃・大腸をはじめとする消化器疾患の診断・治療を行っております。最新の内視鏡設備を備え、苦痛の少ない検査で早期発見・早期治療に努めています。'))); ?></p>
    </div>

    <!-- 消化器内科 -->
    <div class="shinryou-section fade-in" id="shokaki">
      <div class="shinryou-img">
        <?php $img = get_theme_mod('shinryou_shokaki_image'); ?>
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="消化器内科">
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:320px;">消化器内科</div>
        <?php endif; ?>
      </div>
      <div class="shinryou-content">
        <h3>消化器内科</h3>
        <p><?php echo nl2br(esc_html(midori_get('shinryou_shokaki_text', '食道・胃・十二指腸・大腸・肝臓・胆のう・膵臓など、消化器全般の疾患を幅広く診療いたします。腹痛、胃もたれ、胸やけ、便秘・下痢、食欲不振などの症状がある方は、お気軽にご相談ください。ピロリ菌の検査・除菌治療も行っております。'))); ?></p>
        <div class="shinryou-diseases">
          <h4>主な対応疾患・症状</h4>
          <ul>
            <?php midori_render_list('shinryou_shokaki_diseases', "逆流性食道炎\n胃炎・胃潰瘍\n十二指腸潰瘍\nピロリ菌感染症\n過敏性腸症候群（IBS）\n潰瘍性大腸炎\n肝機能障害\n脂肪肝\n胆石症\n膵炎"); ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- 内視鏡内科 -->
    <div class="shinryou-section reverse fade-in" id="naishikyo">
      <div class="shinryou-img">
        <?php $img = get_theme_mod('shinryou_naishikyo_image'); ?>
        <?php if ($img) : ?>
          <img src="<?php echo esc_url($img); ?>" alt="内視鏡内科">
        <?php else : ?>
          <div class="placeholder-img" style="width:100%;height:320px;">内視鏡内科</div>
        <?php endif; ?>
      </div>
      <div class="shinryou-content">
        <h3>内視鏡内科</h3>
        <p><?php echo nl2br(esc_html(midori_get('shinryou_naishikyo_text', '胃カメラ（上部消化管内視鏡）や大腸カメラ（下部消化管内視鏡）による精密検査を行っています。鎮静剤を使用し、苦痛の少ない検査を心がけております。ポリープが見つかった場合は、その場で日帰り切除も可能です（大きさ・形状による）。'))); ?></p>
        <div class="shinryou-diseases">
          <h4>主な検査・対応疾患</h4>
          <ul>
            <?php midori_render_list('shinryou_naishikyo_diseases', "胃カメラ検査（経鼻・経口）\n大腸カメラ検査\n大腸ポリープ日帰り切除\n早期胃がん・大腸がんの発見\nバレット食道\n胃粘膜下腫瘍\n炎症性腸疾患の評価\n消化管出血の精査"); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="fp-cta">
  <div class="container">
    <div class="fade-in">
      <h2>お気軽にご相談ください</h2>
      <p>消化器の不調や内視鏡検査のご予約は、お電話にて承ります。</p>
      <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="cta-tel-btn">
        <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
        <?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
