<?php
$title = 'Retirer un pokemon';
require 'partials/header-autre.php';

global $db;
$pokemons = $db->query('SELECT * FROM pokemon WHERE numero > 151')->fetchAll();
?>

<div class="pokeliste">
    <table class="pokeliste">
        <thead>
            <tr>
                <th>Image du Pokemon</th>
                <th>Nom du Pokemon</th>
                <th>Suppression du Pokemon</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pokemons as $pokemon) { ?>
                <tr>
                    <td><img src="uploads/pokemons/<?= $pokemon['numero']; ?>" alt=""></td>
                    <td><?= $pokemon['nom']; ?></td>
                    <td>
                        <a href="pokemon-supprimer.php?id=<?= $pokemon['id']; ?>"> <div class="rond"><div class="trait"><div class="rond2"></div></div></div> </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div id="bas"></div>

<?php require 'partials/footer.php'; ?>