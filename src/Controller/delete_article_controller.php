<?php
include "../../vendor/autoload.php";

use dao\ArticleDao;

session_start();

$article_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($article_id !== false){
    try{
        (new ArticleDao)->deleteArticle($article_id);
        header("location:display_articles_controller.php");
    } 
        catch(PDOException $e){
        echo $e->getMessage();
    }
} else{
    header("Location:display_articles_controller.php");

}

