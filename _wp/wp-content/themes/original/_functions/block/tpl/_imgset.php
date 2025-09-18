<?php
$col = "";

switch (get_field('カラム数')) {
    case '1カラム':
        $col = 'col1';
        break;
    case '2カラム':
        $col = 'col2';
        break;
    case '3カラム':
        $col = 'col3';
        break;
    case '4カラム':
        $col = 'col4';
        break;
    default:
        break;
}

$type = get_field('タイプ');

?>
<div class="img_set <?php echo $col; ?>" <?php echo (isset($block['anchor']) && $block['anchor'])? ' id="'. $block['anchor'] .'" ' : ''; ?>>

  <?php if(have_rows('画像')): ?>
  <?php while(have_rows('画像')): the_row(); ?>

  <?php
        $img = get_sub_field('画像');
        $img = (isset($img["sizes"]["large"]) && $img["sizes"]["large"])? $img["sizes"]["large"] : "";

        $resize = (get_sub_field('サイズ') == "フィット")? "contain" : "cover";
        $resize2 = (get_sub_field('サイズ') == "フィット")? "img_set_contain" : "";
        $target = (get_sub_field('リンクタイプ'))? ' target="_blank" ' : '';
    ?>


  <figure class="img_set_box">
    <div class="img_set_img <?php echo $resize2; ?>"><img class="<?php echo $resize; ?>" src="<?php echo $img; ?>" alt=""></div>
    <?php if ($type == "キャプション") { ?>
    <?php if(get_sub_field('キャプション')){ ?><figcaption class="img_set_ttl"><?php echo get_sub_field('キャプション'); ?></figcaption><?php } ?>
    <?php if(get_sub_field('キャプションサブ')){ ?><p class="img_set_ttl2"><?php echo get_sub_field('キャプションサブ'); ?></p><?php } ?>
    <?php }else if ($type == "キャプション長文") { ?>
    <?php if(get_sub_field('キャプション')){ ?><figcaption class="img_set_ttl"><?php echo get_sub_field('キャプション'); ?></figcaption><?php } ?>
    <?php if(get_sub_field('キャプション長文')){ ?><p class="img_set_mes"><?php echo get_sub_field('キャプション長文'); ?></p><?php } ?>
    <?php }else{ ?>
    <p class="img_set_link"><a href="<?php echo get_sub_field('リンクURL'); ?>" <?php echo $target; ?>><?php echo get_sub_field('リンクタイトル'); ?></a></p>
    <?php } ?>
  </figure>

  <?php endwhile; ?>
  <?php endif; ?>

</div>