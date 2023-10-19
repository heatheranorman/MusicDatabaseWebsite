<?php
require '../database.php';

if (
    isset($_POST['albumname'])  && isset($_POST['artist_id']) &&
    isset($_POST['notablefact'])  && isset($_POST['genre_id'])  &&
    isset($_POST['releasedate']) && isset($_POST['recordlabel'])
) {
    $album_id = $_GET['album_id'];
    $albumname = $_POST['albumname'];
    $artist_id = $_POST['artist_id'];
    $notablefact = !empty($_POST['notablefact']) ? $_POST['notablefact'] : NULL;
    $genre_id = $_POST['genre_id'];
    $releasedate = $_POST['releasedate'];
    $recordlabel = $_POST['recordlabel'];

    $add_album_query = 'UPDATE albums SET albumname = :albumname, artist_id = :artist_id, recordlabel = :recordlabel, genre_id = :genre_id, releasedate = :releasedate, notablefact = :notablefact
                        WHERE album_id = :album_id';
    $statement = $connection->prepare($add_album_query);
    $statement->execute([':albumname' => $albumname, ':artist_id' => $artist_id, ':recordlabel' => $recordlabel, ':genre_id' => $genre_id, ':releasedate' => $releasedate, ':notablefact' => $notablefact, ':album_id' => $album_id]);
    $add_album = $statement->fetch(PDO::FETCH_OBJ); 
    
    header('Location: allalbums.php');
}
function get_all_artists()
{   global $connection;
    $artist_query = 'SELECT stagename, artist_id
                    FROM artists';
    $statement = $connection->prepare($artist_query);
    $statement->execute();
    $artists = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
function album_information(){
    global $connection;
    $album_id = $_GET['album_id'];
    $album_info_query = 'SELECT * FROM albums WHERE album_id = :album_id';
    $statement = $connection->prepare($album_info_query);
    $statement->execute([':album_id'=>$album_id]);
    $album = $statement->fetch(PDO::FETCH_OBJ);
    return $album;
}
$album_id = $_GET['album_id'];
global $connection;
$genre_query = 'SELECT * FROM genres';
$statement = $connection->prepare($genre_query);
$statement->execute();
$genres = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
$artists = get_all_artists();
$album = album_information();
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

    <head>
        <title>Edit Album</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>

    <body>
        <div id="main">
            <header>
                <h1>
                    <font color="black">Heather's Music Database
                </h1>
                </font>
            </header>
            <div class="body">
                <h1 class="table_header">
                    <font color="black">
                        <center>Edit Album</center>
                </h1>
                </font>
        <div class="body-add">
        <div class = "body">
        <center>
        <label class= "details-label"></label>
        <form method = 'post'>
        <table class = "add">
        <tr>
         <td class = "label-2">Album Name</td><td><input type = "text" name = "albumname" value = "<?=$album->albumname;?>"class = "textbox" required></td>
        </tr>
        <tr>
        <td>Artist Name</td><td><select class = "drop-down" name = "artist_id" ><?php foreach($artists as $artist): if($artist->artist_id == $album->artist_id){?> <option value = "<?php echo $artist->artist_id ?>" selected><?php echo $artist->stagename; ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->artist_id ?>"><?php echo $artist->stagename ?><?php } endforeach;?></td></tr>
        <tr>
        <tr><td>Genre</td><td><select class = "drop-down" name = "genre_id" ><?php foreach($genres as $genre): if($genre->genre_id == $album->genre_id){?> <option value = "<?php echo $genre->genre_id ?>" selected><?php echo $genre->genre; ?></option><?php } else{ ?>
        <option value = "<?php echo $genre->genre_id ?>"><?php echo $genre->genre ?><?php } endforeach;?></td></tr>
        <td>Record Label</td><td><input type = "text" name = "recordlabel" value="<?=$album->recordlabel;?>"class = "textbox" required></td>
        </tr>
        <tr><td>Release Date</td><td><input type = "date" name = "releasedate" value = "<?=$album->releasedate;?>" class = "textbox" required></td></tr>
        <tr><td>Notable Fact </td><td>&nbsp;<textarea name = "notablefact"><?php echo $album->notablefact;?></textarea></td></tr>
        </form></table>
        <br>
        <button type = "submit">Update Album</button>
              <br><br>

                </center>
            </div>
        </div>

        <footer>


            <center>&copy; Heather Norman Summer 2023 </center>

            </p>

        </footer>
    </body>

</html>