<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: Spotify_home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT * FROM info_user WHERE username = '".$username."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            $password= $entry["password"];
            echo "".$username."</br>".$password."";
            if ((password_verify($_POST["password"],$password))) {
                $_SESSION["username"] = $entry['username'];
                $_SESSION["user_id"] = $entry['id'];
                header("Location: Spotify_home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }else{
                $error = "Password errato."; 
            }
        }else{
        $error = "Username errato.";
        }
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>

<html>
    <head>
        <link rel='stylesheet' href='login.css'>
        <link rel='stylesheet' href='signup.css'>
        <link rel='stylesheet' href='index.css'>
        <script href="Login.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accedi a Spotify Premium</title>
    </head>
    <body>
    <header class="flex_center" id="Logo">
            <h1>Accedi a Spotify</h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
            </svg>
        </header>
        <section id="Accesso" class="form flex_center column centralize">
            <form name='signup' method='post'>
                <div class="names">
                    <div class="username">
                        <label for='username'>UserName</label>
                        </br>
                        <input type='text' name='username'>
                    </div>
                    <div class="password">
                        <label for='password'>Password</label>
                        </br>
                        <input type='password' name='password'>
                    </div>
                    <div class="submit flex_center centralize">
                        <input type="submit" value="Accedi">
                    </div>
                    <?php
                    if (isset($error)) {
                        echo "<p class='error textcenter'>$error</p>";
                    }
                    
                ?>
            <div id="Iscrizione" class="flex_center column centralize">
                <h4 class="signup">Non hai un account?</h4>
                <button class="signup" id="iscrizione_button"><a href="signup.php">ISCRIVITI A SPOTIFY PREMIUM</a></button>
            </div>
        </section>
        </main>
    </body>
</html>