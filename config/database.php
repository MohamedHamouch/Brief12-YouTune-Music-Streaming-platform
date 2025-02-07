<?php


$host = 'localhost';
$user = 'postgres';
$pass = '0000';
$dbName = 'youtune';

$dsn = "pgsql:host=$host;port=5432;dbname=$dbName";

try {

    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (Exception $err) {
    echo "Connection error :" . $err->getMessage();
}

?>