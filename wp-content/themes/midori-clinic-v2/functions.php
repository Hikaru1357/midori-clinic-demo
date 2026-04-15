<?php
/**
 * みどり内科クリニック V2 テーマ functions
 * 消化器内科・内視鏡内科専門クリニック デモサイト
 */

// テーマセットアップ
function midori_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 90,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'primary'  => 'メインメニュー',
        'footer'   => 'フッターメニュー',
    ));

    set_post_thumbnail_size(1200, 750, true);
    add_image_size('blog-card', 600, 375, true);
    add_image_size('gallery-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'midori_setup');

// スタイル・スクリプト読み込み
function midori_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@400;500;600;700&display=swap', array(), null);

    // Swiper.js v11 CDN
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

    // メインスタイル
    wp_enqueue_style('midori-style', get_stylesheet_uri(), array('google-fonts', 'swiper'), '2.0.0');

    // デザイン強化CSS
    wp_enqueue_style('midori-enhancements', get_template_directory_uri() . '/assets/css/enhancements.css', array('midori-style'), '2.0.0');

    // メインJS
    wp_enqueue_script('midori-main', get_template_directory_uri() . '/assets/js/main.js', array('swiper'), '2.0.0', true);
}
add_action('wp_enqueue_scripts', 'midori_enqueue_assets');

// ウィジェットエリア登録
function midori_widgets_init() {
    register_sidebar(array(
        'name'          => 'ブログサイドバー',
        'id'            => 'sidebar-blog',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'midori_widgets_init');

// 抜粋の文字数調整
function midori_excerpt_length($length) {
    return 60;
}
add_filter('excerpt_length', 'midori_excerpt_length');

function midori_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'midori_excerpt_more');

// カスタマイザーヘルパー関数
function midori_add_text_setting($wp_customize, $id, $label, $section, $default = '', $type = 'text') {
    $wp_customize->add_setting($id, array(
        'default'           => $default,
        'sanitize_callback' => ($type === 'textarea') ? 'sanitize_textarea_field' : 'sanitize_text_field',
    ));
    $wp_customize->add_control($id, array(
        'label'   => $label,
        'section' => $section,
        'type'    => $type,
    ));
}

function midori_add_image_setting($wp_customize, $id, $label, $section, $default = '') {
    $wp_customize->add_setting($id, array(
        'default'           => $default,
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $id, array(
        'label'   => $label,
        'section' => $section,
    )));
}

// =========================================================
// カスタマイザー設定
// =========================================================
function midori_customize_register($wp_customize) {

    // =========================================================
    // Panel 1: サイト基本情報
    // =========================================================
    $wp_customize->add_panel('midori_site_info', array(
        'title'    => 'サイト基本情報',
        'priority' => 30,
    ));

    // ----- Section: クリニック基本情報 -----
    $wp_customize->add_section('midori_clinic_info', array(
        'title' => 'クリニック基本情報',
        'panel' => 'midori_site_info',
    ));

    midori_add_text_setting($wp_customize, 'clinic_name',            'クリニック名',               'midori_clinic_info', 'みどり内科クリニック');
    midori_add_text_setting($wp_customize, 'clinic_name_en',         'クリニック名（英語）',       'midori_clinic_info', 'Midori Internal Medicine Clinic');
    midori_add_text_setting($wp_customize, 'clinic_tel',             '電話番号',                   'midori_clinic_info', '03-0000-0000');
    midori_add_text_setting($wp_customize, 'clinic_address',         '住所（ヘッダー用1行）',      'midori_clinic_info', '東京都港区南青山1-2-3');
    midori_add_text_setting($wp_customize, 'clinic_address_full',    '住所（フッター用・改行可）',  'midori_clinic_info', "〒107-0062\n東京都港区南青山1-2-3\nメディカルビル3F", 'textarea');
    midori_add_text_setting($wp_customize, 'doctor_name',            '院長名',                     'midori_clinic_info', '緑川 太郎');
    midori_add_text_setting($wp_customize, 'reception_note',         '受付時間の補足',             'midori_clinic_info', '受付は診療終了30分前まで');
    midori_add_text_setting($wp_customize, 'clinic_nearest_station', '最寄駅',                     'midori_clinic_info', '東京メトロ 青山一丁目駅 徒歩3分');
    midori_add_text_setting($wp_customize, 'clinic_parking',         '駐車場',                     'midori_clinic_info', '提携駐車場あり（2時間まで無料）');
    midori_add_text_setting($wp_customize, 'google_maps_embed_url',  'Google Maps埋め込みURL',     'midori_clinic_info', '');

    // ----- Section: 診療時間テーブル -----
    $wp_customize->add_section('midori_timetable', array(
        'title' => '診療時間テーブル',
        'panel' => 'midori_site_info',
    ));

    midori_add_text_setting($wp_customize, 'timetable_am_label',    '午前の時間帯',        'midori_timetable', '9:00〜12:30');
    midori_add_text_setting($wp_customize, 'timetable_pm_label',    '午後の時間帯',        'midori_timetable', '14:00〜18:00');
    midori_add_text_setting($wp_customize, 'timetable_am_sat_note', '土曜午前の補足',      'midori_timetable', '9:00〜13:00');
    midori_add_text_setting($wp_customize, 'timetable_note1',       '注釈1',               'midori_timetable', '受付は診療終了30分前まで');
    midori_add_text_setting($wp_customize, 'timetable_note2',       '注釈2',               'midori_timetable', '休診日：水曜午後・日曜・祝日');
    midori_add_text_setting($wp_customize, 'timetable_note3',       '注釈3',               'midori_timetable', '内視鏡検査は完全予約制');

    // =========================================================
    // Panel 2: トップページ
    // =========================================================
    $wp_customize->add_panel('midori_frontpage', array(
        'title'    => 'トップページ',
        'priority' => 31,
    ));

    // ----- Section: ファーストビュー -----
    $wp_customize->add_section('midori_hero', array(
        'title' => 'ファーストビュー',
        'panel' => 'midori_frontpage',
    ));

    midori_add_image_setting($wp_customize, 'hero_image1', 'スライド画像1', 'midori_hero');
    midori_add_image_setting($wp_customize, 'hero_image2', 'スライド画像2', 'midori_hero');
    midori_add_image_setting($wp_customize, 'hero_image3', 'スライド画像3', 'midori_hero');
    midori_add_text_setting($wp_customize, 'hero_subtitle',      'サブタイトル',    'midori_hero', 'Gastroenterology & Endoscopy');
    midori_add_text_setting($wp_customize, 'hero_heading_line1', '見出し1行目',     'midori_hero', '患者様に寄り添った');
    midori_add_text_setting($wp_customize, 'hero_heading_line2', '見出し2行目',     'midori_hero', '安心の内視鏡検査を');
    midori_add_text_setting($wp_customize, 'hero_description',   '説明文',          'midori_hero', "最新鋭の内視鏡システムと豊富な経験を持つ専門医が\n苦痛の少ない検査で、あなたの健康をお守りします。", 'textarea');

    // ----- Section: 3つの特長 -----
    $wp_customize->add_section('midori_features', array(
        'title' => '3つの特長',
        'panel' => 'midori_frontpage',
    ));

    midori_add_text_setting($wp_customize, 'feature1_title', '特長1 タイトル', 'midori_features', '経験豊富な専門医');
    midori_add_text_setting($wp_customize, 'feature1_text',  '特長1 説明文',   'midori_features', '消化器内視鏡専門医が全ての検査を担当。年間1,000件以上の実績があります。');
    midori_add_text_setting($wp_customize, 'feature2_title', '特長2 タイトル', 'midori_features', '苦痛の少ない検査');
    midori_add_text_setting($wp_customize, 'feature2_text',  '特長2 説明文',   'midori_features', '鎮静剤を使用した検査で、眠っている間に検査が終了。不安なく受けていただけます。');
    midori_add_text_setting($wp_customize, 'feature3_title', '特長3 タイトル', 'midori_features', '最新の内視鏡設備');
    midori_add_text_setting($wp_customize, 'feature3_text',  '特長3 説明文',   'midori_features', 'オリンパス最新内視鏡システムEVIS X1を導入。高精細な画像で早期発見に貢献します。');

    // ----- Section: 院長ご挨拶（トップ） -----
    $wp_customize->add_section('midori_greeting', array(
        'title' => '院長ご挨拶（トップ）',
        'panel' => 'midori_frontpage',
    ));

    midori_add_image_setting($wp_customize, 'greeting_doctor_image', '院長写真', 'midori_greeting');
    midori_add_text_setting($wp_customize, 'greeting_heading', '見出し',   'midori_greeting', "地域の皆様の\n「おなかの健康」を守ります");
    midori_add_text_setting($wp_customize, 'greeting_text1',   '本文1',    'midori_greeting', "みどり内科クリニック院長の緑川太郎です。大学病院の消化器内科で20年以上にわたり内視鏡診療に携わり、\n「もっと身近に、もっと気軽に専門的な検査を受けていただきたい」という想いから開院いたしました。", 'textarea');
    midori_add_text_setting($wp_customize, 'greeting_text2',   '本文2',    'midori_greeting', "消化器の不調は我慢してしまいがちですが、早期発見・早期治療が何よりも大切です。\n「おなかの悩み」はどんな些細なことでもお気軽にご相談ください。", 'textarea');

    // ----- Section: ご来院の方へ -----
    $wp_customize->add_section('midori_fp_visit', array(
        'title' => 'ご来院の方へ',
        'panel' => 'midori_frontpage',
    ));

    midori_add_text_setting($wp_customize, 'visit_info_firstvisit',   '初診の方',       'midori_fp_visit', '保険証をお持ちの上、受付時間内にお越しください。');
    midori_add_text_setting($wp_customize, 'visit_info_reception',    '受付時間',       'midori_fp_visit', '午前 9:00〜12:00 / 午後 14:00〜17:30');
    midori_add_text_setting($wp_customize, 'visit_info_reservation',  '予約について',   'midori_fp_visit', '内視鏡検査は完全予約制です。お電話またはWEB予約をご利用ください。');
    midori_add_text_setting($wp_customize, 'visit_info_payment',      'お支払い方法',   'midori_fp_visit', '各種保険取扱い・各種クレジットカード対応');

    // ----- Section: CTA -----
    $wp_customize->add_section('midori_fp_cta', array(
        'title' => 'CTA',
        'panel' => 'midori_frontpage',
    ));

    midori_add_text_setting($wp_customize, 'cta_heading', 'CTA見出し', 'midori_fp_cta', 'まずはお気軽にご相談ください');
    midori_add_text_setting($wp_customize, 'cta_text',    'CTA説明文', 'midori_fp_cta', '消化器の不調や内視鏡検査について、お気軽にお電話ください。');

    // =========================================================
    // Panel 3: ドクター紹介ページ
    // =========================================================
    $wp_customize->add_panel('midori_doctor', array(
        'title'    => 'ドクター紹介ページ',
        'priority' => 32,
    ));

    // ----- Section: 院長プロフィール -----
    $wp_customize->add_section('midori_doctor_profile', array(
        'title' => '院長プロフィール',
        'panel' => 'midori_doctor',
    ));

    midori_add_image_setting($wp_customize, 'doctor_photo', '院長写真', 'midori_doctor_profile');
    midori_add_text_setting($wp_customize, 'doctor_name_en', '院長名（英語）', 'midori_doctor_profile', 'Taro Midorikawa');
    midori_add_text_setting($wp_customize, 'doctor_message', '院長メッセージ', 'midori_doctor_profile',
        "みどり内科クリニックのホームページをご覧いただき、ありがとうございます。\n院長の緑川太郎です。\n\n私は大学病院の消化器内科で20年以上にわたり、数多くの内視鏡検査・治療に携わってまいりました。\n内視鏡検査は「苦しい」「怖い」というイメージをお持ちの方が多いかと思いますが、\n鎮静剤の使用や経鼻内視鏡など、患者様の負担を最小限にする方法が大きく進歩しています。\n\n「おなかの調子がおかしいけれど、病院に行くのは不安」——そんな方にこそ、\n気軽に相談できるクリニックでありたいと考えております。\n消化器のことなら何でもお気軽にご相談ください。", 'textarea');
    midori_add_text_setting($wp_customize, 'doctor_career', '経歴（改行区切り）', 'midori_doctor_profile',
        "2000年 東京大学医学部卒業\n2000年 東京大学医学部附属病院 研修医\n2002年 同 消化器内科 入局\n2008年 国立がん研究センター 消化器内視鏡科\n2015年 みどり内科クリニック 開院", 'textarea');
    midori_add_text_setting($wp_customize, 'doctor_qualifications', '資格・認定（改行区切り）', 'midori_doctor_profile',
        "日本内科学会 認定内科医\n日本消化器内視鏡学会 専門医・指導医\n日本消化器病学会 専門医\n日本肝臓学会 専門医", 'textarea');
    midori_add_text_setting($wp_customize, 'doctor_societies', '所属学会（改行区切り）', 'midori_doctor_profile',
        "日本内科学会\n日本消化器内視鏡学会\n日本消化器病学会\n日本肝臓学会", 'textarea');

    // ----- Section: 診療方針 -----
    $wp_customize->add_section('midori_doctor_policy', array(
        'title' => '診療方針',
        'panel' => 'midori_doctor',
    ));

    midori_add_text_setting($wp_customize, 'policy1_title', '方針1 タイトル', 'midori_doctor_policy', '苦痛の少ない内視鏡検査');
    midori_add_text_setting($wp_customize, 'policy1_text',  '方針1 説明文',   'midori_doctor_policy', '鎮静剤の使用や経鼻内視鏡により、患者様の身体的・精神的負担を最小限に抑えた検査を行います。');
    midori_add_text_setting($wp_customize, 'policy2_title', '方針2 タイトル', 'midori_doctor_policy', '丁寧な説明と納得の診療');
    midori_add_text_setting($wp_customize, 'policy2_text',  '方針2 説明文',   'midori_doctor_policy', '検査画像をお見せしながら、わかりやすい言葉でご説明します。患者様が納得された上で治療方針を決定します。');
    midori_add_text_setting($wp_customize, 'policy3_title', '方針3 タイトル', 'midori_doctor_policy', '早期発見・早期治療');
    midori_add_text_setting($wp_customize, 'policy3_text',  '方針3 説明文',   'midori_doctor_policy', '最新の内視鏡システムとAI診断支援技術を活用し、微細な病変も見逃さない精密な検査を実施します。');

    // =========================================================
    // Panel 4: 診療科目ページ（2科目のみ）
    // =========================================================
    $wp_customize->add_panel('midori_shinryou', array(
        'title'    => '診療科目ページ',
        'priority' => 33,
    ));

    // ----- Section: 概要 -----
    $wp_customize->add_section('midori_shinryou_intro', array(
        'title' => '概要',
        'panel' => 'midori_shinryou',
    ));

    midori_add_text_setting($wp_customize, 'shinryou_intro', '概要文', 'midori_shinryou_intro',
        "当院は消化器内科・内視鏡内科を専門とするクリニックです。\n食道・胃・大腸をはじめとする消化管の疾患から、肝臓・胆嚢・膵臓の病気まで、\n消化器領域を幅広く診療いたします。内視鏡検査は全て専門医が担当し、\n苦痛の少ない検査と正確な診断をご提供します。", 'textarea');

    // ----- Section: 消化器内科 -----
    $wp_customize->add_section('midori_shinryou_shokaki', array(
        'title' => '消化器内科',
        'panel' => 'midori_shinryou',
    ));

    midori_add_image_setting($wp_customize, 'shinryou_shokaki_image', '消化器内科 画像', 'midori_shinryou_shokaki');
    midori_add_text_setting($wp_customize, 'shinryou_shokaki_text', '消化器内科 説明文', 'midori_shinryou_shokaki',
        "食道・胃・腸・肝臓・胆嚢・膵臓などの消化器系疾患を専門的に診療します。\n腹痛、胃もたれ、胸やけ、便秘・下痢などの日常的な症状から、\nピロリ菌除菌治療、肝機能障害の精査まで幅広く対応いたします。", 'textarea');
    midori_add_text_setting($wp_customize, 'shinryou_shokaki_diseases', '主な対応疾患（改行区切り）', 'midori_shinryou_shokaki',
        "逆流性食道炎・胃炎・胃潰瘍・十二指腸潰瘍\nピロリ菌感染症の検査・除菌治療\n過敏性腸症候群（IBS）\n肝機能障害・脂肪肝\n胆石・胆嚢ポリープ\n大腸ポリープ・炎症性腸疾患\n慢性便秘症・慢性下痢症", 'textarea');

    // ----- Section: 内視鏡内科 -----
    $wp_customize->add_section('midori_shinryou_naishikyo', array(
        'title' => '内視鏡内科',
        'panel' => 'midori_shinryou',
    ));

    midori_add_image_setting($wp_customize, 'shinryou_naishikyo_image', '内視鏡内科 画像', 'midori_shinryou_naishikyo');
    midori_add_text_setting($wp_customize, 'shinryou_naishikyo_text', '内視鏡内科 説明文', 'midori_shinryou_naishikyo',
        "上部消化管内視鏡検査（胃カメラ）・下部消化管内視鏡検査（大腸カメラ）を専門的に行います。\n最新の内視鏡システムEVIS X1を導入し、経鼻内視鏡や鎮静剤を用いた苦痛の少ない検査を実現。\n大腸ポリープの日帰り切除にも対応しています。", 'textarea');
    midori_add_text_setting($wp_customize, 'shinryou_naishikyo_diseases', '主な対応疾患・検査（改行区切り）', 'midori_shinryou_naishikyo',
        "上部消化管内視鏡検査（胃カメラ）\n下部消化管内視鏡検査（大腸カメラ）\n大腸ポリープ日帰り切除\nピロリ菌検査・除菌治療\n早期胃がん・大腸がんのスクリーニング\nバレット食道・食道裂孔ヘルニアの精査\n便潜血陽性の精密検査", 'textarea');

    // =========================================================
    // Panel 5: 検査ページ
    // =========================================================
    $wp_customize->add_panel('midori_kensa', array(
        'title'    => '検査ページ',
        'priority' => 34,
    ));

    // ----- Section: ハイライト -----
    $wp_customize->add_section('midori_kensa_highlights', array(
        'title' => 'ハイライト',
        'panel' => 'midori_kensa',
    ));

    midori_add_text_setting($wp_customize, 'kensa_highlight1_title', 'ハイライト1 タイトル', 'midori_kensa_highlights', '鎮静剤で眠ったまま検査');
    midori_add_text_setting($wp_customize, 'kensa_highlight1_text',  'ハイライト1 説明文',   'midori_kensa_highlights', '鎮静剤を使用し、ほとんど苦痛を感じることなく検査を受けていただけます');
    midori_add_text_setting($wp_customize, 'kensa_highlight2_title', 'ハイライト2 タイトル', 'midori_kensa_highlights', 'EVIS X1による高精細画像');
    midori_add_text_setting($wp_customize, 'kensa_highlight2_text',  'ハイライト2 説明文',   'midori_kensa_highlights', 'オリンパス最新内視鏡システムで微細な病変も見逃さない高精度な診断を実現');
    midori_add_text_setting($wp_customize, 'kensa_highlight3_title', 'ハイライト3 タイトル', 'midori_kensa_highlights', '専門医が全件担当');
    midori_add_text_setting($wp_customize, 'kensa_highlight3_text',  'ハイライト3 説明文',   'midori_kensa_highlights', '年間1,000件以上の実績を持つ消化器内視鏡専門医が全ての検査を責任をもって実施');

    // ----- 検査メニュー各種（6種） -----
    $kensa_types = array(
        'endo' => array(
            'label'   => '胃カメラ',
            'section' => 'midori_kensa_endo',
            'text'    => "経鼻内視鏡・経口内視鏡の両方に対応しており、患者様のご希望に合わせて選択いただけます。\n鎮静剤を使用した検査では、眠っている間に検査が終了。食道・胃・十二指腸の病変を\n高精細な画像で観察し、早期がんの発見にも対応しています。",
            'tags'    => '完全予約制,経鼻対応,鎮静剤使用可',
            'time'    => '約10〜15分',
            'cost'    => '1割：約1,500円 ／ 3割：約4,500円',
            'result'  => '検査当日（画像を見ながらご説明）',
        ),
        'colon' => array(
            'label'   => '大腸カメラ',
            'section' => 'midori_kensa_colon',
            'text'    => "大腸全体を観察し、ポリープやがん、炎症性腸疾患などを診断します。\n鎮静剤を使用し苦痛を最小限に抑えた検査を行います。\n検査中にポリープが見つかった場合、その場で日帰り切除が可能です。",
            'tags'    => '完全予約制,鎮静剤使用,ポリープ日帰り切除',
            'time'    => '約20〜30分',
            'cost'    => '1割：約2,000円 ／ 3割：約6,000円',
            'result'  => '検査当日（病理検査は約2週間後）',
        ),
        'echo' => array(
            'label'   => '腹部エコー',
            'section' => 'midori_kensa_echo',
            'text'    => "肝臓・胆嚢・膵臓・腎臓・脾臓などの腹部臓器を超音波で観察します。\n痛みがなく、被曝の心配もない安全な検査です。\n脂肪肝、胆石、腎結石などの評価に有用です。",
            'tags'    => '予約不要,痛みなし,当日結果説明',
            'time'    => '約15〜20分',
            'cost'    => '1割：約500円 ／ 3割：約1,500円',
            'result'  => '検査当日',
        ),
        'blood' => array(
            'label'   => '血液検査',
            'section' => 'midori_kensa_blood',
            'text'    => "肝機能、腎機能、脂質、血糖、ピロリ菌抗体、腫瘍マーカーなど幅広い項目を検査できます。\n消化器疾患の診断・経過観察に必要な検査を的確に実施します。",
            'tags'    => '一部即日結果,予約不要',
            'time'    => '採血 約5分',
            'cost'    => '検査項目により異なります',
            'result'  => '一部当日 ／ 通常3〜5日後',
        ),
        'xray' => array(
            'label'   => 'レントゲン',
            'section' => 'midori_kensa_xray',
            'text'    => "胸部・腹部のX線撮影を行います。デジタルレントゲンシステムにより、\n低被曝で高画質な画像を得ることができます。腹部の異常ガスや腸閉塞の評価にも有用です。",
            'tags'    => '予約不要,デジタル,即日結果',
            'time'    => '約5分',
            'cost'    => '1割：約200円 ／ 3割：約600円',
            'result'  => '検査当日',
        ),
        'health' => array(
            'label'   => '健康診断',
            'section' => 'midori_kensa_health',
            'text'    => "港区の特定健康診査、がん検診に対応しております。\n企業健診・雇入時健診もお受けしております。\n内視鏡オプション付きの人間ドックもご相談いただけます。",
            'tags'    => '特定健診,企業健診,がん検診',
            'time'    => '約30分〜1時間',
            'cost'    => '特定健診：無料 ／ 企業健診：要問合せ',
            'result'  => '要予約（お電話にて）',
        ),
    );

    foreach ($kensa_types as $type => $data) {
        $wp_customize->add_section($data['section'], array(
            'title' => $data['label'],
            'panel' => 'midori_kensa',
        ));
        midori_add_image_setting($wp_customize, 'kensa_' . $type . '_image',  $data['label'] . ' 画像',     $data['section']);
        midori_add_text_setting($wp_customize,  'kensa_' . $type . '_text',   $data['label'] . ' 説明文',   $data['section'], $data['text'], 'textarea');
        midori_add_text_setting($wp_customize,  'kensa_' . $type . '_tags',   $data['label'] . ' タグ（カンマ区切り）', $data['section'], $data['tags']);
        midori_add_text_setting($wp_customize,  'kensa_' . $type . '_time',   $data['label'] . ' 検査時間', $data['section'], $data['time']);
        midori_add_text_setting($wp_customize,  'kensa_' . $type . '_cost',   $data['label'] . ' 費用目安', $data['section'], $data['cost']);
        midori_add_text_setting($wp_customize,  'kensa_' . $type . '_result', $data['label'] . ' 結果説明', $data['section'], $data['result']);
    }

    // ----- Section: 検査の流れ（5ステップ） -----
    $wp_customize->add_section('midori_kensa_flow', array(
        'title' => '検査の流れ',
        'panel' => 'midori_kensa',
    ));

    midori_add_text_setting($wp_customize, 'kensa_flow_step1_title', 'ステップ1 タイトル', 'midori_kensa_flow', 'ご予約');
    midori_add_text_setting($wp_customize, 'kensa_flow_step1_text',  'ステップ1 説明文',   'midori_kensa_flow', 'お電話（03-0000-0000）またはWEBからご予約ください。ご希望の日時と症状をお伝えいただきます。');
    midori_add_text_setting($wp_customize, 'kensa_flow_step2_title', 'ステップ2 タイトル', 'midori_kensa_flow', '事前診察');
    midori_add_text_setting($wp_customize, 'kensa_flow_step2_text',  'ステップ2 説明文',   'midori_kensa_flow', '検査前に医師が診察を行います。既往歴・服薬状況の確認、検査内容のご説明、同意書の記入をお願いします。');
    midori_add_text_setting($wp_customize, 'kensa_flow_step3_title', 'ステップ3 タイトル', 'midori_kensa_flow', '検査前日');
    midori_add_text_setting($wp_customize, 'kensa_flow_step3_text',  'ステップ3 説明文',   'midori_kensa_flow', '夕食は21時までにお済ませください。それ以降は水・お茶のみ摂取可能です。当日朝は絶食でお越しください。');
    midori_add_text_setting($wp_customize, 'kensa_flow_step4_title', 'ステップ4 タイトル', 'midori_kensa_flow', '検査当日');
    midori_add_text_setting($wp_customize, 'kensa_flow_step4_text',  'ステップ4 説明文',   'midori_kensa_flow', '来院後、前処置（消泡剤服用・局所麻酔等）を行い、鎮静剤を投与して検査を実施します。胃カメラは約10〜15分です。');
    midori_add_text_setting($wp_customize, 'kensa_flow_step5_title', 'ステップ5 タイトル', 'midori_kensa_flow', '結果説明');
    midori_add_text_setting($wp_customize, 'kensa_flow_step5_text',  'ステップ5 説明文',   'midori_kensa_flow', '鎮静剤使用の方は30分〜1時間ほどリカバリー室でお休みいただいた後、撮影画像をお見せしながら結果をご説明します。');

    // ----- Section: 注意事項（4項目） -----
    $wp_customize->add_section('midori_kensa_notices', array(
        'title' => '注意事項',
        'panel' => 'midori_kensa',
    ));

    midori_add_text_setting($wp_customize, 'kensa_notice1_title', '注意1 タイトル', 'midori_kensa_notices', '内視鏡検査の予約');
    midori_add_text_setting($wp_customize, 'kensa_notice1_text',  '注意1 説明文',   'midori_kensa_notices', '内視鏡検査は完全予約制です。お電話（03-0000-0000）またはWEB予約にてご予約をお願いいたします。');
    midori_add_text_setting($wp_customize, 'kensa_notice2_title', '注意2 タイトル', 'midori_kensa_notices', '鎮静剤使用時のご注意');
    midori_add_text_setting($wp_customize, 'kensa_notice2_text',  '注意2 説明文',   'midori_kensa_notices', '鎮静剤を使用された場合、当日のお車・自転車の運転はお控えください。公共交通機関またはご家族の送迎でお越しください。');
    midori_add_text_setting($wp_customize, 'kensa_notice3_title', '注意3 タイトル', 'midori_kensa_notices', '大腸カメラの前処置');
    midori_add_text_setting($wp_customize, 'kensa_notice3_text',  '注意3 説明文',   'midori_kensa_notices', '大腸カメラの前日は消化の良い食事を、当日朝は下剤を服用していただきます。詳しくは事前診察時にご説明します。');
    midori_add_text_setting($wp_customize, 'kensa_notice4_title', '注意4 タイトル', 'midori_kensa_notices', '抗血栓薬を服用中の方');
    midori_add_text_setting($wp_customize, 'kensa_notice4_text',  '注意4 説明文',   'midori_kensa_notices', '血液をサラサラにするお薬を服用中の方は、事前にお申し出ください。お薬の調整が必要な場合があります。');

    // =========================================================
    // Panel 6: クリニック紹介ページ
    // =========================================================
    $wp_customize->add_panel('midori_clinic_page', array(
        'title'    => 'クリニック紹介ページ',
        'priority' => 35,
    ));

    // ----- Section: 紹介文 -----
    $wp_customize->add_section('midori_clinic_intro', array(
        'title' => '紹介文',
        'panel' => 'midori_clinic_page',
    ));

    midori_add_text_setting($wp_customize, 'clinic_intro_text', '紹介文', 'midori_clinic_intro',
        "みどり内科クリニックは、消化器内科・内視鏡内科の専門クリニックとして港区南青山に開院いたしました。\n清潔感のある院内環境と最新の内視鏡設備で、\n患者様が安心して検査・診療を受けていただける空間づくりを心がけています。", 'textarea');

    // ----- Section: 外観 -----
    $wp_customize->add_section('midori_clinic_exterior', array(
        'title' => '外観',
        'panel' => 'midori_clinic_page',
    ));

    midori_add_image_setting($wp_customize, 'clinic_exterior_image1', '外観写真1', 'midori_clinic_exterior');
    midori_add_image_setting($wp_customize, 'clinic_exterior_image2', '外観写真2', 'midori_clinic_exterior');

    // ----- Section: 院内風景 -----
    $wp_customize->add_section('midori_clinic_interior', array(
        'title' => '院内風景',
        'panel' => 'midori_clinic_page',
    ));

    midori_add_image_setting($wp_customize, 'clinic_interior_image1', '院内写真1', 'midori_clinic_interior');
    midori_add_text_setting($wp_customize,  'clinic_interior_label1', '院内写真1 ラベル', 'midori_clinic_interior', '受付・待合室');
    midori_add_image_setting($wp_customize, 'clinic_interior_image2', '院内写真2', 'midori_clinic_interior');
    midori_add_text_setting($wp_customize,  'clinic_interior_label2', '院内写真2 ラベル', 'midori_clinic_interior', '診察室');
    midori_add_image_setting($wp_customize, 'clinic_interior_image3', '院内写真3', 'midori_clinic_interior');
    midori_add_text_setting($wp_customize,  'clinic_interior_label3', '院内写真3 ラベル', 'midori_clinic_interior', '内視鏡室');
    midori_add_image_setting($wp_customize, 'clinic_interior_image4', '院内写真4', 'midori_clinic_interior');
    midori_add_text_setting($wp_customize,  'clinic_interior_label4', '院内写真4 ラベル', 'midori_clinic_interior', 'リカバリー室');
    midori_add_image_setting($wp_customize, 'clinic_interior_image5', '院内写真5', 'midori_clinic_interior');
    midori_add_text_setting($wp_customize,  'clinic_interior_label5', '院内写真5 ラベル', 'midori_clinic_interior', '院内通路（バリアフリー）');

    // ----- Section: 医療機器 -----
    $wp_customize->add_section('midori_clinic_equipment', array(
        'title' => '医療機器',
        'panel' => 'midori_clinic_page',
    ));

    midori_add_image_setting($wp_customize, 'clinic_equip1_image', '機器1 画像', 'midori_clinic_equipment');
    midori_add_text_setting($wp_customize,  'clinic_equip1_title', '機器1 名称', 'midori_clinic_equipment', '内視鏡システム EVIS X1');
    midori_add_text_setting($wp_customize,  'clinic_equip1_text',  '機器1 説明', 'midori_clinic_equipment', 'オリンパス最新の内視鏡プラットフォーム。超高精細画像と特殊光観察（NBI/TXI）により、微細な粘膜変化も鮮明に描出します。');
    midori_add_image_setting($wp_customize, 'clinic_equip2_image', '機器2 画像', 'midori_clinic_equipment');
    midori_add_text_setting($wp_customize,  'clinic_equip2_title', '機器2 名称', 'midori_clinic_equipment', '超音波診断装置');
    midori_add_text_setting($wp_customize,  'clinic_equip2_text',  '機器2 説明', 'midori_clinic_equipment', '腹部エコーに対応。肝臓・胆嚢・膵臓・腎臓の状態をリアルタイムで観察でき、痛みのない非侵襲的な検査です。');
    midori_add_image_setting($wp_customize, 'clinic_equip3_image', '機器3 画像', 'midori_clinic_equipment');
    midori_add_text_setting($wp_customize,  'clinic_equip3_title', '機器3 名称', 'midori_clinic_equipment', 'デジタルレントゲン');
    midori_add_text_setting($wp_customize,  'clinic_equip3_text',  '機器3 説明', 'midori_clinic_equipment', '低被曝で高画質な撮影が可能。撮影後すぐにモニターで確認でき、腹部の異常ガスや腸閉塞の迅速な診断に貢献します。');
    midori_add_image_setting($wp_customize, 'clinic_equip4_image', '機器4 画像', 'midori_clinic_equipment');
    midori_add_text_setting($wp_customize,  'clinic_equip4_title', '機器4 名称', 'midori_clinic_equipment', '内視鏡洗浄消毒装置');
    midori_add_text_setting($wp_customize,  'clinic_equip4_text',  '機器4 説明', 'midori_clinic_equipment', '全ての内視鏡を日本消化器内視鏡学会のガイドラインに準拠した高水準消毒で処理。患者様の安全を最優先に衛生管理を徹底しています。');

    // ----- Section: アクセス情報 -----
    $wp_customize->add_section('midori_clinic_access', array(
        'title' => 'アクセス情報',
        'panel' => 'midori_clinic_page',
    ));

    midori_add_text_setting($wp_customize, 'clinic_access_transport', '交通アクセス（改行区切り）', 'midori_clinic_access',
        "電車：東京メトロ 青山一丁目駅 4番出口より徒歩3分\nバス：南青山一丁目バス停 下車すぐ\nお車：提携駐車場あり（2時間まで無料）", 'textarea');
    midori_add_text_setting($wp_customize, 'clinic_access_landmarks', '周辺目印（改行区切り）', 'midori_clinic_access',
        "青山一丁目交差点すぐ\nメディカルビル3階（1階にコンビニあり）", 'textarea');

    // =========================================================
    // Section: フッター（トップレベル）
    // =========================================================
    $wp_customize->add_section('midori_footer', array(
        'title'    => 'フッター',
        'priority' => 36,
    ));

    midori_add_text_setting($wp_customize, 'footer_hours_am',        'フッター 午前',       'midori_footer', '9:00〜12:30（月〜土）');
    midori_add_text_setting($wp_customize, 'footer_hours_pm',        'フッター 午後',       'midori_footer', '14:00〜18:00（月火木金）');
    midori_add_text_setting($wp_customize, 'footer_hours_closed',    'フッター 休診',       'midori_footer', '水曜午後・日曜・祝日');
    midori_add_text_setting($wp_customize, 'footer_hours_reception', 'フッター 受付',       'midori_footer', '受付は診療終了30分前まで');
    midori_add_text_setting($wp_customize, 'footer_hours_note',      'フッター 備考',       'midori_footer', '※内視鏡検査は完全予約制');
}
add_action('customize_register', 'midori_customize_register');

// =========================================================
// デモコンテンツ自動作成（テーマ有効化時）
// =========================================================
function midori_create_demo_content() {
    if (get_option('midori_v2_demo_content_created')) {
        return;
    }

    // カテゴリー作成
    $categories = array(
        'news'          => 'お知らせ',
        'health-column' => '健康コラム',
        'kensa-info'    => '検査のご案内',
        'diseases'      => '消化器の病気',
    );
    $cat_ids = array();
    foreach ($categories as $slug => $name) {
        $term = term_exists($name, 'category');
        if (!$term) {
            $term = wp_insert_term($name, 'category', array('slug' => $slug));
        }
        if (!is_wp_error($term)) {
            $cat_ids[$slug] = is_array($term) ? $term['term_id'] : $term;
        }
    }

    // お知らせ記事（4件）
    $news_posts = array(
        array(
            'title'    => 'ゴールデンウィーク期間の診療スケジュールについて',
            'date'     => '2026-04-01 09:00:00',
            'category' => $cat_ids['news'],
            'excerpt'  => 'ゴールデンウィーク期間中の診療スケジュールについてお知らせいたします。休診日をご確認のうえ、検査のご予約やお薬の準備にお役立てください。',
            'content'  => '<p>患者様にはいつも当院をご利用いただきありがとうございます。2026年ゴールデンウィーク期間中の診療スケジュールについてお知らせいたします。</p>

<h2>GW期間中の診療スケジュール</h2>
<ul>
<li><strong>4月29日（水・昭和の日）</strong>：休診</li>
<li><strong>4月30日（木）</strong>：通常診療（午前・午後）</li>
<li><strong>5月1日（金）</strong>：通常診療（午前・午後）</li>
<li><strong>5月2日（土）</strong>：午前のみ診療</li>
<li><strong>5月3日（日・憲法記念日）〜 5月6日（水・振替休日）</strong>：休診</li>
<li><strong>5月7日（木）</strong>：通常診療再開</li>
</ul>

<h2>内視鏡検査のご予約について</h2>
<p>連休前後は内視鏡検査のご予約が集中いたします。ご希望の方はお早めにご予約ください。連休明けの検査枠は既に埋まりつつございますので、5月中旬以降の日程もご検討ください。</p>

<h2>お薬の処方について</h2>
<p>定期的にお薬を服用されている患者様は、連休中にお薬が不足しないよう、4月28日（火）までにご来院いただけますと安心です。</p>

<h2>休診中に体調を崩された場合</h2>
<ul>
<li><strong>東京都医療機関案内サービス「ひまわり」</strong>：03-5272-0303（24時間対応）</li>
<li><strong>救急の場合</strong>：119番へおかけください</li>
</ul>',
        ),
        array(
            'title'    => '最新内視鏡システム EVIS X1 を導入いたしました',
            'date'     => '2026-03-15 09:00:00',
            'category' => $cat_ids['news'],
            'excerpt'  => 'より精密で負担の少ない内視鏡検査をご提供するため、オリンパス最新の内視鏡システムEVIS X1を導入いたしました。',
            'content'  => '<p>このたび当院では、オリンパス最新の内視鏡プラットフォーム「EVIS X1」を導入いたしました。従来のシステムと比較して画質・機能ともに大幅に向上しています。</p>

<h2>EVIS X1の主な特徴</h2>
<ul>
<li><strong>超高精細画像</strong>：従来比約2倍の解像度で微細な粘膜変化も鮮明に観察</li>
<li><strong>TXI（Texture and Color Enhancement Imaging）</strong>：色調と構造を強調し、わずかな病変も見やすく表示</li>
<li><strong>RDI（Red Dichromatic Imaging）</strong>：出血部位の視認性を向上させる特殊光観察</li>
<li><strong>AI病変検出支援</strong>：人工知能がリアルタイムで画像を解析し、見落としリスクを低減</li>
</ul>

<h2>患者様へのメリット</h2>
<ul>
<li>早期がんの発見精度がさらに向上</li>
<li>検査時間の短縮による身体的負担の軽減</li>
<li>より鮮明な画像による正確な結果説明</li>
</ul>
<p>「以前の内視鏡検査がつらかった」という方も、最新設備と鎮静剤の併用で安心してお受けいただけます。検査のご予約はお電話またはWEBにて承っております。</p>',
        ),
        array(
            'title'    => '令和8年度 港区特定健康診査・がん検診の受付を開始しました',
            'date'     => '2026-03-01 09:00:00',
            'category' => $cat_ids['news'],
            'excerpt'  => '令和8年度の港区特定健康診査および大腸がん検診の受付を開始いたしました。対象の方はこの機会にぜひ受診ください。',
            'content'  => '<p>当院では、令和8年度の港区特定健康診査および各種がん検診の受付を開始いたしました。</p>

<h2>当院で受けられる検査</h2>
<ul>
<li><strong>特定健康診査</strong>：問診、身体計測、血圧測定、血液検査、尿検査</li>
<li><strong>大腸がん検診</strong>：便潜血検査（2日法）</li>
<li><strong>肝炎ウイルス検査</strong>：B型・C型肝炎ウイルス検査</li>
<li><strong>胃がんリスク検診</strong>：ABC検診（ピロリ菌抗体＋ペプシノゲン）</li>
</ul>

<h2>受診時の持ち物</h2>
<ul>
<li>受診券（港区から届いたもの）</li>
<li>健康保険証またはマイナンバーカード</li>
<li>お薬手帳（お薬を服用中の方）</li>
</ul>

<h2>便潜血陽性の方へ</h2>
<p>便潜血検査で陽性と判定された方は、大腸カメラ（大腸内視鏡検査）による精密検査をお受けください。当院では鎮静剤を使用した苦痛の少ない大腸カメラを実施しております。検査中にポリープが見つかった場合、その場で日帰り切除も可能です。お気軽にご相談ください。</p>',
        ),
        array(
            'title'    => '大腸ポリープ日帰り切除に対応しています',
            'date'     => '2026-02-01 09:00:00',
            'category' => $cat_ids['news'],
            'excerpt'  => '当院では大腸カメラ検査中にポリープが見つかった場合、その場で日帰り切除を行うことが可能です。',
            'content'  => '<p>当院では、大腸内視鏡検査（大腸カメラ）の際にポリープが発見された場合、多くのケースでその場で切除を行うことが可能です。</p>

<h2>日帰りポリープ切除のメリット</h2>
<ul>
<li>検査と治療が1回で完了するため、患者様の負担が少ない</li>
<li>入院の必要がなく、当日にお帰りいただけます</li>
<li>大腸がんの予防につながります（大腸がんの多くはポリープから発生）</li>
</ul>

<h2>切除の対象となるポリープ</h2>
<p>大きさや形状、数によっては入院施設での切除が必要となる場合もございます。その際は連携する専門病院をご紹介いたします。切除した組織は病理検査に提出し、約2週間後に結果をご説明します。</p>

<h2>大腸カメラをお勧めする方</h2>
<ul>
<li>便潜血検査で陽性を指摘された方</li>
<li>血便・下血がある方</li>
<li>便通異常（便秘・下痢）が続く方</li>
<li>大腸がんの家族歴がある方</li>
<li>40歳以上で大腸カメラを受けたことがない方</li>
</ul>
<p>大腸がんは早期発見・早期治療で高い治癒率が期待できます。気になる症状がある方は、お気軽にご相談ください。</p>',
        ),
    );

    // お役立ち情報記事（6件）
    $article_posts = array(
        array(
            'title'    => '胃カメラ検査は怖くない？ — 経鼻内視鏡と鎮静剤で楽に受ける方法',
            'date'     => '2026-04-01 10:00:00',
            'category' => $cat_ids['kensa-info'],
            'excerpt'  => '「胃カメラは辛い」というイメージをお持ちの方も多いのではないでしょうか。経鼻内視鏡や鎮静剤を使った苦痛の少ない検査について詳しくご説明します。',
            'content'  => '<h2>胃カメラ検査への不安 — 多くの方が感じています</h2>
<p>「胃カメラ」と聞くと、「苦しそう」「えずきそう」「怖い」というイメージをお持ちの方は少なくありません。しかし、胃がんをはじめとする消化器疾患の早期発見には、内視鏡検査が最も有効な手段です。</p>

<h2>経鼻内視鏡とは</h2>
<p>経鼻内視鏡とは、鼻からスコープを挿入して食道・胃・十二指腸を観察する検査です。直径約5〜6mmの極細スコープを使用するため、舌の付け根を刺激せず、「オエッ」となる嘔吐反射がほとんどありません。</p>

<h2>経鼻内視鏡のメリット</h2>
<ul>
<li><strong>嘔吐反射が少ない</strong> — 舌根部を刺激しないため快適</li>
<li><strong>検査中に会話ができる</strong> — 口が自由なので質問も可能</li>
<li><strong>鎮静剤なしでも受けやすい</strong> — 苦痛が少なく負担軽減</li>
</ul>

<h2>鎮静剤という選択肢</h2>
<p>当院では、さらに不安が強い方のために鎮静剤を使用した検査もお選びいただけます。うとうとした状態で検査を受けることができ、「気がついたら終わっていた」という方がほとんどです。</p>
<p>ただし鎮静剤使用時は、当日の車・自転車の運転はできません。公共交通機関でのご来院をお願いしています。</p>

<h2>こんな症状がある方は検査をおすすめします</h2>
<ul>
<li>胃の痛みや不快感が続いている</li>
<li>胸やけ、げっぷが多い</li>
<li>40歳以上で胃カメラを受けたことがない</li>
<li>ピロリ菌の感染を指摘された</li>
<li>バリウム検査で異常を指摘された</li>
</ul>
<p>胃がんは早期に発見できれば高い確率で治癒が可能です。当院では患者様の不安をできる限り取り除き、安心して検査を受けていただける環境を整えています。</p>',
        ),
        array(
            'title'    => '大腸カメラ（大腸内視鏡検査）の流れと前処置について',
            'date'     => '2026-03-20 10:00:00',
            'category' => $cat_ids['kensa-info'],
            'excerpt'  => '大腸カメラは大腸がんの早期発見に最も有効な検査です。検査の流れや前処置（下剤の飲み方）について詳しくご案内します。',
            'content'  => '<h2>大腸カメラとは</h2>
<p>大腸カメラ（下部消化管内視鏡検査）は、肛門からスコープを挿入し、直腸から盲腸までの大腸全体を直接観察する検査です。大腸がん、大腸ポリープ、炎症性腸疾患などの診断に不可欠な検査となります。</p>

<h2>検査の流れ</h2>
<h3>1. 予約・事前診察</h3>
<p>お電話またはWEBでご予約の上、事前に診察を受けていただきます。既往歴・服薬状況の確認と、前処置の説明を行います。</p>
<h3>2. 検査前日</h3>
<p>消化の良い食事（白米、うどん、パン、豆腐など）を夕食まで摂っていただきます。繊維質の多い食品（海藻、きのこ、こんにゃく等）は避けてください。</p>
<h3>3. 検査当日朝</h3>
<p>ご自宅またはクリニックで約2リットルの下剤（腸管洗浄液）を服用していただきます。便が透明になれば前処置は完了です。</p>
<h3>4. 検査</h3>
<p>鎮静剤を使用し、ほとんど苦痛なく検査を受けていただけます。所要時間は約20〜30分です。ポリープが見つかった場合はその場で切除可能です。</p>
<h3>5. 結果説明</h3>
<p>リカバリー室で30分〜1時間お休みいただいた後、画像をお見せしながら結果をご説明します。</p>

<h2>大腸カメラを受けるべき方</h2>
<ul>
<li>便潜血検査で陽性を指摘された方</li>
<li>血便・下血がある方</li>
<li>大腸がんの家族歴がある方</li>
<li>40歳以上で大腸カメラを受けたことがない方</li>
</ul>
<p>大腸がんは早期に発見できれば90%以上が治癒可能です。定期的な検査をおすすめします。</p>',
        ),
        array(
            'title'    => 'ピロリ菌とは？ — 検査方法と除菌治療の流れ',
            'date'     => '2026-03-05 10:00:00',
            'category' => $cat_ids['diseases'],
            'excerpt'  => 'ピロリ菌は胃がんの大きなリスク因子です。感染経路、検査方法、除菌治療の流れをわかりやすくご説明します。',
            'content'  => '<h2>ピロリ菌（ヘリコバクター・ピロリ）とは</h2>
<p>ピロリ菌は胃の粘膜に生息する細菌です。感染は主に幼少期に起こり、一度感染すると除菌しない限り胃に住み続けます。50歳以上の方では約半数が感染しているとされています。</p>

<h2>ピロリ菌と胃がんの関係</h2>
<p>ピロリ菌の長期感染は慢性胃炎 → 萎縮性胃炎 → 胃がんへと進行するリスクがあります。WHOはピロリ菌を「確実な発がん因子」に分類しており、日本の胃がんの約99%にピロリ菌の関与があるとされています。</p>

<h2>当院での検査方法</h2>
<ul>
<li><strong>血液検査（抗体法）</strong> — 採血で手軽に検査可能</li>
<li><strong>尿素呼気試験</strong> — 呼気を分析する高精度な検査</li>
<li><strong>便中抗原検査</strong> — 非侵襲的で精度の高い検査</li>
<li><strong>内視鏡時の迅速ウレアーゼ試験</strong> — 胃カメラと同時に検査</li>
</ul>

<h2>除菌治療の流れ</h2>
<h3>1次除菌</h3>
<p>3種類の薬を1日2回、7日間服用します。成功率は約70〜80%です。</p>
<h3>除菌判定</h3>
<p>服薬終了後4週間以上あけて、呼気試験等で判定します。</p>
<h3>2次除菌</h3>
<p>1次除菌で除菌できなかった場合、薬の組み合わせを変えて再度治療します。2次除菌の成功率は約90%以上です。</p>

<h2>除菌後も定期検査を</h2>
<p>除菌に成功してもリスクがゼロになるわけではありません。年に1回の胃カメラで経過観察をおすすめします。当院では検査から除菌、除菌後のフォローまで一貫してサポートしています。</p>',
        ),
        array(
            'title'    => '逆流性食道炎 — 胸やけ・呑酸の原因と治療',
            'date'     => '2026-02-15 10:00:00',
            'category' => $cat_ids['diseases'],
            'excerpt'  => '胸やけ、呑酸（酸っぱいものがこみ上げる）、喉の違和感。これらは逆流性食道炎のサインかもしれません。原因と治療について解説します。',
            'content'  => '<h2>逆流性食道炎とは</h2>
<p>逆流性食道炎は、胃酸が食道に逆流することで食道の粘膜に炎症が起こる病気です。日本では生活習慣の欧米化や高齢化に伴い、患者数が増加しています。</p>

<h2>主な症状</h2>
<ul>
<li><strong>胸やけ</strong> — みぞおちから胸にかけての焼けるような不快感</li>
<li><strong>呑酸</strong> — 酸っぱいものや苦いものがこみ上げる</li>
<li><strong>喉の違和感</strong> — つかえ感、イガイガする感じ</li>
<li><strong>慢性的な咳</strong> — 夜間や食後に悪化しやすい</li>
<li><strong>胸痛</strong> — 心臓の病気と間違われることも</li>
</ul>

<h2>原因</h2>
<p>食道と胃の境目にある「下部食道括約筋」の機能低下が主な原因です。加齢、肥満、食生活（脂肪分の多い食事・暴飲暴食）、猫背などの姿勢、ストレスなどが関与します。</p>

<h2>診断</h2>
<p>問診と内視鏡検査（胃カメラ）で診断します。胃カメラでは食道粘膜の炎症の程度を直接観察でき、バレット食道など合併症の有無も確認できます。</p>

<h2>治療</h2>
<ul>
<li><strong>薬物療法</strong> — プロトンポンプ阻害薬（PPI）やP-CABで胃酸分泌を抑制</li>
<li><strong>生活習慣の改善</strong> — 食後すぐに横にならない、就寝前3時間は食事を避ける、上半身を少し高くして寝る</li>
<li><strong>食事の工夫</strong> — 脂肪分・カフェイン・アルコール・香辛料を控えめに</li>
</ul>
<p>症状が続く場合は、一度胃カメラで食道の状態を確認されることをおすすめします。</p>',
        ),
        array(
            'title'    => '過敏性腸症候群（IBS） — お腹の不調が続く方へ',
            'date'     => '2026-02-01 10:00:00',
            'category' => $cat_ids['diseases'],
            'excerpt'  => '繰り返す腹痛、下痢、便秘。検査では異常が見つからないのに症状が続く——それは過敏性腸症候群（IBS）かもしれません。',
            'content'  => '<h2>過敏性腸症候群（IBS）とは</h2>
<p>過敏性腸症候群（IBS：Irritable Bowel Syndrome）は、腸に明らかな炎症や腫瘍がないにもかかわらず、腹痛や腹部不快感、便通異常（下痢・便秘）が慢性的に続く疾患です。日本人の約10〜15%が罹患しているとされ、特に20〜40代に多く見られます。</p>

<h2>IBSの主なタイプ</h2>
<ul>
<li><strong>下痢型</strong> — 急な腹痛と下痢が特徴。通勤・通学中に症状が出やすい</li>
<li><strong>便秘型</strong> — コロコロとした硬い便、排便困難が続く</li>
<li><strong>混合型</strong> — 下痢と便秘を交互に繰り返す</li>
</ul>

<h2>原因</h2>
<p>腸と脳の相互作用（脳腸相関）の異常が主な原因と考えられています。ストレス、不規則な生活、食生活の乱れなどが誘因となり、腸の運動異常や知覚過敏を引き起こします。</p>

<h2>診断 — 大腸カメラの重要性</h2>
<p>IBSの診断には、大腸がんや炎症性腸疾患など他の病気がないことを確認する必要があります。特に以下に該当する方は大腸カメラをお勧めします。</p>
<ul>
<li>50歳以上で初めて症状が出た方</li>
<li>血便がある方</li>
<li>体重減少を伴う方</li>
<li>大腸がんの家族歴がある方</li>
</ul>

<h2>治療</h2>
<ul>
<li><strong>食事療法</strong> — 低FODMAP食、食物繊維の調整</li>
<li><strong>薬物療法</strong> — 腸の動きを調整する薬、整腸剤、抗不安薬など</li>
<li><strong>生活習慣改善</strong> — 規則正しい食事、適度な運動、ストレス管理</li>
</ul>
<p>IBSは命に関わる病気ではありませんが、生活の質を大きく低下させます。一人で悩まず、お気軽にご相談ください。</p>',
        ),
        array(
            'title'    => '脂肪肝は放置しないで — 肝臓からのSOS',
            'date'     => '2026-01-15 10:00:00',
            'category' => $cat_ids['health-column'],
            'excerpt'  => '健康診断で「脂肪肝」を指摘されたことはありませんか？自覚症状がないため放置しがちですが、肝硬変や肝がんに進行するリスクがあります。',
            'content'  => '<h2>脂肪肝とは</h2>
<p>脂肪肝とは、肝臓に脂肪が過剰に蓄積した状態です。健康診断の腹部エコーや血液検査で発見されることが多く、日本人の約3人に1人が脂肪肝を有しているとされています。</p>

<h2>脂肪肝の種類</h2>
<ul>
<li><strong>アルコール性脂肪肝</strong> — 飲酒習慣が原因</li>
<li><strong>非アルコール性脂肪性肝疾患（NAFLD）</strong> — 飲酒しない方にも起こる脂肪肝</li>
<li><strong>NASH（非アルコール性脂肪肝炎）</strong> — NAFLDのうち炎症を伴うもの。肝硬変・肝がんへ進行するリスクあり</li>
</ul>

<h2>なぜ放置してはいけないのか</h2>
<p>脂肪肝は自覚症状がほとんどないため、「たいしたことない」と思われがちです。しかし、NASH（脂肪肝炎）に進行すると、10〜20年かけて肝硬変や肝がんに至るケースがあります。肝臓は「沈黙の臓器」と呼ばれ、症状が出たときにはかなり進行していることも少なくありません。</p>

<h2>当院での検査</h2>
<ul>
<li><strong>血液検査</strong> — 肝機能（AST、ALT、γ-GTP）、線維化マーカー</li>
<li><strong>腹部エコー</strong> — 脂肪の蓄積度合いを直接観察</li>
</ul>

<h2>治療・改善方法</h2>
<p>脂肪肝の治療の基本は生活習慣の改善です。</p>
<ul>
<li><strong>食事</strong> — 糖質・脂質の摂り過ぎに注意、バランスの良い食事</li>
<li><strong>運動</strong> — 週150分以上の有酸素運動が推奨</li>
<li><strong>体重管理</strong> — 体重の7%減量で脂肪肝が改善するとのデータも</li>
<li><strong>節酒・禁酒</strong> — アルコール性の場合は必須</li>
</ul>
<p>健診で脂肪肝を指摘された方は、一度腹部エコーと血液検査で現在の状態を確認されることをおすすめします。当院は消化器・肝臓の専門クリニックとして、脂肪肝の精査・フォローにも対応しています。</p>',
        ),
    );

    // 全投稿を作成
    $all_posts = array_merge($news_posts, $article_posts);
    foreach ($all_posts as $post_data) {
        $post_id = wp_insert_post(array(
            'post_title'   => $post_data['title'],
            'post_content' => $post_data['content'],
            'post_excerpt' => $post_data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => $post_data['date'],
            'post_category' => array($post_data['category']),
        ));
    }

    update_option('midori_v2_demo_content_created', true);
}
add_action('after_switch_theme', 'midori_create_demo_content');

// =========================================================
// テーマ内ヘルパー関数
// =========================================================

// 設定値取得
function midori_get($setting, $default = '') {
    return get_theme_mod($setting, $default);
}

// プレースホルダー画像生成
function midori_placeholder($label, $class = 'placeholder-landscape', $icon = 'image') {
    $icons = array(
        'image'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>',
        'building'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18M5 21V7l8-4v18M13 21V3l6 3v15M9 7h.01M9 11h.01M9 15h.01M17 8h.01M17 12h.01M17 16h.01"/></svg>',
        'user'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg>',
        'medical'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M2 12h20"/><rect x="5" y="5" width="14" height="14" rx="2"/></svg>',
        'camera'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>',
    );
    $svg = isset($icons[$icon]) ? $icons[$icon] : $icons['image'];
    echo '<div class="placeholder-img ' . esc_attr($class) . '">' . $svg . '<span>' . esc_html($label) . '</span></div>';
}

// パンくずリスト
function midori_breadcrumb() {
    echo '<nav class="breadcrumb"><div class="container">';
    echo '<a href="' . esc_url(home_url('/')) . '">ホーム</a>';
    if (is_single()) {
        echo '<span>›</span><a href="' . esc_url(get_permalink(get_page_by_path('useful-info'))) . '">お役立ち情報</a>';
        echo '<span>›</span>' . get_the_title();
    } elseif (is_page()) {
        echo '<span>›</span>' . get_the_title();
    } elseif (is_category()) {
        echo '<span>›</span>' . single_cat_title('', false);
    }
    echo '</div></nav>';
}

// 診療時間テーブル出力（水曜午後は休診）
function midori_timetable() {
    $am_label    = esc_html(midori_get('timetable_am_label',    '9:00〜12:30'));
    $pm_label    = esc_html(midori_get('timetable_pm_label',    '14:00〜18:00'));
    $sat_note    = esc_html(midori_get('timetable_am_sat_note', '9:00〜13:00'));
    $note1       = esc_html(midori_get('timetable_note1',       '受付は診療終了30分前まで'));
    $note2       = esc_html(midori_get('timetable_note2',       '休診日：水曜午後・日曜・祝日'));
    $note3       = esc_html(midori_get('timetable_note3',       '内視鏡検査は完全予約制'));
    ?>
    <table class="timetable">
        <thead>
            <tr>
                <th></th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th class="sat">土</th>
                <th class="sun">日・祝</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>午前<br><small><?php echo $am_label; ?></small></th>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="half">○<br><small><?php echo $sat_note; ?></small></td>
                <td class="closed">−</td>
            </tr>
            <tr>
                <th>午後<br><small><?php echo $pm_label; ?></small></th>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="closed">−</td>
                <td class="open">○</td>
                <td class="open">○</td>
                <td class="closed">−</td>
                <td class="closed">−</td>
            </tr>
        </tbody>
    </table>
    <div class="timetable-note">
        <?php if ($note1) : ?><p>※ <?php echo $note1; ?></p><?php endif; ?>
        <?php if ($note2) : ?><p>※ <?php echo $note2; ?></p><?php endif; ?>
        <?php if ($note3) : ?><p>※ <?php echo $note3; ?></p><?php endif; ?>
    </div>
    <?php
}

// 電話番号をtel:リンク用に変換
function midori_tel_url($tel = null) {
    if ($tel === null) {
        $tel = midori_get('clinic_tel', '03-0000-0000');
    }
    return 'tel:' . preg_replace('/[^0-9]/', '', $tel);
}

// 改行区切りテキストをリストとして出力
function midori_render_list($setting, $default = '') {
    $text = midori_get($setting, $default);
    $lines = array_filter(array_map('trim', explode("\n", $text)));
    if (empty($lines)) return;
    echo '<ul>';
    foreach ($lines as $line) {
        echo '<li>' . esc_html($line) . '</li>';
    }
    echo '</ul>';
}
