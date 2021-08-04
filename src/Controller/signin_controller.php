<?php
session_start(); // SESSION DEMARRE

include "../../vendor/autoload.php";
use dao\UserDao;
use model\User;

if(isset($_SESSION["user"])){
    header("Location: display_articles_controller.php");
    exit;
}



if(empty($_POST)){
    include "../View/signin.php";
} else{
    $args = [
        "email" =>[
            "filter" => FILTER_VALIDATE_EMAIL
        ],
        "pwd"=>[]
    ];

     // option de vérification
     $signin_post = filter_input_array(INPUT_POST,$args);

     // si champs vide alors message d'erreur
     
     if($signin_post["email"] === false){
         $error_messages[] = "Email inexistant";
     }
 
     if(empty(trim($signin_post["pwd"]))){
         $error_messages[] = "Mot de passe inexistant";
     }

     if(empty($error_messages)){
        $signin_user = (new User()) // APPEL DE LA CLASSE CREEE DANS LE MODEL
            ->setEmail($signin_post["email"])
            ->setPwd($signin_post["pwd"]);  //HASHAGE DU PASSWORD
        
        try{
            $userDao = new UserDao();
            $user = $userDao->getUserByEmail($signin_user->getEmail());
            
            if(!is_null($user)){
                if(password_verify($signin_user->getPwd(), $user->getPwd())){
                    $user = $userDao->getUserById($user->getId_user());
              
                session_regenerate_id(true);
                $_SESSION["user"] = serialize($user);
                header("Location: display_articles_controller.php");
                exit;
                } else{
                    $error_messages[] = "Mot de passe erroné";
                    include "../View/signin.php";
                    exit;
                } 
            } else{
                $error_messages[] = "Email erroné";
                    include "../View/signin.php";
                    exit;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    } else{
        include "../View/signup.php";
    }
}