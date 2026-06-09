<?php

require_once 'includes/conexao.php';
require_once 'includes/header.php';

$erro = "";
$sucesso = "";

// Busca campeonatos
$campeonatos = $pdo->query("
    SELECT *
    FROM campeonatos
    ORDER BY data_campeonato DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Busca inscrições do usuário
$inscricoesUsuario = [];

if (
    isset($_SESSION['usuario_id']) &&
    (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin')
) {

    $stmt = $pdo->prepare("
        SELECT campeonato_id
        FROM inscricoes
        WHERE usuario_id = :usuario_id
    ");

    $stmt->execute([
        ':usuario_id' => $_SESSION['usuario_id']
    ]);

    $inscricoesUsuario = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Apenas admin cria campeonato
if (
    isset($_SESSION['tipo']) &&
    $_SESSION['tipo'] === 'admin' &&
    $_SERVER['REQUEST_METHOD'] == 'POST'
) {

    $nome            = trim($_POST['nome']);
    $jogo            = trim($_POST['jogo']);
    $data_campeonato = $_POST['data_campeonato'];
    $status          = $_POST['status'];

    if (
        empty($nome) ||
        empty($jogo) ||
        empty($data_campeonato) ||
        empty($status)
    ) {

        $erro = "Preencha todos os campos!";

    } else {

        $stmt = $pdo->prepare("
            INSERT INTO campeonatos
            (nome, jogo, data_campeonato, status)
            VALUES
            (:nome, :jogo, :data_campeonato, :status)
        ");

        $stmt->execute([
            ':nome'            => $nome,
            ':jogo'            => $jogo,
            ':data_campeonato' => $data_campeonato,
            ':status'          => $status
        ]);

        $sucesso = "Campeonato cadastrado com sucesso!";

        $campeonatos = $pdo->query("
            SELECT *
            FROM campeonatos
            ORDER BY data_campeonato DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Campeonatos - ProLeague</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-wide">

    <h2>Campeonatos</h2>

    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <p class="sucesso"><?= $sucesso ?></p>
    <?php endif; ?>

    <?php if (
        isset($_SESSION['tipo']) &&
        $_SESSION['tipo'] === 'admin'
    ): ?>

        <form method="POST">

            <input
                type="text"
                name="nome"
                placeholder="Nome do campeonato"
                required
            >

            <input
                type="text"
                name="jogo"
                placeholder="Jogo"
                required
            >

            <input
                type="date"
                name="data_campeonato"
                required
            >

            <select name="status" required>
                <option value="">Selecione o status</option>
                <option value="aberto">Aberto</option>
                <option value="em andamento">Em andamento</option>
                <option value="encerrado">Encerrado</option>
            </select>

            <button type="submit">
                Criar Campeonato
            </button>

        </form>

    <?php endif; ?>

    <h3>Campeonatos Cadastrados</h3>

    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Jogo</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($campeonatos as $c): ?>

            <tr>

                <td>
                    <?= htmlspecialchars($c['nome']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($c['jogo']) ?>
                </td>

                <td>
                    <?= date('d/m/Y', strtotime($c['data_campeonato'])) ?>
                </td>

                <td>
                    <span class="status <?= $c['status'] ?>">
                        <?= ucfirst($c['status']) ?>
                    </span>
                </td>

                <td class="acoes">

                    <?php if (
                        isset($_SESSION['tipo']) &&
                        $_SESSION['tipo'] === 'admin'
                    ): ?>

                        <a
                            href="editar_campeonato.php?id=<?= $c['id'] ?>"
                            class="btn-editar">
                            Editar
                        </a>
                        /
                        <a
                            href="excluir_campeonato.php?id=<?= $c['id'] ?>"
                            class="btn-excluir"
                            onclick="return confirm('Deseja excluir este campeonato?')">
                            Excluir
                        </a>
                        /
                        <a
                            href="admin_inscritos.php?id=<?= $c['id'] ?>"
                            class="btn-inscritos">
                            Ver Inscritos
                        </a>

                    <?php else: ?>

                        <?php if (in_array($c['id'], $inscricoesUsuario)): ?>

                            <span class="sucesso">
                                Inscrito
                            </span>

                        <?php else: ?>

                            <a
                                href="inscrever_campeonato.php?id=<?= $c['id'] ?>"
                                class="btn-editar"
                                onclick="return confirm('Deseja se inscrever neste campeonato?')">
                                Inscrever-se
                            </a>

                        <?php endif; ?>

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php require_once 'includes/footer.php'; ?>

</body>
</html>