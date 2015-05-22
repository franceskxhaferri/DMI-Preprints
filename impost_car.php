<?php

$ini_array = parse_ini_file("/etc/dmipreprints/set.ini");

//mysql
global $hostname_db;
global $db_monte; //nome del database
global $username_db; //l'username
global $password_db; // password

$hostname_db = "localhost";
$db_monte = "dmipreprints"; //nome del database
$username_db = "root"; //l'username
$password_db = "1234";

//percorsi cartelle
global $copia;
global $basedir;
global $basedir2;
global $basedir3;

$copia = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints' . "/pdf/";
$basedir = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints' . "/upload_dmi/";
$basedir2 = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints' . "/upload/";
$basedir3 = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints' . "/pdf_downloads/";

//ldap
$ldaphost = $ini_array['ldap_host'];
$ldapport = $ini_array['ldap_port'];

//RADIUS
$ip_radius_server = $ini_array['radius_ip'];
$shared_secret = $ini_array['radius_secret'];

//mod uid
$mod_uid = $ini_array['uidMod'];

?>
