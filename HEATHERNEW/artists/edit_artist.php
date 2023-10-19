<?php
require '../database.php';
if (
    isset($_POST['stagename'])  && isset($_POST['birthname']) &&
    isset($_POST['DOB'])  && isset($_POST['hometown'])  &&
    isset($_POST['DOD']) && isset($_POST['funfact'])
) {
    $birthname = $_POST['birthname'];
    $stagename = $_POST['stagename'];
    $DOB = $_POST['DOB'];
    $DOD = !empty($_POST['DOD']) ? $_POST['DOD'] : NULL;
    $hometown = $_POST['hometown'];
    $funfact = $_POST['funfact'];
    $artist_id = $_GET['artist_id'];
    $update_artist_query = 'UPDATE artists SET stagename = :stagename, birthname = :birthname, DOB = :DOB, hometown = :hometown, DOD = :DOD, funfact = :funfact
                            WHERE artist_id = :artist_id'; 
    $statement = $connection->prepare($update_artist_query);
    $statement->execute([':stagename' => $stagename, ':birthname' => $birthname, ':DOB' => $DOB, ':hometown' => $hometown, ':DOD' => $DOD, ':funfact' => $funfact, ':artist_id' => $artist_id]);
    $artist = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: allartists.php');
}
function get_artist(){
    global $connection;
    $artist_id = $_GET['artist_id'];
    $artist_query = 'SELECT *
                    FROM artists
                    WHERE artist_id = :artist_id';
    $statement = $connection->prepare($artist_query);
    $statement->execute([':artist_id'=>$artist_id]);
    $artists = $statement->fetch(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
$artist = get_artist();

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
                        <center>Edit Artist</center>
                </h1>
                </font>
                <center>
<div class="body-add">
<div class = "body">
    <center>
    <label class= "details-label"></label>
   <form method = 'post'>
    <table class = "add">
   
    <tr><td>Birth Name</td><td><input type = "text" name = "birthname" value="<?= $artist->birthname;?>"class = "textbox" required></td>
        </tr>
        <tr>
        <td class = "label-2">Stage Name</td><td><input type = "text" name = "stagename" value = "<?= $artist->stagename; ?>"class = "textbox"></td>
        </tr>
        <tr>
        <td>Date of Birth</td><td><input type = "date" name = "DOB" value="<?=$artist->DOB;?>"class = "textbox" required></td>
        </tr>
        <tr><td>Hometown</td><td><input type = "text" name = "hometown" value = "<?=$artist->hometown;?>" class = "textbox"></td></tr>
        <tr><td>Date of Death</td><td><input type = "date" name = "DOD" value = "<?=$artist->DOD;?>" class = "textbox"></td></tr>
        <tr><td>Notable Fact</td><td>&nbsp;<textarea name = "funfact" required><?php echo $artist->funfact;?></textarea></td></tr>
        </form></table>
        <br><br>
        <button type = "submit">Update Artist</button>

</div>
</div>
        <br><br>
        <footer>


            <center>&copy; Heather Norman Summer 2023 </center>

            </p>

        </footer>
    </body>

</html>