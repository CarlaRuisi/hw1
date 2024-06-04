<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_artist=mysqli_real_escape_string($conn, $_POST['id_artist']);
        $artist = mysqli_real_escape_string($conn, $_POST['nameartist']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $follower = mysqli_real_escape_string($conn, $_POST['follower']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "SELECT * FROM artist WHERE id_user = '$userid' AND artist = '$artist'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('exists' => true));
            exit;
        }

        $query_1 = "INSERT INTO artist (id_artist,id_user,artist,image,kind,follower) VALUES('$id_artist','$userid','$artist', '$image','$type','$follower')";
        $res=mysqli_query($conn, $query_1) or die(mysqli_error($conn));
        if($res) {
            echo json_encode(array('exists' => false));
            exit;
        }

        mysqli_close($conn);
    }
?>