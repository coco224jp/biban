<?php $locale = get_locale(); ?>
<?php
  $lead = get_field('biban_lead');
  $address = get_field('biban_address');
  $tel = get_field('biban_tel');
  $open = get_field('biban_open');
  $closed = get_field('biban_closed');
  $remark = get_field('biban_textarea');
  $link = get_field('biban_url');
  $googlemap = get_field('biban_googlemap');
  $poster = get_field('biban_poster');
?>
<?php get_header(); ?>

<main id="main" class="map-detail">

  <div class="map-detail-head">
    <div class="map-detail-head__container">
      <div class="map-detail-head__inner">
        <?php $post_title = get_the_title(); ?>
        <h1 class="map-detail-head__ttl"><?php echo $post_title; ?></h1>
        <div class="map-detail-head__time"><span><time datetime="<?php the_modified_time('Y.m.d'); ?>"><?php //the_time('Y.m.d'); ?>2023.7.20</time> | UPDATE</span></div>
        <p class="map-detail-head__txt"><?php echo $lead; ?></p>
      </div>
    </div>
  </div>

  <div class="map-detail-mv">
    <div class="map-detail-mv__container">
      <?php if ( has_post_thumbnail($post->ID)): ?>
      <?php
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
        $src = $image[0];
        $alt = $post_title;
      ?>
      <div class="map-detail-mv__img"><img src="<?php echo $src; ?>" width="1920" height="1080" alt="<?php echo $alt; ?>"></div>
      <?php endif; ?>
    </div>
  </div>

  <?php //get_template_part('include/breadcrumbs'); ?>

  <div id="contents" class="l-contents --cols2">
    <div class="l-contents__main">

      <section id="map-detail-cont" class="map-detail-cont section-comp generic">
        <div class="map-detail-cont__inner">
          <?php
            if (have_posts()){
              while (have_posts()){
                the_post();
                the_content();
              }
            }
          ?>

          <?php if( !empty($poster) ):?>
          <div class="map-detail-cont__post">
            <?php if ($locale == 'ja'): ?>
            <h3 class="map-detail-cont__post-ttl">書いた人</h3>
            <?php else: ?>
            <h3 class="map-detail-cont__post-ttl">WRITER</h3>
            <?php endif; ?>
            <ul class="map-detail-cont__post-list">
              <?php foreach($poster as $post): ?>
              <?php
                // setup_postdata($post);
                // get_template_part('template/parts', 'post');
                $posterImage = get_post_meta($post->ID, 'poster_image', true);
                $posterNameEn = get_post_meta($post->ID, 'poster_name_en', true);
              ?>
              <li class="map-detail-cont__post-item">
                <?php
                if( !empty($posterImage) ):
                $image = wp_get_attachment_image_src($posterImage,'large');
                $src = $image[0];
                ?>
                <div class="item-icon"><img loading="lazy" src="<?php echo $src; ?>" width="80" height="80" alt="<?php if ($locale == 'ja') { echo $post->post_title; } else { echo $posterNameEn; } ?>"></div>
                <?php else: ?>
                <div class="item-icon"><img loading="lazy" src="/assets/img/noimage03.png" width="80" height="80" alt="<?php if ($locale == 'ja') { echo $post->post_title; } else { echo $posterNameEn; } ?>"></div>
                <?php endif; ?>
                <?php if ($locale == 'ja'): ?>
                <p class="item-txt"><?php echo $post->post_title; ?></p>
                <?php else: ?>
                <p class="item-txt"><?php echo $posterNameEn; ?></p>
                <?php endif; ?>
              </li>
              <?php wp_reset_postdata(); ?>
              <?php endforeach; ?>
              <!-- <li class="map-detail-cont__post-item">
                <div class="item-icon"></div>
                <p class="item-txt">金沢たろう</p>
              </li> -->
            </ul>
          </div>
          <?php endif; ?>

          <?php if( !empty($googlemap) ):?>
          <div class="map-detail-cont__map">
            <h3 class="map-detail-cont__map-ttl">LOCATION MAP</h3>
            <div class="map-detail-cont__map-block">
              <?php if ($locale == 'ja'): ?>
              <?php echo $googlemap; ?>
              <?php else: ?>
              <?php echo $googlemap; ?>
              <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if( !empty($address || $tel || $open || $closed || $remark || $link) ):?>
          <div class="map-detail-cont__info">
            <h3 class="map-detail-cont__info-ttl">INFORMATION</h3>
            <div class="map-detail-cont__info-list">
              <div class="map-detail-cont__info-item">
                <?php
                $squareImage = get_field('biban_image_list');
                if( !empty($squareImage) ):
                $alt = $squareImage['alt'];
                $size = 'large';
                $thumb = $squareImage['sizes'][ $size ];
                ?>
                <div class="item-img"><img loading="lazy" src="<?php echo $thumb; ?>" width="348" height="348" alt="<?php echo $alt; ?>"></div>
                <?php else: ?>
                <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="348" height="348" alt="NO IMAGE"></div>
                <?php endif; ?>
                <?php if ($locale == 'ja') {
                  $dt01 = '住所';
                  $dt02 = 'TEL';
                  $dt03 = '営';
                  $dt04 = '休';
                  $dt05 = '備考欄';
                } else {
                  $dt01 = 'ADDRESS';
                  $dt02 = 'TEL';
                  $dt03 = 'OPEN';
                  $dt04 = 'CLOSED';
                  $dt05 = 'REMARKS';
                } ?>
                <div class="item-desc">
                  <h4 class="item-ttl"><?php the_title(); ?></h4>
                  <dl class="item-dl">
                    <?php if( !empty($address) ):?>
                    <div class="item-di">
                      <dt><?php echo $dt01; ?></dt>
                      <dd><?php echo $address; ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if( !empty($tel) ):?>
                    <div class="item-di">
                      <dt><?php echo $dt02; ?></dt>
                      <dd><?php echo $tel; ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if( !empty($open) ):?>
                    <div class="item-di">
                      <dt><?php echo $dt03; ?></dt>
                      <dd><?php echo $open; ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if( !empty($closed) ):?>
                    <div class="item-di">
                      <dt><?php echo $dt04; ?></dt>
                      <dd><?php echo $closed; ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if( !empty($remark) ):?>
                    <div class="item-di">
                      <dt><?php echo $dt05; ?></dt>
                      <dd><?php echo $remark; ?></dd>
                    </div>
                    <?php endif; ?>
                  </dl>
                  <?php if( !empty($link) ):?>
                  <div class="item-btn">
                    <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="c-btn01">
                      <span class="c-btn01__txt">VIEW MORE</span>
                      <span class="btn-arw"></span>
                    </a>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <div class="map-detail-cont__share">
            <h3 class="map-detail-cont__share-ttl">SHARE</h3>
            <div class="map-detail-cont__share-block">
              <button class="js-share" data-share="x">
                <span class="icon"></span>
              </button>
              <button class="js-share" data-share="facebook">
                <span class="icon"></span>
              </button>
              <button class="js-share" data-share="copy">
                <span class="icon"></span>
                <span class="txt">Copied to clipboard!</span>
              </button>
            </div>
          </div>

          <div class="map-detail-cont__btn-wrap">
            <a href="<?php echo home_url('map/'); ?>" class="c-btn01 back">
              <span class="c-btn01__txt">BACK</span>
              <span class="btn-arw"></span>
            </a>
          </div>
        </div>
      </section>
    </div>

    <div class="l-contents__sidebar">
      <div class="c-widget">
        <div class="c-widget__ttl">
          <h2 class="c-widget__ttl--en">RECENTLY</h2>
        </div>
        <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => 6,
          );
          $the_query = new WP_Query( $args );
        ?>
        <?php if ( $the_query->have_posts() ): ?>
        <ul class="c-widget__list">
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <li class="c-widget__item">
            <a href="<?php the_permalink(); ?>">
              <?php
                $squareImage = get_field('biban_image_list');
                if( !empty($squareImage) ):
                $alt = $squareImage['alt'];
                $size = 'large';
                $thumb = $squareImage['sizes'][ $size ];
              ?>
              <div class="item-img"><img loading="lazy" src="<?php echo $thumb; ?>" width="120" height="120" alt="<?php echo $alt; ?>"></div>
              <?php else: ?>
              <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="120" height="120" alt="NO IMAGE"></div>
              <?php endif; ?>
              <div class="item-desc">
                <h3 class="item-ttl"><?php the_title(); ?></h3>
                <div class="item-time"><span><time datetime="<?php the_modified_time('Y.m.d'); ?>"><?php the_time('Y.m.d'); ?></time> | UPDATE</span></div>
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
        </ul>
        <?php else: ?>
        <!-- <p>新しい記事はありません</p> -->
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>

    <div class="l-contents__aside">
      <?php get_template_part('include/aside'); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>