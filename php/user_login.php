<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phprojekt';

mysqli_report(MYSQLI_REPORT_ERROR); 
error_reporting(-1);

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(mysqli_connect_errno()){
    die ('Fehler bei der Verbindung zu MySQL: ' . mysqli_connect_error());
}

if(!isset($_POST['username'], $_POST['password'])){
    die('irgendein Input hat einen falschen Namen :)');
}

if(empty($_POST['username'] && $_POST['password'])){
    die('Bitte füllen Sie alle Felder aus!');
}

if($stmt = $con->prepare('SELECT id, password, rolle FROM logindaten WHERE username = ?')){
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $password, $rolle);
        $stmt->fetch();
        // Account mit dem eingegebenen Benutzernamen existiert, Passwort wird überprüft
        if(password_verify($_POST['password'], $password)){
            // Authentifizierung abgeschlossen - User wird nun eingeloggt!
            // Sessions zum überprüfen, ob der User eingeloggt ist.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['rolle'] = $rolle;

        if($rolle == 'user'){
            header('Location: ../php/user_inhalt.php');
        }
        if($rolle == 'admin'){
            header('Location: ../php/admin_inhalt.php');
        }
        } else {
            // normalerweise würde ich nicht angeben, welche der beiden Daten (Username oder password) inkorrekt ist - 
            // sondern nur, dass die Kombination aus Username & password falsch ist. zu Test-Zwecken aber nun so :)
            echo 'falsches Passwort!';
            header('refresh: 2; ../html/login_form.html');
        }
    } else {
            echo 'falscher Benutzername!';
            header('refresh: 2; ../html/login_form.html');
        }

    $stmt->close();
}

if($stmt2 = $con->prepare('SELECT id, password, rolle FROM logindaten WHERE email = ?')){
    $stmt2->bind_param('s', $_POST['username']);
    $stmt2->execute();
    $stmt2->store_result();

    if($stmt2->num_rows > 0){
        $stmt2->bind_result($id, $password, $rolle);
        $stmt2->fetch();
        // Account mit der eingegebenen E-Mail existiert, Passwort wird überprüft
        if(password_verify($_POST['password'], $password)){
            // Authentifizierung abgeschlossen - User wird nun eingeloggt!
            // Sessions zum überprüfen, ob der User eingeloggt ist.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['rolle'] = $rolle;

        if($rolle == 'user'){
            header('Location: ../php/user_inhalt.php');
        }
        if($rolle == 'admin'){
            header('Location: ../php/admin_inhalt.php');
        }
        else {
            echo 'falscher Benutzername!';
            header('refresh: 2; ../html/login_form.html');
        }
        } else {
            echo 'falsches Passwort!';
            header('refresh: 2; ../html/login_form.html');
        }
    }
        
    $stmt2->close();
}



?>