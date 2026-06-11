<?php

session_start();
require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

/* busca inscrições do usuario logado */
$stmt = $pdo->prepare("
    SELECT c.id, c.nome, c.jogo, c.data_campeonato, c.status
    FROM inscricoes i
    JOIN campeonatos c ON i.campeonato_id = c.id
    WHERE i.usuario_id = :usuario_id
    ORDER BY c.data_campeonato DESC
");

$stmt->execute([':usuario_id' => $usuario_id]);
$inscricoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Inscrições - ProLeague</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container-wide">

    <h2>Minhas Inscrições</h2>

    <?php if (empty($inscricoes)): ?>
        <p>Você ainda não se inscreveu em nenhum campeonato.</p>
    <?php else: ?>

        <table>
            <thead>
                <tr>
                    <th>Campeonato</th>
                    <th>Jogo</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscricoes as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['nome']) ?></td>
                        <td><?= htmlspecialchars($c['jogo']) ?></td>
                        <td><?= date('d/m/Y', strtotime($c['data_campeonato'])) ?></td>
                        <td>
                            <span class="status <?= $c['status'] ?>">
                                <?= ucfirst($c['status']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <a href="../campeonatos/campeonatos.php">Voltar</a>

</div>

<?php require_once '../includes/footer.php'; ?>

</body>
</html>