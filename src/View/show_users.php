<?php

use dao\UserDao;

$title = "Liste des utilisateurs";
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


<!-- PREMIERE SOLUTION, PLUS VISUELLE AVEC APPEL DES METHODES-->
<!-- DEUXIEME SOLUCE FOREACH DANS DISCORD ANAELLE-->
<?php
if(empty($listUsers)) : 
    echo "Rien à afficher";
else :
?>       
<table>
    <thead>
        <tr>
          <th>L'id de L'utilisateur</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Pseudo</th>
          <th>Email</th>
          <th>Date Création</th>
          <th>Genre</th>
          <th>Groupe</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $user = current($listUsers);
        do {
        ?>    
        <tr>
            <td><?= $user->getId_user() ?></td>
            <td><?= $user->getNom() ?></td>
            <td><?= $user->getPrenom() ?></td>
            <td><?= $user->getPseudo() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getDate_creation() ?></td>
            <td><?= $user->getGenre() ?></td>
            <td><?= $user->getGroupe() ?></td>
        </tr> 
        <?php
        } while ($user = next($listUsers)) ?>
    </tbody>
</table>
<?php
endif;

include 'footer.php';
?>

