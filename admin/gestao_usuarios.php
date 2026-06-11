<?php

session_start();
require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (!isset($_SESSION['tipo']) || strtolower(trim($_SESSION['tipo'])) !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$sucesso = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['excluir'])) {
        $id = (int) $_POST['usuario_id'];
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $sucesso = "Usuário excluído com sucesso!";
    }

    if (isset($_POST['alterar_tipo'])) {
        $id   = (int) $_POST['usuario_id'];
        $tipo = $_POST['tipo'] === 'admin' ? 'admin' : 'usuario';
        $stmt = $pdo->prepare("UPDATE usuarios SET tipo = :tipo WHERE id = :id");
        $stmt->execute([':tipo' => $tipo, ':id' => $id]);
        $sucesso = "Tipo de usuário atualizado!";
    }
}

$usuarios = $pdo->query("SELECT id, nome, email, tipo FROM usuarios ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Usuários - ProLeague</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main>
    <div class="container-wide">

        <h2>Gestão de Usuários</h2>

        <?php if ($sucesso): ?>
            <p class="sucesso"><?= $sucesso ?></p>
        <?php endif; ?>

        <?php if ($erro): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Alterar Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <span style="color: <?= $u['tipo'] === 'admin' ? 'var(--primary)' : 'var(--text-muted)' ?>; font-weight: bold;">
                            <?= ucfirst($u['tipo']) ?>
                        </span>
                    </td>

                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="usuario_id" value="<?= $u['id'] ?>">
                            <select name="tipo">
                                <option value="usuario" <?= $u['tipo'] === 'usuario' ? 'selected' : '' ?>>Usuário</option>
                                <option value="admin"   <?= $u['tipo'] === 'admin'   ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <button type="submit" name="alterar_tipo" style="padding: 8px 14px; font-size: 13px; margin-left: 6px;">
                                Salvar
                            </button>
                        </form>
                    </td>

                    <td class="acoes">
                        <?php if ($u['id'] !== (int) $_SESSION['usuario_id']): ?>
                            <form method="POST" style="display:inline;"
                                  onsubmit="return confirm('Excluir <?= htmlspecialchars($u['nome']) ?>?')">
                                <input type="hidden" name="usuario_id" value="<?= $u['id'] ?>">
                                <button type="submit" name="excluir"
                                        style="padding: 8px 14px; font-size: 13px; background: var(--erro);">
                                    Excluir
                                </button>
                            </form>
                        <?php else: ?>
                            <span style="color: var(--text-muted); font-size: 13px;">Você</span>
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