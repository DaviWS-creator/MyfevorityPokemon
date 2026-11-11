<?php

require_once("util/Conexao.php");

//1- Identificar qual pokemon o usuário quer excluir
//2- Validar se o identificador do pokemon foi recebido
$id = 0;
if(isset($_GET['id']))
    $id = $_GET['id'];

if($id > 0) {
    //3- Excluir o pokemon do banco de dados (SQL)
    $conexao = Conexao::getConexao();
    
    $sql = "DELETE FROM pokemon WHERE id = ?";
    $stm = $conexao->prepare($sql);
    $stm->execute([$id]);

    //4- Redirecionar para a listagem de pokemons
    header("location: index.php");

} else {
    echo "Parâmetro ID inválido!<br>";
    echo "<a href='index.php'>Voltar</a>";
}