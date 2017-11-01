<?php get_header(); ?>

<div class="page-title">
  <div class="container">
    <h3><?php the_title(); ?></h3>
  </div>
</div>

<div class="sections">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
