<?php
session_start();
require __DIR__ . '/../config/config.php';
// On va inclure la connexion à la BDD
require __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="asset/index.css">

</head>

<body>
<div class="site"> 
    <header>

        <div class="nav">
        <h1 class="titre"><a href="index.php">Pokestat</a></h1>
            <nav class="nav">
                <ul>
                    <li> <a href="index.php">↰</a></li>
                </ul>
            </nav>
        </div>

    </header>