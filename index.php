<?php
require 'partials/header-index.php';
global $db;
$query = $db->query('SELECT * FROM pokemon ORDER BY numero');
$pokemons = $query->fetchAll();
?>

<div class="index">
    <div class="indexPs">
        <?php foreach ($pokemons as $pokemon) { ?>
            <div class="indexPoke">
                <a href="./pokemon.php?id=<?= $pokemon['id']; ?>">

                    <div class="indexImg"><img src="uploads/pokemons/<?= $pokemon['numero']; ?>" alt=""></div>
                    <h1><?= $pokemon['nom']; ?></h1>

                </a>
            </div>
        <?php } ?>
    </div>
</div>

<div id="bas"></div>

<?php require 'partials/footer.php'; ?>