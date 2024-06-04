<?php 
    require_once 'auth.php';
    if (!$user_id = checkAuth()) {
        header("Location: index.php");
        exit;
    }  
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $user_id);
    $query = "SELECT * FROM info_user WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
    
?>

<html>
    <head>
        <title> Preferiti di <?php echo $userinfo['username']?> </title>
        <script src="images.js" defer></script>
        <script src="Preferiti.js" defer></script>
        <link rel="stylesheet" href="api_search.css">
        <link rel="stylesheet" href="Preferiti.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
    <header>
            <div class="flex_around"id="header">
                <div class="container_image" id="logo"></div>
                <div class="flex_around" id="exit">
                <div class="button_Logout">
                        <button class="Btn">
                            <div class="sign">
                                <svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg>
                            </div>
                            <div class="text">
                                <a href="Spotify_Home.php">Back</a></div>
                        </button>
                    </div>
                </div>
            </div> 
    </header> 
    <section class="background">
        <div id="title" class="hidden_transition_DOWNTOP">
            <h1>I tuoi preferiti</br>Quando vuoi e dove vuoi</h1>
        </div>
        <div class="navbar_option">
            <h2 id="artist">Artisti</h2>
            <h2 id="brani">Brani</h2>
            <h2 id="album">Album</h2>
            <h2 id="audio">Audiobook</h2>
            <div id="form">
                <form name="delete" method="post" class="hidden form">
                    <input type="submit" value="Aggiorna">
            </form>
        </div>
            
        </div>
        <div id="favourite">
            
        </div>
    </section>
    </body>
</html>
