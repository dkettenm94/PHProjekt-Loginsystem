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

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phprojekt';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(mysqli_connect_errno()){
    die('Fehler bei der Verbindung zu MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, email, rolle FROM logindaten WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $rolle);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="de-DE">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin-Profil</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Admin-Bereich</h1>
                <a href="admin_inhalt.php"><i class="fas fa-user-circle"></i>Startseite</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
            </div>
        </nav>
        <div class="content">
            <h2>Account-Informationen</h2>
            <div>
                <p>Ihre Account-Informationen sehen Sie hier:</p>
                <table>
                    <tr>
                        <td>Benutzername:</td>
                        <td><?=$_SESSION['name']?></td>
                    </tr>
                    <tr>
                        <td>Passwort:</td>
                        <td><?=$password?></td>
                    </tr>
                    <tr>
                        <td>E-Mail:</td>
                        <td><?=$email?></td>
                    </tr>
                    <tr>
                        <td>Rolle:</td>
                        <td><?=$rolle?></td>
                    </tr>
                </table>
            </div>
        </div> 
    </body>
</html>