<?php

session_start();
require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Busca dados do usuário
$stmt = $pdo->prepare("
    SELECT id, nome, email, tipo, foto_perfil, data_cadastro
    FROM usuarios
    WHERE id = :id
");
$stmt->execute([':id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: ../index.php");
    exit;
}

// Processa upload de foto de perfil
$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])) {
    $arquivo = $_FILES['foto_perfil'];
    
    // Validações
    $permitidas = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
    if (!in_array($arquivo['type'], $permitidas)) {
        $erro = "Formato de imagem inválido. Use JPG, PNG, GIF ou WebP.";
    } elseif ($arquivo['size'] > 5 * 1024 * 1024) {
        $erro = "Arquivo muito grande. Máximo 5MB.";
    } else {
        // Cria pasta se não existir
        $pasta_uploads = '../uploads/perfil/';
        if (!is_dir($pasta_uploads)) {
            mkdir($pasta_uploads, 0755, true);
        }
        
        // Gera nome único para arquivo
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nome_arquivo = 'perfil_' . $usuario_id . '_' . time() . '.' . $extensao;
        $caminho_arquivo = $pasta_uploads . $nome_arquivo;
        
        if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
            // Atualiza banco de dados
            $stmt = $pdo->prepare("
                UPDATE usuarios
                SET foto_perfil = :foto_perfil
                WHERE id = :id
            ");
            $stmt->execute([
                ':foto_perfil' => $nome_arquivo,
                ':id' => $usuario_id
            ]);
            
            $sucesso = "Foto de perfil atualizada com sucesso!";
            $usuario['foto_perfil'] = $nome_arquivo;
        } else {
            $erro = "Erro ao fazer upload da foto. Tente novamente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - ProLeague</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .perfil-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .perfil-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            text-align: center;
        }

        .foto-perfil {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin-bottom: 15px;
            border: 3px solid var(--secondary);
            object-fit: cover;
        }

        .perfil-header h1 {
            margin: 10px 0 5px 0;
            color: var(--text);
        }

        .perfil-tipo {
            display: inline-block;
            padding: 5px 15px;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
        }

        .perfil-info {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 12px;
            font-weight: bold;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-valor {
            font-size: 16px;
            color: var(--text);
        }

        .upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: rgba(var(--primary-rgb), 0.05);
        }

        .upload-area input[type="file"] {
            display: none;
        }

        .upload-area label {
            cursor: pointer;
            display: block;
        }

        .upload-area p {
            margin: 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        .btn-voltar {
            display: inline-block;
            padding: 10px 20px;
            background: var(--secondary);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-voltar:hover {
            background: var(--primary);
        }

        .mensagem {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .erro {
            background: rgba(255, 0, 0, 0.1);
            color: var(--erro);
            border: 1px solid var(--erro);
        }

        .sucesso {
            background: rgba(0, 255, 0, 0.1);
            color: #00cc00;
            border: 1px solid #00cc00;
        }
    </style>
</head>
<body>

<main>
    <div class="perfil-container">

        <div class="perfil-header">
            <?php if ($usuario['foto_perfil']): ?>
                <img 
                    src="../uploads/perfil/<?= htmlspecialchars($usuario['foto_perfil']) ?>" 
                    alt="Foto de perfil"
                    class="foto-perfil"
                >
            <?php else: ?>
                <div class="foto-perfil">
                    👤
                </div>
            <?php endif; ?>

            <h1><?= htmlspecialchars($usuario['nome']) ?></h1>
            <span class="perfil-tipo"><?= strtoupper($usuario['tipo']) ?></span>
        </div>

        <?php if ($erro): ?>
            <div class="mensagem erro">
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <div class="mensagem sucesso">
                <?= $sucesso ?>
            </div>
        <?php endif; ?>

        <div class="upload-area">
            <form method="POST" enctype="multipart/form-data" style="margin: 0;">
                <label for="foto_input">
                    <p>📸 Clique para atualizar sua foto de perfil</p>
                    <p style="font-size: 12px; margin-top: 5px; color: var(--text-muted);">JPG, PNG, GIF ou WebP (máx. 5MB)</p>
                </label>
                <input 
                    type="file" 
                    id="foto_input"
                    name="foto_perfil" 
                    accept="image/jpeg,image/png,image/gif,image/webp"
                    onchange="this.form.submit()"
                >
            </form>
        </div>

        <div class="perfil-info">
            <div class="info-item">
                <div class="info-label">📧 Email</div>
                <div class="info-valor"><?= htmlspecialchars($usuario['email']) ?></div>
            </div>

            <div class="info-item">
                <div class="info-label">👤 Tipo de Conta</div>
                <div class="info-valor">
                    <?php 
                        $tipo_label = [
                            'admin' => 'Administrador',
                            'usuario' => 'Jogador'
                        ];
                        echo htmlspecialchars($tipo_label[$usuario['tipo']] ?? ucfirst($usuario['tipo']));
                    ?>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">📅 Data de Cadastro</div>
                <div class="info-valor">
                    <?= date('d/m/Y', strtotime($usuario['data_cadastro'])) ?>
                </div>
            </div>
        </div>

        <a href="/home.php" class="btn-voltar">← Voltar</a>

    </div>
</main>

<?php require_once '../includes/footer.php'; ?>

</body>
</html>
