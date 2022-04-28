<?php

// nusoap library
// require './lib/nusoap-0.9.5/nusoap.php';
// file with the function, (findResident
// require 'resident_management.php';

// $server = new nusoap_server();
// $server->configureWSDL("Barangay Soap Service", "urn:barangayserver");

// $server->register(
//     "findResident",
//     array( //$residentId, $webServiceCode
//         "residentId" => "xsd:string", 
//         "webServiceCode" => "xsd:string"
//     ),
//     array("return" => "xsd:string")
// );

// $server->service(file_get_contents("php://input"))

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";

foreach(Announcement::getAnnouncements() as $v){
    echo $v->getId() . "<br />";
    echo $v->getSubject() . "<br />";
    echo $v->getUploadDate() . "<br />";
    echo $v->getContent() . "<br />";
    echo "<hr/>";
}

$n = new Announcement(uniqid(), "New", "Date New", "Content New");
$n->uploadPost();

foreach(Announcement::getAnnouncements() as $v){
    echo $v->getId() . "<br />";
    echo $v->getSubject() . "<br />";
    echo $v->getUploadDate() . "<br />";
    echo $v->getContent() . "<br />";
    echo "<hr/>";
}
?>