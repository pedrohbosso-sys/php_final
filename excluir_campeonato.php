<?php
require_once 'includes/conexao.php';
require_once 'includes/header.php';

session_start();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT *
    FROM campeonatos
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campeonato) {
    die("Campeonato não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        DELETE FROM campeonatos
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    header("Location: campeonatos.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Campeonato</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">


<h2>Excluir Campeonato</h2>

<p style="margin-bottom:20px;">
    Tem certeza que deseja excluir o campeonato:
    <strong><?= htmlspecialchars($campeonato['nome']) ?></strong>?
</p>

<form method="POST">

    <button
        type="submit"
        style="background:#e74c3c;">
        Confirmar Exclusão
    </button>

</form>

<a href="campeonatos.php">
    Cancelar
</a>


</div>



</body>
</html>
