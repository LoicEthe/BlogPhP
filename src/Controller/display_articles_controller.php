<?php


session_start();
include "../../vendor/autoload.php";
use dao\ArticleDao;


try{
    $articles = (new ArticleDao())->getAllArticle();
    include "../View/display_articles.php";
} catch(PDOException $e){
    echo $e->getMessage();
}

