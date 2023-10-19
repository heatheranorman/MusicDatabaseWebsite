<?php
require '../database.php';

if (
    isset($_POST['birthname'])  && isset($_POST['stagename']) &&
    isset($_POST['DOB']) && isset($_POST['DOD']) && 
    isset($_POST['funfact'])&&
    isset($_POST['hometown'])
) {
    $birthname = $_POST['birthname'];
    $stagename = $_POST['stagename'];
    $DOB = $_POST['DOB'];
    $DOD = !empty($_POST['DOD']) ? $_POST['DOD'] : NULL;
    $funfact = $_POST['funfact'];
    $hometown = $_POST['hometown'];


    $new_artist_info = 'INSERT INTO artists (birthname, stagename, DOB, DOD, funfact, hometown) 
                            VALUES (:birthname, :stagename, :DOB, :DOD, :funfact, :hometown)';


    $statement = $connection->prepare($new_artist_info);
    $statement->execute([':birthname' => $birthname, ':stagename' => $stagename, ':DOB' => $DOB, ':DOD' => $DOD, ':funfact' => $funfact, ':hometown' => $hometown]);

    header("Location: allartists.php");
}

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
        <title>Add Artist</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>

    <body>
        <div id="main">
            <div class="body">

                <h1 class="table_header">
                    <font color="black">
                        <center>Add Artist</center>
                    </font>
                </h1>

    <center>
    <form method="post">
    <table class = "add">
    <tr>
    <td class = "label-2">Artist Birth Name</td><td><input type="text" name="birthname" id="birthname" required><br></td>
    </tr><tr>
    <td>Artist Stage Name</td><td><input type="text" name="stagename" id="stagename" required><br></td>
    </tr><tr>
    <td>Date Of Birth</td><td><input type="text" name="DOB" id="DOB" placeholder="YYYY-MM-DD" required><br></td>
    </tr><tr>
    <td>Hometown</td><td><input type="text" name="hometown" id="hometown" required><br></td>
    </tr><tr>
    <td>Date Of Death</td><td><input type="text" name="DOD" id="DOD" placeholder="YYYY-MM-DD"><br></td>
    </tr><tr>
    <td>Fun Fact</td><td>&nbsp;<textarea type="text" name="funfact" id="funfact" required></textarea></td>
    </tr>
    </form></table><br><br>
            <input type="submit" value="Add Artist">
            <br><br>
                    </form>
                </center>


                <footer>


                    <center>&copy; Heather Norman Summer 2023 </center>

                    </p>

                </footer>

    </body>
</div>

</html>