<?php
require_once 'includes/conexao.php';
require_once 'includes/header.php';

session_start();

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

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $jogo = trim($_POST['jogo']);
    $descricao = trim($_POST['descricao']);

    if (empty($nome) || empty($jogo) || empty($descricao)) {

        $erro = "Preencha todos os campos!";

    } else {

        $stmt = $pdo->prepare("
            UPDATE times
            SET
                nome = :nome,
                jogo = :jogo,
                descricao = :descricao
            WHERE id = :id
        ");

        $stmt->execute([
            ':nome' => $nome,
            ':jogo' => $jogo,
            ':descricao' => $descricao,
            ':id' => $id
        ]);

        $sucesso = "Time atualizado com sucesso!";

        $stmt = $pdo->prepare("
            SELECT *
            FROM times
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $time = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Time</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">


<h2>Editar Time</h2>

<?php if ($erro): ?>
    <p class="erro"><?= $erro ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p class="sucesso"><?= $sucesso ?></p>
<?php endif; ?>

<form method="POST">

    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($time['nome']) ?>"
        required
    >

    <input
        type="text"
        name="jogo"
        value="<?= htmlspecialchars($time['jogo']) ?>"
        required
    >

    <textarea
        name="descricao"
        required><?= htmlspecialchars($time['descricao']) ?></textarea>

    <button type="submit">
        Salvar Alterações
    </button>

</form>

<a href="times.php">
    Voltar
</a>


</div>

<?php require_once 'includes/footer.php'; ?>

</body>
</html>
<?php