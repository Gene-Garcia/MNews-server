<?php

// nusoap library
// require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . '/lib/nusoap/nusoap.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . '/lib/nusoap-master/src/nusoap.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/services/AnnouncementService.php";

$server = new nusoap_server();
$namespace = "http://192.168.1.16/mnews/MNews-server/server.php";
$server->configureWSDL("MalayanNewsService", $namespace);

// declaration of complex type of array of announcements
$server->wsdl->addComplexType(
    "AnnouncementObject",
    "complexType",
    "struct",
    "all",
    "",
    array(
        "id" =>         array("name"=> "id",            "type"=>"xsd:string"),
        "subject" =>    array("name"=> "subject",       "type"=>"xsd:string"),
        "uploadDate" => array("name"=> "uploadDate",    "type"=>"xsd:string"),
        "content" =>    array("name"=> "content",       "type"=>"xsd:string"),
    )
);

$server->wsdl->addComplexType(
    "ArrayOfAnnouncements",
    "complexType",
    "array",
    "",
    "SOAP-ENC:Array",
    array(),
    array(
        array(
            "ref" => "SOAP-ENC:arrayType", 
            "wsdl:arrayType" => "tns:AnnouncementObject[]"
            )               
        ),
    "tns:AnnouncementObject"
);

$server->register(
    "Announcements", 
    array(), 
    array("return" => "tns:ArrayOfAnnouncements"),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: documentation for the method
    'Get all available announcements from mnews server'
);

$server->register(
    "Announcement",
    array("id" => "xsd:string"),
    array("return" => "tns:AnnouncementObject"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Get an announcement by announcement Id"
);

$server->register(
    "PostAnnouncement",
    array("announcement" => "tns:AnnouncementObject"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Post a new announcement"
);

$server->register(
    "EditAnnouncement",
    array("announcement" => "tns:AnnouncementObject"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Update an announcement"
);

$server->register(
    "DeleteAnnouncement",
    array("id" => "xsd:string"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Delete an announcement by announcement Id"
);

$server->service(file_get_contents("php://input"))


?>