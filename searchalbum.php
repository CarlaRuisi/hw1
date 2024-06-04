<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);

        $query = "SELECT * FROM album WHERE id_user = '$userid'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $album= array();
        while ($row = mysqli_fetch_assoc($res)) {
            $album[] = $row;
        }
        echo json_encode($album);
        exit;
        

        mysqli_close($conn);
    }
?>