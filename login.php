<?php
session_start();

require_once 'includes/conexao.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {

        $erro = "Preencha todos os campos!";

    } else {

        $stmt = $pdo->prepare("
            SELECT *
            FROM usuarios
            WHERE email = :email
        ");

        $stmt->execute([
            ':email' => $email
        ]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];
            

            header("Location: home.php");
            exit;

        } else {

            $erro = "Email ou senha inválidos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - ProLeague</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h2>Entrar</h2>

        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST">

            <input
                type="email"
                name="email"
                placeholder="Seu email"
                required
            >

            <input
                type="password"
                name="senha"
                placeholder="Sua senha"
                required
            >

            <button type="submit">
                Entrar
            </button>

        </form>

        <a href="cadastro.php">
            Não possui conta? Cadastrar
        </a>

    </div>

</body>
</html>