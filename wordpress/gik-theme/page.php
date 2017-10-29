<?php get_header(); ?>

<div class="sections">
  <section>
    <div class="container">
      <h3><?php the_title(); ?></h3>
    </div>
  </section>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section>
      <div class="container">
        <p><?php the_content(); ?></p>
      </div>
    </section>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
