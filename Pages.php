<?php

class Pages
{

    public function findByID($pageID): string
    {
        return get_post($pageID);
    }

    public function getAllPages(): array //pobieranie stron z przypisanymi post meta
    {
        $pagesIDS = $this->getAllPagesIDS();
        $pages = [];
        foreach ($pagesIDS as $pageID)
        {
            $pages[] = $this->findByID($pageID);
        }
        return $pages;
    }

    public function getAllPagesIDS(): array //pobieranie id wszystkich stron z przypisanymi post meta
    {
        $AllPagesIDS = getAllAmaraPagesIDS();
        $SelectedPagesIDS = [];
        foreach ($AllPagesIDS as $pageID)
        {
            if( get_post_meta($pageID,'amara_page_access'))
            {
                $SelectedPagesIDS[] = $pageID;
            }
        }
        return  $SelectedPagesIDS;
    }

    public function add(int $pageID): void 
    {
        add_post_meta($pageID, 'amara_page_access', array());
    }

    public function remove(int $pageID): void
    {
        delete_post_meta($pageID, 'amara_page_access');
    }
}