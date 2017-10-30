  <!-- footer -->
  <div class="footer p-5">
    <div class="container">
      <div class="row">
        <!-- logo, sales pitch, social icons -->
        <div class="col-md-6">
          <h3 class="text-white"><?php echo get_option('blogname'); ?></h3>
          <?php if ( get_option('sales_pitch') ) : ?>
            <p class="text-muted">
          <?php echo get_option('sales_pitch'); ?>
          </p>
          <?php endif; ?>
        </div>
        <!-- contact us -->
        <div class="col-md-4">
          <h5 class="text-white"><?php echo get_option('footer_contact_text'); ?></h5>
          <?php if ( get_option('address') ) : ?>
            <strong>Adresse</strong>
            <div class="text-muted"><?php echo get_option('address'); ?></div>
            <br/>
          <?php endif; ?>
          <?php if ( get_option('email') ) : ?>
            <strong>Email</strong>
            <div class="text-muted"><?php echo get_option('email'); ?></div>
            <br/>
          <?php endif; ?>
          <?php if ( get_option('phone') ) : ?>
            <strong>Ring til os</strong>
            <div class="text-muted"><?php echo get_option('phone'); ?></div>
            <br/>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- optional javascript -->
  <!-- jquery first, then popper.js, then bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
    crossorigin="anonymous"></script>
</body>

</html>
