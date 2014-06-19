<?php
/*
Plugin Name: Brand Fever Functionality Plugin
Plugin URI: http://www.brandfeverinc.com
Description: Add specific functionality to this site. This plugin is paired with the Brand Fever theme, meaning you shouldn't use one without the other.
Version: 1.0
Author: Brand Fever
Author Email: support@brandfeverinc.com
License:

  Copyright 2014 Brand Fever (support@brandfeverinc.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class BrandFeverFunctionalityPlugin {

  /*--------------------------------------------*
   * Constants
   *--------------------------------------------*/
  const name = 'Brand Fever - Functionality Plugin';
  const slug = 'brand_fever_functionality_plugin';
  
  /**
   * Constructor
   */
  function __construct() {
    //register an activation hook for the plugin
    register_activation_hook( __FILE__, array( &$this, 'install_brand_fever_functionality_plugin' ) );

    //Hook up to the init action
    add_action( 'init', array( &$this, 'init_brand_fever_functionality_plugin' ) );
  }
  
  /**
   * Runs when the plugin is activated
   */  
  function install_brand_fever_functionality_plugin() {
    // do not generate any output here
  }
  
  /**
   * Runs when the plugin is initialized
   */
  function init_brand_fever_functionality_plugin() {
    // Setup localization
    load_plugin_textdomain( self::slug, false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
    // Load JavaScript and stylesheets
    $this->register_scripts_and_styles();

    /*******************************************************************
    *  WordPress Admin - Functions specific to the website back-end
    */
    if ( is_admin() ) {


      /**
       * Hide ACF menu item from the admin menu
       */
      function remove_acf_menu() {
          // provide a list of usernames who can edit custom field definitions here
          $admins = array( 
              'evanmullins',
              'timfetter',
              'bfstarter'
          );
          // get the current user
          $current_user = wp_get_current_user();
          // match and remove if needed
          if( !in_array( $current_user->user_login, $admins ) ) {
              remove_menu_page('edit.php?post_type=acf');
              remove_menu_page('acf-options');
          }
      }
      add_action( 'admin_menu', 'remove_acf_menu', 999 );

      /**
       * Hide ACF options menu item from the admin menu
       */
      function remove_acf_options_page() {
        remove_menu_page('acf-options');
      }
      // add_action('admin_init', 'remove_acf_options_page', 99);


      /**
      * Add Custom Post Type Classes to body and posts
      */
      function bf_add_posttype_bodyclasses($c) {
              global $post;

              if ( is_archive() && is_post_type_archive() ) {
                      $c[] = 'post-type-archive';
                      $c[] = 'post-type-archive-' . sanitize_html_class( get_query_var( 'post_type' ) );
              }

              if (is_single()) {
                      $c[] = 'single-' . sanitize_html_class($post->post_type, $post->ID);

                      $post_format = get_post_format( $post->ID );
                      if ( $post_format && !is_wp_error($post_format) )
                              $c[] = 'single-format-' . sanitize_html_class( $post_format );
                      else
                              $c[] = 'single-format-standard'; // end cakra-addition
              }

              //add slug class
              $c[] = 'slug-' . the_slug( $post->ID );

              return $c;
      }
      add_filter('body_class','bf_add_posttype_bodyclasses');

      /**
      * the_slug function to return a post slug
      */
      function the_slug($post_id) {
          $post_data = get_post($post_id, ARRAY_A);
          $slug = $post_data['post_name'];
          return $slug;
      }

      /**
      * make_slug function to rcreate a slug from a string
      */
      function bf_make_slug($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
      }



      /**
      * Add ACF content to relevanssi search result excerpts
      */
      // Search Excerpts
      //add_filter('relevanssi_excerpt_content', 'excerpt_function', 10, 3);
      function excerpt_function($content, $post, $query) {

        $fields = array('about', 
          'flexible_content_0_headline', 
          'flexible_content_0_content', 
          'flexible_content_1_headline', 
          'flexible_content_1_content',
          'flexible_content_2_headline', 
          'flexible_content_2_content', 
          'flexible_content_3_headline', 
          'flexible_content_3_content',
          ); 

        foreach($fields as $key => $field){
          $field_value = get_post_meta($post->ID, $field, TRUE);
          $content .= " " . ( is_array($field_value) ? implode('', $field_value) : $field_value );
        }

        return $content;
      }






    /** 
    * Frontend - Functions specific to the website front-end
    */
    } else {



    }


    /**********************************************
    *  this will run everywhere
    */




      /**
      *  add favicon to site, add 16x16 "favicon.ico" image to main directory
      */
      function bf_add_favicon() { ?>
      <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
      <?php }
      add_action('wp_head', 'bf_add_favicon');

      /**
      *  Customize the log-in screen
      */
      add_filter('login_headerurl', create_function(false,"return '/';"));
      add_action('login_head', 'custom_login_logo');

      function custom_login_logo() {
        $logo_url = get_bloginfo('stylesheet_directory') . '/img/login-logo.png';
        ?>
        <style>
          body.login #login h1 a {
              background: url(<?php echo $logo_url; ?>) no-repeat scroll center top transparent;
              background-size: auto;
              width: 100%;
              height: 30px;
              margin-top: 50px;
          }
        </style>
        <?php
      }

      /**
      * Force Site Relative links 
      * http://www.deluxeblogtips.com/2012/06/relative-urls.html
      */
      //add_action( 'template_redirect', 'rw_relative_urls' );
      function rw_relative_urls() {
        // Don't do anything if: in feed OR in sitemap by WordPress SEO plugin
        if ( is_feed() || get_query_var( 'sitemap' ) )
            return;

        $filters = array(
            'post_link',
            'post_type_link',
            'page_link',
            'attachment_link',
            'get_shortlink',
            'post_type_archive_link',
            'get_pagenum_link',
            'get_comments_pagenum_link',
            'term_link',
            'search_link',
            'day_link',
            'month_link',
            'year_link',
            'get_template_directory_uri',
            'get_stylesheet_uri',
            'the_permalink',
            'the_field',
            'get_field'
        );
        foreach ( $filters as $filter ) {
          add_filter( $filter, 'wp_make_link_relative' );
        }
      }





    /*
     * TODO: Define custom functionality for your plugin here
     *
     * For more information: 
     * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
     */
    add_action( 'your_action_here', array( &$this, 'action_callback_method_name' ) );
    add_filter( 'your_filter_here', array( &$this, 'filter_callback_method_name' ) );    
  }

  function action_callback_method_name() {
    // TODO define your action method here
  }

  function filter_callback_method_name() {
    // TODO define your filter method here
  }
  
  /**
   * Registers and enqueues stylesheets for the administration panel and the
   * public facing site.
   */
  private function register_scripts_and_styles() {
    if ( is_admin() ) {
      $this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
      $this->load_file( self::slug . '-admin-style', '/css/admin.css' );
    } else {
      $this->load_file( self::slug . '-script', '/js/widget.js', true );
      $this->load_file( self::slug . '-style', '/css/widget.css' );
    } // end if/else
  } // end register_scripts_and_styles
  
  /**
   * Helper function for registering and enqueueing scripts and styles.
   *
   * @name  The   ID to register with WordPress
   * @file_path   The path to the actual file
   * @is_script   Optional argument for if the incoming file_path is a JavaScript source file.
   */
  private function load_file( $name, $file_path, $is_script = false ) {

    $url = plugins_url($file_path, __FILE__);
    $file = plugin_dir_path(__FILE__) . $file_path;

    if( file_exists( $file ) ) {
      if( $is_script ) {
        wp_register_script( $name, $url, array('jquery') ); //depends on jquery
        wp_enqueue_script( $name );
      } else {
        wp_register_style( $name, $url );
        wp_enqueue_style( $name );
      } // end if
    } // end if

  } // end load_file
  
} // end class
new BrandFeverFunctionalityPlugin();

?>