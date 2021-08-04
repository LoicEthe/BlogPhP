<?php

include "../../vendor/autoload.php";

use dao\UserDao;
use model\User;

try{
    $userDao = new UserDao();
    $listUsers = $userDao->getuser();
    foreach($listUsers as $key => $user){
        $listUsers[$key] = (new User())
            ->setId_user(($user['id']))
            ->setNom(($user['nom']))
            ->setPrenom(($user['prenom']))
            ->setPseudo(($user['pseudo']))
            ->setEmail(($user['email']))
            ->setDate_creation(($user['date_creation']))
            ->setGenre(($user['genre']))
            ->setGroupe(($user['groupe']));
    }
    include "../View/show_users.php";
}
catch (PDOException $e){
    echo $e->getMessage();
} 