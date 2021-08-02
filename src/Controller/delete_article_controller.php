<?php

include "../Dao/article_dao.php";

if($article_id !== false){
    try{
        $article_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $articles = delete_article($article_id);
        header("location:display_articles_controller.php");
        include "../View/display_articles_controller.php";
    } 
        catch(PDOException $e){
        echo $e->getMessage();
    }
    
}

