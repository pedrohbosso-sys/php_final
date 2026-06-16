<?php

require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../campeonatos/campeonatos.php");
    exit;
}

// Verifica se o ID enviado é válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../campeonatos/campeonatos.php");
    exit;
}

$campeonato_id = (int) $_GET['id'];

// Busca dados do campeonato
$stmt = $pdo->prepare("
    SELECT *
    FROM campeonatos
    WHERE id = :id
");
$stmt->execute([':id' => $campeonato_id]);
$campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campeonato) {
    header("Location: ../campeonatos/campeonatos.php");
    exit;
}

// Busca inscritos do campeonato com dados do usuário
$stmt = $pdo->prepare("
    SELECT u.id, u.nome, u.email
    FROM inscricoes i
    JOIN usuarios u ON i.usuario_id = u.id
    WHERE i.campeonato_id = :campeonato_id
    ORDER BY u.nome ASC
");
$stmt->execute([':campeonato_id' => $campeonato_id]);
$inscritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inscritos - <?= htmlspecialchars($campeonato['nome']) ?> - ProLeague</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container-wide">

    <h2>Inscritos no Campeonato</h2>

    <div class="info-campeonato">
        <p>
            <strong>Campeonato:</strong>
            <?= htmlspecialchars($campeonato['nome']) ?>
        </p>
        <p>
            <strong>Jogo:</strong>
            <?= htmlspecialchars($campeonato['jogo']) ?>
        </p>
        <p>
            <strong>Data:</strong>
            <?= date('d/m/Y', strtotime($campeonato['data_campeonato'])) ?>
        </p>
        <p>
            <strong>Status:</strong>
            <span class="status <?= $campeonato['status'] ?>">
                <?= ucfirst($campeonato['status']) ?>
            </span>
        </p>
        <p>
            <strong>Total de inscritos:</strong>
            <?= count($inscritos) ?>
        </p>
    </div>

    <!-- Exibe mensagem quando não há inscritos ou a lista de inscritos -->
    <!-- Exibe mensagem quando não há inscritos e tabela quando há registros -->
    <?php if (empty($inscritos)): ?>

        <p>Nenhum usuário inscrito neste campeonato ainda.</p>

    <?php else: ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscritos as $i => $u): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($u['nome']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <br>
    <a href="../campeonatos/campeonatos.php">← Voltar para Campeonatos</a>

</div>
<!-- pega o footer -->
<?php require_once '../includes/footer.php'; ?>

</body>
</html>