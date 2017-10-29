<?php /* Template Name: Frontpage */ ?>

<?php get_header(); ?>

  <!-- frontpage image -->
  <div class="frontpage-header-image"></div>
  <!-- sections -->
  <div class="sections">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <!-- section -->
      <section>
        <div class="container">
          <h3><?php the_title(); ?></h3>
          <p><?php the_content(); ?></p>
        </div>
      </section>
    
    <?php endwhile; endif; ?>
  </div>

<?php get_footer(); ?>
