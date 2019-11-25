<?php

include('pdo_connect.php');
include('model.php');
include('assets/pageheader.php');

$page = '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch ($page) {
    case 'request':
        include('views/request.php');
        break;
    case 'requestsubmit':
        include('views/request.php');

        $requestURL = '';
        if (isset($_POST['request'])) {
            $requestURL = $_POST['request'];
        }

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $requestURL, $matches);
        $requestURL = '';
        foreach ($matches as $x) {
            $requestURL = $x;
        }



        $sqlSongIsAlreadySaved = "SELECT * FROM `requested_songs` WHERE `youtube_url` = '{$requestURL}'";
        $result = getAllRecords($sqlSongIsAlreadySaved, $db, null);

        if (count($result) == 0) {
            $insertIntoRequestedSongs = "INSERT INTO `requested_songs`(`youtube_url`) VALUES ('{$requestURL}')";
            executeSQL($insertIntoRequestedSongs, $db, null);

            $result = getOneRecord("SELECT count(1) FROM `queue`", $db, null);
            $total = 0;
            foreach ($result as $x) {
                $total += $x;
            }

            $insertIntoQueue = "INSERT INTO `queue`(`youtube_url`, `queue_position`) VALUES ((SELECT `youtube_url` FROM `requested_songs` WHERE `youtube_url` = '{$requestURL}' LIMIT 1), {$total})";
            executeSQL($insertIntoQueue, $db, null);
            $tmp = $total + 1;
            echo "<center><h2>We have added that song to the queue. You are number {$tmp}.<h2><center>";

        } else {
            $sqlSongAlreadyQueued = "SELECT * FROM `queue` WHERE `youtube_url` = (SELECT `youtube_url` FROM `requested_songs` WHERE `youtube_url` = '{$requestURL}')";
            $queueResult = getAllRecords($sqlSongAlreadyQueued, $db, null);

            if (count($queueResult) == 0) {

                $result = getOneRecord("SELECT count(1) FROM `queue`", $db, null);
                $total = 0;
                foreach ($result as $x) {
                    $total += $x;
                }

                $insertIntoQueue = "INSERT INTO `queue`(`youtube_url`, `queue_position`) VALUES ((SELECT `youtube_url` FROM `requested_songs` WHERE `youtube_url` = '{$requestURL}' LIMIT 1), {$total})";
                executeSQL($insertIntoQueue, $db, null);
                $tmp = $total + 1;
                echo "<center><h2>We have added that song to the queue. You are number {$tmp}.<h2><center>";
            } else {
                echo "<center><h2>That song is already in the queue.<h2><center>";
            }
        }
        break;
    case 'queue':
        include('views/queue.php');
        break;
    case 'player':
        include('views/player.php');
        break;
    default:
        break;
}

include('assets/pagefooter.php');
?>