<?php
require_once '../includes/conexao.php';
require_once '../includes/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT *
    FROM times
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$time = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$time) {
    die("Time não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmtPartidas = $pdo->prepare("
        DELETE FROM partidas
        WHERE time1_id = :id OR time2_id = :id
    ");
    $stmtPartidas->execute([
        ':id' => $id
    ]);

    $stmtTime = $pdo->prepare("
        DELETE FROM times
        WHERE id = :id
    ");
    $stmtTime->execute([
        ':id' => $id
    ]);

    header("Location: times.php");
    exit;
}
?>

<main style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: calc(100vh - 310px); padding: 40px 0;">
    <div class="container" style="margin: 0 auto;">

        <h2>Excluir Time</h2>

        <p style="margin-bottom:20px;">
            Tem certeza que deseja excluir o time:
            <strong><?= htmlspecialchars($time['nome']) ?></strong>?
        </p>

        <form method="POST">
            <button type="submit" style="background: var(--erro);">
                Confirmar Exclusão
            </button>
        </form>

        <a href="times.php">
            Cancelar
        </a>

    </div>
</main>

<?php 
require_once '../includes/footer.php'; 
?>