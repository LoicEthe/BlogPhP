<?php

include "../Dao/article_dao.php";
$id = filter_input(INPUT_GET,"id");
try{
    $articles = get_article_by_id($id);
    include "../View/display_one_article.php";
} catch(PDOException $e){
    echo $e->getMessage();
}
