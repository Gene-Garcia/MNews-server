<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/entity/AnnouncementContext.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/repository.php";

class DatabaseContext {
    
    // entities
    private $announcementCtx;

    function __construct(){
        $announcementCtx = new AnnouncementContext($this, $data);
    }
    
    function getAnnouncementContext(){
        return $this->announcementCtx;
    }

}

?>