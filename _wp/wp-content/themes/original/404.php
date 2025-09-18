<?php get_header(); ?>

<main id="main" class="notfound">

  <div class="c-mv">
    <div class="c-mv__container">
      <div class="c-mv__inner">
        <h1 class="c-mv__ttl" style="text-align:center;">404</h1>
      </div>
    </div>
  </div>

  <div id="contents">
    <section class="section-comp generic">
      <div class="wp-block-group__inner-container">
        <div class="section-comp__inner">
          <div class="notfound-cont__btn-box tac">
            <p>We are sorry but the page you are looking for does not exsit.<br>You could return to the homepage.</p>
            <a href="<?php echo home_url(); ?>" class="c-btn01 back">
              <span class="c-btn01__txt">Back to Top Page</span>
              <span class="btn-arw"></span>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>