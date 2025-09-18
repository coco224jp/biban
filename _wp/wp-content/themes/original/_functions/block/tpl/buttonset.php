<?php if( have_rows('set_button') ):
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
?>
<div class="section-comp__btn-wrap <?php echo esc_attr($classes); ?>">
  <?php while ( have_rows('set_button') ) : the_row(); ?>
  <?php
      $link = get_sub_field('set_button_link');
      $linkUrl = $link['url'];
      $linkTitle = $link['title'];
      $linkTarget = $link['target'];
      $linkBack = get_sub_field('set_button_back');
    ?>
  <?php if(!($linkBack === true)): ?>
  <a href="<?php echo esc_url( $linkUrl ); ?>" <?php if( $linkTarget ): ?>target="<?php echo esc_attr( $linkTarget ); ?>" rel="noopener noreferrer" <?php endif; ?> class="c-btn01">
    <span class="c-btn01__txt"><?php if( !empty($linkTitle) ): echo esc_html( $linkTitle ); else: echo 'Learn More'; esc_html( $linkTitle ); endif; ?></span>
    <span class="btn-arw"></span>
  </a>
  <?php else: ?>
  <a href="<?php echo esc_url( $linkUrl ); ?>" class="c-btn01 back">
    <span class="c-btn01__txt">Back</span>
    <span class="btn-arw"></span>
  </a>
  <?php endif; ?>
  <?php endwhile; ?>
</div>
<?php endif; ?>