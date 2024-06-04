<?php 
    require_once 'dbconfig.php';
    require_once 'auth.php';
    if (!$user_id = checkAuth()) {
        header("Location: index.php");
        exit;
    }


    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM info_user WHERE username='$username'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if( mysqli_num_rows($res) > 0){
        echo json_encode(array('exists' =>false));
    }
    else{
        $query1 = "UPDATE info_user SET username='$username'WHERE id='$user_id'";
        $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
        if(!$res1){
            echo json_encode(array("exists"=>'impossible'));
        }else{
            echo json_encode(array('exists'=>true));
        }
    }

    mysqli_close($conn);
?>