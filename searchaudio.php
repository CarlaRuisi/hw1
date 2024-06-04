<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);

        $query = "SELECT * FROM audio WHERE id_user = '$userid'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $audio = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $audio[] = $row;
        }
        echo json_encode($audio);
        exit;
    

        mysqli_close($conn);
    }
?>