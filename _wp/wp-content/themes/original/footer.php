<?php $locale = get_locale(); ?>
<footer class="l-footer">
  <div class="l-footer__pagetop">
    <a href="#main" class="pagetop-link"><span></span></a>
  </div>
  <div class="l-footer__container">
    <div class="l-footer__inner">
    <!-- <p class="l-footer__logo"><img src="/assets/img/logo-footer.png" width="930" height="248" alt="美板 魅力ある看板から考える 金沢の景観" /></p> -->
    <?php /*
    <div class="l-footer__main">
        <div class="l-footer__main-top l-footer__nav">
          <?php if ($locale == 'ja'): ?>
          <?php if( have_rows('footer_nav_repeat01', 'option') ): ?>
          <ul class="l-footer__nav-list">
            <?php while ( have_rows('footer_nav_repeat01', 'option') ) : the_row(); ?>
            <?php
              $link = get_sub_field('footer_nav_repeat01_link', 'option');
              $linkUrl = $link['url'];
              $linkTitle = $link['title'];
              $linkTarget = $link['target'];
            ?>
            <li class="l-footer__nav-item">
              <a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?> class="item-link">
                <span class="item-txt"><?php echo esc_html( $linkTitle ); ?></span>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
          <?php else: ?>
          <?php if( have_rows('footer_nav_repeat01_en', 'option') ): ?>
          <ul class="l-footer__nav-list">
            <?php while ( have_rows('footer_nav_repeat01_en', 'option') ) : the_row(); ?>
            <?php
              $link = get_sub_field('footer_nav_repeat01_en_link', 'option');
              $linkUrl = $link['url'];
              $linkTitle = $link['title'];
              $linkTarget = $link['target'];
            ?>
            <li class="l-footer__nav-item">
              <a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?> class="item-link">
                <span class="item-txt"><?php echo esc_html( $linkTitle ); ?></span>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
          <?php endif; ?>
        </div>
        <!-- <div class="l-footer__main-bottom">
          <?php if ($locale == 'ja'): ?>
          <p class="l-footer__info">金沢美術工芸大学ホリスティックデザイン専攻<br>
            坂野研究室<br>
            〒920-8656 石川県金沢市小立野2-40<br>
            tel. 076-262-3518<br>
            e-mail sakano@kanazawa-bidai.ac.jp</p>
          <?php else: ?>
          <p class="l-footer__info">Kanazawa美術工芸大学ホリスティックデザイン専攻<br>
            坂野研究室<br>
            〒920-8656 石川県金沢市小立野2-40<br>
            tel. 076-262-3518<br>
            e-mail sakano@kanazawa-bidai.ac.jp</p>
          <?php endif; ?>
        </div> -->
      </div>
      */ ?>

      <copy class="l-footer__copyright">copyright @ biban2025</copy>
    </div>

  </div>
</footer>
<?php wp_footer(); ?>

<script>
document.addEventListener('touchstart', function() {});
</script>

</body>

</html>