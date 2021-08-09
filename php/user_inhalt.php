<?php
session_start();
// Wenn der User nicht eingeloggt ist, wird er auf die Startseite (Anmeldung) weitergeleitet
if(!isset($_SESSION['loggedin'])){
    header('Location: ../html/login_form.html');
    exit();
}

mysqli_report(MYSQLI_REPORT_ERROR); 
error_reporting(-1);
?>



<!DOCTYPE html>
<html lang="de-DE">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User-Bereich</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>User-Bereich</h1>
                <a href="user_profile.php"><i class="fas fa-user-circle"></i>Account</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
            </div>
        </nav>
        <div class="content">
            <h2>Startseite</h2>
            <p>Willkommen im User-Bereich, <?=$_SESSION['name']?>! <br><br> 180°-Drehkick auf dein einfaches User-Dasein.</p>
        </div>
    </body>
</html>