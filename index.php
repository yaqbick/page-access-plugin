<?php

/**

 *@package amara-page-access

 *

/*

Plugin Name: AMARA Page Access

Description: Manage access for users

Author: yaqbick

*/
require_once(ABSPATH.'wp-content/plugins/amara-page-access/functions.php');
add_action('admin_menu', 'amara_page_access');
add_filter ( 'the_content' , 'checkRole' , 50 );
add_action('admin_enqueue_scripts', 'load_scripts');

function load_scripts($hook)
{
  wp_register_script('apa_checkboxes',plugins_url( 'assets/js/checkboxes.js', __FILE__ ), array( 'jquery' ));
  wp_enqueue_script('apa_checkboxes');
  wp_localize_script('apa_checkboxes', 'apa_checkboxes', array(
    'ajax_url' => admin_url( 'admin-ajax.php' )
));

add_action( 'wp_ajax_my_action', 'my_action' );
add_action("wp_ajax_nopriv_my_action", "my_action");
// wp_localize_script('apa_checkboxes', 'apa_checkboxes',array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
}


function amara_page_access()
{
    add_menu_page('AMARA Page Access', 'AMARA Page Access', 'read', 'apc', 'displaySettings');
}

function displaySettings()
{
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/settings.php');
}
