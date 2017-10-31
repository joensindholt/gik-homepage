<?php get_header(); ?>

<div class="page-title">
  <div class="container">
    <h3><?php the_title(); ?></h3>
  </div>
</div>

<div class="sections">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section>
      <div class="container">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
