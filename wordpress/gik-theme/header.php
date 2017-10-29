<!doctype html>
<html lang="en">

<head>
  <title>Gentofte Idræts Klub</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
</head>

<body>
  <!-- top-bar -->
  <nav class="navbar navbar-expand-md app-navbar-top navbar-dark bg-primary">
    <div class="container">
      <!-- content -->
      <ul class="navbar-nav text-muted">
        <li class="nav-item py-2 mr-4 d-none d-sm-block">
          gik.atletik@gmail.com
        </li>
      </ul>
      <a class="btn btn-secondary navbar-member-button text-white font-weight-bold ml-auto">Bliv medlem</a>
    </div>
  </nav>

  <!-- frontpage header -->
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light my-3 my-md-4">
      <a class="navbar-brand" href="#">
        <img src="images/logo-50.png" width="50" class="d-none d-sm-inline" />
        <img src="images/logo-50.png" width="30" class="d-inline d-sm-none" />
      </a>
      <!--front page title -->
      <div class="h1 pt-3 text-primary mr-auto frontpage-title">
        <span class="first">GIK</span><span class="second">Atletik</span>
        <br/>
        <span class="third">Gentofte Idræts Klub</span>
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
        <a class="social social-facebook" href="https://da-dk.facebook.com/GIK-Gentofte-Idr%C3%A6ts-Klub-Gentofte-Atletik-779438128804409/"
          title="Facebook">
          f
        </a>
      </div>
    </nav>
  </div>
