<?php $locale = get_locale(); ?>
<?php
  $url_instagram = '';
  $url_x = '';
  $url_facebook = '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="is-loaded--fix">

<head>
  <?php get_template_part('include/g-tag01'); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?></title>

  <meta name="keywords" content="" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <link rel="apple-touch-icon" type="image/x-icon" href="/assets/img/favicons/icon.png">
  <link rel="icon" type="image/vnd.microsoft.icon" href="/assets/img/favicons/favicon.ico">
  <?php get_template_part('include/webfonts'); ?>
  <script type="text/javascript" src="/assets/js/jquery-3.7.1.min.js"></script>
  <?php wp_head(); ?>
</head>

<body id="body">
  <?php get_template_part('include/g-tag02'); ?>
  <div class="l-loader"></div>

  <header id="header" class="l-header">

    <div class="l-hnav-lang-Wrap">
      <nav class="l-hnav">

      <?php if ($locale == 'ja'): ?>

      <?php if( have_rows('header_nav_repeat01', 'option') ): ?>
      <ul class="l-hnav__list">
        <?php while ( have_rows('header_nav_repeat01', 'option') ) : the_row();
          $link = get_sub_field('header_nav_repeat01_link', 'option');
          $linkUrl = $link['url'];
          $linkTitle = $link['title'];
          $linkTarget = $link['target'];
        ?>
        <li class="l-hnav__item <?php if( have_rows('header_nav_repeat02', 'option') ): ?>--has-child<?php endif; ?>">
          <a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><span class="item-txt"><?php echo esc_html( $linkTitle ); ?></span><?php if( have_rows('header_nav_repeat02', 'option') ): ?><span class="btn-plus"></span><?php endif; ?></a>
          <?php if( have_rows('header_nav_repeat02', 'option') ): ?>
          <div class="l-hnav__popup-box">
            <ul class="l-hnav__popup-list">
              <?php while ( have_rows('header_nav_repeat02', 'option') ) : the_row();
                $link2 = get_sub_field('header_nav_repeat02_link', 'option');
                $linkUrl2 = $link2['url'];
                $linkTitle2 = $link2['title'];
                $linkTarget2 = $link2['target'];
              ?>
              <li class="l-hnav__popup-item">
                <a href="<?php echo esc_url( $linkUrl2 ); ?>" <?php if( $linkTarget2 ): ?>target="<?php echo esc_attr( $linkTarget2 ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle2 ); ?></a>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endif; ?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>
      
      <?php else: ?>

      <?php if( have_rows('header_nav_repeat01_en', 'option') ): ?>
      <ul class="l-hnav__list">
        <?php while ( have_rows('header_nav_repeat01_en', 'option') ) : the_row();
          $link = get_sub_field('header_nav_repeat01_en_link', 'option');
          $linkUrl = $link['url'];
          $linkTitle = $link['title'];
          $linkTarget = $link['target'];
        ?>
        <li class="l-hnav__item <?php if( have_rows('header_nav_repeat02_en', 'option') ): ?>--has-child<?php endif; ?>">
          <a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><span class="item-txt"><?php echo esc_html( $linkTitle ); ?></span><?php if( have_rows('header_nav_repeat02_en', 'option') ): ?><span class="btn-plus"></span><?php endif; ?></a>
          <?php if( have_rows('header_nav_repeat02_en', 'option') ): ?>
          <div class="l-hnav__popup-box">
            <ul class="l-hnav__popup-list">
              <?php while ( have_rows('header_nav_repeat02_en', 'option') ) : the_row();
                $link2 = get_sub_field('header_nav_repeat02_en_link', 'option');
                $linkUrl2 = $link2['url'];
                $linkTitle2 = $link2['title'];
                $linkTarget2 = $link2['target'];
              ?>
              <li class="l-hnav__popup-item">
                <a href="<?php echo esc_url( $linkUrl2 ); ?>" <?php if( $linkTarget2 ): ?>target="<?php echo esc_attr( $linkTarget2 ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle2 ); ?></a>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endif; ?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>
      
      <?php endif; ?><!-- check $locale -->
      </nav>

      <?php /*
      <div class="l-header__lang">
        <ul class="bogo-language-switcher">
          <?php if ($_SERVER['SERVER_NAME'] === 'localhost') {
            $link = 'http://localhost:3000';
          } elseif ($_SERVER['SERVER_NAME'] === 'biban.testsite.help') {
            $link = 'https://biban.testsite.help';
          } else {
            $link = $_SERVER['HTTP_HOST'];
          } ?>
          <?php if ($locale == 'ja'): ?>
          <li class="ja current"><a rel="alternate" hreflang="ja" href="<?php echo home_url(); ?>" title="JA" class="current" aria-current="page">JA</a></li>
          <li class="en"><a rel="alternate" hreflang="en-US" href="<?php echo home_url(); ?>/en/" title="EN">EN</a></li>
          <?php else: ?>
          <li class="ja"><a rel="alternate" hreflang="ja" href="<?php echo $link; ?>" title="JA">JA</a></li>
          <li class="en current"><a rel="alternate" hreflang="en-US" href="<?php echo home_url(); ?>" title="EN" class="current" aria-current="page">EN</a></li>
          <?php endif; ?>
        </ul>
        <?php //echo do_shortcode('[bogo]'); ?>
      </div>
      */ ?>

    </div><!-- /.l-hnav-lang-Wrap -->

    <!-- <div class="l-header__sns">
      <a href="<?php echo $url_instagram; ?>" target="_blank" rel="noopener noreferrer" class="instagram"></a>
      <a href="<?php echo $url_x; ?>" target="_blank" rel="noopener noreferrer" class="x"></a>
      <a href="<?php echo $url_facebook; ?>" target="_blank" rel="noopener noreferrer" class="facebook"></a>
    </div> -->

    <div class="l-header__gnav">
      <div class="l-header__gnav-inner">
        <nav class="l-gnav">
          <div class="l-gnav__main">
            <?php if ($locale == 'ja'): ?>

            <?php if( have_rows('header_nav_repeat01', 'option') ): ?>
            <div class="l-gnav__nav">
              <?php while ( have_rows('header_nav_repeat01', 'option') ) : the_row();
                $link = get_sub_field('header_nav_repeat01_link', 'option');
                $linkUrl = $link['url'];
                $linkTitle = $link['title'];
                $linkTarget = $link['target'];
              ?>
              <div class="l-gnav__nav-unit">
                <?php if( have_rows('header_nav_repeat02', 'option') ): ?>
                <p class="l-gnav__nav-ttl ac-heading"><a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle ); ?></a><span class="btn-plus"></span></p>
                <ul class="l-gnav__nav-list ac-cont">
                  <?php while ( have_rows('header_nav_repeat02', 'option') ) : the_row();
                  the_row();
                  $link2 = get_sub_field('header_nav_repeat02_link', 'option');
                  $linkUrl2 = $link2['url'];
                  $linkTitle2 = $link2['title'];
                  $linkTarget2 = $link2['target'];
                ?>
                  <li class="l-gnav__nav-item"><a href="<?php echo esc_url( $linkUrl2 ); ?>" <?php if( $linkTarget2 ): ?>target="<?php echo esc_attr( $linkTarget2 ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle2 ); ?></a></li>
                  <?php endwhile; ?>
                </ul>
                <?php else: ?>
                <p class="l-gnav__nav-ttl"><a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle ); ?><span class="btn-arw"></span></a></p>
                <?php endif; ?>
              </div>
              <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <?php else: ?>

            <?php if( have_rows('header_nav_repeat01_en', 'option') ): ?>
            <div class="l-gnav__nav">
              <?php while ( have_rows('header_nav_repeat01_en', 'option') ) : the_row();
                $link = get_sub_field('header_nav_repeat01_en_link', 'option');
                $linkUrl = $link['url'];
                $linkTitle = $link['title'];
                $linkTarget = $link['target'];
              ?>
              <div class="l-gnav__nav-unit">
                <?php if( have_rows('header_nav_repeat02_en', 'option') ): ?>
                <p class="l-gnav__nav-ttl ac-heading"><a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle ); ?></a><i class="btn-plus"></i></p>
                <ul class="l-gnav__nav-list ac-cont">
                  <?php while ( have_rows('header_nav_repeat02_en', 'option') ) : the_row();
                  the_row();
                  $link2 = get_sub_field('header_nav_repeat02_en_link', 'option');
                  $linkUrl2 = $link2['url'];
                  $linkTitle2 = $link2['title'];
                  $linkTarget2 = $link2['target'];
                ?>
                  <li class="l-gnav__nav-item"><a href="<?php echo esc_url( $linkUrl2 ); ?>" <?php if( $linkTarget2 ): ?>target="<?php echo esc_attr( $linkTarget2 ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle2 ); ?></a></li>
                  <?php endwhile; ?>
                </ul>
                <?php else: ?>
                <p class="l-gnav__nav-ttl"><a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html( $linkTitle ); ?><span class="btn-arw"></span></a></p>
                <?php endif; ?>
              </div>
              <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <?php endif; ?>

            <div class="l-gnav__nav-sns">
              <a href="<?php echo $url_instagram; ?>" target="_blank" rel="noopener noreferrer" class="instagram"></a>
              <a href="<?php echo $url_x; ?>" target="_blank" rel="noopener noreferrer" class="x"></a>
              <a href="<?php echo $url_facebook; ?>" target="_blank" rel="noopener noreferrer" class="facebook"></a>
            </div>
            <copy class="l-gnav__nav-copyright">copyright @2024 Cityscape Planning Section, Kanazawa</copy>
          </div>
        </nav>
      </div>
    </div>
    
    <?php /*
    <div class="l-header__lang">
      <ul class="bogo-language-switcher">
        <?php if ($_SERVER['SERVER_NAME'] === 'localhost') {
          $link = 'http://localhost:3000';
        } elseif ($_SERVER['SERVER_NAME'] === 'biban.testsite.help') {
          $link = 'https://biban.testsite.help';
        } else {
          $link = $_SERVER['HTTP_HOST'];
        } ?>
        <?php if ($locale == 'ja'): ?>
        <li class="ja current"><a rel="alternate" hreflang="ja" href="<?php echo home_url(); ?>" title="JA" class="current" aria-current="page">JA</a></li>
        <li class="en"><a rel="alternate" hreflang="en-US" href="<?php echo home_url(); ?>/en/" title="EN">EN</a></li>
        <?php else: ?>
        <li class="ja"><a rel="alternate" hreflang="ja" href="<?php echo $link; ?>" title="JA">JA</a></li>
        <li class="en current"><a rel="alternate" hreflang="en-US" href="<?php echo home_url(); ?>" title="EN" class="current" aria-current="page">EN</a></li>
        <?php endif; ?>
      </ul>
      <?php //echo do_shortcode('[bogo]'); ?>
    </div>
    */ ?>

    <button class="l-header__menu">
      <span></span>
    </button>
  </header>