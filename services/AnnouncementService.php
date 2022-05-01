<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/services/MainService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";

function Announcements(){
    global $announcementCtx;
    
    $rawAnnouncements =  $announcementCtx->getAnnouncements();

    if (gettype($rawAnnouncements) != "array"){
        // the raw announcement contains a string of error message
        return array(new Announcement("", "Error", "Try again later", $rawAnnouncements));
    } else if (count($rawAnnouncements) <= 0){
        // Empty
        return array(new Announcement("", "Information", "{date}", "No announcement found"));
    }

    // printing will cause error in parsing. Always remove any unecessary prints or outputs
    // print_r($decoded);

    return $rawAnnouncements;
}

function Announcement($idx){
    if (empty($idx)){
        return array(new Announcement("", "Error", "Try again later", "Announcement id missing"));
    } else {
        global $announcementCtx;

        $rawAnnouncement = $announcementCtx->getAnnouncement($idx);
        
        if (is_string($announcement)) {
            // it must have returned an error message, not the announcement
            return array(new Announcement("", "Error", "Try again later", $announcement));
        } else {
            return $rawAnnouncement;
        }
    }
}

function PostAnnouncement($rawAnnouncement){
    // validate
    if (empty($rawAnnouncement)) {
        return "Invalid model";
    } else if (
        empty($rawAnnouncement["id"]) || 
        empty($rawAnnouncement["subject"]) || 
        empty($rawAnnouncement["uploadDate"]) ||
         empty($rawAnnouncement["content"])){
        return "Incomplete announcement details";
    } else {
        global $announcementCtx;

        $announcementCtx->createAnnouncement($rawAnnouncement);

        return "New announcement " . $rawAnnouncement["subject"] . " has been added";
    }
}

function EditAnnouncement($rawAnnouncement){
    // validate
    if (empty($rawAnnouncement)) {
        return "Invalid model";
    } else if (
        empty($rawAnnouncement["id"]) || 
        empty($rawAnnouncement["subject"]) || 
        empty($rawAnnouncement["uploadDate"]) || 
        empty($rawAnnouncement["content"])){
        return "Incomplete announcement details";
    } else {
        global $announcementCtx;

        return $announcementCtx->updateAnnouncement($rawAnnouncement);
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