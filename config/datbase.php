<?php


$host = 'localhost';
$user = 'postgres';
$pass = '0000';
$dbName = 'youtune';

$dsn = "pgsql:host:$host;port=5432;dbname=$dbName;charset=utf8";

try {

    $PDOConn = new PDO($dsn, $user, $pass);
    $PDOConn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $err) {
    echo "Connection error :" . $err->getMessage();
}

?>