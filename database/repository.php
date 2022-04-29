<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";

$data = array(
    "Announcements"=> array(
        new Announcement("Zc123V", "Subject 1", "Date 1", "Content 1"),
        new Announcement("1gdvs3", "Subject 2", "Date 2", "Content 2"),
        new Announcement("26Dfdq", "Subject 3", "Date 3", "Content 3"),
        new Announcement("633thd", "Subject 4", "Date 4", "Content 4"),
        new Announcement("7fFCd1", "Subject 5", "Date 5", "Content 5")
    )
)

?>