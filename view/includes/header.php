<?php
include_once(__DIR__ . "/../../util/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/style/style.css">
</head>
<body>

    <header class="header">
        <div class="header-logo">
            <img src="<?= BASE_URL ?>/img/pokeball_heart_favicon.svg" alt="Logo" height="50">
            <h1>MyFavoritePokemon</h1>
        </div>
        <nav class="nav">
            <a href="index.php">Início</a>
            <a href="<?= BASE_URL ?>/view/pokemon/listar.php">Pokémons</a>
        </nav>
    </header>