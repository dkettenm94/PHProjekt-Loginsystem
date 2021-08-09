<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phprojekt';

mysqli_report(MYSQLI_REPORT_ERROR); 
error_reporting(-1);

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Fehler bei der Verbindung zu MySQL: ' . mysqli_connect_error());
}

if(!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['vorname'], $_POST['gebdatum'], $_POST['strasse'], $_POST['hausnummer'], $_POST['plz'], $_POST['ort'] )){
    die ('irgendein Input hat einen falschen Namen :)');
}

if(empty($_POST['username'] && $_POST['password'] && $_POST['email'] && $_POST['vorname'] && $_POST['name'] && $_POST['gebdatum']  && $_POST['strasse'] && $_POST['hausnummer'] && $_POST['plz'] && $_POST['ort'])) {
    die ('Bitte füllen Sie alle Felder aus.');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	die ('Das Passwort muss mindestens 5 Zeichen lang sein und darf die Länge von 20 Zeichen nicht überschreiten!');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Das Format der angegebenen E-Mail-Adresse ist ungültig!');
}

// Überprüfen, ob ein Account mit eingegebenem Benutzernamen oder E-Mail bereits existiert.
if ($stmt = $con->prepare('SELECT id, password FROM logindaten WHERE email = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt2 = $con->prepare('SELECT id, password FROM logindaten WHERE username = ?')) {
	$stmt2->bind_param('s', $_POST['username']);
	$stmt2->execute();
	$stmt2->store_result();
	// Ergebnis speichern, damit wir es überprüfen können.
	} if ($stmt2->num_rows > 0) {
		// Benutzername schon in Datenbank vorhanden.
		echo 'Benutzername existiert bereits, bitte wählen Sie einen anderen.';
		header('refresh: 2; ../html/user_register_form.html');
	} else if ($stmt->num_rows > 0) {
		// E-Mail schon in Datenbank vorhanden.
		echo 'E-Mail existiert bereits, bitte wählen Sie eine andere.';
		header('refresh: 2; ../html/user_register_form.html');
	} else {
		// Username und E-Mail sind noch nicht vorhanden -> Daten können in die Datenbank eingetragen werden.
        if ($stmt = $con->prepare('INSERT INTO logindaten (username, password, email, rolle) VALUES (?, ?, ?, ?)')) {
	        // Passwort verschlüsseln
	        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	        $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $_POST['rolle']);
			$stmt->execute();
			echo 'Daten in Tabelle logindaten gespeichert <br>';

			$stmt2 = $con->prepare('INSERT INTO userdaten (id, name, vorname, gebdatum, email, strasse, hnr, plz, ort) VALUES (LAST_INSERT_ID(), ?, ?, ?, ?, ?, ?, ?, ?)');
			$stmt2->bind_param('ssssssss', $_POST['name'], $_POST['vorname'], $_POST['gebdatum'], $_POST['email'], $_POST['strasse'], $_POST['hausnummer'], $_POST['plz'], $_POST['ort']);
			$stmt2->execute();
			echo 'Daten in Tabelle userDaten gespeichert';
			header('refresh: 2; ../html/login_form.html');
	
    } else {
		echo 'irgendwas am SQL-Statement ist falsch :)';
		header('refresh: 2; ../html/user_register_form.html');
}
	}
	$stmt->close();
	$stmt2->close();
}

$con->close();
?>

