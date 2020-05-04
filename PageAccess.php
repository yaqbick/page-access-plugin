<?php

class PageAccess
{
    protected int $pageID;
    protected array $roles;

    public function __construct(int $pageID, array $roles)
    {
        $this->pageID = $pageID;
        $this->roles = $roles;
    }

    public function update():void
    {
        update_post_meta();
    }


}