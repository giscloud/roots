<?php
/**
 * Roots functions
 */

// my
add_filter('show_admin_bar', '__return_false');
// /my

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/inc/util.php');            // Utility functions
require_once locate_template('/inc/config.php');          // Configuration and constants
require_once locate_template('/inc/activation.php');      // Theme activation
require_once locate_template('/inc/template-tags.php');   // Template tags
require_once locate_template('/inc/cleanup.php');         // Cleanup
require_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
require_once locate_template('/inc/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/inc/hooks.php');           // Hooks
require_once locate_template('/inc/actions.php');         // Actions
require_once locate_template('/inc/widgets.php');         // Sidebars and widgets
require_once locate_template('/inc/custom.php');          // Custom functions

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('css/editor-style.css');

}

add_action('after_setup_theme', 'roots_setup');

function add_listener_woopra_tracking() {
    ?>
        <script type="text/javascript">
            document.addEventListener( 'wpcf7mailsent', function( event ) {

              var woopraEvents = {
                "general_contact": "dev_docs_general_contact",
                "custom_app_contact": "dev_docs_custom_app_contact",
              };

              var inputs = event.detail.inputs;
              var emailObj = inputs.filter(input => input.name === "your-email")[0];
              var wooEvent = woopraEvents[window.type_of_post];

              if (emailObj && emailObj.value && wooEvent && typeof woopra !== "undefined") {

                var email = emailObj.value;

                woopra.identify({ email: email });
                woopra.track(wooEvent, { email: email });
              }

            }, false );
        </script>
    <?php
}

add_action('wp_footer', 'add_listener_woopra_tracking');