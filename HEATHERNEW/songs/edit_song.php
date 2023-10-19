<?php
require '../database.php';

    global $connection;
    $song_id = $_GET['song_id'];
    function get_song(){
        global $connection;
        $song_id = $_GET['song_id'];
        $song_query = 'SELECT *
                            FROM songs 
                                JOIN albums ON songs.album_id = albums.album_id 
                                JOIN artists ON albums.artist_id = artists.artist_id
                                WHERE songs.song_id= :song_id';
        $statement = $connection->prepare($song_query);
        $statement->bindParam(':song_id', $song_id, PDO::PARAM_INT);
        $statement->execute([':song_id'=> $song_id]);
        $song_info = $statement->fetch(PDO::FETCH_OBJ);
        $statement->closeCursor();
        return $song_info;
    }
    if (
        isset($_POST['songname'])  && isset($_POST['artistname']) &&
        isset($_POST['albumname'])  && isset($_POST['lengthinseconds'])  &&
        isset($_POST['comments']) && isset($_POST['writername'])
    ) {
        $songname = $_POST['songname'];
        $stagename = $_POST['artistname'];
        $albumname = $_POST['albumname'];
        $lengthinseconds = $_POST['lengthinseconds'];
        $comments = !empty($_POST['comments']) ? $_POST['comments'] : NULL;
        $writername = $_POST['writername'];
    
    $artist_id_query = 'SELECT artist_id FROM artists WHERE stagename = :stagename';
    $artist_statement = $connection->prepare($artist_id_query);
    $artist_statement->execute(['stagename' => $stagename]);
    $artist_object = $artist_statement->fetch(PDO::FETCH_OBJ);
    $artist_id = $artist_object->artist_id;
   
    $album_id_query = 'SELECT album_id FROM albums WHERE albumname = :albumname';
    $album_statement = $connection->prepare($album_id_query);
    $album_statement->execute(['albumname' => $albumname]);
    $album_object = $album_statement->fetch(PDO::FETCH_OBJ);

    $album_id = $album_object->album_id;
    $update_song = 'UPDATE songs SET songname = :songname, artist_id = :artist_id, album_id = :album_id, lengthinseconds = :lengthinseconds, comments = :comments, writername = :writername WHERE song_id = :song_id';

    $song_id=$_GET['song_id'];
    $statement = $connection->prepare($update_song);
    $statement->execute([':songname' => $songname, ':artist_id' => $artist_id, ':album_id' => $album_id, ':lengthinseconds' => $lengthinseconds, ':comments' => $comments, ':writername' => $writername, ':song_id' => $song_id]);
    $new_song = $statement->fetch(PDO::FETCH_OBJ);
    header('Location: allsongs.php');      
    }      



    function get_all_artists()
{
    global $connection;
    $artist_query = 'SELECT DISTINCT stagename, artists.artist_id, albumname, album_id
                        FROM artists JOIN albums on artists.artist_id = albums.album_id';
    $statement = $connection->prepare($artist_query);
    $statement->execute();
    $artists = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
$artists = get_all_artists();
$song_info = get_song();

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
                        <center>Edit Song</center>
                </h1>
                </font>
<div class="body-add">
<div class = "body">
    <center>
    <label class= "details-label"></label>
   <form method = 'post'>
    <table class = "add">
    <tr>
        <td class = "label-2">Song Name</td><td><input type = "text" name = "songname" value = "<?= $song_info->songname; ?>" class = "textbox" required></td>
        </tr>
        <tr>
        <td>Artist Name</td><td><select class = "drop-down" name = "artistname"> <?php foreach($artists as $artist): if($artist->artist_id == $song_info->artist_id){?> <option value = "<?php echo $song_info->stagename ?>" selected><?php echo $artist->stagename; ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->artist_id ?>"><?php echo $artist->stagename ?><?php } endforeach;?></td>
        </tr>
        <tr>
        <td>Album Name</td><td><select class = "drop-down" name = "albumname" ><?php foreach($artists as $artist): if($artist->album_id == $song_info->album_id){?> <option value = "<?php echo $song_info->albumname ?>" selected><?php echo $artist->albumname; ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->album_id ?>"><?php echo $artist->albumname ?><?php } endforeach;?></td>
        <tr><td>Length in Seconds</td><td><input type = "text" name = "lengthinseconds" value = "<?=$song_info->lengthinseconds?>" class = "textbox" required></td></tr>
        <tr><td>Writer</td><td><input type = "text" name = "writername" value = "<?=$song_info->writername?>" class = "textbox" required></td></tr>
        <tr><td>Comments</td><td>&nbsp;<textarea name = "comments"><?php echo $song_info->comments;?></textarea></td></tr>
        </form></table>
       <br><br>
        <button type = "submit">Update Song</button>
        

        </div>
</div></center>
    <br><br>
        <footer>


            <center>&copy; Heather Norman Summer 2023 </center>

            </p>

        </footer>
    </body>

</html>