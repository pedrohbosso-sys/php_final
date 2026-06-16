<?php

session_start();
require_once '../includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campeonato_id = $_GET['id'];

// Verifica se o usuário já está inscrito neste campeonato
$stmt = $pdo->prepare("
    SELECT id FROM inscricoes
    WHERE usuario_id = :usuario_id
    AND campeonato_id = :campeonato_id
");

$stmt->execute([
    ':usuario_id' => $usuario_id,
    ':campeonato_id' => $campeonato_id
]);

if (!$stmt->fetch()) {

    // Registra a inscrição somente se ainda não existir
    $insert = $pdo->prepare("\
        INSERT INTO inscricoes (usuario_id, campeonato_id)
        VALUES (:usuario_id, :campeonato_id)
    ");

    $insert->execute([
        ':usuario_id' => $usuario_id,
        ':campeonato_id' => $campeonato_id
    ]);
}

// Após inscrição, redireciona para a página de minhas inscrições
header("Location: ../usuario/minhas_inscricoes.php");
exit;