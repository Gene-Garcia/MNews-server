<?php 

class Announcement {
    private $subject;
    private $uploadDate;
    private $content;

    function __construct($subj, $upDate, $cnt){
        $this->subject = $subj;
        $this->uploadDate = $upDate;
        $this->content = $cnt;
    }

    // Getters and setters
    function getSubject() { return $this->subject; }
    function setSubject($subj){ $this->subject = $subj; }

    function getUploadDate() { return $this->uploadDate; }
    function setUploadDate($upDate){ $this->uploadDate = $upDate; }

    function getContent() { return $this->content; }
    function setContent($cnt){ $this->content = $cnt; }
    
}

?>