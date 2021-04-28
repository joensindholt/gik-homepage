<?php get_header(); ?>

  <h1>Foo</h1>

  <?php
    while ( have_posts() ) : the_post();
      get_template_part( 'content', 'page' );

      if ( comments_open() || get_comments_number() ) :
              comments_template();
      endif;
    endwhile;
  ?>

<?php get_footer(); ?>
