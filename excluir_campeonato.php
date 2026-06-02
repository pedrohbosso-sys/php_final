<?php
require_once 'includes/conexao.php';
require_once 'includes/header.php';

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

    $stmtInscricoes = $pdo->prepare("
        DELETE FROM inscricoes
        WHERE campeonato_id = :id
    ");
    
    $stmtInscricoes->execute([
        ':id' => $id
    ]);

    $stmtCampeonato = $pdo->prepare("
        DELETE FROM campeonatos
        WHERE id = :id
    ");

    $stmtCampeonato->execute([
        ':id' => $id
    ]);

    header("Location: campeonatos.php");
    exit;
}
?>

<main style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: calc(100vh - 310px); padding: 40px 0;">
    <div class="container" style="margin: 0 auto;">

        <h2>Excluir Campeonato</h2>

        <p style="margin-bottom:20px;">
            Tem certeza que deseja excluir o campeonato:
            <strong><?= htmlspecialchars($campeonato['nome']) ?></strong>?
        </p>

        <form method="POST">
            <button type="submit" style="background: var(--erro);">
                Confirmar Exclusão
            </button>
        </form>

        <a href="campeonatos.php">
            Cancelar
        </a>

    </div>
</main>

<?php 
require_once 'includes/footer.php'; 
?>