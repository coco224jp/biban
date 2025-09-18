<?php $locale = get_locale(); ?>
<div class="section-marquee">
  <div class="section-marquee__list">
    <div class="section-marquee__item"><span>Search for BIBAN @ kanazawa city!</span><span>Search for BIBAN @ kanazawa city!</span></div>
    <div class="section-marquee__item"><span>Search for BIBAN @ kanazawa city!</span><span>Search for BIBAN @ kanazawa city!</span></div>
  </div>
</div>

<section class="section-map">
  <div class="section-map__head">
    <div class="section-map__ttl">
      <h2 class="section-map__ttl--en">AREA MAP</h2>
    </div>
    <div class="section-map__btnWrap">
      <a href="<?php echo home_url('map/'); ?>" class="c-btn01">
        <span class="c-btn01__txt">VIEW MORE</span>
        <span class="btn-arw"></span>
      </a>
    </div>
  </div>
  <ul class="section-map__list">
    <li class="section-map__item">
      <a href="<?php echo home_url('category/west/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">WEST</p>
          <h3 class="item-ttl--ja">県庁・大野周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">WEST</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
    <li class="section-map__item">
      <a href="<?php echo home_url('category/north/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">NORTH</p>
          <h3 class="item-ttl--ja">ひがし茶屋街・森本周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">NORTH</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
    <li class="section-map__item">
      <a href="<?php echo home_url('category/ekinishi/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">EKINISHI</p>
          <h3 class="item-ttl--ja">西金沢駅周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">EKINISHI</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
    <li class="section-map__item">
      <a href="<?php echo home_url('category/center/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">CENTER</p>
          <h3 class="item-ttl--ja">金沢駅・兼六園周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">CENTER</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
    <li class="section-map__item">
      <a href="<?php echo home_url('category/east/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">EAST</p>
          <h3 class="item-ttl--ja">小立野・湯涌周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">EAST</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
    <li class="section-map__item">
      <a href="<?php echo home_url('category/south/'); ?>">
        <div class="item-img"><img loading="lazy" src="/assets/img/noimage02.png" width="130" height="130" alt=""></div>
        <div class="item-ttl">
          <?php if ($locale == 'ja'): ?>
          <p class="item-ttl--en">SOUTH</p>
          <h3 class="item-ttl--ja">にし茶屋街・寺町周辺</h3>
          <?php else: ?>
          <h3 class="item-ttl--en">SOUTH</h3>
          <?php endif; ?>
        </div>
        <div class="item-btnWrap">
          <span class="c-btn01">
            <span class="c-btn01__txt">VIEW MORE</span>
            <span class="btn-arw"></span>
          </span>
        </div>
      </a>
    </li>
  </ul>
  <div class="section-map__box">
    <?php if ($locale == 'ja') {
      echo do_shortcode('[wpgmza id="1" cat="16,19,21,23,25,27"]');
    } else {
      echo do_shortcode('[wpgmza id="1" cat="17,20,22,24,26,28"]');
    } ?>
  </div>
</section>