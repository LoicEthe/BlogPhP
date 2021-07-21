<?php

$options_title = ["options" => [ // FILTRE REGEX POUR TITRE
    "regexp" => "#^[a-zA-Z].+$#"
]];

$article_title = filter_input(  // VA CHERCHER LES DONNES DU FORM GRACE A INPUT_POST
    INPUT_POST, 
    "title",
    FILTER_VALIDATE_REGEXP,
    $options_title
);

$article_description = filter_input(
    INPUT_POST, 
    "description"
);

// IMPLEMENTATION DE LA BDD

// SI TITRE OU DESC VIDE 
if(isset($article_title) && isset($article_description)){
    if($article_title === false){
        $error_messages[] = "Titre vide !";

    }
    if (empty(trim($article_description))){
        $error_messages[] = "Description vide !";
    }
}

if(!(isset($article_title) && isset($article_description)) || !empty($error_messages)){ 
    include "../View/add_article.php";
}

else { // SINON ENVOIT A LA BASE DE DONNES
    try { 
        $dbh = new PDO(
            "mysql:host=localhost;dbname=ccib;charset=UTF8",
            "root",
            "",[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $req = $dbh->prepare("INSERT INTO article (title, description) 
                            VALUES (:title, :description)");
        $req->execute([
            ":title" => $article_title,
            ":description" => $article_description
        ]);
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
} 