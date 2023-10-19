<?php
require '../database.php';

$song_id = $_GET['song_id'];
$album_id = $_GET['album_id'];

$song_delete = 'DELETE FROM songs WHERE song_id=:song_id';
$song_statement = $connection->prepare($song_delete);
$song_statement->execute([':song_id' => $song_id]) ?  header("Location: index.php") : print("error");

header('Location: allsongs.php' . $album_id);