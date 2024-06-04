<?php 
    require_once 'auth.php';
    if (!$user_id = checkAuth()) {
        header("Location: index.php");
        exit;
    }
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $user_id);
    $query = "SELECT * FROM info_user WHERE id = $user_id";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
?>

<html>
    <head>
        <title>Benvenuto <?php echo $userinfo["username"]?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="Spotify_home.css">
        <script src="images.js" defer></script>
        <script src="Spotify_home.js" defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="flex_around" id="header">
                <div class="container_image" id="logo">
                </div>
                <div class="flex_around" id="option">
                    <div class="dropdown" id="info_dropdown">Premium
                        <div class="dropdown_content hidden" id="info">
                            <div class="content">
                                <h3>Premium Individual</h3>
                                <p>1 account per 1 persona</p>
                                <hr>
                            </div>
                            <div class="content">
                                <h3>Premium Individual</h3>
                                <p>1 account per 1 persona</p>
                                <hr>
                            </div>
                            <div class="content">
                                <h3>Premium Individual</h3>
                                <p>1 account per 1 persona</p>
                                <hr>
                            </div>
                            <div class="content">
                                <h3>Premium Individual</h3>
                                <p>1 account per 1 persona</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <a>Assistenza</a>
                    <a>Scarica</a>
                    <div id="separatore">|</div>
                    <div id="Profile" class="dropdown">
                        <div id="Option_profile" class="flex_around">
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
                            <a><?php echo $userinfo['username']?></a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" id="arrow_down" viewBox="0 0 16 16">
                                <path d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up hidden" id="arrow_up" viewBox="0 0 16 16">
                            <path d="M3.204 11h9.592L8 5.519zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659"/>
                            </svg>
                        </div>
                        <div class="dropdown_content hidden" id="setting">
                            <div class="content">
                                        <a href="profile.php">Profile</a>
                                        <hr>
                            </div>
                           
                            <div class="content">
                                <a href="Preferiti.php">I tuoi preferiti</a>
                            </div>
                        </div>  
                    </div>
                    <div class="button_Logout">
                        <button class="Btn">
                            <div class="sign">
                                <svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg>
                            </div>
                            <div class="text">
                                <a href="Logout.php">Logout</a></div>
                        </button>
                    </div>
                </div>
                <div class="flex_around column" id="Mobile">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </header>
        <section class="background_main">
            <div id="container">
                <div class="flex_around">
                    <div class="column" id="info_main">
                        <h1>Prova Spotify Premium</h1>
                        <h3>Dopo solo &euro;10,99 al mese</h3>
                        <div id="button">
                            <button id="violet">Prova gratis per 1 mese</button>
                            <button id="black"><a href="more_info.php">Visualizza tutti i piani</a></button>
                        </div>
                        <a href="https://www.spotify.com/it/legal/premium-promotional-offer-terms/">Applica termini e condizioni</a>
                    </div>
                    <div class="container_image" id="moon">
                    </div>
                </div>

            </div>

        </section>
        <section class="background">
            <div id="table_container" class="column flex center">
                <h1>Sperimenta la differenza</h1>
                <h3>Passa a Premium e approfitta del pieno controllo della musica che ascolti. Annulla quando vuoi.</h3>
                <div id="table" class="flex center hidden_transition_DOWNTOP">
                    <table>
                        <tr>
                            <th class="col_1">
                                    <div id="header_col_1">
                                    <h5>Cosa otterrai</h5>
                                    </div>
                            </th>
                            <th class="col_2">
                                    <div id="header_col_2">
                                        <h5>Piano gratuito di Spotify</h5>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div id="header_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                                        </svg>
                                        <h5>Premium</h5>
                                    </div>
                            </th>
                        </tr>                      
                        <tr>
                            <th class="col_1">
                                <div class="content_col_1">
                                    <h5>Musica senza pubblicità</h5>
                                </div>
                            </th>
                            <th class="col_2">
                                    <div class="content_col_2">
                                        <hr>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div class="content_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                        </svg>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="col_1">
                                <div class="content_col_1">
                                    <h5>Musica senza pubblicità</h5>
                                </div>
                            </th>
                            <th class="col_2">
                                    <div class="content_col_2">
                                        <hr>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div class="content_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                        </svg>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="col_1">
                                <div class="content_col_1">
                                    <h5>Musica senza pubblicità</h5>
                                </div>
                            </th>
                            <th class="col_2">
                                    <div class="content_col_2">
                                        <hr>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div class="content_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                        </svg>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="col_1">
                                <div class="content_col_1">
                                    <h5>Musica senza pubblicità</h5>
                                </div>
                            </th>
                            <th class="col_2">
                                    <div class="content_col_2">
                                        <hr>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div class="content_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                        </svg>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="col_1">
                                <div class="content_col_1">
                                    <h5>Musica senza pubblicità</h5>
                                </div>
                            </th>
                            <th class="col_2">
                                    <div class="content_col_2">
                                        <hr>
                                    </div>
                            </th>
                            <th class="col_3">
                                    <div class="content_col_3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                        </svg>
                                    </div>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <section class="background">
            <div class="flex_center" id="api_section">
                <h3>Prova anche tu cosa significa avere Spotify Premium!</h3>
                <button class="button_api_section">
                    <a href="api_search.php">
                        Prova ora
                    </a>
                </button>
            </div>
        </section>
        <section class="background">
            <div id="section_pay" class="flex_center center column">
                <h1>Piani convenienti per ogni situazione</h1>
                <h3>Scegli un piano Premium e ascolta musica senza pubblicità, senza limiti tramite telefono, altoparlante e altri dispositivi. Paga in vari modi. Annulla quando vuoi.</h3>
                <div class="flex_around" id="pay_container">
                    <div class="container_image" id="image">
                    </div>
                    <div class="container_image" id="image">
                    </div>
                    <div class="container_image" id="image">
                    </div>
                    <div class="container_image" id="image">
                    </div>
                </div>
            </div>
        </section>
        <section class="background">
            <div class="flex_center center" id="premium_option">
                <h3>Tutti i piani premium includono</h3>
                <button id="button_option">Scopri di più</button>
                <div id="elenco" class="hidden">
                    <ul>
                        <li class="flex_center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            <p> Musica senza pubblicità</p>
                        </li>
                        <li class="flex_center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            <p> Musica senza pubblicità</p>
                        </li>
                        <li class="flex_center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            <p> Musica senza pubblicità</p>
                        </li>
                        <li class="flex_center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            <p> Musica senza pubblicità</p>
                        </li>
                        <li class="flex_center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            <p> Musica senza pubblicità</p>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </section> 
        <section class="background">
            <div class="grid">
                <div class="card">
                   <div class="header_card">
                    <p>Gratis per un mese</p>
                   </div> 
                   <div class="title_card">
                        <div class="flex column">
                            <div class="flex " id='logo_card'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                                </svg>
                                <h3>Premium</h3>
                            </div>
                            <h1>Individual</h1>
                            <h5>Gratis per 1 mese</h5>
                            <p>Dopo &euro;10,99 al mese</p>
                        </div>
                   </div>
                    <hr>
                    <div class="card_elenco">
                        <ul>
                            <li>1 account Premium</li>
                            <li>Annulla quando vuoi</li> 
                        </ul>
                    </div>
                    <div class="card_button flex_center">
                        <button>Prova gratis per un mese</button>
                    </div> 
                    <div class="card_footer">
                        <p>Gratis per 1 mese, poi 10,99 € al mese. Offerta disponibile solo se non hai ancora provato Premium.<a href="#"> Si applicano termini e condizioni.</a></p>
                    </div>
                </div>
                <div class="card">
                   <div class="header_card">
                    <p>Gratis per un mese</p>
                   </div> 
                   <div class="title_card">
                        <div class="flex column">
                            <div class="flex " id='logo_card'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                                </svg>
                                <h3>Premium</h3>
                            </div>
                            <h1>Individual</h1>
                            <h5>Gratis per 1 mese</h5>
                            <p>Dopo &euro;10,99 al mese</p>
                        </div>
                   </div>
                    <hr>
                    <div class="card_elenco">
                        <ul>
                            <li>1 account Premium</li>
                            <li>Annulla quando vuoi</li> 
                        </ul>
                    </div>
                    <div class="card_button flex_center">
                        <button>Prova gratis per un mese</button>
                    </div> 
                    <div class="card_footer">
                        <p>Gratis per 1 mese, poi 10,99 € al mese. Offerta disponibile solo se non hai ancora provato Premium.<a href="#"> Si applicano termini e condizioni.</a></p>
                    </div>
                </div>
                <div class="card">
                   <div class="header_card">
                    <p>Gratis per un mese</p>
                   </div> 
                   <div class="title_card">
                        <div class="flex column">
                            <div class="flex " id='logo_card'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                                </svg>
                                <h3>Premium</h3>
                            </div>
                            <h1>Individual</h1>
                            <h5>Gratis per 1 mese</h5>
                            <p>Dopo &euro;10,99 al mese</p>
                        </div>
                   </div>
                    <hr>
                    <div class="card_elenco">
                        <ul>
                            <li>1 account Premium</li>
                            <li>Annulla quando vuoi</li> 
                        </ul>
                    </div>
                    <div class="card_button flex_center">
                        <button>Prova gratis per un mese</button>
                    </div> 
                    <div class="card_footer">
                        <p>Gratis per 1 mese, poi 10,99 € al mese. Offerta disponibile solo se non hai ancora provato Premium.<a href="#"> Si applicano termini e condizioni.</a></p>
                    </div>
                </div>
                <div class="card" id="items_grid">
                   <div class="header_card">
                    <p>Gratis per un mese</p>
                   </div> 
                   <div class="title_card">
                        <div class="flex column">
                            <div class="flex " id='logo_card'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
                                </svg>
                                <h3>Premium</h3>
                            </div>
                            <h1>Individual</h1>
                            <h5>Gratis per 1 mese</h5>
                            <p>Dopo &euro;10,99 al mese</p>
                        </div>
                   </div>
                    <hr>
                    <div class="card_elenco">
                        <ul>
                            <li>1 account Premium</li>
                            <li>Annulla quando vuoi</li> 
                        </ul>
                    </div>
                    <div class="card_button flex_center">
                        <button>Prova gratis per un mese</button>
                    </div> 
                    <div class="card_footer">
                        <p>Gratis per 1 mese, poi 10,99 € al mese. Offerta disponibile solo se non hai ancora provato Premium.<a href="#"> Si applicano termini e condizioni.</a></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="background">
            <div id="info">
                <div class="flex_center column">
                    <h1>Hai domande?</h1>
                    <h5>Abbiamo noi le risposte</h5>
                </div>
               <div class="flex_between center dropdown" id="section_info">
                <h3>Come funziona il periodo di prova di Spotify Premium?</h3>
                <svg id="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
                <svg id="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-up hidden" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
                </svg>
               </div>
               <div class="dropdown_content_info hidden">
                <p>Se non hai mai avuto Premium prima d'ora, potresti avere diritto a un periodo di prova gratuito (o a una tariffa ridotta).</br>Per i periodi di prova, devi comunque inserire un metodo di pagamento valido per iscriverti. Lo utilizzeremo per confermare il tuo Paese o la tua regione ed effettuare i pagamenti qualora decidessi di tenere Premium al termine dell'offerta.</br>Ti invieremo un promemoria 7 giorni prima del termine del periodo di prova. Si applicano termini e condizioni e restrizioni in base al Paese.</p>
               </div>
               <div class="flex_between center dropdown" id="section_info">
                <h3>Come funziona il periodo di prova di Spotify Premium?</h3>
                <svg id="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
                <svg id="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-up hidden" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
                </svg>
               </div>
               <div class="dropdown_content_info hidden">
                <p>Se non hai mai avuto Premium prima d'ora, potresti avere diritto a un periodo di prova gratuito (o a una tariffa ridotta).</br>Per i periodi di prova, devi comunque inserire un metodo di pagamento valido per iscriverti. Lo utilizzeremo per confermare il tuo Paese o la tua regione ed effettuare i pagamenti qualora decidessi di tenere Premium al termine dell'offerta.</br>Ti invieremo un promemoria 7 giorni prima del termine del periodo di prova. Si applicano termini e condizioni e restrizioni in base al Paese.</p>
               </div>
               <div class="flex_between center dropdown" id="section_info">
                <h3>Come funziona il periodo di prova di Spotify Premium?</h3>
                <svg id="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
                <svg id="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-up hidden" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
                </svg>
               </div>
               <div class="dropdown_content_info hidden">
                <p>Se non hai mai avuto Premium prima d'ora, potresti avere diritto a un periodo di prova gratuito (o a una tariffa ridotta).</br>Per i periodi di prova, devi comunque inserire un metodo di pagamento valido per iscriverti. Lo utilizzeremo per confermare il tuo Paese o la tua regione ed effettuare i pagamenti qualora decidessi di tenere Premium al termine dell'offerta.</br>Ti invieremo un promemoria 7 giorni prima del termine del periodo di prova. Si applicano termini e condizioni e restrizioni in base al Paese.</p>
               </div>
               <div class="flex_between center dropdown" id="section_info">
                <h3>Come funziona il periodo di prova di Spotify Premium?</h3>
                <svg id="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
                <svg id="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-up hidden" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
                </svg>
               </div>
               <div class="dropdown_content_info hidden">
                <p>Se non hai mai avuto Premium prima d'ora, potresti avere diritto a un periodo di prova gratuito (o a una tariffa ridotta).</br>Per i periodi di prova, devi comunque inserire un metodo di pagamento valido per iscriverti. Lo utilizzeremo per confermare il tuo Paese o la tua regione ed effettuare i pagamenti qualora decidessi di tenere Premium al termine dell'offerta.</br>Ti invieremo un promemoria 7 giorni prima del termine del periodo di prova. Si applicano termini e condizioni e restrizioni in base al Paese.</p>
               </div>
               <div class="flex_between center dropdown" id="section_info">
                <h3>Come funziona il periodo di prova di Spotify Premium?</h3>
                <svg id="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
                <svg id="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-up hidden" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
                </svg>
               </div>
               <div class="dropdown_content_info hidden">
                <p>Se non hai mai avuto Premium prima d'ora, potresti avere diritto a un periodo di prova gratuito (o a una tariffa ridotta).</br>Per i periodi di prova, devi comunque inserire un metodo di pagamento valido per iscriverti. Lo utilizzeremo per confermare il tuo Paese o la tua regione ed effettuare i pagamenti qualora decidessi di tenere Premium al termine dell'offerta.</br>Ti invieremo un promemoria 7 giorni prima del termine del periodo di prova. Si applicano termini e condizioni e restrizioni in base al Paese.</p>
               </div>
            </div>

        </section>
        <footer class="background_footer">
            <div class="flex_around">
                <div class="container_image" id="white">
                </div>
                <div class="flex_around" id="elenco_footer">
                    <ul>
                        <li id="header">Azienda</li>
                        <li><a href="#">Link_Utili</a></li>
                        <li><a href="à">Opportunità di lavoro</a></li>
                        <li><a href="#">Chi siamo</a></li>
                    </ul>
                    <ul>
                        <li id="header">Azienda</li>
                        <li><a href="#">Link_Utili</a></li>
                        <li><a href="#">Opportunità di lavoro</a></li>
                        <li><a href="#">Chi siamo</a></li>
                    </ul>
                    <ul>
                        <li id="header">Azienda</li>
                        <li><a href="#">Link_Utili</a></li>
                        <li><a href="#">Opportunità di lavoro</a></li>
                        <li><a href="#">Chi siamo</a></li>
                    </ul>
                </div>
                <div class="flex_center">
                    <div class="container_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                        </svg>
                    </div>
                    <div class="container_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                         <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </div>
                    <div class="container_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>


