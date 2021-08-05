<?php

use dao\ArticleDao;
use model\Article;

session_start();
include "../../vendor/autoload.php";

//$id = htmlspecialchars($_GET["id"]);
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id !== false) {
    // VERIFIER SI $_POST EST VIDE
    if(empty($_POST)){
    try {
        $article = (new ArticleDao())->getArticleById($id);

        if (!is_null($article)) {
            include "../View/edit_article.php";
        }else {
            header("location:display_articles_controller.php");
            exit;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}else{
    $args = [   
        "title" => [
            "filter" => FILTER_VALIDATE_REGEXP,
            "options" => [
                "regexp" => "#^[A-Z]#u"
            ]
            ],
            "description" => []
        ];
    
    $article_post = filter_input_array(
        INPUT_POST ,
        $args
    );


    // verifier le contenu du titre et description
    if (isset( $article_post["title"]) && isset( $article_post["description"])) {
        if ( $article_post["title"] === false) {
            $error_messages[] = "title inexistant";
        }

        if (empty(trim( $article_post["description"]))) {
            $error_messages[] = "description inexistante";
        }
    }


    if (!(isset( $article_post["title"]) && isset( $article_post["description"])) || !empty($error_messages)) {
        include "../View/edit_article.php";
    } else {
        $article = (new Article())
        ->setId_article($id)
        ->setTitle($article_post["title"])
        ->setDescription( $article_post["description"]);
        //update de l'article
        try {
            (new ArticleDao())->updateArticle($article);
            header(sprintf("location:display_articles_controller.php?id=%d",$article->getId_article()));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
}else {
    header("location:display_articles_controller.php");
    exit;
}