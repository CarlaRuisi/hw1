<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_album=mysqli_real_escape_string($conn, $_POST['id_album']);
        $album = mysqli_real_escape_string($conn, $_POST['album']);
        $artist = mysqli_real_escape_string($conn, $_POST['artist']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $total_tracks=mysqli_real_escape_string($conn, $_POST['total_tracks']);

        $query = "SELECT * FROM album WHERE id_user = '$userid' AND album = '$album'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('exists' => true));
            exit;
        }

        $query_1 = "INSERT INTO album (id_album,id_user,album,artist,image,total_tracks) VALUES('$id_album','$userid','$album','$artist', '$image','$total_tracks')";
        $res=mysqli_query($conn, $query_1) or die(mysqli_error($conn));
        if($res) {
            echo json_encode(array('exists' => false));
            exit;
        }

        mysqli_close($conn);
    }
?>