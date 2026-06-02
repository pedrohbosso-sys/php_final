<?php
require_once 'includes/conexao.php';
require_once 'includes/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT p.id, t1.nome AS time1, t2.nome AS time2, c.nome AS campeonato
    FROM partidas p
    JOIN times t1 ON p.time1_id = t1.id
    JOIN times t2 ON p.time2_id = t2.id
    JOIN campeonatos c ON p.campeonato_id = c.id
    WHERE p.id = :id
");

$stmt->execute([
    ':id' => $id
]);

$partida = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$partida) {
    die("Partida não encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        DELETE FROM partidas
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    header("Location: partidas.php");
    exit;
}
?>

<main style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: calc(100vh - 310px); padding: 40px 0;">
    <div class="container" style="margin: 0 auto;">

        <h2>Excluir Partida</h2>

        <p style="margin-bottom:20px;">
            Tem certeza que deseja excluir a partida do campeonato <strong><?= htmlspecialchars($partida['campeonato']) ?></strong> entre:<br>
            <strong><?= htmlspecialchars($partida['time1']) ?> x <?= htmlspecialchars($partida['time2']) ?></strong>?
        </p>

        <form method="POST">
            <button type="submit" style="background: var(--erro);">
                Confirmar Exclusão
            </button>
        </form>

        <a href="partidas.php">
            Cancelar
        </a>

    </div>
</main>

<?php 
require_once 'includes/footer.php'; 
?>