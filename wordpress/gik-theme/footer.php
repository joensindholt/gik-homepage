  <!-- footer -->
  <div class="footer p-5">
    <div class="container">
      <div class="row">
        <!-- logo, sales pitch, social icons -->
        <div class="col-md">
          <h5 class="text-white"><?php echo get_option('blogname'); ?></h5>
          <?php if ( get_option('sales_pitch') ) : ?>
            <p class="text-muted">
              <?php echo get_option('sales_pitch'); ?>
            </p>
          <?php endif; ?>
        </div>
        <!-- contact us -->
        <div class="col-md">
          <h5 class="text-white"><?php echo get_option('footer_contact_text'); ?></h5>
          <?php if ( get_option('address') ) : ?>
            <p>
              <strong>Adresse</strong>
              <div class="text-muted"><?php echo get_option('address'); ?></div>
            </p>
          <?php endif; ?>
          <?php if ( get_option('email') ) : ?>
            <p>
              <strong>Email</strong>
              <div class="text-muted"><?php echo get_option('email'); ?></div>
            </p>
          <?php endif; ?>
          <?php if ( get_option('phone') ) : ?>
            <p>
              <strong>Ring til os</strong>
              <div class="text-muted"><?php echo get_option('phone'); ?></div>
            </p>
          <?php endif; ?>
        </div>
        <?php if ( get_option('gdpr') ) : ?>
          <div class="col-md-auto">
            <h5 class="text-white">Anden information</h5>
            <p><a href="<?php echo get_option('gdpr'); ?>" class="text-muted">Persondatapolitik</a></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>
