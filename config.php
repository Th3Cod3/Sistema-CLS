<?php
$dbHost = 'localhost';
$dbName = 'armacls_ipb';
$dbUser = 'ygonzalez';
$dbPass = 'KjROz5FCfl5CGTo3';


// $dbHost = 'server.armacls.com';
// $dbName = 'cls';
// $dbUser = 'root';
// $dbPass = '';
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}	