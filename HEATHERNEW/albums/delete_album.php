<?php
require '../database.php';

$album_id = $_GET['album_id'];

$songs_delete = 'DELETE FROM songs WHERE album_id=:album_id';
$songs_statement = $connection->prepare($songs_delete);

$album_delete = 'DELETE FROM albums WHERE album_id=:album_id';
$album_statement = $connection->prepare($album_delete);

if (
  $songs_statement->execute([':album_id' => $album_id]) &&
  $album_statement->execute([':album_id' => $album_id])
) {
  header("Location: ../albums/allalbums.php");
}