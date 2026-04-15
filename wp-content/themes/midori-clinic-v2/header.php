<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Side CTA (PC) -->
<div class="side-cta">
  <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="side-cta-tel" aria-label="電話">
    <svg viewBox="0 0 24 24" width="16" height="16" fill="#fff" style="margin-bottom:8px"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z"/></svg>
    <?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?>
  </a>
  <a href="#" class="side-cta-web" aria-label="WEB予約">WEB予約</a>
  <a href="#" class="side-cta-line" aria-label="LINE予約">LINE</a>
</div>

<header class="site-header" id="site-header">
  <div class="header-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/other/logo.svg" alt="<?php echo esc_attr(midori_get('clinic_name', 'みどり内科クリニック')); ?>" width="48" height="48">
      <div class="site-logo-text">
        <span class="site-logo-name"><?php echo esc_html(midori_get('clinic_name', 'みどり内科クリニック')); ?></span>
        <span class="site-logo-sub"><?php echo esc_html(midori_get('clinic_name_en', 'Midori Internal Medicine Clinic')); ?></span>
      </div>
    </a>

    <nav class="main-nav" id="main-nav">
      <a href="<?php echo esc_url(home_url('/')); ?>"<?php echo is_front_page() ? ' class="current"' : ''; ?>>
        <span class="nav-jp">ホーム</span>
        <span class="nav-en">Home</span>
      </a>
      <a href="<?php echo esc_url(home_url('/shinryou/')); ?>"<?php echo is_page('shinryou') ? ' class="current"' : ''; ?>>
        <span class="nav-jp">診療科目</span>
        <span class="nav-en">Medical</span>
      </a>
      <a href="<?php echo esc_url(home_url('/kensa/')); ?>"<?php echo is_page('kensa') ? ' class="current"' : ''; ?>>
        <span class="nav-jp">検査</span>
        <span class="nav-en">Examination</span>
      </a>
      <a href="<?php echo esc_url(home_url('/doctor/')); ?>"<?php echo is_page('doctor') ? ' class="current"' : ''; ?>>
        <span class="nav-jp">ドクター紹介</span>
        <span class="nav-en">Doctor</span>
      </a>
      <a href="<?php echo esc_url(home_url('/clinic/')); ?>"<?php echo is_page('clinic') ? ' class="current"' : ''; ?>>
        <span class="nav-jp">クリニック紹介</span>
        <span class="nav-en">Clinic</span>
      </a>
      <a href="<?php echo esc_url(home_url('/useful-info/')); ?>"<?php echo (is_page('useful-info') || is_single()) ? ' class="current"' : ''; ?>>
        <span class="nav-jp">お役立ち情報</span>
        <span class="nav-en">Information</span>
      </a>
    </nav>

    <div class="header-contact">
      <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="header-tel">
        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
        <div>
          <span><?php echo esc_html(midori_get('clinic_tel', '03-0000-0000')); ?></span>
          <span class="header-tel-note"><?php echo esc_html(midori_get('reception_note', '受付は診療終了30分前まで')); ?></span>
        </div>
      </a>
    </div>

    <button class="menu-toggle" id="menu-toggle" aria-label="メニュー">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>

<div class="nav-overlay" id="nav-overlay"></div>

<!-- SP Fixed Bottom Bar -->
<div class="sp-fixed-bar">
  <div class="sp-fixed-bar-inner">
    <a href="tel:<?php echo esc_attr(midori_tel_url(midori_get('clinic_tel', '03-0000-0000'))); ?>" class="sp-fixed-bar-tel">
      <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.36 11.36 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.58 1 1 0 01-.25 1.01l-2.2 2.2z" fill="currentColor"/></svg>
      電話予約
    </a>
    <a href="#" class="sp-fixed-bar-web">
      <svg viewBox="0 0 24 24"><path d="M19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 14H5V8h14v10z" fill="currentColor"/><path d="M7 10h10v2H7zm0 4h7v2H7z" fill="currentColor"/></svg>
      WEB予約
    </a>
    <a href="#" class="sp-fixed-bar-line">
      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 5.82 2 10.5c0 2.93 1.95 5.5 4.87 7.03-.19.7-.68 2.6-.78 3-.13.5.18.49.38.36.16-.1 2.54-1.72 3.57-2.42.62.1 1.27.15 1.96.15 5.52 0 10-3.82 10-8.5S17.52 2 12 2z" fill="currentColor"/></svg>
      LINE
    </a>
  </div>
</div>
