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


function amara_page_access()
{
    add_menu_page('AMARA Page Access', 'AMARA Page Access', 'read', 'apc', 'displaySettings');
}

function displaySettings()
{
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/settings.php');
}
