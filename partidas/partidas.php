<?php

session_start();
require_once '../includes/conexao.php';
require_once '../includes/header.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$isAdmin = isset($_SESSION['tipo']) && strtolower(trim($_SESSION['tipo'])) === 'admin';

$erro = "";
$sucesso = "";

/* BUSCA DADOS */
$times = $pdo->query("
    SELECT id, nome
    FROM times
")->fetchAll(PDO::FETCH_ASSOC);

$campeonatos = $pdo->query("
    SELECT id, nome, categoria
    FROM campeonatos
")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!$isAdmin) {
        die("Acesso negado.");
    }

    $campeonato_id = $_POST['campeonato_id'];
    $time1_id      = $_POST['time1_id'];
    $time2_id      = $_POST['time2_id'];
    $placar1       = $_POST['placar1'];
    $placar2       = $_POST['placar2'];

    if ($time1_id == $time2_id) {

        $erro = "Os dois times não podem ser iguais!";

    } else {

        $stmt = $pdo->prepare("
            INSERT INTO partidas
            (campeonato_id, time1_id, time2_id, placar1, placar2)
            VALUES
            (:campeonato_id, :time1_id, :time2_id, :placar1, :placar2)
        ");

        $stmt->execute([
            ':campeonato_id' => $campeonato_id,
            ':time1_id'      => $time1_id,
            ':time2_id'      => $time2_id,
            ':placar1'       => $placar1,
            ':placar2'       => $placar2
        ]);

        $sucesso = "Partida cadastrada com sucesso!";
    }
}

/* LISTA PARTIDAS */
$partidas = $pdo->query("
    SELECT p.id,
           t1.nome AS time1,
           t2.nome AS time2,
           p.placar1,
           p.placar2,
           c.nome AS campeonato,
           c.categoria
    FROM partidas p
    JOIN times t1 ON p.time1_id = t1.id
    JOIN times t2 ON p.time2_id = t2.id
    JOIN campeonatos c ON p.campeonato_id = c.id
")->fetchAll(PDO::FETCH_ASSOC);

?>

<main>
<div class="container-wide">

    <h2>Partidas</h2>

    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <p class="sucesso"><?= $sucesso ?></p>
    <?php endif; ?>

    <?php if ($isAdmin): ?>

    <form method="POST">

        <select name="campeonato_id" required>
            <option value="">Selecione o campeonato</option>

            <?php foreach ($campeonatos as $c): ?>
                <option value="<?= $c['id'] ?>">
                    <?= htmlspecialchars($c['nome']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <select name="time1_id" required>
            <option value="">Time 1</option>

            <?php foreach ($times as $t): ?>
                <option value="<?= $t['id'] ?>">
                    <?= htmlspecialchars($t['nome']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <input
            type="number"
            name="placar1"
            placeholder="Resultado Time 1"
            min="0"
            required
        >

        <select name="time2_id" required>
            <option value="">Time 2</option>

            <?php foreach ($times as $t): ?>
                <option value="<?= $t['id'] ?>">
                    <?= htmlspecialchars($t['nome']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <input
            type="number"
            name="placar2"
            placeholder="Resultado Time 2"
            min="0"
            required
        >

        <button type="submit">
            Cadastrar Partida
        </button>

    </form>

    <?php endif; ?>

    <h3>Partidas Cadastradas</h3>

        <!-- Tabela com as partidas registradas -->
        <thead>
            <tr>
                <th>Campeonato</th>
                <th>Time 1</th>
                <th>Resultado</th>
                <th>Time 2</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($partidas as $p): ?>

            <tr>

                <td>
                    <?= htmlspecialchars($p['campeonato']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($p['time1']) ?>
                </td>

                <td class="placar">

                    <?php if ($p['categoria'] === 'Battle Royale'): ?>

                        <?= $p['placar1'] ?> pts x <?= $p['placar2'] ?> pts

                    <?php else: ?>

                        <?= $p['placar1'] ?> x <?= $p['placar2'] ?>

                    <?php endif; ?>

                </td>

                <td>
                    <?= htmlspecialchars($p['time2']) ?>
                </td>

                <td class="acoes">

                    <?php if ($isAdmin): ?>

                        <a
                            href="editar_partida.php?id=<?= $p['id'] ?>"
                            class="btn-editar">
                            Editar
                        </a>

                        /

                        <a
                            href="excluir_partida.php?id=<?= $p['id'] ?>"
                            class="btn-excluir"
                            onclick="return confirm('Tem certeza que deseja excluir esta partida?')">
                            Excluir
                        </a>

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

<?php
require_once '../includes/footer.php';
?>