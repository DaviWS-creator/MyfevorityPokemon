<?php 

require_once(__DIR__ . "/../../controller/PokemonController.php");
$pokemonController = new PokemonController();
$pokemons = $pokemonController->listar();

//print_r($pokemons);

//Inclui o HEADER
include_once(__DIR__ . "/../includes/header.php");
?>

<h2>Listagem de Pokemons</h2>

<table border="1px">
    <tr>
        <th>id</th>
        <th>nome</th>
        <th>descricao</th>
        <th>url imagem</th>
        <th>tipo</th>
        <th>geracao</th>
        <th></th>
        <th></th>
    </tr>

    <!-- Dados -->
    <?php foreach($pokemons as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>

        </tr>
    <?php endforeach;?> 
</table>

<?php 
include_once(__DIR__ . "/../includes/footer.php");
?>

