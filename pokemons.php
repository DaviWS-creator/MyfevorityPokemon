<?php
//Exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");
require_once("util/functions.php");

$conexao = Conexao::getConexao();

//Listagem dos pokemons
$sql = "SELECT * FROM pokemon";
$stm = $conexao->prepare($sql);
$stm->execute();
$pokemons = $stm->fetchAll();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyFavoritePokemon</title>
    <link rel="icon" type="image/svg+xml" href="img/pokeball_heart_favicon.svg">
    <link rel="stylesheet" href="sytle/style.css">
    <link rel="stylesheet" href="sytle/card-style.css">
</head>

<body>
    <div class="container">

        <?php require 'includes/header.php'; ?>
        <main>
            <!-- Listagem dos pokemons -->
            <h2 style="font-size: 40px; color: #7a4a1a; margin: 20px auto 0px auto; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">Pokemons Cadastrados</h2>
            <div class="row cards-pokemons">

                <!-- Cards de apresentação dos pokemons -->
                <?php if (! empty($pokemons)) : ?>

                    <?php foreach ($pokemons as $pokemon) : ?>

                        <div class="col-2 card-pokemon">

                            <div class="poke-card-img">
                                <img src="<?= $pokemon['urlImg'] ?>" alt="<?= $pokemon['nome'] ?> " width="200px">
                            </div>


                            <div class="poke-card-body">
                                <p class="poke-nome"><strong><?= $pokemon['nome'] ?></strong><br></p>
                                <p class="poke-desc">Descrição: <?= $pokemon['descricao'] ?><br></p>

                                <div class="poke-tipos">
                                    <?php foreach (json_decode($pokemon['tipo']) as $tipo): ?>
                                        <span class="tipo tipo-<?= strtolower(removerAcentos($tipo)) ?>">
                                            <?= ucfirst(trim($tipo)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                            <div class="poke-card-footer">
                                <a href="pokemon_excluir.php?id=<?= $pokemon['id'] ?>"
                                    class="btn-excluir"
                                    onclick="return confirm('Deseja realmente excluir este pokemon?')">
                                    🗑️ Excluir
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>


            </div>
        <?php else : ?>
            <p>Nenhum Pokemon cadastrado ainda.</p>
        <?php endif; ?>
        </main>
    </div>

    <?php require 'includes/footer.php'; ?>
</body>