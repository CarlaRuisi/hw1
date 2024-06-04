<?php 
    require_once 'auth.php';
    if (!$user_id = checkAuth()) {
        header("Location: index.php");
        exit;
          
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $user_id);
    $query = "SELECT * FROM info_user WHERE id = $user_id";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
    }
?>

<html>  
    <head>
        <title>Search_Api</title>
        <script src="images.js" defer></script>
        <script src="api_search.js" defer></script>
        <link rel="stylesheet" href="api_search.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
       <header>
        <div class="flex_around"id="header">
                <div class="container_image" id="logo">
                </div>
                <div class="flex_around" id="exit">
                    <a href="Spotify_home.php">Exit</a>
                </div>
        </div> 
       </header> 
       <section class="background_api">
            <div id="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16" id="music">
                        <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13s1.12-2 2.5-2 2.5.896 2.5 2m9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2"/>
                        <path fill-rule="evenodd" d="M14 11V2h1v9zM6 3v10H5V3z"/>
                        <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4z"/>
                    </svg>
                <h1>Prova la bellezza del Premium</h1> 
                <h3>Cerca qui</h3>
                <form name="api" method="post">
                    <label for="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search-heart-fill" viewBox="0 0 16 16">
                        <path d="M6.5 13a6.47 6.47 0 0 0 3.845-1.258h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1A6.47 6.47 0 0 0 13 6.5 6.5 6.5 0 0 0 6.5 0a6.5 6.5 0 1 0 0 13m0-8.518c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
                        </svg>
                        Search 
                    </label>
                    <select id="type" name="list" form="api">
                        <option value="Artist">Artista</option>
                        <option value="Track">Musica</option>
                        <option value="Album">Album</option>
                        <option value="Audiobook">Audiobook</option>
                    <input type="text" name="search" id="search_content">
                </form>
                <span></span>
            </div>
            <div id="result">   
                <div id="result_spotify">
                    
                </div>
            </div>
       </section>
    </body>
</html>