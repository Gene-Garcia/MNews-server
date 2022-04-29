<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/database/DatabaseContext.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";

$db = new DatabaseContext();
$annCtx = $db->getAnnouncementContext();

foreach($annCtx->getAnnouncements() as $announcement){
    echo "<p>" . $announcement->getId() . "</p>";
    echo "<p>" . $announcement->getSubject() . "</p>";
    echo "<p>" . $announcement->getUploadDate() . "</p>";
    echo "<p>" . $announcement->getContent() . "</p>";
    echo "<hr />";
}

echo "<br/><br/>";

$annCtx->createAnnouncement(new Announcement("abcd", "New subject", "New date", "New content"));
foreach($annCtx->getAnnouncements() as $announcement){
    echo "<p>" . $announcement->getId() . "</p>";
    echo "<p>" . $announcement->getSubject() . "</p>";
    echo "<p>" . $announcement->getUploadDate() . "</p>";
    echo "<p>" . $announcement->getContent() . "</p>";
    echo "<hr />";
}

echo "<br/><br/>";

$ann = $annCtx->getAnnouncement("abcd");
echo "<p>" . $ann->getId() . "</p>";
echo "<p>" . $ann->getSubject() . "</p>";
echo "<p>" . $ann->getUploadDate() . "</p>";
echo "<p>" . $ann->getContent() . "</p>";

echo "<br/><br/>";

$ann->setSubject("New UPDATED subject");
$annCtx->updateAnnouncement($ann);
echo "<p>" . $ann->getId() . "</p>";
echo "<p>" . $ann->getSubject() . "</p>";
echo "<p>" . $ann->getUploadDate() . "</p>";
echo "<p>" . $ann->getContent() . "</p>";

echo "<br/><br/>";

$annCtx->deleteAnnouncement($ann->getId());
foreach($annCtx->getAnnouncements() as $announcement){
    echo "<p>" . $announcement->getId() . "</p>";
    echo "<p>" . $announcement->getSubject() . "</p>";
    echo "<p>" . $announcement->getUploadDate() . "</p>";
    echo "<p>" . $announcement->getContent() . "</p>";
    echo "<hr />";
}

?>