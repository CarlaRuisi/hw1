<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_audio=mysqli_real_escape_string($conn, $_POST['id_audio']);
        $author = mysqli_real_escape_string($conn, $_POST['authors']);
        $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
        $audio = mysqli_real_escape_string($conn, $_POST['audio']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "SELECT * FROM audio WHERE id_user = '$userid' AND id_audio = '$id_audio'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('exists' => true));
            exit;
        }

        $query_1 = "INSERT INTO audio (id_audio,id_user,audio,authors,image,publisher) VALUES('$id_audio','$userid','$audio','$author','$image','$publisher')";
        $res=mysqli_query($conn, $query_1) or die(mysqli_error($conn));
        if($res) {
            echo json_encode(array('exists' => false));
            exit;
        }

        mysqli_close($conn);
    }
?>