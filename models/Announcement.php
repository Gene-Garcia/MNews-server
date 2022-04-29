<?php 

class Announcement {
    private $id;
    private $subject;
    private $uploadDate;
    private $content;

    function __construct($idx, $subj, $upDate, $cnt) {
        $this->id = $idx;
        $this->subject = $subj;
        $this->uploadDate = $upDate;
        $this->content = $cnt;
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

}

?>