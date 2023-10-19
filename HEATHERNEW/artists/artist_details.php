<?php
require '../database.php';

function get_artist_details($artist_id)
{
   global $connection;
    $artist_info_query = 'SELECT artists.artist_id, birthname, stagename, DOB, DOD, funfact, hometown, genres.genre_id, albums.album_id, genre
                        FROM artists 
                            JOIN albums ON albums.album_id = albums.album_id 
                            JOIN genres ON genres.genre_id = genres.genre_id
                            WHERE artists.artist_id = :artist_id';
    $statement = $connection->prepare($artist_info_query);
    $statement->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $statement->execute();
    $artist = $statement->fetchAll(PDO::FETCH_OBJ); // Fetch as objects
    $statement->closeCursor();
    return $artist;
}

function get_songs_by_album($album_id)
{
    global $connection;
    $song_query = 'SELECT song_id, songname, stagename, lengthinseconds, comments, writername 
                   FROM songs 
                   JOIN albums ON songs.album_id = albums.album_id 
                   JOIN artists ON albums.artist_id = artists.artist_id
                   WHERE albums.album_id = :album_id
                   ORDER BY songname';
    $statement = $connection->prepare($song_query);
    $statement->bindParam(':album_id', $album_id, PDO::PARAM_INT);
    $statement->execute();
    $songs = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $songs;
}

if (isset($_GET['artist_id'])) {
    $artist_id = $_GET['artist_id'];
    $artist_details = get_artist_details($artist_id);
    $songs = get_songs_by_album($artist_id);
}

?>
<html>
<head>

    <title>My Music Database</title>

    <link rel="stylesheet" type="text/css" href="../main.css">

</head>
    <center>
        <header>
            <h1>
                <font color=black>Heather's Music Database
            </h1>
            </font>
        </header>
    </center>
    <div id="main">

        <center>
            <p>
        <a href="../index.php">Home</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="../artists/allartists.php">Artists</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="../albums/allalbums.php">Albums</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="../songs/allsongs.php">Songs</a>
            </p>
        </center>

    </div><head>
    <title>Artist Details</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>

<body>
    <div id="main">
        <div class="body">
            <?php if (isset($artist_details)) : ?>
            <h1 class="table_header"><font color="black"><center>Artist Details</center></h1></font>
                <center>
                <table>
                <tbody>
                <tr>
                <td>Artist Birth Name:</td>
                <td><?= $artist_details[0]->birthname; ?></td>
               </tr>
                <tr>
                <td>Artist Stage Name:</td>
                <td><?= $artist_details[0]->stagename; ?></td>
                </tr>
                <tr>
                <td>Genre:</td>
               <td><?= $artist_details[0]->genre; ?></td>
                </tr>
                <tr>
                <td>Date of Birth:</td>
                <td><?= $artist_details[0]->DOB; ?></td>
                </tr>
                <tr>
                 <td>Hometown:</td>
                <td><?= $artist_details[0]->hometown; ?></td>
                </tr>
                <tr>
                <td>Fun Fact:</td>
                <td><?= $artist_details[0]->funfact; ?></td>
                </tr>
                       
   
        </tbody>
    </table>
        <h1 class="table_header"><font color="black"><center>Songs</center></h1></font>
        <table>
            <thead>
               <tr class="text-center">
                  <th>Song</th>
                   <th>Writer</th>
                   <th>Length of Song</th>

                </tr>
            </thead>
                <?php foreach ($songs as $song) : ?>
                    <tr class="text-center">
                   <td><a href="../songs/song_details.php?song_id=<?= $song->song_id; ?>">
                    <?= $song->songname; ?>

                        <td><?= $song->writername; ?></td>
                        <td><?= $song->lengthinseconds; ?> seconds</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

<br>
        <a href="../artists/edit_artist.php?artist_id=<?= $artist_details[0]->artist_id; ?>">
                Edit Artist
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../artists/delete_artist.php?artist_id=<?= $artist_details[0]->artist_id; ?>" onclick="return confirm('Are you sure you want to delete this artist?');">
                Delete Artist
            </a>
            
                </center>
            <?php else : ?>
                <h1><center>No album details available.</center></h1>
            <?php endif; ?>
                <center>
                    <a href="../artists/allartists.php">Back to All Artists</a></center>
        </div>

    </div>
</body>


    <br><br>
</div>
    <footer>


        <center>&copy; Heather Norman Summer 2023 </center>
        <br><br>
        </p>

    </footer>
