<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/DatabaseContext.php";

class Announcement {
    private $id;
    private $subject;
    private $uploadDate;
    private $content;

    // database
    private $ctx;

    function __construct($idx, $subj, $upDate, $cnt){
        $this->id = $idx;
        $this->subject = $subj;
        $this->uploadDate = $upDate;
        $this->content = $cnt;

        $this->ctx = new DatabaseContext();
    }

    // Getters and setters
    function getId() { return $this->id; }
    function setId($idx){ $this->id = $idx; }

    function getSubject() { return $this->subject; }
    function setSubject($subj){ $this->subject = $subj; }

    function getUploadDate() { return $this->uploadDate; }
    function setUploadDate($upDate){ $this->uploadDate = $upDate; }

    function getContent() { return $this->content; }
    function setContent($cnt){ $this->content = $cnt; }
    
    function prepare(){
        $this->ctx->connect();
    }

    // Database functions
    function uploadPost() {
        // check if all are populated
        array_push($this->ctx->data()["Announcements"], $this);
    }

    public static function getAnnouncements(){
        // declare seperate db context
        $dbCtx = new DatabaseContext();
        $dbCtx->connect();
        return $dbCtx->data()["Announcements"];
    }

    public static function getPost($idx){
        $dbCtx = new DatabaseContext();
        $dbCtx->connect();

        foreach($dbCtx->data()["Announcements"] as $value){
            if ($value->getId() == $idx){
                return $value;
            }
        }

        return "Post not found";
    }

    function updatePost(){
        // check if all are populated
        // pass reference
        $data = &$this->ctx->data()["Announcements"];

        $len = count($data);
        for ($i = 0; $i < $len; $i++) {
            if ($data[$i] == $this->id) {
                $data[$i] = $this;
                return "Post updated successfully";
            }
        }

        return "Post not found and was not updated";
    }

    function deletePost(){
        // pass reference
        $data = &$this->ctx->data()["Announcements"];

        $len = count($data);
        for ($i = 0; $i < $len; $i++) {
            if ($data[$i] == $this->id) {
                unset($data[$i]);
                return "Post found and deleted successfully";
            }
        }

        return "Post not found and was not deleted";
    }

}

?>