<?php get_header(); ?>

<main id="main" class="parts">

  <div class="c-mv">
    <div class="c-mv__container">
      <div class="c-mv__inner">
        <h1 class="c-mv__ttl"><?php echo the_title_attribute(); ?></ha>
      </div>
    </div>
  </div>

  <div class="parts-mv">
    <div class="parts-mv__container">
      <?php $post_title = get_the_title(); ?>
      <?php if ( has_post_thumbnail($post->ID)): ?>
      <?php
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
        $src = $image[0];
        $alt = $post_title;
      ?>
      <div class="parts-mv__img"><img src="<?php echo $src; ?>" width="1920" height="1080" alt="<?php echo $alt; ?>"></div>
      <?php endif; ?>
    </div>
  </div>

  <div id="contents">
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