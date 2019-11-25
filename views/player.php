<div class="container">
    <center><div id="player"></div></center>

    <?php

    echo "<script>";
      echo "var tag = document.createElement('script');"; 
      

      echo "tag.src = 'https://www.youtube.com/iframe_api';";
      echo "var firstScriptTag = document.getElementsByTagName('script')[0];";
      echo "firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);";

      $nextVideo = "SELECT `youtube_url` FROM `queue` WHERE `queue_position` = 0";
      $result = getOneRecord($nextVideo, $db, null);

      $firstVid = '';

      if ($result != null) { // kk got it, move everything down one.
        $firstVid = $result['youtube_url'];
        $delete = "DELETE FROM `queue` WHERE `queue_position` = 0";
        executeSQL($delete, $db, null);

        $all = "SELECT * FROM `queue`";
        $data = getAllRecords($all, $db, null);

        foreach ($data as $row) {
          $currentPosition = "SELECT `queue_position` FROM `queue` WHERE `youtube_url` = '{$row['youtube_url']}'";
          $pos = getOneRecord($currentPosition, $db, null);
          $newpos = $pos['queue_position'] - 1;

          $update = "UPDATE `queue` SET `queue_position`={$newpos} WHERE `youtube_url` = '{$row['youtube_url']}'";
          executeSQL($update, $db, null);
        }
      } else { // choose a random song cuz nothing is in the queue.
        $totalrows = 'SELECT count(*) FROM `requested_songs`';
        $result = getOneRecord($totalrows, $db, null);
        $total = 0;
        foreach ($result as $x) {
          $total = $x;
        }

        $choice = rand(1, $total + 1);

        $select = "SELECT * FROM `requested_songs` WHERE `id` = {$choice}";
        $result = getOneRecord($select, $db, null);

        $firstVid = $result['youtube_url'];

      }

      echo "var player;";
      echo "function onYouTubeIframeAPIReady() {";
        echo "player = new YT.Player('player', {";
          echo "height: '390',";
          echo "width: '640',";
          echo "videoId: '{$firstVid}',";
          echo "events: {";
            echo "'onReady': onPlayerReady,";
            echo "'onStateChange': onPlayerStateChange";
          echo "}";
        echo "});";
      echo "}";

      echo "function onPlayerReady(event) {";
        echo "event.target.playVideo();";
      echo "}";

      echo "function onPlayerStateChange(event) {";
        echo "if (event.data == YT.PlayerState.ENDED) {";
          echo "location.reload();";
        echo "}";
      echo "}</script>";

    ?>


</div>