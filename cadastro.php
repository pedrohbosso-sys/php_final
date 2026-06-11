<?php
require_once 'includes/conexao.php';

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos!";
    } else {
        // verifica se o email já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() > 0) {
            $erro = "Este email já está cadastrado!";
        } else {
          
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            // insere o usuário no banco
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->execute([
                ':nome'  => $nome,
                ':email' => $email,
                ':senha' => $senhaCriptografada
            ]);

            $sucesso = "Cadastro realizado com sucesso!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - ProLeague</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Criar Conta</h2>

        <?php if ($erro): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <p class="sucesso"><?= $sucesso ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text"     name="nome"  placeholder="Seu nome"  required>
            <input type="email"    name="email" placeholder="Seu email" required>
            <input type="password" name="senha" placeholder="Sua senha" required>
            <button type="submit">Cadastrar</button>
        </form>

        <a href="index.php">Já tem conta? Entrar</a>
    </div>
</body>
</html>