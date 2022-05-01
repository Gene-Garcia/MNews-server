<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/entity/AnnouncementContext.php";

class DatabaseContext {
    // entities
    private $announcementCtx;

    function __construct(){
        $this->announcementCtx = new AnnouncementContext($this);
    }
    
    // add other getters of other specific context
    function getAnnouncementContext(){
        return $this->announcementCtx;
    }


    // text file handling
    public $file;

    // file status
    private $status = array(
        "READ" => "r",
        // Open a file for read/write. The existing data in file is preserved. File pointer starts at the end of the file. Creates a new file if the file doesn't exist
        "ADD" => "a+",
        "UPDATE" => "w+"
        );

    function validateFile(){
        $isExisting = file_exists($_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/announcement_repo.txt");
        
        if (!$isExisting){
            // create file and add base data
            $temp = fopen(
                $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/announcement_repo.txt", 
                "w"
            );

            fwrite(
                $temp, 
                "hfgd!4|Subject 4|Upload Date|Content 4"
            );

            fclose($temp);
        }
    }

    function openFile($stat){
        $this->validateFile();

        $this->file = fopen(
            $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/announcement_repo.txt", 
            $this->status[$stat]
        );
    }

    function closeFile(){
        fclose($this->file);
    }

}


?>