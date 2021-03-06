<?php
session_start();


include "../../vendor/autoload.php";

use dao\UserDao;
use model\User;




if(empty($_POST)){
    include "../View/signup.php";
} else{
    $args = [
        "pseudo" =>[
            "filter"=> FILTER_VALIDATE_REGEXP,
            "options" =>[
                "regexp" => "#^[\w\s]+#u"
            ]
        ],
        "email" =>[
            "filter" => FILTER_VALIDATE_EMAIL
        ],
        "pwd"=>[]
    ];

    // option de vérification
    $signup_post = filter_input_array(INPUT_POST,$args);

    // si champs vide alors message d'erreur
    if($signup_post["pseudo"] === false){
        $error_messages[] = "Pseudo inexistant";
    }

    if($signup_post["email"] === false){
        $error_messages[] = "Email inexistant";
    }

    if(empty(trim($signup_post["pwd"]))){
        $error_messages[] = "Mot de passe inexistant";
    }

    if(empty($error_messages)){
        $signup_user = new User(); // APPEL DE LA CLASSE CREEE DANS LE MODEL
        $signup_user->setPseudo($signup_post["pseudo"]); 
        $signup_user->setEmail($signup_post["email"]); 
        $signup_user->setPwd(password_hash($signup_post["pwd"],PASSWORD_DEFAULT));  //HASHAGE DU PASSWORD
        
        try{
            $userDao = new UserDao();
            $userDao->addUser($signup_user);
            header("Location: display_articles_controller.php");
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    } else{
        include "../View/signup.php";
    }
}