<?php get_header(); ?>

<main id="main" class="pickup">

  <div class="c-mv">
    <div class="c-mv__container">
      <div class="c-mv__inner">
        <p class="c-mv__ttl">PICKUP</p>
      </div>
    </div>
  </div>

  <div class="pickup-detail-mv">
    <div class="pickup-detail-mv__container">
      <?php $post_title = get_the_title(); ?>
      <?php if ( has_post_thumbnail($post->ID)): ?>
      <?php
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
        $src = $image[0];
        $alt = $post_title;
      ?>
      <div class="pickup-detail-mv__img"><img src="<?php echo $src; ?>" width="1920" height="1080" alt="<?php echo $alt; ?>"></div>
      <?php endif; ?>
    </div>
  </div>

  <div id="contents">
    <section class="pickup-detail-head">
      <div class="pickup-detail-head__container">
        <div class="pickup-detail-head__inner">
          <h1 class="pickup-detail-head__ttl"><?php echo $post_title; ?></h1>
          <?php $lead = get_field('pickup_lead');
            if ($lead):
          ?>
          <p class="pickup-detail-head__lead"><?php echo $lead; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php
      if (have_posts()){
        while (have_posts()){
          the_post();
          the_content();
        }
      }
    ?>

    <?php get_template_part('include/map'); ?>

    <?php get_template_part('include/aside'); ?>
  </div>

</main>

<?php get_footer(); ?>