<?php
/*
Template Name: front
*/

$locale = get_locale();
?>

<?php get_header(); ?>

<main id="main" class="front">
  <div id="mv" class="front-masonry">
    <div class="front-masonry__container">
      <div class="front-masonry__head">
        <p class="front-masonry__ttl">BIBAN</p>
        <p class="front-masonry__txt">
          <?php if ($locale == 'ja'): ?>
          <span class="front-masonry__txt--ja">金沢看板をアートの視点からみる</span>
          <?php endif; ?>
          <span class="front-masonry__txt--en">Cityscape Planning Section, Kanazawa</span>
        </p>
      </div>
      <?php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 20,
          'meta_query' => array(
            array(
              'key' => 'biban_image_masonry_check',
              'value' => '1',
              'compare' => '='
            )
          )
        );
        $the_query = new WP_Query( $args );
      ?>
      <?php if ( $the_query->have_posts() ): ?>
      <div id="masonry" class="front-masonry__main">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="masonry-item">
          <a href="<?php the_permalink(); ?>">
            <?php
              $image = get_field('biban_image_masonry');
              if( !empty($image) ):
              $alt = $image['alt'];
              $size = 'large';
              $thumb = $image['sizes'][ $size ];
              $width = $image['sizes'][ $size . '-width' ];
              $height = $image['sizes'][ $size . '-height' ];
            ?>
            <img class="skip-lazy" src="<?php echo $thumb; ?>" width="<?php echo $width; ?>"
              height="<?php echo $height; ?>" alt="<?php echo $alt; ?>">
            <?php endif; ?>
          </a>
        </div>
        <!--<div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1920x1080.png"></div>
        <div class="masonry-item"><img class="skip-lazy" src="https://placehold.jp/1080x1080.png"></div>-->
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>

  <div id="contents">
    <section id="pickup-list" class="front-pickup">
      <div class="front-pickup__ttl">
        <h2 class="front-pickup__ttl--en">PICKUP</h2>
        <?php if ($locale == 'ja'): ?>
        <p class="front-pickup__ttl--ja">特集記事</p>
        <?php endif; ?>
      </div>
      <?php
        $args = array(
          'post_type' => 'pickup',
          'posts_per_page' => 3,
        );
        $the_query = new WP_Query( $args );
      ?>
      <?php if ( $the_query->have_posts() ): ?>
      <ul class="front-pickup__list">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li class="front-pickup__item">
          <a href="<?php the_permalink(); ?>">
            <?php
              $image = get_field('pickup_image_list');
              if( !empty($image) ):
              $alt = $image['alt'];
              $size = 'large';
              $thumb = $image['sizes'][ $size ];
            ?>
            <div class="item-img"><img loading="lazy" src="<?php echo $thumb; ?>" width="518" height="650"
                alt="<?php echo $alt; ?>"></div>
            <?php else: ?>
            <div class="item-img"><img loading="lazy" src="/assets/img/noimage01.png" width="518" height="650"
                alt="NO IMAGE"></div>
            <?php endif; ?>
            <div class="item-desc">
              <h3 class="item-ttl"><?php the_title(); ?></h3>
              <!-- <p class="item-txt">雰囲気がここだけ異国を感じる。ファサード部分の文字のフォントや旗がある感じや白字に青の差し色が要因だろう。文字に立体感を持たせているところも洋風な雰囲気が出て良い。上の店舗の看板が気になってしまう。</p> -->
              <div class="item-btnWrap">
                <span class="c-btn01">
                  <span class="c-btn01__txt">VIEW MORE</span>
                  <span class="btn-arw"></span>
                </span>
              </div>
            </div>
          </a>
        </li>
        <?php endwhile; ?>
        <?php /*
        <li class="front-pickup__item">
          <a href="#">
            <div class="item-img"><img loading="lazy" src="https://placehold.jp/518x650.png" width="518" height="650"
                alt=""></div>
            <div class="item-desc">
              <h3 class="item-ttl">金沢裏散歩のすすめ雰囲気がここだけ異国を感じる雰囲気がここだけ異国を感じる雰囲気がここだけ異国を感じる</h3>
              <!-- <p class="item-txt">雰囲気がここだけ異国を感じる。ファサード部分の文字のフォントや旗がある感じや白字に青の差し色が要因だろう。文字に立体感を持たせているところも洋風な雰囲気が出て良い。上の店舗の看板が気になってしまう。</p> -->
              <div class="item-btnWrap">
                <span class="c-btn01">
                  <span class="c-btn01__txt">VIEW MORE</span>
                  <span class="btn-arw"></span>
                </span>
              </div>
            </div>
          </a>
        </li>
        */ ?>
      </ul>
      <?php else: ?>
      <p style="margin-block: 5rem; text-align: center;">現在新しい記事はありません</p>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </section>

    <section class="front-recently">
      <div class="front-recently__intro">
        <div class="front-recently__ttl">
          <h2 class="front-recently__ttl--en">RECENTLY</h2>
          <?php if ($locale == 'ja'): ?>
          <p class="front-recently__ttl--ja">新着看板</p>
          <?php endif; ?>
        </div>
        <div class="front-recently__desc">
          <p class="front-recently__txt">
            金沢で見かけた最近きになった看板をご紹介します。金沢で見かけた最近きになった看板をご紹介します。金沢で見かけた最近きになった看板をご紹介します。金沢で見かけた最近きになった看板をご紹介します。</p>
          <div class="front-recently__btnWrap">
            <a href="<?php echo home_url('map/'); ?>" class="c-btn01">
              <span class="c-btn01__txt">VIEW MORE</span>
              <span class="btn-arw"></span>
            </a>
          </div>
        </div>
      </div>

      <?php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 6,
        );
        $the_query = new WP_Query( $args );
      ?>
      <?php if ( $the_query->have_posts() ): ?>
      <ul class="front-recently__list">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li class="front-recently__item">
          <a href="<?php the_permalink(); ?>">
            <?php
              $image = get_field('biban_image_list');
              if( !empty($image) ):
              $alt = $image['alt'];
              $size = 'large';
              $thumb = $image['sizes'][ $size ];
            ?>
            <div class="item-img"><img loading="lazy" src="<?php echo $thumb; ?>" width="388" height="388"
                alt="<?php echo $alt; ?>"></div>
            <?php else: ?>
            <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="388" height="388"
                alt="NO IMAGE"></div>
            <?php endif; ?>
            <h3 class="item-ttl"><?php the_title(); ?></h3>
            <div class="item-time"><span><time
                  datetime="<?php the_modified_time('Y.m.d'); ?>"><?php the_time('Y.m.d'); ?></time> | UPDATE</span>
            </div>
            <div class="item-btnWrap">
              <span class="c-btn01">
                <span class="c-btn01__txt">VIEW MORE</span>
                <span class="btn-arw"></span>
              </span>
            </div>
          </a>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php else: ?>
      <p style="margin-block: 5rem; text-align: center;">新しい記事はありません</p>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </section>

    <?php get_template_part('include/map'); ?>

    <?php get_template_part('include/aside'); ?>
  </div>
</main>

<?php get_footer(); ?>