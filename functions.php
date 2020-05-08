<?php
require_once(ABSPATH.'wp-content/plugins/amara-page-access/Pages.php');

add_filter ( 'the_content' , 'checkRole' , 50 );


function displayCheckboxes($pageID): string
{
    $roles = new WP_Roles();
    $roleNames = $roles->get_names();
    $output ='';

    foreach ($roleNames as $key=> $roleName)
    {
        if(strpos($key,'um_')!== false)
        {
            $rolesAllowed = get_post_meta($pageID,'amara_page_access',true);
            if(isset($rolesAllowed) && !empty($rolesAllowed) && in_array($key,$rolesAllowed))
            {
                $output.= '<input type="checkbox" checked  name="'.get_the_title($pageID).'[]" value="'.$key.'">
                <label for="vehicle1">'.$roleName.'</label>';
            }
            else
            {
                $output.= '<input type="checkbox" name="'.get_the_title($pageID).'[]" value="'.$key.'">
                <label for="vehicle1">'.$roleName.'</label>';
            }
        }

    }
    return $output;
}

function getAllAmaraPagesIDS()
{
    $filteredPagesIDS = [];
    $filter =[7103,22340,22100];
    foreach (get_all_page_ids() as $pageID)
    {
        if(!in_array(wp_get_post_parent_id($pageID), $filter) )
        {
            $filteredPagesIDS[] = $pageID;
        }
    }
    return  $filteredPagesIDS;
}

add_action('wp_ajax_my_action','handle_event');
add_action('wp_ajax_delete_page','delete_page');

function delete_page()
{
    $pages = new Pages();
    $pages->remove($_POST['data']);

}
function handle_event()
{
    $decodedResponse = json_decode(stripslashes($_POST['data']),true);

    foreach ($decodedResponse as $page)
    {
        update_post_meta($page['pageID'],'amara_page_access', $page['value']);
    }

  exit;
}


function checkRole($content)
{
    $pageID = get_the_ID();
    if(get_post_meta($pageID,'amara_page_access') || get_post_meta(wp_get_post_parent_id($pageID),'amara_page_access'))
    {
        
        $user = wp_get_current_user();
        $agreement = get_user_meta($user->ID, 'zgoda_przetwarzanie_danych_os',true);
        $allowedRoles = get_post_meta($pageID,'amara_page_access',true);

        if(is_user_logged_in())
        {
            $userRole =$user->roles[0];
           
        }
        else
        {
            wp_redirect( 'http://pagetoredirectto.com' );
        }

        if(!isset($agreement) || empty($agreement) || !in_array($userRole, $allowedRoles))
        {
            if($userRole!='administrator')
            {
                wp_redirect( 'http://pagetoredirectto.com' );
            }
        }
    }

    return $content;

}