<?php
$title = 'Ajouter un pokemon';
require 'partials/header-autre.php';
?>

<?php
$nom = $_POST['nom'] ?? '';
$pv = $_POST['pv'] ?? '';
$attaque = $_POST['attaque'] ?? '';
$defense = $_POST['defense'] ?? '';
$atkspe = $_POST['attaque_spe'] ?? '';
$defspe = $_POST['defense_spe'] ?? '';
$vitesse = $_POST['vitesse'] ?? '';
$numero = $_POST['numero'] ?? '';

$image = $_FILES['image']['name'] ?? '';

$errors = [];

$allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];

global $db;

if (!empty($_POST)) {

    $nom = htmlspecialchars($_POST['nom']); 

    if (strlen($nom) < 2) {
        $errors['nom'] = 'Le nom est trop court';
    }

    if ($pv <= 0) {
        $errors['pv'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($attaque <= 0) {
        $errors['attaque'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($defense <= 0) {
        $errors['defense'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($atkspe <= 0) {
        $errors['attaque_spe'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($defspe <= 0) {
        $errors['defense_spe'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($vitesse <= 0) {
        $errors['vitesse'] = 'Les statistiques ne peuvent pas être inférieur ou égale à 0';
    }

    if ($numero <= 151) {
        $errors['numero'] = 'Nous avons déjà les 151 premiers pokemons';
    }

    //Si on envoie une image 
    if (!empty($_FILES['image'])) {
        //S'il n'y a pas d'erreur et que c'est le bon type d'image
        if ($_FILES['image']['error'] === 0 && in_array($_FILES['image']['type'], $allowedTypes)) {

            $file = $_FILES['image']['tmp_name'];

            //On vérifie que le dossier image existe sinon on le crée
            if (!is_dir(__DIR__ . '/uploads/pokemons')) {
                mkdir(__DIR__ . '/uploads/pokemons');
            }

            $fileName = $numero;

            //On déplace le fichier dans le dossier choisi
            move_uploaded_file($file, __DIR__ . '/uploads/pokemons/' . $fileName);
        } else {
            $errors['image'] = 'Veuillez envoyer un fichier .jpeg , .jpg ou .png';
        }


        if (empty($errors)) {

            // Ici, on peut faire l'upload

            // Ici, on fait la requête SQL
            $query = $db->prepare(
                'INSERT INTO pokemon (nom, pv, attaque, defense, attaque_spe, defense_spe, vitesse, numero)
             VALUES (:nom, :pv, :attaque, :defense, :attaque_spe, :defense_spe, :vitesse, :numero)'
            );

            $query->bindValue(':nom', $nom);
            $query->bindValue(':pv', $pv);
            $query->bindValue(':attaque', $attaque);
            $query->bindValue(':defense', $defense);
            $query->bindValue(':attaque_spe', $atkspe);
            $query->bindValue(':defense_spe', $defspe);
            $query->bindValue(':vitesse', $vitesse);
            $query->bindValue(':numero', $numero);

            $query->execute();

            header('Location: index.php?success');
        }
    }
}
?>

<div class="ajoutP">
    <form method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter un pokemon</legend>


            <div>
                <label for="nom">Nom</label>
                <input type="textarea" name="nom" id="nom" placeholder="Nom du Pokemon" value="<?= $nom; ?>">

                <?php if (isset($errors['nom'])) {
                    echo '<div class="erreur">' . $errors['nom'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="pv">Pv</label>
                <input type="number" name="pv" id="pv" placeholder="0" value="<?= $pv; ?>">

                <?php if (isset($errors['pv'])) {
                    echo '<div class="erreur">' . $errors['pv'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="attaque">Attaque</label>
                <input type="number" name="attaque" id="attaque" placeholder="0" value="<?= $attaque; ?>">

                <?php if (isset($errors['attaque'])) {
                    echo '<div class="erreur">' . $errors['attaque'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="defense">Défense</label>
                <input type="number" name="defense" id="defense" placeholder="0" value="<?= $defense; ?>">

                <?php if (isset($errors['defense'])) {
                    echo '<div class="erreur">' . $errors['defense'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="attaque_spe">Attaque Spéciale</label>
                <input type="number" name="attaque_spe" id="attaque_spe" placeholder="0" value="<?= $atkspe; ?>">

                <?php if (isset($errors['attaque_spe'])) {
                    echo '<div class="erreur">' . $errors['attaque_spe'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="defense_spe">Defense Spéciale</label>
                <input type="number" name="defense_spe" id="defense_spe" placeholder="0" value="<?= $defspe; ?>">

                <?php if (isset($errors['defense_spe'])) {
                    echo '<div class="erreur">' . $errors['defense_spe'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="vitesse">Vitesse</label>
                <input type="number" name="vitesse" id="vitesse" placeholder="0" value="<?= $vitesse; ?>">

                <?php if (isset($errors['vitesse'])) {
                    echo '<div class="erreur">' . $errors['vitesse'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="numero">Numéro</label>
                <input type="number" name="numero" id="numero" placeholder="0" value="<?= $numero; ?>">

                <?php if (isset($errors['numero'])) {
                    echo '<div class="erreur">' . $errors['numero'] . '</div>';
                } ?>
            </div>

            <div>
                <label for="image" class="image">Choisir une photo...</label>
                <input type="file" name="image" id="image">

                <?php if (isset($errors['image'])) {
                    echo '<div class="erreur">' . $errors['image'] . '</div>';
                } ?>

            </div>
        </fieldset>
        <div class="subP">
            <input class="ajoutP" type="submit" value="Ajouter ce pokemon"></input>
        </div>
    </form>
</div>
<?php
require_once __DIR__ . '/partials/footer.php';
?>