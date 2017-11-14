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
</body>

</html>
