<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM info_user WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   

        if(isset($_POST["name"])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $query = "UPDATE info_user SET name='$name' WHERE id='$userid'";
            $res_2 = mysqli_query($conn, $query);
            if ($res_2) {
                mysqli_close($conn);
                header("Location: profile.php");
                mysqli_free_result($res);
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        if(isset($_POST["surname"])) {
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $query = "UPDATE info_user SET surname='$surname' WHERE id='$userid'";
            $res_2 = mysqli_query($conn, $query);
            if ($res_2) {
                mysqli_close($conn);
                header("Location: profile.php");
                mysqli_free_result($res);
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        if(isset($_POST["password"])) {
            if(strlen($_POST["password"])< 5) {
                $error[] = "Caratteri password insufficienti";
            }
            else{
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $password=password_hash($password,PASSWORD_BCRYPT);
                $query = "UPDATE info_user SET password='$password' WHERE id='$userid'";
                $res_2 = mysqli_query($conn, $query);
                if ($res_2) {
                    mysqli_close($conn);
                    header("Location: profile.php");
                    mysqli_free_result($res);
                    exit;
                } else {
                    $error[] = "Errore di connessione al Database";
                }
            }
        }
        if(isset($_FILES["photo_profile"]["name"])){
            $error = array();
            
            #CONTROLLO IMMAGINE
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["photo_profile"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //estensione del file caricato e in lettere minuscole
            // Check se l'immagine è reale o fake
            $check = getimagesize($_FILES["photo_profile"]["tmp_name"]); //["tmp_name"]: Il nome del file temporaneo che è stato memorizzato sul server durante il caricamento.
            if($check == false) {
                $error[] = "Uploaded file is not an image.";
            }
            // Check dimensione
            if ($_FILES["photo_profile"]["size"] > 500000) { //["size"]: restituisce in byte la dimenzione del file
                $error[] = "Uploaded image is too large.";
            }
            //Check formato
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" & $imageFileType != "gif" ) {
                $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
            }
            if(count($error)==0){
                if (move_uploaded_file($_FILES["photo_profile"]["tmp_name"], $target_file)) {
                    $query = "UPDATE info_user SET profile='$target_file' WHERE id='$userid'";
                    $res = mysqli_query($conn, $query)  or die("Errore: ". mysqli_connect_error());
                    if($res){
                        header("Location:profile.php");
                        mysqli_free_result($res);
                        mysqli_close($conn);
                        exit;
                    }else{
                        $error[] = "Something went wrong.";
                    }
                    }
                
                 }
              }
 
?>

    <head>
        <link rel='stylesheet' href='profile.css'>
        <script src='profile.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


        <title>Profilo-<?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>
        <header>
            <div class="flex_center" id="header">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                </svg>
                <h1>Profilo <?php echo $userinfo['name']." ".$userinfo['surname'] ?></h1>
            </div>
        </header>
        <section>
            <div class="flex_column" id="photo_profile">
                <?php 
                        if($userinfo['profile']!==NULL) {
                            echo "<div id='container_photo_user'>
                                   <img src=".$userinfo['profile']."></div>";
                              }     
                        else{
                            echo' <svg id="svg_photo" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>';
                        }
                    ?>
                <form class="flex_between" method="post"  enctype="multipart/form-data">
                    <input type="file" id="photo_profile" name="photo_profile">
                    <input type="submit" value="Modifica" id="Modify_profile">  
                </form>
            </div>
            <div class="flex_column hidden_transition_DOWNTOP" id="info">
                <div class="grid" id="setting">
                    <h4> Nome </h4>
                    <h4 id="info_user"> <?php echo $userinfo['name']?></h4>
                    <button>Modifica</button>
                    <form class="flex_between hidden" method="post">
                        <input type="text" name="name">
                        <input type="submit" value="Modifica" class="hidden"> 
                        <span class="hidden"></span>
                    </form>
                </div>
                <div class="grid" id="setting">
                    <h4> Cognome </h4>
                    <h4> <?php echo $userinfo['surname']?></h4>
                    <button>Modifica</button>
                    <form class="flex_between hidden" method="post">
                        <input type="text" name="surname" >
                        <input type="submit" value="Modifica" class="hidden"> 
                        <span class="hidden"></span>
                    </form>
                </div>
                <div class="grid" id="setting">
                    <h4> Username </h4>
                    <h4> <?php echo $userinfo['username']?></h4>
                    <button>Modifica</button>
                    <form class="flex_between hidden" method="post">
                        <input type="text" name="username">
                        <input type="submit" value="Modifica" class="hidden">
                        <span class="hidden"></span>
                    </form>
                </div>
                <div class="grid" id="setting">
                    <h4> Email </h4>
                    <h4> <?php echo $userinfo['email']?></h4>
                    <button>Modifica</button>
                    <form class="flex_between hidden" method="post">
                        <input type="text" name="email">
                        <input type="submit" value="Modifica" class="hidden">
                        <span class="hidden"></span>
                    </form>
                </div>
                <div class="grid" id="setting">
                    <h4> Password </h4>
                    <div id="emoji">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile-upside-down-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M7 9.5C7 8.672 6.552 8 6 8s-1 .672-1 1.5.448 1.5 1 1.5 1-.672 1-1.5M4.285 6.433a.5.5 0 0 0 .683-.183A3.5 3.5 0 0 1 8 4.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.5 4.5 0 0 0 8 3.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683M10 8c-.552 0-1 .672-1 1.5s.448 1.5 1 1.5 1-.672 1-1.5S10.552 8 10 8"/>
                        </svg>
                    </div>
                    <button>Modifica</button>
                    <form class="flex_between hidden" method="post">
                        <input type="password" name="password" >
                        <input type="submit" value="Modifica" class="hidden">
                        <span class="hidden"></span>
                    </form>
                </div>
                <div class="grid_return" id="option">
                    <button class="home" id="home"><a href="Spotify_home.php">Torna alla home</a></button>
                    <button class="home" id="favourite"><a href="Preferiti.php">Visualizza i tuoi preferiti</a></button>
                </div>
            </div>
            <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errorj'><img src='./assets/close.svg'/><span>".$err."</span></div>";
                    }
                } ?>
        </section>
    

    </body>
</html>

<?php mysqli_close($conn); ?>