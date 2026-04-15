<?php get_header(); ?>

<div class="page-hero">
  <div class="container">
    <div class="section-heading">
      <span class="section-heading-en">Not Found</span>
      <h1 class="section-heading-jp">ページが見つかりません</h1>
    </div>
  </div>
</div>

<section class="section section-white">
  <div class="container">
    <div class="page-404">
      <h2>404</h2>
      <h3>お探しのページは見つかりませんでした</h3>
      <p>ページが移動または削除された可能性があります。</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-arrow">トップページへ戻る</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
