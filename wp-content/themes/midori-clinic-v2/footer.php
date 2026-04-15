<footer class="site-footer">
  <div class="container-wide">
    <div class="footer-grid">

      <div class="footer-brand">
        <div class="footer-logo">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/other/logo.svg" alt="<?php echo esc_attr(midori_get('clinic_name', 'みどり内科クリニック')); ?>" width="40" height="40">
          <span class="footer-logo-name"><?php echo esc_html(midori_get('clinic_name', 'みどり内科クリニック')); ?></span>
        </div>
        <p><?php echo nl2br(esc_html(midori_get('clinic_address_full', "〒107-0062\n東京都港区南青山1-2-3\nメディカルビル3F"))); ?></p>
        <div class="footer-tel">
          <svg viewBox="0 0 24 24" width="16" height="16"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
          <?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?>
        </div>
      </div>

      <div class="footer-col">
        <h4>ページ一覧</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
          <li><a href="<?php echo esc_url(home_url('/shinryou/')); ?>">診療科目</a></li>
          <li><a href="<?php echo esc_url(home_url('/kensa/')); ?>">検査</a></li>
          <li><a href="<?php echo esc_url(home_url('/doctor/')); ?>">ドクター紹介</a></li>
          <li><a href="<?php echo esc_url(home_url('/clinic/')); ?>">クリニック紹介</a></li>
          <li><a href="<?php echo esc_url(home_url('/useful-info/')); ?>">お役立ち情報</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>診療科目</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/shinryou/#shokaki')); ?>">消化器内科</a></li>
          <li><a href="<?php echo esc_url(home_url('/shinryou/#naishikyo')); ?>">内視鏡内科</a></li>
          <li><a href="<?php echo esc_url(home_url('/kensa/')); ?>">胃カメラ検査</a></li>
          <li><a href="<?php echo esc_url(home_url('/kensa/')); ?>">大腸カメラ検査</a></li>
          <li><a href="<?php echo esc_url(home_url('/kensa/')); ?>">腹部エコー</a></li>
          <li><a href="<?php echo esc_url(home_url('/kensa/')); ?>">健康診断</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>診療時間</h4>
        <div class="footer-hours-mini">
          <p>午前 <?php echo esc_html(midori_get('footer_hours_am', '9:00〜12:30')); ?></p>
          <p>午後 <?php echo esc_html(midori_get('footer_hours_pm', '14:00〜18:00')); ?></p>
          <p><?php echo esc_html(midori_get('footer_hours_closed', '休診：水曜午後・日曜・祝日')); ?></p>
          <p><?php echo esc_html(midori_get('footer_hours_reception', '受付は診療終了30分前まで')); ?></p>
          <?php $note = midori_get('footer_hours_note', '内視鏡検査は完全予約制です'); if ($note) : ?>
            <p style="margin-top:8px;font-size:0.75rem;opacity:0.7;">※<?php echo esc_html($note); ?></p>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(midori_get('clinic_name', 'みどり内科クリニック')); ?> All Rights Reserved.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
