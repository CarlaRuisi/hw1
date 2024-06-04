<?php
    require_once 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $id_album = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT * FROM album WHERE id_user='$userid' AND id_album = '$id_album'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0) {
        $query="DELETE FROM album WHERE id_user='$userid' AND id_album = '$id_album'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(!$res){
            echo json_encode(array('exists'=>false));
        }else{
            echo json_encode(array('exists'=>true));
        }

        }
        else{
            echo json_encode(array('exists'=>false));
        }
    

    mysqli_close($conn);
?>