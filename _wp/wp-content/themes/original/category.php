<?php
  $locale = get_locale();
  $url = $_SERVER['REQUEST_URI'];
?>
<?php get_header(); ?>

<main id="main" class="map">

  <div class="c-mv">
    <div class="c-mv__container">
      <div class="c-mv__inner">
        <h2 class="c-mv__ttl">BIBAN LIST</h2>
      </div>
    </div>
  </div>

  <div class="map-mv">
    <?php if ($locale == 'ja') {
      if(strpos($url,'west')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="19"]');
      } elseif(strpos($url,'north')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="21"]');
      } elseif(strpos($url,'ekinishi')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="23"]');
      } elseif(strpos($url,'center')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="16"]');
      } elseif(strpos($url,'east')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="25"]');
      } elseif(strpos($url,'south')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="27"]');
      } else {
        echo do_shortcode('[wpgmza id="1" cat="0"]');
      }
    } else {
      if(strpos($url,'west')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="20"]');
      } elseif(strpos($url,'north')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="22"]');
      } elseif(strpos($url,'ekinishi')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="24"]');
      } elseif(strpos($url,'center')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="17"]');
      } elseif(strpos($url,'east')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="26"]');
      } elseif(strpos($url,'south')!== false) {
        echo do_shortcode('[wpgmza id="1" cat="28"]');
      } else {
        echo do_shortcode('[wpgmza id="1" cat="0"]');
      }
    } ?>
  </div>

  <?php //get_template_part('include/breadcrumbs'); ?>

  <div id="contents" class="l-contents --cols2">
    <div class="l-contents__main">

      <section id="map-cont" class="map-cont">
        <div class="map-cont__inner">

          <?php if (have_posts()): ?>
          <ul class="map-cont__list">
            <?php while (have_posts()) : the_post(); ?>
            <li class="map-cont__item">
              <a href="<?php the_permalink(); ?>">
                <?php
                  $image = get_field('biban_image_list');
                  if( !empty($image) ):
                  $alt = $image['alt'];
                  $size = 'large';
                  $thumb = $image['sizes'][ $size ];
                ?>
                <div class="item-img"><img loading="lazy" src="<?php echo $thumb; ?>" width="388" height="388" alt="<?php echo $alt; ?>"></div>
                <?php else: ?>
                <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="388" height="388" alt="NO IMAGE"></div>
                <?php endif; ?>
                <h3 class="item-ttl"><?php the_title(); ?></h3>
                <div class="item-time"><span><time datetime="<?php the_modified_time('Y.m.d'); ?>"><?php the_time('Y.m.d'); ?></time> | UPDATE</span></div>
                <div class="item-btnWrap">
                  <span class="c-btn01">
                    <span class="c-btn01__txt">VIEW MORE</span>
                    <span class="btn-arw"></span>
                  </span>
                </div>
              </a>
            </li>
            <?php endwhile; ?>

            <li class="map-cont__item">
              <a href="#">
                <div class="item-img"><img src="https://placehold.jp/388x388.png" width="388" height="388" alt=""></div>
                <h3 class="item-ttl">サンニコラ香林坊店</h3>
                <div class="item-time"><span><time datetime="">2023.7.20</time> | UPDATE</span></div>
                <div class="item-btnWrap">
                  <span class="c-btn01">
                    <span class="c-btn01__txt">VIEW MORE</span>
                    <span class="btn-arw"></span>
                  </span>
                </div>
              </a>
            </li>
            <li class="map-cont__item">
              <a href="#">
                <div class="item-img"><img src="https://placehold.jp/388x388.png" width="388" height="388" alt=""></div>
                <h3 class="item-ttl">サンニコラ香林坊店</h3>
                <div class="item-time"><span><time datetime="">2023.7.20</time> | UPDATE</span></div>
                <div class="item-btnWrap">
                  <span class="c-btn01">
                    <span class="c-btn01__txt">VIEW MORE</span>
                    <span class="btn-arw"></span>
                  </span>
                </div>
              </a>
            </li>
            <li class="map-cont__item">
              <a href="#">
                <div class="item-img"><img src="https://placehold.jp/388x388.png" width="388" height="388" alt=""></div>
                <h3 class="item-ttl">サンニコラ香林坊店</h3>
                <div class="item-time"><span><time datetime="">2023.7.20</time> | UPDATE</span></div>
                <div class="item-btnWrap">
                  <span class="c-btn01">
                    <span class="c-btn01__txt">VIEW MORE</span>
                    <span class="btn-arw"></span>
                  </span>
                </div>
              </a>
            </li>
          </ul>
          <?php endif; ?>

          <?php if ( function_exists( 'pagination' ) ) : ?>
          <?php pagination( $wp_query->max_num_pages, get_query_var( 'paged' ) ); ?>
          <?php endif; ?>

        </div>
      </section>
    </div>

    <div class="l-contents__sidebar">
      <div class="c-widget">
        <div class="c-widget__ttl">
          <h2 class="c-widget__ttl--en">AREA</h2>
        </div>
        <ul class="c-widget__catList">
          <li class="cat-item cat-item-1"><a href="<?php echo home_url('map/'); ?>">ALL</a></li>
          <?php
          // タームの一覧を表示
          $catlist = wp_list_categories(array(
            'parent' => '0',
            'taxonomy' => 'category', // タクソノミーの指定
            'title_li' => '', // リストの外側に表示されるタイトルを非表示
            'show_count' => 0, // カテゴリの投稿数を表示
            'echo' => 0 // 設定した値を返す
          ));
          echo preg_replace( '/<a (.*?)>(.*?)<\/a>/', '<a $1>$2</a>', $catlist );
          ?>
        </ul>
      </div>
    </div>

    <div class="l-contents__aside">
      <?php get_template_part('include/aside'); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>