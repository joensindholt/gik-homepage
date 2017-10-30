<?php

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}

add_action( 'init', 'wpb_custom_new_menu' );

// Register Custom Navigation Walker
require_once('class-wp-bootstrap-navwalker.php');

// **************************************************************************************
// GIK Settings
// **************************************************************************************

function custom_settings_add_menu() {
  add_menu_page( 'GIK Settings', 'GIK Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}

add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>GIK Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Email
function setting_email() { ?>
  <input type="text" name="email" id="email" value="<?php echo get_option( 'email' ); ?>" style="width: 100%;" />
<?php }

// Frontpage footer sales pitch
function setting_sales_pitch() { ?>
  <input type="text" name="sales_pitch" id="sales_pitch" value="<?php echo get_option( 'sales_pitch' ); ?>" style="width: 100%;" />
<?php }

// Address
function setting_address() { ?>
  <input type="text" name="address" id="address" value="<?php echo get_option( 'address' ); ?>" style="width: 100%;" />
<?php }

// Phone
function setting_phone() { ?>
  <input type="text" name="phone" id="phone" value="<?php echo get_option( 'phone' ); ?>" />
<?php }

// Facebook
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option( 'facebook' ); ?>" style="width: 100%;" />
<?php }

// Top bar button text
function setting_topbar_button_text() { ?>
  <input type="text" name="topbar_button_text" id="topbar_button_text" value="<?php echo get_option( 'topbar_button_text' ); ?>" style="width: 100%;" />
<?php }

// Become member link
function setting_topbar_button_link() { ?>
  <input type="text" name="topbar_button_link" id="topbar_button_link" value="<?php echo get_option( 'topbar_button_link' ); ?>" style="width: 100%;" />
<?php }

// Footer Contact Text
function setting_footer_contact_text() { ?>
  <input type="text" name="footer_contact_text" id="footer_contact_text" value="<?php echo get_option( 'footer_contact_text' ); ?>" style="width: 100%;" />
<?php }

function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  
  add_settings_field( 'topbar_button_text', 'Top Bar Button Text', 'setting_topbar_button_text', 'theme-options', 'section' );
  add_settings_field( 'topbar_button_link', 'Top Bar Button Link', 'setting_topbar_button_link', 'theme-options', 'section' );
  
  add_settings_field( 'address', 'Address', 'setting_address', 'theme-options', 'section' );
  add_settings_field( 'email', 'Email', 'setting_email', 'theme-options', 'section' );
  add_settings_field( 'phone', 'Phone', 'setting_phone', 'theme-options', 'section' );
  add_settings_field( 'sales_pitch', 'Frontpage Footer Sales Pitch', 'setting_sales_pitch', 'theme-options', 'section' );
  add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
  add_settings_field( 'footer_contact_text', 'Footer Contact Text', 'setting_footer_contact_text', 'theme-options', 'section' );
  
  register_setting('section', 'topbar_button_text');
  register_setting('section', 'topbar_button_link');
  register_setting('section', 'address');
  register_setting('section', 'email');
  register_setting('section', 'phone');
  register_setting('section', 'sales_pitch');
  register_setting('section', 'facebook');
  register_setting('section', 'footer_contact_text');
}

add_action( 'admin_init', 'custom_settings_page_setup' );

// **************************************************************************************

add_theme_support( 'custom-header' )

?>
