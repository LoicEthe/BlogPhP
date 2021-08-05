<?php

use dao\ArticleDao;

session_start();
include "../../vendor/autoload.php";

$article_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


// RECUPERATION DE L'ARTICLE
if($article_id !== false){
    try{
        $article = (new ArticleDao())->getArticleById($article_id);
        if(!is_null($article)){
            // RECUPERATION DU COMMENTAIRE
            $commentaires = get_commentaire_by_article_id($article_id);
            include "../View/display_one_article.php";
        } else{
            header("location:display_articles_controller.php");
            exit;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}   else{
    header("location:display_articles_controller.php");
    exit;
}

