<?php 
require_once 'includes/header.php'; 
?>

<main>

    <!-- Seção principal de destaque da página inicial -->
    <section class="hero">

        <h1>
            Organize Campeonatos de eSports
        </h1>

        <p>Crie times, participe de torneios, acompanhe partidas e suba no ranking.</p>

        <a href="/campeonatos/campeonatos.php">Ver Campeonatos</a>

    </section>

    <!-- Card com links rápidos para as áreas principais do site -->
    <section class="cards">

        <div class="card">

            <h2>Campeonatos</h2>

            <p> Veja os torneios disponíveis e participe das competições.</p>

            <a href="/campeonatos/campeonatos.php">Acessar</a>

        </div>

        <div class="card">

            <h2>Times</h2>

            <p>Crie sua equipe e gerencie seus jogadores.</p>

            <a href="/times/times.php"> Acessar</a>

        </div>

        <div class="card">

            <h2>Partidas</h2>

            <p>Acompanhe resultados,confrontos e estatísticas.</p>

            <a href="/partidas/partidas.php"> Acessar</a>

        </div>

    </section>

</main>

<?php require_once 'includes/footer.php'; ?>