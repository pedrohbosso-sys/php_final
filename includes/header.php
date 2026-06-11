<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProLeague</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<header>

    <div style="display:flex; align-items:center; gap:15px;">

        <?php if (isset($_SESSION['tipo'])): ?>
            <span style="
                color: var(--secondary);
                font-weight: bold;
                font-size: 14px;
            ">
                <?= strtoupper($_SESSION['tipo']) ?>
            </span>
        <?php endif; ?>

        <div class="logo-area">
            <a href="/home.php">
                <img
                    src="/img/logo.png"
                    alt="Logo"
                    class="logo-img"
                    id="siteLogo">
            </a>
        </div>

    </div>

    <nav>
        <ul>

            <li>
                <a href="/home.php">Início</a>
            </li>

            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>

                <li>
                    <a href="/campeonatos/campeonatos.php">Campeonatos</a>
                </li>

                <li>
                    <a href="/times/times.php">Times</a>
                </li>

                <li>
                    <a href="/partidas/partidas.php">Partidas</a>
                </li>

                <li>
                    <a href="/admin/gestao_usuarios.php">Usuários</a>
                </li>

            <?php else: ?>

                <li>
                    <a href="/times/times.php">Meu Time</a>
                </li>

                <li>
                    <a href="/campeonatos/campeonatos.php">Campeonatos</a>
                </li>

                <li>
                    <a href="/partidas/partidas.php">Partidas</a>
                </li>

                <li>
                    <a href="/usuario/minhas_inscricoes.php">Minhas Inscrições</a>
                </li>

            <?php endif; ?>

            <?php if (isset($_SESSION['usuario_id'])): ?>

                <li>
                    <a href="/logout.php">Sair</a>
                </li>

            <?php else: ?>

                <li>
                    <a href="/index.php">Login</a>
                </li>

                <li>
                    <a href="/cadastro.php">Cadastro</a>
                </li>

            <?php endif; ?>

            <li class="theme-toggle-item">
                <button
                    id="themeToggle"
                    class="theme-toggle"
                    aria-label="Alternar tema">

                    <span class="theme-icon theme-icon--dark">
                        🌙
                    </span>

                    <span class="theme-icon theme-icon--light">
                        ☀️
                    </span>

                </button>
            </li>

        </ul>
    </nav>

</header>

<script src="/js/script.js"></script>

</body>
</html>