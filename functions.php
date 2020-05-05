<?php
require_once(ABSPATH.'wp-content/plugins/amara-page-access/PageAccess.php');

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
            if(isset($rolesAllowed) && !empty($rolesAllowed) && in_array($roleName,$rolesAllowed))
            {
                $output.= '<input type="checkbox" checked id=".ID_'.$pageID.'" name="APA_'.$roleName.'_'.$pageID.'">
                <label for="vehicle1">'.$roleName.'</label>';
            }
            else
            {
                $output.= '<input type="checkbox" id=".ID_'.$pageID.'" name="APA_'.$roleName.'_'.$pageID.'">
                <label for="vehicle1">'.$roleName.'</label>';
            }
        }

    }
    return $output;
}

function getAllAmaraPagesIDS()
{
    return get_all_page_ids();
}

function requestToObjects():array
{
    $accessObjects = [];
    foreach($_POST as $key=>$value)
    {
        if(strpos($key,'APA')!== false && $value=="on")
        {
            $data = explode('_',$key);
            $pageID = $data[2];
            $role = $data[1];

            if(isset($accessObjects[$pageID]))
            {
                $accessObjects[$pageID]->addRole($role);
            }
            else
            {
                $pageAccess = new PageAccess(intval($pageID),[$role]);
                $accessObjects[$pageID] = $pageAccess; 
            }
        }
    }
    return  $accessObjects;
}

function updatePageAccess()
{
    $accessObjects = requestToObjects();
    foreach($accessObjects as $key=>$object)
    {
        $object->save();
    }
}


function checkRole($content)
{
    $user = wp_get_current_user();
    $agreement = get_user_meta($user->ID, 'zgoda_przetwarzanie_danych_os','Potwierdzam');
    $pageID = get_the_ID();

    // get_post_meta(wp_get_post_parent_id($pageID),'amara_page_access')

    if(isset($agreement) && !empty($agreement) &&  get_post_meta($pageID,'amara_page_access') )
    {
        wp_redirect( 'http://pagetoredirectto.com' );
    }

    return $content;

}