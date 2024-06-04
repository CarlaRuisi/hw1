<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: Spotify_home.php");
        exit;
    }   

    if (!empty($_POST["username"]) && !empty($_POST["password"]) &&
 !empty($_POST["email"]) && !empty($_POST["check_email"])&& !empty($_POST["name"]) && 
        !empty($_POST["surname"]) &&
 !empty($_POST["check_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{4,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM info_user WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 5) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["check_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM info_user WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }
        if (strcmp($_POST["email"], $_POST["check_email"]) != 0) {
            $error[] = "Le email non coincidono";
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password_hash = password_hash($password,PASSWORD_BCRYPT);
            $query = "INSERT INTO info_user(name,surname,username,email,password) VALUES('$name', '$surname', '$username', '$email', '$password_hash')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: Spotify_home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='signup.css'>
        <link rel='stylesheet' href='index.css'>
        <script src='signup.js' defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Iscriviti a Spotify</title>
    </head>
    <body>
        <section class="form flex_center centralize" id="Subscribe">
        <div class="flex_center" id="Logo">
            <h1 class="h1_header">Iscriviti Gratuitamente a Spotify</h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288"/>
            </svg>
        </div>
        <div class="contaier_form">
            <form name='signup' method='post'>
                <div class="names">
                    <div class="name flex_between">
                        <label for='name'>Nome</label>
                        <input type='text' name='name'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                        </svg><span>Devi inserire il tuo nome</span>
                    </div>
                    <div class="surname flex_between">
                        <label for='surname'>Cognome</label>
                        <input type='text' name='surname'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                        </svg><span>Devi inserire il tuo Cognome</span>
                    </div>
                    <div class="username flex_between">
                        <label for='username'>Nome utente</label>
                        <input type='text' name='username'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                            </svg><span>Devi inserire il tuo UserName</span>
                        </div>
                    <div class="email flex_between">
                        <label for='email'>Email</label>
                        <input type='text' name='email'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                            </svg><span>Devi inserire la tua email</span>
                    </div>
                    <div class="check_email flex_between">
                        <label for='check_email'>Conferma Email</label>
                        <input type='text' name='check_email'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                        </svg><span>Le ameil non coincidono</span>
                    </div>
                    <div class="password flex_between">
                        <label for='password'>Password</label>
                        <input type='password' name='password'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                        </svg><span>Devi inserire la tua password</span>
                    </div>
                    <div class="check_password flex_between">
                        <label for='confirm_password'>Conferma Password</label>
                        <input type='password' name='check_password'>
                    </div>
                    <div class="error hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                            </svg><span>Attenzione le password non coincidono</span>
                        </div>
                    <div class="allow"> 
                        <input type='checkbox' name='allow'>
                        <label for='allow'>Accetto i termini e condizioni d'uso.</label>
                    </div>
                </div>
                <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='error'><span>".$err."</span></div>";
                    }
                } ?>
                <div class="submit flex_center">
                    <input type='submit' value="Registrati" id="submit">
                </div>
            </form>
        </div>
        </section>
        <div class="signup flex_center column centralize" id="Access">
            Hai un account? 
            <button>
                <a href="login.php">Accedi</a>
            </button>
    </body>
</html>