<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/MNews/MNews-server" . "/models/Announcement.php";


/*
 * A database context for announcement and its CRUD operations
 * 
 */
class AnnouncementContext {
    private $dbCtx;

    function __construct($db){
        $this->dbCtx = $db;
    }

    function createAnnouncement($rawModel){
        // data passed by client is in raw format not in announcement model
        $this->dbCtx->openFile("ADD");
        $file = &$this->dbCtx->file;

        fwrite($file, "\n" . implode("|", $rawModel));

        return "Announcement" . $rawModel["subject"] . " successfully posted";
    }

    function getAnnouncements($toEncode){
        $this->dbCtx->openFile("READ");

        $file = &$this->dbCtx->file;

        $raw = array();
        while (!feof($file)){
            $split = explode("|", fgets($file));

            // expected number of fields
            if (count($split) == 4) {
                // trim removes unecessary whitespaces, epecially the new line in content
                array_push($raw, array(
                    "id" => trim($split[0]),
                    "subject" => trim($split[1]),
                    "uploadDate" => trim($split[2]),
                    "content" => trim($split[3]),
                ));
            } else {
                // skip line
            }
        }

        // no data was found
        if (count($raw) <= 0) {
            return "Erro in our server";
        }

        if ($toEncode){
            // encode raw announcements to Announcement
            // will be used for server operation

            $announcements = array();
            foreach ($raw as $announcement){
                array_push(
                    $announcements,
                    new Announcement(
                        $announcement["id"],
                        $announcement["subject"],
                        $announcement["uploadDate"],
                        $announcement["content"]
                    )
                    );
            }

            return $announcements;
        } else {
            // no need to encode because it will be directly sent to client
            return $raw;
        }
    }

    function getAnnouncement($idx){
        $raw = $this->getAnnouncements(false);

        // if raw is not an array it is not announcement
        if (gettype($raw) == "array"){
            foreach($raw as $ann) {
                if ($ann["id"] == $idx) {
                    // no need to encode
                    return $ann;
                }
            }
        }

        return "Announcement post not found";
    }

    function updateAnnouncement($model){
        $raw = $this->getAnnouncements(false);
        $success = false;
        $updatedSubject = "";

        // raw must be an array to hold data
        if (gettype($raw) != "array"){
            return "Error in our servers";
        }
        
        for($i = 0; $i < count($raw); $i++){
            if ($raw[$i]["id"] == $model["id"]) {
                $raw[$i] = $model;
                $success = true;
                $updatedSubject = $raw[$i]["subject"];

                break;
            }
        }

        if ($success) {
            $this->reWriteFile($raw);

            return "Announcement " . $updatedSubject . " updated successfully";
        } else {
            return "Announcement not found and was not updated";
        }

    }

    function deleteAnnouncement($idx){
        $raw = $this->getAnnouncements(false);
        $deletedSubject = "";

        // raw must be an array to hold data
        if (gettype($raw) != "array"){
            return "Error in our servers";
        }

        $removeIndex = -1;
        for($i = 0; $i < count($raw); $i++){
            if ($raw[$i]["id"] == $idx) {
                $removed = true;
                $deletedSubject = $raw[$i]["subject"];

                $removeIndex = $i;
                break;
            }
        }

        if ($removeIndex == -1) {
            return "Announcement post not found";
        } else {
            unset($raw[$removeIndex]);

            // re-write to file
            $this->reWriteFile($raw);

            return "Announcement " . $deletedSubject . " deleted";
        }
    }


    private function reWriteFile($rawAnnouncement) {
        // // write
        $this->dbCtx->openFile("UPDATE");

        // format $raw to strings
        foreach ($rawAnnouncement as $line){
            fwrite($this->dbCtx->file, implode($line, "|") . "\n");
        }

        $this->dbCtx->closeFile();
    }

}

?>