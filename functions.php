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
                $output.= '<input type="checkbox" checked  name="'.get_the_title($pageID).'[]" value="'.$roleName.'">
                <label for="vehicle1">'.$roleName.'</label>';
            }
            else
            {
                $output.= '<input type="checkbox" name="'.get_the_title($pageID).'[]" value="'.$roleName.'">
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

// function requestToObjects():array
// {
//     $accessObjects = [];
//     foreach($_POST as $key=>$value)
//     {
//         if(strpos($key,'APA')!== false)
//         {
//             $data = explode('_',$key);
//             $pageID = $data[2];
//             $role = $data[1];
//             if($value=='on')
//             {

//                 if(isset($accessObjects[$pageID]))
//                 {
//                     $accessObjects[$pageID]->addRole($role);
//                 }
//                 else
//                 {
//                     $pageAccess = new PageAccess(intval($pageID),[$role]);
//                     $accessObjects[$pageID] = $pageAccess; 
//                 }
//             }
//             else
//             {
//                 $assignedRoles = get_post_meta($pageID,'amara_page_access',true);
//                 if(in_array($role, $assignedRoles ))
//                 {
//                     unset($assignedRoles[$role]);
//                     update_post_meta($pageID,'amara_page_access',$assignedRoles);
//                 }
//             }
//         }
//     }
//     return  $accessObjects;
// }

// function updatePageAccess()
// {
//     $accessObjects = requestToObjects();
//     foreach($accessObjects as $key=>$object)
//     {
//         $object->save();
//     }
// }

add_action('wp_ajax_my_action','handle_event');
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