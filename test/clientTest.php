<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . '/lib/nusoap-0.9.5/nusoap.php';
$client = new nusoap_client("http://localhost/MNEWS/MNews-server/server.php?wsdl"); // Create a instance for nusoap client
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HE</h1>

    <?php
    
    $response = $client->call('Announcements',array());
    echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
    echo "<hr />";
    echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
    ?>

</body>
</html>