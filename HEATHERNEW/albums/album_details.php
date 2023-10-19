<?php
require '../database.php';

function get_album_details($album_id)
{
    global $connection;
    $album_details_query = 'SELECT albums.album_id, albumname, artists.artist_id, genres.genre_id, recordlabel, releasedate, notablefact, stagename, genre
                            FROM albums
                            JOIN artists ON albums.artist_id = artists.artist_id
                            JOIN genres ON albums.genre_id = genres.genre_id
                            WHERE albums.album_id = :album_id';
    $statement = $connection->prepare($album_details_query);
    $statement->bindParam(':album_id', $album_id, PDO::PARAM_INT);
    $statement->execute();
    $album = $statement->fetch(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $album;
}
function get_songs_on_album($album_id)
{
    global $connection;
    $song_query = 'SELECT song_id, songname, stagename, lengthinseconds, comments, writername 
                   FROM songs 
                   JOIN albums ON songs.album_id = albums.album_id 
                   JOIN artists ON albums.artist_id = artists.artist_id
                   WHERE albums.album_id = :album_id';
       if(isset($_GET['sort']) && isset($_GET['by'])){
        $sort = $_GET['sort'];
        $by = $_GET['by'];
        $song_query .= " ORDER BY $by $sort";
    }
    else{
        $song_query .= ' ORDER BY songname';
    }         
    $statement = $connection->prepare($song_query);
    $statement->bindParam(':album_id', $album_id, PDO::PARAM_INT);
    $statement->execute();
    $songs = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $songs;
}

if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
    $album_details = get_album_details($album_id);
    $songs = get_songs_on_album($album_id);
}


?><!DOCTYPE html>
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

    </div>

<html>

<head>
    <title>Album Details</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>

<body>
    <div id="main">
        <div class="body">
            <?php if (isset($album_details)) : ?>
            <h1 class="table_header"><font color="black"><center>Album Details</center></h1></font>
                <center>
                <table>
                <tbody>
                <tr>
                <td>Album:</td>
                <td><?= $album_details->albumname; ?></td>
                </tr>
                <tr>
                <td>Artist:</td>
                <td><?= $album_details->stagename; ?></td>
                </tr>
                <tr>
                <td>Genre:</td>
                <td><?= $album_details->genre; ?></td>
                </tr>
                <tr>
                <td>Label:</td>
                <td><?= $album_details->recordlabel; ?></td>
                </tr>
                <tr>
                <td>Release Date:</td>
                <td><?= $album_details->releasedate; ?></td>
                  </tr>
                     <tr>
                <td>Notable Fact:</td>
                <td><?= $album_details->notablefact; ?></td>
                </tr>
                       
   
        </tbody>
    </table>
        <h1 class="table_header"><font color="black"><center>Songs</center></h1></font>
        <table>
        <thead>
        <tr class="text-center">
    <th>Song<a class = "icons" href="album_details.php?sort=asc&by=songname&album_id=<?= $album_details->album_id ?>">    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zm-8.46-.5a.5.5 0 0 1-1 0V3.707L2.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L4.5 3.707V13.5z"/>
</svg>   
    </a><a class = "icons" href="album_details.php?sort=desc&by=songname&album_id=<?= $album_details->album_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg>
</a></th>
    <th>Writer<a class = "icons" href="album_details.php?sort=asc&by=writername&album_id=<?= $album_details->album_id ?>">    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zm-8.46-.5a.5.5 0 0 1-1 0V3.707L2.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L4.5 3.707V13.5z"/>
</svg> 
    </a><a class = "icons" href="album_details.php?sort=desc&by=writername&album_id=<?= $album_details->album_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg>
</a></th>
    <th>Length of Song<a class = "icons" href="album_details.php?sort=asc&by=lengthinseconds&album_id=<?= $album_details->album_id ?>">    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg>    
    </a><a class = "icons" href="album_details.php?sort=desc&by=lengthinseconds&album_id=<?= $album_details->album_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
  <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
</svg>
</a></th>

                </tr>
            </thead>
                <?php foreach ($songs as $song) : ?>
                    <tr class="text-center">
                        <td><?= $song->songname; ?></td>
                        <td><?= $song->writername; ?></td>
                        <td><?= $song->lengthinseconds; ?> seconds</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

<br>
            <a href="../albums/edit_album.php?album_id=<?= $album_details->album_id; ?>">
                Edit Album
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../albums/delete_album.php?album_id=<?= $album_details->album_id; ?>" onclick="return confirm('Are you sure you want to delete this album?');">
                Delete Album
            </a>
            
                </center>
            <?php else : ?>
                <h1><center>No album details available.</center></h1>
            <?php endif; ?>
                <center>
                    <a href="../albums/allalbums.php">Back to All Albums</a></center>
        </div>

    </div>
</body>

</html>
    <br><br>
</div>
    <footer>


        <center>&copy; Heather Norman Summer 2023 </center>
        <br><br>
        </p>

    </footer>
