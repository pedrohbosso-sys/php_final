<?php
require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM campeonatos WHERE id = :id");
$stmt->execute([':id' => $id]);

$campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campeonato) {
    die("Campeonato não encontrado.");
}

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $jogo = trim($_POST['jogo']);
    $data_campeonato = $_POST['data_campeonato'];
    $status = $_POST['status'];

    if (
        empty($nome) ||
        empty($jogo) ||
        empty($data_campeonato) ||
        empty($status)
    ) {
        $erro = "Preencha todos os campos!";
    } else {

        $stmt = $pdo->prepare("
            UPDATE campeonatos
            SET
                nome = :nome,
                jogo = :jogo,
                data_campeonato = :data_campeonato,
                status = :status
            WHERE id = :id
        ");

        $stmt->execute([
            ':nome' => $nome,
            ':jogo' => $jogo,
            ':data_campeonato' => $data_campeonato,
            ':status' => $status,
            ':id' => $id
        ]);

        header("Location: campeonatos.php");
        exit;
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Campeonato</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container-wide">


<h2>Editar Campeonato</h2>

<?php if ($erro): ?>
    <p class="erro"><?= $erro ?></p>
<?php endif; ?>

<form method="POST">

    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($campeonato['nome']) ?>"
        required
    >

    <input
        type="text"
        name="jogo"
        value="<?= htmlspecialchars($campeonato['jogo']) ?>"
        required
    >

    <input
        type="date"
        name="data_campeonato"
        value="<?= $campeonato['data_campeonato'] ?>"
        required
    >

    <select name="status" required>
        <option value="aberto" <?= $campeonato['status'] == 'aberto' ? 'selected' : '' ?>>
            Aberto
        </option>

        <option value="em andamento" <?= $campeonato['status'] == 'em andamento' ? 'selected' : '' ?>>
            Em andamento
        </option>

        <option value="encerrado" <?= $campeonato['status'] == 'encerrado' ? 'selected' : '' ?>>
            Encerrado
        </option>
    </select>

    <button type="submit">
        Salvar Alterações
    </button>

</form>


</div>

<?php require_once '../includes/footer.php'; ?>

</body>
</html>
