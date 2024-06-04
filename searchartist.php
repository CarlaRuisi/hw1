<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);

        $query = "SELECT * FROM artist WHERE id_user = '$userid'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $artists = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $artists[] = $row;
        }
        echo json_encode($artists);
        exit;
        

        

        mysqli_close($conn);
    }
?>