
<!DOCTYPE html>
<html>
<head>
<?php get_template_part( '_meta' );
?>
</head>
<body>
<?php get_template_part( '_header' );
?>

<ul>
<?php query_posts($query_string); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
 <li><a href="<?php the_permalink(); ?>"><span><?php echo get_the_date("Y.m.d"); ?></span><?php the_title(); ?></a></li>
<?php endwhile; endif; ?>
</ul>


<?php get_template_part( '_footer' );
?>
</body>
</html>