<?php
require '../database.php';

function get_artist_id($stagename)
{
    global $connection;
    $artist_id_query = 'SELECT artist_id FROM artists WHERE stagename = :stagename';
    $artist_statement = $connection->prepare($artist_id_query);
    $artist_statement->execute(['stagename' => $stagename]);
    $artist_object = $artist_statement->fetch(PDO::FETCH_OBJ);
    $artist_statement->closeCursor();

    $artist_id = $artist_object->artist_id;

    return $artist_id;
}

function get_albumname($albumname)
{
    global $connection;
    $album_name_query = 'SELECT album_id FROM albums WHERE albumname = :albumname';
    $album_statement = $connection->prepare($album_name_query);
    $album_statement->execute(['albumname' => $albumname]);
    $album_object = $album_statement->fetch(PDO::FETCH_OBJ);
    $album_statement->closeCursor();

    $album_id = $album_object->album_id;

    return $album_id;
}

if (
    isset($_POST['songname'])  && isset($_POST['stagename']) &&
    isset($_POST['albumname']) && 
    isset($_POST['lengthinseconds']) && isset($_POST['writername']) &&
    isset($_POST['comments'])
            
) {
    $songname = $_POST['songname'];
    $stagename = $_POST['stagename'];
    $albumname = $_POST['albumname'];
    $lengthinseconds = $_POST['lengthinseconds'];
    $writername = $_POST['writername'];
    $comments = !empty($_POST['comments']) ? $_POST['comments'] : NULL;

    $artist_id = get_artist_id($stagename);

    
    $album_id = get_albumname($albumname);

    $new_song_info = 'INSERT INTO songs (songname, artist_id, album_id, lengthinseconds, writername, comments) 
                            VALUES (:songname, :artist_id, :album_id, :lengthinseconds, :writername, :comments)';


    $statement = $connection->prepare($new_song_info);
    $statement->execute([':songname' => $songname, ':artist_id' => $artist_id, ':album_id' => $album_id, ':lengthinseconds' => $lengthinseconds, ':writername' => $writername, ':comments' => $comments]);

    header("Location: allsongs.php");
}

$stage_name_query = "SELECT stagename FROM artists";
$stage_name_statement = $connection->prepare($stage_name_query);
$stage_name_statement->execute();
$stagenames = $stage_name_statement->fetchAll(PDO::FETCH_ASSOC);

$album_query = "SELECT albumname FROM albums";
$album_statement = $connection->prepare($album_query);
$album_statement->execute();
$albums = $album_statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html>

<head>

    <title>My Music Database</title>

    <link rel="stylesheet" type="text/css" href="../main.css">

</head>
<center>
    <header>
        <h1>
            <font color=black>Heather's Music Database</font>
        </h1>

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
        <hr>
    </center>

    <head>
        <title>Add Song</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>

    <body>
        <div id="main">
            <div class="body">
                <h1 class="table_header">
                    <font color="black">
                        <center>Add Song</center>
                    </font>
        </h1>
        <br>
        <center>
        <form method="post">
        <table class = "add">
        <tr>
            <td class = "label-2">Song Name</td><td><input type="text" name="songname" id="songname" required><br></td>
            </tr><tr>
            <td>Artist Stage Name</td><td><select name="stagename" id="stagename" required><option value=""></option>
            <?php foreach ($stagenames as $stagename) : ?><option value="<?php echo $stagename['stagename']; ?>">
            <?php echo $stagename['stagename']; ?></option>
            <?php endforeach ?></td></tr><tr>
            <td>Album Name</td><td><select name="albumname" id="albumname" required><option value=""></option>
            <?php foreach ($albums as $albumname) : ?><option value="<?php echo $albumname['albumname']; ?>">
            <?php echo $albumname['albumname']; ?></option><?php endforeach ?></td></tr><tr>
            <td>Length of Song in Seconds</td><td><input type="text" name="lengthinseconds" id="lengthinseconds" required><br></td>
            </tr><tr>
            <td>Writer Name</td><td><input type="text" name="writername" id="writername" required><br></td></tr><tr>
            <td>Comments</td><td>&nbsp;<textarea type="text" name="comments" id="comments"></textarea></td></tr>
        </form></table>
            <br><br>

                        <input type="submit" value="Add Song">
                        <br>

                </center>


                <footer>


                    <center>&copy; Heather Norman Summer 2023 </center>

                    </p>

                </footer>

    </body>
</div>

</html>