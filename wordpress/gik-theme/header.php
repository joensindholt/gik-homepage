<!doctype html>
<html lang="en">

<head>
  <title>Gentofte Idræts Klub</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/style.css?v=3">
  <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/datepicker.min.css">
  <script src="https://unpkg.com/vue"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="<?php echo get_bloginfo('template_directory'); ?>/scripts/moment.min.js"></script>
  <script src="<?php echo get_bloginfo('template_directory'); ?>/scripts/da.js"></script>
  <script src="<?php echo get_bloginfo('template_directory'); ?>/scripts/datepicker.min.js"></script>
  <script src="<?php echo get_bloginfo('template_directory'); ?>/scripts/app.js?v=7"></script>
</head>

<body>
  <!-- top-bar -->
  <nav class="navbar navbar-expand-md app-navbar-top navbar-dark bg-primary">
    <div class="container">
      <!-- content -->
      <ul class="navbar-nav text-muted">
      <?php if ( get_option('email') ) : ?>
        <li class="nav-item py-2 mr-4 d-none d-sm-block">
          <i class="fa fa-light fa-envelope-o" aria-hidden="true"></i>
          <a class="text-muted" href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a>
        </li>
      <?php endif; ?>
      </ul>
      <?php if ( get_option('topbar_button_text') ) : ?>
        <a class="btn btn-secondary navbar-member-button text-white font-weight-bold ml-auto" href="<?php echo get_option('topbar_button_link'); ?>">
          <?php echo get_option('topbar_button_text'); ?>
        </a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- frontpage header -->
  <div class="container">
    <nav class="navbar navbar-full-width navbar-expand-lg navbar-light my-3 my-md-4">
      <a class="navbar-brand" href="#">
        <img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]; ?>" width="70" class="d-none d-sm-inline logo--large" />
        <img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]; ?>" width="50" class="d-inline d-sm-none logo--small" />
      </a>
      <!--front page title -->
      <div class="h1 pt-3 text-primary mr-auto frontpage-title">
        <div><span class="first">GIK</span><span class="second">Atletik</span></div>
        <div class="third">Gentofte Idræts Klub</div>
      </div>
      <!-- navbar toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- menu items -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
          wp_nav_menu( array( 
              'theme_location' => 'my-custom-menu', 
              'container' => '',
              'container_class' => '',
              'menu_class' => 'navbar-nav ml-auto mr-4',
              'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
              'walker'			=> new WP_Bootstrap_Navwalker() ) ); 
        ?>
        <!-- https://da-dk.facebook.com/GIK-Gentofte-Idr%C3%A6ts-Klub-Gentofte-Atletik-779438128804409/ -->
        <?php if ( get_option('facebook') ) : ?>
          <a class="social social-facebook" href="<?php echo get_option('facebook'); ?>"
            title="Facebook">
            f
          </a>
        <?php endif; ?>
      </div>
    </nav>
  </div>

  <?php if ( get_option('daily_message') ) : ?>
    <div class="daily-message"><?php echo get_option('daily_message'); ?></div>
  <?php endif; ?>

