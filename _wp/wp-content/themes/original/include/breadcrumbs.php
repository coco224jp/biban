<div class="l-breadcrumbs">
  <div class="container">
    <div class="l-breadcrumbs__inner inview">
      <?php
        if(function_exists( 'yoast_breadcrumb' )){
          yoast_breadcrumb( '<p id="breadcrumbs" class="pageBread">', '</p>');
        }
      ?>
    </div>
  </div>
</div>