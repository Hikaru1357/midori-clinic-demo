<?php
/**
 * Template Name: 検査ページ
 * Description: 内視鏡検査に特化した検査ページ
 */
get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Examination</span>
      <h1 class="section-heading-jp">検査のご案内</h1>
    </div>
  </div>
</div>

<div class="container">
  <?php midori_breadcrumb(); ?>
</div>

<!-- Highlights -->
<section class="section section-white">
  <div class="container">
    <div class="kensa-highlights fade-in">
      <?php
      $highlights = array(
        array(
          'num' => 'Point 01',
          'title' => midori_get('kensa_highlight1_title', '消化器内視鏡専門医が担当'),
          'text' => midori_get('kensa_highlight1_text', '全ての内視鏡検査を経験豊富な消化器内視鏡専門医が実施します。'),
        ),
        array(
          'num' => 'Point 02',
          'title' => midori_get('kensa_highlight2_title', '鎮静剤使用で苦痛を軽減'),
          'text' => midori_get('kensa_highlight2_text', 'ご希望の方には鎮静剤を使用し、眠っている間に検査を行います。'),
        ),
        array(
          'num' => 'Point 03',
          'title' => midori_get('kensa_highlight3_title', '最新の内視鏡システム'),
          'text' => midori_get('kensa_highlight3_text', 'EVIS X1を導入。高精細画像で微小な病変も見逃しません。'),
        ),
      );
      foreach ($highlights as $h) : ?>
      <div class="kensa-highlight-card">
        <div class="kensa-highlight-num"><?php echo esc_html($h['num']); ?></div>
        <h3><?php echo esc_html($h['title']); ?></h3>
        <p><?php echo esc_html($h['text']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Exam Tabs -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Examinations</span>
        <h2 class="section-heading-jp">検査メニュー</h2>
      </div>
    </div>

    <div class="fade-in">
      <?php
      $kensa_types = array(
        'endo' => '胃カメラ',
        'colon' => '大腸カメラ',
        'echo' => '腹部エコー',
        'blood' => '血液検査',
        'xray' => 'レントゲン',
        'health' => '健康診断',
      );
      $kensa_defaults = array(
        'endo' => array(
          'text' => '経鼻・経口のどちらにも対応しております。鎮静剤を使用することで、苦痛なく検査を受けていただけます。食道・胃・十二指腸の病変を高精細な画像で観察し、必要に応じて組織を採取して病理検査を行います。',
          'tags' => '完全予約制,経鼻対応,鎮静剤使用可',
          'time' => '約10〜15分',
          'cost' => '約4,000〜10,000円（3割負担）',
          'result' => '当日説明・病理は約1週間',
        ),
        'colon' => array(
          'text' => '大腸の内部を直接観察し、ポリープやがん、炎症性疾患の有無を確認します。検査中にポリープが見つかった場合は、大きさや形状に応じてその場で切除（日帰りポリープ切除）が可能です。',
          'tags' => '完全予約制,日帰りポリープ切除可,鎮静剤使用可',
          'time' => '約20〜30分',
          'cost' => '約5,000〜20,000円（3割負担）',
          'result' => '当日説明・病理は約1週間',
        ),
        'echo' => array(
          'text' => '超音波を用いて肝臓・胆のう・膵臓・腎臓・脾臓などの腹部臓器を観察する検査です。痛みがなく、放射線被ばくもないため安全に受けていただけます。',
          'tags' => '予約優先,痛みなし,被ばくなし',
          'time' => '約15〜20分',
          'cost' => '約1,500〜2,500円（3割負担）',
          'result' => '当日説明',
        ),
        'blood' => array(
          'text' => '貧血、肝機能、腎機能、脂質、血糖、腫瘍マーカーなど幅広い検査項目に対応しています。健康診断での異常値の再検査もお受けしています。',
          'tags' => '予約不要,当日対応可',
          'time' => '採血自体は約5分',
          'cost' => '検査項目により異なります',
          'result' => '約3〜7日',
        ),
        'xray' => array(
          'text' => '胸部や腹部のレントゲン撮影を行い、肺や腹部の異常を確認します。デジタルX線を導入しており、低被ばくで鮮明な画像が得られます。',
          'tags' => '予約不要,当日対応可',
          'time' => '約5分',
          'cost' => '約1,000〜2,000円（3割負担）',
          'result' => '当日説明',
        ),
        'health' => array(
          'text' => '企業健診・特定健診・人間ドックに対応しています。ご要望に応じて胃カメラや大腸カメラを組み合わせたプランもございます。',
          'tags' => '要予約,企業健診対応',
          'time' => '約1〜2時間',
          'cost' => 'プランにより異なります',
          'result' => '約1〜2週間',
        ),
      );
      ?>

      <div class="kensa-tabs" role="tablist">
        <?php $i = 0; foreach ($kensa_types as $key => $label) : ?>
        <button class="kensa-tab<?php echo $i === 0 ? ' active' : ''; ?>" role="tab" data-tab="<?php echo esc_attr($key); ?>" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($label); ?></button>
        <?php $i++; endforeach; ?>
      </div>

      <?php $i = 0; foreach ($kensa_types as $key => $label) :
        $d = $kensa_defaults[$key];
      ?>
      <div class="kensa-panel<?php echo $i === 0 ? ' active' : ''; ?>" id="panel-<?php echo esc_attr($key); ?>" role="tabpanel">
        <div class="kensa-detail">
          <div class="kensa-detail-img">
            <?php $img = get_theme_mod("kensa_{$key}_image"); ?>
            <?php if ($img) : ?>
              <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($label); ?>">
            <?php else : ?>
              <div class="placeholder-img" style="width:100%;height:300px;"><?php echo esc_html($label); ?></div>
            <?php endif; ?>
          </div>
          <div class="kensa-detail-info">
            <h3><?php echo esc_html($label); ?></h3>
            <div class="kensa-detail-tags">
              <?php
              $tags = explode(',', midori_get("kensa_{$key}_tags", $d['tags']));
              foreach ($tags as $tag) :
                $tag = trim($tag);
                if ($tag) :
              ?>
              <span class="kensa-tag"><?php echo esc_html($tag); ?></span>
              <?php endif; endforeach; ?>
            </div>
            <p><?php echo nl2br(esc_html(midori_get("kensa_{$key}_text", $d['text']))); ?></p>
            <dl class="kensa-meta">
              <div class="kensa-meta-item">
                <dt>検査時間</dt>
                <dd><?php echo esc_html(midori_get("kensa_{$key}_time", $d['time'])); ?></dd>
              </div>
              <div class="kensa-meta-item">
                <dt>費用目安</dt>
                <dd><?php echo esc_html(midori_get("kensa_{$key}_cost", $d['cost'])); ?></dd>
              </div>
              <div class="kensa-meta-item">
                <dt>結果説明</dt>
                <dd><?php echo esc_html(midori_get("kensa_{$key}_result", $d['result'])); ?></dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
      <?php $i++; endforeach; ?>
    </div>
  </div>
</section>

<!-- Flow -->
<section class="section section-white">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Flow</span>
        <h2 class="section-heading-jp">検査の流れ</h2>
      </div>
    </div>
    <div class="kensa-flow fade-in">
      <?php
      $steps = array(
        array(midori_get('kensa_flow_step1_title', 'ご予約'), midori_get('kensa_flow_step1_text', 'お電話またはWEB予約にて検査日をご予約ください。事前に問診票のご記入をお願いしております。')),
        array(midori_get('kensa_flow_step2_title', '事前準備'), midori_get('kensa_flow_step2_text', '検査前日の食事制限や、大腸カメラの場合は下剤の服用について事前にご案内いたします。')),
        array(midori_get('kensa_flow_step3_title', '検査当日・受付'), midori_get('kensa_flow_step3_text', '予約時間の15分前までにお越しください。受付後、検査着に着替えていただきます。')),
        array(midori_get('kensa_flow_step4_title', '検査実施'), midori_get('kensa_flow_step4_text', '鎮静剤をご希望の場合は点滴から投与します。リラックスした状態で検査を行います。')),
        array(midori_get('kensa_flow_step5_title', '結果説明'), midori_get('kensa_flow_step5_text', '検査後、リカバリールームでお休みいただいた後、医師から画像を見ながら結果をご説明します。')),
      );
      foreach ($steps as $idx => $step) : ?>
      <div class="kensa-flow-step">
        <div class="kensa-flow-num"><?php echo $idx + 1; ?></div>
        <div class="kensa-flow-content">
          <h4><?php echo esc_html($step[0]); ?></h4>
          <p><?php echo esc_html($step[1]); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Notices -->
<section class="section section-alt">
  <div class="container">
    <div class="fade-in">
      <div class="section-heading">
        <span class="section-heading-en">Notice</span>
        <h2 class="section-heading-jp">注意事項</h2>
      </div>
    </div>
    <div class="kensa-notices fade-in">
      <?php
      $notices = array(
        array(midori_get('kensa_notice1_title', '食事制限'), midori_get('kensa_notice1_text', '胃カメラは前日21時以降の食事をお控えください。大腸カメラは前日から検査食をお召し上がりいただきます。')),
        array(midori_get('kensa_notice2_title', 'お薬について'), midori_get('kensa_notice2_text', '血液をサラサラにするお薬を服用中の方は事前にお知らせください。検査内容により休薬が必要な場合があります。')),
        array(midori_get('kensa_notice3_title', '鎮静剤使用時'), midori_get('kensa_notice3_text', '鎮静剤を使用した場合、当日のお車・自転車の運転はできません。公共交通機関でお越しください。')),
        array(midori_get('kensa_notice4_title', 'キャンセルについて'), midori_get('kensa_notice4_text', '検査のキャンセル・変更は、検査日の2日前までにご連絡ください。')),
      );
      foreach ($notices as $n) : ?>
      <div class="kensa-notice">
        <h4><?php echo esc_html($n[0]); ?></h4>
        <p><?php echo esc_html($n[1]); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="fp-cta">
  <div class="container">
    <div class="fade-in">
      <h2>検査のご予約・ご相談</h2>
      <p>内視鏡検査は完全予約制です。お電話にてお気軽にお問い合わせください。</p>
      <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="cta-tel-btn">
        <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
        <?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
