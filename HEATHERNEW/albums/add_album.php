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

function get_genre_id($genre)
{
    global $connection;
    $genre_id_query = 'SELECT genre_id FROM genres WHERE genre = :genre';
    $genre_statement = $connection->prepare($genre_id_query);
    $genre_statement->execute(['genre' => $genre]);
    $genre_object = $genre_statement->fetch(PDO::FETCH_OBJ);
    $genre_statement->closeCursor();

    $genre_id = $genre_object->genre_id;

    return $genre_id;
}

if (
    isset($_POST['albumname'])  && isset($_POST['stagename']) &&
    isset($_POST['recordlabel']) && isset($_POST['genre']) &&
    isset($_POST['releasedate']) && isset($_POST['notablefact'])
) {
    $albumname = $_POST['albumname'];
    $stagename = $_POST['stagename'];
    $recordlabel = $_POST['recordlabel'];
    $genre = $_POST['genre'];
    $releasedate = $_POST['releasedate'];
    $notablefact = !empty($_POST['notablefact']) ? $_POST['notablefact'] : NULL;

    $artist_id = get_artist_id($stagename);

    $genre_id = get_genre_id($genre);

    $new_album_info = 'INSERT INTO albums (albumname, artist_id, recordlabel, genre_id, releasedate, notablefact) 
                            VALUES (:albumname, :artist_id, :recordlabel, :genre_id, :releasedate, :notablefact)';


    $statement = $connection->prepare($new_album_info);
    $statement->execute([':albumname' => $albumname, ':artist_id' => $artist_id, ':recordlabel' => $recordlabel, ':genre_id' => $genre_id, ':releasedate' => $releasedate, ':notablefact' => $notablefact]);

    header("Location: allalbums.php");
}

$stage_name_query = "SELECT stagename FROM artists";
$stage_name_statement = $connection->prepare($stage_name_query);
$stage_name_statement->execute();
$stagenames = $stage_name_statement->fetchAll(PDO::FETCH_ASSOC);


$genres_query = "SELECT genre FROM genres";
$genre_statement = $connection->prepare($genres_query);
$genre_statement->execute();
$genres = $genre_statement->fetchAll(PDO::FETCH_ASSOC);

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
        <title>Add Album</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>

    <body>
        <div id="main">
            <div class="body">

                <h1 class="table_header">
                    <font color="black">
                        <center>Add Album</center>
                    </font>
                </h1>

    <center>
    <form method="post">
    <table class = "add">
    <tr>
        <td class = "label-2">Album Name</td><td><input type="text" name="albumname" id="albumname" required><br>
        </td></tr>
        <tr>
        <td>Artist Stage Name</td><td><select name="stagename" id="stagename" required><option value=""></option>
        <?php foreach ($stagenames as $stagename) : ?>
        <option value="<?php echo $stagename['stagename']; ?>">
        <?php echo $stagename['stagename']; ?></option>
        <?php endforeach ?>
        </td></tr>
        <tr>
        <td>Record Label</td><td><input type="text" name="recordlabel" id="recordlabel" required><br></td>
        </tr><tr>
        <td>Genre</td><td><select name="genre" id="genre" required>
        <option value=""></option>
        <?php foreach ($genres as $genre) : ?>
        <option value="<?php echo $genre['genre']; ?>"><?php echo $genre['genre']; ?></option>
        <?php endforeach ?></td></tr>
        <tr>
        <td>Release Date</td><td><input type="text" name="releasedate" id="releasedate" placeholder="YYYY-MM-DD" required><br></td></tr>
        <tr>   
        <td>Notable Fact</td><td>&nbsp;<textarea type="text" name="notablefact" id="notablefact"></textarea></td></tr>
<br><br>
</form></table>
        <br><br>

                        <input type="submit" value="Add Album">
                        <br>
                    </form>
                </center>


                <footer>


                    <center>&copy; Heather Norman Summer 2023 </center>

                    </p>

                </footer>

    </body>
</div>

</html>