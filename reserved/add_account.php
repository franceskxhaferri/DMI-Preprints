<?php

//inserimento di un nuovo account(registrazione nuovo utente)
include '../header.inc.php';
include '../mysql/db_conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['mail']) && isset($_POST['username']) && isset($_POST['password'])) {
	$email = $_POST['mail'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	//generazione chiave hash password
	$hash = md5($password);;
	$sql = "INSERT INTO ACCOUNTS ( uid, email, password) VALUES ('" . $username . "','" . $email . "','" . $hash . "') ON DUPLICATE KEY UPDATE uid = VALUES(uid)";
	$query = mysqli_query($db_connection, $sql) or die(mysql_error());
	//chiusura connessione al database
	mysqli_close($db_connection);
	echo "Registrazione effettuata correttamente!";
}

?>
