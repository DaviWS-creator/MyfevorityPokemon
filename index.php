<?php

//Exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

$msgErro = "";
require_once("util/Conexao.php");
require_once("util/functions.php");

$conexao = Conexao::getConexao();

$nome = '';
$tipo1 = '';
$tipo2 = '';
$tipos = [];
$descricao = '';
$urlImg = '';

//Salvar o Pokemon
if (isset($_POST['nome'])) {
    //1- Receber os dados do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $tipo1 = trim($_POST['tipo1']) ? trim($_POST['tipo1']) : null;
    $tipo2 = trim($_POST['tipo2']) ? trim($_POST['tipo2']) : null;
    $tipos = array_filter([$tipo1, $tipo2]); // Remove valores nulos do array de tipos
    $descricao = trim($_POST['descricao']) ? trim($_POST['descricao']) : null;
    $urlImg = trim($_POST['imagem']) ? trim($_POST['imagem']) : null;

    //1.1 - Validar os dados

    $msgs = [];
    if (! $nome) {
        array_push($msgs, "O nome do Pokemon deve ser informado");
    } elseif (strlen($nome) < 3) {
        array_push($msgs, "O nome não pode ter menos de 3 caracteres");
    } elseif (strlen($nome) > 50) {
        array_push($msgs, "O nome não pode ter mais de 50 caracteres");
    }

    $sql = "SELECT nome from pokemon where nome = ?";
    $stm = $conexao->prepare($sql);
    $stm->execute([$nome]);
    $pokemon = $stm->fetch(); //retorna apenas um registro ou false se não encontrar nenhum
    if ($pokemon) {
        array_push($msgs, "Já existe um pokemon cadastrado com este nome!");
    }

    // Valida o tipo1 que é obrigatório, e o tipo2 só se foi preenchido
    $tiposValidos = [
        'Normal',
        'Fogo',
        'Água',
        'Grama',
        'Elétrico',
        'Gelo',
        'Lutador',
        'Veneno',
        'Terra',
        'Voador',
        'Psíquico',
        'Inseto',
        'Pedra',
        'Fantasma',
        'Dragão',
        'Sombrio',
        'Aço',
        'Fada'
    ];

    if (! $tipo1 || ! in_array($tipo1, $tiposValidos)) {
        array_push($msgs, "O tipo 1 do Pokemon deve ser informado");
    }
    if ($tipo2 && ! in_array($tipo2, $tiposValidos)) {
        array_push($msgs, "O tipo 2 informado é inválido");
    }

    if (! $descricao) {
        array_push($msgs, "A descrição do Pokemon deve ser informada");
    } elseif (strlen($descricao) < 10) {
        array_push($msgs, "A descrição deve conter pelo menos 10 caracteres");
    } elseif (strlen($descricao) > 200) {
        array_push($msgs, "A descrição deve conter no máximo 200 caracteres");
    }

    if (! $urlImg) {
        $urlImg = "img/placeholder_pokeball_final.svg";
    } elseif (strlen($urlImg) > 400) {
        array_push($msgs, "A URL da imagem do Pokemon deve conter no máximo 400 caracteres");
    } elseif (! filter_var($urlImg, FILTER_VALIDATE_URL)) {
        array_push($msgs, "A URL da imagem do Pokemon deve ser válida");
    }

    if (empty($msgs)) {
        $sql = "INSERT INTO pokemon (nome, tipo, descricao, urlImg) VALUES (?, ?, ?, ?)";
        $stm = $conexao->prepare($sql);
        $stm->execute([$nome, json_encode($tipos), $descricao, $urlImg]); // Array PHP → JSON string pro MySQL

        //Limpar os campos do formulário
        $nome = '';
        $tipos = [];
        $descricao = '';
        $urlImg = '';
    } else {
        //Exibir os erros
        $msgErro = implode("<br>", $msgs);
    }
}
//Listagem dos pokemons
$sql = "SELECT * FROM pokemon";
$stm = $conexao->prepare($sql);
$stm->execute();
$pokemons = $stm->fetchAll();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyFavoritePokemon</title>
    <link rel="icon" type="image/svg+xml" href="img/pokeball_heart_favicon.svg">
    <link rel="stylesheet" href="sytle/style.css">
    <link rel="stylesheet" href="sytle/card-style.css">
    <link rel="stylesheet" href="sytle/form-style.css">
    <link rel="stylesheet" href="sytle/table-style.css">
</head>

<body>

    <div class="container">

        <?php require 'includes/header.php'; ?>

        <main>
            <h2 style="font-size: 40px; color: #7a4a1a; margin: 20px auto 0px auto; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">Pokemons Cadastrados</h2>

            <div class="container-table">

                <table>
                    <!-- Cabeçalho -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>URL da Imagem</th>
                        </tr>
                    </thead>
                    <!-- Dados -->
                    <tbody>
                        <?php foreach ($pokemons as $p): ?>
                            <tr>
                                <td><?= $p["id"] ?></td>
                                <td><?= $p["nome"] ?></td>
                                <td>
                                    <?= implode(', ', json_decode($p['tipo'])) ?>
                                </td>
                                <td><?= $p["descricao"] ?></td>
                                <td><?= $p["urlImg"] ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>



            <!-- Formulario -->
            <div class="container-form">
                <h3 id="formulario">Formulário</h3>
                <div class="row">

                    <form action="" method="POST">

                        <!-- Campos -->
                        <div class="campos-form">

                            <!-- Campo nome -->
                            <div class="campo-form">
                                <input type="text" placeholder="Informe o nome"
                                    name="nome" id="nome" value="<?= $nome ?>">
                            </div>

                            <!-- Campo tipo1 -->
                            <div class="campo-form">
                                <select name="tipo1" id="tipo1">
                                    <option value="">---Selecione o tipo---</option>
                                    <option value="Normal" <?= ($tipo1 == 'Normal') ? 'selected' : '' ?>>Normal</option>
                                    <option value="Fogo" <?= ($tipo1 == 'Fogo') ? 'selected' : '' ?>>Fogo</option>
                                    <option value="Água" <?= ($tipo1 == 'Água') ? 'selected' : '' ?>>Água</option>
                                    <option value="Grama" <?= ($tipo1 == 'Grama') ? 'selected' : '' ?>>Grama</option>
                                    <option value="Elétrico" <?= ($tipo1 == 'Elétrico') ? 'selected' : '' ?>>Elétrico</option>
                                    <option value="Gelo" <?= ($tipo1 == 'Gelo') ? 'selected' : '' ?>>Gelo</option>
                                    <option value="Lutador" <?= ($tipo1 == 'Lutador') ? 'selected' : '' ?>>Lutador</option>
                                    <option value="Veneno" <?= ($tipo1 == 'Veneno') ? 'selected' : '' ?>>Veneno</option>
                                    <option value="Terra" <?= ($tipo1 == 'Terra') ? 'selected' : '' ?>>Terra</option>
                                    <option value="Voador" <?= ($tipo1 == 'Voador') ? 'selected' : '' ?>>Voador</option>
                                    <option value="Psíquico" <?= ($tipo1 == 'Psíquico') ? 'selected' : '' ?>>Psíquico</option>
                                    <option value="Inseto" <?= ($tipo1 == 'Inseto') ? 'selected' : '' ?>>Inseto</option>
                                    <option value="Pedra" <?= ($tipo1 == 'Pedra') ? 'selected' : '' ?>>Pedra</option>
                                    <option value="Fantasma" <?= ($tipo1 == 'Fantasma') ? 'selected' : '' ?>>Fantasma</option>
                                    <option value="Dragão" <?= ($tipo1 == 'Dragão') ? 'selected' : '' ?>>Dragão</option>
                                    <option value="Sombrio" <?= ($tipo1 == 'Sombrio') ? 'selected' : '' ?>>Sombrio</option>
                                    <option value="Aço" <?= ($tipo1 == 'Aço') ? 'selected' : '' ?>>Aço</option>
                                    <option value="Fada" <?= ($tipo1 == 'Fada') ? 'selected' : '' ?>>Fada</option>
                                </select>
                                <!-- Botão que revela o segundo select -->
                                <button type="button" id="btnAddTipo" style="display: <?= $tipo2 ? 'none' : 'inline' ?>;">
                                    +
                                </button>

                            </div>

                            <!-- Segundo select começa escondido -->

                            <!-- Passa a visibilidade pro div via PHP -->
                            <div class="campo-form" id="tipo2Container" style="display: <?= $tipo2 ? 'block' : 'none' ?>;">
                                <select name="tipo2" id="tipo2">
                                    <option value="">---Selecione o tipo---</option>
                                    <option value="Normal" <?= ($tipo2 == 'Normal') ? 'selected' : '' ?>>Normal</option>
                                    <option value="Fogo" <?= ($tipo2 == 'Fogo') ? 'selected' : '' ?>>Fogo</option>
                                    <option value="Água" <?= ($tipo2 == 'Água') ? 'selected' : '' ?>>Água</option>
                                    <option value="Grama" <?= ($tipo2 == 'Grama') ? 'selected' : '' ?>>Grama</option>
                                    <option value="Elétrico" <?= ($tipo2 == 'Elétrico') ? 'selected' : '' ?>>Elétrico</option>
                                    <option value="Gelo" <?= ($tipo2 == 'Gelo') ? 'selected' : '' ?>>Gelo</option>
                                    <option value="Lutador" <?= ($tipo2 == 'Lutador') ? 'selected' : '' ?>>Lutador</option>
                                    <option value="Veneno" <?= ($tipo2 == 'Veneno') ? 'selected' : '' ?>>Veneno</option>
                                    <option value="Terra" <?= ($tipo2 == 'Terra') ? 'selected' : '' ?>>Terra</option>
                                    <option value="Voador" <?= ($tipo2 == 'Voador') ? 'selected' : '' ?>>Voador</option>
                                    <option value="Psíquico" <?= ($tipo2 == 'Psíquico') ? 'selected' : '' ?>>Psíquico</option>
                                    <option value="Inseto" <?= ($tipo2 == 'Inseto') ? 'selected' : '' ?>>Inseto</option>
                                    <option value="Pedra" <?= ($tipo2 == 'Pedra') ? 'selected' : '' ?>>Pedra</option>
                                    <option value="Fantasma" <?= ($tipo2 == 'Fantasma') ? 'selected' : '' ?>>Fantasma</option>
                                    <option value="Dragão" <?= ($tipo2 == 'Dragão') ? 'selected' : '' ?>>Dragão</option>
                                    <option value="Sombrio" <?= ($tipo2 == 'Sombrio') ? 'selected' : '' ?>>Sombrio</option>
                                    <option value="Aço" <?= ($tipo2 == 'Aço') ? 'selected' : '' ?>>Aço</option>
                                    <option value="Fada" <?= ($tipo2 == 'Fada') ? 'selected' : '' ?>>Fada</option>
                                </select>
                                <!-- Botão para remover o segundo select -->
                                <button type="button" id="btnRemoveTipo">✕</button>
                            </div>


                            <!-- Campo descriçao -->
                            <div class="campo-form">
                                <textarea placeholder="Informe a descrição"
                                    name="descricao" id="descricao"><?= $descricao ?></textarea>

                            </div>

                            <!-- Campo da URL da imagem -->
                            <div class="campo-form">
                                <input type="text" name="imagem" id="urlImg"
                                    placeholder="Informe o URL da imagem" value="<?= $urlImg ?>">

                            </div>

                            <div>
                                <button class="btnGravar">Gravar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="color: red">
                    <?= $msgErro ?>
                </div>

            </div>

        </main>
    </div>

    <?php require 'includes/footer.php'; ?>
    
    <script>
        document.getElementById('btnAddTipo').addEventListener('click', function() {
            document.getElementById('tipo2Container').style.display = 'block';
            this.style.display = 'none'; // Esconde o botão de adicionar
        });

        document.getElementById('btnRemoveTipo').addEventListener('click', function() {
            document.getElementById('tipo2Container').style.display = 'none';
            document.getElementById('btnAddTipo').style.display = 'inline'; // Mostra o botão de novo
        });
    </script>
</body>

</html>