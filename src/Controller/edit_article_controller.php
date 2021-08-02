<?php



//$id = htmlspecialchars($_GET["id"]);
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id !== false) {
    if(empty($_POST)){
        include "../Dao/article_dao.php";
    try {
        $article = get_article_by_id($id);
        if (!empty($article)) {
            include "../View/edit_article.php";
        }else {
            header("location:display_articles_controller.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}else{


    $options_title = [
        "options" => [
            "regexp" => "#^.+$#"
        ]
    ];
    $article_title = filter_input(
        INPUT_POST,
        "title",
        FILTER_VALIDATE_REGEXP,
        $options_title
    );
    $article_description = filter_input(
        INPUT_POST,
        "description"
    );

    if (isset($article_title) && isset($article_description)) {
        if ($article_title === false) {
            $error_messages[] = "title inexistant";
        }
        if (empty(trim($article_description))) {
            $error_messages[] = "description inexistante";
        }
    }
    $article = [
        "title" => $article_title,
        "description" => $article_description,
        "id_article" => $id
    ];
    if (!(isset($article_title) && isset($article_description)) || !empty($error_messages)) {
        include "../View/edit_article.php";
    } else {
        include "../Dao/article_dao.php";
        try {
            update_article($article);
            header(sprintf("location:display_articles_controller.php?id=%d",$article["id_article"]));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
}else {
    header("location:display_articles_controller.php");
}