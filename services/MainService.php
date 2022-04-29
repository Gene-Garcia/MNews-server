<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/DatabaseContext.php";

// main db context

$dbCtx = new DatabaseContext();

// specific context
$announcementCtx = $dbCtx->getAnnouncementContext();

?>