<?php

//inserimento di un nuovo account(registrazione nuovo utente)
include '../header.inc.php';
include '../mysql/db_conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['mail']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $sname = $_POST['surname'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $name = trim($name);
    $name = ucwords($name);
    $sname = trim($sname);
    $sname = ucwords($sname);
    //generazione chiave hash password
    $hash = md5($password);
    $sql = "INSERT INTO ACCOUNTS ( nome, cognome, email, password) VALUES ('" . $name . "','" . $sname . "','" . $email . "','" . $hash . "') ON DUPLICATE KEY UPDATE email = VALUES(email)";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    //chiusura connessione al database
    mysqli_close($db_connection);
    echo "You have registered correctly!";
}
?>
