<?php 

/*
 * A database context for announcement and its CRUD operations
 * 
 */
class AnnouncementContext {

    private $key = "Announcements";

    private $dbCtx;
    private $announcements;

    function __construct($db, $data){
        $this->dbCtx = $db;
        // pass by reference
        $this->announcements = &$data[$this->key];
    }

    function createAnnouncement($model){
        array_push($this->announcements, $model);
    }

    function getAnnouncements(){
        return $this->announcements;
    }

    function getAnnouncement($idx){
        foreach($this->announcements as $announcement){
            if ($announcement->getId() == $idx){
                return $announcement;
            }
        }

        return "Announcement post not found";
    }

    function updateAnnouncement($model){
        for($i=0; $i<count($this->announcements); $i++){
            if ($this->announcements[$i]->getId() == $model->getId()){
                $this->announcements[$i] = $model; 
                return "Announcement updated successfully";
            }
        }

        return "Announcement not found and was not updated";
    }

    function deleteAnnouncement($idx){
        for($i=0; $i<count($this->announcements); $i++){
            if ($this->announcements[$i]->getId() == $idx){
                unset($this->announcements[$i]);
                return "Announcement deleted";
            }
        }

        return "Announcement not found and not deleted";
    }

}

?>