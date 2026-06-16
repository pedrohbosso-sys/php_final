<?php

session_start();
require_once '../includes/conexao.php';
require_once '../includes/header.php';

$erro = "";

// Verifica se o usuário logado é admin
$isAdmin = isset($_SESSION['tipo']) && strtolower(trim($_SESSION['tipo'])) === 'admin';
$usuario_id_logado = $_SESSION['usuario_id'] ?? null;

// Busca todos os times cadastrados com o nome do dono
$times = $pdo->query("
    SELECT t.id, t.nome, t.jogo, t.descricao, t.usuario_id, u.nome AS dono
    FROM times t
    JOIN usuarios u ON t.usuario_id = u.id
")->fetchAll(PDO::FETCH_ASSOC);

// Processa criação de time quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../index.php");
        exit;
    }

    $nome       = trim($_POST['nome']);
    $jogo       = trim($_POST['jogo']);
    $descricao  = trim($_POST['descricao']);
    $usuario_id = $_SESSION['usuario_id'];

    if (empty($nome) || empty($jogo) || empty($descricao)) {
        $erro = "Preencha todos os campos!";
    } else {

        $stmt = $pdo->prepare("
            INSERT INTO times (nome, jogo, descricao, usuario_id)
            VALUES (:nome, :jogo, :descricao, :usuario_id)
        ");

        $stmt->execute([
            ':nome'       => $nome,
            ':jogo'       => $jogo,
            ':descricao'  => $descricao,
            ':usuario_id' => $usuario_id
        ]);

        header("Location: times.php?sucesso=1");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Times - ProLeague</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main>
    <div class="container-wide">

        <h2>Times</h2>

        <!-- Exibe erro ao criar time ou mensagem de sucesso quando criado -->
        <?php if ($erro): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['sucesso'])): ?>
            <p class="sucesso">Time cadastrado com sucesso!</p>
        <?php endif; ?>

        <!-- Formulário para criar time, visível apenas para usuário logado -->
        <?php if ($usuario_id_logado): ?>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome do time" required>
            <input type="text" name="jogo" placeholder="Jogo" required>
            <textarea name="descricao" placeholder="Descrição do time" required></textarea>
            <button type="submit">Criar Time</button>
        </form>
        <?php endif; ?>

        <h3>Times Cadastrados</h3>

        <!-- Lista os times existentes e mostra botões de ação apenas para admin -->
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Jogo</th>
                    <th>Descrição</th>
                    <th>Dono</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($times as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['nome']) ?></td>
                    <td><?= htmlspecialchars($t['jogo']) ?></td>
                    <td><?= htmlspecialchars($t['descricao']) ?></td>
                    <td><?= htmlspecialchars($t['dono']) ?></td>
                    <td class="acoes">
                        <?php if ($isAdmin): ?>
                            <a href="editar_time.php?id=<?= $t['id'] ?>" class="btn-editar">Editar</a> /
                            <a href="excluir_time.php?id=<?= $t['id'] ?>" class="btn-excluir"
                               onclick="return confirm('Tem certeza que deseja excluir este time?')">Excluir</a>
                        <?php else: ?>
                            <span>Somente visualização</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</main>

<?php require_once '../includes/footer.php'; ?>

</body>
</html>