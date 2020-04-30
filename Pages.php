<?php

class Pages
{

    public function findByID($pageID): string
    {
        return get_the_title($pageID);
    }

    public function getAllPages(): array //pobieranie stron z przypisanym post meta
    {
        $pagesIDS = $this->getAllPagesIDS();
        $pages = [];
        foreach ($pagesIDS as $pageID)
        {
            if( get_post_meta($pageID,'amara_page_access'))
            {
                $pages[] = $this->findByID($pageID);
            }
        }
        return $pages;
    }

    public function getAllPagesIDS(): array //pobieranie id wszystkich istniejących stron w systemie
    {
        return get_all_page_ids();
    }

    public function add(int $pageID): void 
    {
        add_post_meta($pageID, 'amara_page_access', array());
    }

    public function remove(int $pageID): void
    {

    }
}