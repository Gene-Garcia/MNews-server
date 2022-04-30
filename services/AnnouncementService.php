<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/services/MainService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";

function Announcements(){
    global $announcementCtx;
    
    $announcements =  $announcementCtx->getAnnouncements();

    // convert Announcement object to an associative array because
    // the complex type of nusoap cannot serialize an Announcement object
    $decoded = array();
    foreach($announcements as $announcement){
        array_push($decoded, json_decode(json_encode($announcement), true));
    }    

    // printing will cause error in parsing. Always remove any unecessary prints or outputs
    // print_r($decoded);

    return $decoded;
}

function Announcement($idx){
    if (empty($idx)){
        return "Announcement id missing";
    } else {
        global $announcementCtx;

        return $announcementCtx->getAnnouncement($idx);
    }
}

function PostAnnouncement($announcement){
    // validate
    if (empty($announcement)) {
        return "Invalid model";
    } else if (empty($announcement["id"]) || empty($announcement["subject"]) || empty($announcement["uploadDate"]) || empty($announcement["content"])){
        return "Incomplete announcement details";
    } else {
        global $announcementCtx;

        // we need to encode array type of announcement to an Announcmenet object 
        // because data receive is in format of Array([id] => 1234   [subject] => New subject 1234  [uploadDate] => New upload date 1235    [content] => New content 1235)
        $encoded = new Announcement($announcement["id"], $announcement["subject"], $announcement["uploadDate"], $announcement["content"]);

        $announcementCtx->createAnnouncement($encoded);

        return "New announcement " . $announcement->subject . " has been added";
    }
}

function EditAnnouncement($announcement){
    // validate
    if (empty($announcement)) {
        return "Invalid model";
    } else if (empty($announcement["id"]) || empty($announcement["subject"]) || empty($announcement["uploadDate"]) || empty($announcement["content"])){
        return "Incomplete announcement details";
    } else {
        global $announcementCtx;

        $encoded = new Announcement($announcement["id"], $announcement["subject"], $announcement["uploadDate"], $announcement["content"]);

        return $announcementCtx->updateAnnouncement($encoded);
    }
}

function DeleteAnnouncement($idx){
    if (empty($idx)){
        return "Announcement Id missing";
    } else {
        global $announcementCtx;

        return $announcementCtx->deleteAnnouncement($idx);
    }
}

?>