<?php
/*
* Plugin Name: Taxify
* Plugin URI: https://taxify.com/
* Description: A simple plugin that allows WooCommerce users to enter states within the United States and get the rates for that state in a Custom Post Type (CPA).
* Version: 1.0
* Author: Victor Wilson
* Author URI: https://dsvwilson.com/
* License: GPLv3
* License URL: https://www.gnu.org/licenses/gpl-3.0.html
* Text Domain: taxify
*  
*/

if ( ! defined( 'ABSPATH' ) ) {
    die; // SECURITY - kill the operation if accessed directly
}

/*
Giving Object Oriented Programming (OOP) a shot for this one. Hope that goes well!
*/


// defining the first class in the plugin to do ..x..

class Begin {

    /* 

    construct: 
    
    1. taxes custom post type

    */

    function __construct() {
        add_action( 'init' , array( $this, 'custom_post_type' ) );
    }

    // method to create the Taxes post type

    function custom_post_type() {

        register_post_type('txy_taxes', array(
            'label' => 'Taxes',
            'description' => 'The core and only CPA for this plugin which provides a field where users can enter their state to get the tax rate returned to them via API.',
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-money-alt',
            'rewrite' => array( 'slug' => 'taxes' ),
        )
        );
    }

    // enqueue scripts

    function enq_scripts() {
        wp_enqueue_style( 'taxifystyle', plugins_url( '/assets/style.css', __FILE__ ) );
        wp_enqueue_script( 'taxifyscript', plugins_url( '/assets/scripts.js', __FILE__ ) );
    }

    // register admin scripts

    function register_admin_scripts() {
        add_action( 'admin_enqueue_scripts' , array( $this, 'enq_scripts' ) );
    }

}

if ( class_exists( 'Begin' ) ) {
    
    $TaxifyBegin = new Begin(); // instantiating an object from the class TaxifyFirst only if the class already exists
    $TaxifyBegin->register_admin_scripts(); //enqueue admin scripts

}


// activate

require_once plugin_dir_path( __FILE__ ) . 'includes/taxify-activate.php';
register_activation_hook( __FILE__, array( 'Activate', 'activate' ) );

// deactivate

require_once plugin_dir_path( __FILE__ ) . 'includes/taxify-deactivate.php';
register_deactivation_hook(__FILE__, array ( 'Deactivate', 'deactivate' ) );
