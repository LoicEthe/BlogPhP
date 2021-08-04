<?php
$title = "Editer un utilisateur";
include 'header.php';


if (!empty($error_messages)) :?>
<div>
    <ul>
        <?php foreach ($error_messages as $msg) :?>
            <li><?= $msg ?></li>
            <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="" method="post">
    <label for="nom">Nom :</label><input type="text" name="nom" id="nom">
    <label for="prenom">Prénom : </label><input type="text" name="prenom" id="prenom">
    <label for="pseudo">Pseudo :</label><input type="text" name="pseudo" id="pseudo">
    <label for="email">Email :</label><input type="text" name="email" id="email">
    <label for="pwd">Mot de passe :</label><input type="password" name="pwd" id="pwd">
    <label for="genre">Genre</label><input type="text" name="genre" id="genre">
    <label for="groupe">Groupe</label><input type="text" name="group" id="group">
    <input type="submit" value="Envoyer">
</form>

<?php include 'footer.php' ?>