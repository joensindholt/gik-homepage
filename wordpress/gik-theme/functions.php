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

  $custom_header_settngs = array(
    // Header image height (in pixels)
    'width' => 1400,
    // Header image height (in pixels)
    'height' => 450
  );

add_theme_support( 'custom-header', $custom_header_settngs );
add_theme_support( 'custom-logo' );

// **************************************************************************************
// Short codes
// **************************************************************************************

function section_shortcode( $atts, $content = null ) {
	return '<section><div class="container">' . do_shortcode($content) . '</div></section>';
}

function image_section_shortcode( $atts ) {
  $a = shortcode_atts( array(
      'image-url' => '',
      'title' => 'Title',
      'subtitle' => 'Subtitle',
      'text' => 'Some content',
    ), $atts );

  return "<section>
  <div class=\"container\">
    <div class=\"image-section\">
      <div class=\"image-section__image\" style=\"background-image: url('{$a['image-url']}')\">
      </div>
      <div class=\"image-section__content\">
        <h1 class=\"image-section__title\">{$a['title']}</h1>
        <p class=\"image-section__subtitle\">{$a['subtitle']}</p>
        <div class=\"image-section__text\">
          {$a['text']}
        </div>
      </div>
    </div>
  </div>
</section>";
}

function package_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'title' => 'title',
    'price' => '10',
    'currency' => 'kr.',
    'interval' => 'år',
    'text' => 'text',
    'button-text' => 'Læs mere',
    'button-link' => 'button-link',
    'number-of-packages' => 4
  ), $atts );

  $lgCol = 12 / $a['number-of-packages'];
  $smCol = 6;

  return "<div class=\"col-sm-{$smCol} col-lg-{$lgCol}\">
  <div class=\"package-container\">
    <div class=\"package\">
      <h5 class=\"package__title\">{$a['title']}</h5>
      <div class=\"package__content\">
        <p class=\"package__price\">
          <span class=\"package__price__currency\">{$a['currency']}</span> 
          {$a['price']}<span class=\"package__price__interval\">/{$a['interval']}</span>
        </p>
        <div class=\"package__text text-muted\">{$a['text']}</div>
        <a href=\"{$a['button-link']}\" class=\"btn btn-secondary\">{$a['button-text']}</a>
      </div>
    </div>      
  </div>    
</div>";
}

function package_container_shortcode( $atts, $content = null ) {
  return "<div class=\"row justify-content-center\">" . do_shortcode($content) . "</div>";
}

function contacts_shortcode( $atts ) {
  return "<div class=\"row justify-content-around\">
  <div class=\"col-sm-3 text-center mb-5 mb-sm-0\">
    <div class=\"mb-3\"><i class=\"fa fa-4x fa-envelope-o\" aria-hidden=\"true\"></i></div>
    <div >
      <a class=\"text-muted\" href=\"mailto:" . get_option('email') ."\"> " . get_option('email') ." </a>
    </div>
  </div>
  <div class=\"col-sm-3 text-center\">
  <div class=\"mb-3\"><i class=\"fa fa-4x fa-map-o\" aria-hidden=\"true\"></i></div>
  <div class=\"text-muted\">
    " . get_option('address') . "
  </div>
</div>
</div>";
}

function board_members_shortcode( $atts, $content = null ) {
  return "<div class=\"row justify-content-center\">" . do_shortcode($content) . "</div>";
}

function board_member_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'name' => 'name',
    'position' => 'position',
    'email' => '',
    'phone' => ''
  ), $atts );

  return "
  <div class=\"col-sm-5 text-center mb-2 mb-sm-4\">
    <div class=\"contact-box\">
      <div class=\"contact-box__name\">{$a['name']}</div>
      <div class=\"contact-box__position my-2\">{$a['position']}</div>" . ($a['email'] || $a['phone'] ? "
      <div class=\"contact-box__meta text-muted\">
        " . ($a['email'] ? "<div><a class=\"text-muted\" href=\"mailto:{$a['email']}\">{$a['email']}</a></div>" : "") . "
        " . ($a['phone'] ? "<div>{$a['phone']}</div>" : "") . "
      </div> " : "") . "
    </div>
  </div>";
}

add_shortcode( 'section', 'section_shortcode' );
add_shortcode( 'image-section', 'image_section_shortcode' );
add_shortcode( 'package-container', 'package_container_shortcode' );
add_shortcode( 'package', 'package_shortcode' );
add_shortcode( 'contacts', 'contacts_shortcode' );
add_shortcode( 'board-members', 'board_members_shortcode');
add_shortcode( 'board-member', 'board_member_shortcode');

?>
