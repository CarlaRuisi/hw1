<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $id_artist = mysqli_real_escape_string($conn, $_GET["q"]);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM artist WHERE id_user = '$userid' AND id_artist='$id_artist'";
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