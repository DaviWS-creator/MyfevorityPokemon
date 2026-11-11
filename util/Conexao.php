<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Conexao
{
    private static ?PDO $conexao = null;

    public static function getConexao(): PDO
    {
        if (self::$conexao === null) {
            //Criar a conexão com o banco de dados

            $opcoes = array(
                //Define o charset da conexão
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                //Define o tipo do erro como exceção
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                //Define o tipo do retorno das consultas
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );


            self::$conexao = new PDO('mysql:host=127.0.0.1;port=3306;dbname=pokedex', 
                                     'root', 
                                     'bancodedados', 
                                     $opcoes);
        }
        return self::$conexao;
    }
}
