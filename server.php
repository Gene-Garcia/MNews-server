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
    "AnnouncementObj",
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
    "ArrayOfAnnouncementObj",
    "complexType",
    "array",
    "",
    "SOAP-ENC:Array",
    array(),
    array(
        array(
            "ref" => "SOAP-ENC:arrayType", 
            "wsdl:arrayType" => "tns:AnnouncementObj[]"
            )               
        ),
    "tns:AnnouncementObj"
);

$server->register(
    "Announcements", 
    array(), 
    array("return" => "tns:ArrayOfAnnouncementObj"),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: documentation for the method
    'Get all available announcements'
);

$server->register(
    "Announcement",
    array("idx"=>"xsd:string"),
    array("return" => "tns:AnnouncementObj"),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: documentation for the method
    'Get an announcement by id'
);

$server->service(file_get_contents("php://input"))


?>