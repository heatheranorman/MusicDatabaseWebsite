<?php
require '../database.php';

function get_song_details($song_id)
{
    global $connection;
    $song_details_query = 'SELECT song_id, songname, stagename, albumname, lengthinseconds, comments, writername 
                        FROM songs 
                            JOIN albums ON songs.album_id = albums.album_id 
                            JOIN artists ON albums.artist_id = artists.artist_id
                            WHERE song_id = :song_id';
    $statement = $connection->prepare($song_details_query);
    $statement->bindParam(':song_id', $song_id, PDO::PARAM_INT);
    $statement->execute();
    $song_details = $statement->fetch(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $song_details;
}

if (isset($_GET['song_id'])) {
    $song_id = $_GET['song_id'];
    $song_details = get_song_details($song_id);

    if (!$song_details) {
        header("Location: ../error.php");
        exit();
    }
} else {
    header("Location: ../error.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
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
<head>
    <title>Song Details</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>

<body>
    <div id="main">
        <header><center>
            <h1><font color="black">Heather's Music Database</h1></font>
        </header>
        <div class="body">
            <h1 class="table_header"><font color="black"><center>Song Details</h1></center></font>
            <center>
                <table>
                    <tbody>

                        <tr>
                            <td>Song Name:</td>
                            <td><?= $song_details->songname; ?></td>
                        </tr>
                        <tr>
                            <td>Artist:</td>
                            <td><?= $song_details->stagename; ?></td>
                        </tr>
                        <tr>
                            <td>Album:</td>
                            <td><?= $song_details->albumname; ?></td>
                        </tr>
                        <tr>
                            <td>Writer:</td>
                            <td><?= $song_details->writername; ?></td>
                        </tr>
                        <tr>
                            <td>Length (seconds):</td>
                            <td><?= $song_details->lengthinseconds; ?></td>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                            <td><?= $song_details->comments; ?></td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
</body>

</html>
<br>   <center>
            <a href="../songs/edit_song.php?song_id=<?= $song_details->song_id; ?>">
                Edit Song
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../songs/delete_song.php?song_id=<?= $song_details->song_id; ?>" onclick="return confirm('Are you sure you want to delete this song?');">
                Delete Song
            </a>
            <br>
             
                    <a href="../songs/allsongs.php">Back to All Songs</a></center>
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