<?php

/**

 *@package amara-page-access

 *

/*

Plugin Name: AMARA Page Access

Description: Manage access for users

Author: yaqbick

*/

add_action('admin_menu', 'amara_page_access');



function amara_page_access()
{
    add_menu_page('AMARA Page Access', 'AMARA Page Access', 'read', 'apc', 'displaySettings');
}

function displaySettings()
{
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/settings.php');
}