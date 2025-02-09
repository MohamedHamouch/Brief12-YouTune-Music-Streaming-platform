<?php

$env = parse_ini_file(__DIR__ . '/.env');

if (!$env) {
    die("Error: Unable to load environment variables.");
}

$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASSWORD'];
$dbName = $env['DB_NAME'];
$port = $env['DB_PORT'];

$dsn = "pgsql:host=$host;port=$port;dbname=$dbName";

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (Exception $err) {
    echo "Connection error: " . $err->getMessage();
}

?>