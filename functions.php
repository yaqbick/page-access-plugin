<?php

function displayCheckboxes($pageName): string
{
    $roles = new WP_Roles();
    $roleNames = $roles->get_names();
    $output ='';
    foreach ($roleNames as $key=> $roleName)
    {
        if(strpos($key,'um_')!== false)
        {
            $output.= '<input type="checkbox" id=".ID_'.$pageName.'" name="'.$roleName.'_for_'.$pageName.'">
            <label for="vehicle1">'.$roleName.'</label>';
        }

    }
    return $output;
}