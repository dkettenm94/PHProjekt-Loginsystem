<?php
session_start();
// Wenn der User nicht eingeloggt ist, wird er auf die Startseite (Anmeldung) weitergeleitet
if(!isset($_SESSION['loggedin'])){
    header('Location: login_form.html');
    exit();
}

// gibt es nur, wenn ein User den Admin-Bereich betreten möchte - anders herum nicht. Admins dürfen überall hin :D
if($_SESSION['rolle'] != 'admin'){
    echo 'Sie sind kein Admin, Sie Frechdachs!';
    header('refresh: 3; user_inhalt.php');
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
        <title>Admin-Bereich</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Admin-Bereich</h1>
                <a href="admin_profile.php"><i class="fas fa-user-circle"></i>Account</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
            </div>
        </nav>
        <div class="content">
            <h2>Startseite</h2>
            <p>Willkommen im Admin-Bereich, <?=$_SESSION['name']?>! <br><br> Sie dürfen machen, was sie wollen.</p>
        </div>
    </body>
</html>