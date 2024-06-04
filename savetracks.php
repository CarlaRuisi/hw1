<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_track=mysqli_real_escape_string($conn, $_POST['id_track']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $artist = mysqli_real_escape_string($conn, $_POST['artist']);
        $album = mysqli_real_escape_string($conn, $_POST['album']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "SELECT * FROM tracks WHERE id_user = '$userid' AND title= '$title'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('exists' => true));
            exit;
        }

        $query_1 = "INSERT INTO tracks (id_tracks,id_user,title,artist,album,image) VALUES('$id_track','$userid','$title', '$artist','$album','$image')";
        $res=mysqli_query($conn, $query_1) or die(mysqli_error($conn));
        if($res) {
            echo json_encode(array('exists' => false));
            exit;
        }

        mysqli_close($conn);
    }
?>