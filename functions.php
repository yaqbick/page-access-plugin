<?php

function displayCheckboxes($pageID): string
{
    $roles = new WP_Roles();
    $roleNames = $roles->get_names();
    $output ='';
    foreach ($roleNames as $key=> $roleName)
    {
        if(strpos($key,'um_')!== false)
        {
            $output.= '<input type="checkbox" id=".ID_'.$pageID.'" name="APA_'.$roleName.'_'.$pageID.'">
            <label for="vehicle1">'.$roleName.'</label>';
        }

    }
    return $output;
}

function getAllAmaraPagesIDS()
{
    return get_all_page_ids();
}

function fetchRequest()
{
    foreach($_POST as $key=>$value)
    {
        if(strpos($key,'APA')!== false && $value=="ON")
        {
            $data = explode($key,'_');
            $pageID = $data[1];
            $role = $data[2];
        }
    }
}