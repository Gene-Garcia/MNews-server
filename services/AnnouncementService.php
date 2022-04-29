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
    return $decoded;
}

?>