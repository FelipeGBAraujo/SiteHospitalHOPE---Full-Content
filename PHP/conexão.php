<?php

$host = 'fdb1032.awardspace.net';
$port = '3306';
$dbname = '4488710_dbprojeto';
$username = '4488710_dbprojeto';
$password = '(7dCKU/76z2vjh!P';

try {
    $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h1>Erro de conexão: " . $e->getMessage() . "</h1>";
}

?>
