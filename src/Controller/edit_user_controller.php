<?php

use dao\GenreDao;
use dao\GroupeDao;
use dao\UserDao;
use model\User;

require "../../vendor/autoload.php";

session_start();

$user_id  = filter_input(INPUT_GET, "id",FILTER_VALIDATE_INT);

if($user_id !== false){

    try {
        $userDao = new UserDao();
        $user = $userDao->getUserById($user_id);
        $genres = (new GenreDao())->getAllGenre();
        $groupes = (new GroupeDao())->getAllGroupe();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if(empty($_POST)){
            if(!is_null($user)){
                require "../View/edit_user.php";
            } else{
                header("Location display_articles_controller.php");
                exit;
            }
    }else{
        $args = [
            "nom" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => [
                    "regexp" => "#^[A-Z]#"
                ]
            ] ,
            "prenom" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => [
                    "regexp" => "#^[A-Z]#"
                ]
            ] ,
            "pseudo" =>[
                "filter"=> FILTER_VALIDATE_REGEXP,
                "options" =>[
                    "regexp" => "#^[\w\s]+#u"
                ]
            ],
            "email" =>[
                "filter" => FILTER_VALIDATE_EMAIL
            ],
            "pwd"=>[],
            "genre" =>[
                "filter" => FILTER_VALIDATE_INT
            ],
            "groupe" =>[
                "filter" => FILTER_VALIDATE_INT
            ],
        ];

        $edit_post = filter_input_array(INPUT_POST,$args);
        if(empty($_POST["nom"])) $edit_user["nom"] = null;
        if(empty($_POST["prenom"])) $edit_user["prenom"] = null;
        if(empty($_POST["genre"])) $edit_user["genre"] = null;
        if(empty($_POST["groupe"])) $edit_user["groupe"] = null;


        if($edit_post["nom"] === false){
            $error_messages[] = "Nom inexistant";
        }

        if($edit_post["prenom"] === false){
            $error_messages[] = "Pr??nom inexistant";
        }

        if($edit_post["pseudo"] === false){
            $error_messages[] = "Pseudo inexistant";
        }
    
        if($edit_post["email"] === false){
            $error_messages[] = "Email inexistant";
        }
    
        if(empty(trim($edit_post["pwd"]))){
            $error_messages[] = "Mot de passe inexistant";
        }

        if($edit_post["genre"] === false){
            $error_messages[] = "Genre inexistant";
        }

        if($edit_post["groupe"] === false){
            $error_messages[] = "Groupe inexistant";
        }

        if(empty($error_messages)){
            foreach ($genres as $genre){
                if ($genre ->getId_genre() === $edit_post["genre"]) $edit_post["genre"] = $genre->getType(); {
                   
                }
            }
            foreach ($groupes as $groupe){
                if ($groupe ->getId_group() === $edit_post["groupe"]) $edit_post["groupe"] = $groupe->getNom(); {
                   
                }
            }

            $edit_user = (new User)
                ->SetId_user($user_id)
                ->SetNom($edit_post["nom"])
                ->SetPrenom($edit_post["prenom"])
                ->SetPseudo($edit_post["pseudo"])
                ->SetEmail($edit_post["email"])
                ->SetPwd(password_hash($edit_post["pwd"],PASSWORD_DEFAULT))
                ->SetGenre($edit_post["genre"])
                ->SetGroupe($edit_post["groupe"]);

            try {
                $userDao->updateUser($edit_user);
                header(sprintf("Location: show_one_user_controller.php?id=%d", $user_id));
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }else{
            require "../View/edit_user.php";
        }
    }
}  else{
    header("Location display_articles_controller.php");
    exit;
}