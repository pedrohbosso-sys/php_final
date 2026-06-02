<?php

$host = "localhost";
$dbname = "proleague";
$user = "postgres";  
$pass = "postgres"; 

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erro ao conectar com o banco: " . $e->getMessage());
}
?> 