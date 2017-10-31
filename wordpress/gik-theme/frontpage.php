<?php /* Template Name: Frontpage */ ?>

<?php get_header(); ?>

  <!-- frontpage image -->
  <div class="frontpage-header-image"></div>
  
  <!-- sections -->
  <div class="sections">
    <!-- section -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; endif; ?>

    <!-- memberships -->
    <?php 
    $customfields = get_post_custom();
    $memberships = $customfields['Memberships'];
    if ($memberships) {
    ?>
    <section>
      <div class="container">
        <div class="row justify-content-center">
          <?php
          foreach ($memberships as $membershipData) {
            $membership = explode(';', $membershipData);
          ?>
            <div class="col-sm-6 col-lg-3">
              <div class="package-container">
                <div class="package">
                  <h5 class="package__title"><?php echo $membership[0] ?></h5>
                  <div class="package__content">
                    <p class="package__price">
                      <span class="package__price__currency">kr.</span> 
                      <?php echo $membership[1] ?><span class="package__price__interval">/<?php echo $membership[2] ?></span>
                    </p>
                    <p class="package__text text-muted"><?php echo $membership[3] ?></p>
                    <a href="#" class="btn btn-secondary">Læs mere</a>
                  </div>
                </div>      
              </div>    
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?> 
  </div>
  
<?php get_footer(); ?>

<style>
 .frontpage-header-image {
    background-image: url("<?php header_image(); ?>");
 }
</style>
