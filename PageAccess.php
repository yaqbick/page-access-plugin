<?php

class PageAccess
{
    protected  $pageID;
    protected  $roles;

    public function __construct(int $pageID, array $roles)
    {
        $this->pageID = $pageID;
        $this->roles = $roles;
    }

    public function save():void
    {
        update_post_meta($this->pageID,'amara_page_access',$this->roles);
    }

    public function addRole(string $role):void
    {
        $this->roles[] = $role;
    }


}