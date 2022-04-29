<?php

// nusoap library
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . '/lib/nusoap-0.9.5/nusoap.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/services/AnnouncementService.php";

// echo print_r(Announcements());

$server = new nusoap_server();
$namespace = "http://localhost/MNEWS/MNews-server/server.php?wsdl";
$server->configureWSDL("Malayan News Service", "urn:mnews-server");

// $server->register(
//     "findResident",
//     array( //$residentId, $webServiceCode
//         "residentId" => "xsd:string", 
//         "webServiceCode" => "xsd:string"
//     ),
//     array("return" => "xsd:string")
// );

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
            "wsdl:arrayType" => "tns:AnnouncementObj[]")               
    )
);

$server->register(
    "Announcements", 
    array(), 
    array("return" => "tns:ArrayOfAnnouncementObj"),
    "",
    "",
    "rpc",
    "encoded",
    "Get all available announcements"
);

$server->service(file_get_contents("php://input"))


?>