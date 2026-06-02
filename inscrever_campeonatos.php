<?php

require_once 'includes/conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$campeonato_id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("
    SELECT *
    FROM campeonatos
    WHERE id = :id
");

$stmt->execute([
    ':id' => $campeonato_id
]);

$campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campeonato) {
    die("Campeonato não encontrado.");
}

// verifica se já está inscrito
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

$inscricao = $stmt->fetch();

if (!$inscricao) {

    $stmt = $pdo->prepare("
        INSERT INTO inscricoes
        (usuario_id, campeonato_id)
        VALUES
        (:usuario_id, :campeonato_id)
    ");

    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':campeonato_id' => $campeonato_id
    ]);
}

header("Location: minhas_inscricoes.php");
exit;