<?php

include "../Dao/commentaire_dao.php";
$commentaire_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($commentaire_id !== false){
    try{
        delete_commentaire($commentaire_id);
        header("location:display_articles_controller.php");
        include "../View/display_articles_controller.php";
    } 
        catch(PDOException $e){
        echo $e->getMessage();
    }
    
}