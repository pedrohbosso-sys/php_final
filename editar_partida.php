<?php
require_once 'includes/conexao.php';
require_once 'includes/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT *
    FROM partidas
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$partida = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$partida) {
    die("Partida não encontrada.");
}

$campeonatos = $pdo->query("
    SELECT id, nome
    FROM campeonatos
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);

$times = $pdo->query("
    SELECT id, nome
    FROM times
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campeonato_id = $_POST['campeonato_id'];
    $time1_id      = $_POST['time1_id'];
    $time2_id      = $_POST['time2_id'];
    $placar1       = $_POST['placar1'];
    $placar2       = $_POST['placar2'];

    if ($time1_id == $time2_id) {

        $erro = "Os dois times não podem ser iguais.";

    } else {

        $stmt = $pdo->prepare("
            UPDATE partidas
            SET
                campeonato_id = :campeonato_id,
                time1_id = :time1_id,
                time2_id = :time2_id,
                placar1 = :placar1,
                placar2 = :placar2
            WHERE id = :id
        ");

        $stmt->execute([
            ':campeonato_id' => $campeonato_id,
            ':time1_id'      => $time1_id,
            ':time2_id'      => $time2_id,
            ':placar1'       => $placar1,
            ':placar2'       => $placar2,
            ':id'            => $id
        ]);

        $sucesso = "Partida atualizada com sucesso!";

        $stmt = $pdo->prepare("
            SELECT *
            FROM partidas
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $partida = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Partida</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-wide">


<h2>Editar Partida</h2>

<?php if ($erro): ?>
    <p class="erro"><?= $erro ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p class="sucesso"><?= $sucesso ?></p>
<?php endif; ?>

<form method="POST">

    <select name="campeonato_id" required>
        <?php foreach ($campeonatos as $c): ?>
            <option
                value="<?= $c['id'] ?>"
                <?= $c['id'] == $partida['campeonato_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="time1_id" required>
        <?php foreach ($times as $t): ?>
            <option
                value="<?= $t['id'] ?>"
                <?= $t['id'] == $partida['time1_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input
        type="number"
        name="placar1"
        min="0"
        value="<?= $partida['placar1'] ?>"
        required
    >

    <select name="time2_id" required>
        <?php foreach ($times as $t): ?>
            <option
                value="<?= $t['id'] ?>"
                <?= $t['id'] == $partida['time2_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input
        type="number"
        name="placar2"
        min="0"
        value="<?= $partida['placar2'] ?>"
        required
    >

    <button type="submit">
        Salvar Alterações
    </button>

</form>

<a href="partidas.php">
    Voltar
</a>


</div>

<?php require_once 'includes/footer.php'; ?>

</body>
</html>
