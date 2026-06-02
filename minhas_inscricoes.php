<?php

session_start();
require_once 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: campeonatos.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campeonato_id = (int) $_GET['id'];

/* verifica duplicado */
$stmt = $pdo->prepare("
    SELECT id 
    FROM inscricoes 
    WHERE usuario_id = :usuario_id 
    AND campeonato_id = :campeonato_id
");

$stmt->execute([
    ':usuario_id' => $usuario_id,
    ':campeonato_id' => $campeonato_id
]);

if (!$stmt->fetch()) {

    $insert = $pdo->prepare("
        INSERT INTO inscricoes (usuario_id, campeonato_id)
        VALUES (:usuario_id, :campeonato_id)
    ");

    $insert->execute([
        ':usuario_id' => $usuario_id,
        ':campeonato_id' => $campeonato_id
    ]);
}

header("Location: minhas_inscricoes.php");
exit;