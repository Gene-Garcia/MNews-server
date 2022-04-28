<?php

require "../models/Announcement.php";

class DatabaseContext {
    
    public $isConnected; 

    private $data;

    /*
     * basically mocks connecting to database and will
     * allow access to data
     */
    function connect(){
        // populate $data
        $this->data = array("Announcements"=>
            array(
                new Announcement(uniqid(), "Subject 1", "Date 1", "Content 1"),
                new Announcement(uniqid(), "Subject 2", "Date 2", "Content 2"),
                new Announcement(uniqid(), "Subject 3", "Date 3", "Content 3"),
                new Announcement(uniqid(), "Subject 4", "Date 4", "Content 4"),
                new Announcement(uniqid(), "Subject 5", "Date 5", "Content 5")
            )
        );
    }

    function disconnect() {}

    function data(){
        return $this->data;
    }
    
}

?>