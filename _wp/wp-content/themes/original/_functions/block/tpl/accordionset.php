<?php if( have_rows('parts_accordion') ):
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
?>
<div class="section-comp__ac-list <?php echo esc_attr($classes); ?>">
  <?php while ( have_rows('parts_accordion') ) : the_row(); ?>
  <?php
    $acHead = get_sub_field('parts_accordion_heading');
    $acMain= get_sub_field('parts_accordion_main');
  ?>
  <div class="section-comp__ac-item">
    <div class="section-comp__ac-item--heading js-accordion">
      <h3 class="heading-ttl"><span><?php echo $acHead; ?></span></h3>
      <span class="heading-btn">
        <i class="btn-plus"></i>
      </span>
    </div>
    <div class="section-comp__ac-item--main">
      <?php echo $acMain; ?>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php endif; ?>