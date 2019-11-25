# MusicBot

MusicBot is a website application that allows for users to request songs to be played. This application can be used when a group of your friends want to listen to some music. It is built in PHP, MySQL, Javascript, and HTML/CSS.

# Installation

MusicBot can be quickly installed onto a websever that supports PHP, Javascript, and HTML/CSS. Furthermore, you must also have a MySQL server.
1. WebServer
  - Download the files and drag and drop into a new folder in htdocs.
  - To access the website, go to the websites URL followed by /[folder-name] that you just created.
2. MySQL
  - Create a new table called queue with the following columns. youtube_url as varchar(20) and queue_position int(11).
  - Create a new table called requested_songs with the following columns. id int(11)	and youtube_url varchar(20).
  - Assign id in table requested_songs to the primary key and have it auto increment.
  - Open the folder you created on the webserver and create a new document called pdo_connect.php with the following code and replace the needed information.
```
<?php

$user = 'DB_USERNAME';
$pass = 'DB_PASSWORD';
$db_info='mysql:host=DB_HOST;dbname=DB_NAME';

try {
    $db = new PDO($db_info, $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
```
  - After all of this is complete, the website will load. You can begin to request songs in the request tab and you can view the queue at any time in the queue tab. To listen to the queue go to your url and add /index.php?page=player to the end of the url. This will load the player. Please note, only one user should be playing music at a time. This application is not built for multiplie people on different devices to be listening at the same time.
