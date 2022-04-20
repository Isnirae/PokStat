<?php

// Pour utiliser le header('Location: ...'); et afficher du contenu avant
ob_start();

// On va d'abord récupèrer l'id dans l'URL
$id = $_GET['id'] ?? 0;

// On inclus la connexion à la base de données avant
// pour pouvoir afficher le titre du film dans la balise
// title (require_once pour être sûr de ne faire qu'une
// seule connexion)
require_once 'config/database.php';


global $db;
$query = $db->prepare('SELECT * FROM pokemon WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute(); // Nécessaire si on prépare la requête
$pokemon = $query->fetch(); // On a une seule ligne de résultat
$title = $pokemon['nom'];

// J'affiche le titre du pokemon dans la balise title du head
$nom = $pokemon['nom'];
require __DIR__ . '/partials/header-autre.php';

// Si le pokemon n'existe pas
if (!$pokemon) {
    require 'partials/404.php';
}
?>

<div class="pstat">

    <div class="pstatimg">
        <ul>
            <li>
                <div class="img"><img src="uploads/pokemons/<?= $pokemon['numero']; ?>" alt=""></div>
            </li>
            <li>
                <h1><?= $pokemon['nom']; ?></h1>
            </li>
        </ul>
    </div>
    <div class="pstatistique">
        <ul>
            <li>
                <h3>PV</h3>
            </li>
            <li>
                <h3><?= $pokemon['pv']; ?></h3>
            </li>
        </ul>
        <ul>
            <li>
                <h3>Attaque</h3>
            </li>
            <li>
                <h3><?= $pokemon['attaque']; ?></h3>
            </li>
        </ul>
        <ul>
            <li>
                <h3>Defense</h3>
            </li>
            <li>
                <h3><?= $pokemon['defense']; ?></h3>
            </li>
        </ul>
        <ul>
            <li>
                <h3>A.Spe</h3>
            </li>
            <li>
                <h3><?= $pokemon['attaque_spe']; ?></h3>
            </li>
        </ul>
        <ul>
            <li>
                <h3>D.Spe</h3>
            </li>
            <li>
                <h3><?= $pokemon['defense_spe']; ?></h3>
            </li>
        </ul>
        <ul>
            <li>
                <h3>Vitesse</h3>
            </li>
            <li>
                <h3><?= $pokemon['vitesse']; ?></h3>
            </li>
        </ul>
    </div>

</div>

<?php require 'partials/footer.php'; ?>