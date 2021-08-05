<?php

use dao\ArticleDao;

session_start();
include "../../vendor/autoload.php";



$args = [
    "title" => [
        "filter" => FILTER_VALIDATE_REGEXP,
        "options" => [
            "regexp" => "#^[A-Z]#u"
        ]
        ],
        "description" => []
    ];

// IMPLEMENTATION DE LA BDD

$article = filter_input_array(INPUT_POST, $args);

// SI TITRE OU DESC VIDE 
if(isset($article["title"]) && isset($article["description"])){
    if($article["title"] === false){
        $error_messages[] = "Titre vide !";

    }
    if (empty(trim($article["description"]))){
        $error_messages[] = "Description vide !";
    }
}

if(!(isset($article["title"]) && isset($article["description"])) || !empty($error_messages)){ 
    include "../View/add_article.php";
}
else { 
    try { 
        (new ArticleDao)->addArticle($article["title"], $article["description"]);
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
} 