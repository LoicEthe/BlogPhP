<?php

use dao\CommentaireDao;
use model\Commentaire;

include "../../vendor/autoload.php";
session_start();

$article_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($article_id !== false){
    if(empty($_POST)){
        include "../View/add_commentaire.php";
    }
    else{
        $comment = [
            "id_article" => $article_id,
            "contenu" => filter_input(INPUT_POST, "contenu")
        ];
        $commentaire = (new Commentaire())
        ->setId_article($comment["id_article"])
        ->setContenu($comment["contenu"]);
        
        
        if(isset($comment["contenu"]) && empty(trim($comment["contenu"]))){
            $error_messages[] = "Commentaire vide !";
        }
        
        if(!isset($comment["contenu"]) || !empty($error_messages)){
        
            include "../View/add_commentaire.php";
        }
        else{
            include "../Dao/CommentaireDao.php";
            try{
                (new CommentaireDao())->addCommentaire($commentaire);
                echo 'alors';
                // header(sprintf("location:display_one_article_controller.php?id=%d", $comment["article_id"]));
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    }
} else {
    header("Location: display_articles_controller.php");
}